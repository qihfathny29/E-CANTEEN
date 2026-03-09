<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Menu;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers    = User::count();
        $ordersToday   = Order::whereDate('created_at', today())->count();
        $activeMenus   = Menu::where('stock', '>', 0)->count();
        $revenueToday  = Order::whereDate('created_at', today())->where('status', 'selesai')->sum('total_harga');
        $pendingOrders = Order::whereIn('status', ['pending', 'sedang_disiapkan', 'siap_diambil'])->count();

        return view('admin.dashboard', compact('totalUsers', 'ordersToday', 'activeMenus', 'revenueToday', 'pendingOrders'));
    }
}
