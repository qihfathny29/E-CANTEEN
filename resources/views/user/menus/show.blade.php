@extends('layouts.user')
@section('title', $menu->nama_menu)

@section('page-styles')
        .page-wrap{padding:2rem 1.75rem;}

        /* ── Back link ── */
        .back-link{display:inline-flex;align-items:center;gap:.45rem;font-size:.85rem;font-weight:600;color:var(--text-muted);text-decoration:none;margin-bottom:1.5rem;transition:color .15s;}
        .back-link:hover{color:var(--text);}

        /* ── Detail card ── */
        .detail-card{background:var(--bg-card);border:1px solid var(--border);border-radius:1.25rem;overflow:hidden;display:flex;gap:0;}
        @media(min-width:640px){.detail-card{flex-direction:row;}}
        @media(max-width:639px){.detail-card{flex-direction:column;}}

        /* ── Photo panel ── */
        .detail-photo{flex:0 0 320px;position:relative;background:var(--bg-card2);}
        @media(max-width:639px){.detail-photo{flex:none;height:220px;}}
        .detail-photo img{width:100%;height:100%;object-fit:cover;display:block;}
        .detail-photo-placeholder{width:100%;height:100%;display:flex;align-items:center;justify-content:center;min-height:220px;}

        /* ── Info panel ── */
        .detail-info{flex:1;padding:2rem 1.75rem;display:flex;flex-direction:column;gap:1.1rem;}

        .detail-name{font-size:1.55rem;font-weight:700;color:var(--text);line-height:1.25;}

        .detail-price{font-size:1.3rem;font-weight:700;color:var(--red);}

        /* ── Badges row ── */
        .detail-badges{display:flex;flex-wrap:wrap;gap:.5rem;align-items:center;}
        .badge{display:inline-flex;align-items:center;gap:.3rem;padding:.3rem .75rem;border-radius:999px;font-size:.78rem;font-weight:600;}
        .badge-cat{background:color-mix(in srgb,var(--red) 12%,transparent);color:var(--red);}
        .badge-pedas{background:#ff6b3520;color:#e55a28;}
        .badge-manis{background:#7c3aed20;color:#7c3aed;}
        .badge-stock-ok{background:#16a34a18;color:#16a34a;}
        .badge-stock-out{background:#ef444420;color:#ef4444;}

        /* ── Divider ── */
        .detail-divider{height:1px;background:var(--border);}

        /* ── Action button ── */
        .btn-order{display:inline-flex;align-items:center;gap:.5rem;background:var(--red);color:#fff;border:none;border-radius:.75rem;padding:.8rem 1.5rem;font-size:.95rem;font-weight:700;text-decoration:none;cursor:pointer;transition:background .15s,transform .1s;}
        .btn-order:hover{background:var(--red-h);transform:translateY(-1px);}
        .btn-order.disabled{background:var(--border-md);color:var(--text-muted);pointer-events:none;}
@endsection

@section('content')
<div class="page-wrap">

    <a href="{{ route('user.menus.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Kembali ke Menu
    </a>

    <div class="detail-card">
        {{-- Photo --}}
        <div class="detail-photo">
            @if($menu->foto)
                <img src="{{ Storage::url($menu->foto) }}" alt="{{ $menu->nama_menu }}">
            @else
                <div class="detail-photo-placeholder">
                    <i class="fas fa-bowl-food" style="font-size:4rem;color:var(--text-muted);"></i>
                </div>
            @endif
        </div>

        {{-- Info --}}
        <div class="detail-info">
            <div>
                <div class="detail-name">{{ $menu->nama_menu }}</div>
            </div>

            <div class="detail-price">Rp {{ number_format($menu->harga, 0, ',', '.') }}</div>

            <div class="detail-badges">
                {{-- Kategori --}}
                @if($menu->kategori)
                    @php
                        $catLabels = ['makanan' => 'Makanan', 'minuman' => 'Minuman', 'snack' => 'Snack'];
                        $catLabel  = $catLabels[$menu->kategori] ?? ucfirst($menu->kategori);
                    @endphp
                    <span class="badge badge-cat">
                        @if($menu->kategori === 'makanan') <i class="fas fa-utensils"></i>
                        @elseif($menu->kategori === 'minuman') <i class="fas fa-glass-water"></i>
                        @else <i class="fas fa-cookie-bite"></i>
                        @endif
                        {{ $catLabel }}
                    </span>
                @endif

                {{-- Pedas / Manis --}}
                @if($menu->is_pedas)
                    @if($menu->kategori === 'minuman')
                        <span class="badge badge-manis">🍬 Manis</span>
                    @else
                        <span class="badge badge-pedas"><i class="fas fa-fire"></i> Pedas</span>
                    @endif
                @endif

                {{-- Stock --}}
                @if($menu->stock > 0)
                    <span class="badge badge-stock-ok"><i class="fas fa-circle-check"></i> Tersedia ({{ $menu->stock }} porsi)</span>
                @else
                    <span class="badge badge-stock-out"><i class="fas fa-circle-xmark"></i> Habis</span>
                @endif
            </div>

            <div class="detail-divider"></div>

            @if($menu->stock > 0)
                <a href="{{ route('user.orders.create') }}" class="btn-order">
                    <i class="fas fa-cart-plus"></i> Pesan di Pre-Order
                </a>
            @else
                <span class="btn-order disabled">
                    <i class="fas fa-ban"></i> Sedang Tidak Tersedia
                </span>
            @endif
        </div>
    </div>

</div>
@endsection
