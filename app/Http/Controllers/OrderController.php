<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PrintingJob;
use Illuminate\Http\Request;
use App\Exports\OrdersExport;
use App\Models\Product;
use App\Notifications\OrderShippedNotification;
use App\Notifications\OrderStatusNotification;
use App\Notifications\OrderWhatshappNotfication;
use Illuminate\Support\Carbon;

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
        // Ambil data request kecuali beberapa field custom
        $data = $request->except('imageOption', 'custom_size', 'custom_price');

        // dd($data);

        // $item = Product::find($id);

        // Upload file jika ada
        if ($request->hasFile('path_file')) {
            $data['path_file'] = upload_file('app/public/images/orders', $request->file('path_file'));
        }

        $user = auth()->user();

        // Tambahan field penting
        $data['user_id']     = $user->id;
        $data['product_id']  = $id;
        $data['size']        = isset($request->custom_size) ? $request->custom_size : $data['size'];
        $data['order_type']  = $user->role !== 'user' ? 'offline' : 'online';
        $data['status']      = 'pending';

        // Normalisasi nilai harga & total
        $price = (int) $data['price'] ?? 0;
        $qty   = (int) $data['qty'] ?? 1;

        // Hitung total_amount jika belum ada
        $data['total_amount'] = $data['total_amount'] ?? $price * $qty;

        // Isi price jika kosong, pakai total sebagai fallback
        // $data['price'] = $price > 0 ? $price : $data['total_amount'];

        // Simpan order
        $order = \App\Models\Order::create($data);

        // Kirim notifikasi ke admin
        $admins = \App\Models\User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new OrderShippedNotification($order));
        }

        // Redirect sesuai role
        $route = $user->role === 'user' ? 'user.orders.show' : 'admin.orders.show';
        return redirect()->route($route, $order->id);
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

        if (!$order) {
            return response()->json([
                'message' => 'Order tidak ditemukan.',
                'success' => false
            ], 404);
        }

        // Cek apakah sudah lebih dari 24 jam
        $createdAt = Carbon::parse($order->created_at);
        if (Carbon::now()->diffInHours($createdAt) > 24) {
            return response()->json([
                'message' => 'Order tidak dapat dibatalkan karena sudah lebih dari 24 jam.',
                'success' => false
            ]);
        }

        // Update status order
        $order->status = 'cancelled';
        $order->save();

        // Update status job jika ada
        $job = \App\Models\PrintingJob::where('order_id', $id)->first();
        if ($job) {
            $job->status = 'cancelled';
            $job->save();
        }

        return response()->json([
            'message' => 'Order berhasil dibatalkan.',
            'success' => true
        ]);
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

    public function uploadPayment(Request $request, $id)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $order = \App\Models\Order::find($id);

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('payments', 'public');
            $order->update([
                'payment_proof' => $path,
                'status' => 'pending' // Change status to pending verification
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Bukti pembayaran berhasil diupload'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal mengupload bukti pembayaran'
        ], 400);
    }
}
