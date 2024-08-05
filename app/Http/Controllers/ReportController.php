<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Exports\ProductsExport;
use App\Exports\PrintingJobExport;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index() {
        return view('admin.laporan.index');
    }

    public function getReport(Request $request) {
        $request->validate([
            'reportType' => 'required|string',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2000|max:' . now()->year,
        ]);

        $reportType = $request->reportType;

        switch ($reportType) {
            case 'orders':
                $export = new OrdersExport($request->month, $request->year);
                break;
            case 'products':
                $export = new ProductsExport($request->month, $request->year);
                break;
            case 'tasks':
                $export = new PrintingJobExport($request->month, $request->year);
                break;
            default:
                $export = [];
                break;
        }

        return exportTo($export, 'Excel', $reportType . '-' . $request->month . '-' . $request->year);
    }
}
