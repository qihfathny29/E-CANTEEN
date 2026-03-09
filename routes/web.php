<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\User\MenuController as UserMenuController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\User\SaldoController as UserSaldoController;
use App\Http\Controllers\User\CheckoutController as UserCheckoutController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\AntreanController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;

Route::get('/', function () {
    return view('welcome');
});

// Smart /dashboard redirect — digunakan oleh middleware guest saat redirect
Route::get('/dashboard', function () {
    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    }
    return redirect()->route('login');
})->name('dashboard');

// Route Admin - hanya bisa diakses role admin
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');

    Route::resource('menus', MenuController::class, ['as' => 'admin']);

    Route::get('/antrean', [AntreanController::class, 'index'])->name('admin.antrean.index');
    Route::patch('/antrean/{order}/status', [AntreanController::class, 'updateStatus'])->name('admin.antrean.updateStatus');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('admin.laporan.index');

    Route::get('/profile', [AdminProfileController::class, 'show'])->name('admin.profile');
    Route::post('/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
});

Route::prefix('user')->middleware(['auth', 'user'])->group(function () {
    Route::get('/dashboard', [UserDashboard::class, 'index'])->name('user.dashboard');

    // Menu
    Route::get('/menus', [UserMenuController::class, 'index'])->name('user.menus.index');

    // Order
    Route::get('/order', [UserOrderController::class, 'create'])->name('user.orders.create');
    Route::post('/order', [UserOrderController::class, 'store'])->name('user.orders.store');
    Route::get('/riwayat', [UserOrderController::class, 'index'])->name('user.orders.index');

    // Saldo
    Route::get('/saldo', [UserSaldoController::class, 'index'])->name('user.saldo.index');
    Route::post('/saldo/topup', [UserSaldoController::class, 'topUp'])->name('user.saldo.topup');

    // Checkout
    Route::get('/checkout', [UserCheckoutController::class, 'index'])->name('user.checkout.index');
    Route::post('/checkout/pay', [UserCheckoutController::class, 'pay'])->name('user.checkout.pay');

    // Profile
    Route::get('/profile', [UserProfileController::class, 'show'])->name('user.profile');
    Route::post('/profile', [UserProfileController::class, 'update'])->name('user.profile.update');
});

require __DIR__.'/auth.php';
