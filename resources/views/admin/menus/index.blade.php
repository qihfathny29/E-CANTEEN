@extends('layouts.admin')
@section('title', 'Kelola Menu')
@section('page-styles')
        .page-wrap{max-width:1100px;margin:0 auto;padding:2rem;}
        .page-header{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:1rem;}
        .page-header h1{font-family:var(--font-d);font-size:1.4rem;font-weight:800;color:var(--text);letter-spacing:-.03em;}
        .page-header p{font-size:.85rem;color:var(--text-muted);margin-top:.25rem;}

        /* BUTTONS */
        .btn-red{display:inline-flex;align-items:center;gap:.45rem;font-family:var(--font-d);font-size:.85rem;font-weight:700;color:white;background:var(--red);border:none;border-radius:.55rem;padding:.55rem 1.25rem;text-decoration:none;cursor:pointer;transition:all .2s;}
        .btn-red:hover{background:var(--red-h);transform:translateY(-1px);box-shadow:0 6px 18px rgba(192,57,43,.4);}
        .btn-sm-edit{display:inline-flex;align-items:center;gap:.35rem;font-family:var(--font-d);font-size:.75rem;font-weight:600;color:var(--text-sub);background:var(--bg-card2);border:1px solid var(--border-md);border-radius:.4rem;padding:.3rem .7rem;text-decoration:none;transition:all .2s;white-space:nowrap;}
        .btn-sm-edit:hover{color:var(--text);border-color:rgba(192,57,43,.45);}
        .btn-sm-del{display:inline-flex;align-items:center;gap:.35rem;font-family:var(--font-d);font-size:.75rem;font-weight:600;color:rgba(192,57,43,.85);background:rgba(192,57,43,.08);border:1px solid rgba(192,57,43,.2);border-radius:.4rem;padding:.3rem .7rem;cursor:pointer;transition:all .2s;white-space:nowrap;}
        .btn-sm-del:hover{color:white;background:var(--red);border-color:var(--red);}

        /* FLASH */
        .flash{border-radius:.75rem;padding:.85rem 1.1rem;margin-bottom:1.5rem;font-size:.875rem;display:flex;align-items:center;gap:.65rem;}
        .flash-success{background:rgba(34,197,94,.10);border:1px solid rgba(34,197,94,.25);color:#4ade80;}
        .flash-error{background:rgba(192,57,43,.10);border:1px solid rgba(192,57,43,.30);color:var(--red-h);}

        /* TABLE CARD */
        .tbl-card{background:var(--bg-card);border:1px solid var(--border);border-radius:1rem;overflow:hidden;transition:background .3s;}
        table{width:100%;border-collapse:collapse;}
        thead tr{background:var(--bg-card2);}
        thead th{font-family:var(--font-d);font-size:.72rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--text-muted);padding:.9rem 1.1rem;text-align:left;border-bottom:1px solid var(--border);}
        tbody tr{border-bottom:1px solid var(--border);transition:background .15s;}
        tbody tr:last-child{border-bottom:none;}
        tbody tr:hover{background:var(--bg-card2);}
        tbody td{padding:.85rem 1.1rem;font-size:.875rem;color:var(--text-sub);vertical-align:middle;}
        td.td-name{font-weight:600;color:var(--text);font-family:var(--font-d);}
        td.td-price{font-family:var(--font-d);font-weight:700;color:var(--text);}
        .menu-thumb{width:46px;height:46px;object-fit:cover;border-radius:.5rem;border:1px solid var(--border-md);display:block;}
        .menu-thumb-placeholder{width:46px;height:46px;background:var(--bg-card2);border:1px solid var(--border);border-radius:.5rem;display:flex;align-items:center;justify-content:center;color:var(--text-muted);font-size:.95rem;}

        /* BADGES */
        .badge-tersedia{display:inline-flex;align-items:center;gap:.3rem;font-family:var(--font-d);font-size:.7rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;background:rgba(34,197,94,.12);color:#4ade80;border:1px solid rgba(34,197,94,.22);padding:.22rem .7rem;border-radius:100px;}
        .badge-habis{display:inline-flex;align-items:center;gap:.3rem;font-family:var(--font-d);font-size:.7rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;background:rgba(192,57,43,.12);color:var(--red-h);border:1px solid rgba(192,57,43,.22);padding:.22rem .7rem;border-radius:100px;}

        /* EMPTY */
        .empty-state{padding:4rem 2rem;text-align:center;}
        .empty-state i{font-size:2.5rem;color:var(--text-muted);display:block;margin-bottom:1rem;}
        .empty-state p{font-size:.9rem;color:var(--text-muted);}

        /* PAGINATION */
        .pag-wrap{padding:1rem 1.1rem;border-top:1px solid var(--border);display:flex;gap:.3rem;align-items:center;}
        .pag-btn{display:inline-flex;align-items:center;justify-content:center;font-family:var(--font-d);font-size:.8rem;font-weight:600;min-width:34px;height:34px;padding:0 .5rem;border-radius:.4rem;text-decoration:none;transition:all .2s;border:1px solid var(--border-md);color:var(--text-sub);background:var(--bg-card2);}
        .pag-btn:hover{color:var(--text);border-color:var(--red);}
        .pag-btn.active{background:var(--red);color:white;border-color:var(--red);}
@endsection
@section('content')
<div class="page-wrap">
    <div class="page-header">
        <div>
            <h1>Kelola Menu</h1>
            <p>Tambah, ubah, dan hapus menu yang tersedia di kantin.</p>
        </div>
        <a href="{{ route('admin.menus.create') }}" class="btn-red">
            <i class="fas fa-plus"></i> Tambah Menu
        </a>
    </div>

    @if(session('success'))
        <div class="flash flash-success">
            <i class="fas fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="flash flash-error">
            <i class="fas fa-circle-exclamation"></i> {{ session('error') }}
        </div>
    @endif

    <div class="tbl-card">
        <table>
            <thead>
                <tr>
                    <th style="width:60px;">Foto</th>
                    <th>Nama Menu</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th style="width:140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($menus as $menu)
                <tr>
                    <td>
                        @if($menu->foto)
                            <img src="{{ Storage::url($menu->foto) }}" class="menu-thumb" alt="{{ $menu->nama_menu }}">
                        @else
                            <div class="menu-thumb-placeholder"><i class="fas fa-image"></i></div>
                        @endif
                    </td>
                    <td class="td-name">{{ $menu->nama_menu }}</td>
                    <td class="td-price">Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                    <td>
                        @if($menu->status === 'tersedia')
                            <span class="badge-tersedia"><i class="fas fa-circle" style="font-size:.42rem;"></i> Tersedia</span>
                        @else
                            <span class="badge-habis"><i class="fas fa-circle" style="font-size:.42rem;"></i> Habis</span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex;gap:.5rem;align-items:center;">
                            <a href="{{ route('admin.menus.edit', $menu) }}" class="btn-sm-edit">
                                <i class="fas fa-pen"></i> Edit
                            </a>
                            <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus menu ini?')" style="margin:0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-sm-del">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">
                        <div class="empty-state">
                            <i class="fas fa-bowl-food"></i>
                            <p>Belum ada menu. Klik <strong>Tambah Menu</strong> untuk mulai.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if($menus->hasPages())
        <div class="pag-wrap">
            @if($menus->onFirstPage())
                <span class="pag-btn disabled"><i class="fas fa-chevron-left"></i></span>
            @else
                <a href="{{ $menus->previousPageUrl() }}" class="pag-btn"><i class="fas fa-chevron-left"></i></a>
            @endif

            @for($i = max(1, $menus->currentPage() - 2); $i <= min($menus->lastPage(), $menus->currentPage() + 2); $i++)
                @if($i === $menus->currentPage())
                    <span class="pag-btn active">{{ $i }}</span>
                @else
                    <a href="{{ $menus->url($i) }}" class="pag-btn">{{ $i }}</a>
                @endif
            @endfor

            @if($menus->hasMorePages())
                <a href="{{ $menus->nextPageUrl() }}" class="pag-btn"><i class="fas fa-chevron-right"></i></a>
            @else
                <span class="pag-btn disabled"><i class="fas fa-chevron-right"></i></span>
            @endif
        </div>
        @endif
    </div>
@endsection
@section('page-scripts')
<script>
    function confirmDelete(f){if(!confirm('Yakin ingin menghapus menu ini?'))return;f.submit();}
</script>
@endsection