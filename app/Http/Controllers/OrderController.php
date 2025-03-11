<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PrintingJob;
use Illuminate\Http\Request;
use App\Exports\OrdersExport;
use App\Notifications\OrderShippedNotification;
use App\Notifications\OrderStatusNotification;
use App\Notifications\OrderWhatshappNotfication;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = Order::with('product', 'user')->orderBy('created_at', 'desc');

        if ($user->isAdmin()) {
            $orders = $query->get();
            return view('admin.order.index', compact('orders'));
        }

        // user is not admin
        $orders = $query->where('user_id', $user->id)->get();
        return view('user.order.index', compact('orders'));
    }

    public function show($id, Request $request)
    {
        $user = $request->user();
        $query = Order::with('product', 'user');

        if ($user->isAdmin()) {
            $order = $query->where('id', $id)->first();
            return view('admin.order.show', compact('order'));
        }

        $order = $query->where('user_id', $user->id)->where('id', $id)->first();
        return view('user.order.show', compact('order'));
    }

    public function createOrder(Request $request, $id)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required',
        //     'phone' => 'required',
        //     'notes' => 'string',
        //     'size' => 'required',
        //     'price' => 'required',
        //     'qty' => 'required',
        //     'date_expected' => 'required',
        // ]);

        $data = $request->except('imageOption');

        if ($request->hasFile('path_file')) {
            $image = upload_file('app/public/images/orders', $request->file('path_file'));
            $data['path_file'] = $image;
        }

        $data['user_id'] = auth()->user()->id;
        $data['product_id'] = $id;
        $data['total_amount'] = $data['qty'] * $data['price'];
        $data['status'] = 'pending';
        $data['order_type'] = auth()->user()->role != 'user' ? 'offline' : 'online';

        // run notification
        // $request->user()->notify(new OrderWhatshappNotfication());

        $order = \App\Models\Order::create($data);

        $admin = \App\Models\User::where('role', 'admin')->get();
        foreach ($admin as $user) {
            $user->notify(new OrderShippedNotification($order));
        }

        if (auth()->user()->role == 'user') {
            return redirect()->route('user.orders.show', $order->id);
        } else {
            return redirect()->route('admin.orders.show', $order->id);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
            'expected_date' => 'required_if:status,inprogress',
            'priority' => 'required_if:status,inprogress',
        ]);

        $order = \App\Models\Order::find($id);
        $order->status = $request->status;
        $order->expected_date = $request->expected_date;
        $order->save();

        if ($request->status == 'inprogress') {
            PrintingJob::updateOrCreate(
                ['order_id' => $order->id],
                [
                    'priority' => $request->priority,
                    'status' => 'pending',
                    'order_id' => $order->id,
                    'start_date' => now(),

                ]
            );
        }

        $user = \App\Models\User::find($order->user_id);
        $user->notify(new OrderStatusNotification($order));

        return redirect()->back();
    }

    public function destroy($id)
    {
        $order = \App\Models\Order::find($id);
        $order->delete();

        return response()->json([
            'message' => 'Product deleted successfully',
            'success' => true
        ]);
    }

    public function cancel($id)
    {
        $order = \App\Models\Order::find($id);
        $order->status = 'cancelled';
        $order->save();

        $job = \App\Models\PrintingJob::where('order_id', $id)->first();
        if ($job) {
            $job->status = 'cancelled';
            $job->save();
        }

        return redirect()->back();
    }

    public function exportToPDF()
    {
        $orders = \App\Models\Order::all();

        return exportTo($orders, 'PDF', 'admin.order.pdf');
    }

    public function exportToExcel()
    {
        return exportTo(new OrdersExport, 'Excel', 'orders');
    }
}
