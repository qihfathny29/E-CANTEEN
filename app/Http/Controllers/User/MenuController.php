<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        // Ambil semua menu yang tersedia saja
        $menus = Menu::where('stock', '>', 0)->get();

        return view('user.menus.index', compact('menus'));
    }
}