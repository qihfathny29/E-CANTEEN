<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AntreanController extends Controller
{
    // Tampilkan semua pesanan
    public function index()
    {
        $orders = Order::with(['user', 'orderItems.menu'])
                        ->whereIn('status', ['pending', 'sedang_disiapkan', 'siap_diambil'])
                        ->latest()
                        ->get();

        return view('admin.antrean.index', compact('orders'));
    }

    // Update status pesanan
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,sedang_disiapkan,siap_diambil,selesai'
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->route('admin.antrean.index')
                         ->with('success', 'Status pesanan berhasil diupdate!');
    }
}