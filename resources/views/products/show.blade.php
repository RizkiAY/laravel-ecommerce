
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $product->name }} - Detail Produk</title>

    <style>
        :root {
            --page-bg: #f0eade;
            --content-bg: #fbf9f5;
            --border: #e3e0da;
            --text: #080808;
            --muted: #777773;
            --green: #203a29;
            --green-hover: #304b38;
            --green-soft: #e7eee7;
            --red: #ff3338;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 28px 5%;
            font-family: Arial, Helvetica, sans-serif;
            color: var(--text);
            background: var(--page-bg);
        }

        a {
            color: inherit;
        }

        .page {
            max-width: 1344px;
            min-height: calc(100vh - 56px);
            margin: 0 auto;
            padding: 28px 4%;
            background: var(--content-bg);
            border-radius: 18px;
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

        .product-layout {
            display: grid;
            grid-template-columns: minmax(0, 1.15fr) minmax(300px, 0.85fr);
            gap: 42px;
            align-items: start;
        }

        /* Product image */

        .gallery {
            min-width: 0;
        }

        .photo-frame {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 460px;
            padding: 30px;
            overflow: hidden;
            background: #ffffff;
            border-radius: 18px;
        }

        .photo {
            display: block;
            width: 100%;
            height: 460px;
            object-fit: contain;
            mix-blend-mode: multiply;
        }

        .image-placeholder {
            display: grid;
            place-items: center;
            width: 100%;
            min-height: 400px;
            color: var(--muted);
            font-size: 14px;
            text-align: center;
        }

        .image-placeholder span {
            display: block;
            margin-bottom: 12px;
            font-size: 56px;
        }

        .image-caption {
            margin-top: 12px;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.7;
        }

        /* Product information */

        .info {
            min-width: 0;
            padding-top: 8px;
        }

        .category {
            display: inline-block;
            align-self: flex-start;
            margin-bottom: 11px;
            padding: 7px 10px;
            border: 1px solid #e3e0da;
            border-radius: 20px;
            background: #f0eade;
            color: #555550;
            font-size: 12px;
            font-weight: 700;
        }

        .product-title {
            margin: 0 0 12px;
            font-size: clamp(27px, 3vw, 38px);
            font-weight: 500;
            line-height: 1.15;
            letter-spacing: -0.8px;
            overflow-wrap: anywhere;
        }

        .product-subtitle {
            margin: 0 0 25px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.8;
        }

        .divider {
            height: 1px;
            margin: 23px 0;
            background: var(--border);
        }

        .section-label {
            display: block;
            margin-bottom: 12px;
            color: var(--muted);
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .price {
            margin: 0;
            color: var(--green);
            font-size: clamp(28px, 3vw, 36px);
            font-weight: 700;
            letter-spacing: -0.7px;
            line-height: 1.2;
            overflow-wrap: anywhere;
        }

        .stock {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 12px;
            color: var(--muted);
            font-size: 12px;
        }

        .stock-dot {
            width: 7px;
            height: 7px;
            flex: 0 0 7px;
            border-radius: 50%;
            background: var(--green);
        }

        .stock.out-of-stock .stock-dot {
            background: var(--red);
        }

        .description {
            color: #55554f;
            font-size: 13px;
            line-height: 1.9;
            overflow-wrap: anywhere;
        }

        .description p {
            margin: 0;
            white-space: pre-line;
        }

        /* Quantity and add-to-cart */

        .purchase-form {
            margin-top: 26px;
        }

        .purchase-row {
            display: grid;
            grid-template-columns: minmax(100px, 0.65fr) minmax(0, 1.35fr);
            gap: 12px;
            align-items: end;
        }

        .quantity-field label {
            display: block;
            margin-bottom: 10px;
            color: var(--muted);
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.8px;
            text-transform: uppercase;
        }

        .quantity-input {
            width: 100%;
            height: 48px;
            padding: 0 13px;
            border: 1px solid var(--border);
            border-radius: 8px;
            outline: none;
            background: #f5f1e9;
            color: var(--text);
            font: inherit;
        }

        .quantity-input:focus {
            border-color: var(--green);
        }

        .add-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            min-height: 42px;
            margin-top: auto;
            padding: 15px 16px;
            border: 1px solid #080808;
            border-radius: 8px;
            background: #080808;
            color: #ffffff;
            font-family: inherit;
            font-size: 14px;
            font-weight: 650;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.2s, transform 0.2s;
        }

        .add-button:hover {
            background: #333333;
        }

        .add-button:disabled {
            border-color: #d5d0c7;
            background: #d5d0c7;
            color: #777773;
            cursor: not-allowed;
        }

        .add-button:focus-visible {
            outline: 2px solid #333333;
            outline-offset: 3px;
        }

        .notice {
            margin-top: 12px;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.7;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 24px;
            color: var(--text);
            font-size: 12px;
            text-decoration: none;
        }

        .back-link:hover {
            color: var(--green);
        }

        @media (max-width: 760px) {
            body {
                padding: 12px;
            }

            .page {
                min-height: calc(100vh - 24px);
                padding: 20px 16px 28px;
                border-radius: 12px;
            }

            .breadcrumb {
                margin-bottom: 20px;
            }

            .product-layout {
                grid-template-columns: 1fr;
                gap: 25px;
            }

            .photo-frame {
                min-height: 280px;
                padding: 18px;
            }

            .photo {
                height: 320px;
            }

            .image-placeholder {
                min-height: 280px;
            }

            .info {
                padding-top: 0;
            }

            .product-title {
                font-size: 29px;
            }

            .product-subtitle {
                margin-bottom: 20px;
            }

            .divider {
                margin: 20px 0;
            }

            .purchase-row {
                grid-template-columns: minmax(90px, 0.7fr) minmax(0, 1.3fr);
                gap: 10px;
            }
        }

        @media (max-width: 360px) {
            .purchase-row {
                grid-template-columns: 1fr;
            }

            .add-button {
                min-height: 46px;
            }
        }

        @media (max-width: 550px) {
            .category {
                padding: 4px 7px;
                font-size: 10px;
            }

            .add-button {
                padding: 10px 8px;
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <main class="page">

        <nav class="breadcrumb" aria-label="Breadcrumb">
            <a href="{{ url('/produk') }}">Produk</a>
            <span class="separator">›</span>
            @if ($product->category)
                <span>{{ $product->category->name }}</span>
                <span class="separator">›</span>
            @endif
            <span>{{ $product->name }}</span>
        </nav>

        <div class="product-layout">

            {{-- Gambar produk --}}
            <section class="gallery" aria-label="Gambar produk">
                <div class="photo-frame">
                    @if ($product->image)
                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="photo"
                        >
                    @else
                        <div class="image-placeholder">
                            <div>
                                <span>📦</span>
                                Gambar produk belum tersedia
                            </div>
                        </div>
                    @endif
                </div>

            </section>

            {{-- Informasi produk --}}
            <section class="info" aria-label="Informasi produk">

                @if ($product->category)
                    <span class="category">
                        {{ $product->category->name }}
                    </span>
                @endif

                <h1 class="product-title">
                    {{ $product->name }}
                </h1>

                <div class="divider"></div>


                <section aria-label="Deskripsi produk">
                    <span class="section-label">Deskripsi</span>

                    <div class="description">
                        <p>{{ $product->description ?: 'Belum ada deskripsi produk.' }}</p>
                    </div>
                </section>

                <div class="divider"></div>

                <section aria-label="Harga produk">
                    <span class="section-label">Harga</span>

                    <p class="price">
                        Rp {{ number_format((float) $product->price, 0, ',', '.') }}
                    </p>

                    <div class="stock {{ $product->stock > 0 ? '' : 'out-of-stock' }}">
                        <span class="stock-dot"></span>

                        @if ($product->stock > 0)
                            Tersedia · {{ $product->stock }} unit
                        @else
                            Produk sedang habis
                        @endif
                    </div>
                </section>

                @if ($product->stock > 0)
                    <form
                        action="{{ url('/keranjang/tambah/' . $product->id) }}"
                        method="POST"
                        class="purchase-form"
                    >
                        @csrf

                        <div class="purchase-row">
                            <div class="quantity-field">
                                <label for="quantity">Jumlah</label>

                                <input
                                    type="number"
                                    id="quantity"
                                    name="quantity"
                                    class="quantity-input"
                                    value="{{ old('quantity', 1) }}"
                                    min="1"
                                    max="{{ $product->stock }}"
                                    required
                                >
                            </div>

                            <button type="submit" class="add-button">
                                Add To Cart
                            </button>
                        </div>
                    </form>
                @else
                    <div class="purchase-form">
                        <button type="button" class="add-button" disabled>
                            Stok Habis
                        </button>
                    </div>
                @endif

            </section>
        </div>
    </main>
</body>
</html>