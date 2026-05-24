<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ContractRequest;
use App\Models\Company;
use App\Models\Property;
use App\Models\Customer;
use App\Services\Dashboard\ContractService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Exceptions\DeleteRestrictionException;

class ContractsController extends Controller
{
    protected $service;

    // Initialize the controller with the Contract Service
    public function __construct(ContractService $service)
    {
        $this->service = $service;
    }

    // Display a list of all contracts with filters and statistics
    public function index(Request $request)
    {
        Gate::authorize('contracts_read');

        $contracts = $this->service->getAll($request);
        $title = __('contracts.contracts');
        $companies = null;

        if (user()->company_id == 1) {
            $companies = Company::active()->orderBy('id', 'desc')->get();
        }

        $properties = Property::orderBy('id', 'desc')->get();
        $customers = Customer::active()->orderBy('id', 'desc')->get();
        $stats = $this->service->getStats();

        if ($request->ajax() || $request->has('_ajax')) {
            return view('dashboard.contracts.partials._table', compact('contracts', 'companies', 'properties', 'customers'))->render();
        }

        return view('dashboard.contracts.index', compact('contracts', 'title', 'companies', 'properties', 'customers', 'stats'));
    }

    // Display the create new contract screen
    public function create()
    {
        Gate::authorize('contracts_create');
        $title = __('contracts.create_new_contract');
        return view('dashboard.contracts.create', compact('title'));
    }

    // Store new contract data in the database
    public function store(ContractRequest $request)
    {
        Gate::authorize('contracts_create');

        try {
            $this->service->store($request->validated());
            return response()->json([
                'status' => true,
                'message' => __('general.add_success_message')
            ]);
        } catch (\Exception $e) {
            \Log::error('Contract Store Error: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => __('general.add_error_message') . ' - ' . $e->getMessage()
            ], 500);
        }
    }

    // Show details for a specific contract (Preview)
    public function show($id)
    {
        Gate::authorize('contracts_read');

        $contract = $this->service->find($id);
        $title = __('contracts.contract_details') . ' #' . $contract->id;

        return view('dashboard.contracts.show', compact('contract', 'title'));
    }

    // Display the edit screen for an existing contract
    public function edit($id)
    {
        Gate::authorize('contracts_update');
        $contract = $this->service->find($id);
        if (!$contract) {
            flash()->error(__('general.item_not_found'));
            return redirect()->route('dashboard.contracts.index');
        }

        if (!$contract->contractDetail) {
            flash()->warning(__('contracts.contract_details_not_found', ['default' => 'لم يتم العثور على تفاصيل العقد (اللقطة الثابتة). يرجى فتح شاشة تعديل العقد والضغط على حفظ أولاً.']));
        }

        $title = __('contracts.update_contract') . ' #' . $contract->id;
        return view('dashboard.contracts.edit', compact('contract', 'title'));
    }

    // Update contract data in the database
    public function update(ContractRequest $request, $id)
    {
        Gate::authorize('contracts_update');

        try {
            $this->service->update($id, $request->validated());
            return response()->json([
                'status' => true,
                'message' => __('general.update_success_message')
            ]);
        } catch (\Exception $e) {
            \Log::error('Contract Update Error: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => __('general.update_error_message') . ' - ' . $e->getMessage()
            ], 500);
        }
    }

    // Delete a contract while checking restriction constraints
    public function destroy(Request $request)
    {
        Gate::authorize('contracts_delete');

        try {
            $this->service->delete($request->id);
            return response()->json([
                'status' => true,
                'message' => __('general.delete_success_message')
            ]);
        } catch (DeleteRestrictionException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => __('general.delete_error_message')
            ], 500);
        }
    }

    // Fast autocomplete search for contracts
    public function autocomplete(Request $request)
    {
        $data = $this->service->autocomplete($request->get('q'));
        return response()->json($data);
    }

    // Fetch and display contract payments (AJAX)
    public function getPayments($id)
    {
        Gate::authorize('contracts_read');
        $contract = $this->service->find($id);
        return view('dashboard.contracts.show._payments', compact('contract'))->render();
    }

    // Fetch and display contract cheques (AJAX)
    public function getCheques($id)
    {
        Gate::authorize('contracts_read');
        $contract = $this->service->find($id);
        return view('dashboard.contracts.show._cheques', compact('contract'))->render();
    }

    // Main function to generate and print the contract in Word (Docx) format
    public function print($id)
    {
        Gate::authorize('contracts_read');
        $contract = $this->service->find($id);
        if (!$contract) {
            abort(404);
        }

        $template_path = storage_path('app/rental-templates/contract.docx');
        if (!file_exists($template_path)) {
            return response()->json(['status' => false, 'message' => 'Template not found'], 404);
        }

        $template = new \PhpOffice\PhpWord\TemplateProcessor($template_path);
        
        $detail = $contract->contractDetail;
        if (!$detail) {
            flash()->warning(__('contracts.contract_details_not_found', ['default' => 'لم يتم العثور على تفاصيل العقد (اللقطة الثابتة). يرجى فتح شاشة تعديل العقد والضغط على حفظ أولاً.']));
            return redirect()->back();
        }

        $this->setBasicData($template, $contract, $detail);
        $this->setFinancialData($template, $contract);
        $this->setFirstPartyData($template, $contract, $detail);
        $this->setSecondPartyData($template, $contract, $detail);
        $this->setPropertyData($template, $contract, $detail);
        $this->setUtilitiesTable($template, $contract, $detail);

        $replacements = $this->getSmartTagsReplacements($contract, $detail);
        $this->setClausesComplexBlock($template, $detail, $replacements);

        $fileName = 'RentalContract-' . $contract->id . '-' . date('Ymd') . '.docx';
        $temp_dir = storage_path('app/temp');
        if (!file_exists($temp_dir)) {
            mkdir($temp_dir, 0755, true);
        }

        $outputPath = $temp_dir . '/' . $fileName;
        $template->saveAs($outputPath);

        return response()->download($outputPath)->deleteFileAfterSend(true);
    }

    // Helper to set basic contract data (dates, duration, grace period)
    private function setBasicData($template, $contract, $detail)
    {
        $template->setValue('conclusion_date', $contract->conclusion_date ? $contract->conclusion_date->format('d/m/Y') : '');
        $template->setValue('start_date', $contract->start_date ? $contract->start_date->format('d/m/Y') : '');
        $template->setValue('end_date', $contract->end_date ? $contract->end_date->format('d/m/Y') : '');
        
        $durationText = $contract->duration_label ?? '';
        $durationRun = new \PhpOffice\PhpWord\Element\TextRun();
        $durationRun->getParagraphStyle()->setBidi(true);
        $durationRun->getParagraphStyle()->setAlignment(\PhpOffice\PhpWord\SimpleType\Jc::END);
        $durationRun->addText($durationText, ['rtl' => true, 'bidi' => true, 'name' => 'Calibri', 'size' => 11]);
        $template->setComplexValue('contract_duration', $durationRun);
        
        $template->setValue('grace_period', $detail->grace_period ?? 'لا يوجد');
    }

    // Helper to set financial data (rent and deposit with Tafqeet wording)
    private function setFinancialData($template, $contract)
    {
        $template->setValue('rent_amount', intval($contract->rent_amount) . ' ' . __('general.qatari_riyal'));
        $template->setValue('rent_amount_ar', tafqeet(intval($contract->rent_amount), __('general.qatari_riyal'), __('general.dirham')));
        $template->setValue('deposit_amount', intval($contract->deposit_amount) . ' ' . __('general.qatari_riyal'));
        $template->setValue('deposit_amount_ar', tafqeet(intval($contract->deposit_amount), __('general.qatari_riyal'), __('general.dirham')));
    }

    // Helper to set First Party (Landlord/Company) data
    private function setFirstPartyData($template, $contract, $detail)
    {
        $firstParty = $detail->first_party_data ?? [];
        $template->setValue('first_party_name', $firstParty['name']['ar'] ?? ($firstParty['name'] ?? ''));
        $template->setValue('first_party_owner_name', $firstParty['owner_name'] ?? '');
        $template->setValue('first_party_owner_qid', $firstParty['owner_qid'] ?? '');
        $template->setValue('first_party_owner_phone', $firstParty['owner_phone'] ?? '');
    }

    // Helper to set Second Party (Tenant) data
    private function setSecondPartyData($template, $contract, $detail)
    {
        $secondParty = $detail->second_party_data ?? [];
        $liveTenant = optional($contract->customer);
        
        $template->setValue('second_party_name', $secondParty['name']['ar'] ?? ($secondParty['name'] ?? optional($liveTenant)->name ?? ''));
        $template->setValue('second_party_id', $secondParty['id_number'] ?? optional($liveTenant)->id_number ?? '');
        $template->setValue('second_party_nationality', $secondParty['nationality'] ?? optional($liveTenant->nationality)->name ?? '');
        $template->setValue('second_party_phone', $secondParty['phone'] ?? optional($liveTenant)->phone ?? '');
        $template->setValue('second_party_company_name', $secondParty['company_name'] ?? optional($liveTenant)->company_name ?? '');
        $template->setValue('second_party_cr_number', $secondParty['cr_number'] ?? optional($liveTenant)->cr_number ?? '');
        $template->setValue('second_party_license_number', $secondParty['license_number'] ?? optional($liveTenant)->license_number ?? '');
        $template->setValue('second_party_establishment_number', $secondParty['establishment_number'] ?? optional($liveTenant)->establishment_number ?? '');
    }

    // Helper to set Property and unit details
    private function setPropertyData($template, $contract, $detail)
    {
        $property = $detail->property_data ?? [];
        $liveProperty = optional($contract->property);
        $template->setValue('property_zone', $property['zone_number'] ?? '');
        $template->setValue('property_street', $property['street_number'] ?? '');
        $template->setValue('property_building', $property['building_number'] ?? '');
        $template->setValue('property_deed', $property['title_deed_number'] ?? '');
        $template->setValue('property_name_ar', $property['name_ar'] ?? $liveProperty->getTranslation('name', 'ar') ?? '');
        $template->setValue('property_name_en', $property['name_en'] ?? $liveProperty->getTranslation('name', 'en') ?? '');
        $template->setValue('property_type', $property['type'] ?? optional($liveProperty->propertyType)->name ?? '');
        $template->setValue('property_floor', $property['floor'] ?? $liveProperty->floor ?? '');
        $template->setValue('property_description', $property['description'] ?? $liveProperty->description ?? '');
    }

    // Helper to clone and populate the utilities table (electricity/water meters and unit amounts)
    private function setUtilitiesTable($template, $contract, $detail)
    {
        $utilities = $detail->utilities_data ?? [];
        
        $variables = $template->getVariables();
        if (in_array('electricity_number', $variables)) {
            try {
                $utilitiesCount = count($utilities) > 0 ? count($utilities) : 1;
                $template->cloneRow('electricity_number', $utilitiesCount);
                
                foreach ($utilities as $index => $utility) {
                    $rowIdx = $index + 1;
                    $template->setValue('meter_index#' . $rowIdx, $rowIdx);
                    $template->setValue('electricity_number#' . $rowIdx, $utility['electricity_account_number'] ?? '');
                    $template->setValue('water_number#' . $rowIdx, $utility['water_account_number'] ?? '');
                    $template->setValue('unit_rent_amount#' . $rowIdx, $utility['unit_rent_amount'] ?: ($contract->rent_amount ?? ''));
                    $template->setValue('unit_deposit_amount#' . $rowIdx, $utility['unit_deposit_amount'] ?: ($contract->deposit_amount ?? ''));
                }
                
                if (count($utilities) == 0) {
                    $template->setValue('meter_index#1', '1');
                    $template->setValue('electricity_number#1', '');
                    $template->setValue('water_number#1', '');
                    $template->setValue('unit_rent_amount#1', $contract->rent_amount ?? '');
                    $template->setValue('unit_deposit_amount#1', $contract->deposit_amount ?? '');
                }
            } catch (\Exception $e) {
                \Log::warning('Word Template utilities table clone failed: ' . $e->getMessage());
            }
        }
    }

    // Helper to prepare the smart tags replacement array for contract clauses
    private function getSmartTagsReplacements($contract, $detail)
    {
        $firstParty = $detail->first_party_data ?? [];
        $secondParty = $detail->second_party_data ?? [];
        $property = $detail->property_data ?? [];
        
        $companyName = $firstParty['name']['ar'] ?? ($firstParty['name'] ?? optional(optional($contract->property)->company)->getTranslation('name', 'ar') ?? '');
        
        $liveOwner = optional($contract->property)->owners ? $contract->property->owners->where('pivot.is_primary', 1)->first() : null;
        if (!$liveOwner && optional($contract->property)->owners) {
            $liveOwner = $contract->property->owners->first();
        }

        $ownerName = $firstParty['owner_name'] ?? optional($liveOwner)->name ?? '';
        $ownerQid = $firstParty['owner_qid'] ?? optional($liveOwner)->identification_number ?? '';
        $ownerPhone = $firstParty['owner_phone'] ?? optional($liveOwner)->phone ?? '';

        $liveTenant = optional($contract->customer);
        $tenantNationality = optional($liveTenant->nationality)->name ?? '';
        
        $liveProperty = optional($contract->property);

        return [
            '${contract_number}' => $contract->id,
            '${conclusion_date}' => $contract->conclusion_date ? $contract->conclusion_date->format('d/m/Y') : '',
            '${start_date}' => $contract->start_date ? $contract->start_date->format('d/m/Y') : '',
            '${end_date}' => $contract->end_date ? $contract->end_date->format('d/m/Y') : '',
            '${contract_duration}' => $contract->duration_label,
            '${grace_period}' => $detail->grace_period ?? 'لا يوجد',
            '${deposit_amount}' => intval($contract->deposit_amount) . ' ' . __('general.qatari_riyal'),
            '${deposit_amount_ar}' => tafqeet(intval($contract->deposit_amount), __('general.qatari_riyal'), __('general.dirham')),
            '${rent_amount}' => intval($contract->rent_amount) . ' ' . __('general.qatari_riyal'),
            '${rent_amount_ar}' => tafqeet(intval($contract->rent_amount), __('general.qatari_riyal'), __('general.dirham')),
            '${first_party_name}' => $companyName,
            '${first_party_owner_name}' => $ownerName,
            '${first_party_owner_qid}' => $ownerQid,
            '${first_party_owner_phone}' => $ownerPhone,
            '${second_party_name}' => $secondParty['name']['ar'] ?? ($secondParty['name'] ?? optional($liveTenant)->name ?? ''),
            '${second_party_id}' => $secondParty['id_number'] ?? optional($liveTenant)->id_number ?? '',
            '${second_party_nationality}' => $tenantNationality,
            '${second_party_phone}' => $secondParty['phone'] ?? optional($liveTenant)->phone ?? '',
            '${second_party_company_name}' => $secondParty['company_name'] ?? optional($liveTenant)->company_name ?? '',
            '${second_party_cr_number}' => $secondParty['cr_number'] ?? optional($liveTenant)->cr_number ?? '',
            '${second_party_license_number}' => $secondParty['license_number'] ?? optional($liveTenant)->license_number ?? '',
            '${second_party_establishment_number}' => $secondParty['establishment_number'] ?? optional($liveTenant)->establishment_number ?? '',
            '${property_zone}' => $property['zone_number'] ?? '',
            '${property_street}' => $property['street_number'] ?? '',
            '${property_building}' => $property['building_number'] ?? '',
            '${property_deed}' => $property['title_deed_number'] ?? '',
            '${property_name_ar}' => $property['name_ar'] ?? $liveProperty->getTranslation('name', 'ar') ?? '',
            '${property_name_en}' => $property['name_en'] ?? $liveProperty->getTranslation('name', 'en') ?? '',
            '${property_type}' => $property['type'] ?? optional($liveProperty->propertyType)->name ?? '',
            '${property_floor}' => $property['floor'] ?? $liveProperty->floor ?? '',
            '${property_description}' => $property['description'] ?? $liveProperty->description ?? '',
            '${unit_rent_amount}' => (is_array($detail->utilities_data) && count($detail->utilities_data) > 0) ? ($detail->utilities_data[0]['unit_rent_amount'] ?? $contract->rent_amount) : $contract->rent_amount,
            '${unit_deposit_amount}' => (is_array($detail->utilities_data) && count($detail->utilities_data) > 0) ? ($detail->utilities_data[0]['unit_deposit_amount'] ?? $contract->deposit_amount) : $contract->deposit_amount,
        ];
    }

    // Helper to process contract clauses and convert them to RTL-compatible paragraphs in Word
    private function setClausesComplexBlock($template, $detail, $replacements)
    {
        $clauses = $detail->contract_clauses ?? [];
        
        if (is_array($clauses)) {
            $xmlWriter = new \PhpOffice\PhpWord\Shared\XMLWriter();
            
            foreach ($clauses as $clause) {
                $title = $clause['title'] ?? '';
                $content = $clause['content'] ?? '';
                
                $content = str_replace(array_keys($replacements), array_values($replacements), $content);
                
                if ($title) {
                    $textRun = new \PhpOffice\PhpWord\Element\TextRun();
                    $textRun->getParagraphStyle()->setBidi(true);
                    $textRun->getParagraphStyle()->setAlignment('both');
                    $textRun->addText($title . ':', ['rtl' => true, 'bidi' => true, 'bold' => true, 'size' => 12, 'name' => 'Arial']);
                    
                    $elementWriter = new \PhpOffice\PhpWord\Writer\Word2007\Element\TextRun($xmlWriter, $textRun, false);
                    $elementWriter->write();
                }
                
                if ($content) {
                    $lines = explode("\n", $content);
                    foreach ($lines as $lineIdx => $line) {
                        $line = trim($line);
                        if ($line !== '') {
                            $textRun = new \PhpOffice\PhpWord\Element\TextRun();
                            $textRun->getParagraphStyle()->setBidi(true);
                            $textRun->getParagraphStyle()->setAlignment('both');
                            $textRun->addText($line, ['rtl' => true, 'bidi' => true, 'size' => 11, 'name' => 'Arial']);
                            
                            $elementWriter = new \PhpOffice\PhpWord\Writer\Word2007\Element\TextRun($xmlWriter, $textRun, false);
                            $elementWriter->write();
                        }
                    }
                }
                
                // Add empty paragraph for spacing
                $emptyRun = new \PhpOffice\PhpWord\Element\TextRun();
                $emptyRun->getParagraphStyle()->setBidi(true);
                $emptyRun->getParagraphStyle()->setAlignment('both');
                $emptyRun->getParagraphStyle()->setSpaceAfter(\PhpOffice\PhpWord\Shared\Converter::pointToTwip(8));
                
                $emptyRunWriter = new \PhpOffice\PhpWord\Writer\Word2007\Element\TextRun($xmlWriter, $emptyRun, false);
                $emptyRunWriter->write();
            }
            
            $rawXml = $xmlWriter->getData();
            
            // Use reflection to call the protected replaceXmlBlock method to inject multiple paragraphs
            $reflection = new \ReflectionClass($template);
            $method = $reflection->getMethod('replaceXmlBlock');
            $method->setAccessible(true);
            $method->invokeArgs($template, ['${contract_clauses}', $rawXml, 'w:p']);
            
        } elseif (is_string($clauses)) {
            $textRun = new \PhpOffice\PhpWord\Element\TextRun();
            $textRun->getParagraphStyle()->setBidi(true);
            $textRun->getParagraphStyle()->setAlignment('both');
            $clausesHtml = str_replace(array_keys($replacements), array_values($replacements), $clauses);
            \PhpOffice\PhpWord\Shared\Html::addHtml($textRun, $clausesHtml, false, false);
            $template->setComplexBlock('contract_clauses', $textRun);
        }
    }

    // Helper to process legacy HTML text in clauses (for backward compatibility)
    private function getComplexHtmlValue($html, $fontSize = 11)
    {
        $textRun = new \PhpOffice\PhpWord\Element\TextRun();
        $textRun->getParagraphStyle()->setBidi(true);
        $textRun->getParagraphStyle()->setAlignment('right');
        $textRun->getParagraphStyle()->setIndentation(['right' => 0, 'left' => 0, 'firstLine' => 0]);

        if (!$html) {
            return $textRun;
        }

        $html = str_replace("\r", "", $html);
        $html = str_replace(['text-align: justify;', 'text-align:justify;'], '', $html);
        $html = str_replace(['<strong>', '</strong>'], ['<b>', '</b>'], $html);
        $html = str_replace(['<br>', '<br />', '<br/>', '<p>', '<div>', '<li>'], "\n", $html);
        $html = str_replace(['</p>', '</div>', '</li>', '<ul>', '</ul>', '<ol>', '</ol>'], "", $html);
        $html = preg_replace("/\n+/", "\n", $html);
        $html = trim($html, "\n");
        $html = strip_tags($html, '<b>');
        $html = html_entity_decode($html);
        $parts = preg_split('/(<b>.*?<\/b>|\n)/u', $html, -1, PREG_SPLIT_DELIM_CAPTURE);

        $first = true;
        foreach ($parts as $part) {
            if ($part === "") continue;

            if ($part === "\n") {
                if (!$first) {
                    $textRun->addTextBreak();
                }
                continue;
            }

            $isBold = false;
            $text = $part;

            if (preg_match('/<b>(.*?)<\/b>/u', $part, $matches)) {
                $isBold = true;
                $text = $matches[1];
            }

            if ($text !== '' || $text === "0") {
                $textRun->addText(htmlspecialchars($text), [
                    'rtl' => true,
                    'bidi' => true,
                    'name' => 'Calibri',
                    'size' => $fontSize,
                    'bold' => $isBold
                ]);
                $first = false;
            }
        }

        return $textRun;
    }
}
