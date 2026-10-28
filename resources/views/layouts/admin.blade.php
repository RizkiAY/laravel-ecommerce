<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            color-scheme: dark;
            --bg-main: #0b1120;
            --bg-sidebar: #020617;
            --bg-panel: #111827;
            --bg-input: #0f172a;
            --bg-hover: #1e293b;
            --border-color: #334155;
            --text-main: #e2e8f0;
            --text-muted: #94a3b8;
            --accent: #2563eb;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: var(--bg-main);
            color: var(--text-main);
        }

        .admin-layout {
            display: flex;
            min-height: 100vh;
            background: var(--bg-main);
        }

        /* SIDEBAR STICKY */
        .admin-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 245px;
            height: 100vh;
            flex-shrink: 0;
            padding: 25px 16px;
            background: var(--bg-sidebar);
            color: #f8fafc;
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            z-index: 1000;
        }

        .admin-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            min-height: 10px;
            margin-bottom: 10px;
            text-decoration: none;
        }

        .admin-brand-logo {
            display: block;
            width: 100%;
            max-width: 250px;
            height: 100px;
            object-fit: contain;
            object-position: center;
            margin: 0 auto;
        }

        .admin-brand span {
            color: #38bdf8;
        }

        .admin-menu-label {
            padding: 0 12px;
            margin-bottom: 12px;
            color: var(--text-muted);
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .admin-menu {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .admin-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 12px;
            border-radius: 8px;
            color: #cbd5e1;
            text-decoration: none;
            font-size: 14px;
            transition: background 0.2s ease;
        }

        .admin-menu a svg {
            display: block;
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .admin-menu a:hover,
        .admin-menu a.active {
            background: #1d4ed8;
            color: #ffffff;
        }

        /* LOGOUT DI BAGIAN BAWAH SIDEBAR */
        .admin-sidebar-bottom {
            margin-top: auto;
            padding-top: 30px;
        }

        .admin-sidebar-bottom form {
            margin: 0;
        }

        .admin-logout {
            width: 100%;
            padding: 12px;
            border: 1px solid #475569;
            border-radius: 8px;
            background: transparent;
            color: #e2e8f0;
            text-align: left;
            font-size: 14px;
            cursor: pointer;
        }

        .admin-logout:hover {
            background: #1e293b;
        }

        .admin-logout-button {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            padding: 13px 12px;
            border: 1px solid #29323f;
            border-radius: 8px;
            background: transparent;
            color: #cbd5e1;
            font-size: 14px;
            text-align: left;
            cursor: pointer;
            transition: background 0.2s ease, color 0.2s ease;
        }

        .admin-logout-button svg {
            display: block;
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .admin-logout-button:hover {
            background: #d81d5b;
            color: #ffffff;
        }

        /* KONTEN UTAMA */
        .admin-main {
            flex: 1;
            min-width: 0;
            margin-left: 245px;
            padding: 32px;
            background: var(--bg-main);
        }

        .admin-page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 28px;
        }

        .admin-page-header h1 {
            margin: 0 0 8px;
            color: #f8fafc;
            font-size: 28px;
        }

        .admin-subtitle {
            margin: 0;
            color: var(--text-muted);
            font-size: 14px;
        }

        .admin-user-badge {
            padding: 10px 14px;
            background: var(--bg-panel);
            color: var(--text-main);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            font-size: 13px;    
            font-weight: 700;
        }

        .admin-alert {
            margin-bottom: 20px;
            padding: 13px 16px;
            border: 1px solid #065f46;
            border-radius: 8px;
            background: #064e3b;
            color: #a7f3d0;
        }

        .admin-content {
            min-width: 0;
            color: var(--text-main);
        }

        /* KOMPONEN UMUM DI DALAM HALAMAN ADMIN */
        .admin-content .category-panel,
        .admin-content .category-item,
        .admin-content .product-card,
        .admin-content .admin-card,
        .admin-content .card,
        .admin-content .panel {
            background: var(--bg-panel);
            color: var(--text-main);
            border-color: var(--border-color);
        }

        .admin-content h1,
        .admin-content h2,
        .admin-content h3,
        .admin-content h4,
        .admin-content strong,
        .admin-content label {
            color: #f1f5f9;
        }

        .admin-content p {
            color: #cbd5e1;
        }

        .admin-content input,
        .admin-content textarea,
        .admin-content select {
            background: var(--bg-input);
            color: #f1f5f9;
            border: 1px solid #475569;
        }

        .admin-content input::placeholder,
        .admin-content textarea::placeholder {
            color: #94a3b8;
        }

        .admin-content input:focus,
        .admin-content textarea:focus,
        .admin-content select:focus {
            outline: 2px solid #3b82f6;
            outline-offset: 1px;
        }

        .admin-content table {
            width: 100%;
            color: var(--text-main);
            border-color: var(--border-color);
        }

        .admin-content th {
            background: #1e293b;
            color: #f8fafc;
        }

        .admin-content td,
        .admin-content th {
            border-color: var(--border-color);
        }

        .admin-content .category-empty {
            background: #1e293b;
            color: #cbd5e1;
        }

        /* WARNA STATUS */
        .admin-content .category-success {
            background: #064e3b;
            color: #a7f3d0;
            border-color: #065f46;
        }

        .admin-content .category-alert-error {
            background: #7f1d1d;
            color: #fecaca;
            border-color: #991b1b;
        }

        /* TOMBOL UMUM */
        .admin-content button,
        .admin-content .category-button {
            transition: filter 0.2s ease;
        }

        .admin-content button:hover,
        .admin-content .category-button:hover {
            filter: brightness(1.12);
        }

        /* RESPONSIVE MOBILE */
        @media (max-width: 650px) {
            .admin-layout {
                display: flex;
                flex-direction: column;
            }

            .admin-sidebar {
                position: relative;
                top: auto;
                left: auto;
                bottom: auto;
                width: 100%;
                height: auto;
                max-height: none;
                padding: 18px 14px;
                overflow-y: visible;
            }

            .admin-brand {
                padding: 0 8px 18px;
            }

            .admin-menu {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .admin-sidebar-bottom {
                padding-top: 15px;
            }

            .admin-main {
                margin-left: 0;
                padding: 22px 15px;
            }

            .admin-page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .admin-page-header h1 {
                font-size: 24px;
            }
        }

        /* Latar dan teks seluruh konten admin */
        .admin-content {
            background-color: transparent;
            color: #e2e8f0;
        }

        /* Card dan panel dengan berbagai nama class */
        .admin-content .card,
        .admin-content .panel,
        .admin-content .stat-card,
        .admin-content .stats-card,
        .admin-content .dashboard-card,
        .admin-content .summary-card,
        .admin-content .metric-card,
        .admin-content .stat-box,
        .admin-content .info-box,
        .admin-content .small-box,
        .admin-content .widget,
        .admin-content .box,
        .admin-content [class*="stat-card"],
        .admin-content [class*="dashboard-card"],
        .admin-content [class*="summary-card"],
        .admin-content [class*="metric-card"] {
            background-color: #111827 !important;
            color: #e2e8f0 !important;
            border-color: #334155 !important;
            box-shadow: 0 4px 14px rgb(0 0 0 / 15%);
        }

        /* Paksa teks dalam card agar terbaca */
        .admin-content .card *,
        .admin-content .panel *,
        .admin-content .stat-card *,
        .admin-content .stats-card *,
        .admin-content .dashboard-card *,
        .admin-content .summary-card *,
        .admin-content .metric-card *,
        .admin-content .stat-box *,
        .admin-content .info-box *,
        .admin-content .small-box *,
        .admin-content .widget *,
        .admin-content .box * {
            border-color: #334155;
        }

        /* Judul dan angka statistik */
        .admin-content .card h1,
        .admin-content .card h2,
        .admin-content .card h3,
        .admin-content .card h4,
        .admin-content .card strong,
        .admin-content .panel h1,
        .admin-content .panel h2,
        .admin-content .panel h3,
        .admin-content .panel h4,
        .admin-content .panel strong,
        .admin-content [class*="stat"] h1,
        .admin-content [class*="stat"] h2,
        .admin-content [class*="stat"] h3,
        .admin-content [class*="stat"] strong {
            color: #f8fafc !important;
        }

        /* Teks, label, dan deskripsi */
        .admin-content p,
        .admin-content label,
        .admin-content small,
        .admin-content .text-muted,
        .admin-content .description {
            color: #cbd5e1;
        }

        /* Tabel */
        .admin-content table {
            background-color: #111827 !important;
            color: #e2e8f0 !important;
            border-color: #334155 !important;
        }

        .admin-content thead,
        .admin-content thead tr,
        .admin-content th {
            background-color: #1e293b !important;
            color: #f8fafc !important;
            border-color: #334155 !important;
        }

        .admin-content tbody tr,
        .admin-content td {
            background-color: #111827 !important;
            color: #e2e8f0 !important;
            border-color: #334155 !important;
        }

        /* Input, dropdown, dan textarea */
        .admin-content input,
        .admin-content select,
        .admin-content textarea {
            background-color: #0f172a !important;
            color: #f1f5f9 !important;
            border-color: #475569 !important;
        }

        .admin-content input::placeholder,
        .admin-content textarea::placeholder {
            color: #94a3b8 !important;
        }

        /* Link */
        .admin-content a {
            color: #60a5fa;
        }

        .admin-content a:hover {
            color: #93c5fd;
        }

        /* Garis pemisah */
        .admin-content hr {
            border-color: #334155;
        }

        /* Panel kosong */
        .admin-content .category-empty {
            background-color: #1e293b !important;
            color: #cbd5e1 !important;
            border-color: #334155 !important;
        }

    </style>

    @stack('styles')
</head>

<body>
    <div class="admin-layout">

        <aside class="admin-sidebar">

            <a href="{{ url('/admin/dashboard') }}" class="admin-brand">
                <img
                    src="{{ asset('images/KOTOKO white text1.png') }}"
                    alt="Logo kotoko"
                    class="admin-brand-logo"
                >
            </a>

            <div class="admin-menu-label">MENU UTAMA</div>

            <nav class="admin-menu">
                {{-- Dashboard --}}
                <a href="/admin/dashboard"
                class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round"
                        aria-hidden="true">
                        <rect x="3" y="3" width="7" height="7" rx="1.5"/>
                        <rect x="14" y="3" width="7" height="7" rx="1.5"/>
                        <rect x="14" y="14" width="7" height="7" rx="1.5"/>
                        <rect x="3" y="14" width="7" height="7" rx="1.5"/>
                    </svg>
                    <span>Dashboard</span>
                </a>

                {{-- Produk --}}
                <a href="/produk"
                class="{{ request()->is('produk') || request()->is('produk/*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round"
                        aria-hidden="true">
                        <path d="m12 3 9 5-9 5-9-5 9-5Z"/>
                        <path d="m3 12 9 5 9-5"/>
                        <path d="m3 16 9 5 9-5"/>
                    </svg>
                    <span>Produk</span>
                </a>

                {{-- Kategori --}}
                <a href="/kategori"
                class="{{ request()->is('kategori') || request()->is('kategori/*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round"
                        aria-hidden="true">
                        <rect x="3" y="4" width="18" height="6" rx="1.5"/>
                        <rect x="3" y="14" width="18" height="6" rx="1.5"/>
                    </svg>
                    <span>Kategori</span>
                </a>

                {{-- Pesanan --}}
                <a href="/pesanan"
                class="{{ request()->is('pesanan') || request()->is('pesanan/*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round"
                        aria-hidden="true">
                        <path d="M6 2h9l5 5v15H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2Z"/>
                        <path d="M14 2v6h6"/>
                        <path d="M8 13h8"/>
                        <path d="M8 17h8"/>
                    </svg>
                    <span>Pesanan</span>
                </a>
            </nav>

            <div class="admin-sidebar-bottom">
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="admin-logout-button">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            width="20"
                            height="20"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                            <path d="M16 17l5-5-5-5"/>
                            <path d="M21 12H9"/>
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="admin-main">
            <header class="admin-page-header">
                <div>
                    <h1>@yield('page_heading', 'Dashboard')</h1>
                    <p class="admin-subtitle">
                        @yield('page_description', 'Kelola toko online KOTOKO.')
                    </p>
                </div>

                <div class="admin-user-badge">
                    Admin: <strong>{{ auth()->user()->name }}</strong>
                </div>
            </header>

            @if (session('success'))
                <div class="admin-alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="admin-content">
                @yield('content')
            </div>
        </main>

    </div>

    @stack('scripts')
</body>
</html>
