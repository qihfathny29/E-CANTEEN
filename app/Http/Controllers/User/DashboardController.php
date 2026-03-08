<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $activeOrders = Order::where('user_id', auth()->id())
            ->whereIn('status', ['pending', 'sedang_disiapkan', 'siap_diambil'])
            ->count();

        $totalOrders = Order::where('user_id', auth()->id())->count();

        return view('user.dashboard', compact('activeOrders', 'totalOrders'));
    }
}
