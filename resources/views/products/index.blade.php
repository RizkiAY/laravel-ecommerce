
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk | KOTOKO</title>

    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            color-scheme: light;
            --bg-main: #fbf9f5;
            --bg-header: #f5f1e9;
            --bg-card: #fbf9f5;
            --bg-input: #ffffff;
            --bg-hover: #f0eade;
            --border: #e3e0da;
            --text-main: #080808;
            --text-heading: #080808;
            --text-muted: #777773;
            --accent: #080808;
            --accent-hover: #333333;
        }

        html {
            min-height: 100%;
            background: var(--bg-main);
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: var(--bg-main);
            color: var(--text-main);
            line-height: 1.5;
        }

        /* HEADER KATALOG */
        .public-header {
            display: flex;
            align-items: center;
            gap: 50px;
            padding: 8px 4%;
            background: var(--bg-header);
            border-bottom: 1px solid var(--border);
            box-shadow: 0 4px 18px rgb(0 0 0 / 5%);
        }

        /* LOGO WEBSITE */
        .public-header .public-logo {
            display: inline-flex;
            align-items: center;
            flex: 0 0 auto; /* DIUBAH: logo tidak melebar memenuhi ruang kosong */
            width: fit-content; /* DIUBAH: area klik hanya selebar konten logo */
            padding: 0; /* DITAMBAHKAN: tidak ada area klik tambahan */
            margin: 0;
            text-decoration: none;
        }

        .public-header .public-logo-image {
            display: block;
            width: 120px; /* DIUBAH: ukuran gambar logo */
            max-width: 100%;
            height: auto;
            object-fit: contain;
            margin: 0; /* DIUBAH: menghapus margin yang tidak diperlukan */
        }

        /* DIUBAH: Nama user menjadi bold */
        .public-header .customer-greeting {
            font-weight: 400;
        }

        .public-header .customer-greeting strong {
            font-weight: 700;
        }

        /* DIUBAH: Tombol Logout menjadi bold */
        .public-header .logout-button {
            font-weight: 700;
        }

        /* SEARCH BAR HEADER */

        .header-search {
            display: flex;
            flex: 1 1 auto;
            min-width: 100px;
            max-width: 750px; /* DIUBAH: sebelumnya 900px, kolom bisa lebih panjang */
            margin-left: 20px; /* DIUBAH: sebelumnya 130px, memberi ruang lebih besar */
            gap: 0;
        }

        .header-search input {
            width: 100%;
            min-width: 0;
            padding: 12px 14px;
            border: 1px solid #d5d0c7;
            border-right: 0;
            border-radius: 8px 0 0 8px;
            background: var(--bg-input);
            color: var(--text-main);
            font-family: inherit;
            font-size: 14px;
        }

        .header-search input::placeholder {
            color: var(--text-muted);
        }

        .header-search input:focus {
            outline: 2px solid #080808;
            outline-offset: -2px;
        }

        .header-search button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 46px;
            border: 1px solid var(--accent);
            border-radius: 0 8px 8px 0;
            background: var(--accent);
            color: white;
            cursor: pointer;
        }

        .header-search button:hover {
            background: var(--accent-hover);
        }

        /* MENU KANAN HEADER */
        .public-nav {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            flex: 0 0 auto;
            gap: 15px;
            margin-left: 0;
        }

        .public-nav a {
            color: #555550;
            font-size: 13px;
            text-decoration: none;
            white-space: nowrap;
        }

        .public-nav a:hover {
            color: #333333;
        }

        .public-nav .cart-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            color: #080808;
        }

        .cart-link svg {
            display: block;
            width: 23px;
            height: 23px;
        }

        .public-nav .register-link,
        .public-nav .login-link {
            padding: 9px 13px;
            border-radius: 7px;
        }

        .public-nav .register-link {
            border: 1px solid #d5d0c7;
            background: #fbf9f5;
        }

        .public-nav .login-link {
            background: var(--accent);
            color: #fff;
        }

        .public-nav .login-link:hover {
            background: var(--accent-hover);
            color: #fff;
        }

        .public-nav .customer-greeting {
            color: #555550;
            font-size: 13px;
            white-space: nowrap;
        }

        .public-nav .logout-button {
            padding: 8px 0;
            border: 0;
            background: transparent;
            color: #ff3338;
            font-family: inherit;
            font-size: 13px;
            cursor: pointer;
            white-space: nowrap;
        }

        .public-nav .logout-button:hover {
            color: #cc252a;
        }

        .public-nav form {
            margin: 0;
        }

        /* RESPONSIF */

        /* UKURAN LOGO DI HP */
        @media (max-width: 550px) {
            .public-header .public-logo-image {
                width: 150px;
            }
        }

        @media (max-width: 900px) {
            .public-header {
                gap: 15px;
                padding: 10px 3%;
            }

            .public-header .public-logo-image {
                width: 100px;
            }

            .public-nav {
                gap: 12px;
            }
        }

        @media (max-width: 650px) {
            .public-header {
                flex-wrap: wrap;
                gap: 12px;
                padding: 12px 15px;
            }

            .public-header .public-logo-image {
                width: 100px;
            }

            .header-search {
                order: 3;
                flex: 1 0 100%;
                max-width: none;
            }

            .public-nav {
                margin-left: auto;
                gap: 12px;
            }

            .public-nav .customer-greeting {
                max-width: 115px;
                overflow-wrap: anywhere;
                white-space: normal;
            }
        }

        @media (max-width: 380px) {
            .public-header {
                padding: 10px;
            }

            .public-nav {
                gap: 9px;
            }

            .public-nav .cart-label {
                display: none;
            }

            .public-nav .register-link,
            .public-nav .login-link {
                padding: 8px 10px;
            }
        }

        /* AREA UTAMA */
        .public-main {
            max-width: 1200px;
            margin: 36px auto;
            padding: 0 22px;
        }

        .public-heading {
            margin-bottom: 26px;
        }

        .public-heading h1 {
            margin: 0 0 5px;
            font-size: clamp(30px, 3vw, 40px);
            font-weight: 400;
            letter-spacing: -2px;
        }

        .public-heading p {
            margin: 0;
            color: var(--text-muted);
            line-height: 1.7;
        }

        /* PENCARIAN DAN FILTER */
        .product-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 24px;
            padding: 16px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px;
        }

        .product-filter {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 1;
            flex-wrap: wrap;
            min-width: 0;
        }

        .product-filter input,
        .product-filter select {
            min-width: 150px;
            max-width: 100%;
            min-height: 42px;
            padding: 11px 12px;
            border: 1px solid #d5d0c7;
            border-radius: 8px;
            background: var(--bg-input);
            color: var(--text-main);
            font-family: inherit;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .product-filter input {
            flex: 1;
        }

        .product-filter input::placeholder {
            color: #777773;
        }

        .product-filter input:focus,
        .product-filter select:focus {
            border-color: #080808;
            box-shadow: 0 0 0 3px rgb(8 8 8 / 8%);
        }

        .product-filter select option {
            background: var(--bg-input);
            color: var(--text-main);
        }

        .product-filter button,
        .product-detail-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 11px 16px;
            border: 1px solid #080808;
            border-radius: 8px;
            background: var(--accent);
            color: #ffffff;
            font-family: inherit;
            font-size: 14px;
            font-weight: 650;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.2s, transform 0.2s;
        }

        .product-filter button:hover,
        .product-detail-button:hover {
            background: var(--accent-hover);
        }

        .product-filter a {
            align-self: center;
            color: #333333;
            font-size: 14px;
            text-decoration: none;
        }

        .product-filter a:hover {
            color: #555550;
            text-decoration: underline;
        }

        /* NOTIFIKASI */
        .product-success {
            margin-bottom: 20px;
            padding: 14px 16px;
            border: 1px solid #b9d8bd;
            border-radius: 9px;
            background: #e8f4e8;
            color: #245b32;
        }

        /* GRID PRODUK */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
        }

        .product-card {
            display: flex;
            flex-direction: column;
            min-width: 0;
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 13px;
            background: var(--bg-card);
            color: var(--text-main);
            transition: transform 0.2s ease, border-color 0.2s ease,
                        box-shadow 0.2s ease;
        }

        .product-card:hover {
            transform: translateY(-2px);
            border-color: #d5d0c7;
            box-shadow: 0 10px 30px rgb(0 0 0 / 40%);
        }

        /* FRAME PUTIH GAMBAR PRODUK */
        .product-image-link {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 210px;
            padding: 18px;
            overflow: hidden;
            background: #ffffff;
            border-bottom: 1px solid var(--border);
            color: inherit;
            text-decoration: none;
        }

        .product-image {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: contain;
            background: #ffffff;
        }

        .product-image-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            background: #ffffff;
            color: #99958d;
            font-size: 45px;
        }

        .product-card-body {
            display: flex;
            flex: 1;
            flex-direction: column;
            align-items: stretch;
            padding: 18px;
        }

        /* BADGE KATEGORI */
        .product-category {
            display: inline-block;
            align-self: flex-start;
            margin-bottom: 11px;
            padding: 5px 10px;
            border: 1px solid #e3e0da;
            border-radius: 20px;
            background: #f0eade;
            color: #555550;
            font-size: 12px;
            font-weight: 700;
        }

        /* NAMA DAN DESKRIPSI */
        .product-name {
            margin: 0 0 9px;
            color: var(--text-heading);
            font-size: 17px;
            font-weight: 700;
            line-height: 1.45;
            overflow-wrap: anywhere;
        }

        .product-name a {
            color: var(--text-heading);
            text-decoration: none;
        }

        .product-name a:hover {
            color: #333333;
        }

        .product-description {
            display: -webkit-box;
            overflow: hidden;
            margin: 0 0 12px;
            color: #777773;
            font-size: 13px;
            line-height: 1.7;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }

        /* HARGA DAN STOK */
        .product-price {
            margin: 12px 0 7px;
            color: #080808;
            font-size: 20px;
            font-weight: 750;
            overflow-wrap: anywhere;
        }

        .product-stock {
            margin-bottom: 16px;
            color: var(--text-muted);
            font-size: 13px;
        }

        .product-out-of-stock {
            color: #ff3338;
            font-weight: 700;
        }

        /* TOMBOL DETAIL */
        .product-detail-button {
            width: 100%;
            margin-top: auto;
            text-align: center;
        }

        .product-detail-button:focus-visible,
        .product-filter button:focus-visible,
        .public-nav a:focus-visible {
            outline: 2px solid #333333;
            outline-offset: 3px;
        }

        /* KATALOG KOSONG */
        .product-empty {
            padding: 42px 22px;
            border: 1px dashed #d5d0c7;
            border-radius: 12px;
            background: var(--bg-card);
            color: var(--text-main);
            text-align: center;
        }

        .product-empty h2 {
            margin-top: 0;
            color: var(--text-heading);
            font-size: 20px;
        }

        .product-empty p {
            color: var(--text-muted);
        }

        /* FOOTER */
        .public-footer {
            margin-top: 55px;
            padding: 26px 20px;
            border-top: 1px solid var(--border);
            background: var(--bg-header);
            color: var(--text-muted);
            text-align: center;
            font-size: 13px;
        }

        /* LOGO KOTOKO */
        .public-header .public-logo {
            display: inline-flex;
            align-items: center;
            width: fit-content;
            text-decoration: none;
        }

        .public-header .public-logo-image {
            display: block;
            width: 120px;
            max-width: 100%;
            height: auto;
            object-fit: contain;
        }

        /* Ukuran logo di HP */
        @media (max-width: 550px) {
            .public-header .public-logo-image {
                width: 150px;
            }
        }

        /* TABLET */
        @media (max-width: 900px) {
            .product-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 18px;
            }

            .public-main {
                margin-top: 28px;
            }
        }

        /* HP */
        @media (max-width: 550px) {
            .public-header {
                padding: 18px 20px;
            }

            .public-nav {
                gap: 13px 17px;
            }

            .public-main {
                margin: 25px auto;
                padding: 0 15px;
            }

            .public-heading h1 {
                font-size: 25px;
            }

            .product-toolbar {
                padding: 12px;
            }

            .product-filter {
                flex-direction: column;
                align-items: stretch;
                width: 100%;
            }

            .product-filter input,
            .product-filter select,
            .product-filter button {
                width: 100%;
                min-width: 0;
            }

            .product-filter a {
                align-self: flex-start;
                padding: 5px 0;
            }

            .product-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px;
            }

            .product-image,
            .product-image-placeholder {
                height: 145px;
            }

            .product-card-body {
                padding: 12px;
            }

            .product-category {
                font-size: 10px;
                padding: 4px 7px;
            }

            .product-name {
                font-size: 14px;
            }

            .product-description {
                font-size: 12px;
            }

            .product-price {
                font-size: 16px;
            }

            .product-stock {
                font-size: 12px;
            }

            .product-detail-button {
                padding: 10px 8px;
                font-size: 12px;
            }
        }

        @media (max-width: 360px) {
            .product-grid {
                grid-template-columns: 1fr;
            }

            .product-image,
            .product-image-placeholder {
                height: 190px;
            }

            .product-card-body {
                padding: 16px;
            }
        }

        /* LAYOUT SIDEBAR FILTER DAN HASIL PRODUK */
        .catalog-layout {
            display: grid;
            grid-template-columns: 245px minmax(0, 1fr);
            align-items: start;
            gap: 24px;
        }

        .catalog-sidebar {
            min-width: 0;
        }

        .catalog-filter-form {
            padding: 20px;
            background: #fbf9f5;
            border: 1px solid #e3e0da;
            border-radius: 12px;
            box-shadow: 0 4px 14px rgb(0 0 0 / 5%);
        }

        .catalog-filter-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            padding-bottom: 16px;
        }

        .catalog-filter-heading h2 {
            margin: 0;
            color: #080808;
            font-size: 19px;
        }

        .catalog-filter-heading a {
            color: #333333;
            font-size: 12px;
            text-decoration: none;
        }

        .catalog-filter-heading a:hover {
            color: #555550;
        }

        .catalog-filter-section {
            padding: 18px 0;
            border-top: 1px solid #e3e0da;
        }

        .catalog-filter-section h3 {
            margin: 0 0 14px;
            color: #080808;
            font-size: 14px;
            font-weight: 700;
        }

        .catalog-radio {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin: 12px 0;
            color: #555550;
            font-size: 13px;
            line-height: 1.5;
            cursor: pointer;
        }

        .catalog-radio input {
            width: 15px;
            height: 15px;
            flex-shrink: 0;
            margin: 2px 0 0;
            accent-color: #080808;
            cursor: pointer;
        }

        .catalog-radio:hover {
            color: #080808;
        }

        .catalog-price-label {
            display: block;
            margin: 12px 0 7px;
            color: #555550;
            font-size: 12px;
        }

        .catalog-filter-form .catalog-price-input {
            width: 100%;
            min-width: 0;
            padding: 10px 11px;
            border: 1px solid #d5d0c7;
            border-radius: 7px;
            background: #ffffff;
            color: #080808;
            font: inherit;
            font-size: 13px;
        }

        .catalog-filter-form .catalog-price-input::placeholder {
            color: #99958d;
        }

        .catalog-filter-form .catalog-price-input:focus {
            outline: 2px solid #080808;
            outline-offset: 1px;
        }

        .catalog-apply-button {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #080808;
            border-radius: 8px;
            background: #080808;
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
        }

        .catalog-apply-button:hover {
            background: #333333;
        }

        .catalog-results {
            min-width: 0;
        }

        .catalog-results-toolbar {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .catalog-search-form {
            display: flex;
            flex: 1;
            min-width: 0;
            gap: 9px;
        }

        .catalog-search-form input {
            flex: 1;
            min-width: 0;
            padding: 12px 14px;
            border: 1px solid #d5d0c7;
            border-radius: 8px;
            background: #ffffff;
            color: #080808;
            font: inherit;
            font-size: 14px;
        }

        .catalog-search-form input::placeholder {
            color: #777773;
        }

        .catalog-search-form input:focus {
            outline: 2px solid #080808;
            outline-offset: 1px;
        }

        .catalog-search-form button {
            padding: 11px 17px;
            border: 1px solid #080808;
            border-radius: 8px;
            background: #080808;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
        }

        .catalog-search-form button:hover {
            background: #333333;
        }

        .catalog-results .product-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .catalog-pagination {
            margin-top: 24px;
            overflow-x: auto;
        }

        .catalog-sort-select {
            display: block;
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #d5d0c7;
            border-radius: 8px;
            background: #ffffff;
            color: #080808;
            font: inherit;
            font-size: 13px;
            cursor: pointer;
        }

        .catalog-sort-select:focus {
            outline: 2px solid #080808;
            outline-offset: 1px;
        }

        .catalog-sort-select option {
            background: #fbf9f5;
            color: #080808;
        }


        /* GRID KATALOG PENGGUNA: 3 PRODUK PER BARIS */
        .catalog-results .product-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
            align-items: stretch;
        }

        /* Nama produk maksimal 3 baris */
        .catalog-results .product-name {
            display: -webkit-box;
            overflow: hidden;
            overflow-wrap: anywhere;
            line-height: 1.5;
            max-height: 4.5em;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
        }

        .catalog-results-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 18px;
        }

        .catalog-total-items {
            margin: 0;
            color: var(--text-muted);
            font-size: 15px;
            line-height: 1.5;
        }

        .catalog-total-items strong {
            color: var(--text-heading);
            font-weight: 600;
        }

        /* Responsif untuk tablet */
        @media (max-width: 900px) {
            .catalog-results .product-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        /* Responsif untuk HP */
        @media (max-width: 480px) {
            .catalog-results .product-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px;
            }
        }


        /* Responsif untuk tablet */
        @media (max-width: 900px) {
            .catalog-results .product-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        /* Responsif untuk HP */
        @media (max-width: 480px) {
            .catalog-results .product-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px;
            }
        }


        /* TABLET */
        @media (max-width: 900px) {
            .catalog-layout {
                grid-template-columns: 215px minmax(0, 1fr);
                gap: 16px;
            }

            .catalog-filter-form {
                padding: 15px;
            }

            .catalog-results .product-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        /* HP: FILTER DI ATAS PRODUK */
        @media (max-width: 650px) {
            .catalog-layout {
                grid-template-columns: minmax(0, 1fr);
                gap: 20px;
            }

            .catalog-filter-form {
                padding: 16px;
            }

            .catalog-filter-section {
                padding: 14px 0;
            }

            .catalog-results-toolbar {
                align-items: stretch;
            }

            .catalog-search-form {
                width: 100%;
                flex-basis: 100%;
            }

            .catalog-results .product-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 380px) {
            .catalog-results .product-grid {
                grid-template-columns: minmax(0, 1fr);
            }
        }

    </style>

</head>
<body>
    <header class="public-header">
        {{-- Logo toko --}}
        <a href="/" class="public-logo" aria-label="KOTOKO">
            <img
                src="{{ asset('images/KOTOKO black text1.png') }}"
                alt="KOTOKO"
                class="public-logo-image"
            >
        </a>

        {{-- Pencarian produk --}}
        <form action="{{ url('/produk') }}" method="GET" class="header-search">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari produk..."
                aria-label="Cari produk"
            >

            {{-- Pertahankan filter ketika melakukan pencarian --}}
            @foreach (['sort_by', 'category_id', 'min_price', 'max_price'] as $filter)
                @if (request()->filled($filter))
                    <input type="hidden" name="{{ $filter }}" value="{{ request($filter) }}">
                @endif
            @endforeach

            <button type="submit" aria-label="Cari produk">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    aria-hidden="true"
                >
                    <circle cx="11" cy="11" r="7"></circle>
                    <path d="m20 20-4-4"></path>
                </svg>
            </button>
        </form>

        {{-- Keranjang dan akun --}}
        <nav class="public-nav" aria-label="Menu akun">
            @auth
                <a href="{{ url('/keranjang') }}" class="cart-link" aria-label="Keranjang">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                </a>
            @endauth

            @auth
                @if (auth()->user()->is_admin)
                    <a href="/admin/dashboard">Dashboard Admin</a>
                @endif

                <span class="customer-greeting">
                    Hello, <strong>{{ auth()->user()->name }}</strong>
                </span>

                <form action="{{ url('/logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-button">Logout</button>
                </form>
            @else
                <a href="{{ route('register') }}" class="register-link">Daftar</a>
                <a href="{{ route('login') }}" class="login-link">Login</a>
            @endauth
        </nav>
    </header>

    <main class="public-main">
        <div class="public-heading">
            <h1>Catalog</h1>
            <p>Temukan produk yang kamu butuhkan di KOTOKO.</p>
        </div>

        @include('products.partials.catalog')
    </main>

    <footer class="public-footer">
        &copy; {{ date('Y') }} KOTOKO. All Rights Reserved.
    </footer>
</body>
</html>
