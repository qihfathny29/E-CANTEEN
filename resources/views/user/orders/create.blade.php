@extends('layouts.user')
@section('title', 'Pre-Order')

@section('page-styles')
        .page-wrap{padding:2rem 1.75rem 6rem;}
        .page-header{margin-bottom:1.5rem;}
        .page-header h1{font-family:var(--font-d);font-size:1.4rem;font-weight:800;color:var(--text);letter-spacing:-.03em;}
        .saldo-badge{display:inline-flex;align-items:center;gap:.4rem;font-family:var(--font-d);font-size:.82rem;font-weight:700;background:rgba(74,222,128,.1);color:#4ade80;border:1px solid rgba(74,222,128,.25);padding:.3rem .8rem;border-radius:100px;margin-top:.6rem;}
        .flash{border-radius:.75rem;padding:.85rem 1.1rem;margin-bottom:1.5rem;font-size:.875rem;display:flex;align-items:center;gap:.65rem;}
        .flash-error{background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.25);color:#f87171;}

        /* Waktu section */
        .waktu-section{background:var(--bg-card);border:1px solid var(--border);border-radius:1rem;padding:1rem 1.4rem;margin-bottom:1.25rem;}
        .waktu-label{font-family:var(--font-d);font-size:.75rem;font-weight:700;letter-spacing:.07em;text-transform:uppercase;color:var(--text-muted);margin-bottom:.65rem;display:flex;align-items:center;gap:.45rem;}
        .radio-group{display:flex;gap:.75rem;}
        .radio-label{display:flex;align-items:center;gap:.55rem;font-size:.88rem;font-weight:500;color:var(--text-sub);cursor:pointer;padding:.55rem 1rem;border:1px solid var(--border-md);border-radius:.6rem;transition:all .2s;flex:1;}
        .radio-label:has(input:checked){background:rgba(192,57,43,.1);border-color:rgba(192,57,43,.4);color:var(--text);}
        .radio-label input{accent-color:var(--red);}

        /* Filter bar */
        .filter-bar{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem;margin-bottom:1.5rem;border-bottom:1px solid var(--border);}
        .tab-group{display:flex;gap:0;flex-wrap:wrap;}
        .tab-btn{font-family:var(--font-d);font-size:.82rem;font-weight:600;padding:.6rem 1.1rem;border:none;border-bottom:2px solid transparent;background:none;color:var(--text-muted);cursor:pointer;transition:all .18s;white-space:nowrap;margin-bottom:-1px;}
        .tab-btn:hover{color:var(--text);}
        .tab-btn.active{color:var(--text);border-bottom-color:var(--red);}
        .spicy-filter{display:flex;align-items:center;gap:0;margin-bottom:-1px;}
        .spicy-btn{font-family:var(--font-d);font-size:.78rem;font-weight:600;padding:.55rem .85rem;border:none;border-bottom:2px solid transparent;background:none;color:var(--text-muted);cursor:pointer;transition:all .18s;white-space:nowrap;}
        .spicy-btn:hover{color:var(--text);}
        .spicy-btn.active{color:#ef4444;border-bottom-color:#ef4444;}

        /* Grid */
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
        .menu-foot{display:flex;align-items:center;justify-content:space-between;margin-top:.35rem;padding-top:.65rem;border-top:1px solid var(--border);}
        .menu-price{font-family:var(--font-d);font-size:.95rem;font-weight:800;color:#4ade80;}

        /* Qty controls inside card */
        .po-qty-wrap{display:inline-flex;align-items:center;gap:.45rem;}
        .qty-btn{width:26px;height:26px;border-radius:.35rem;border:1px solid var(--border-md);background:var(--bg-card2);color:var(--text);font-size:.8rem;cursor:pointer;transition:all .18s;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
        .qty-btn:hover{background:var(--red);border-color:var(--red);color:white;}
        .qty-display{font-family:var(--font-d);font-size:.82rem;font-weight:700;color:var(--text);min-width:22px;text-align:center;}
        .qty-display.active{color:var(--red);}

        /* Empty state */
        .empty-state{background:var(--bg-card);border:1px solid var(--border);border-radius:1rem;padding:4rem 2rem;text-align:center;grid-column:1/-1;}
        .empty-state i{font-size:2rem;color:var(--text-muted);display:block;margin-bottom:1rem;opacity:.35;}
        .empty-state p{font-size:.9rem;color:var(--text-muted);}
        #empty-filter{display:none;}

        /* Sticky bottom bar */
        .sticky-bar{position:fixed;bottom:0;left:var(--sidebar-w);right:0;z-index:90;padding:1rem 1.75rem;background:var(--nav-bg);backdrop-filter:blur(14px);border-top:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;gap:1rem;transform:translateY(110%);transition:transform .3s cubic-bezier(.4,0,.2,1);}
        .sticky-bar.show{transform:translateY(0);}
        .sticky-info{display:flex;align-items:center;gap:.75rem;}
        .sticky-icon{width:38px;height:38px;background:var(--red);border-radius:.55rem;display:flex;align-items:center;justify-content:center;color:white;font-size:.9rem;flex-shrink:0;}
        .sticky-count{font-family:var(--font-d);font-size:.82rem;font-weight:600;color:var(--text-muted);}
        .sticky-total{font-family:var(--font-d);font-size:1rem;font-weight:800;color:var(--text);}
        .sticky-btn{display:inline-flex;align-items:center;gap:.5rem;font-family:var(--font-d);font-size:.85rem;font-weight:700;padding:.55rem 1.35rem;border-radius:.6rem;background:var(--red);color:white;border:none;cursor:pointer;transition:background .18s;}
        .sticky-btn:hover{background:var(--red-h);}
@endsection

@section('content')
<div class="page-wrap">
    <div class="page-header">
        <h1 data-i18n="page.title">Pre-Order</h1>
        <div class="saldo-badge"><i class="fas fa-wallet"></i> <span data-i18n="page.balance_label">Saldo</span>: Rp {{ number_format(auth()->user()->saldo, 0, ',', '.') }}</div>
    </div>

    @if(session('error'))
        <div class="flash flash-error"><i class="fas fa-circle-exclamation"></i> {{ session('error') }}</div>
    @endif

    <form action="{{ route('user.orders.store') }}" method="POST" id="order-form">
        @csrf

        {{-- Waktu ambil --}}
        <div class="waktu-section">
            <div class="waktu-label"><i class="fas fa-clock"></i> <span data-i18n="section.pickup_time">Waktu Pengambilan</span></div>
            <div class="radio-group">
                <label class="radio-label">
                    <input type="radio" name="waktu_ambil" value="istirahat_1" checked>
                    <i class="fas fa-sun" style="color:var(--text-muted);"></i> <span data-i18n="radio.break1">Istirahat 1</span>
                </label>
                <label class="radio-label">
                    <input type="radio" name="waktu_ambil" value="istirahat_2">
                    <i class="fas fa-cloud-sun" style="color:var(--text-muted);"></i> <span data-i18n="radio.break2">Istirahat 2</span>
                </label>
            </div>
        </div>

        {{-- Filter bar --}}
        <div class="filter-bar">
            <div class="tab-group" id="tab-group">
                <button type="button" class="tab-btn active" data-cat="semua">Semua</button>
                <button type="button" class="tab-btn" data-cat="makanan_utama">Makanan Utama</button>
                <button type="button" class="tab-btn" data-cat="minuman">Minuman</button>
                <button type="button" class="tab-btn" data-cat="cemilan">Cemilan</button>
                <button type="button" class="tab-btn" data-cat="spesial_promo">Spesial Promo</button>
            </div>
            <div class="spicy-filter" id="spicy-group">
                <button type="button" class="spicy-btn active" data-spicy="semua">Semua</button>
                <button type="button" class="spicy-btn" data-spicy="pedas">🌶 Pedas</button>
                <button type="button" class="spicy-btn" data-spicy="tidak_pedas">Tidak Pedas</button>
            </div>
        </div>

        {{-- Menu grid --}}
        <div class="menu-grid" id="menu-grid">
            @forelse($menus as $index => $menu)
            <div class="menu-card"
                 data-cat="{{ $menu->kategori }}"
                 data-pedas="{{ $menu->is_pedas ? 'pedas' : 'tidak_pedas' }}">
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
                        {{-- Hidden inputs always present so form always submits all items --}}
                        <input type="hidden" name="items[{{ $index }}][menu_id]" value="{{ $menu->id }}">
                        <input type="hidden" name="items[{{ $index }}][jumlah]" class="qty-val" id="qty-{{ $index }}" data-harga="{{ $menu->harga }}" data-id="{{ $menu->id }}" data-nama="{{ $menu->nama_menu }}" value="0">
                        @if($menu->stock > 0)
                        <div class="po-qty-wrap">
                            <button type="button" class="qty-btn" onclick="chQty({{ $index }}, -1)"><i class="fas fa-minus" style="font-size:.65rem;"></i></button>
                            <span class="qty-display" id="qd-{{ $index }}">0</span>
                            <button type="button" class="qty-btn" onclick="chQty({{ $index }}, 1)"><i class="fas fa-plus" style="font-size:.65rem;"></i></button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <i class="fas fa-bowl-food"></i>
                <p>Tidak ada menu tersedia saat ini.</p>
            </div>
            @endforelse
            <div class="empty-state" id="empty-filter">
                <i class="fas fa-magnifying-glass"></i>
                <p id="empty-filter-text">Tidak ada produk di kategori ini.</p>
            </div>
        </div>

    </form>
</div>

{{-- Sticky bar (outside form, triggers JS submit) --}}
<div class="sticky-bar" id="sticky-bar">
    <div class="sticky-info">
        <div class="sticky-icon"><i class="fas fa-receipt"></i></div>
        <div>
            <div class="sticky-count" id="sticky-count">0 item dipilih</div>
            <div class="sticky-total" id="sticky-total">Rp 0</div>
        </div>
    </div>
    <button type="button" class="sticky-btn" onclick="submitOrder()">
        <i class="fas fa-check" style="font-size:.75rem;"></i> <span data-i18n="btn.confirm">Konfirmasi Pesanan</span>
    </button>
</div>
@endsection

@section('page-scripts')
<script>
    function chQty(idx, delta) {
        const input   = document.getElementById('qty-' + idx);
        const display = document.getElementById('qd-' + idx);
        const v = Math.min(10, Math.max(0, (parseInt(input.value) || 0) + delta));
        input.value = v;
        if (display) {
            display.textContent = v;
            display.classList.toggle('active', v > 0);
        }
        updateSticky();
    }

    function updateSticky() {
        let totalQty = 0, totalHarga = 0;
        document.querySelectorAll('.qty-val').forEach(function(el) {
            const q = parseInt(el.value) || 0;
            const h = parseInt(el.dataset.harga) || 0;
            totalQty  += q;
            totalHarga += q * h;
        });
        document.getElementById('sticky-count').textContent = totalQty + ' item dipilih';
        document.getElementById('sticky-total').textContent = 'Rp ' + totalHarga.toLocaleString('id-ID');
        const bar = document.getElementById('sticky-bar');
        if (totalQty > 0) bar.classList.add('show');
        else bar.classList.remove('show');
    }

    function submitOrder() {
        const cartKey = 'ecanteen-cart-{{ auth()->id() }}';
        const cart = {};

        document.querySelectorAll('.qty-val').forEach(function(el) {
            const qty = parseInt(el.value) || 0;
            if (qty > 0) {
                const id    = el.dataset.id;
                const harga = parseInt(el.dataset.harga) || 0;
                const nama  = el.dataset.nama;
                cart[id] = { qty: qty, harga: harga, nama: nama };
            }
        });

        if (Object.keys(cart).length === 0) {
            alert('Pilih minimal 1 menu terlebih dahulu.');
            return;
        }

        localStorage.setItem(cartKey, JSON.stringify(cart));
        window.location.href = '{{ route("user.checkout.index") }}';
    }

    /* ── Tab & spicy filter ── */
    let activeCat = 'semua', activeSpicy = 'semua';

    function applyFilters() {
        var visible = 0;
        document.querySelectorAll('#menu-grid .menu-card').forEach(function(card) {
            const catMatch   = activeCat === 'semua'   || card.dataset.cat   === activeCat;
            const spicyMatch = activeSpicy === 'semua' || card.dataset.pedas === activeSpicy;
            const show = catMatch && spicyMatch;
            card.style.display = show ? '' : 'none';
            if (show) visible++;
        });
        var emptyEl = document.getElementById('empty-filter');
        if (emptyEl) emptyEl.style.display = visible === 0 ? '' : 'none';
    }

    document.querySelectorAll('#tab-group .tab-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            document.querySelectorAll('#tab-group .tab-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            activeCat = btn.dataset.cat;
            var isMinuman = activeCat === 'minuman';
            document.querySelector('.spicy-btn[data-spicy="pedas"]').innerHTML    = isMinuman ? '🍬 Manis' : '🌶 Pedas';
            document.querySelector('.spicy-btn[data-spicy="tidak_pedas"]').textContent = isMinuman ? 'Tidak Manis' : 'Tidak Pedas';
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

    Object.assign(window.T.id, {
        'page.title': 'Pre-Order',
        'page.balance_label': 'Saldo',
        'section.pickup_time': 'Waktu Pengambilan',
        'radio.break1': 'Istirahat 1',
        'radio.break2': 'Istirahat 2',
        'btn.confirm': 'Konfirmasi Pesanan',
    });
    Object.assign(window.T.en, {
        'page.title': 'Pre-Order',
        'page.balance_label': 'Balance',
        'section.pickup_time': 'Pickup Time',
        'radio.break1': 'Break 1',
        'radio.break2': 'Break 2',
        'btn.confirm': 'Confirm Order',
    });
    window.applyLang(window.currentLang);
</script>
@endsection

@section('page-styles')
        .page-wrap{padding:2rem;}
        .page-header{margin-bottom:1.75rem;}
        .page-header h1{font-family:var(--font-d);font-size:1.4rem;font-weight:800;color:var(--text);letter-spacing:-.03em;}
        .saldo-badge{display:inline-flex;align-items:center;gap:.4rem;font-family:var(--font-d);font-size:.82rem;font-weight:700;background:rgba(74,222,128,.1);color:#4ade80;border:1px solid rgba(74,222,128,.25);padding:.3rem .8rem;border-radius:100px;margin-top:.6rem;}
        .flash{border-radius:.75rem;padding:.85rem 1.1rem;margin-bottom:1.5rem;font-size:.875rem;display:flex;align-items:center;gap:.65rem;}
        .flash-error{background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.25);color:#f87171;}
        .section-card{background:var(--bg-card);border:1px solid var(--border);border-radius:1rem;margin-bottom:1.1rem;overflow:hidden;}
        .section-title{padding:1rem 1.4rem;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:.6rem;}
        .section-title span{font-family:var(--font-d);font-size:.88rem;font-weight:700;color:var(--text);}
        .section-icon{width:28px;height:28px;border-radius:.4rem;background:rgba(192,57,43,.15);color:var(--red);display:grid;place-items:center;font-size:.78rem;}
        .radio-group{display:flex;gap:.75rem;padding:1.1rem 1.4rem;}
        .radio-label{display:flex;align-items:center;gap:.55rem;font-size:.88rem;font-weight:500;color:var(--text-sub);cursor:pointer;padding:.55rem 1rem;border:1px solid var(--border-md);border-radius:.6rem;transition:all .2s;flex:1;}
        .radio-label:has(input:checked){background:rgba(192,57,43,.1);border-color:rgba(192,57,43,.4);color:var(--text);}
        .radio-label input{accent-color:var(--red);}
        .menu-row{display:flex;align-items:center;justify-content:space-between;padding:.8rem 1.4rem;border-bottom:1px solid var(--border);transition:background .15s;}
        .menu-row:last-child{border-bottom:none;}
        .menu-row:hover{background:var(--bg-card2);}
        .menu-row-left{display:flex;align-items:center;gap:.75rem;}
        .menu-thumb{width:38px;height:38px;border-radius:.5rem;object-fit:cover;}
        .menu-thumb-placeholder{width:38px;height:38px;border-radius:.5rem;background:var(--bg-card2);display:flex;align-items:center;justify-content:center;color:var(--text-muted);font-size:.9rem;}
        .menu-row-name{font-size:.88rem;font-weight:600;color:var(--text);}
        .menu-row-price{font-size:.78rem;color:#4ade80;margin-top:.1rem;}
        .qty-wrap{display:flex;align-items:center;gap:.4rem;}
        .qty-btn{width:28px;height:28px;border-radius:.4rem;border:1px solid var(--border-md);background:var(--bg-card2);color:var(--text-sub);cursor:pointer;font-size:.9rem;display:flex;align-items:center;justify-content:center;transition:all .2s;}
        .qty-btn:hover{border-color:var(--red);color:var(--red);}
        .qty-input{width:42px;text-align:center;background:var(--input-bg);border:1px solid var(--border-md);border-radius:.4rem;color:var(--text);font-family:var(--font-b);font-size:.88rem;padding:.25rem 0;outline:none;}
        .qty-input:focus{border-color:rgba(192,57,43,.5);}
        .total-bar{background:var(--bg-card);border:1px solid var(--border);border-radius:1rem;padding:1.1rem 1.4rem;margin-bottom:1.1rem;display:flex;justify-content:space-between;align-items:center;}
        .total-label{font-family:var(--font-d);font-size:.88rem;font-weight:600;color:var(--text-sub);}
        .total-val{font-family:var(--font-d);font-size:1.2rem;font-weight:800;color:#4ade80;}
        .btn-submit{width:100%;padding:.75rem;border-radius:.6rem;background:var(--red);color:white;font-family:var(--font-d);font-size:.9rem;font-weight:700;border:none;cursor:pointer;transition:background .2s;}
        .btn-submit:hover{background:var(--red-h);}
@endsection

@section('content')
<div class="page-wrap">
    <div class="page-header">
        <h1 data-i18n="page.title">Pre-Order</h1>
        <div class="saldo-badge"><i class="fas fa-wallet"></i> <span data-i18n="page.balance_label">Saldo</span>: Rp {{ number_format(auth()->user()->saldo, 0, ',', '.') }}</div>
    </div>

    @if(session('error'))
        <div class="flash flash-error"><i class="fas fa-circle-exclamation"></i> {{ session('error') }}</div>
    @endif

    <form action="{{ route('user.orders.store') }}" method="POST">
        @csrf
        <div class="section-card">
            <div class="section-title">
                <div class="section-icon"><i class="fas fa-clock"></i></div>
                <span data-i18n="section.pickup_time">Waktu Pengambilan</span>
            </div>
            <div class="radio-group">
                <label class="radio-label">
                    <input type="radio" name="waktu_ambil" value="istirahat_1" checked>
                    <i class="fas fa-sun" style="color:var(--text-muted);"></i> <span data-i18n="radio.break1">Istirahat 1</span>
                </label>
                <label class="radio-label">
                    <input type="radio" name="waktu_ambil" value="istirahat_2">
                    <i class="fas fa-cloud-sun" style="color:var(--text-muted);"></i> <span data-i18n="radio.break2">Istirahat 2</span>
                </label>
            </div>
        </div>

        <div class="section-card">
            <div class="section-title">
                <div class="section-icon"><i class="fas fa-bowl-food"></i></div>
                <span data-i18n="section.select_menu">Pilih Menu</span>
            </div>
            @foreach($menus as $index => $menu)
            <div class="menu-row">
                <div class="menu-row-left">
                    @if($menu->foto)
                        <img src="{{ Storage::url($menu->foto) }}" class="menu-thumb" alt="{{ $menu->nama_menu }}">
                    @else
                        <div class="menu-thumb-placeholder"><i class="fas fa-bowl-food"></i></div>
                    @endif
                    <div>
                        <div class="menu-row-name">{{ $menu->nama_menu }}</div>
                        <div class="menu-row-price">Rp {{ number_format($menu->harga, 0, ',', '.') }}</div>
                    </div>
                </div>
                <div class="qty-wrap">
                    <input type="hidden" name="items[{{ $index }}][menu_id]" value="{{ $menu->id }}">
                    <button type="button" class="qty-btn" onclick="changeQty(this,-1)"><i class="fas fa-minus" style="font-size:.7rem;"></i></button>
                    <input type="number" name="items[{{ $index }}][jumlah]" value="0" min="0" max="10"
                           class="qty-input" onchange="hitungTotal()" oninput="hitungTotal()">
                    <button type="button" class="qty-btn" onclick="changeQty(this,1)"><i class="fas fa-plus" style="font-size:.7rem;"></i></button>
                </div>
            </div>
            @endforeach
        </div>

        <div class="total-bar">
            <span class="total-label" data-i18n="total.label">Total Pembayaran</span>
            <span class="total-val" id="totalHarga">Rp 0</span>
        </div>

        <button type="submit" class="btn-submit"><i class="fas fa-check" style="margin-right:.45rem;"></i><span data-i18n="btn.confirm">Konfirmasi Pesanan</span></button>
    </form>
</div>
@endsection

@section('page-scripts')
<script>
    const hargaMenus = {
        @foreach($menus as $index => $menu)
            {{ $index }}: {{ $menu->harga }},
        @endforeach
    };
    function hitungTotal(){
        let t=0;
        document.querySelectorAll('.qty-input').forEach((el,i)=>{t+=(parseInt(el.value)||0)*(hargaMenus[i]||0);});
        document.getElementById('totalHarga').textContent='Rp '+t.toLocaleString('id-ID');
    }
    function changeQty(btn,delta){
        const input=btn.parentElement.querySelector('.qty-input');
        const v=Math.min(10,Math.max(0,(parseInt(input.value)||0)+delta));
        input.value=v;hitungTotal();
    }
    Object.assign(window.T.id, {
        'page.title': 'Pre-Order',
        'page.balance_label': 'Saldo',
        'section.pickup_time': 'Waktu Pengambilan',
        'radio.break1': 'Istirahat 1',
        'radio.break2': 'Istirahat 2',
        'section.select_menu': 'Pilih Menu',
        'total.label': 'Total Pembayaran',
        'btn.confirm': 'Konfirmasi Pesanan',
    });
    Object.assign(window.T.en, {
        'page.title': 'Pre-Order',
        'page.balance_label': 'Balance',
        'section.pickup_time': 'Pickup Time',
        'radio.break1': 'Break 1',
        'radio.break2': 'Break 2',
        'section.select_menu': 'Select Menu',
        'total.label': 'Total Payment',
        'btn.confirm': 'Confirm Order',
    });
    window.applyLang(window.currentLang);
</script>
@endsection