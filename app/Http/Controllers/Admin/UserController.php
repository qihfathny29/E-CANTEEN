<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
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

        $users = $query->orderBy('name')->paginate(20)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $orders = Order::with('orderItems.menu')
                        ->where('user_id', $user->id)
                        ->latest()
                        ->paginate(10);

        return view('admin.users.show', compact('user', 'orders'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'user_type' => 'required|in:siswa,guru',
            'password'  => ['required', 'confirmed', Rules\Password::defaults()],
            'saldo'     => 'nullable|numeric|min:0',
        ]);

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'user_type' => $request->user_type,
            'password'  => Hash::make($request->password),
            'role'      => 'user',
            'saldo'     => $request->saldo ?? 0,
        ]);

        return redirect()->route('admin.users.index')
                         ->with('success', "Akun {$request->name} berhasil dibuat.");
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'user_type' => 'required|in:siswa,guru',
            'password'  => ['nullable', 'confirmed', Rules\Password::defaults()],
            'saldo'     => 'nullable|numeric|min:0',
        ]);

        $data = [
            'name'      => $request->name,
            'email'     => $request->email,
            'user_type' => $request->user_type,
            'saldo'     => $request->saldo ?? $user->saldo,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
                         ->with('success', "Data {$user->name} berhasil diperbarui.");
    }

    public function destroy(User $user)
    {
        // Jangan hapus admin sendiri
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak bisa menghapus akun yang sedang aktif.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
                         ->with('success', "Akun {$user->name} berhasil dihapus.");
    }
}
