<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Pesanan</title>

    <style>
        * { box-sizing: border-box; }

        :root {
            --page-bg: #f5f1e9;
            --content-bg: #fbf9f5;
            --card-bg: #fff;
            --border: #e3e0da;
            --text: #080808;
            --muted: #777773;
            --green: #203a29;
            --green-soft: #d5ffe4;
        }

        body {
            margin: 0;
            background: var(--page-bg);
            color: var(--text);
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.5;
        }

        .page {
            width: min(100%, 1050px);
            min-height: 100vh;
            margin: 0 auto;
            padding: 22px 6%;
            background: var(--content-bg);
        }

        .breadcrumbs {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .breadcrumbs a {
            color: var(--muted);
            text-decoration: none;
        }

        .breadcrumbs a:hover { color: var(--text); }
        .separator { color: #b4b0a8; }
        .separator-active { color: #000000; }

        h1 {
            margin: -9px 0 20px;
            font-size: clamp(30px, 3vw, 40px);
            font-weight: 400;
            letter-spacing: -2px;
        }

        .steps {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 12px;
            padding-bottom: 24px;
            margin-bottom: 30px;
            border-bottom: 1px solid var(--border);
        }

        .step {
            display: flex;
            align-items: center;
            gap: 9px;
            min-width: 0;
            color: #999891;
            font-size: 13px;
        }

        .step:not(:last-child)::after {
            content: "";
            height: 4px;
            flex: 1;
            margin-left: 4px;
            background: var(--border);
        }

        .step-number {
            display: grid;
            place-items: center;
            width: 25px;
            height: 25px;
            flex: 0 0 25px;
            border-radius: 50%;
            background: #efeeea;
            color: #777;
            font-size: 12px;
        }

        .step.done { color: var(--green); }
        .step.done .step-number {
            background: var(--green-soft);
            color: var(--green);
        }

        .step.active { color: var(--text); }
        .step.active .step-number {
            background: var(--green);
            color: #fff;
        }

        .success {
            padding: 20px;
            margin-bottom: 22px;
            border: 1px solid #c8dfce;
            border-radius: 16px;
            background: #dcfce7;
            color: #166534;
        }

        .success h2 {
            margin: 0 0 5px;
            font-size: 20px;
            font-weight: 500;
        }

        .success p {
            margin: 0;
            color: #526454;
            font-size: 14px;
        }

        .invoice-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px;
            align-items: start;
        }

        .panel {
            min-width: 0;
            padding: 25px;
            border: 1px solid var(--border);
            border-radius: 20px;
            background: var(--content-bg);
        }

        .panel h2 {
            margin: 0 0 20px;
            font-size: 20px;
            font-weight: 500;
            letter-spacing: -.4px;
        }

        .invoice-number {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: #fff;
        }

        .muted {
            color: var(--muted);
            font-size: 12px;
        }

        .invoice-number strong {
            display: block;
            margin-top: 4px;
            font-size: 20px;
            overflow-wrap: anywhere;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px;
            padding: 13px 0;
            border-bottom: 1px solid var(--border);
            font-size: 13px;
        }

        .info-row:last-child { border-bottom: 0; }

        .info-row > span:first-child {
            flex: 0 0 42%;
            color: var(--muted);
        }

        .info-row strong {
            max-width: 58%;
            text-align: right;
            font-weight: 500;
            overflow-wrap: anywhere;
        }

        .total-box {
            margin-top: 20px;
            padding: 20px;
            border-radius: 14px;
            background: #f0eee7;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .total-row strong {
            font-size: clamp(20px, 3vw, 27px);
            letter-spacing: -.7px;
            text-align: right;
            overflow-wrap: anywhere;
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            background: #efeeea;
            color: #56564f;
            font-size: 12px;
            font-weight: 500;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 24px;
        }

        .button {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            min-height: 48px;
            padding: 13px 20px;
            border: 1px solid #000;
            border-radius: 35px;
            background: #000;
            color: #fff;
            font-size: 14px;
            text-decoration: none;
            cursor: pointer;
        }

        .button.secondary {
            border-color: var(--border);
            background: #fff;
            color: var(--text);
        }

        .step-check {
            width: 18px;
            height: 18px;
            display: block;
            flex-shrink: 0;
        }

        @media print {
            body { background: #fff; }
            .page { width: 100%; padding: 0; }
            .actions { display: none; }
            .panel, .success { break-inside: avoid; }
        }

        @media (max-width: 700px) {
            .page { padding: 20px 16px; }
            .invoice-layout { grid-template-columns: 1fr; }
            .panel { padding: 21px 18px; }
        }

        @media (max-width: 430px) {
            .steps { gap: 5px; }
            .step { gap: 6px; font-size: 11px; }
            .step:not(:last-child)::after { margin-left: 0; }
            .step-number {
                width: 23px;
                height: 23px;
                flex-basis: 23px;
            }
        }
    </style>
</head>
<body>
@php
    $paymentMethod = $order->payment_method ?? 'Belum ditentukan';

    $paymentLabels = [
        'card' => 'Kartu Debit / Kredit',
        'virtual_account' => 'Virtual Account',
    ];

    $paymentLabel = $paymentLabels[$paymentMethod] ?? $paymentMethod;

    $total = (float) (
        $order->total
        ?? $order->total_price
        ?? $order->grand_total
        ?? 0
    );

    $status = $order->status ?? 'Menunggu konfirmasi';
@endphp

<main class="page">
    <nav class="breadcrumbs" aria-label="Breadcrumb">
        <a href="{{ url('/produk') }}">Home</a>
        <span class="separator" aria-hidden="true">›</span>
        <a href="{{ url('/keranjang') }}">Cart</a>
        <span class="separator" aria-hidden="true">›</span>
        <a href="{{ url('/checkout') }}">Checkout</a>
        <span class="separator-active" aria-hidden="true">›</span>
        <span aria-current="page">Invoice</span>
    </nav>

    <h1>Invoice</h1>

    <div class="steps" aria-label="Tahapan checkout">
        <div class="step done">
            <span class="step-number">
                <svg class="step-check" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor"
                    stroke-width="2.5" stroke-linecap="round"
                    stroke-linejoin="round" aria-hidden="true">
                    <path d="m5 12 4 4L19 6"></path>
                </svg>
            </span>
            <span>Informasi</span>
        </div>
        <div class="step done">
            <span class="step-number">
                <svg class="step-check" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor"
                    stroke-width="2.5" stroke-linecap="round"
                    stroke-linejoin="round" aria-hidden="true">
                    <path d="m5 12 4 4L19 6"></path>
                </svg>
            </span>
            <span>Pembayaran</span>
        </div>
        <div class="step active">
            <span class="step-number">3</span>
            <span>Selesai</span>
        </div>
    </div>

    @if (session('success'))
        <div class="success" id="invoice-success">
            <h2>Berhasil</h2>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="invoice-layout">
        <section class="panel">
            <h2>Informasi Pelanggan</h2>

            <div class="info-row">
                <span>Nama lengkap</span>
                <strong>{{ $order->customer_name ?? '—' }}</strong>
            </div>

            <div class="info-row">
                <span>Nomor ponsel</span>
                <strong>{{ $order->phone ?? '—' }}</strong>
            </div>

            <div class="info-row">
                <span>Email</span>
                <strong>{{ $order->email ?? '—' }}</strong>
            </div>

            <div class="info-row">
                <span>Alamat pengiriman</span>
                <strong>{{ $order->address ?? '—' }}</strong>
            </div>

            <div class="info-row">
                <span>Kota / Kabupaten</span>
                <strong>{{ $order->city ?? '—' }}</strong>
            </div>

            <div class="info-row">
                <span>Kode pos</span>
                <strong>{{ $order->postal_code ?? '—' }}</strong>
            </div>

            @if (!empty($order->notes))
                <div class="info-row">
                    <span>Catatan pesanan</span>
                    <strong>{{ $order->notes }}</strong>
                </div>
            @endif
        </section>

        <section class="panel">
            <h2>Detail Pembayaran</h2>

            <div class="invoice-number">
                <span class="muted">Nomor invoice</span>
                <strong>INV-{{ $order->id }}</strong>
            </div>

            <div class="info-row">
                <span>Tanggal pesanan</span>
                <strong>
                    {{ $order->created_at
                        ? $order->created_at->format('d/m/Y H:i')
                        : '—' }}
                </strong>
            </div>

            <div class="info-row">
                <span>Metode pembayaran</span>
                <strong>{{ $paymentLabel }}</strong>
            </div>

            <div class="info-row">
                <span>Status pesanan</span>
                <strong><span class="status">{{ $status }}</span></strong>
            </div>

            <div class="total-box">
                <div class="total-row">
                    <span>Total pembayaran</span>
                    <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
                </div>
            </div>

            <p class="muted" style="margin: 15px 0 0;">
                Status pada invoice mengikuti status pesanan yang tersimpan
                di database.
            </p>
        </section>
    </div>

    <div class="actions">
        <button class="button" type="button" onclick="window.print()">
            Cetak Invoice
        </button>

        <a class="button secondary" href="{{ url('/produk') }}">
            Kembali ke Katalog
        </a>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const successMessage = document.getElementById('invoice-success');
        const navigation = performance.getEntriesByType('navigation')[0];

        if (successMessage && navigation?.type === 'reload') {
            successMessage.remove();
        }
    });
</script>

</body>
</html>