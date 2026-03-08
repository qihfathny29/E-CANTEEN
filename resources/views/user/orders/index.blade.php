@extends('layouts.user')
@section('title', 'Riwayat Pesanan')

@section('page-styles')
        .page-wrap{max-width:740px;margin:0 auto;padding:2rem;}
        .page-header{margin-bottom:1.75rem;}
        .page-header h1{font-family:var(--font-d);font-size:1.4rem;font-weight:800;color:var(--text);letter-spacing:-.03em;}
        .page-header p{font-size:.85rem;color:var(--text-muted);margin-top:.2rem;}
        .flash{border-radius:.75rem;padding:.85rem 1.1rem;margin-bottom:1.5rem;font-size:.875rem;display:flex;align-items:center;gap:.65rem;}
        .flash-success{background:rgba(34,197,94,.10);border:1px solid rgba(34,197,94,.25);color:#4ade80;}
        .order-card{background:var(--bg-card);border:1px solid var(--border);border-radius:1rem;padding:1.4rem;margin-bottom:1rem;transition:border-color .2s;}
        .order-card:hover{border-color:var(--border-md);}
        .order-header{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:.9rem;gap:.75rem;}
        .order-date{font-size:.8rem;color:var(--text-muted);}
        .order-waktu{display:inline-flex;align-items:center;gap:.3rem;font-family:var(--font-d);font-size:.68rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;background:var(--bg-card2);border:1px solid var(--border-md);color:var(--text-sub);padding:.2rem .6rem;border-radius:100px;margin-top:.3rem;}
        .badge-pending{display:inline-flex;align-items:center;gap:.3rem;font-family:var(--font-d);font-size:.7rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;background:rgba(234,179,8,.12);color:#facc15;border:1px solid rgba(234,179,8,.25);padding:.22rem .7rem;border-radius:100px;}
        .badge-disiapkan{display:inline-flex;align-items:center;gap:.3rem;font-family:var(--font-d);font-size:.7rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;background:rgba(59,130,246,.12);color:#60a5fa;border:1px solid rgba(59,130,246,.25);padding:.22rem .7rem;border-radius:100px;}
        .badge-siap{display:inline-flex;align-items:center;gap:.3rem;font-family:var(--font-d);font-size:.7rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;background:rgba(34,197,94,.12);color:#4ade80;border:1px solid rgba(34,197,94,.25);padding:.22rem .7rem;border-radius:100px;}
        .badge-selesai{display:inline-flex;align-items:center;gap:.3rem;font-family:var(--font-d);font-size:.7rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;background:rgba(255,255,255,.07);color:var(--text-muted);border:1px solid var(--border-md);padding:.22rem .7rem;border-radius:100px;}
        .items-section{border-top:1px solid var(--border);padding-top:.8rem;margin-bottom:.8rem;}
        .item-row{display:flex;justify-content:space-between;align-items:center;padding:.28rem 0;font-size:.85rem;color:var(--text-sub);}
        .order-footer{border-top:1px solid var(--border);padding-top:.8rem;display:flex;justify-content:space-between;align-items:center;}
        .order-total{font-family:var(--font-d);font-size:.95rem;font-weight:800;color:var(--text);}
        .order-total span{color:#4ade80;}
        .empty-state{background:var(--bg-card);border:1px solid var(--border);border-radius:1rem;padding:4rem 2rem;text-align:center;}
        .empty-state i{font-size:2rem;color:var(--text-muted);display:block;margin-bottom:1rem;opacity:.35;}
        .empty-state p{font-size:.9rem;color:var(--text-muted);margin-bottom:.75rem;}
        .empty-link{font-family:var(--font-d);font-size:.82rem;font-weight:700;color:var(--red);text-decoration:none;}
        .empty-link:hover{color:var(--red-h);}
@endsection

@section('content')
<div class="page-wrap">
    <div class="page-header">
        <h1 data-i18n="page.title">Riwayat Pesanan</h1>
        <p data-i18n="page.subtitle">Lihat semua pesanan yang pernah kamu buat.</p>
    </div>

    @if(session('success'))
        <div class="flash flash-success"><i class="fas fa-circle-check"></i> {{ session('success') }}</div>
    @endif

    @forelse($orders as $order)
    <div class="order-card">
        <div class="order-header">
            <div>
                <div class="order-date">{{ $order->created_at->format('d M Y, H:i') }}</div>
                <div class="order-waktu"><i class="fas fa-clock" style="font-size:.55rem;"></i>{{ $order->waktu_ambil === 'istirahat_1' ? 'Istirahat 1' : 'Istirahat 2' }}</div>
            </div>
            @if($order->status === 'pending')
                <span class="badge-pending"><i class="fas fa-circle" style="font-size:.4rem;"></i> Pending</span>
            @elseif($order->status === 'sedang_disiapkan')
                <span class="badge-disiapkan"><i class="fas fa-circle" style="font-size:.4rem;"></i> Sedang Disiapkan</span>
            @elseif($order->status === 'siap_diambil')
                <span class="badge-siap"><i class="fas fa-circle" style="font-size:.4rem;"></i> Siap Diambil</span>
            @elseif($order->status === 'selesai')
                <span class="badge-selesai"><i class="fas fa-circle" style="font-size:.4rem;"></i> Selesai</span>
            @endif
        </div>
        <div class="items-section">
            @foreach($order->orderItems as $item)
            <div class="item-row">
                <span>{{ $item->menu->nama_menu }} <span style="color:var(--text-muted)">x{{ $item->jumlah }}</span></span>
                <span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
            </div>
            @endforeach
        </div>
        <div class="order-footer">
            <span class="order-total">Total: <span>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span></span>
        </div>
    </div>
    @empty
    <div class="empty-state">
        <i class="fas fa-receipt"></i>
        <p data-i18n="empty.orders">Belum ada pesanan.</p>
        <a href="{{ route('user.orders.create') }}" class="empty-link" data-i18n="empty.cta">Pesan sekarang →</a>
    </div>
    @endforelse
</div>
@endsection

@section('page-scripts')
<script>
Object.assign(window.T.id, {
    'page.title': 'Riwayat Pesanan',
    'page.subtitle': 'Lihat semua pesanan yang pernah kamu buat.',
    'empty.orders': 'Belum ada pesanan.',
    'empty.cta': 'Pesan sekarang →',
});
Object.assign(window.T.en, {
    'page.title': 'Order History',
    'page.subtitle': 'View all your past orders.',
    'empty.orders': 'No orders yet.',
    'empty.cta': 'Order now →',
});
window.applyLang(window.currentLang);
</script>
@endsection