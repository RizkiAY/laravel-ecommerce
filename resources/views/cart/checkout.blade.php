<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Checkout</title>
    <style>
        * { box-sizing: border-box; }
        :root {
            --page-bg: #f5f1e9;
            --content-bg: #fbf9f5;
            --card-bg: #fff;
            --border: #e3e0da;
            --text: #080808;
            --muted: #777773;
            --accent: #111;
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
        button, input, select { font: inherit; }
        .page {
            width: min(100%, 1050px);
            min-height: 100vh;
            margin: 0 auto;
            padding: 22px 6%;
            background: var(--content-bg);
        }
        .breadcrumbs {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .breadcrumbs a {
            color: var(--muted);
            text-decoration: none;
            transition: color .15s;
        }
        .breadcrumbs a:hover { color: var(--text); }
        .breadcrumbs .separator { color: #b4b0a8; }
        .breadcrumbs .current { color: var(--text); font-weight: 500; }
        h1 {
            margin: -9px 0 20px;
            font-size: clamp(30px, 3vw, 40px);
            font-weight: 400;
            letter-spacing: -2px;
        }
        .steps {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            align-items: center;
            gap: 12px;
            padding: 0 0 24px;
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
        .step.done .step-number { background: var(--green-soft); color: var(--green); }
        .step.active { color: var(--text); }
        .step.active .step-number { background: var(--green); color: #fff; }
        .checkout-layout {
            display: grid;
            grid-template-columns: minmax(0, 1.35fr) minmax(290px, .85fr);
            gap: 22px;
            align-items: start;
        }
        .panel {
            border: 1px solid var(--border);
            border-radius: 20px;
            background: var(--content-bg);
            padding: 25px;
        }
        .panel h2 {
            margin: 0 0 24px;
            font-size: 21px;
            font-weight: 500;
            letter-spacing: -.4px;
        }
        .section-label {
            display: block;
            margin: 0 0 11px;
            font-size: 14px;
            font-weight: 600;
        }
        .payment-methods {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 25px;
        }
        .method-option { position: relative; }
        .method-option input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }
        .method-card {
            display: flex;
            flex-direction: column;
            gap: 11px;
            min-height: 82px;
            padding: 14px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: #fff;
            cursor: pointer;
            transition: border-color .15s, background .15s;
        }
        .method-card svg { width: 20px; height: 20px; }
        .method-card span { font-size: 13px; }
        .method-option input:checked + .method-card {
            border: 1.5px solid var(--green);
            background: #f7f8f3;
            box-shadow: inset 0 0 0 1px var(--green);
        }
        .method-option input:focus-visible + .method-card {
            outline: 2px solid #829582;
            outline-offset: 3px;
        }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px 12px; }
        .field { min-width: 0; }
        .field.full { grid-column: 1 / -1; }
        .field label {
            display: block;
            margin-bottom: 7px;
            font-size: 13px;
            font-weight: 500;
        }
        .required { color: #b44435; }
        .field input, .field select {
            display: block;
            width: 100%;
            min-width: 0;
            height: 45px;
            padding: 0 13px;
            border: 1px solid var(--border);
            border-radius: 9px;
            outline: none;
            background: #fff;
            color: var(--text);
            font-size: 14px;
            transition: border-color .15s, box-shadow .15s;
        }
        .field input:focus, .field select:focus {
            border-color: #657b68;
            box-shadow: 0 0 0 3px rgb(32 58 41 / 8%);
        }
        .field input::placeholder { color: #aaa8a1; }
        .field-hint { margin: 7px 0 0; color: var(--muted); font-size: 12px; }
        .check-row {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-top: 23px;
            padding: 15px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: #fff;
            cursor: pointer;
        }
        .check-row input { width: 16px; height: 16px; margin: 2px 0 0; accent-color: var(--green); }
        .check-row strong { display: block; margin-bottom: 4px; font-size: 13px; font-weight: 500; }
        .check-row small { display: block; color: var(--muted); font-size: 12px; line-height: 1.5; }
        .summary-panel { position: sticky; top: 20px; }
        .summary-title-row { display: flex; align-items: center; justify-content: space-between; gap: 10px; }
        .summary-title-row h2 { margin-bottom: 20px; }
        .summary-title-row a { margin-bottom: 20px; color: var(--muted); font-size: 12px; text-decoration: underline; }
        .summary-item {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding: 13px 0;
            border-bottom: 1px solid var(--border);
            font-size: 13px;
        }
        .summary-item span:first-child { color: var(--muted); }
        .summary-item strong { text-align: right; font-weight: 500; }
        .summary-total {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin: 20px 0;
            font-size: 15px;
        }
        .summary-total strong { font-size: 23px; letter-spacing: -.6px; }
        .pay-button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            width: 100%;
            padding: 19px 15px;
            border: none;
            border-radius: 35px;
            background: #000;
            color: #fff;
            font-size: 15px;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.2s;
        }
        .pay-button:hover { background: #333; }
        .pay-button:active { transform: scale(.99); }
        .secure-note { display: flex; align-items: center; justify-content: center; gap: 7px; margin: 13px 0 0; color: var(--muted); font-size: 11px; }
        .secure-note svg { width: 14px; height: 14px; color: var(--green); }
        .empty-summary { color: var(--muted); font-size: 13px; }
        .virtual-note {
            display: none;
            margin: -10px 0 23px;
            padding: 12px 14px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: #fff;
            color: var(--muted);
            font-size: 12px;
        }
        @media (max-width: 760px) {
            .page { padding: 20px 16px; }
            .checkout-layout { grid-template-columns: 1fr; }
            .summary-panel { position: static; }
            .panel { padding: 21px 18px; }
        }
        @media (max-width: 430px) {
            .steps { gap: 5px; }
            .step { gap: 6px; font-size: 11px; }
            .step:not(:last-child)::after { margin-left: 0; }
            .step-number { width: 23px; height: 23px; flex-basis: 23px; }
            .payment-methods { gap: 9px; }
            .method-card { padding: 12px; }
            .form-grid { gap: 13px 9px; }
        }

        .pay-button svg {
            width: 20px;
            height: 20px;
            flex: 0 0 20px;
            display: block;
        }

        .step-check {
            width: 18px;
            height: 18px;
            display: block;
            flex-shrink: 0;
        }

    </style>
</head>
<body>
<main class="page">
    <nav class="breadcrumbs" aria-label="Breadcrumb">
        <a href="{{ url('/produk') }}">Home</a>
        <span class="separator" aria-hidden="true">›</span>
        <a href="{{ url('/keranjang') }}">Cart</a>
        <span class="current" aria-hidden="true">›</span>
        <span class="current" aria-current="page">Checkout</span>
    </nav>
    <h1>Checkout</h1>

    @if (session('error'))
        <div role="alert" style="margin-bottom:18px;padding:12px 15px;border:1px solid #e5b8af;border-radius:10px;background:#fff4f1;color:#8d3025;">
            {{ session('error') }}
        </div>
    @endif
    @if ($errors->any())
        <div role="alert" style="margin-bottom:18px;padding:12px 15px;border:1px solid #e5b8af;border-radius:10px;background:#fff4f1;color:#8d3025;">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

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
        <div class="step active"><span class="step-number">2</span><span>Pembayaran</span></div>
        <div class="step"><span class="step-number">3</span><span>Selesai</span></div>
    </div>

    <form action="{{ url('/checkout') }}" method="POST" id="checkout-payment-form">
        @csrf
        <div class="checkout-layout">
            <section class="panel">
                <h2>Detail Pembayaran</h2>
                <span class="section-label">Pilih metode pembayaran</span>

                <div class="payment-methods">
                    <label class="method-option">
                        <input type="radio" name="payment_method" value="card" checked>
                        <span class="method-card">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                <rect x="3" y="5" width="18" height="14" rx="2"></rect><path d="M3 10h18M7 15h3"></path>
                            </svg>
                            <span>Kartu Debit / Kredit</span>
                        </span>
                    </label>
                    <label class="method-option">
                        <input type="radio" name="payment_method" value="virtual_account">
                        <span class="method-card">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                <rect x="3" y="5" width="18" height="14" rx="2"></rect><path d="M7 9h10M7 13h4M7 16h7"></path>
                            </svg>
                            <span>Virtual Account</span>
                        </span>
                    </label>
                </div>

                <div class="virtual-note" id="virtual-note">
                    Nomor virtual account akan ditampilkan setelah pesanan dikonfirmasi.
                </div>

                <div id="card-fields">
                    <div class="form-grid">
                        <div class="field full">
                            <label for="card_number">Nomor kartu <span class="required">*</span></label>
                            <input id="card_number" name="card_number" type="text" inputmode="numeric" autocomplete="cc-number" placeholder="Masukkan nomor kartu" maxlength="23">
                        </div>
                        <div class="field">
                            <label for="card_expiry">Tanggal kedaluwarsa <span class="required">*</span></label>
                            <input id="card_expiry" name="card_expiry" type="text" autocomplete="cc-exp" placeholder="BB/TT" maxlength="5">
                        </div>
                        <div class="field">
                            <label for="card_cvv">CVV <span class="required">*</span></label>
                            <input id="card_cvv" name="card_cvv" type="password" inputmode="numeric" autocomplete="cc-csc" placeholder="•••" maxlength="4">
                        </div>
                        <div class="field full">
                            <label for="cardholder_name">Nama pemegang kartu <span class="required">*</span></label>
                            <input id="cardholder_name" name="cardholder_name" type="text" autocomplete="cc-name" placeholder="Nama sesuai kartu">
                        </div>
                    </div>
                </div>

                <div class="form-grid" style="margin-top:19px;">
                    <div class="field full">
                        <label for="customer_name">Nama lengkap <span class="required">*</span></label>
                        <input id="customer_name" name="customer_name" type="text" value="{{ old('customer_name', auth()->user()->name ?? '') }}" autocomplete="name" required placeholder="Nama penerima pesanan">
                    </div>
                    <div class="field">
                        <label for="phone">Nomor ponsel <span class="required">*</span></label>
                        <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" autocomplete="tel" required placeholder="08xxxxxxxxxx">
                    </div>
                    <div class="field">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email', auth()->user()->email ?? '') }}" autocomplete="email" placeholder="nama@email.com">
                    </div>
                    <div class="field full">
                        <label for="address">Alamat pengiriman <span class="required">*</span></label>
                        <input id="address" name="address" type="text" value="{{ old('address') }}" autocomplete="street-address" required placeholder="Nama jalan, nomor rumah, RT/RW">
                    </div>
                    <div class="field">
                        <label for="city">Kota / Kabupaten <span class="required">*</span></label>
                        <input id="city" name="city" type="text" value="{{ old('city') }}" required placeholder="Kota atau kabupaten">
                    </div>
                    <div class="field">
                        <label for="postal_code">Kode pos</label>
                        <input id="postal_code" name="postal_code" type="text" value="{{ old('postal_code') }}" inputmode="numeric" placeholder="Kode pos">
                    </div>
                    <div class="field full">
                        <label for="notes">Catatan pesanan</label>
                        <input id="notes" name="notes" type="text" value="{{ old('notes') }}" placeholder="Opsional">
                    </div>
                </div>

                <label class="check-row">
                    <input type="checkbox" name="save_information" value="1">
                    <span>
                        <strong>Simpan informasi saya untuk checkout berikutnya</strong>
                        <small>Informasi akan digunakan untuk mempermudah pengisian pada transaksi berikutnya.</small>
                    </span>
                </label>
            </section>

            <aside class="panel summary-panel">
                <div class="summary-title-row">
                    <h2>Ringkasan Pesanan</h2>
                    <a href="{{ url('/keranjang') }}">Ubah keranjang</a>
                </div>

                @php
                    $checkoutSubtotal = 0;
                    $checkoutItemsCount = 0;
                    if (isset($cart, $products) && is_iterable($cart)) {
                        foreach ($cart as $checkoutId => $checkoutItem) {
                            if (isset($products[$checkoutId])) {
                                $checkoutQty = max(1, (int) ($checkoutItem['quantity'] ?? 1));
                                $checkoutSubtotal += (float) $products[$checkoutId]->price * $checkoutQty;
                                $checkoutItemsCount += $checkoutQty;
                            }
                        }
                    }
                    $checkoutDiscount = $checkoutSubtotal * 0.20;
                    $checkoutDelivery = $checkoutSubtotal > 0 ? 15000 : 0;
                    $checkoutTotal = max(0, $checkoutSubtotal - $checkoutDiscount + $checkoutDelivery);
                @endphp

                @if (isset($cart, $products) && $checkoutItemsCount > 0)
                    <div class="summary-item"><span>Jumlah item</span><strong>{{ $checkoutItemsCount }} item</strong></div>
                    <div class="summary-item"><span>Subtotal</span><strong>Rp {{ number_format($checkoutSubtotal, 0, ',', '.') }}</strong></div>
                    <div class="summary-item"><span>Diskon (20%)</span><strong>− Rp {{ number_format($checkoutDiscount, 0, ',', '.') }}</strong></div>
                    <div class="summary-item"><span>Biaya pengiriman</span><strong>Rp {{ number_format($checkoutDelivery, 0, ',', '.') }}</strong></div>
                    <div class="summary-total"><span>Total pembayaran</span><strong>Rp {{ number_format($checkoutTotal, 0, ',', '.') }}</strong></div>
                @else
                    <p class="empty-summary">Ringkasan total akan ditampilkan berdasarkan pesanan yang dipilih.</p>
                    <div class="summary-total"><span>Total pembayaran</span><strong>—</strong></div>
                @endif

                <button class="pay-button" type="submit">
                    Confirm Order
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M5 12h14"/>
                        <path d="m13 5 7 7-7 7"/>
                    </svg>
                </button>
                <p class="secure-note">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <rect x="5" y="10" width="14" height="11" rx="2"></rect><path d="M8 10V7a4 4 0 0 1 8 0v3"></path>
                    </svg>
                    Informasi Anda dijaga dengan aman
                </p>
            </aside>
        </div>
    </form>
</main>

<script>
    const paymentOptions = document.querySelectorAll('input[name="payment_method"]');
    const cardFields = document.getElementById('card-fields');
    const virtualNote = document.getElementById('virtual-note');
    const cardInputs = cardFields.querySelectorAll('input');

    function updatePaymentMethod() {
        const selected = document.querySelector('input[name="payment_method"]:checked')?.value;
        const isCard = selected === 'card';

        cardFields.style.display = isCard ? 'block' : 'none';
        virtualNote.style.display = isCard ? 'none' : 'block';

        cardInputs.forEach(input => {
            input.required = isCard;
            input.disabled = !isCard;
        });
    }

    paymentOptions.forEach(option => option.addEventListener('change', updatePaymentMethod));
    updatePaymentMethod();

    const cardNumber = document.getElementById('card_number');
    cardNumber.addEventListener('input', () => {
        const digits = cardNumber.value.replace(/\D/g, '').slice(0, 19);
        cardNumber.value = digits.replace(/(.{4})/g, '$1 ').trim();
    });

    const expiry = document.getElementById('card_expiry');
    expiry.addEventListener('input', () => {
        const digits = expiry.value.replace(/\D/g, '').slice(0, 4);
        expiry.value = digits.length > 2 ? digits.slice(0, 2) + '/' + digits.slice(2) : digits;
    });
</script>
</body>
</html>
