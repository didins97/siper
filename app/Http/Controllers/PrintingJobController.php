<?php

namespace App\Http\Controllers;

use App\Exports\PrintingJobExport;
use App\Models\PrintingJob;
use Illuminate\Http\Request;

class PrintingJobController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->isAdmin()) {
            $jobs = PrintingJob::with('order')->get();
            return view('admin.job.index', compact('jobs'));
        }

        $pendingJobs = PrintingJob::where('status', 'pending')->get();
        $inProgressJobs = PrintingJob::where('status', 'processing')->get();
        $completedJobs = PrintingJob::where('status', 'completed')->get();

        return view('operator.job.index', compact('pendingJobs', 'inProgressJobs', 'completedJobs'));
    }

    public function updateStatus(Request $request, $id)
    {
        $job = PrintingJob::find($id);
        $job->status = $request->status;
        $job->save();

        return response()->json([
            'message' => 'Status updated successfully',
            'success' => true
        ]);
    }

    public function show($id)
    {
        $job = PrintingJob::with('order')->where('id', $id)->first();
        return response()->json($job);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
            'start_date' => 'required',
            'end_date' => 'required_if:status,completed',
        ]);

        $data = $request->all();

        if ($data['status'] != 'completed') {
            $data['end_date'] = null;
        }

        $job = PrintingJob::findOrFail($id);
        $job->update($data);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $job = PrintingJob::findOrFail($id);

        // Update the order status to 'pending'
        $order = $job->order;
        $order->status = 'pending';
        $order->save();

        // Delete the job
        $job->delete();

        return response()->json([
            'message' => 'Job deleted successfully',
            'success' => true
        ]);
    }

    public function exportToPDF()
    {
        $data = PrintingJob::with('order')->get();

        return exportTo($data, 'PDF', 'admin.job.pdf');
    }

    public function exportToExcel()
    {
        return exportTo(new PrintingJobExport(), 'Excel', 'job');
    }
}
