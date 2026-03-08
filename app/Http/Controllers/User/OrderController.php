<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Halaman form pre-order
    public function create()
    {
        $menus = Menu::where('status', 'tersedia')->get();
        return view('user.orders.create', compact('menus'));
    }

    // Proses pre-order
    public function store(Request $request)
    {
        $request->validate([
            'waktu_ambil' => 'required|in:istirahat_1,istirahat_2',
            'items'       => 'required|array|min:1',
            'items.*.menu_id' => 'required|exists:menus,id',
            'items.*.jumlah'  => 'required|integer|min:1',
        ]);

        // Hitung total harga dulu
        $totalHarga = 0;
        $itemsData = [];

        foreach ($request->items as $item) {
            // Skip kalau jumlahnya 0
            if ($item['jumlah'] <= 0) continue;

            $menu = Menu::find($item['menu_id']);

            // Cek lagi statusnya, bisa aja habis pas lagi checkout
            if ($menu->status === 'habis') {
                return back()->with('error', "Menu {$menu->nama_menu} sudah habis!");
            }

            $subtotal = $menu->harga * $item['jumlah'];
            $totalHarga += $subtotal;

            $itemsData[] = [
                'menu_id'      => $menu->id,
                'jumlah'       => $item['jumlah'],
                'harga_satuan' => $menu->harga,
                'subtotal'     => $subtotal,
            ];
        }

        // Cek saldo user cukup atau tidak
        if (auth()->user()->saldo < $totalHarga) {
            return back()->with('error', 'Saldo tidak cukup! Silakan top up terlebih dahulu.');
        }

        // Kalau ga ada item yang dipilih
        if (empty($itemsData)) {
            return back()->with('error', 'Pilih minimal 1 menu!');
        }

        // Pakai DB transaction biar aman
        // Kalau salah satu gagal, semua dibatalin
        DB::transaction(function () use ($request, $itemsData, $totalHarga) {
            // Buat order
            $order = Order::create([
                'user_id'     => auth()->id(),
                'waktu_ambil' => $request->waktu_ambil,
                'status'      => 'pending',
                'total_harga' => $totalHarga,
            ]);

            // Buat order items
            foreach ($itemsData as $item) {
                $order->orderItems()->create($item);
            }

            // Potong saldo user
            auth()->user()->decrement('saldo', $totalHarga);
        });

        return redirect()->route('user.orders.index')
                         ->with('success', 'Pesanan berhasil dibuat!');
    }

    // Riwayat pesanan
    public function index()
    {
        $orders = Order::with('orderItems.menu')
                        ->where('user_id', auth()->id())
                        ->latest()
                        ->get();

        return view('user.orders.index', compact('orders'));
    }
}