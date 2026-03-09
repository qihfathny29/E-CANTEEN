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
        .topup-title{font-family:var(--font-d);font-size:.95rem;font-weight:700;color:var(--text);margin-bottom:1.1rem;}
        .flash-err{background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.25);color:#f87171;border-radius:.6rem;padding:.7rem .9rem;font-size:.85rem;margin-bottom:.9rem;}
        .nominal-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:.55rem;margin-bottom:1.1rem;}
        .nominal-btn{padding:.55rem .4rem;border-radius:.55rem;border:1px solid var(--border-md);background:var(--bg-card2);color:var(--text-sub);font-family:var(--font-d);font-size:.75rem;font-weight:700;cursor:pointer;transition:all .2s;text-align:center;}
        .nominal-btn:hover{border-color:rgba(192,57,43,.4);color:var(--text);background:rgba(192,57,43,.08);}
        .form-label{font-size:.8rem;font-weight:600;color:var(--text-sub);margin-bottom:.4rem;display:block;}
        .form-input{width:100%;padding:.55rem .9rem;border-radius:.55rem;border:1px solid var(--border-md);background:var(--input-bg);color:var(--text);font-family:var(--font-b);font-size:.9rem;outline:none;transition:border .2s;margin-bottom:1rem;}
        .form-input:focus{border-color:rgba(192,57,43,.5);}
        .btn-topup{width:100%;padding:.72rem;border-radius:.6rem;background:var(--red);color:white;font-family:var(--font-d);font-size:.9rem;font-weight:700;border:none;cursor:pointer;transition:background .2s;}
        .btn-topup:hover{background:var(--red-h);}
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
        <div class="topup-title" data-i18n="topup.title">Top Up Saldo</div>

        @if($errors->any())
            <div class="flash-err"><i class="fas fa-circle-exclamation"></i> {{ $errors->first() }}</div>
        @endif

        <form action="{{ route('user.saldo.topup') }}" method="POST">
            @csrf
            <div class="nominal-grid">
                @foreach([10000, 20000, 50000, 100000, 200000, 500000] as $nominal)
                <button type="button" class="nominal-btn"
                        onclick="document.getElementById('jumlah').value={{ $nominal }}">
                    Rp {{ number_format($nominal, 0, ',', '.') }}
                </button>
                @endforeach
            </div>
            <label class="form-label" for="jumlah" data-i18n="topup.label">Nominal Top Up</label>
            <input type="number" id="jumlah" name="jumlah"
                   placeholder="Minimal Rp 10.000" class="form-input">
            <button type="submit" class="btn-topup">
                <i class="fas fa-plus" style="margin-right:.4rem;"></i><span data-i18n="topup.btn">Top Up Sekarang</span>
            </button>
        </form>
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