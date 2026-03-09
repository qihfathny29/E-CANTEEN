@extends('layouts.admin')
@section('title', 'Detail User — ' . $user->name)

@section('page-styles')
        .page-wrap{padding:2rem;}
        .back-link{display:inline-flex;align-items:center;gap:.45rem;font-family:var(--font-d);font-size:.8rem;font-weight:600;color:var(--text-muted);text-decoration:none;margin-bottom:1.4rem;transition:color .18s;}
        .back-link:hover{color:var(--text);}

        /* Profile card */
        .profile-card{background:var(--bg-card);border:1px solid var(--border);border-radius:1.1rem;padding:1.5rem;display:flex;align-items:center;gap:1.25rem;margin-bottom:1.5rem;flex-wrap:wrap;}
        .profile-avatar{width:56px;height:56px;border-radius:50%;background:var(--red);color:white;display:flex;align-items:center;justify-content:center;font-family:var(--font-d);font-size:1.2rem;font-weight:700;flex-shrink:0;}
        .profile-info{flex:1;}
        .profile-name{font-family:var(--font-d);font-size:1.15rem;font-weight:700;color:var(--text);}
        .profile-email{font-size:.82rem;color:var(--text-muted);margin-top:.2rem;}
        .profile-meta{display:flex;gap:.65rem;margin-top:.5rem;flex-wrap:wrap;}
        .badge-type{display:inline-flex;padding:.22rem .65rem;border-radius:100px;font-family:var(--font-d);font-size:.68rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;}
        .badge-siswa{background:rgba(59,130,246,.12);color:#60a5fa;border:1px solid rgba(59,130,246,.2);}
        .badge-guru{background:rgba(168,85,247,.12);color:#c084fc;border:1px solid rgba(168,85,247,.2);}
        .saldo-chip{display:inline-flex;align-items:center;gap:.35rem;padding:.22rem .65rem;border-radius:100px;font-family:var(--font-d);font-size:.75rem;font-weight:700;background:rgba(74,222,128,.1);color:#4ade80;border:1px solid rgba(74,222,128,.2);}
        .profile-actions{display:flex;gap:.5rem;margin-left:auto;}
        .btn-sm{display:inline-flex;align-items:center;gap:.3rem;padding:.4rem .9rem;border-radius:.5rem;font-family:var(--font-d);font-size:.78rem;font-weight:700;text-decoration:none;border:none;cursor:pointer;transition:all .18s;}
        .btn-edit{background:rgba(234,179,8,.1);color:#facc15;border:1px solid rgba(234,179,8,.2);}
        .btn-edit:hover{background:rgba(234,179,8,.2);}

        /* Stats row */
        .stats-row{display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:1rem;margin-bottom:1.5rem;}
        .stat-mini{background:var(--bg-card);border:1px solid var(--border);border-radius:.85rem;padding:1rem 1.2rem;}
        .stat-mini-label{font-family:var(--font-d);font-size:.68rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--text-muted);margin-bottom:.4rem;}
        .stat-mini-val{font-family:var(--font-d);font-size:1.35rem;font-weight:800;color:var(--text);}

        /* Orders table */
        .table-card{background:var(--bg-card);border:1px solid var(--border);border-radius:1.1rem;overflow:hidden;}
        .table-card-head{padding:1rem 1.35rem;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:.55rem;}
        .table-card-icon{width:28px;height:28px;border-radius:.45rem;background:rgba(192,57,43,.15);color:var(--red);display:flex;align-items:center;justify-content:center;font-size:.78rem;flex-shrink:0;}
        .table-card-title{font-family:var(--font-d);font-size:.92rem;font-weight:700;color:var(--text);}
        .data-table{width:100%;border-collapse:collapse;font-size:.875rem;}
        .data-table thead tr{background:var(--bg-card2);}
        .data-table th{padding:.6rem 1.2rem;text-align:left;font-family:var(--font-d);font-size:.67rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:var(--text-muted);}
        .data-table tbody tr{border-bottom:1px solid var(--border);transition:background .15s;}
        .data-table tbody tr:last-child{border-bottom:none;}
        .data-table tbody tr:hover{background:var(--bg-card2);}
        .data-table td{padding:.75rem 1.2rem;color:var(--text);vertical-align:middle;}
        .td-empty{padding:3rem;text-align:center;color:var(--text-muted);}
        .td-empty i{display:block;font-size:2rem;margin-bottom:.75rem;opacity:.35;}
        .badge-status{display:inline-flex;padding:.2rem .6rem;border-radius:100px;font-family:var(--font-d);font-size:.68rem;font-weight:700;}
        .badge-pending{background:rgba(234,179,8,.12);color:#facc15;border:1px solid rgba(234,179,8,.2);}
        .badge-disiapkan{background:rgba(59,130,246,.12);color:#60a5fa;border:1px solid rgba(59,130,246,.2);}
        .badge-siap{background:rgba(34,197,94,.12);color:#4ade80;border:1px solid rgba(34,197,94,.2);}
        .badge-selesai{background:rgba(255,255,255,.07);color:var(--text-muted);border:1px solid var(--border-md);}
        .items-list{font-size:.78rem;color:var(--text-muted);}

        .pagination-wrap{padding:.9rem 1.2rem;border-top:1px solid var(--border);display:flex;gap:.35rem;flex-wrap:wrap;}
        .page-link{display:inline-flex;align-items:center;justify-content:center;min-width:32px;height:32px;padding:0 .6rem;border-radius:.4rem;font-family:var(--font-d);font-size:.78rem;font-weight:600;color:var(--text-muted);text-decoration:none;border:1px solid var(--border);transition:all .18s;}
        .page-link:hover{border-color:var(--border-md);color:var(--text);}
        .page-link.active{background:var(--red);border-color:var(--red);color:white;}
        .page-link.disabled{opacity:.4;pointer-events:none;}
@endsection

@section('content')
<div class="page-wrap">
    <a href="{{ route('admin.users.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar User
    </a>

    {{-- Profile card --}}
    <div class="profile-card">
        <div class="profile-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
        <div class="profile-info">
            <div class="profile-name">{{ $user->name }}</div>
            <div class="profile-email">{{ $user->email }}</div>
            <div class="profile-meta">
                <span class="badge-type {{ $user->user_type === 'guru' ? 'badge-guru' : 'badge-siswa' }}">
                    {{ $user->user_type === 'guru' ? 'Guru' : 'Siswa' }}
                </span>
                <span class="saldo-chip">
                    <i class="fas fa-wallet" style="font-size:.7rem;"></i>
                    Rp {{ number_format($user->saldo, 0, ',', '.') }}
                </span>
            </div>
        </div>
        <div class="profile-actions">
            <a href="{{ route('admin.users.edit', $user) }}" class="btn-sm btn-edit">
                <i class="fas fa-pen"></i> Edit
            </a>
        </div>
    </div>

    {{-- Stats --}}
    @php
        $allOrders   = $orders->getCollection();
        $totalOrders = $orders->total();
        $totalSpent  = \App\Models\Order::where('user_id',$user->id)->where('status','selesai')->sum('total_harga');
        $doneCount   = \App\Models\Order::where('user_id',$user->id)->where('status','selesai')->count();
    @endphp
    <div class="stats-row">
        <div class="stat-mini">
            <div class="stat-mini-label">Total Pesanan</div>
            <div class="stat-mini-val">{{ $totalOrders }}</div>
        </div>
        <div class="stat-mini">
            <div class="stat-mini-label">Pesanan Selesai</div>
            <div class="stat-mini-val">{{ $doneCount }}</div>
        </div>
        <div class="stat-mini">
            <div class="stat-mini-label">Total Belanja</div>
            <div class="stat-mini-val" style="font-size:1rem;">Rp {{ number_format($totalSpent, 0, ',', '.') }}</div>
        </div>
        <div class="stat-mini">
            <div class="stat-mini-label">Bergabung</div>
            <div class="stat-mini-val" style="font-size:1rem;">{{ $user->created_at->format('d M Y') }}</div>
        </div>
    </div>

    {{-- Order history --}}
    <div class="table-card">
        <div class="table-card-head">
            <div class="table-card-icon"><i class="fas fa-receipt"></i></div>
            <div class="table-card-title">Riwayat Pesanan</div>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Item</th>
                    <th>Waktu Ambil</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td style="color:var(--text-muted);font-size:.78rem;">{{ $order->id }}</td>
                    <td>
                        <div class="items-list">
                            {{ $order->orderItems->map(fn($i) => $i->jumlah.'x '.$i->menu->nama_menu)->implode(' · ') }}
                        </div>
                    </td>
                    <td style="font-size:.8rem;color:var(--text-muted);">
                        {{ $order->waktu_ambil === 'istirahat_1' ? 'Istirahat 1' : 'Istirahat 2' }}
                    </td>
                    <td style="font-family:var(--font-d);font-weight:700;color:#4ade80;font-size:.85rem;">
                        Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                    </td>
                    <td>
                        @if($order->status === 'pending')
                            <span class="badge-status badge-pending">Pending</span>
                        @elseif($order->status === 'sedang_disiapkan')
                            <span class="badge-status badge-disiapkan">Diproses</span>
                        @elseif($order->status === 'siap_diambil')
                            <span class="badge-status badge-siap">Siap</span>
                        @else
                            <span class="badge-status badge-selesai">Selesai</span>
                        @endif
                    </td>
                    <td style="font-size:.78rem;color:var(--text-muted);">
                        {{ $order->created_at->format('d M Y H:i') }}
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="td-empty">
                    <i class="fas fa-receipt"></i>
                    Belum ada pesanan.
                </td></tr>
                @endforelse
            </tbody>
        </table>

        @if($orders->hasPages())
        <div class="pagination-wrap">
            @if($orders->onFirstPage())
                <span class="page-link disabled"><i class="fas fa-chevron-left" style="font-size:.65rem;"></i></span>
            @else
                <a href="{{ $orders->previousPageUrl() }}" class="page-link"><i class="fas fa-chevron-left" style="font-size:.65rem;"></i></a>
            @endif
            @foreach($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                <a href="{{ $url }}" class="page-link {{ $page == $orders->currentPage() ? 'active' : '' }}">{{ $page }}</a>
            @endforeach
            @if($orders->hasMorePages())
                <a href="{{ $orders->nextPageUrl() }}" class="page-link"><i class="fas fa-chevron-right" style="font-size:.65rem;"></i></a>
            @else
                <span class="page-link disabled"><i class="fas fa-chevron-right" style="font-size:.65rem;"></i></span>
            @endif
        </div>
        @endif
    </div>
</div>
@endsection
