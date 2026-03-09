@extends('layouts.user')
@section('title', 'Menu Kantin')

@section('page-styles')
        /* ── Page wrap ── */
        .page-wrap{padding:2rem 1.75rem;}

        /* ── Header ── */
        .menu-hero{margin-bottom:1.75rem;}
        .menu-hero-sub{font-size:.8rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--red);margin-bottom:.35rem;}
        .menu-hero h1{font-family:var(--font-d);font-size:1.85rem;font-weight:800;color:var(--text);letter-spacing:-.04em;line-height:1.2;}
        .menu-hero p{font-size:.85rem;color:var(--text-muted);margin-top:.4rem;}

        /* ── Filter bar ── */
        .filter-bar{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem;margin-bottom:1.5rem;border-bottom:1px solid var(--border);}
        .tab-group{display:flex;gap:0;flex-wrap:wrap;}
        .tab-btn{font-family:var(--font-d);font-size:.82rem;font-weight:600;padding:.6rem 1.1rem;border:none;border-bottom:2px solid transparent;background:none;color:var(--text-muted);cursor:pointer;transition:all .18s;white-space:nowrap;margin-bottom:-1px;}
        .tab-btn:hover{color:var(--text);}
        .tab-btn.active{color:var(--text);border-bottom-color:var(--red);}

        /* Pedas filter */
        .spicy-filter{display:flex;align-items:center;gap:0;margin-bottom:-1px;}
        .spicy-btn{font-family:var(--font-d);font-size:.78rem;font-weight:600;padding:.55rem .85rem;border:none;border-bottom:2px solid transparent;background:none;color:var(--text-muted);cursor:pointer;transition:all .18s;white-space:nowrap;}
        .spicy-btn:hover{color:var(--text);}
        .spicy-btn.active{color:#ef4444;border-bottom-color:#ef4444;}

        /* ── Grid ── */
        .menu-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:1.1rem;}

        .menu-card{background:var(--bg-card);border:1px solid var(--border);border-radius:1rem;overflow:hidden;transition:border-color .2s,transform .2s;display:flex;flex-direction:column;text-decoration:none;cursor:pointer;}
        .menu-card:hover{border-color:var(--border-md);transform:translateY(-2px);}
        .menu-img-wrap{position:relative;}
        .menu-img{width:100%;height:148px;object-fit:cover;display:block;}
        .menu-img-placeholder{width:100%;height:148px;background:var(--bg-card2);display:flex;align-items:center;justify-content:center;}
        .pedas-badge{position:absolute;top:.55rem;right:.55rem;background:rgba(239,68,68,.88);color:white;font-family:var(--font-d);font-size:.63rem;font-weight:700;padding:.18rem .5rem;border-radius:100px;display:flex;align-items:center;gap:.25rem;}
        .habis-overlay{position:absolute;inset:0;background:rgba(0,0,0,.55);display:flex;align-items:center;justify-content:center;}
        .habis-label{font-family:var(--font-d);font-size:.78rem;font-weight:700;color:rgba(255,255,255,.7);background:rgba(0,0,0,.5);padding:.3rem .8rem;border-radius:100px;border:1px solid rgba(255,255,255,.2);}

        .menu-info{padding:.85rem 1rem 1rem;flex:1;display:flex;flex-direction:column;gap:.6rem;}
        .menu-name{font-family:var(--font-d);font-size:.88rem;font-weight:700;color:var(--text);line-height:1.35;}
        .menu-price{font-family:var(--font-d);font-size:.95rem;font-weight:800;color:#4ade80;}
        .menu-foot{display:flex;align-items:center;justify-content:space-between;margin-top:.35rem;padding-top:.65rem;border-top:1px solid var(--border);}

        /* ── Empty state ── */
        .empty-state{background:var(--bg-card);border:1px solid var(--border);border-radius:1rem;padding:4rem 2rem;text-align:center;grid-column:1/-1;}
        .empty-state i{font-size:2rem;color:var(--text-muted);display:block;margin-bottom:1rem;opacity:.35;}
        .empty-state p{font-size:.9rem;color:var(--text-muted);}
@endsection

@section('content')
<div class="page-wrap">

    {{-- Hero --}}
    <div class="menu-hero">
        <div class="menu-hero-sub">E-Canteen</div>
        <h1 data-i18n="page.title">Selamat Datang! 👋</h1>
        <p data-i18n="page.subtitle">Menu kantin hari ini — lihat foto, harga, dan ketersediaan stok.</p>
    </div>

    {{-- Filter bar --}}
    <div class="filter-bar">
        <div class="tab-group" id="tab-group">
            <button class="tab-btn active" data-cat="semua">Semua</button>
            <button class="tab-btn" data-cat="makanan_utama">Makanan Utama</button>
            <button class="tab-btn" data-cat="minuman">Minuman</button>
            <button class="tab-btn" data-cat="cemilan">Cemilan</button>
            <button class="tab-btn" data-cat="spesial_promo">Spesial Promo</button>
        </div>
        <div class="spicy-filter" id="spicy-group">
            <button class="spicy-btn active" data-spicy="semua">Semua</button>
            <button class="spicy-btn" data-spicy="pedas">🌶 Pedas</button>
            <button class="spicy-btn" data-spicy="tidak_pedas">Tidak Pedas</button>
        </div>
    </div>

    {{-- Menu grid --}}
    <div class="menu-grid" id="menu-grid">
        @forelse($menus as $menu)
        <a href="{{ route('user.menus.show', $menu) }}" class="menu-card"
             data-cat="{{ $menu->kategori }}"
             data-pedas="{{ $menu->is_pedas ? 'pedas' : 'tidak_pedas' }}"
             data-status="{{ $menu->stock > 0 ? 'tersedia' : 'habis' }}">
            <div class="menu-img-wrap">
                @if($menu->foto)
                    <img src="{{ Storage::url($menu->foto) }}" class="menu-img" alt="{{ $menu->nama_menu }}">
                @else
                    <div class="menu-img-placeholder"><i class="fas fa-bowl-food" style="font-size:2rem;color:var(--text-muted);"></i></div>
                @endif
                @if($menu->is_pedas)
                    @if($menu->kategori === 'minuman')
                        <span class="pedas-badge">🍬 Manis</span>
                    @else
                        <span class="pedas-badge"><i class="fas fa-fire"></i> Pedas</span>
                    @endif
                @endif
                @if($menu->stock <= 0)
                    <div class="habis-overlay"><span class="habis-label">Habis</span></div>
                @endif
            </div>
            <div class="menu-info">
                <div class="menu-name">{{ $menu->nama_menu }}</div>
                <div class="menu-foot">
                    <div class="menu-price">Rp {{ number_format($menu->harga, 0, ',', '.') }}</div>
                </div>
            </div>
        </a>
        @empty
        <div class="empty-state" style="grid-column:1/-1;">
            <i class="fas fa-bowl-food"></i>
            <p>Tidak ada menu tersedia saat ini.</p>
        </div>
        @endforelse

        {{-- Empty state JS filter (hidden by default, shown by JS) --}}
        <div class="empty-state" id="empty-filter" style="display:none;">
            <i class="fas fa-magnifying-glass"></i>
            <p id="empty-filter-text">Tidak ada produk di kategori ini.</p>
        </div>
    </div>

</div>

@endsection

@section('page-scripts')
<script>
/* ─── Tab & spicy filter ─── */
let activeCat   = 'semua';
let activeSpicy = 'semua';

function applyFilters() {
    var visible = 0;
    document.querySelectorAll('#menu-grid .menu-card').forEach(function(card) {
        const catMatch   = activeCat === 'semua'   || card.dataset.cat   === activeCat;
        const spicyMatch = activeSpicy === 'semua' || card.dataset.pedas === activeSpicy;
        const show = catMatch && spicyMatch;
        card.style.display = show ? '' : 'none';
        if (show) visible++;
    });
    var emptyEl  = document.getElementById('empty-filter');
    var emptyTxt = document.getElementById('empty-filter-text');
    if (emptyEl) {
        emptyEl.style.display = visible === 0 ? '' : 'none';
        if (emptyTxt && visible === 0) {
            var isMinuman = activeCat === 'minuman';
            emptyTxt.textContent = activeCat === 'semua'
                ? 'Tidak ada produk yang tersedia saat ini.'
                : 'Tidak ada produk di kategori ini.';
        }
    }
}

document.querySelectorAll('#tab-group .tab-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        document.querySelectorAll('#tab-group .tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        activeCat = btn.dataset.cat;

        // Update spicy/manis filter labels based on active category
        var isMinuman = activeCat === 'minuman';
        document.querySelector('.spicy-btn[data-spicy="pedas"]').innerHTML    = isMinuman ? '🍬 Manis'      : '🌶 Pedas';
        document.querySelector('.spicy-btn[data-spicy="tidak_pedas"]').textContent = isMinuman ? 'Tidak Manis' : 'Tidak Pedas';

        // Reset spicy filter to "Semua" on every tab change
        document.querySelectorAll('#spicy-group .spicy-btn').forEach(b => b.classList.remove('active'));
        document.querySelector('.spicy-btn[data-spicy="semua"]').classList.add('active');
        activeSpicy = 'semua';

        applyFilters();
    });
});

document.querySelectorAll('#spicy-group .spicy-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        document.querySelectorAll('#spicy-group .spicy-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        activeSpicy = btn.dataset.spicy;
        applyFilters();
    });
});

/* ─── i18n ─── */
Object.assign(window.T.id, {
    'page.title': 'Selamat Datang! 👋',
    'page.subtitle': 'Menu kantin hari ini — lihat foto, harga, dan ketersediaan stok.',
});
Object.assign(window.T.en, {
    'page.title': 'Welcome! 👋',
    'page.subtitle': "Today's canteen menu — browse photos, prices and stock.",
});
window.applyLang(window.currentLang);
</script>
@endsection