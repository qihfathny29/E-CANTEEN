@extends('layouts.admin')
@section('title', 'Laporan Harian')
@section('page-styles')
        /* PAGE */
        .page-wrap{padding:2rem;}
        .page-header{margin-bottom:1.5rem;}
        .page-header h1{font-family:var(--font-d);font-size:1.4rem;font-weight:800;color:var(--text);letter-spacing:-.03em;}
        .page-header p{font-size:.85rem;color:var(--text-muted);margin-top:.25rem;}

        /* FILTER FORM */
        .filter-card{background:var(--bg-card);border:1px solid var(--border);border-radius:1rem;padding:1.25rem 1.5rem;margin-bottom:1.75rem;display:flex;align-items:flex-end;gap:1rem;flex-wrap:wrap;}
        .filter-field{display:flex;flex-direction:column;gap:.4rem;}
        .filter-label{font-family:var(--font-d);font-size:.7rem;font-weight:700;letter-spacing:.05em;text-transform:uppercase;color:var(--text-muted);}
        .filter-input{padding:.38rem .75rem;border-radius:.5rem;border:1px solid var(--border-md);background:var(--input-bg);color:var(--text);font-family:var(--font-b);font-size:.88rem;outline:none;transition:border .2s;}
        .filter-input:focus{border-color:rgba(192,57,43,.6);}
        .filter-input::-webkit-calendar-picker-indicator{filter:invert(60%);cursor:pointer;}
        .btn-filter{display:inline-flex;align-items:center;gap:.35rem;font-family:var(--font-d);font-size:.8rem;font-weight:700;color:white;background:var(--red);border:none;border-radius:.5rem;padding:.38rem .95rem;cursor:pointer;transition:all .2s;}
        .btn-filter:hover{background:var(--red-h);}

        /* STAT CARDS */
        .stats-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:1.75rem;}
        .stat-card{background:var(--bg-card);border:1px solid var(--border);border-radius:1rem;padding:1.25rem 1.4rem;transition:border-color .2s;}
        .stat-card:hover{border-color:var(--border-md);}
        .stat-label{font-family:var(--font-d);font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--text-muted);margin-bottom:.5rem;}
        .stat-val{font-family:var(--font-d);font-size:1.75rem;font-weight:800;color:var(--text);line-height:1;}
        .stat-val.red{color:var(--red-h);}
        .stat-val.green{color:#4ade80;}
        .stat-val.blue{color:#60a5fa;}
        @media(max-width:640px){.stats-grid{grid-template-columns:1fr;}}

        /* TABLE CARD */
        .table-card{background:var(--bg-card);border:1px solid var(--border);border-radius:1rem;overflow:hidden;margin-bottom:2rem;}
        .table-card-header{padding:1rem 1.5rem;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:.6rem;}
        .table-card-header h2{font-family:var(--font-d);font-size:.95rem;font-weight:700;color:var(--text);}
        .table-card-header .icon-badge{width:28px;height:28px;border-radius:.4rem;background:rgba(192,57,43,.15);color:var(--red);display:grid;place-items:center;font-size:.78rem;}
        .data-table{width:100%;border-collapse:collapse;font-size:.875rem;}
        .data-table thead tr{background:var(--bg-card2);}
        .data-table th{padding:.65rem 1.4rem;text-align:left;font-family:var(--font-d);font-size:.68rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:var(--text-muted);}
        .data-table tbody tr{border-bottom:1px solid var(--border);transition:background .15s;}
        .data-table tbody tr:last-child{border-bottom:none;}
        .data-table tbody tr:hover{background:var(--bg-card2);}
        .data-table td{padding:.85rem 1.4rem;color:var(--text);}
        .td-name{font-weight:600;color:var(--text);}
        .td-porsi{color:var(--text-sub);}
        .td-pendapatan{font-weight:700;color:#4ade80;}
        .td-empty{padding:3rem 1.4rem;text-align:center;color:var(--text-muted);font-size:.875rem;}
        .td-empty i{display:block;font-size:2rem;margin-bottom:.75rem;opacity:.35;}
@endsection
@section('content')

<div class="page-wrap">
    <div class="page-header">
        <h1>Laporan Harian</h1>
        <p>Ringkasan transaksi dan pendapatan berdasarkan tanggal yang dipilih.</p>
    </div>

    <form method="GET" action="{{ route('admin.laporan.index') }}" class="filter-card">
        <div class="filter-field">
            <label class="filter-label">Pilih Tanggal</label>
            <input type="date" name="tanggal" value="{{ $tanggal }}" class="filter-input">
        </div>
        <button type="submit" class="btn-filter">
            <i class="fas fa-magnifying-glass"></i> Filter
        </button>
        <a href="{{ route('admin.laporan.export', ['tanggal' => $tanggal]) }}"
           class="btn-filter" style="background:var(--bg-card2);border:1px solid var(--border-md);color:var(--text-sub);text-decoration:none;">
            <i class="fas fa-file-csv"></i> Export CSV
        </a>
        <a href="{{ route('admin.laporan.exportPdf', ['tanggal' => $tanggal]) }}"
           class="btn-filter" style="background:rgba(192,57,43,.12);border:1px solid rgba(192,57,43,.3);color:#e07060;text-decoration:none;">
            <i class="fas fa-file-pdf"></i> Export PDF
        </a>
    </form>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">Total Pesanan</div>
            <div class="stat-val blue">{{ $orders->count() }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Pendapatan</div>
            <div class="stat-val green" style="font-size:1.35rem;">
                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Porsi Terjual</div>
            <div class="stat-val red">{{ $porsiPerMenu->sum('total_porsi') }}</div>
        </div>
    </div>

    <div class="table-card">
        <div class="table-card-header">
            <div class="icon-badge"><i class="fas fa-utensils"></i></div>
            <h2>Rekap Per Menu</h2>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nama Menu</th>
                    <th>Porsi Terjual</th>
                    <th>Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($porsiPerMenu as $menu)
                <tr>
                    <td class="td-name">{{ $menu['nama_menu'] }}</td>
                    <td class="td-porsi">{{ $menu['total_porsi'] }} porsi</td>
                    <td class="td-pendapatan">Rp {{ number_format($menu['total_pendapatan'], 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="td-empty">
                        <i class="fas fa-inbox"></i>
                        Belum ada transaksi pada tanggal ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection