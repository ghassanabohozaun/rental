<?php

namespace App\Exports;

use App\Models\Employee;
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

class EmployeesExport implements WithHeadings, FromCollection, WithMapping, WithColumnWidths, ShouldAutoSize, WithStyles, WithEvents, WithColumnFormatting
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
            return __('employees.' . $column);
        }, $this->columns);
    }

    public function collection()
    {
        return Employee::with(['governorate', 'city', 'employeeJobDetails.department', 'employeeJobDetails.employeeStatus'])
            ->when(!empty($this->filters['gender']), function ($query) {
                $query->where('gender', $this->filters['gender']);
            })
            ->when(!empty($this->filters['marital_status']), function ($query) {
                $query->where('marital_status', $this->filters['marital_status']);
            })
            ->when(!empty($this->filters['city_id']), function ($query) {
                $query->where('city_id', $this->filters['city_id']);
            })
            ->when(!empty($this->filters['governoate_id']), function ($query) {
                $query->where('governoate_id', $this->filters['governoate_id']);
            })
            ->when(!empty($this->filters['department_id']), function ($query) {
                $query->whereHas('employeeJobDetails', function ($q) {
                    $q->where('department_id', $this->filters['department_id']);
                });
            })
            ->when(!empty($this->filters['employee_status_id']), function ($query) {
                $query->whereHas('employeeJobDetails', function ($q) {
                    $q->where('employee_status_id', $this->filters['employee_status_id']);
                });
            })
            ->when(!empty($this->filters['employee_ids']), function ($query) {
                $query->whereIn('id', $this->filters['employee_ids']);
            })
            ->latest()
            ->get();
    }

    public function map($row): array
    {
        $items = [];

        foreach ($this->columns as $column) {
            if ($column == 'id') {
                $items[] = ++$this->index;
            } elseif ($column == 'full_name') {
                $items[] = $row->EmployeeFullName();
            } elseif ($column == 'first_name') {
                $items[] = $row->first_name;
            } elseif ($column == 'father_name') {
                $items[] = $row->father_name;
            } elseif ($column == 'grand_father_name') {
                $items[] = $row->grand_father_name;
            } elseif ($column == 'family_name') {
                $items[] = $row->family_name;
            } elseif ($column == 'personal_id') {
                $items[] = $row->personal_id;
            } elseif ($column == 'gender') {
                $items[] = $row->EmployeeGender();
            } elseif ($column == 'birthday') {
                $items[] = $row->birthday;
            } elseif ($column == 'marital_status') {
                $items[] = $row->marital_status ? __('employees.' . $row->marital_status) : '';
            } elseif ($column == 'mobile_no') {
                $items[] = $row->mobile_no;
            } elseif ($column == 'alternative_mobile_no') {
                $items[] = $row->alternative_mobile_no;
            } elseif ($column == 'email') {
                $items[] = $row->email;
            } elseif ($column == 'governoate_id') {
                $items[] = $row->governorate ? $row->governorate->name : '';
            } elseif ($column == 'city_id') {
                $items[] = $row->city ? $row->city->name : '';
            } elseif ($column == 'address_details') {
                $items[] = $row->address_details;
            } elseif ($column == 'bank_name') {
                $items[] = $row->bank_name;
            } elseif ($column == 'iban') {
                $items[] = $row->iban;
            } elseif ($column == 'banck_account') {
                $items[] = $row->banck_account;
            } elseif ($column == 'basic_salary') {
                $items[] = $row->basic_salary;
            } elseif ($column == 'currency') {
                $items[] = $row->currency;
            } elseif (in_array($column, ['title', 'department_id', 'employee_status_id', 'appointment_date'])) {
                if ($row->employeeJobDetails) {
                    if ($column == 'title') {
                        $items[] = $row->employeeJobDetails->title ?? '';
                    } elseif ($column == 'department_id') {
                        $items[] = $row->employeeJobDetails->department->name ?? '';
                    } elseif ($column == 'employee_status_id') {
                        $items[] = $row->employeeJobDetails->employeeStatus->name ?? '';
                    } elseif ($column == 'appointment_date') {
                        $items[] = $row->employeeJobDetails->appointment_date ?? '';
                    }
                } else {
                    $items[] = '';
                }
            } else {
                $items[] = '';
            }
        }

        return $items;
    }

    public function columnFormats(): array
    {
        $formats = [];
        $textFormatColumns = ['personal_id', 'mobile_no', 'alternative_mobile_no', 'banck_account', 'iban'];
        
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
