<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PaymentsExport implements WithHeadings, FromCollection, WithMapping, WithColumnWidths, ShouldAutoSize, WithStyles, WithEvents, WithColumnFormatting
{
    use RegistersEventListeners;

    protected $columns;
    public $filters;
    protected $index;

    public function __construct(array $columns, $filters)
    {
        $this->columns = $columns;
        $this->filters = $filters;
        $this->index = 0;
    }

    public function headings(): array
    {
        return array_map(function ($column) {
            return __('reports.' . $column);
        }, $this->columns);
    }

    public function collection()
    {
        $locale = app()->getLocale();

        return Payment::with(['contract.property', 'contract.customer', 'cheque', 'companyBankAccount'])
            // Company isolation
            ->when(user()->company_id != 1, function ($query) {
                $query->whereHas('contract', function($q) {
                    $q->where('company_id', user()->company_id);
                });
            })
            ->when(user()->company_id == 1 && !empty($this->filters['company_id']), function ($query) {
                $query->whereHas('contract', function($q) {
                    $q->where('company_id', $this->filters['company_id']);
                });
            })
            // Customer multi-select
            ->when(!empty($this->filters['customer_id']), function ($query) {
                $query->whereHas('contract', function($q) {
                    $q->whereIn('customer_id', $this->filters['customer_id']);
                });
            })
            // Payment method single-select
            ->when(!empty($this->filters['method']), function ($query) {
                $query->where('method', $this->filters['method']);
                // Bank Account filter only applies if method is bank or online
                if (($this->filters['method'] === 'bank' || $this->filters['method'] === 'online') && !empty($this->filters['company_bank_account_id'])) {
                    $query->where('company_bank_account_id', $this->filters['company_bank_account_id']);
                }
            })
            // Status multi-select
            ->when(!empty($this->filters['status']), function ($query) {
                $query->whereIn('status', $this->filters['status']);
            })
            // Payment date range
            ->when(!empty($this->filters['payment_date_from']), function ($query) {
                $query->whereDate('payment_date', '>=', $this->filters['payment_date_from']);
            })
            ->when(!empty($this->filters['payment_date_to']), function ($query) {
                $query->whereDate('payment_date', '<=', $this->filters['payment_date_to']);
            })
            // Amount range
            ->when(!empty($this->filters['amount_from']), function ($query) {
                $query->where('amount', '>=', $this->filters['amount_from']);
            })
            ->when(!empty($this->filters['amount_to']), function ($query) {
                $query->where('amount', '<=', $this->filters['amount_to']);
            })
            ->latest()
            ->get();
    }

    public function map($row): array
    {
        $items = [];
        $locale = app()->getLocale();

        foreach ($this->columns as $column) {
            $val = null;
            if ($column == 'id') {
                $val = ++$this->index;
            } elseif ($column == 'payment_date') {
                $val = $row->payment_date ? $row->payment_date->format('Y-m-d') : null;
            } elseif ($column == 'amount') {
                $val = number_format($row->amount, 2);
            } elseif ($column == 'method') {
                $val = __('payments.methods.' . $row->method);
            } elseif ($column == 'company_bank_name') {
                $val = $row->companyBankAccount ? ($row->companyBankAccount->getTranslation('bank_name', $locale) ?: $row->companyBankAccount->bank_name) : null;
            } elseif ($column == 'company_account_number') {
                $val = $row->companyBankAccount ? $row->companyBankAccount->account_number : null;
            } elseif ($column == 'company_account_holder_name') {
                $val = $row->companyBankAccount ? ($row->companyBankAccount->getTranslation('account_holder_name', $locale) ?: $row->companyBankAccount->account_holder_name) : null;
            } elseif ($column == 'company_iban') {
                $val = $row->companyBankAccount ? $row->companyBankAccount->iban : null;
            } elseif ($column == 'reference_number') {
                $val = $row->reference_number;
            } elseif ($column == 'status') {
                $val = __('payments.statuses.' . $row->status);
            } elseif ($column == 'notes') {
                $val = $row->notes;
            } elseif ($column == 'created_at') {
                $val = $row->created_at ? $row->created_at->format('Y-m-d H:i') : null;
            } elseif ($column == 'contract_number') {
                $val = $row->contract_id ?: null;
            } elseif ($column == 'customer_name') {
                $val = ($row->contract && $row->contract->customer) 
                    ? ($row->contract->customer->getTranslation('name', $locale) ?: $row->contract->customer->name) 
                    : null;
            } elseif ($column == 'property_name') {
                $val = ($row->contract && $row->contract->property) 
                    ? ($row->contract->property->getTranslation('name', $locale) ?: $row->contract->property->name) 
                    : null;
            } elseif ($column == 'cheque_number') {
                $val = $row->cheque ? $row->cheque->cheque_number : null;
            } elseif ($column == 'bank_name') {
                $val = $row->cheque && $row->cheque->bank_name ? ($row->cheque->getTranslation('bank_name', $locale) ?: $row->cheque->bank_name) : null;
            }

            if ($val === null || $val === '') {
                $val = '-';
            }

            $items[] = $val;
        }

        return $items;
    }

    public function columnFormats(): array
    {
        $formats = [];
        $textFormatColumns = ['contract_number', 'reference_number', 'cheque_number', 'company_account_number', 'company_iban'];
        
        foreach ($this->columns as $index => $column) {
            if (in_array($column, $textFormatColumns)) {
                $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($index + 1);
                $formats[$columnLetter] = \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT;
            }
        }
        
        return $formats;
    }

    public function columnWidths(): array
    {
        return [];
    }

    public function styles(Worksheet $sheet)
    {
        $lastColumn = $sheet->getHighestColumn();
        $lastRow = $sheet->getHighestRow();

        // 1. Header Styling (Row 1) - Navy Blue / Indigo with White Text
        $sheet->getStyle('A1:' . $lastColumn . '1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 12,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4B49AC'], // Modern Indigo
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        // 2. Global Alignment & Wrap Text
        $sheet->getStyle('A1:' . $lastColumn . $lastRow)->applyFromArray([
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'wrapText' => true,
            ],
        ]);

        // 3. Professional Borders
        $sheet->getStyle('A1:' . $lastColumn . $lastRow)->getBorders()->getAllBorders()->applyFromArray([
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['rgb' => 'D1D5DB'],
        ]);

        $sheet->getRowDimension('1')->setRowHeight(35); // Taller header row
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $lastColumn = $sheet->getHighestColumn();
                $lastRow = $sheet->getHighestRow();

                // 1. RTL/LTR Handling
                $direction = Lang() == 'ar' ? true : false;
                $sheet->setRightToLeft($direction);

                // 2. Zebra Striping (Alternate Row Colors)
                for ($row = 2; $row <= $lastRow; $row++) {
                    if ($row % 2 == 0) {
                        $sheet->getStyle('A' . $row . ':' . $lastColumn . $row)->getFill()->applyFromArray([
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'startColor' => ['rgb' => 'F8F9FA'],
                        ]);
                    }
                }
            },
        ];
    }
}
