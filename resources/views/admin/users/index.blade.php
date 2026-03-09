@extends('layouts.admin')
@section('title', 'Kelola User')

@section('page-styles')
        .page-wrap{padding:2rem;}
        .page-header{margin-bottom:1.5rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;}
        .page-header h1{font-family:var(--font-d);font-size:1.4rem;font-weight:800;color:var(--text);letter-spacing:-.03em;}
        .page-header p{font-size:.85rem;color:var(--text-muted);margin-top:.25rem;}
        .btn-primary{display:inline-flex;align-items:center;gap:.4rem;padding:.48rem 1.1rem;border-radius:.55rem;background:var(--red);color:white;font-family:var(--font-d);font-size:.82rem;font-weight:700;text-decoration:none;border:none;cursor:pointer;transition:background .2s;white-space:nowrap;}
        .btn-primary:hover{background:var(--red-h);}

        .flash{border-radius:.75rem;padding:.85rem 1.1rem;margin-bottom:1.5rem;font-size:.875rem;display:flex;align-items:center;gap:.65rem;}
        .flash-success{background:rgba(34,197,94,.10);border:1px solid rgba(34,197,94,.25);color:#4ade80;}
        .flash-error{background:rgba(239,68,68,.10);border:1px solid rgba(239,68,68,.25);color:#f87171;}

        .search-bar{display:flex;gap:.65rem;margin-bottom:1.5rem;flex-wrap:wrap;}
        .search-input{flex:1;min-width:220px;padding:.48rem .9rem;border-radius:.55rem;border:1px solid var(--border-md);background:var(--input-bg);color:var(--text);font-family:var(--font-b);font-size:.88rem;outline:none;transition:border .2s;}
        .search-input:focus{border-color:rgba(192,57,43,.5);}
        .btn-search{display:inline-flex;align-items:center;gap:.35rem;padding:.48rem 1.1rem;border-radius:.55rem;background:rgba(192,57,43,.15);color:var(--red);font-family:var(--font-d);font-size:.82rem;font-weight:700;border:none;cursor:pointer;transition:all .2s;white-space:nowrap;text-decoration:none;}
        .btn-search:hover{background:var(--red);color:white;}

        .table-card{background:var(--bg-card);border:1px solid var(--border);border-radius:1.1rem;overflow:hidden;}
        .data-table{width:100%;border-collapse:collapse;font-size:.875rem;}
        .data-table thead tr{background:var(--bg-card2);}
        .data-table th{padding:.6rem 1.2rem;text-align:left;font-family:var(--font-d);font-size:.67rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:var(--text-muted);}
        .data-table tbody tr{border-bottom:1px solid var(--border);transition:background .15s;}
        .data-table tbody tr:last-child{border-bottom:none;}
        .data-table tbody tr:hover{background:var(--bg-card2);}
        .data-table td{padding:.8rem 1.2rem;color:var(--text);}
        .td-name{font-weight:600;}
        .td-email{font-size:.78rem;color:var(--text-muted);margin-top:.1rem;}
        .td-saldo{font-family:var(--font-d);font-weight:700;color:#4ade80;}
        .td-empty{padding:3rem;text-align:center;color:var(--text-muted);}
        .td-empty i{display:block;font-size:2rem;margin-bottom:.75rem;opacity:.35;}
        .badge-type{display:inline-flex;padding:.2rem .6rem;border-radius:100px;font-family:var(--font-d);font-size:.68rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;}
        .badge-siswa{background:rgba(59,130,246,.12);color:#60a5fa;border:1px solid rgba(59,130,246,.2);}
        .badge-guru{background:rgba(168,85,247,.12);color:#c084fc;border:1px solid rgba(168,85,247,.2);}

        .action-btns{display:flex;gap:.4rem;}
        .btn-sm{display:inline-flex;align-items:center;gap:.3rem;padding:.3rem .7rem;border-radius:.4rem;font-family:var(--font-d);font-size:.72rem;font-weight:700;text-decoration:none;border:none;cursor:pointer;transition:all .18s;white-space:nowrap;}
        .btn-detail{background:var(--bg-card2);color:var(--text-sub);border:1px solid var(--border-md);}
        .btn-detail:hover{color:var(--text);border-color:var(--border-md);}
        .btn-edit{background:rgba(234,179,8,.1);color:#facc15;border:1px solid rgba(234,179,8,.2);}
        .btn-edit:hover{background:rgba(234,179,8,.2);}
        .btn-del{background:rgba(239,68,68,.1);color:#f87171;border:1px solid rgba(239,68,68,.2);}
        .btn-del:hover{background:rgba(239,68,68,.2);}

        .pagination-wrap{padding:.9rem 1.2rem;border-top:1px solid var(--border);display:flex;gap:.35rem;flex-wrap:wrap;}
        .page-link{display:inline-flex;align-items:center;justify-content:center;min-width:32px;height:32px;padding:0 .6rem;border-radius:.4rem;font-family:var(--font-d);font-size:.78rem;font-weight:600;color:var(--text-muted);text-decoration:none;border:1px solid var(--border);transition:all .18s;}
        .page-link:hover{border-color:var(--border-md);color:var(--text);}
        .page-link.active{background:var(--red);border-color:var(--red);color:white;}
        .page-link.disabled{opacity:.4;pointer-events:none;}
@endsection

@section('content')
<div class="page-wrap">
    <div class="page-header">
        <div>
            <h1>Kelola User</h1>
            <p>Lihat, tambah, edit, dan hapus akun pengguna.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn-primary">
            <i class="fas fa-plus"></i> Tambah User
        </a>
    </div>

    @if(session('success'))
        <div class="flash flash-success"><i class="fas fa-circle-check"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="flash flash-error"><i class="fas fa-circle-exclamation"></i> {{ session('error') }}</div>
    @endif

    <form method="GET" action="{{ route('admin.users.index') }}" class="search-bar">
        <input type="text" name="search" value="{{ request('search') }}"
               class="search-input" placeholder="Cari nama atau email...">
        <button type="submit" class="btn-search"><i class="fas fa-magnifying-glass"></i> Cari</button>
        @if(request('search'))
            <a href="{{ route('admin.users.index') }}" class="btn-search" style="background:var(--bg-card2);color:var(--text-muted);">
                <i class="fas fa-xmark"></i> Reset
            </a>
        @endif
    </form>

    <div class="table-card">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Tipe</th>
                    <th>Saldo</th>
                    <th>Bergabung</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $u)
                <tr>
                    <td>
                        <div class="td-name">{{ $u->name }}</div>
                        <div class="td-email">{{ $u->email }}</div>
                    </td>
                    <td>
                        <span class="badge-type {{ $u->user_type === 'guru' ? 'badge-guru' : 'badge-siswa' }}">
                            {{ $u->user_type === 'guru' ? 'Guru' : 'Siswa' }}
                        </span>
                    </td>
                    <td><span class="td-saldo">Rp {{ number_format($u->saldo, 0, ',', '.') }}</span></td>
                    <td style="font-size:.8rem;color:var(--text-muted);">{{ $u->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('admin.users.show', $u) }}" class="btn-sm btn-detail">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                            <a href="{{ route('admin.users.edit', $u) }}" class="btn-sm btn-edit">
                                <i class="fas fa-pen"></i> Edit
                            </a>
                            <form method="POST" action="{{ route('admin.users.destroy', $u) }}"
                                  onsubmit="return confirm('Hapus akun {{ addslashes($u->name) }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm btn-del">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="td-empty">
                    <i class="fas fa-users"></i>
                    Tidak ada pengguna ditemukan.
                </td></tr>
                @endforelse
            </tbody>
        </table>

        @if($users->hasPages())
        <div class="pagination-wrap">
            @if($users->onFirstPage())
                <span class="page-link disabled"><i class="fas fa-chevron-left" style="font-size:.65rem;"></i></span>
            @else
                <a href="{{ $users->previousPageUrl() }}" class="page-link"><i class="fas fa-chevron-left" style="font-size:.65rem;"></i></a>
            @endif
            @foreach($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                <a href="{{ $url }}" class="page-link {{ $page == $users->currentPage() ? 'active' : '' }}">{{ $page }}</a>
            @endforeach
            @if($users->hasMorePages())
                <a href="{{ $users->nextPageUrl() }}" class="page-link"><i class="fas fa-chevron-right" style="font-size:.65rem;"></i></a>
            @else
                <span class="page-link disabled"><i class="fas fa-chevron-right" style="font-size:.65rem;"></i></span>
            @endif
        </div>
        @endif
    </div>
</div>
@endsection
