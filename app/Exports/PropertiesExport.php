<?php

namespace App\Exports;

use App\Models\Property;
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

class PropertiesExport implements WithHeadings, FromCollection, WithMapping, WithColumnWidths, ShouldAutoSize, WithStyles, WithEvents, WithColumnFormatting
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
            if ($column == 'owner') {
                return __('reports.owner');
            }
            return __('properties.' . $column);
        }, $this->columns);
    }

    public function collection()
    {
        return Property::with(['propertyType', 'propertyStatus', 'owners', 'creator'])
            ->when(!empty($this->filters['property_type_id']), function ($query) {
                $query->where('property_type_id', $this->filters['property_type_id']);
            })
            ->when(!empty($this->filters['property_status_id']), function ($query) {
                $query->where('property_status_id', $this->filters['property_status_id']);
            })
            ->when(!empty($this->filters['owner_id']), function ($query) {
                $query->whereHas('owners', function ($q) {
                    $q->where('owner_id', $this->filters['owner_id']);
                });
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
            } elseif ($column == 'name') {
                $items[] = $row->name;
            } elseif ($column == 'property_number') {
                $items[] = $row->property_number;
            } elseif ($column == 'property_type_id') {
                $items[] = $row->propertyType ? $row->propertyType->name : '';
            } elseif ($column == 'property_status_id') {
                $items[] = $row->propertyStatus ? $row->propertyStatus->name : '';
            } elseif ($column == 'area') {
                $items[] = $row->area;
            } elseif ($column == 'price') {
                $items[] = number_format($row->price, 2);
            } elseif ($column == 'location') {
                $items[] = $row->location;
            } elseif ($column == 'floor') {
                $items[] = $row->floor;
            } elseif ($column == 'title_deed_number') {
                $items[] = $row->title_deed_number;
            } elseif ($column == 'electricity_account_number') {
                $items[] = $row->electricity_account_number;
            } elseif ($column == 'water_account_number') {
                $items[] = $row->water_account_number;
            } elseif ($column == 'file_number') {
                $items[] = $row->file_number;
            } elseif ($column == 'description') {
                $items[] = $row->description;
            } elseif ($column == 'owner') {
                if ($row->owners->isNotEmpty()) {
                    // Extract names of all owners, or primary owner
                    $ownerNames = $row->owners->pluck('name')->implode(' - ');
                    $items[] = $ownerNames;
                } else {
                    $items[] = '';
                }
            } elseif ($column == 'created_at') {
                $items[] = $row->created_at ? $row->created_at->format('Y-m-d H:i') : '';
            } elseif ($column == 'created_by') {
                $items[] = $row->creator ? $row->creator->name : $row->created_by;
            } elseif ($column == 'rental_contract_original') {
                $items[] = $row->rental_contract_original ? __('general.yes') : __('general.no');
            } elseif ($column == 'building_completion_certificate') {
                $items[] = $row->building_completion_certificate ? __('general.yes') : __('general.no');
            } elseif ($column == 'other_documents') {
                $items[] = $row->other_documents ? __('general.yes') : __('general.no');
            } else {
                $items[] = '';
            }
        }

        return $items;
    }

    public function columnFormats(): array
    {
        $formats = [];
        $textFormatColumns = ['property_number', 'title_deed_number', 'electricity_account_number', 'water_account_number', 'file_number'];
        
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
