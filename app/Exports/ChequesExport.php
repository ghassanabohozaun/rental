<?php

namespace App\Exports;

use App\Models\Cheque;
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
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class ChequesExport extends DefaultValueBinder implements WithHeadings, FromCollection, WithMapping, WithColumnWidths, ShouldAutoSize, WithStyles, WithEvents, WithColumnFormatting, WithCustomValueBinder
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

        return Cheque::with(['customer', 'contract.property', 'companyBankAccount', 'creator'])
            // Company isolation
            ->when(user()->company_id != 1, function ($query) {
                $query->where('company_id', user()->company_id);
            })
            ->when(user()->company_id == 1 && !empty($this->filters['company_id']), function ($query) {
                $query->where('company_id', $this->filters['company_id']);
            })
            // Customer multi-select
            ->when(!empty($this->filters['customer_id']), function ($query) {
                $query->whereIn('customer_id', $this->filters['customer_id']);
            })
            // Cheque type filter
            ->when(isset($this->filters['cheque_type']) && $this->filters['cheque_type'] !== '', function ($query) {
                $isDeposit = $this->filters['cheque_type'] === 'insurance';
                $query->where('is_deposit', $isDeposit);
            })
            // Status multi-select
            ->when(!empty($this->filters['status']), function ($query) {
                $query->whereIn('status', $this->filters['status']);
            })
            // Company bank account filter
            ->when(!empty($this->filters['company_bank_account_id']), function ($query) {
                $query->where('company_bank_account_id', $this->filters['company_bank_account_id']);
            })
            // Due date range
            ->when(!empty($this->filters['due_date_from']), function ($query) {
                $query->whereDate('due_date', '>=', $this->filters['due_date_from']);
            })
            ->when(!empty($this->filters['due_date_to']), function ($query) {
                $query->whereDate('due_date', '<=', $this->filters['due_date_to']);
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
        $optionalLabel = __('general.optional');

        foreach ($this->columns as $column) {
            $val = null;
            if ($column == 'id') {
                $val = ++$this->index;
            } elseif ($column == 'cheque_number') {
                $val = $row->cheque_number;
            } elseif ($column == 'amount') {
                $val = number_format($row->amount, 2);
            } elseif ($column == 'used_amount') {
                $val = number_format($row->used_amount, 2);
            } elseif ($column == 'remaining_amount') {
                $val = number_format($row->remaining_amount, 2);
            } elseif ($column == 'bank_name') {
                $val = $row->bank_name ? ($row->getTranslation('bank_name', $locale) ?: $row->bank_name) : null;
            } elseif ($column == 'cheque_owner_name') {
                $val = $row->cheque_owner_name ? ($row->getTranslation('cheque_owner_name', $locale) ?: $row->cheque_owner_name) : null;
            } elseif ($column == 'issue_date') {
                $val = $row->issue_date ? $row->issue_date->format('Y-m-d') : null;
            } elseif ($column == 'due_date') {
                $val = $row->due_date ? $row->due_date->format('Y-m-d') : null;
            } elseif ($column == 'status') {
                $val = $row->status_label;
            } elseif ($column == 'is_deposit') {
                $val = $row->is_deposit ? __('reports.insurance_cheque') : __('reports.rent_cheque');
            } elseif ($column == 'notes') {
                $val = $row->notes ? ($row->getTranslation('notes', $locale) ?: $row->notes) : null;
            } elseif ($column == 'created_at') {
                $val = $row->created_at ? $row->created_at->format('Y-m-d H:i') : null;
            } elseif ($column == 'contract_number') {
                $val = $row->contract_id ?: null;
            } elseif ($column == 'customer_name') {
                $val = $row->customer ? ($row->customer->getTranslation('name', $locale) ?: $row->customer->name) : null;
            } elseif ($column == 'property_name') {
                $val = ($row->contract && $row->contract->property) 
                    ? ($row->contract->property->getTranslation('name', $locale) ?: $row->contract->property->name) 
                    : null;
            } elseif ($column == 'contract_start_date') {
                $val = ($row->contract && $row->contract->start_date) ? $row->contract->start_date->format('Y-m-d') : null;
            } elseif ($column == 'contract_end_date') {
                $val = ($row->contract && $row->contract->end_date) ? $row->contract->end_date->format('Y-m-d') : null;
            } elseif ($column == 'deposited_bank_name') {
                $val = $row->companyBankAccount 
                    ? ($row->companyBankAccount->getTranslation('bank_name', $locale) ?: $row->companyBankAccount->bank_name) 
                    : null;
            } elseif ($column == 'account_number') {
                $val = $row->companyBankAccount ? $row->companyBankAccount->account_number : null;
            } elseif ($column == 'iban') {
                $val = $row->companyBankAccount ? $row->companyBankAccount->iban : null;
            }

            if ($val === null || $val === '') {
                $val = $optionalLabel;
            }

            $items[] = $val;
        }

        return $items;
    }

    public function columnFormats(): array
    {
        $formats = [];
        $textFormatColumns = ['cheque_number', 'contract_number', 'account_number', 'iban'];
        
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

    public function bindValue(Cell $cell, $value)
    {
        // Force account_number, cheque_number, iban (large numeric/alphanumeric strings) to be treated explicitly as strings
        // This prevents Excel from converting them to scientific notation (e.g. 4.80003E+12) or stripping leading zeros
        if (is_numeric($value) && strlen((string)$value) > 8 && strpos((string)$value, '.') === false) {
            $cell->setValueExplicit((string)$value, DataType::TYPE_STRING);
            return true;
        }

        return parent::bindValue($cell, $value);
    }
}
