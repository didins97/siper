<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PrintingJob;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $completedJobs = PrintingJob::completed()->count();
        $totalJobs = PrintingJob::count();

        $totalMonthlyIncome = Order::completedLastMonth()->sum('total_amount');
        $totalItems = Product::isActive()->count();
        $totalUser = User::where('role', 'user')->count();
        $progressCompletedJobs = $totalJobs > 0 ? ($completedJobs / $totalJobs) * 100 : 0;

        return view('admin.index', compact('totalMonthlyIncome', 'totalUser', 'progressCompletedJobs', 'totalItems'));
    }

    public function operatorDashboard()
    {
        $jobs = new PrintingJob();
        $completedJobs = $jobs->completed()->count();
        $totalJobs = $jobs->count();

        $progressCompletedJobs = $totalJobs > 0 ? ($completedJobs / $totalJobs) * 100 : 0;

        return view('operator.index', compact('progressCompletedJobs'));
    }

    public function userDashboard()
    {
        $user = auth()->user();
        return view('user.index', compact('user'));
    }

    public function orderAreaChart()
    {
        $orders = Order::select(\DB::raw('MONTH(created_at) as month'), \DB::raw('SUM(total_amount) as total'))
            ->groupBy(\DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month');

        $orderChart = [];
        for ($month = 1; $month <= 12; $month++) {
            $orderChart[] = $orders->get($month, 0);
        }

        return response()->json($orderChart);
    }

    public function jobPieChart()
    {
        $jobs = new PrintingJob();

        $completedJobs = $jobs->status('completed')->count();
        $inProgressJobs = $jobs->status('processing')->count();
        $cancelledJobs = $jobs->status('cancelled')->count();
        $pendingJobs = $jobs->status('pending')->count();

        return response()->json([
            'completed' => $completedJobs,
            'inProgress' => $inProgressJobs,
            'cancelled' => $cancelledJobs,
            'pending' => $pendingJobs
        ]);
    }
}
