<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Halaman form pre-order
    public function create()
    {
        $menus = Menu::where('stock', '>', 0)->get();
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

            // Cek lagi stoknya, bisa aja habis pas lagi checkout
            if ($menu->stock <= 0) {
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
        $activeOrders = Order::with('orderItems.menu')
                        ->where('user_id', auth()->id())
                        ->whereIn('status', ['pending', 'sedang_disiapkan', 'siap_diambil'])
                        ->latest()
                        ->get();

        $doneOrders = Order::with('orderItems.menu')
                        ->where('user_id', auth()->id())
                        ->where('status', 'selesai')
                        ->latest()
                        ->get();

        return view('user.orders.index', compact('activeOrders', 'doneOrders'));
    }

    // Konfirmasi user sudah mengambil pesanan
    public function confirmPickup(Order $order)
    {
        abort_if($order->user_id !== auth()->id(), 403);
        abort_if($order->status !== 'siap_diambil', 403);

        $order->update(['status' => 'selesai']);

        Notification::create([
            'user_id'  => $order->user_id,
            'order_id' => $order->id,
            'title'    => 'Pesanan Selesai ✅',
            'message'  => 'Terima kasih sudah memesan! Sampai jumpa lagi 😊',
            'is_read'  => false,
        ]);

        return redirect()->route('user.orders.index')
                         ->with('success', 'Pesanan selesai! Terima kasih 😊');
    }

    public function struk(Order $order)
    {
        abort_if($order->user_id !== auth()->id(), 403);
        abort_if($order->status !== 'selesai', 404);

        return view('user.orders.struk', compact('order'));
    }
}