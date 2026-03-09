@extends('layouts.user')
@section('title', 'Checkout')

@section('page-styles')
        .page-wrap{padding:2rem 1.75rem;}
        .back-link{display:inline-flex;align-items:center;gap:.45rem;font-family:var(--font-d);font-size:.8rem;font-weight:600;color:var(--text-muted);text-decoration:none;margin-bottom:1.4rem;transition:color .18s;}
        .back-link:hover{color:var(--text);}

        .page-title{font-family:var(--font-d);font-size:1.75rem;font-weight:800;color:var(--text);letter-spacing:-.04em;margin-bottom:1.75rem;}
        .page-title span{color:var(--red);}

        /* ── Two-column layout ── */
        .checkout-grid{display:grid;grid-template-columns:1fr 380px;gap:1.5rem;align-items:start;}
        @media(max-width:860px){.checkout-grid{grid-template-columns:1fr;}}

        /* ── Shared card ── */
        .ck-card{background:var(--bg-card);border:1px solid var(--border);border-radius:1.1rem;overflow:hidden;}
        .ck-card-head{padding:1.1rem 1.35rem .9rem;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:.6rem;}
        .ck-card-head-icon{width:28px;height:28px;border-radius:.45rem;background:rgba(192,57,43,.15);color:var(--red);display:flex;align-items:center;justify-content:center;font-size:.78rem;flex-shrink:0;}
        .ck-card-head-title{font-family:var(--font-d);font-size:.92rem;font-weight:700;color:var(--text);}
        .ck-card-body{padding:1.1rem 1.35rem;}

        /* ── Order items ── */
        .order-item{display:flex;gap:.9rem;padding:.9rem 0;border-bottom:1px solid var(--border);}
        .order-item:last-of-type{border-bottom:none;}
        .oi-thumb{width:64px;height:64px;border-radius:.6rem;object-fit:cover;flex-shrink:0;background:var(--bg-card2);display:flex;align-items:center;justify-content:center;overflow:hidden;}
        .oi-thumb img{width:100%;height:100%;object-fit:cover;}
        .oi-thumb i{font-size:1.25rem;color:var(--text-muted);}
        .oi-body{flex:1;min-width:0;}
        .oi-name{font-family:var(--font-d);font-size:.88rem;font-weight:700;color:var(--text);}
        .oi-price{font-family:var(--font-d);font-size:.8rem;font-weight:600;color:#4ade80;margin-top:.15rem;}
        .oi-right{display:flex;flex-direction:column;align-items:flex-end;gap:.5rem;flex-shrink:0;}
        .oi-sub-label{font-size:.7rem;color:var(--text-muted);}
        .oi-sub-val{font-family:var(--font-d);font-size:.95rem;font-weight:800;color:var(--text);}

        /* Qty ctrl */
        .oi-qty{display:flex;align-items:center;gap:.45rem;}
        .oi-qty button{width:24px;height:24px;border-radius:.35rem;border:1px solid var(--border-md);background:var(--bg-card2);color:var(--text);font-size:.72rem;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .18s;}
        .oi-qty button:hover{background:var(--red);border-color:var(--red);color:white;}
        .oi-qty span{font-family:var(--font-d);font-size:.8rem;font-weight:700;color:var(--text);min-width:20px;text-align:center;}

        /* Note textarea */
        .oi-note{width:100%;margin-top:.55rem;background:var(--input-bg);border:1px solid var(--border);border-radius:.5rem;padding:.45rem .7rem;font-family:var(--font-b);font-size:.78rem;color:var(--text);resize:none;outline:none;transition:border-color .18s;}
        .oi-note:focus{border-color:rgba(192,57,43,.4);background:var(--input-bg-f);}
        .oi-note::placeholder{color:var(--text-muted);}

        /* Empty cart */
        .empty-cart{padding:3rem;text-align:center;}
        .empty-cart i{font-size:2.2rem;color:var(--text-muted);opacity:.3;display:block;margin-bottom:1rem;}
        .empty-cart p{font-size:.9rem;color:var(--text-muted);}
        .empty-cart a{display:inline-flex;align-items:center;gap:.4rem;margin-top:1rem;font-family:var(--font-d);font-size:.82rem;font-weight:700;color:var(--red);text-decoration:none;}

        /* ── Waktu ambil ── */
        .wt-group{display:flex;gap:.65rem;flex-wrap:wrap;}
        .wt-label{flex:1;min-width:130px;}
        .wt-label input{display:none;}
        .wt-label input:checked + .wt-inner{border-color:var(--red);background:rgba(192,57,43,.08);color:var(--text);}
        .wt-inner{display:flex;align-items:center;gap:.55rem;padding:.65rem .9rem;border:1px solid var(--border-md);border-radius:.65rem;cursor:pointer;transition:all .18s;color:var(--text-muted);font-family:var(--font-d);font-size:.8rem;font-weight:600;}
        .wt-inner:hover{border-color:var(--text-muted);}
        .wt-inner i{font-size:.8rem;}

        /* ── Payment options ── */
        .pay-option{display:flex;align-items:center;gap:.75rem;padding:.75rem .9rem;border:1px solid var(--border-md);border-radius:.75rem;cursor:pointer;transition:all .18s;margin-bottom:.55rem;}
        .pay-option:last-child{margin-bottom:0;}
        .pay-option input{display:none;}
        .pay-option.selected{border-color:var(--red);background:rgba(192,57,43,.07);}
        .pay-icon{width:38px;height:38px;border-radius:.5rem;overflow:hidden;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:1rem;}
        .pay-name{font-family:var(--font-d);font-size:.83rem;font-weight:700;color:var(--text);flex:1;}
        .pay-sub{font-size:.72rem;color:var(--text-muted);margin-top:.08rem;}
        .pay-check{width:18px;height:18px;border-radius:50%;border:2px solid var(--border-md);flex-shrink:0;display:flex;align-items:center;justify-content:center;transition:all .18s;}
        .pay-option.selected .pay-check{border-color:var(--red);background:var(--red);}
        .pay-option.selected .pay-check::after{content:'';width:6px;height:6px;border-radius:50%;background:white;display:block;}

        /* ── Cost breakdown ── */
        .cost-row{display:flex;justify-content:space-between;align-items:baseline;padding:.35rem 0;font-size:.82rem;color:var(--text-muted);}
        .cost-row.total{padding-top:.65rem;border-top:1px solid var(--border);margin-top:.3rem;}
        .cost-row.total .cost-label{font-family:var(--font-d);font-size:.9rem;font-weight:700;color:var(--text);}
        .cost-row.total .cost-val{font-family:var(--font-d);font-size:1.15rem;font-weight:800;color:var(--red-h);}

        /* ── Pay button ── */
        .btn-pay{display:flex;align-items:center;justify-content:center;gap:.55rem;width:100%;padding:.85rem;border-radius:.75rem;background:linear-gradient(135deg,var(--red),var(--red-h));color:white;font-family:var(--font-d);font-size:.95rem;font-weight:800;border:none;cursor:pointer;transition:opacity .18s;margin-top:1rem;position:relative;overflow:hidden;}
        .btn-pay:hover{opacity:.9;}
        .btn-pay .sparkle{position:absolute;right:1.1rem;font-size:1.1rem;opacity:.7;}
        .btn-pay:disabled{opacity:.5;cursor:not-allowed;}

        /* Alert */
        .alert-err{background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.3);border-radius:.6rem;padding:.65rem 1rem;font-size:.82rem;color:#ef4444;margin-bottom:1.2rem;}
@endsection

@section('content')
<div class="page-wrap">

    <a href="{{ route('user.menus.index') }}" class="back-link">
        <i class="fas fa-arrow-left" style="font-size:.75rem;"></i> Kembali ke Menu
    </a>

    <h1 class="page-title">Ringkasan Pesanan <span>&</span> Pembayaran</h1>

    @if(session('error'))
        <div class="alert-err"><i class="fas fa-circle-exclamation" style="margin-right:.4rem;"></i>{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('user.checkout.pay') }}" id="checkout-form">
        @csrf
        <div class="checkout-grid">

            {{-- ═══ LEFT: Order summary ═══ --}}
            <div class="ck-card">
                <div class="ck-card-head">
                    <div class="ck-card-head-icon"><i class="fas fa-receipt"></i></div>
                    <div class="ck-card-head-title">Daftar Pesanan</div>
                </div>
                <div class="ck-card-body" id="order-list-wrap">
                    <div class="empty-cart" id="empty-cart" style="display:none;">
                        <i class="fas fa-cart-shopping"></i>
                        <p>Keranjangmu masih kosong.</p>
                        <a href="{{ route('user.menus.index') }}"><i class="fas fa-arrow-left" style="font-size:.7rem;"></i> Kembali ke Menu</a>
                    </div>
                    <div id="order-items-list"></div>
                </div>

                {{-- Waktu ambil --}}
                <div style="padding:0 1.35rem 1.35rem;">
                    <div style="font-family:var(--font-d);font-size:.78rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.07em;margin-bottom:.7rem;">
                        <i class="fas fa-clock" style="margin-right:.35rem;"></i>Waktu Pengambilan
                    </div>
                    <div class="wt-group">
                        <label class="wt-label">
                            <input type="radio" name="waktu_ambil" value="istirahat_1" checked>
                            <div class="wt-inner"><i class="fas fa-sun"></i> Istirahat 1</div>
                        </label>
                        <label class="wt-label">
                            <input type="radio" name="waktu_ambil" value="istirahat_2">
                            <div class="wt-inner"><i class="fas fa-cloud-sun"></i> Istirahat 2</div>
                        </label>
                    </div>
                </div>
            </div>

            {{-- ═══ RIGHT: Payment ═══ --}}
            <div style="display:flex;flex-direction:column;gap:1.1rem;">

                {{-- Cost breakdown --}}
                <div class="ck-card">
                    <div class="ck-card-head">
                        <div class="ck-card-head-icon"><i class="fas fa-tag"></i></div>
                        <div class="ck-card-head-title">Detail Biaya</div>
                    </div>
                    <div class="ck-card-body">
                        <div class="cost-row">
                            <span class="cost-label">Subtotal</span>
                            <span class="cost-val" id="cost-subtotal">Rp 0</span>
                        </div>
                        <div class="cost-row">
                            <span class="cost-label">Pajak (0%)</span>
                            <span class="cost-val">Rp 0</span>
                        </div>
                        <div class="cost-row">
                            <span class="cost-label">Biaya Layanan</span>
                            <span class="cost-val">Rp 2.000</span>
                        </div>
                        <div class="cost-row total">
                            <span class="cost-label">Total Pembayaran</span>
                            <span class="cost-val" id="cost-total">Rp 2.000</span>
                        </div>
                    </div>
                </div>

                {{-- Payment method --}}
                <div class="ck-card">
                    <div class="ck-card-head">
                        <div class="ck-card-head-icon"><i class="fas fa-credit-card"></i></div>
                        <div class="ck-card-head-title">Pilih Metode Pembayaran</div>
                    </div>
                    <div class="ck-card-body">

                        <div class="pay-option selected" onclick="selectPay(this,'saldo')">
                            <input type="radio" name="metode_bayar" value="saldo" checked>
                            <div class="pay-icon" style="background:rgba(192,57,43,.12);">
                                <i class="fas fa-wallet" style="color:var(--red);"></i>
                            </div>
                            <div>
                                <div class="pay-name">Saldo E-Canteen SISWA</div>
                                <div class="pay-sub">Rp {{ number_format($user->saldo, 0, ',', '.') }}</div>
                            </div>
                            <div class="pay-check"></div>
                        </div>

                        <div class="pay-option" onclick="selectPay(this,'gopay')">
                            <input type="radio" name="metode_bayar" value="gopay">
                            <div class="pay-icon" style="background:#e8f8f0;">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/86/Gopay_logo.svg/1200px-Gopay_logo.svg.png" style="width:28px;height:28px;object-fit:contain;" alt="GoPay">
                            </div>
                            <div>
                                <div class="pay-name">GoPay</div>
                            </div>
                            <div class="pay-check"></div>
                        </div>

                        <div class="pay-option" onclick="selectPay(this,'dana')">
                            <input type="radio" name="metode_bayar" value="dana">
                            <div class="pay-icon" style="background:#e8f1ff;">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/72/Logo_dana_blue.svg/1200px-Logo_dana_blue.svg.png" style="width:28px;height:28px;object-fit:contain;" alt="Dana">
                            </div>
                            <div>
                                <div class="pay-name">Dana</div>
                            </div>
                            <div class="pay-check"></div>
                        </div>

                        <div class="pay-option" onclick="selectPay(this,'tunai')">
                            <input type="radio" name="metode_bayar" value="tunai">
                            <div class="pay-icon" style="background:rgba(255,255,255,.06);">
                                <i class="fas fa-cash-register" style="color:var(--text-muted);"></i>
                            </div>
                            <div>
                                <div class="pay-name">Bayar Tunai di Kasir</div>
                            </div>
                            <div class="pay-check"></div>
                        </div>

                    </div>
                </div>

                {{-- Pay button --}}
                <button type="submit" class="btn-pay" id="btn-pay">
                    <span id="btn-pay-label">Bayar Rp 2.000 Now</span>
                    <span class="sparkle">✦</span>
                </button>

            </div>
        </div>

        {{-- Hidden items injected by JS --}}
        <div id="hidden-items"></div>
    </form>
</div>
@endsection

@section('page-scripts')
<script>
/* ── Menu data from server (for foto lookup) ── */
const serverMenus = {
    @foreach($menus as $menu)
    {{ $menu->id }}: {
        foto: '{{ $menu->foto ? Storage::url($menu->foto) : '' }}',
        status: '{{ $menu->stock > 0 ? "tersedia" : "habis" }}'
    },
    @endforeach
};

const CART_KEY    = 'ecanteen-cart-{{ auth()->id() }}';
const BIAYA_LAYANAN = 2000;

function loadCart() {
    try { return JSON.parse(localStorage.getItem(CART_KEY)) || {}; }
    catch(e) { return {}; }
}
function saveCart(cart) {
    localStorage.setItem(CART_KEY, JSON.stringify(cart));
    renderPage();
    updateNavCartBadge(cart);
}
function updateNavCartBadge(cart) {
    const total = Object.values(cart).reduce((s, i) => s + i.qty, 0);
    const badge = document.getElementById('nav-cart-badge');
    if (badge) { badge.textContent = total; badge.style.display = total > 0 ? 'flex' : 'none'; }
}

function changeQty(id, delta) {
    const cart = loadCart();
    if (!cart[id]) return;
    cart[id].qty = Math.max(0, cart[id].qty + delta);
    if (cart[id].qty === 0) delete cart[id];
    saveCart(cart);
}

function renderPage() {
    const cart     = loadCart();
    const keys     = Object.keys(cart);
    const list     = document.getElementById('order-items-list');
    const empty    = document.getElementById('empty-cart');
    const hidden   = document.getElementById('hidden-items');
    const btnPay   = document.getElementById('btn-pay');

    if (keys.length === 0) {
        list.innerHTML  = '';
        hidden.innerHTML = '';
        empty.style.display = '';
        btnPay.disabled = true;
        document.getElementById('cost-subtotal').textContent = 'Rp 0';
        document.getElementById('cost-total').textContent = 'Rp ' + BIAYA_LAYANAN.toLocaleString('id-ID');
        document.getElementById('btn-pay-label').textContent = 'Bayar Rp ' + BIAYA_LAYANAN.toLocaleString('id-ID') + ' Now';
        return;
    }

    empty.style.display = 'none';
    btnPay.disabled = false;

    let subtotal = 0;
    let itemsHTML = '';
    let hiddenHTML = '';

    keys.forEach(function(id, idx) {
        const item = cart[id];
        subtotal += item.qty * item.harga;
        const sub = item.qty * item.harga;
        const srv  = serverMenus[id];
        const foto = srv && srv.foto ? srv.foto : '';

        itemsHTML +=
            '<div class="order-item">' +
                '<div class="oi-thumb">' +
                    (foto ? '<img src="' + foto + '" alt="">' : '<i class="fas fa-bowl-food"></i>') +
                '</div>' +
                '<div class="oi-body">' +
                    '<div class="oi-name">' + item.nama + '</div>' +
                    '<div class="oi-price">Rp ' + item.harga.toLocaleString('id-ID') + '</div>' +
                    '<textarea class="oi-note" rows="2" placeholder="Tambahkan Catatan..." id="note-' + id + '" oninput="syncNotes()"></textarea>' +
                '</div>' +
                '<div class="oi-right">' +
                    '<div>' +
                        '<div class="oi-sub-label">Subtotal</div>' +
                        '<div class="oi-sub-val">Rp ' + sub.toLocaleString('id-ID') + '</div>' +
                    '</div>' +
                    '<div class="oi-qty">' +
                        '<button type="button" onclick="changeQty(' + id + ',-1)"><i class="fas fa-minus" style="font-size:.6rem;"></i></button>' +
                        '<span>' + item.qty + 'x</span>' +
                        '<button type="button" onclick="changeQty(' + id + ',1)"><i class="fas fa-plus" style="font-size:.6rem;"></i></button>' +
                    '</div>' +
                '</div>' +
            '</div>';

        hiddenHTML +=
            '<input type="hidden" name="items[' + idx + '][menu_id]" value="' + id + '">' +
            '<input type="hidden" name="items[' + idx + '][jumlah]"  value="' + item.qty + '">' +
            '<input type="hidden" name="items[' + idx + '][catatan]" id="h-note-' + idx + '" value="">';
    });

    list.innerHTML  = itemsHTML;
    hidden.innerHTML = hiddenHTML;

    const total = subtotal + BIAYA_LAYANAN;
    document.getElementById('cost-subtotal').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
    document.getElementById('cost-total').textContent    = 'Rp ' + total.toLocaleString('id-ID');
    document.getElementById('btn-pay-label').textContent = 'Bayar Rp ' + total.toLocaleString('id-ID') + ' Now';

    syncNotes();
}

function syncNotes() {
    const cart = loadCart();
    const keys = Object.keys(cart);
    keys.forEach(function(id, idx) {
        const ta = document.getElementById('note-' + id);
        const hi = document.getElementById('h-note-' + idx);
        if (ta && hi) hi.value = ta.value;
    });
}

function selectPay(el, val) {
    document.querySelectorAll('.pay-option').forEach(o => o.classList.remove('selected'));
    el.classList.add('selected');
    el.querySelector('input[type=radio]').checked = true;
}

/* Clear cart after successful submit */
document.getElementById('checkout-form').addEventListener('submit', function() {
    const cart = loadCart();
    const keys = Object.keys(cart);
    // sync notes one final time before submit
    keys.forEach(function(id, idx) {
        const ta = document.getElementById('note-' + id);
        const hi = document.getElementById('h-note-' + idx);
        if (ta && hi) hi.value = ta.value;
    });
    // Clear cart from localStorage after form submit
    setTimeout(function() {
        localStorage.removeItem(CART_KEY);
    }, 300);
});

renderPage();

Object.assign(window.T.id, { 'page.title': 'Checkout' });
Object.assign(window.T.en, { 'page.title': 'Checkout' });
window.applyLang(window.currentLang);
</script>
@endsection
