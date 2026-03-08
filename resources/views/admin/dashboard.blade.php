@extends('layouts.admin')
@section('title', 'Dashboard')

@section('page-styles')
        .page-header{padding:2rem 2rem .5rem;}
        .page-header h1{font-family:var(--font-d);font-size:1.4rem;font-weight:800;color:var(--text);letter-spacing:-.03em;}
        .page-header p{font-size:.85rem;color:var(--text-muted);margin-top:.25rem;}
        .stat-card{background:var(--bg-card);border:1px solid var(--border);border-radius:1rem;padding:1.5rem;transition:border-color .2s,background .3s;}
        .stat-card:hover{border-color:rgba(192,57,43,.35);}
        .stat-icon{width:42px;height:42px;background:rgba(192,57,43,.12);border-radius:.7rem;display:flex;align-items:center;justify-content:center;color:var(--red-h);font-size:1.1rem;margin-bottom:1rem;}
        .stat-val{font-family:var(--font-d);font-size:1.8rem;font-weight:800;color:var(--text);letter-spacing:-.03em;}
        .stat-lbl{font-size:.8rem;color:var(--text-muted);margin-top:.2rem;}
@endsection

@section('content')
@php
    $pendingCount    = $pendingOrders ?? 0;
    $activeMenuCount = $activeMenus   ?? 0;
@endphp

<div class="page-header">
    <h1 data-i18n="page.title">Admin Dashboard</h1>
    <p><span data-i18n="page.hello">Halo</span>, {{ auth()->user()->name }}! <span data-i18n="page.subtitle">Berikut ringkasan sistem hari ini.</span></p>
</div>

<div style="padding:1.5rem 2rem;display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1.25rem;">
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-users"></i></div>
        <div class="stat-val">{{ $totalUsers }}</div>
        <div class="stat-lbl" data-i18n="stat.users">Total Pengguna</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-receipt"></i></div>
        <div class="stat-val">{{ $ordersToday }}</div>
        <div class="stat-lbl" data-i18n="stat.orders_today">Pesanan Hari Ini</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-utensils"></i></div>
        <div class="stat-val">{{ $activeMenus }}</div>
        <div class="stat-lbl" data-i18n="stat.active_menu">Menu Aktif</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-coins"></i></div>
        <div class="stat-val" style="font-size:1.2rem;">Rp {{ number_format($revenueToday, 0, ',', '.') }}</div>
        <div class="stat-lbl" data-i18n="stat.revenue">Pendapatan Hari Ini</div>
    </div>
</div>

<div style="padding:0 2rem 2rem;display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:1.25rem;">
    <a href="{{ route('admin.antrean.index') }}" class="stat-card" style="text-decoration:none;display:flex;align-items:center;gap:1.2rem;padding:1.25rem 1.5rem;">
        <div class="stat-icon" style="margin-bottom:0;flex-shrink:0;position:relative;">
            <i class="fas fa-list-ol"></i>
            @if($pendingCount > 0)
            <span style="position:absolute;top:-6px;right:-6px;background:var(--red);color:white;font-family:var(--font-d);font-size:.65rem;font-weight:700;padding:.1rem .4rem;border-radius:100px;min-width:18px;text-align:center;">{{ $pendingCount }}</span>
            @endif
        </div>
        <div>
            <div style="font-family:var(--font-d);font-size:.95rem;font-weight:700;color:var(--text);" data-i18n="quick.queue">Kelola Antrean</div>
            <div style="font-size:.8rem;color:var(--text-muted);margin-top:.15rem;" data-i18n-tmpl="quick.queue_sub" data-i18n-val="{{ $pendingCount }}">{{ $pendingCount }} pesanan aktif saat ini</div>
        </div>
        <i class="fas fa-chevron-right" style="margin-left:auto;color:var(--text-muted);font-size:.8rem;"></i>
    </a>
    <a href="{{ route('admin.laporan.index') }}" class="stat-card" style="text-decoration:none;display:flex;align-items:center;gap:1.2rem;padding:1.25rem 1.5rem;">
        <div class="stat-icon" style="margin-bottom:0;flex-shrink:0;"><i class="fas fa-chart-bar"></i></div>
        <div>
            <div style="font-family:var(--font-d);font-size:.95rem;font-weight:700;color:var(--text);" data-i18n="quick.report">Laporan Harian</div>
            <div style="font-size:.8rem;color:var(--text-muted);margin-top:.15rem;" data-i18n="quick.report_sub">Lihat rekap transaksi hari ini</div>
        </div>
        <i class="fas fa-chevron-right" style="margin-left:auto;color:var(--text-muted);font-size:.8rem;"></i>
    </a>
    <a href="{{ route('admin.menus.index') }}" class="stat-card" style="text-decoration:none;display:flex;align-items:center;gap:1.2rem;padding:1.25rem 1.5rem;">
        <div class="stat-icon" style="margin-bottom:0;flex-shrink:0;"><i class="fas fa-bowl-food"></i></div>
        <div>
            <div style="font-family:var(--font-d);font-size:.95rem;font-weight:700;color:var(--text);" data-i18n="quick.menus">Kelola Menu</div>
            <div style="font-size:.8rem;color:var(--text-muted);margin-top:.15rem;" data-i18n-tmpl="quick.menus_sub" data-i18n-val="{{ $activeMenuCount }}">{{ $activeMenuCount }} menu tersedia saat ini</div>
        </div>
        <i class="fas fa-chevron-right" style="margin-left:auto;color:var(--text-muted);font-size:.8rem;"></i>
    </a>
</div>
@endsection

@section('page-scripts')
<script>
Object.assign(window.T.id, {
    'page.title': 'Admin Dashboard',
    'page.hello': 'Halo',
    'page.subtitle': 'Berikut ringkasan sistem hari ini.',
    'stat.users': 'Total Pengguna',
    'stat.orders_today': 'Pesanan Hari Ini',
    'stat.active_menu': 'Menu Aktif',
    'stat.revenue': 'Pendapatan Hari Ini',
    'quick.queue': 'Kelola Antrean',
    'quick.queue_sub': '{n} pesanan aktif saat ini',
    'quick.report': 'Laporan Harian',
    'quick.report_sub': 'Lihat rekap transaksi hari ini',
    'quick.menus': 'Kelola Menu',
    'quick.menus_sub': '{n} menu tersedia saat ini',
});
Object.assign(window.T.en, {
    'page.title': 'Admin Dashboard',
    'page.hello': 'Hello',
    'page.subtitle': "Here's today's system summary.",
    'stat.users': 'Total Users',
    'stat.orders_today': "Today's Orders",
    'stat.active_menu': 'Active Menus',
    'stat.revenue': "Today's Revenue",
    'quick.queue': 'Manage Queue',
    'quick.queue_sub': '{n} active orders right now',
    'quick.report': 'Daily Report',
    'quick.report_sub': "View today's transaction recap",
    'quick.menus': 'Manage Menu',
    'quick.menus_sub': '{n} menus available right now',
});
window.applyLang(window.currentLang);
</script>
@endsection
