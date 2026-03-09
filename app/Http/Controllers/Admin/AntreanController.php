<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
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
            'status' => 'required|in:pending,sedang_disiapkan,siap_diambil'
        ]);

        $order->update(['status' => $request->status]);

        $messages = [
            'pending'          => ['Pesanan Diterima',    'Pesananmu sedang menunggu konfirmasi dari kantin.'],
            'sedang_disiapkan' => ['Pesanan Diproses',    'Pesananmu sedang disiapkan! Harap tunggu ya 🍳'],
            'siap_diambil'     => ['Pesanan Siap!',       'Pesananmu sudah siap diambil di kantin 🎉'],
            'selesai'          => ['Pesanan Selesai ✅',  'Terima kasih sudah memesan! Sampai jumpa lagi 😊'],
        ];

        if (isset($messages[$request->status])) {
            [$title, $message] = $messages[$request->status];
            Notification::create([
                'user_id'  => $order->user_id,
                'order_id' => $order->id,
                'title'    => $title,
                'message'  => $message,
                'is_read'  => false,
            ]);
        }

        return redirect()->route('admin.antrean.index')
                         ->with('success', 'Status pesanan berhasil diupdate!');
    }
}