<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TopupLog;
use App\Models\User;
use Illuminate\Http\Request;

class SaldoController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'user');

        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%");
            });
        }

        $users = $query->orderBy('name')->paginate(15)->withQueryString();

        $logs = TopupLog::with(['user', 'admin'])
                    ->latest()
                    ->take(20)
                    ->get();

        return view('admin.saldo.index', compact('users', 'logs'));
    }

    public function topup(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'jumlah'  => 'required|numeric|min:1000|max:10000000',
            'catatan' => 'nullable|string|max:255',
        ]);

        $user = User::findOrFail($request->user_id);

        $user->increment('saldo', $request->jumlah);

        TopupLog::create([
            'user_id'  => $user->id,
            'admin_id' => auth()->id(),
            'jumlah'   => $request->jumlah,
            'catatan'  => $request->catatan,
        ]);

        return redirect()->route('admin.saldo.index')
                         ->with('success', "Top up Rp " . number_format($request->jumlah, 0, ',', '.') . " untuk {$user->name} berhasil!");
    }
}
