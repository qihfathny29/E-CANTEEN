<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    // Tampilkan semua menu
    public function index()
    {
        $menus = Menu::latest()->paginate(10);
        return view('admin.menus.index', compact('menus'));
    }

    // Tampilkan form tambah menu
    public function create()
    {
        return view('admin.menus.create');
    }

    // Simpan menu baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'harga'     => 'required|numeric|min:0',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status'    => 'required|in:tersedia,habis',
        ]);

        // Handle upload foto
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            // Simpan foto ke folder storage/app/public/menus
            $fotoPath = $request->file('foto')->store('menus', 'public');
        }

        Menu::create([
            'nama_menu' => $request->nama_menu,
            'harga'     => $request->harga,
            'foto'      => $fotoPath,
            'status'    => $request->status,
        ]);

        return redirect()->route('admin.menus.index')
                         ->with('success', 'Menu berhasil ditambahkan!');
    }

    // Tampilkan form edit
    public function edit(Menu $menu)
    {
        // Laravel otomatis cari menu by ID (Route Model Binding)
        return view('admin.menus.edit', compact('menu'));
    }

    // Update menu
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'harga'     => 'required|numeric|min:0',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status'    => 'required|in:tersedia,habis',
        ]);

        $fotoPath = $menu->foto; // default pakai foto lama

        if ($request->hasFile('foto')) {
            // Hapus foto lama kalau ada
            if ($menu->foto) {
                Storage::disk('public')->delete($menu->foto);
            }
            // Simpan foto baru
            $fotoPath = $request->file('foto')->store('menus', 'public');
        }

        $menu->update([
            'nama_menu' => $request->nama_menu,
            'harga'     => $request->harga,
            'foto'      => $fotoPath,
            'status'    => $request->status,
        ]);

        return redirect()->route('admin.menus.index')
                         ->with('success', 'Menu berhasil diupdate!');
    }

    // Hapus menu
    public function destroy(Menu $menu)
    {
        // Hapus foto dari storage kalau ada
        if ($menu->foto) {
            Storage::disk('public')->delete($menu->foto);
        }

        $menu->delete();

        return redirect()->route('admin.menus.index')
                         ->with('success', 'Menu berhasil dihapus!');
    }
}