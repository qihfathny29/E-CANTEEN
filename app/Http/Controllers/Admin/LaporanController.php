<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Default tanggal hari ini, bisa difilter
        $tanggal = $request->tanggal ?? now()->toDateString();

        // Ambil semua order yang selesai pada tanggal tersebut
        $orders = Order::with(['user', 'orderItems.menu'])
                        ->whereDate('created_at', $tanggal)
                        ->where('status', 'selesai')
                        ->get();

        // Hitung total pendapatan
        $totalPendapatan = $orders->sum('total_harga');

        // Hitung total porsi per menu
        $porsiPerMenu = OrderItem::with('menu')
                        ->whereHas('order', function($q) use ($tanggal) {
                            $q->whereDate('created_at', $tanggal)
                              ->where('status', 'selesai');
                        })
                        ->get()
                        ->groupBy('menu_id')
                        ->map(function($items) {
                            return [
                                'nama_menu'      => $items->first()->menu->nama_menu,
                                'total_porsi'    => $items->sum('jumlah'),
                                'total_pendapatan' => $items->sum('subtotal'),
                            ];
                        });

        return view('admin.laporan.index', compact('orders', 'totalPendapatan', 'porsiPerMenu', 'tanggal'));
    }
}