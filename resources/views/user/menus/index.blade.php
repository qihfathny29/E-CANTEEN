@extends('layouts.user')
@section('title', 'Menu Kantin')

@section('page-styles')
        /* ── Page wrap ── */
        .page-wrap{padding:2rem 1.75rem 7rem;}

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

        .menu-card{background:var(--bg-card);border:1px solid var(--border);border-radius:1rem;overflow:hidden;transition:border-color .2s,transform .2s;display:flex;flex-direction:column;}
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

        /* Add / Qty buttons */
        .btn-add{display:inline-flex;align-items:center;gap:.35rem;font-family:var(--font-d);font-size:.78rem;font-weight:700;padding:.38rem .85rem;border-radius:.5rem;border:none;background:var(--red);color:white;cursor:pointer;transition:background .18s;}
        .btn-add:hover{background:var(--red-h);}
        .qty-ctrl{display:inline-flex;align-items:center;gap:.5rem;}
        .qty-ctrl button{width:26px;height:26px;border-radius:.35rem;border:1px solid var(--border-md);background:var(--bg-card2);color:var(--text);font-size:.8rem;cursor:pointer;transition:all .18s;display:flex;align-items:center;justify-content:center;}
        .qty-ctrl button:hover{background:var(--red);border-color:var(--red);color:white;}
        .qty-ctrl span{font-family:var(--font-d);font-size:.82rem;font-weight:700;color:var(--text);min-width:22px;text-align:center;}

        /* ── Empty state ── */
        .empty-state{background:var(--bg-card);border:1px solid var(--border);border-radius:1rem;padding:4rem 2rem;text-align:center;grid-column:1/-1;}
        .empty-state i{font-size:2rem;color:var(--text-muted);display:block;margin-bottom:1rem;opacity:.35;}
        .empty-state p{font-size:.9rem;color:var(--text-muted);}

        /* ── Sticky cart bar ── */
        .cart-bar{position:fixed;bottom:0;left:var(--sidebar-w);right:0;z-index:90;padding:1rem 1.75rem;background:var(--nav-bg);backdrop-filter:blur(14px);border-top:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;gap:1rem;transform:translateY(110%);transition:transform .3s cubic-bezier(.4,0,.2,1);}
        .cart-bar.show{transform:translateY(0);}
        .cart-bar-info{display:flex;align-items:center;gap:.75rem;}
        .cart-bar-icon{width:38px;height:38px;background:var(--red);border-radius:.55rem;display:flex;align-items:center;justify-content:center;color:white;font-size:.9rem;flex-shrink:0;}
        .cart-bar-count{font-family:var(--font-d);font-size:.82rem;font-weight:600;color:var(--text-muted);}
        .cart-bar-total{font-family:var(--font-d);font-size:1rem;font-weight:800;color:var(--text);}
        .cart-bar-btn{display:inline-flex;align-items:center;gap:.5rem;font-family:var(--font-d);font-size:.85rem;font-weight:700;padding:.55rem 1.35rem;border-radius:.6rem;background:var(--red);color:white;text-decoration:none;transition:background .18s;border:none;cursor:pointer;}
        .cart-bar-btn:hover{background:var(--red-h);}
@endsection

@section('content')
<div class="page-wrap">

    {{-- Hero --}}
    <div class="menu-hero">
        <div class="menu-hero-sub">E-Canteen</div>
        <h1 data-i18n="page.title">Selamat Datang! 👋</h1>
        <p data-i18n="page.subtitle">Canteen Menu Hari Ini — pilih favoritmu dan pesan sekarang.</p>
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
        @foreach($menus as $menu)
        <div class="menu-card"
             data-cat="{{ $menu->kategori }}"
             data-pedas="{{ $menu->is_pedas ? 'pedas' : 'tidak_pedas' }}"
             data-status="{{ $menu->status }}"
             data-id="{{ $menu->id }}"
             data-nama="{{ $menu->nama_menu }}"
             data-harga="{{ (int) $menu->harga }}"
             data-foto="{{ $menu->foto ? Storage::url($menu->foto) : '' }}">
            <div class="menu-img-wrap">
                @if($menu->foto)
                    <img src="{{ Storage::url($menu->foto) }}" class="menu-img" alt="{{ $menu->nama_menu }}">
                @else
                    <div class="menu-img-placeholder"><i class="fas fa-bowl-food" style="font-size:2rem;color:var(--text-muted);"></i></div>
                @endif
                @if($menu->is_pedas)
                    <span class="pedas-badge"><i class="fas fa-fire"></i> Pedas</span>
                @endif
                @if($menu->status === 'habis')
                    <div class="habis-overlay"><span class="habis-label">Habis</span></div>
                @endif
            </div>
            <div class="menu-info">
                <div class="menu-name">{{ $menu->nama_menu }}</div>
                <div class="menu-foot">
                    <div class="menu-price">Rp {{ number_format($menu->harga, 0, ',', '.') }}</div>
                    @if($menu->status === 'tersedia')
                        <div class="menu-cart-ctrl" id="ctrl-{{ $menu->id }}">
                            <button class="btn-add" onclick="addToCart({{ $menu->id }})">
                                <i class="fas fa-plus" style="font-size:.7rem;"></i> Tambah
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>

{{-- Sticky cart bar --}}
<div class="cart-bar" id="cart-bar">
    <div class="cart-bar-info">
        <div class="cart-bar-icon"><i class="fas fa-cart-shopping"></i></div>
        <div>
            <div class="cart-bar-count" id="cart-bar-count">0 item</div>
            <div class="cart-bar-total" id="cart-bar-total">Rp 0</div>
        </div>
    </div>
    <a href="{{ route('user.checkout.index') }}" class="cart-bar-btn">
        <i class="fas fa-arrow-right" style="font-size:.75rem;"></i> Lihat Keranjang & Pesan Now
    </a>
</div>
@endsection

@section('page-scripts')
<script>
/* ─── Cart helpers ─── */
const CART_KEY = 'ecanteen-cart-{{ auth()->id() }}';

function loadCart() {
    try { return JSON.parse(localStorage.getItem(CART_KEY)) || {}; }
    catch(e) { return {}; }
}
function saveCart(cart) {
    localStorage.setItem(CART_KEY, JSON.stringify(cart));
    updateCartUI(cart);
    updateNavCartBadge(cart);
}

function addToCart(menuId) {
    const cart = loadCart();
    const card = document.querySelector('.menu-card[data-id="' + menuId + '"]');
    if (!card) return;
    cart[menuId] = {
        id: menuId,
        nama: card.dataset.nama,
        harga: parseInt(card.dataset.harga),
        foto: card.dataset.foto,
        qty: (cart[menuId] ? cart[menuId].qty : 0) + 1,
    };
    saveCart(cart);
    renderCartCtrl(menuId, cart[menuId].qty);
}
function removeFromCart(menuId) {
    const cart = loadCart();
    if (!cart[menuId]) return;
    cart[menuId].qty -= 1;
    if (cart[menuId].qty <= 0) delete cart[menuId];
    saveCart(cart);
    renderCartCtrl(menuId, cart[menuId] ? cart[menuId].qty : 0);
}

function renderCartCtrl(menuId, qty) {
    const wrap = document.getElementById('ctrl-' + menuId);
    if (!wrap) return;
    if (qty <= 0) {
        wrap.innerHTML = '<button class="btn-add" onclick="addToCart(' + menuId + ')"><i class="fas fa-plus" style="font-size:.7rem;"></i> Tambah</button>';
    } else {
        wrap.innerHTML =
            '<div class="qty-ctrl">' +
            '<button onclick="removeFromCart(' + menuId + ')"><i class="fas fa-minus" style="font-size:.65rem;"></i></button>' +
            '<span>' + qty + '</span>' +
            '<button onclick="addToCart(' + menuId + ')"><i class="fas fa-plus" style="font-size:.65rem;"></i></button>' +
            '</div>';
    }
}

function updateCartUI(cart) {
    const keys = Object.keys(cart);
    const totalQty   = keys.reduce((s, k) => s + cart[k].qty, 0);
    const totalHarga = keys.reduce((s, k) => s + cart[k].qty * cart[k].harga, 0);
    const bar = document.getElementById('cart-bar');
    if (totalQty > 0) {
        document.getElementById('cart-bar-count').textContent = totalQty + ' item';
        document.getElementById('cart-bar-total').textContent = 'Rp ' + totalHarga.toLocaleString('id-ID');
        bar.classList.add('show');
    } else {
        bar.classList.remove('show');
    }
}

function updateNavCartBadge(cart) {
    const total = Object.values(cart).reduce((s, i) => s + i.qty, 0);
    const badge = document.getElementById('nav-cart-badge');
    if (!badge) return;
    badge.textContent = total;
    badge.style.display = total > 0 ? 'flex' : 'none';
}

/* ─── Init cart state on load ─── */
(function initCart() {
    const cart = loadCart();
    Object.keys(cart).forEach(id => renderCartCtrl(parseInt(id), cart[id].qty));
    updateCartUI(cart);
    updateNavCartBadge(cart);
})();

/* ─── Tab & spicy filter ─── */
let activeCat   = 'semua';
let activeSpicy = 'semua';

function applyFilters() {
    document.querySelectorAll('#menu-grid .menu-card').forEach(function(card) {
        const catMatch   = activeCat === 'semua'   || card.dataset.cat   === activeCat;
        const spicyMatch = activeSpicy === 'semua' || card.dataset.pedas === activeSpicy;
        card.style.display = (catMatch && spicyMatch) ? '' : 'none';
    });
}

document.querySelectorAll('#tab-group .tab-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        document.querySelectorAll('#tab-group .tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        activeCat = btn.dataset.cat;
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
    'page.subtitle': 'Canteen Menu Hari Ini — pilih favoritmu dan pesan sekarang.',
});
Object.assign(window.T.en, {
    'page.title': 'Welcome! 👋',
    'page.subtitle': "Today's Canteen Menu — pick your favourite and order now.",
});
window.applyLang(window.currentLang);
</script>
@endsection