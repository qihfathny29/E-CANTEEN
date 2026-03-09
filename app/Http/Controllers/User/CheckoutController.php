<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        // Pass menu data keyed by ID so JS dapat lookup foto & status
        $menus = Menu::where('stock', '>', 0)->get()->keyBy('id');
        $user  = auth()->user();
        return view('user.checkout.index', compact('menus', 'user'));
    }

    public function pay(Request $request)
    {
        $request->validate([
            'waktu_ambil'         => 'required|in:istirahat_1,istirahat_2',
            'metode_bayar'        => 'required|string',
            'items'               => 'required|array|min:1',
            'items.*.menu_id'     => 'required|exists:menus,id',
            'items.*.jumlah'      => 'required|integer|min:1',
            'items.*.catatan'     => 'nullable|string|max:255',
        ]);

        $biayaLayanan = 2000;
        $totalHarga   = 0;
        $itemsData    = [];

        foreach ($request->items as $item) {
            $menu = Menu::find($item['menu_id']);

            if ($menu->stock < $item['jumlah']) {
                $sisa = $menu->stock <= 0 ? 'sudah habis' : "sisa {$menu->stock}";
                return back()->with('error', "Stok {$menu->nama_menu} tidak cukup ({$sisa})!");
            }

            $subtotal    = $menu->harga * $item['jumlah'];
            $totalHarga += $subtotal;

            $itemsData[] = [
                'menu_id'      => $menu->id,
                'jumlah'       => $item['jumlah'],
                'harga_satuan' => $menu->harga,
                'subtotal'     => $subtotal,
                'catatan'      => $item['catatan'] ?? null,
            ];
        }

        $totalBayar = $totalHarga + $biayaLayanan;

        // Kalau saldo, cek kecukupan
        if ($request->metode_bayar === 'saldo' && auth()->user()->saldo < $totalBayar) {
            return back()->with('error', 'Saldo tidak cukup! Silakan top up terlebih dahulu.');
        }

        DB::transaction(function () use ($request, $itemsData, $totalBayar) {
            $order = Order::create([
                'user_id'      => auth()->id(),
                'waktu_ambil'  => $request->waktu_ambil,
                'status'       => 'pending',
                'total_harga'  => $totalBayar,
                'metode_bayar' => $request->metode_bayar,
            ]);

            foreach ($itemsData as $item) {
                $order->orderItems()->create($item);
                Menu::where('id', $item['menu_id'])->decrement('stock', $item['jumlah']);
            }

            // Potong saldo hanya untuk metode saldo
            if ($request->metode_bayar === 'saldo') {
                auth()->user()->decrement('saldo', $totalBayar);
            }
        });

        return redirect()->route('user.orders.index')
                         ->with('success', 'Pesanan berhasil dibuat! Silakan ambil saat jam istirahat.');
    }
}
