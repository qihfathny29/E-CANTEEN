<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->tanggal ?? now()->toDateString();

        $orders = Order::with(['user', 'orderItems.menu'])
                        ->whereDate('created_at', $tanggal)
                        ->where('status', 'selesai')
                        ->get();

        $totalPendapatan = $orders->sum('total_harga');

        $porsiPerMenu = OrderItem::with('menu')
                        ->whereHas('order', function($q) use ($tanggal) {
                            $q->whereDate('created_at', $tanggal)
                              ->where('status', 'selesai');
                        })
                        ->get()
                        ->groupBy('menu_id')
                        ->map(function($items) {
                            return [
                                'nama_menu'        => $items->first()->menu->nama_menu,
                                'total_porsi'      => $items->sum('jumlah'),
                                'total_pendapatan' => $items->sum('subtotal'),
                            ];
                        });

        return view('admin.laporan.index', compact('orders', 'totalPendapatan', 'porsiPerMenu', 'tanggal'));
    }

    public function export(Request $request): StreamedResponse
    {
        $tanggal = $request->tanggal ?? now()->toDateString();

        $orders = Order::with(['user', 'orderItems.menu'])
                        ->whereDate('created_at', $tanggal)
                        ->where('status', 'selesai')
                        ->get();

        $filename = "laporan-{$tanggal}.csv";

        return response()->streamDownload(function () use ($orders, $tanggal) {
            $out = fopen('php://output', 'w');

            // BOM agar Excel bisa baca UTF-8
            fwrite($out, "\xEF\xBB\xBF");

            fputcsv($out, ['Laporan Harian E-Canteen', $tanggal]);
            fputcsv($out, []);
            fputcsv($out, ['No', 'Nama Pemesan', 'Waktu Ambil', 'Item', 'Total', 'Metode Bayar', 'Waktu Pesan']);

            $no = 1;
            foreach ($orders as $order) {
                $items = $order->orderItems->map(fn($i) => $i->jumlah . 'x ' . $i->menu->nama_menu)->implode(', ');
                fputcsv($out, [
                    $no++,
                    $order->user->name,
                    $order->waktu_ambil === 'istirahat_1' ? 'Istirahat 1' : 'Istirahat 2',
                    $items,
                    $order->total_harga,
                    $order->metode_bayar ?? '-',
                    $order->created_at->format('H:i'),
                ]);
            }

            fputcsv($out, []);
            fputcsv($out, ['Total Pendapatan', '', '', '', $orders->sum('total_harga')]);
            fclose($out);
        }, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }

    public function exportPdf(Request $request)
    {
        $tanggal = $request->tanggal ?? now()->toDateString();

        $orders = Order::with(['user', 'orderItems.menu'])
                        ->whereDate('created_at', $tanggal)
                        ->where('status', 'selesai')
                        ->get();

        $totalPendapatan = $orders->sum('total_harga');

        $pdf = Pdf::loadView('admin.laporan.pdf', compact('orders', 'totalPendapatan', 'tanggal'))
                  ->setPaper('a4', 'landscape');

        return $pdf->download("laporan-{$tanggal}.pdf");
    }
}