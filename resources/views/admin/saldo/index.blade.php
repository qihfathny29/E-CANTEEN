@extends('layouts.admin')
@section('title', 'Kelola Saldo')

@section('page-styles')
        .page-wrap{padding:2rem;}
        .page-header{margin-bottom:1.5rem;}
        .page-header h1{font-family:var(--font-d);font-size:1.4rem;font-weight:800;color:var(--text);letter-spacing:-.03em;}
        .page-header p{font-size:.85rem;color:var(--text-muted);margin-top:.25rem;}

        .flash{border-radius:.75rem;padding:.85rem 1.1rem;margin-bottom:1.5rem;font-size:.875rem;display:flex;align-items:center;gap:.65rem;}
        .flash-success{background:rgba(34,197,94,.10);border:1px solid rgba(34,197,94,.25);color:#4ade80;}
        .flash-error{background:rgba(239,68,68,.10);border:1px solid rgba(239,68,68,.25);color:#f87171;}

        /* Search bar */
        .search-bar{display:flex;gap:.65rem;margin-bottom:1.5rem;flex-wrap:wrap;}
        .search-input{flex:1;min-width:220px;padding:.48rem .9rem;border-radius:.55rem;border:1px solid var(--border-md);background:var(--input-bg);color:var(--text);font-family:var(--font-b);font-size:.88rem;outline:none;transition:border .2s;}
        .search-input:focus{border-color:rgba(192,57,43,.5);}
        .btn-search{display:inline-flex;align-items:center;gap:.35rem;padding:.48rem 1.1rem;border-radius:.55rem;background:var(--red);color:white;font-family:var(--font-d);font-size:.82rem;font-weight:700;border:none;cursor:pointer;transition:background .2s;white-space:nowrap;}
        .btn-search:hover{background:var(--red-h);}

        /* Two-col layout */
        .main-grid{display:grid;grid-template-columns:1fr 360px;gap:1.5rem;align-items:start;}
        @media(max-width:900px){.main-grid{grid-template-columns:1fr;}}

        /* Table card */
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
        .data-table td{padding:.8rem 1.2rem;color:var(--text);}
        .td-name{font-weight:600;}
        .td-email{font-size:.78rem;color:var(--text-muted);margin-top:.1rem;}
        .td-saldo{font-family:var(--font-d);font-weight:700;color:#4ade80;}
        .td-empty{padding:3rem;text-align:center;color:var(--text-muted);font-size:.875rem;}
        .td-empty i{display:block;font-size:2rem;margin-bottom:.75rem;opacity:.35;}

        /* Top up form card */
        .topup-card{background:var(--bg-card);border:1px solid var(--border);border-radius:1.1rem;overflow:hidden;position:sticky;top:80px;}
        .topup-card-head{padding:1rem 1.35rem;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:.55rem;}
        .topup-card-body{padding:1.25rem 1.35rem;}
        .form-label{font-family:var(--font-d);font-size:.72rem;font-weight:700;letter-spacing:.05em;text-transform:uppercase;color:var(--text-muted);margin-bottom:.4rem;display:block;}
        .form-input{width:100%;padding:.52rem .85rem;border-radius:.55rem;border:1px solid var(--border-md);background:var(--input-bg);color:var(--text);font-family:var(--font-b);font-size:.9rem;outline:none;transition:border .2s;margin-bottom:1rem;}
        .form-input:focus{border-color:rgba(192,57,43,.5);}
        .form-select{width:100%;padding:.52rem .85rem;border-radius:.55rem;border:1px solid var(--border-md);background:var(--input-bg);color:var(--text);font-family:var(--font-b);font-size:.88rem;outline:none;transition:border .2s;margin-bottom:1rem;appearance:none;cursor:pointer;}
        .form-select:focus{border-color:rgba(192,57,43,.5);}
        .nominal-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:.45rem;margin-bottom:1rem;}
        .nominal-btn{padding:.5rem .3rem;border-radius:.45rem;border:1px solid var(--border-md);background:var(--bg-card2);color:var(--text-sub);font-family:var(--font-d);font-size:.72rem;font-weight:700;cursor:pointer;transition:all .2s;text-align:center;}
        .nominal-btn:hover{border-color:rgba(192,57,43,.4);color:var(--text);background:rgba(192,57,43,.08);}
        .btn-topup{width:100%;padding:.72rem;border-radius:.6rem;background:var(--red);color:white;font-family:var(--font-d);font-size:.9rem;font-weight:700;border:none;cursor:pointer;transition:background .2s;}
        .btn-topup:hover{background:var(--red-h);}
        .user-preview{background:var(--bg-card2);border:1px solid var(--border);border-radius:.65rem;padding:.8rem 1rem;margin-bottom:1rem;display:none;}
        .user-preview.show{display:block;}
        .user-preview-name{font-family:var(--font-d);font-size:.88rem;font-weight:700;color:var(--text);}
        .user-preview-saldo{font-size:.78rem;color:#4ade80;margin-top:.2rem;}
        .err-msg{background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.25);color:#f87171;border-radius:.55rem;padding:.6rem .85rem;font-size:.8rem;margin-bottom:.85rem;}

        /* Log list */
        .log-card{background:var(--bg-card);border:1px solid var(--border);border-radius:1.1rem;overflow:hidden;margin-top:1.5rem;}
        .log-item{display:flex;justify-content:space-between;align-items:center;padding:.75rem 1.2rem;border-bottom:1px solid var(--border);gap:.75rem;}
        .log-item:last-child{border-bottom:none;}
        .log-user{font-family:var(--font-d);font-size:.82rem;font-weight:700;color:var(--text);}
        .log-meta{font-size:.72rem;color:var(--text-muted);margin-top:.12rem;}
        .log-amount{font-family:var(--font-d);font-size:.88rem;font-weight:700;color:#4ade80;white-space:nowrap;}
        .log-empty{padding:2rem;text-align:center;color:var(--text-muted);font-size:.85rem;}

        /* Pagination */
        .pagination-wrap{padding:.9rem 1.2rem;border-top:1px solid var(--border);display:flex;gap:.35rem;flex-wrap:wrap;}
        .page-link{display:inline-flex;align-items:center;justify-content:center;min-width:32px;height:32px;padding:0 .6rem;border-radius:.4rem;font-family:var(--font-d);font-size:.78rem;font-weight:600;color:var(--text-muted);text-decoration:none;border:1px solid var(--border);transition:all .18s;}
        .page-link:hover{border-color:var(--border-md);color:var(--text);}
        .page-link.active{background:var(--red);border-color:var(--red);color:white;}
        .page-link.disabled{opacity:.4;pointer-events:none;}
@endsection

@section('content')
<div class="page-wrap">
    <div class="page-header">
        <h1>Kelola Saldo Pengguna</h1>
        <p>Top up saldo siswa/guru setelah menerima pembayaran tunai.</p>
    </div>

    @if(session('success'))
        <div class="flash flash-success"><i class="fas fa-circle-check"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="flash flash-error"><i class="fas fa-circle-exclamation"></i> {{ session('error') }}</div>
    @endif

    {{-- Search --}}
    <form method="GET" action="{{ route('admin.saldo.index') }}" class="search-bar">
        <input type="text" name="search" value="{{ request('search') }}"
               class="search-input" placeholder="Cari nama atau email pengguna...">
        <button type="submit" class="btn-search"><i class="fas fa-magnifying-glass"></i> Cari</button>
        @if(request('search'))
            <a href="{{ route('admin.saldo.index') }}" class="btn-search" style="background:var(--bg-card2);color:var(--text-muted);border:1px solid var(--border-md);">
                <i class="fas fa-xmark"></i> Reset
            </a>
        @endif
    </form>

    <div class="main-grid">

        {{-- ══ LEFT: User list ══ --}}
        <div>
            <div class="table-card">
                <div class="table-card-head">
                    <div class="table-card-icon"><i class="fas fa-users"></i></div>
                    <div class="table-card-title">Daftar Pengguna</div>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Saldo</th>
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
                                <span class="td-saldo">Rp {{ number_format($u->saldo, 0, ',', '.') }}</span>
                            </td>
                            <td>
                                <button type="button" class="btn-search" style="padding:.35rem .85rem;font-size:.75rem;"
                                    onclick="selectUser({{ $u->id }}, '{{ addslashes($u->name) }}', {{ $u->saldo }})">
                                    <i class="fas fa-plus"></i> Top Up
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="td-empty">
                            <i class="fas fa-users"></i>
                            Tidak ada pengguna ditemukan.
                        </td></tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Pagination --}}
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

            {{-- Log 20 transaksi terbaru --}}
            <div class="log-card" style="margin-top:1.5rem;">
                <div class="table-card-head">
                    <div class="table-card-icon"><i class="fas fa-clock-rotate-left"></i></div>
                    <div class="table-card-title">Riwayat Top Up Terbaru</div>
                </div>
                @forelse($logs as $log)
                <div class="log-item">
                    <div>
                        <div class="log-user">{{ $log->user->name }}</div>
                        <div class="log-meta">
                            oleh {{ $log->admin->name }} &middot; {{ $log->created_at->diffForHumans() }}
                            @if($log->catatan) &middot; <em>{{ $log->catatan }}</em> @endif
                        </div>
                    </div>
                    <div class="log-amount">+Rp {{ number_format($log->jumlah, 0, ',', '.') }}</div>
                </div>
                @empty
                <div class="log-empty">Belum ada riwayat top up.</div>
                @endforelse
            </div>
        </div>

        {{-- ══ RIGHT: Top up form ══ --}}
        <div class="topup-card">
            <div class="topup-card-head">
                <div class="table-card-icon"><i class="fas fa-wallet"></i></div>
                <div class="table-card-title">Top Up Saldo</div>
            </div>
            <div class="topup-card-body">

                @if($errors->any())
                    <div class="err-msg"><i class="fas fa-circle-exclamation" style="margin-right:.35rem;"></i>{{ $errors->first() }}</div>
                @endif

                <div class="user-preview" id="user-preview">
                    <div class="user-preview-name" id="preview-name">—</div>
                    <div class="user-preview-saldo" id="preview-saldo">Saldo: Rp 0</div>
                </div>

                <form method="POST" action="{{ route('admin.saldo.topup') }}">
                    @csrf

                    <label class="form-label">Pilih Pengguna</label>
                    <select name="user_id" id="user-select" class="form-select" onchange="onSelectChange()" required>
                        <option value="">— Pilih pengguna —</option>
                        @foreach($users as $u)
                            <option value="{{ $u->id }}"
                                data-name="{{ $u->name }}"
                                data-saldo="{{ $u->saldo }}"
                                {{ old('user_id') == $u->id ? 'selected' : '' }}>
                                {{ $u->name }} (Rp {{ number_format($u->saldo, 0, ',', '.') }})
                            </option>
                        @endforeach
                    </select>

                    <label class="form-label">Nominal Top Up</label>
                    <div class="nominal-grid">
                        @foreach([5000, 10000, 20000, 50000, 100000, 200000] as $n)
                        <button type="button" class="nominal-btn"
                                onclick="document.getElementById('jumlah').value={{ $n }}">
                            Rp {{ number_format($n, 0, ',', '.') }}
                        </button>
                        @endforeach
                    </div>
                    <input type="number" id="jumlah" name="jumlah"
                           value="{{ old('jumlah') }}"
                           placeholder="Atau ketik nominal..." class="form-input" min="1000">

                    <label class="form-label">Catatan (opsional)</label>
                    <input type="text" name="catatan" value="{{ old('catatan') }}"
                           placeholder="Contoh: pembayaran tunai Senin" class="form-input">

                    <button type="submit" class="btn-topup">
                        <i class="fas fa-plus" style="margin-right:.4rem;"></i> Top Up Sekarang
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection

@section('page-scripts')
<script>
const userSaldoMap = {
    @foreach($users as $u)
    {{ $u->id }}: { name: '{{ addslashes($u->name) }}', saldo: {{ $u->saldo }} },
    @endforeach
};

function selectUser(id, name, saldo) {
    const sel = document.getElementById('user-select');
    sel.value = id;
    showPreview(id, name, saldo);
    // scroll to form on mobile
    document.querySelector('.topup-card').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function onSelectChange() {
    const sel = document.getElementById('user-select');
    const id  = sel.value;
    if (!id) {
        document.getElementById('user-preview').classList.remove('show');
        return;
    }
    const u = userSaldoMap[id];
    if (u) showPreview(id, u.name, u.saldo);
}

function showPreview(id, name, saldo) {
    document.getElementById('preview-name').textContent  = name;
    document.getElementById('preview-saldo').textContent = 'Saldo saat ini: Rp ' + Number(saldo).toLocaleString('id-ID');
    document.getElementById('user-preview').classList.add('show');
}

// Restore selection if old() is present (after validation error)
(function() {
    const sel = document.getElementById('user-select');
    if (sel.value) onSelectChange();
})();
</script>
@endsection
