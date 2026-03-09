@extends('layouts.user')
@section('title', 'Saldo')

@section('page-styles')
        .page-wrap{padding:2rem;}
        .page-header{margin-bottom:1.75rem;}
        .page-header h1{font-family:var(--font-d);font-size:1.4rem;font-weight:800;color:var(--text);letter-spacing:-.03em;}
        .page-header p{font-size:.85rem;color:var(--text-muted);margin-top:.2rem;}
        .flash{border-radius:.75rem;padding:.85rem 1.1rem;margin-bottom:1.5rem;font-size:.875rem;display:flex;align-items:center;gap:.65rem;}
        .flash-success{background:rgba(34,197,94,.10);border:1px solid rgba(34,197,94,.25);color:#4ade80;}
        .saldo-hero{background:linear-gradient(135deg,var(--red) 0%,#8b1a12 100%);border-radius:1rem;padding:1.75rem;color:white;margin-bottom:1.1rem;}
        .saldo-hero-label{font-family:var(--font-d);font-size:.72rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;opacity:.8;margin-bottom:.5rem;display:flex;align-items:center;gap:.4rem;}
        .saldo-hero-amount{font-family:var(--font-d);font-size:2.1rem;font-weight:800;letter-spacing:-.03em;}
        .saldo-hero-name{font-size:.82rem;opacity:.7;margin-top:.75rem;}
        .topup-card{background:var(--bg-card);border:1px solid var(--border);border-radius:1rem;padding:1.4rem;}
        .topup-title{font-family:var(--font-d);font-size:.95rem;font-weight:700;color:var(--text);margin-bottom:.35rem;}
        .topup-desc{font-size:.85rem;color:var(--text-muted);line-height:1.6;}
        .topup-steps{list-style:none;margin-top:1rem;display:flex;flex-direction:column;gap:.6rem;}
        .topup-steps li{display:flex;align-items:flex-start;gap:.65rem;font-size:.84rem;color:var(--text-sub);}
        .step-num{width:22px;height:22px;border-radius:50%;background:rgba(192,57,43,.15);color:var(--red);font-family:var(--font-d);font-size:.68rem;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:.05rem;}
@endsection

@section('content')
<div class="page-wrap">
    <div class="page-header">
        <h1 data-i18n="page.title">Saldo Saya</h1>
        <p data-i18n="page.subtitle">Kelola saldo untuk melakukan pemesanan di kantin.</p>
    </div>

    @if(session('success'))
        <div class="flash flash-success"><i class="fas fa-circle-check"></i> {{ session('success') }}</div>
    @endif

    <div class="saldo-hero">
        <div class="saldo-hero-label"><i class="fas fa-wallet"></i> <span data-i18n="hero.label">Saldo Kamu</span></div>
        <div class="saldo-hero-amount">Rp {{ number_format(auth()->user()->saldo, 0, ',', '.') }}</div>
        <div class="saldo-hero-name">{{ auth()->user()->name }}</div>
    </div>

    <div class="topup-card">
        <div class="topup-title">Cara Top Up Saldo</div>
        <p class="topup-desc">Saldo kamu ditambahkan langsung oleh petugas kantin setelah kamu membayar tunai di kasir.</p>
        <ol class="topup-steps">
            <li>
                <span class="step-num">1</span>
                <span>Datangi kasir kantin dan beritahu nama kamu.</span>
            </li>
            <li>
                <span class="step-num">2</span>
                <span>Serahkan uang tunai sesuai nominal yang ingin kamu isi.</span>
            </li>
            <li>
                <span class="step-num">3</span>
                <span>Petugas akan langsung mengisi saldo ke akun kamu.</span>
            </li>
            <li>
                <span class="step-num">4</span>
                <span>Saldo akan otomatis muncul di sini setelah berhasil diisi.</span>
            </li>
        </ol>
    </div>
</div>
@endsection

@section('page-scripts')
<script>
Object.assign(window.T.id, {
    'page.title': 'Saldo Saya',
    'page.subtitle': 'Kelola saldo untuk melakukan pemesanan di kantin.',
    'hero.label': 'Saldo Kamu',
    'topup.title': 'Top Up Saldo',
    'topup.label': 'Nominal Top Up',
    'topup.btn': 'Top Up Sekarang',
});
Object.assign(window.T.en, {
    'page.title': 'My Balance',
    'page.subtitle': 'Manage your balance for canteen orders.',
    'hero.label': 'Your Balance',
    'topup.title': 'Top Up Balance',
    'topup.label': 'Amount',
    'topup.btn': 'Top Up Now',
});
window.applyLang(window.currentLang);
</script>
@endsection