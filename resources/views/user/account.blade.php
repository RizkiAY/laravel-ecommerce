<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Saya | KOTOKO</title>
    <style>
        * { box-sizing: border-box; }
        :root {
            color-scheme: light;
            --bg-main: #fbf9f5;
            --bg-header: #f5f1e9;
            --bg-card: #fbf9f5;
            --bg-input: #fff;
            --bg-hover: #f0eade;
            --border: #e3e0da;
            --text-main: #080808;
            --text-muted: #777773;
            --accent: #080808;
            --accent-hover: #333;
        }
        body { margin: 0; font-family: Arial, sans-serif; background: var(--bg-main); color: var(--text-main); line-height: 1.5; }
        a { color: inherit; }

        /* Header mengikuti halaman katalog KOTOKO */
        .public-header { display:flex; align-items:center; gap:32px; padding:8px 4%; background:var(--bg-header); border-bottom:1px solid var(--border); box-shadow:0 4px 18px rgb(0 0 0 / 5%); }
        .public-logo { display:inline-flex; align-items:center; flex:0 0 auto; text-decoration:none; }
        .public-logo img { display:block; width:120px; max-width:100%; height:auto; object-fit:contain; }
        .header-search { display:flex; flex:1 1 auto; min-width:100px; max-width:750px; margin-left:12px; }
        .header-search input { width:100%; min-width:0; padding:12px 14px; border:1px solid #d5d0c7; border-right:0; border-radius:8px 0 0 8px; background:#fff; color:var(--text-main); font:14px Arial,sans-serif; }
        .header-search input:focus { outline:2px solid var(--accent); outline-offset:-2px; }
        .header-search button { flex:0 0 46px; display:inline-flex; align-items:center; justify-content:center; border:1px solid var(--accent); border-radius:0 8px 8px 0; background:var(--accent); color:#fff; cursor:pointer; }
        .header-right { display:flex; align-items:center; gap:20px; margin-left:auto; }
        .cart-link { display:inline-flex; align-items:center; color:var(--text-main); text-decoration:none; }
        .cart-link svg { width:23px; height:23px; }
        .account-wrap { position:relative; }
        .account-trigger { display:flex; align-items:center; gap:10px; padding:5px 8px; border:0; border-radius:9px; background:transparent; color:var(--text-main); text-align:left; cursor:pointer; }
        .account-trigger:hover, .account-trigger[aria-expanded="true"] { background:var(--bg-hover); }
        .account-avatar { width:42px; height:42px; flex:0 0 42px; display:flex; align-items:center; justify-content:center; overflow:hidden; border-radius:50%; background:#e7e3dc; color:#555; font-weight:700; }
        .account-avatar img { width:100%; height:100%; object-fit:cover; }
        .greeting { display:block; color:var(--text-muted); font-size:12px; line-height:1.3; }
        .account-name { display:block; max-width:150px; overflow:hidden; color:var(--text-main); font-size:14px; font-weight:700; text-overflow:ellipsis; white-space:nowrap; }
        .chevron { width:14px; height:14px; transition:transform .2s; }
        .account-trigger[aria-expanded="true"] .chevron { transform:rotate(180deg); }
        .account-dropdown { position:absolute; z-index:20; top:calc(100% + 12px); right:0; width:290px; padding:18px; border:1px solid var(--border); border-radius:12px; background:#fff; box-shadow:0 12px 35px rgb(0 0 0 / 13%); display:none; }
        .account-dropdown.open { display:block; }
        .dropdown-user { display:flex; align-items:center; gap:12px; padding-bottom:15px; border-bottom:1px solid var(--border); }
        .dropdown-user strong { font-size:16px; }
        .dropdown-link { display:flex; align-items:center; gap:12px; padding:11px 4px; border-bottom:1px solid #f0eee9; color:#444; font-size:14px; text-decoration:none; }
        .dropdown-link:last-of-type { border-bottom:0; }
        .dropdown-link:hover { color:#000; background:#faf8f3; }
        .dropdown-icon { width:32px; height:32px; display:flex; align-items:center; justify-content:center; border-radius:50%; background:#f0eee9; font-size:15px; }
        .dropdown-arrow { margin-left:auto; font-size:20px; }
        .logout-form { margin-top:8px; padding-top:8px; border-top:1px solid var(--border); }
        .logout-button { width:100%; display:flex; align-items:center; gap:12px; padding:10px 4px; border:0; background:transparent; color:#b52b2b; font:14px Arial,sans-serif; text-align:left; cursor:pointer; }
        .guest-links { display:flex; gap:10px; align-items:center; }
        .guest-links a { padding:9px 13px; border-radius:7px; text-decoration:none; font-size:13px; }
        .guest-links a:last-child { background:var(--accent); color:#fff; }

        /* Layout halaman akun */
        .account-page { max-width:1200px; margin:34px auto 60px; padding:0 22px; }
        .page-heading { margin-bottom:22px; }
        .page-heading h1 { margin:0 0 5px; font-size:30px; font-weight:500; letter-spacing:-1px; }
        .page-heading p { margin:0; color:var(--text-muted); font-size:14px; }
        .account-layout { display:grid; grid-template-columns:285px minmax(0,1fr); align-items:start; gap:22px; }
        .sidebar, .content-card { border:1px solid var(--border); border-radius:13px; background:var(--bg-card); box-shadow:0 4px 14px rgb(0 0 0 / 4%); }
        .sidebar { overflow:hidden; }
        .sidebar-user { display:flex; align-items:center; gap:12px; padding:20px 18px; border-bottom:1px solid var(--border); }
        .sidebar-avatar { width:52px; height:52px; flex:0 0 52px; display:flex; align-items:center; justify-content:center; overflow:hidden; border-radius:50%; background:#e7e3dc; color:#555; font-size:18px; font-weight:700; }
        .sidebar-avatar img { width:100%; height:100%; object-fit:cover; }
        .sidebar-user-name { min-width:0; font-size:15px; font-weight:700; overflow-wrap:anywhere; }
        .sidebar-user-caption { color:var(--text-muted); font-size:12px; }
        .sidebar-menu { padding:12px; }
        .sidebar-main-link, .sidebar-sub-link { width:100%; display:flex; align-items:center; gap:11px; padding:12px 11px; border:0; border-radius:8px; background:transparent; color:#37352f; font:14px Arial,sans-serif; text-align:left; text-decoration:none; cursor:pointer; }
        .sidebar-main-link:hover, .sidebar-sub-link:hover { background:var(--bg-hover); }
        .sidebar-main-link.active, .sidebar-sub-link.active { background:var(--bg-hover); color:#080808; font-weight:700; }
        .side-icon { width:27px; text-align:center; font-size:17px; }
        .side-chevron { margin-left:auto; transition:transform .2s; }
        .sidebar-main-link[aria-expanded="true"] .side-chevron { transform:rotate(90deg); }
        .submenu { display:none; padding:3px 0 7px 38px; }
        .submenu.open { display:block; }
        .sidebar-sub-link { padding:9px 10px; color:#66635c; font-size:13px; }
        .sidebar-divider { height:1px; margin:9px 4px; background:var(--border); }
        .content-card { min-height:480px; padding:26px; }
        .content-heading { margin:0 0 5px; font-size:22px; font-weight:600; }
        .content-description { margin:0 0 24px; color:var(--text-muted); font-size:13px; }

        /* Satu card untuk seluruh informasi profil */
        .profile-info-card {
            padding: 24px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 2px 8px rgb(0 0 0 / 3%);
        }

        /* Judul dan deskripsi profil */
        .profile-info-header {
            margin-bottom: 22px;
        }

        .profile-info-header h2 {
            margin: 0 0 5px;
            font-size: 22px;
            font-weight: 600;
        }

        .profile-info-header p {
            margin: 0;
            color: var(--text-muted);
            font-size: 13px;
        }

        /* Bagian Biodata dan Kontak */
        .profile-section {
            margin-bottom: 24px;
        }

        .profile-section-title {
            margin: 0 0 12px;
            font-size: 16px;
            font-weight: 700;
        }

        /* Card putih khusus data */
        .profile-detail-card {
            padding: 20px 22px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 2px 8px rgb(0 0 0 / 3%);
        }

        .profile-detail-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .profile-detail {
            display: grid;
            grid-template-columns: 150px minmax(0, 1fr);
            gap: 12px;
            align-items: start;
            font-size: 14px;
        }

        .profile-detail span {
            color: var(--text-muted);
        }

        .profile-detail strong {
            color: var(--text-main);
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .profile-section-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
        }

        .profile-section-heading .profile-section-title {
            margin: 0;
        }

        .profile-edit-button {
            border: none;
            background: transparent;
            color: #2563eb;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .profile-edit-button:hover {
            color: #1d4ed8;
        }

        .profile-modal {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 9999;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(15, 23, 42, 0.55);
        }

        .profile-modal.active {
            display: flex;
        }

        .profile-modal-content {
            width: 100%;
            max-width: 430px;
            padding: 24px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.2);
        }

        .profile-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
        }

        .profile-modal-header h3 {
            margin: 0;
            color: #1e293b;
            font-size: 18px;
        }

        .profile-modal-close {
            border: none;
            background: transparent;
            color: #64748b;
            font-size: 26px;
            cursor: pointer;
        }

        .profile-form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 16px;
        }

        .profile-form-group label {
            color: #334155;
            font-size: 14px;
            font-weight: 600;
        }

        .profile-form-group input,
        .profile-form-group select {
            width: 100%;
            box-sizing: border-box;
            padding: 11px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            background: #fff;
            color: #1e293b;
            font-family: inherit;
            font-size: 14px;
            outline: none;
        }

        .profile-form-group input:focus,
        .profile-form-group select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12);
        }

        .profile-modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 24px;
        }

        .profile-cancel-button,
        .profile-save-button {
            padding: 10px 16px;
            border: none;
            border-radius: 7px;
            font-family: inherit;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .profile-cancel-button {
            background: #f1f5f9;
            color: #475569;
        }

        .profile-save-button {
            background: #2563eb;
            color: #fff;
        }

        .profile-save-button:hover {
            background: #1d4ed8;
        }

        @media (max-width: 650px) {
            .profile-detail-card {
                padding: 17px 15px;
            }

            .profile-detail {
                grid-template-columns: 115px minmax(0, 1fr);
                gap: 8px;
                font-size: 13px;
            }
        }
        .section-title { margin:25px 0 12px; padding-bottom:10px; border-bottom:1px solid var(--border); font-size:16px; font-weight:700; }
        .profile-grid { display:grid; grid-template-columns:1fr 1fr; gap:13px; }
        .data-field { min-width:0; padding:14px 15px; border:1px solid var(--border); border-radius:9px; background:#fff; }
        .data-label { display:block; margin-bottom:5px; color:var(--text-muted); font-size:12px; }
        .data-value { display:block; overflow-wrap:anywhere; color:var(--text-main); font-size:14px; font-weight:600; }
        .empty-state { padding:45px 20px; border:1px dashed #d5d0c7; border-radius:10px; color:var(--text-muted); text-align:center; }
        .empty-state strong { display:block; margin-bottom:6px; color:#333; font-size:15px; }
        .table-wrap { width:100%; overflow-x:auto; }
        .orders-table { width:100%; border-collapse:collapse; font-size:13px; }
        .orders-table th, .orders-table td { padding:13px 12px; border-bottom:1px solid var(--border); text-align:left; white-space:nowrap; }
        .orders-table th { background:#f5f1e9; color:#555; font-weight:700; }
        .status { display:inline-block; padding:4px 9px; border-radius:20px; background:#f0eade; color:#5a5142; font-size:11px; }
        .address-card, .bank-card { padding:16px; border:1px solid var(--border); border-radius:10px; background:#fff; }
        .address-card + .address-card, .bank-card + .bank-card { margin-top:12px; }
        .item-title { margin:0 0 7px; font-size:14px; font-weight:700; }
        .muted { color:var(--text-muted); font-size:13px; }
        .site-footer { padding:25px 15px; border-top:1px solid var(--border); background:var(--bg-header); color:var(--text-muted); text-align:center; font-size:13px; }

        @media (max-width:900px) {
            .public-header { gap:16px; padding:10px 3%; }
            .public-logo img { width:100px; }
            .account-layout { grid-template-columns:245px minmax(0,1fr); gap:15px; }
            .content-card { padding:21px; }
        }
        @media (max-width:650px) {
            .public-header { flex-wrap:wrap; gap:10px; padding:12px 15px; }
            .public-logo img { width:95px; }
            .header-search { order:3; flex:1 0 100%; max-width:none; margin:0; }
            .header-right { gap:12px; }
            .account-name { max-width:100px; }
            .account-avatar { width:36px; height:36px; flex-basis:36px; }
            .account-page { margin:24px auto 40px; padding:0 14px; }
            .account-layout { grid-template-columns:minmax(0,1fr); }
            .sidebar-user { padding:14px 16px; }
            .sidebar-menu { padding:8px 12px; }
            .content-card { min-height:0; padding:19px 15px; }
            .profile-grid { grid-template-columns:1fr; }
            .account-dropdown { width:min(290px, calc(100vw - 25px)); }
        }
    </style>
</head>
<body>
<header class="public-header">
    <a href="{{ url('/') }}" class="public-logo" aria-label="KOTOKO">
        <img src="{{ asset('images/KOTOKO black text1.png') }}" alt="KOTOKO">
    </a>
    <form action="{{ url('/produk') }}" method="GET" class="header-search">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." aria-label="Cari produk">
        <button type="submit" aria-label="Cari produk">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="7"></circle><path d="m20 20-4-4"></path></svg>
        </button>
    </form>
    <div class="header-right">
        @auth
            <a href="{{ url('/keranjang') }}" class="cart-link" aria-label="Keranjang">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
            </a>
            <div class="account-wrap">
                <button type="button" class="account-trigger" id="accountTrigger" aria-expanded="false" aria-controls="accountDropdown">
                    <span class="account-avatar">
                        @if (!empty(auth()->user()->avatar))
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Foto profil">
                        @else
                            {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                        @endif
                    </span>
                    <span><span class="greeting">Hello,</span><span class="account-name">{{ auth()->user()->name }}</span></span>
                    <svg class="chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m6 9 6 6 6-6"></path></svg>
                </button>
                <div class="account-dropdown" id="accountDropdown">
                    <div class="dropdown-user">
                        <span class="account-avatar">
                            @if (!empty(auth()->user()->avatar)) <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Foto profil"> @else {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }} @endif
                        </span>
                        <strong>{{ auth()->user()->name }}</strong>
                    </div>
                    <a class="dropdown-link" href="{{ url('/profile?tab=profile') }}"><span class="dropdown-icon">♙</span>Edit Profile<span class="dropdown-arrow">›</span></a>
                    <a class="dropdown-link" href="{{ url('/pesanan') }}"><span class="dropdown-icon">▤</span>Pesanan<span class="dropdown-arrow">›</span></a>
                    <a class="dropdown-link" href="{{ url('/profile?tab=bank') }}"><span class="dropdown-icon">⚙</span>Rekening Bank<span class="dropdown-arrow">›</span></a>
                    <a class="dropdown-link" href="{{ url('/profile?tab=address') }}"><span class="dropdown-icon">⌖</span>Alamat<span class="dropdown-arrow">›</span></a>
                    <form class="logout-form" action="{{ url('/logout') }}" method="POST">@csrf<button class="logout-button" type="submit"><span class="dropdown-icon">⇥</span>Logout</button></form>
                </div>
            </div>
        @else
            <div class="guest-links"><a href="{{ route('register') }}">Daftar</a><a href="{{ route('login') }}">Login</a></div>
        @endauth
    </div>
</header>

<main class="account-page">
    <div class="page-heading">
        <h1>Akun Saya</h1>
        <p>Kelola informasi akun, alamat, rekening bank, dan pesanan kamu.</p>
    </div>

    @php
        $activeTab = request('tab', 'profile');
        $user = auth()->user();
        $orders = $orders ?? collect();
        $bankAccounts = $bankAccounts ?? collect();
        $addresses = $addresses ?? collect();
    @endphp

    <div class="account-layout">
        <aside class="sidebar">
            <div class="sidebar-user">
                <span class="sidebar-avatar">
                    @if ($user && !empty($user->avatar)) <img src="{{ asset('storage/' . $user->avatar) }}" alt="Foto profil"> @else {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }} @endif
                </span>
                <div><div class="sidebar-user-name">{{ $user->name ?? 'Pengguna' }}</div><div class="sidebar-user-caption">Akun KOTOKO</div></div>
            </div>
            <nav class="sidebar-menu" aria-label="Navigasi akun">
                <button type="button" class="sidebar-main-link {{ in_array($activeTab, ['profile','bank','address']) ? 'active' : '' }}" id="accountMenuToggle" aria-expanded="{{ in_array($activeTab, ['profile','bank','address']) ? 'true' : 'false' }}" aria-controls="accountSubmenu">
                    <span class="side-icon">♙</span> Akun Saya <span class="side-chevron">›</span>
                </button>
                <div class="submenu {{ in_array($activeTab, ['profile','bank','address']) ? 'open' : '' }}" id="accountSubmenu">
                    <a class="sidebar-sub-link {{ $activeTab === 'profile' ? 'active' : '' }}" href="{{ url('/profile?tab=profile') }}">Profil</a>
                    <a class="sidebar-sub-link {{ $activeTab === 'bank' ? 'active' : '' }}" href="{{ url('/profile?tab=bank') }}">Rekening Bank</a>
                    <a class="sidebar-sub-link {{ $activeTab === 'address' ? 'active' : '' }}" href="{{ url('/profile?tab=address') }}">Alamat</a>
                </div>
                <div class="sidebar-divider"></div>
                <a class="sidebar-main-link {{ $activeTab === 'orders' ? 'active' : '' }}" href="{{ url('/profile?tab=orders') }}"><span class="side-icon">▤</span> Pesanan</a>
            </nav>
        </aside>

        <section class="content-card">
            @if ($activeTab === 'profile')

                {{-- Judul Profil --}}
                <div class="profile-info-header">
                    <h2>Kelola Profil</h2>
                    <p>Informasi pribadi dan kontak yang terhubung dengan akun kamu.</p>
                </div>

                {{-- Biodata Diri --}}
                <div class="profile-section">
                    <div class="profile-section-heading">
                        <h3 class="profile-section-title">Biodata Diri</h3>

                        <button type="button" class="profile-edit-button" data-modal-open="biodataModal">
                            Ubah
                        </button>
                    </div>

                    <div class="profile-detail-card">
                        <div class="profile-detail-list">
                            <div class="profile-detail">
                                <span>Username</span>
                                <strong>: {{ $user->name ?? '-' }}</strong>
                            </div>

                            <div class="profile-detail">
                                <span>Tanggal Lahir</span>
                                <strong>
                                    : {{ $user->date_of_birth ? \Illuminate\Support\Carbon::parse($user->date_of_birth)->format('d F Y') : '-' }}
                                </strong>
                            </div>

                            <div class="profile-detail">
                                <span>Jenis Kelamin</span>
                                <strong>: {{ $user->gender ? ucfirst($user->gender) : '-' }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kontak --}}
                <div class="profile-section">
                    <div class="profile-section-heading">
                        <h3 class="profile-section-title">Kontak</h3>

                        <button type="button" class="profile-edit-button" data-modal-open="kontakModal">
                            Ubah
                        </button>
                    </div>

                    <div class="profile-detail-card">
                        <div class="profile-detail-list">
                            <div class="profile-detail">
                                <span>Email</span>
                                <strong>: {{ $user->email ?? '-' }}</strong>
                            </div>

                            <div class="profile-detail">
                                <span>Nomor HP</span>
                                <strong>: {{ $user->phone ?? '-' }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal Biodata --}}
                <div class="profile-modal" id="biodataModal">
                    <div class="profile-modal-content">
                        <div class="profile-modal-header">
                            <h3>Ubah Biodata Diri</h3>
                            <button type="button" class="profile-modal-close" data-modal-close>&times;</button>
                        </div>

                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="profile-form-group">
                                <label for="edit-name">Username</label>
                                <input
                                    type="text"
                                    id="edit-name"
                                    name="name"
                                    value="{{ old('name', $user->name) }}"
                                    required
                                >
                            </div>

                            <div class="profile-form-group">
                                <label for="edit-date-of-birth">Tanggal Lahir</label>
                                <input
                                    type="date"
                                    id="edit-date-of-birth"
                                    name="date_of_birth"
                                    value="{{ old('date_of_birth', $user->date_of_birth) }}"
                                >
                            </div>

                            <div class="profile-form-group">
                                <label for="edit-gender">Jenis Kelamin</label>
                                <select id="edit-gender" name="gender">
                                    <option value="">Pilih jenis kelamin</option>
                                    <option value="laki-laki" @selected(old('gender', $user->gender) === 'laki-laki')>
                                        Laki-laki
                                    </option>
                                    <option value="perempuan" @selected(old('gender', $user->gender) === 'perempuan')>
                                        Perempuan
                                    </option>
                                </select>
                            </div>

                            <div class="profile-modal-actions">
                                <button type="button" class="profile-cancel-button" data-modal-close>
                                    Batal
                                </button>
                                <button type="submit" class="profile-save-button">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Modal Kontak --}}
                <div class="profile-modal" id="kontakModal">
                    <div class="profile-modal-content">
                        <div class="profile-modal-header">
                            <h3>Ubah Informasi Kontak</h3>
                            <button type="button" class="profile-modal-close" data-modal-close>&times;</button>
                        </div>

                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="profile-form-group">
                                <label for="edit-email">Email</label>
                                <input
                                    type="email"
                                    id="edit-email"
                                    name="email"
                                    value="{{ old('email', $user->email) }}"
                                    required
                                >
                            </div>

                            <div class="profile-form-group">
                                <label for="edit-phone">Nomor HP</label>
                                <input
                                    type="text"
                                    id="edit-phone"
                                    name="phone"
                                    value="{{ old('phone', $user->phone) }}"
                                >
                            </div>

                            <div class="profile-modal-actions">
                                <button type="button" class="profile-cancel-button" data-modal-close>
                                    Batal
                                </button>
                                <button type="submit" class="profile-save-button">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            @elseif ($activeTab === 'bank')
                <h2 class="content-heading">Rekening Bank</h2>
                <p class="content-description">Daftar rekening bank yang tersimpan pada akun kamu.</p>
                @forelse ($bankAccounts as $bank)
                    <div class="bank-card"><h3 class="item-title">{{ $bank->bank_name ?? 'Rekening Bank' }}</h3><div class="muted">{{ $bank->account_name ?? '' }}</div><strong>{{ $bank->account_number ?? '' }}</strong></div>
                @empty
                    <div class="empty-state"><strong>Belum ada rekening bank tersimpan</strong>Rekening bank yang kamu simpan akan ditampilkan di sini.</div>
                @endforelse
            @elseif ($activeTab === 'address')
                <h2 class="content-heading">Alamat Saya</h2>
                <p class="content-description">Daftar alamat pengiriman yang tersimpan pada akun kamu.</p>
                @forelse ($addresses as $address)
                    <div class="address-card"><h3 class="item-title">{{ $address->label ?? 'Alamat' }}</h3><strong>{{ $address->recipient_name ?? $user->name }}</strong><div class="muted">{{ $address->phone ?? '' }}</div><p class="muted">{{ $address->address ?? '' }} {{ $address->city ?? '' }} {{ $address->postal_code ?? '' }}</p></div>
                @empty
                    <div class="empty-state"><strong>Belum ada alamat tersimpan</strong>Alamat pengiriman yang kamu simpan akan ditampilkan di sini.</div>
                @endforelse
            @elseif ($activeTab === 'orders')
                <h2 class="content-heading">Daftar Pesanan</h2>
                <p class="content-description">Lihat riwayat dan status pesanan kamu.</p>
                @if ($orders->isNotEmpty())
                    <div class="table-wrap"><table class="orders-table"><thead><tr><th>No. Pesanan</th><th>Tanggal</th><th>Total</th><th>Status</th></tr></thead><tbody>
                        @foreach ($orders as $order)
                            <tr><td>#{{ $order->id }}</td><td>{{ optional($order->created_at)->format('d-m-Y') }}</td><td>Rp {{ number_format((float) $order->total, 0, ',', '.') }}</td><td><span class="status">{{ ucfirst($order->status ?? 'pending') }}</span></td></tr>
                        @endforeach
                    </tbody></table></div>
                @else
                    <div class="empty-state"><strong>Belum ada pesanan</strong>Pesanan yang berhasil kamu buat akan muncul di halaman ini.</div>
                @endif
            @else
                <h2 class="content-heading">Akun Saya</h2><p class="content-description">Pilih menu di samping untuk melihat informasi akun.</p>
            @endif
        </section>
    </div>
</main>
<footer class="site-footer">&copy; {{ date('Y') }} KOTOKO. All Rights Reserved.</footer>

<script>
    const accountTrigger = document.getElementById('accountTrigger');
    const accountDropdown = document.getElementById('accountDropdown');
    if (accountTrigger && accountDropdown) {
        accountTrigger.addEventListener('click', function () {
            const isOpen = accountDropdown.classList.toggle('open');
            accountTrigger.setAttribute('aria-expanded', String(isOpen));
        });
        document.addEventListener('click', function (event) {
            if (!event.target.closest('.account-wrap')) {
                accountDropdown.classList.remove('open');
                accountTrigger.setAttribute('aria-expanded', 'false');
            }
        });
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                accountDropdown.classList.remove('open');
                accountTrigger.setAttribute('aria-expanded', 'false');
            }
        });
    }

    const accountMenuToggle = document.getElementById('accountMenuToggle');
    const accountSubmenu = document.getElementById('accountSubmenu');
    if (accountMenuToggle && accountSubmenu) {
        accountMenuToggle.addEventListener('click', function () {
            const isOpen = accountSubmenu.classList.toggle('open');
            accountMenuToggle.setAttribute('aria-expanded', String(isOpen));
        });
    }
</script>

<script>
    document.querySelectorAll('[data-modal-open]').forEach(button => {
        button.addEventListener('click', () => {
            const modalId = button.dataset.modalOpen;
            document.getElementById(modalId)?.classList.add('active');
        });
    });

    document.querySelectorAll('[data-modal-close]').forEach(button => {
        button.addEventListener('click', () => {
            button.closest('.profile-modal')?.classList.remove('active');
        });
    });

    document.querySelectorAll('.profile-modal').forEach(modal => {
        modal.addEventListener('click', event => {
            if (event.target === modal) {
                modal.classList.remove('active');
            }
        });
    });

    document.addEventListener('keydown', event => {
        if (event.key === 'Escape') {
            document.querySelectorAll('.profile-modal.active').forEach(modal => {
                modal.classList.remove('active');
            });
        }
    });
</script>
</body>
</html>
