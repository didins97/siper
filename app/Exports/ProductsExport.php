<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ProductsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnFormatting, WithTitle, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $month, $year;

    public function __construct($month = null, $year = null)
    {
        $this->month = $month;
        $this->year = $year;
    }
    public function collection()
    {
        // return Product::all();
        if ($this->month && $this->year) {
            return Product::whereMonth('created_at', $this->month)->whereYear('created_at', $this->year)->get();
        } else {
            return Product::all();
        }
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Deskripsi',
            'Ukuran',
            'Harga',
            'Aktif',
            'Dibuat Pada'
        ];
    }

    /**
     * @param mixed $product
     *
     * @return array
     */
    public function map($product): array
    {
        return [
            $product->id,
            $product->name,
            $product->desc,
            implode(", ", json_decode($product->sizes)),
            implode(", ", json_decode($product->prices)),
            $product->is_active ? 'Ya' : 'Tidak',
            \Carbon\Carbon::parse($product->created_at)->format('d F Y')
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            // All rows
            'A' => ['alignment' => ['horizontal' => 'center']],
            'B' => ['alignment' => ['horizontal' => 'left']],
            'C' => ['alignment' => ['horizontal' => 'left']],
            'D' => ['alignment' => ['horizontal' => 'left']],
            'E' => ['alignment' => ['horizontal' => 'left']],
            'F' => ['alignment' => ['horizontal' => 'center']],
            'G' => ['alignment' => ['horizontal' => 'center']],
            'A1:G1' => ['borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['argb' => '000000'],
                ],
            ]],
        ];
    }

    /**
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'G' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Daftar Items';
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $sheet->mergeCells('A1:G1');
                $sheet->setCellValue('A1', 'Punggawa Digital Printing Daftar Items');
                $sheet->getStyle('A1')->getFont()->setBold(true);
                $sheet->getStyle('A1')->getFont()->setSize(14);
                $sheet->getStyle('A2:G2')->getFont()->setBold(true);
                $sheet->getStyle('A2:G2')->getAlignment()->setHorizontal('center');

                $lastRow = $sheet->getHighestRow();
                $sheet->getStyle("A2:G$lastRow")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);
            },
        ];
    }
}

