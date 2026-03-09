<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 10px; color: #111; background: #fff; }

        /* ── HEADER ── */
        .header {
            background-color: #c0392b;
            color: #ffffff;
            padding: 14px 20px;
        }
        .header-title {
            font-size: 16px;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .header-meta {
            font-size: 9px;
            margin-top: 5px;
            opacity: 0.9;
        }
        .header-bar {
            height: 4px;
            background-color: #1a1a1a;
        }

        /* ── BODY ── */
        .body { padding: 14px 20px; }

        /* ── TABLE ── */
        table { width: 100%; border-collapse: collapse; }
        thead tr { background-color: #1a1a1a; }
        thead th {
            color: #ffffff;
            padding: 7px 8px;
            font-size: 8.5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-align: left;
        }
        tbody td { padding: 5px 8px; font-size: 9px; border-bottom: 1px solid #e0e0e0; }
        tr.even { background-color: #f7f7f7; }
        tr.odd  { background-color: #ffffff; }

        /* ── FOOTER ── */
        .footer {
            margin-top: 14px;
            padding: 9px 8px 0;
            border-top: 2px solid #c0392b;
            text-align: right;
        }
        .total-label { font-size: 10px; font-weight: bold; color: #111; }
        .total-value { font-size: 13px; font-weight: bold; color: #c0392b; }

        .no-data {
            text-align: center;
            padding: 40px;
            color: #777;
            font-size: 11px;
        }

        .printed-by {
            margin-top: 8px;
            font-size: 8px;
            color: #aaa;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-title">Laporan Harian E-Canteen</div>
        <div class="header-meta">
            Tanggal: {{ \Carbon\Carbon::parse($tanggal)->locale('id')->isoFormat('D MMMM YYYY') }}
            &nbsp;&nbsp;|&nbsp;&nbsp;
            Total Pesanan: {{ $orders->count() }}
            &nbsp;&nbsp;|&nbsp;&nbsp;
            Dicetak: {{ now()->format('d/m/Y H:i') }} WIB
        </div>
    </div>
    <div class="header-bar"></div>

    <div class="body">
        @if($orders->isEmpty())
            <div class="no-data">Tidak ada data pesanan pada tanggal ini.</div>
        @else
            <table>
                <thead>
                    <tr>
                        <th style="width:22px">No</th>
                        <th style="width:130px">Nama Pemesan</th>
                        <th style="width:72px">Waktu Ambil</th>
                        <th>Item Pesanan</th>
                        <th style="width:82px">Total</th>
                        <th style="width:58px">Metode</th>
                        <th style="width:42px">Jam</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $index => $order)
                    <tr class="{{ $index % 2 === 0 ? 'even' : 'odd' }}">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->waktu_ambil === 'istirahat_1' ? 'Istirahat 1' : 'Istirahat 2' }}</td>
                        <td>{{ $order->orderItems->map(fn($i) => $i->jumlah.'x '.$i->menu->nama_menu)->implode(', ') }}</td>
                        <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                        <td>{{ ucfirst($order->metode_bayar ?? 'saldo') }}</td>
                        <td>{{ $order->created_at->format('H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="footer">
                <span class="total-label">TOTAL PENDAPATAN &nbsp;</span>
                <span class="total-value">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</span>
            </div>
            <div class="printed-by">Dokumen ini digenerate otomatis oleh sistem E-Canteen</div>
        @endif
    </div>
</body>
</html>
