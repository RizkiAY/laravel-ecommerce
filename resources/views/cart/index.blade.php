
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Your Cart</title>

    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            --page-bg: #f0eade;
            --content-bg: #fbf9f5;
            --border: #e3e0da;
            --text: #080808;
            --muted: #777773;
            --red: #ff3338;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: var(--page-bg);
            color: var(--text);
        }

        .page {
            max-width: 1344px;
            min-height: 100vh;
            margin: 0 auto;
            padding: 20px 7%;
            background: var(--content-bg);
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .breadcrumb a {
            color: var(--muted);
            text-decoration: none;
            transition: color .15s;
        }
        .breadcrumb a:hover { color: var(--text); }
        .breadcrumb .separator { color: #b4b0a8; }
        .breadcrumb .current { color: var(--text); font-weight: 500; }
        h1 {
            margin: 0 0 28px;
            font-size: clamp(30px, 4vw, 42px);
            font-weight: 400;
            letter-spacing: -1.8px;
        }

        .page-title {
            margin: 0 0 27px;
            font-size: clamp(30px, 3vw, 40px);
            font-weight: 400;
            letter-spacing: -2px;
        }

        .cart-layout {
            display: grid;
            grid-template-columns: minmax(0, 1.48fr) minmax(350px, 1fr);
            gap: 18px;
            align-items: start;
        }

        .cart-items,
        .order-summary {
            border: 1px solid var(--border);
            border-radius: 20px;
            background: var(--content-bg);
        }

        .cart-items {
            padding: 0 21px;
        }

        .cart-item {
            display: grid;
            grid-template-columns: 28px 116px minmax(0, 1fr);
            gap: 12px;
            align-items: center;
            padding: 17px 0 20px;
            border-bottom: 1px solid var(--border);
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .product-image {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 116px;
            height: 116px;
            overflow: hidden;
            border-radius: 12px;
            background: #ffffff;
        }

        .product-image img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .product-info {
            min-width: 0;
        }

        .product-heading {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 10px;
        }

        .product-name {
            margin: 5px 0 5px;
            font-size: 19px;
            line-height: 1.3;
            font-weight: 600;
        }

        .product-detail {
            margin: 4px 0;
            color: var(--muted);
            font-size: 13px;
        }

        .product-detail strong {
            color: #555;
            font-weight: 400;
        }

        .delete-button {
            flex-shrink: 0;
            padding: 1px;
            border: none;
            background: transparent;
            color: var(--red);
            cursor: pointer;
        }

        .delete-button svg {
            width: 20px;
            height: 20px;
        }

        .product-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-top: 12px;
        }

        .product-price {
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -1px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 13px;
            min-width: 116px;
            padding: 9px 13px;
            border-radius: 30px;
            background: #fff;
        }

        .quantity-control button {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            border: 0;
            background: transparent;
            color: #000;
            font-size: 23px;
            line-height: 18px;
            cursor: pointer;
        }

        .quantity-control input {
            width: 20px;
            padding: 0;
            border: none;
            outline: none;
            background: transparent;
            text-align: center;
            font-size: 14px;
            color: #111;
            appearance: textfield;
            -moz-appearance: textfield;
        }

        .quantity-control input::-webkit-inner-spin-button,
        .quantity-control input::-webkit-outer-spin-button {
            margin: 0;
            -webkit-appearance: none;
        }

        .order-summary {
            padding: 20px 21px 29px;
            position: sticky;
            top: 24px;
            align-self: start;
}

        .summary-title {
            margin: 0 0 26px;
            font-size: 23px;
            font-weight: 600;
            letter-spacing: -0.5px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin: 0 0 22px;
            font-size: 18px;
        }

        .summary-row .label {
            color: var(--muted);
        }

        .summary-row .value {
            font-weight: 600;
            white-space: nowrap;
        }

        .summary-row.discount .value {
            color: var(--red);
        }

        .summary-divider {
            height: 1px;
            margin: 4px 0 22px;
            border: none;
            background: var(--border);
        }

        .summary-total {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 24px;
            font-size: 18px;
        }

        .summary-total strong {
            font-size: 25px;
            letter-spacing: -0.7px;
        }

        .promo-form {
            display: flex;
            gap: 11px;
            margin-bottom: 22px;
        }

        .promo-input {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 1;
            min-width: 0;
            padding: 0 15px;
            border-radius: 30px;
            background: #fff;
        }

        .promo-input svg {
            flex-shrink: 0;
            width: 21px;
            height: 21px;
            color: #999;
        }

        .promo-input input {
            width: 100%;
            min-width: 0;
            padding: 13px 0;
            border: none;
            outline: none;
            background: transparent;
            font-size: 14px;
        }

        .promo-input input::placeholder {
            color: #999;
        }

        .apply-button {
            min-width: 112px;
            padding: 13px 20px;
            border: none;
            border-radius: 30px;
            background: #000;
            color: #fff;
            font-size: 14px;
            cursor: pointer;
        }

        .checkout-button {
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

        .checkout-button:hover,
        .apply-button:hover {
            background: #333;
        }

        .checkout-button svg {
            width: 22px;
            height: 22px;
        }

        .empty-cart {
            padding: 45px 15px;
            text-align: center;
        }

        .empty-cart h2 {
            margin-bottom: 10px;
        }

        .empty-cart p {
            color: var(--muted);
        }

        .empty-cart a {
            display: inline-block;
            margin-top: 12px;
            padding: 14px 25px;
            border-radius: 30px;
            background: #000;
            color: #fff;
            text-decoration: none;
        }

        .alert {
            margin-bottom: 15px;
            padding: 12px 15px;
            border-radius: 10px;
            font-size: 14px;
        }

        .alert-success {
            padding: 20px;
            margin-bottom: 22px;
            border: 1px solid #c8dfce;
            border-radius: 16px;
            background: #dcfce7;
            color: #166534;
            font-size: 14px;
            line-height: 1.5;
        }

        .alert-success h2 {
            margin: 0 0 5px;
            font-size: 20px;
            font-weight: 500;
            line-height: 1.5;
        }

        .alert-success p {
            margin: 0;
            color: #526454;
            font-size: 14px;
            line-height: 1.5;
        }

        .alert-error {
            padding: 20px;
            margin-bottom: 22px;
            border: 1px solid #dfc8c8;
            border-radius: 16px;
            background: #fee2e2;
            color: #991b1b;
        }

        .alert-error h2 {
            margin: 0 0 5px;
            font-size: 20px;
            font-weight: 500;
        }

        .alert-error p {
            margin: 0;
            color: #645252;
            font-size: 14px;
        }

        /* Checkbox berada di luar gambar, di sebelah kiri */
        .product-checkbox {
            position: static;
            display: block;
            width: 24px;
            height: 24px;
            min-width: 24px;
            margin: 0;
            justify-self: center;
            align-self: center;
            cursor: pointer;
            accent-color: #000;
        }

        /* Gambar tidak lagi menjadi wadah checkbox */
        .product-image {
            position: static;
            width: 116px;
            height: 116px;
            overflow: hidden;
        }

        body {
            margin: 0;
            background: #f5f1e9;
        }

        .page {
            width: min(100%, 1050px);
            min-height: 100vh;
            margin: 0 auto;
            padding: 24px 6%;
            background: var(--content-bg);
        }

        /* Tampilan mobile */
        @media (max-width: 480px) {
            .cart-item {
                grid-template-columns: 26px 88px minmax(0, 1fr);
                gap: 8px;
            }

            .product-checkbox {
                width: 22px;
                height: 22px;
                min-width: 22px;
            }

            .product-image {
                width: 88px;
                height: 100px;
            }
        }

        @media (max-width: 900px) {
            .page {
                padding: 24px 4%;
            }

            .cart-layout {
                grid-template-columns: 1fr;
            }

            .order-summary {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .page {
                padding: 20px 14px;
            }

            .page-title {
                margin-bottom: 20px;
            }

            .cart-items {
                padding: 0 12px;
                border-radius: 15px;
            }

            .cart-item {
                grid-template-columns: 88px minmax(0, 1fr);
                gap: 11px;
                padding: 15px 0;
            }

            .product-image {
                width: 88px;
                height: 100px;
            }

            .product-name {
                font-size: 15px;
            }

            .product-detail {
                font-size: 12px;
            }

            .product-price {
                font-size: 20px;
            }

            .product-bottom {
                flex-wrap: wrap;
                align-items: flex-start;
            }

            .quantity-control {
                min-width: 100px;
                gap: 10px;
                padding: 7px 10px;
            }

            .summary-row {
                font-size: 15px;
            }

            .apply-button {
                min-width: 82px;
                padding: 12px;
            }
        }
        @media (max-width: 768px) {
            .order-summary {
                position: static;
            }
        }
    
        .quantity-control button:disabled {
            opacity: 0.35;
            cursor: not-allowed;
            pointer-events: none;
        }

        .steps {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            align-items: center;
            gap: 12px;
            padding: 0 0 24px;
            margin: 0 0 30px;
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

        .step.active {
            color: var(--text);
        }

        .step.active .step-number {
            background: #203a29;
            color: #fff;
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
<div class="page">

    <nav class="breadcrumb">
        <a href="{{ url('/produk') }}">Home</a>
        <span>›</span>
        <span>Cart</span>
    </nav>

    <h1 class="page-title">Your Cart</h1>

    <div class="steps" aria-label="Tahapan checkout">
        <div class="step active">
            <span class="step-number">1</span>
            <span>Informasi</span>
        </div>
        <div class="step">
            <span class="step-number">2</span>
            <span>
                <a href="{{ url('/checkout') }}"
                style="color: inherit; text-decoration: none;">
                    Pembayaran
                </a>
            </span>
        </div>
        <div class="step">
            <span class="step-number">3</span>
            <span>Selesai</span>
        </div>
    </div>

    @if (session('success'))
        <div class="alert-success">
            <h2>Berhasil</h2>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    @php
        $cartSubtotal = 0;
        $validItems = [];

        foreach ($cart as $id => $item) {
            if (isset($products[$id])) {
                $product = $products[$id];
                $quantity = max(1, (int) ($item['quantity'] ?? 1));
                $price = (float) $product->price;

                $cartSubtotal += $price * $quantity;

                $validItems[] = [
                    'id' => $id,
                    'item' => $item,
                    'product' => $product,
                    'quantity' => $quantity,
                    'price' => $price,
                ];
            }
        }

        $discount = $cartSubtotal * 0.20;
        $deliveryFee = count($validItems) > 0 ? 15000 : 0;
        $grandTotal = max(0, $cartSubtotal - $discount + $deliveryFee);
    @endphp

    @if (count($validItems) > 0)

        <main class="cart-layout">

            {{-- DAFTAR PRODUK --}}
            <section class="cart-items">

                @foreach ($validItems as $entry)
                    @php
                        $id = $entry['id'];
                        $item = $entry['item'];
                        $product = $entry['product'];
                        $quantity = $entry['quantity'];
                        $price = $entry['price'];

                        // Sesuaikan nama kolom gambar dengan database Anda.
                        $imagePath = $product->image
                            ?? $product->image_path
                            ?? null;

                        $imageUrl = $imagePath
                            ? asset('storage/' . $imagePath)
                            : null;

                        $size = $item['size']
                            ?? ($product->size ?? null);

                        $color = $item['color']
                            ?? ($product->color ?? null);
                    @endphp

                    <article class="cart-item">

                        <input
                                type="checkbox"
                                class="product-checkbox"
                                name="selected_products[]"
                                value="{{ $id }}"
                                form="checkout-form"
                                aria-label="Pilih {{ $product->name }}"
                                data-price="{{ $price }}"
                                data-quantity="{{ $quantity }}"
                            >
                        <div class="product-image">

                            @if ($imageUrl)
                                <img
                                    src="{{ $imageUrl }}"
                                    alt="{{ $product->name }}"
                                >
                            @else
                                <svg
                                    width="55"
                                    height="55"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="#aaa"
                                    stroke-width="1.2"
                                    aria-label="Gambar produk tidak tersedia"
                                >
                                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                                    <circle cx="8.5" cy="8.5" r="1.5"/>
                                    <path d="m21 15-5-5L5 21"/>
                                </svg>
                            @endif
                        </div>

                        <div class="product-info">

                            <div class="product-heading">
                                <h2 class="product-name">
                                    {{ $product->name }}
                                </h2>

                                <form
                                    action="{{ url('/keranjang/hapus/' . $id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Hapus produk ini dari keranjang?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="delete-button"
                                        aria-label="Hapus {{ $product->name }}"
                                        title="Hapus produk"
                                    >
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        >
                                            <path d="M3 6h18"/>
                                            <path d="M8 6V4h8v2"/>
                                            <path d="m19 6-1 14H6L5 6"/>
                                            <path d="M10 10v6M14 10v6"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>

                            @if ($size)
                                <p class="product-detail">
                                    Size: <strong>{{ $size }}</strong>
                                </p>
                            @endif

                            @if ($color)
                                <p class="product-detail">
                                    Color: <strong>{{ $color }}</strong>
                                </p>
                            @endif

                            <div class="product-bottom">

                                <div class="product-price">
                                    Rp {{ number_format($price, 0, ',', '.') }}
                                </div>

                                <form
                                    action="{{ url('/keranjang/update/' . $id) }}"
                                    method="POST"
                                    class="quantity-control"
                                    data-update-url="{{ url('/keranjang/update/' . $id) }}"
                                    onsubmit="return false"
                                >
                                    @csrf

                                    <input
                                        type="hidden"
                                        name="product_id"
                                        value="{{ $id }}"
                                    >

                                    <button
                                        type="button"
                                        class="quantity-minus"
                                        onclick="changeQuantity(this, -1)"
                                        aria-label="Kurangi jumlah"
                                        {{ $quantity <= 1 ? 'disabled' : '' }}
                                    >−</button>

                                    <input
                                        type="number"
                                        name="quantity"
                                        value="{{ $quantity }}"
                                        min="1"
                                        max="{{ (int) ($product->stock ?? 99) }}"
                                        data-last-quantity="{{ $quantity }}"
                                        aria-label="Jumlah produk"
                                    >

                                    <button
                                        type="button"
                                        class="quantity-plus"
                                        onclick="changeQuantity(this, 1)"
                                        aria-label="Tambah jumlah"
                                        {{ $quantity >= (int) ($product->stock ?? 99) ? 'disabled' : '' }}
                                    >+</button>
                                </form>

                            </div>
                        </div>
                    </article>
                @endforeach

            </section>

            {{-- RINGKASAN PESANAN --}}
            <aside class="order-summary">

                <h2 class="summary-title">Ringkasan Pesanan</h2>

                <div class="summary-row">
                    <span class="label">Subtotal</span>
                    <span class="value" id="summary-subtotal">
                        Rp {{ number_format($cartSubtotal, 0, ',', '.') }}
                    </span>
                </div>

                <div class="summary-row discount">
                    <span class="label">Diskon (-20%)</span>
                    <span class="value" id="summary-discount">
                        -Rp {{ number_format($discount, 0, ',', '.') }}
                    </span>
                </div>

                <div class="summary-row">
                    <span class="label">Ongkos Kirim</span>
                    <span class="value" id="summary-delivery">
                        Rp {{ number_format($deliveryFee, 0, ',', '.') }}
                    </span>
                </div>

                <hr class="summary-divider">

                <div class="summary-total">
                    <span>Total</span>
                    <strong id="summary-total">
                        Rp {{ number_format($grandTotal, 0, ',', '.') }}
                    </strong>
                </div>

                <form
                    action="{{ url('/keranjang/promo') }}"
                    method="POST"
                    class="promo-form"
                >
                    @csrf

                    <div class="promo-input">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M20.6 13.4 13.4 20.6a2 2 0 0 1-2.8 0L3 13V3h10l7.6 7.6a2 2 0 0 1 0 2.8Z"/>
                            <circle cx="7.5" cy="7.5" r="1"/>
                        </svg>

                        <input
                            type="text"
                            name="promo_code"
                            placeholder="Add promo code"
                            value="{{ old('promo_code') }}"
                        >
                    </div>

                    <button type="submit" class="apply-button">
                        Apply
                    </button>
                </form>

                <form
                    action="{{ url('/checkout') }}"
                    method="GET"
                    id="checkout-form"
                >
                    <button
                        type="submit"
                        class="checkout-button"
                        id="checkout-button"
                        disabled
                    >
                        Go to Checkout

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
                </form>

            </aside>

        </main>

    @else

        <section class="cart-items empty-cart">
            <h2>Keranjang Anda Kosong</h2>
            <p>Belum ada produk yang ditambahkan ke keranjang.</p>

            <a href="{{ url('/produk') }}">Mulai Belanja</a>
        </section>

    @endif

</div>

<script>
    let refreshCartSummary = function () {};

    function syncQuantityButtons(input) {
        const form = input.closest('form.quantity-control');
        if (!form) return;

        const minusButton = form.querySelector('.quantity-minus');
        const plusButton = form.querySelector('.quantity-plus');
        const quantity = Number(input.value) || 1;
        const min = Number(input.min) || 1;
        const max = Number(input.max) || 99;

        if (minusButton) minusButton.disabled = quantity <= min;
        if (plusButton) plusButton.disabled = quantity >= max;
    }

    function changeQuantity(button, change) {
        const form = button.closest('form.quantity-control');
        const input = form?.querySelector('input[name="quantity"]');
        if (!form || !input || input.disabled) return;

        const current = parseInt(input.value, 10) || 1;
        const max = parseInt(input.max, 10) || 99;
        const next = Math.min(max, Math.max(1, current + change));

        if (next === current) return;

        input.value = next;
        syncQuantityButtons(input);
        input.dispatchEvent(new Event('input', { bubbles: true }));
        saveQuantity(input);
    }

    const quantitySaveTimers = new WeakMap();

    async function saveQuantity(input) {
        if (input.dataset.saving === 'true') return;

        const form = input.closest('form.quantity-control');
        const updateUrl = form?.dataset.updateUrl;
        if (!updateUrl) return;

        const oldQuantity = Number(input.dataset.lastQuantity) || 1;
        const max = Number(input.max) || 99;
        const quantity = Number(input.value);

        if (!Number.isInteger(quantity) || quantity < 1 || quantity > max) {
            input.value = oldQuantity;
            refreshCartSummary();
            return;
        }

        if (quantity === oldQuantity) return;

        input.dataset.saving = 'true';
        input.disabled = true;

        try {
            const csrfToken = document.querySelector(
                'meta[name="csrf-token"]'
            )?.content;

            const response = await fetch(updateUrl, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken || ''
                },
                body: JSON.stringify({ quantity })
            });

            let result = {};
            try {
                result = await response.json();
            } catch (_) {
                // Jika server tidak mengirim JSON, tangani melalui status HTTP.
            }

            if (!response.ok) {
                throw new Error(result.message || 'Jumlah gagal disimpan.');
            }

            input.dataset.lastQuantity = String(quantity);
        } catch (error) {
            input.value = oldQuantity;
            console.error(error);
            alert(error.message || 'Gagal menyimpan jumlah. Silakan coba lagi.');
        } finally {
            input.disabled = false;
            input.dataset.saving = 'false';
            syncQuantityButtons(input);
            refreshCartSummary();
        }
    }
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = [...document.querySelectorAll('.product-checkbox')];
        const checkoutButton = document.getElementById('checkout-button');
        const checkoutForm = document.getElementById('checkout-form');

        const subtotalElement = document.getElementById('summary-subtotal');
        const discountElement = document.getElementById('summary-discount');
        const deliveryElement = document.getElementById('summary-delivery');
        const totalElement = document.getElementById('summary-total');

        if (
            !checkoutButton ||
            !checkoutForm ||
            !subtotalElement ||
            !discountElement ||
            !deliveryElement ||
            !totalElement
        ) {
            return;
        }

        const rupiah = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0
        });

        function updateSummary() {
            let subtotal = 0;
            let selectedCount = 0;

            checkboxes.forEach(function (checkbox) {
                const row = checkbox.closest('.cart-item');
                const quantityInput = row?.querySelector(
                    'input[name="quantity"]'
                );

                const price = Number(checkbox.dataset.price) || 0;
                const quantity = Math.max(
                    1,
                    Number(quantityInput?.value) ||
                    Number(checkbox.dataset.quantity) ||
                    1
                );

                checkbox.dataset.quantity = quantity;

                if (checkbox.checked) {
                    subtotal += price * quantity;
                    selectedCount++;
                }
            });

            const discount = subtotal * 0.20;
            const deliveryFee = selectedCount > 0 ? 15000 : 0;
            const total = Math.max(0, subtotal - discount + deliveryFee);

            subtotalElement.textContent = rupiah.format(subtotal);
            discountElement.textContent = '-' + rupiah.format(discount);
            deliveryElement.textContent = rupiah.format(deliveryFee);
            totalElement.textContent = rupiah.format(total);

            checkoutButton.disabled = selectedCount === 0;
        }

        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', updateSummary);
        });

        document.querySelectorAll(
            '.quantity-control input[name="quantity"]'
        ).forEach(function (input) {
            syncQuantityButtons(input);
            input.addEventListener('input', function () {
                updateSummary();

                clearTimeout(quantitySaveTimers.get(input));
                quantitySaveTimers.set(input, setTimeout(function () {
                    saveQuantity(input);
                }, 600));
            });

            input.addEventListener('change', function () {
                clearTimeout(quantitySaveTimers.get(input));
                saveQuantity(input);
                updateSummary();
            });
        });

        checkoutForm.addEventListener('submit', function (event) {
            const selected = checkboxes.filter(function (checkbox) {
                return checkbox.checked;
            });

            if (selected.length === 0) {
                event.preventDefault();
                alert('Pilih minimal satu produk untuk checkout.');
                return;
            }

            selected.forEach(function (checkbox) {
                const row = checkbox.closest('.cart-item');
                const quantityInput = row?.querySelector(
                    'input[name="quantity"]'
                );

                if (quantityInput) {
                    checkbox.dataset.quantity = quantityInput.value;
                }
            });
        });

        refreshCartSummary = updateSummary;
        updateSummary();
    });

</script>


</body>
</html>
