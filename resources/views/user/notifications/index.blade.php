@extends('layouts.user')
@section('title', 'Notifikasi')

@section('page-styles')
        .page-wrap{padding:2rem;}
        .page-header{margin-bottom:1.75rem;}
        .page-header h1{font-family:var(--font-d);font-size:1.4rem;font-weight:800;color:var(--text);letter-spacing:-.03em;}
        .page-header p{font-size:.85rem;color:var(--text-muted);margin-top:.2rem;}

        .notif-list{display:flex;flex-direction:column;gap:.85rem;}

        .notif-card{background:var(--bg-card);border:1px solid var(--border);border-radius:1rem;padding:1.2rem 1.4rem;transition:border-color .2s,background .3s;}
        .notif-card:hover{border-color:var(--border-md);}
        .notif-card.unread{border-left:3px solid var(--red);}

        .notif-top{display:flex;align-items:flex-start;gap:1rem;}
        .notif-icon{width:38px;height:38px;border-radius:.55rem;background:rgba(192,57,43,.12);color:var(--red);display:flex;align-items:center;justify-content:center;font-size:.9rem;flex-shrink:0;margin-top:.1rem;}
        .notif-icon.green{background:rgba(34,197,94,.10);color:#4ade80;}
        .notif-icon.blue{background:rgba(59,130,246,.10);color:#60a5fa;}
        .notif-icon.yellow{background:rgba(234,179,8,.10);color:#facc15;}
        .notif-icon.muted{background:var(--bg-card2);color:var(--text-muted);}

        .notif-body{flex:1;min-width:0;}
        .notif-title{font-family:var(--font-d);font-size:.88rem;font-weight:700;color:var(--text);margin-bottom:.15rem;}
        .notif-message{font-size:.83rem;color:var(--text-sub);line-height:1.45;}
        .notif-time{font-size:.74rem;color:var(--text-muted);margin-top:.3rem;}

        /* Items strip */
        .notif-items{display:flex;gap:.6rem;margin-top:.85rem;padding-top:.75rem;border-top:1px solid var(--border);flex-wrap:wrap;align-items:center;}
        .notif-item{display:flex;align-items:center;gap:.5rem;background:var(--bg-card2);border:1px solid var(--border);border-radius:.6rem;padding:.35rem .6rem .35rem .35rem;}
        .notif-item-img{width:32px;height:32px;border-radius:.4rem;object-fit:cover;flex-shrink:0;background:var(--bg-body);}
        .notif-item-img-placeholder{width:32px;height:32px;border-radius:.4rem;background:var(--bg-body);display:flex;align-items:center;justify-content:center;font-size:.75rem;color:var(--text-muted);flex-shrink:0;}
        .notif-item-name{font-family:var(--font-d);font-size:.76rem;font-weight:700;color:var(--text);white-space:nowrap;max-width:120px;overflow:hidden;text-overflow:ellipsis;}
        .notif-item-qty{font-size:.72rem;color:var(--text-muted);margin-left:.15rem;}

        .empty-state{background:var(--bg-card);border:1px solid var(--border);border-radius:1rem;padding:4rem 2rem;text-align:center;}
        .empty-state i{font-size:2rem;color:var(--text-muted);display:block;margin-bottom:1rem;opacity:.35;}
        .empty-state p{font-size:.9rem;color:var(--text-muted);}
@endsection

@section('content')
<div class="page-wrap">
    <div class="page-header">
        <h1>Notifikasi</h1>
        <p>Update terbaru seputar pesananmu.</p>
    </div>

    @if($notifications->isEmpty())
    <div class="empty-state">
        <i class="fas fa-bell-slash"></i>
        <p>Belum ada notifikasi.</p>
    </div>
    @else
    <div class="notif-list">
        @foreach($notifications as $notif)
        @php
            $iconClass = 'muted';
            $iconName  = 'fa-circle-check';
            if (str_contains($notif->title, 'Diterima'))       { $iconClass = 'yellow'; $iconName = 'fa-clock'; }
            elseif (str_contains($notif->title, 'Diproses'))   { $iconClass = 'blue';   $iconName = 'fa-fire-burner'; }
            elseif (str_contains($notif->title, 'Siap'))       { $iconClass = 'green';  $iconName = 'fa-circle-check'; }
            elseif (str_contains($notif->title, 'Selesai'))    { $iconClass = 'muted';  $iconName = 'fa-flag-checkered'; }
        @endphp
        <div class="notif-card{{ $notif->is_read ? '' : ' unread' }}">
            <div class="notif-top">
                <div class="notif-icon {{ $iconClass }}">
                    <i class="fas {{ $iconName }}"></i>
                </div>
                <div class="notif-body">
                    <div class="notif-title">{{ $notif->title }}</div>
                    <div class="notif-message">{{ $notif->message }}</div>
                    <div class="notif-time">{{ $notif->created_at->diffForHumans() }}</div>
                </div>
            </div>
            @if($notif->order && $notif->order->orderItems->isNotEmpty())
            <div class="notif-items">
                @foreach($notif->order->orderItems as $item)
                <div class="notif-item">
                    @if($item->menu && $item->menu->foto)
                        <img src="{{ Storage::url($item->menu->foto) }}" alt="{{ $item->menu->nama_menu }}" class="notif-item-img">
                    @else
                        <div class="notif-item-img-placeholder"><i class="fas fa-utensils"></i></div>
                    @endif
                    <span class="notif-item-name">{{ $item->menu->nama_menu ?? '-' }}</span>
                    <span class="notif-item-qty">x{{ $item->jumlah }}</span>
                </div>
                @endforeach
            </div>
            @endif
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
