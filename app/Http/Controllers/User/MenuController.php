<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('user.menus.index', compact('menus'));
    }

    public function show(Menu $menu)
    {
        return view('user.menus.show', compact('menu'));
    }
}