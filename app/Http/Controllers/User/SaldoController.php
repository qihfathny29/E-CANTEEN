<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SaldoController extends Controller
{
    // Halaman top up
    public function index()
    {
        return view('user.saldo.index');
    }

    // Proses top up
    public function topUp(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:10000|max:500000',
        ]);

        // Tambah saldo user
        auth()->user()->increment('saldo', $request->jumlah);

        return redirect()->route('user.saldo.index')
                         ->with('success', 'Top up Rp ' . number_format($request->jumlah, 0, ',', '.') . ' berhasil!');
    }
}