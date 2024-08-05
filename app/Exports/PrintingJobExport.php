<?php

namespace App\Exports;

use App\Models\PrintingJob;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PrintingJobExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle, WithCustomStartCell
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
            return PrintingJob::whereMonth('created_at', $this->month)->whereYear('created_at', $this->year)->get();
        } else {
            return PrintingJob::all();
        }
    }

    public function headings(): array
    {
        return [
            'No. Order',
            'Tgl. Mulai',
            'Tgl. Selesai',
            'Prioritas',
            'Status'
        ];
    }

    public function map($printingJob): array
    {
        return [
            $printingJob->order->order_number,
            \Carbon\Carbon::parse($printingJob->start_date)->format('d F Y'),
            \Carbon\Carbon::parse($printingJob->end_date)->format('d F Y'),
            $printingJob->priority,
            $printingJob->status
        ];
    }

    public function styles(Worksheet $sheet) {
        $sheet->getStyle('A3:E3')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        $sheet->getStyle('A3:E' . ($sheet->getHighestRow()))
              ->applyFromArray([
                  'borders' => [
                      'allBorders' => [
                          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                      ],
                  ],
              ]);

        $sheet->mergeCells('A1:H1');
        $sheet->setCellValue('A1', 'Punggawa Digital Printing Daftar Pemesanan');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 16,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        return [];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Daftar Printing Job';
    }

    /**
     * @return string
     */
    public function startCell(): string
    {
        return 'A3';
    }
}
