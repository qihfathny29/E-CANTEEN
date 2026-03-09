@extends('layouts.user')
@section('title', 'Pre-Order')

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