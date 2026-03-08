@extends('layouts.user')
@section('title', 'Dashboard')

@section('page-styles')
        .stat-card{background:var(--bg-card);border:1px solid var(--border);border-radius:1rem;padding:1.5rem;transition:border-color .2s,background .3s;display:block;text-decoration:none;}
        .stat-card:hover{border-color:rgba(192,57,43,.35);}
        .stat-icon{width:42px;height:42px;background:rgba(192,57,43,.12);border-radius:.7rem;display:flex;align-items:center;justify-content:center;color:var(--red-h);font-size:1.1rem;margin-bottom:1rem;}
        .stat-val{font-family:var(--font-d);font-size:1.5rem;font-weight:800;color:var(--text);letter-spacing:-.03em;}
        .stat-lbl{font-size:.8rem;color:var(--text-muted);margin-top:.2rem;}
        .page-header{padding:2rem 2rem .5rem;}
        .page-header h1{font-family:var(--font-d);font-size:1.4rem;font-weight:800;color:var(--text);letter-spacing:-.03em;}
        .page-header p{font-size:.85rem;color:var(--text-muted);margin-top:.2rem;}
        .saldo-card{background:linear-gradient(135deg,var(--red) 0%,#992d22 100%);border-radius:1rem;padding:1.75rem;color:white;}
        .saldo-label{font-family:var(--font-d);font-size:.75rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;opacity:.85;margin-bottom:.5rem;}
        .saldo-amount{font-family:var(--font-d);font-size:2rem;font-weight:800;letter-spacing:-.03em;}
@endsection

@section('content')
    <div class="page-header">
        <h1><span data-i18n="page.hello">Halo</span>, {{ auth()->user()->name }}!</h1>
        <p data-i18n="page.welcome">Selamat datang di E-Canteen kamu.</p>
    </div>

    <div style="padding:1.5rem 2rem;display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:1.25rem;">
        <div class="saldo-card">
            <div class="saldo-label"><i class="fas fa-wallet" style="margin-right:.4rem;"></i> <span data-i18n="stat.balance">Saldo Kamu</span></div>
            <div class="saldo-amount">Rp {{ number_format(auth()->user()->saldo, 0, ',', '.') }}</div>
            <div style="margin-top:1rem;opacity:.75;font-size:.8rem;">{{ auth()->user()->email }}</div>
        </div>
        <a href="{{ route('user.orders.index') }}" class="stat-card">
            <div class="stat-icon"><i class="fas fa-receipt"></i></div>
            <div class="stat-val">{{ $activeOrders }}</div>
            <div class="stat-lbl" data-i18n="stat.active_orders">Pesanan Aktif</div>
        </a>
        <a href="{{ route('user.orders.index') }}" class="stat-card">
            <div class="stat-icon"><i class="fas fa-clock-rotate-left"></i></div>
            <div class="stat-val">{{ $totalOrders }}</div>
            <div class="stat-lbl" data-i18n="stat.total_orders">Total Pesanan</div>
        </a>
        <a href="{{ route('user.orders.create') }}" class="stat-card">
            <div class="stat-icon"><i class="fas fa-cart-shopping"></i></div>
            <div class="stat-val" data-i18n="stat.order_btn" style="font-size:1rem;margin-top:.25rem;">Pesan →</div>
            <div class="stat-lbl" data-i18n="stat.preorder">Pre-Order Sekarang</div>
        </a>
    </div>
@endsection

@section('page-scripts')
<script>
Object.assign(window.T.id, {
    'page.hello': 'Halo',
    'page.welcome': 'Selamat datang di E-Canteen kamu.',
    'stat.balance': 'Saldo Kamu',
    'stat.active_orders': 'Pesanan Aktif',
    'stat.total_orders': 'Total Pesanan',
    'stat.order_btn': 'Pesan →',
    'stat.preorder': 'Pre-Order Sekarang',
});
Object.assign(window.T.en, {
    'page.hello': 'Hello',
    'page.welcome': 'Welcome to your E-Canteen.',
    'stat.balance': 'Your Balance',
    'stat.active_orders': 'Active Orders',
    'stat.total_orders': 'Total Orders',
    'stat.order_btn': 'Order →',
    'stat.preorder': 'Pre-Order Now',
});
window.applyLang(window.currentLang);
</script>
@endsection