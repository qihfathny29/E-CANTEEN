<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pesanan #{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background: #e8e8e8;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            padding: 2rem 1rem 3rem;
            font-family: 'Courier New', Courier, monospace;
        }

        /* ── RECEIPT CARD ── */
        .receipt {
            background: #fff;
            width: 100%;
            max-width: 320px;
            padding: 1.4rem 1.6rem 1.2rem;
            box-shadow: 0 6px 40px rgba(0,0,0,.18);
            position: relative;
        }

        /* Zigzag bottom edge effect */
        .receipt::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            right: 0;
            height: 8px;
            background:
                linear-gradient(135deg, #fff 33.33%, transparent 33.33%) 0 0,
                linear-gradient(-135deg, #fff 33.33%, transparent 33.33%) 0 0;
            background-size: 12px 8px;
            background-repeat: repeat-x;
        }

        /* ── HEADER ── */
        .receipt-header {
            text-align: center;
            padding-bottom: 1rem;
            border-bottom: 2px dashed #222;
            margin-bottom: .9rem;
        }
        .store-name {
            font-size: 1.05rem;
            font-weight: bold;
            letter-spacing: 4px;
            text-transform: uppercase;
        }
        .store-sub {
            font-size: .68rem;
            letter-spacing: 1px;
            color: #555;
            margin-top: .15rem;
        }
        .receipt-date {
            font-size: .7rem;
            color: #444;
            margin-top: .55rem;
        }

        /* ── KEY-VALUE ROWS ── */
        .kv-row {
            display: flex;
            justify-content: space-between;
            font-size: .73rem;
            margin-bottom: .28rem;
            line-height: 1.4;
        }
        .kv-label { color: #333; white-space: nowrap; margin-right: .5rem; }
        .kv-value { font-weight: bold; text-align: right; word-break: break-word; }

        /* ── DIVIDERS ── */
        .div-dash  { border: none; border-top: 1px dashed #444; margin: .7rem 0; }
        .div-solid { border: none; border-top: 2px solid #111; margin: .7rem 0; }

        /* ── SECTION TITLE ── */
        .section-title {
            text-align: center;
            font-size: .68rem;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #333;
            margin: .4rem 0;
        }

        /* ── ITEM ROWS ── */
        .item-row {
            display: flex;
            align-items: baseline;
            font-size: .73rem;
            margin-bottom: .28rem;
            gap: .3rem;
        }
        .item-name  { flex: 1; }
        .item-qty   { width: 28px; text-align: center; color: #555; flex-shrink: 0; }
        .item-price { text-align: right; white-space: nowrap; flex-shrink: 0; }

        /* ── TOTAL ── */
        .total-row {
            display: flex;
            justify-content: space-between;
            font-size: .9rem;
            font-weight: bold;
            margin-top: .2rem;
        }

        /* ── FOOTER ── */
        .receipt-footer {
            text-align: center;
            padding-top: .8rem;
            border-top: 2px dashed #222;
            margin-top: .6rem;
        }
        .footer-main { font-size: .75rem; font-weight: bold; letter-spacing: 2px; }
        .footer-sub  { font-size: .67rem; color: #555; margin-top: .25rem; }

        /* ── PRINT BUTTON ── */
        .action-wrap {
            margin-top: 2rem;
            text-align: center;
        }
        .btn-print {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            background: #c0392b;
            color: #fff;
            border: none;
            border-radius: .5rem;
            padding: .65rem 1.75rem;
            font-size: .88rem;
            font-weight: bold;
            font-family: sans-serif;
            cursor: pointer;
            transition: background .2s;
            letter-spacing: .5px;
        }
        .btn-print:hover { background: #e74c3c; }
        .print-hint {
            font-family: sans-serif;
            font-size: .7rem;
            color: #888;
            margin-top: .55rem;
        }

        /* ── PRINT MEDIA ── */
        @page {
            size: 80mm auto;
            margin: 5mm;
        }
        @media print {
            body {
                background: #fff;
                padding: 0;
                display: block;
            }
            .no-print { display: none !important; }
            .receipt {
                box-shadow: none;
                max-width: 100%;
                padding: .4rem;
            }
            .receipt::after { display: none; }
        }
    </style>
</head>
<body>

<div class="receipt">
    {{-- Header --}}
    <div class="receipt-header">
        <div class="store-name">E-CANTEEN</div>
        <div class="store-sub">Kantin Sekolah</div>
        <div class="receipt-date">
            {{ $order->created_at->format('d-M-Y') }} &nbsp;&nbsp; {{ $order->created_at->format('H:i') }} WIB
        </div>
    </div>

    {{-- Order Info --}}
    <div class="kv-row">
        <span class="kv-label">NO. PESANAN</span>
        <span class="kv-value">: #{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</span>
    </div>
    <div class="kv-row">
        <span class="kv-label">NAMA</span>
        <span class="kv-value">: {{ strtoupper($order->user->name) }}</span>
    </div>
    <div class="kv-row">
        <span class="kv-label">WAKTU AMBIL</span>
        <span class="kv-value">: {{ $order->waktu_ambil === 'istirahat_1' ? 'Istirahat 1' : 'Istirahat 2' }}</span>
    </div>
    <div class="kv-row">
        <span class="kv-label">METODE BAYAR</span>
        <span class="kv-value">: {{ strtoupper($order->metode_bayar ?? 'SALDO') }}</span>
    </div>

    <hr class="div-dash">
    <div class="section-title">---- DETAIL PESANAN ----</div>

    {{-- Items --}}
    @foreach($order->orderItems as $item)
    <div class="item-row">
        <span class="item-name">{{ $item->menu->nama_menu }}</span>
        <span class="item-qty">{{ $item->jumlah }}x</span>
        <span class="item-price">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</span>
    </div>
    @endforeach

    <hr class="div-solid">

    <div class="total-row">
        <span>TOTAL</span>
        <span>Rp{{ number_format($order->total_harga, 0, ',', '.') }}</span>
    </div>

    {{-- Footer --}}
    <div class="receipt-footer">
        <div class="footer-main">.:. TERIMA KASIH .:.</div>
        <div class="footer-sub">Selamat menikmati makanannya!</div>
    </div>
</div>

{{-- Print button --}}
<div class="action-wrap no-print">
    <button class="btn-print" onclick="window.print()">
        &#128438; Cetak / Simpan PDF
    </button>
    <div class="print-hint">Pilih "Simpan sebagai PDF" pada dialog cetak</div>
</div>

</body>
</html>
