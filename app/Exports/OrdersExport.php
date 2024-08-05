<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrdersExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle, WithCustomStartCell
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
        // return Order::all();
        if($this->month && $this->year) {
            return Order::whereMonth('created_at', $this->month)->whereYear('created_at', $this->year)->get();
        } else {
            return Order::all();
        }
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No Order',
            'Tgl. Order',
            'Nama Pemesan',
            'Jenis Item',
            'Harga Satuan',
            'Ukuran',
            'Jumlah',
            'Total Harga',
        ];
    }

    /**
     * @param $order
     * @return array
     */
    public function map($order): array
    {
        $formatter = new \NumberFormatter('id_ID', \NumberFormatter::CURRENCY);

        return [
            $order->order_number,
            \Carbon\Carbon::parse($order->created_at)->format('d F Y'),
            $order->name,
            $order->product->name,
            $formatter->formatCurrency($order->price, 'IDR'),
            $order->size,
            $order->qty,
            $formatter->formatCurrency($order->price, 'IDR'),
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A3:H3')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        $sheet->getStyle('A3:H' . ($sheet->getHighestRow()))
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
        return 'Daftar Pemesanan';
    }

    /**
     * @return string
     */
    public function startCell(): string
    {
        return 'A3';
    }
}
