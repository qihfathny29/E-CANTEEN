@extends('layouts.admin')
@section('title', 'Antrean Pesanan')
@section('page-styles')
        /* PAGE */
        .page-wrap{padding:2rem;}
        .page-header{margin-bottom:1.5rem;}
        .page-header h1{font-family:var(--font-d);font-size:1.4rem;font-weight:800;color:var(--text);letter-spacing:-.03em;}
        .page-header p{font-size:.85rem;color:var(--text-muted);margin-top:.25rem;}

        /* FLASH */
        .flash{border-radius:.75rem;padding:.85rem 1.1rem;margin-bottom:1.5rem;font-size:.875rem;display:flex;align-items:center;gap:.65rem;}
        .flash-success{background:rgba(34,197,94,.10);border:1px solid rgba(34,197,94,.25);color:#4ade80;}

        /* COUNTER PILLS */
        .counter-row{display:flex;gap:.75rem;margin-bottom:1.75rem;flex-wrap:wrap;}
        .counter-pill{display:inline-flex;align-items:center;gap:.5rem;font-family:var(--font-d);font-size:.8rem;font-weight:700;padding:.4rem 1rem;border-radius:100px;border:1px solid;}
        .pill-yellow{background:rgba(234,179,8,.10);border-color:rgba(234,179,8,.3);color:#facc15;}
        .pill-blue{background:rgba(59,130,246,.10);border-color:rgba(59,130,246,.3);color:#60a5fa;}
        .pill-green{background:rgba(34,197,94,.10);border-color:rgba(34,197,94,.3);color:#4ade80;}

        /* ORDER CARDS */
        .order-card{background:var(--bg-card);border:1px solid var(--border);border-radius:1rem;padding:1.5rem;margin-bottom:1.1rem;transition:border-color .2s,background .3s;}
        .order-card:hover{border-color:var(--border-md);}
        .order-header{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:1rem;gap:1rem;}
        .order-user-name{font-family:var(--font-d);font-size:1rem;font-weight:700;color:var(--text);}
        .order-user-email{font-size:.8rem;color:var(--text-muted);margin-top:.15rem;}
        .order-waktu{display:inline-flex;align-items:center;gap:.35rem;font-family:var(--font-d);font-size:.7rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;background:var(--bg-card2);border:1px solid var(--border-md);color:var(--text-sub);padding:.22rem .65rem;border-radius:100px;margin-top:.4rem;}
        .badge-pending{display:inline-flex;align-items:center;gap:.3rem;font-family:var(--font-d);font-size:.72rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;background:rgba(234,179,8,.12);color:#facc15;border:1px solid rgba(234,179,8,.25);padding:.25rem .75rem;border-radius:100px;}
        .badge-disiapkan{display:inline-flex;align-items:center;gap:.3rem;font-family:var(--font-d);font-size:.72rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;background:rgba(59,130,246,.12);color:#60a5fa;border:1px solid rgba(59,130,246,.25);padding:.25rem .75rem;border-radius:100px;}
        .badge-siap{display:inline-flex;align-items:center;gap:.3rem;font-family:var(--font-d);font-size:.72rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;background:rgba(34,197,94,.12);color:#4ade80;border:1px solid rgba(34,197,94,.25);padding:.25rem .75rem;border-radius:100px;}

        /* ITEMS LIST */
        .items-section{border-top:1px solid var(--border);padding-top:.9rem;margin-bottom:.9rem;}
        .item-row{display:flex;justify-content:space-between;align-items:center;padding:.3rem 0;font-size:.875rem;color:var(--text-sub);}
        .item-name{font-weight:500;}
        .item-price{font-family:var(--font-d);font-weight:600;color:var(--text);}

        /* FOOTER */
        .order-footer{display:flex;justify-content:space-between;align-items:center;border-top:1px solid var(--border);padding-top:.9rem;flex-wrap:wrap;gap:.75rem;}
        .order-total{font-family:var(--font-d);font-size:.95rem;font-weight:800;color:var(--text);}
        .order-total span{color:var(--red-h);}

        /* UPDATE FORM */
        .update-form{display:flex;gap:.5rem;align-items:center;}
        .form-select-sm{background:var(--input-bg);border:1px solid var(--border-md);border-radius:.5rem;color:var(--text);padding:.38rem .75rem;font-size:.8rem;font-family:var(--font-b);outline:none;cursor:pointer;appearance:none;padding-right:2rem;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 24 24' fill='none' stroke='rgba(255,255,255,0.4)' stroke-width='2.5'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right .65rem center;transition:border .2s;}
        .form-select-sm:focus{border-color:rgba(192,57,43,.6);}
        html[data-theme="light"] .form-select-sm{background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 24 24' fill='none' stroke='rgba(0,0,0,0.4)' stroke-width='2.5'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");}
        html[data-theme="light"] select option{background:#ffffff;color:#0f0f0f;}
        .btn-update{display:inline-flex;align-items:center;gap:.35rem;font-family:var(--font-d);font-size:.8rem;font-weight:700;color:white;background:var(--red);border:none;border-radius:.5rem;padding:.38rem .95rem;cursor:pointer;transition:all .2s;}
        .btn-update:hover{background:var(--red-h);}

        /* EMPTY */
        .empty-state{background:var(--bg-card);border:1px solid var(--border);border-radius:1rem;padding:4rem 2rem;text-align:center;}
        .empty-state i{font-size:2.5rem;color:var(--text-muted);display:block;margin-bottom:1rem;}
        .empty-state p{font-size:.9rem;color:var(--text-muted);}
@endsection
@section('content')

<div class="page-wrap">
    <div class="page-header">
        <h1>Antrean Pesanan</h1>
        <p>Monitor dan perbarui status pesanan yang masuk secara real-time.</p>
    </div>

    @if(session('success'))
        <div class="flash flash-success">
            <i class="fas fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    <div class="counter-row">
        <span class="counter-pill pill-yellow">
            <i class="fas fa-clock"></i>
            Pending: {{ $orders->where('status', 'pending')->count() }}
        </span>
        <span class="counter-pill pill-blue">
            <i class="fas fa-fire-burner"></i>
            Sedang Disiapkan: {{ $orders->where('status', 'sedang_disiapkan')->count() }}
        </span>
        <span class="counter-pill pill-green">
            <i class="fas fa-bell"></i>
            Siap Diambil: {{ $orders->where('status', 'siap_diambil')->count() }}
        </span>
    </div>

    @forelse($orders as $order)
    <div class="order-card">
        <div class="order-header">
            <div>
                <div class="order-user-name">{{ $order->user->name }}</div>
                <div class="order-user-email">{{ $order->user->email }}</div>
                <span class="order-waktu">
                    <i class="fas fa-clock" style="font-size:.6rem;"></i>
                    {{ $order->waktu_ambil === 'istirahat_1' ? 'Istirahat 1' : 'Istirahat 2' }}
                </span>
            </div>
            <div>
                @if($order->status === 'pending')
                    <span class="badge-pending"><i class="fas fa-circle" style="font-size:.42rem;"></i> Pending</span>
                @elseif($order->status === 'sedang_disiapkan')
                    <span class="badge-disiapkan"><i class="fas fa-circle" style="font-size:.42rem;"></i> Sedang Disiapkan</span>
                @elseif($order->status === 'siap_diambil')
                    <span class="badge-siap"><i class="fas fa-circle" style="font-size:.42rem;"></i> Siap Diambil</span>
                @endif
            </div>
        </div>

        <div class="items-section">
            @foreach($order->orderItems as $item)
            <div class="item-row">
                <span class="item-name">{{ $item->menu->nama_menu }} <span style="color:var(--text-muted);">×{{ $item->jumlah }}</span></span>
                <span class="item-price">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
            </div>
            @endforeach
        </div>

        <div class="order-footer">
            <div class="order-total">
                Total: <span>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
            </div>
            <form action="{{ route('admin.antrean.updateStatus', $order) }}" method="POST" class="update-form">
                @csrf
                @method('PATCH')
                <select name="status" class="form-select-sm">
                    <option value="pending"           {{ $order->status === 'pending'           ? 'selected' : '' }}>Pending</option>
                    <option value="sedang_disiapkan"  {{ $order->status === 'sedang_disiapkan'  ? 'selected' : '' }}>Sedang Disiapkan</option>
                    <option value="siap_diambil"      {{ $order->status === 'siap_diambil'      ? 'selected' : '' }}>Siap Diambil</option>
                    <option value="selesai"           {{ $order->status === 'selesai'           ? 'selected' : '' }}>Selesai</option>
                </select>
                <button type="submit" class="btn-update">
                    <i class="fas fa-arrow-right"></i> Update
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="empty-state">
        <i class="fas fa-check-circle"></i>
        <p>Tidak ada pesanan aktif saat ini. Semua sudah selesai!</p>
    </div>
    @endforelse
</div>

@endsection