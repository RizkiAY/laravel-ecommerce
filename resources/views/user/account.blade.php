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

        .account-tab-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 22px;
        }

        .account-tab-header .content-description {
            margin-bottom: 0;
        }

        .profile-add-button {
            flex-shrink: 0;
            padding: 10px 14px;
            border: 1px solid #080808;
            border-radius: 7px;
            background: #080808;
            color: #fff;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s ease, border-color .2s ease;
        }

        .profile-add-button:hover {
            border-color: #333;
            background: #333;
        }

        .account-item-heading {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px;
        }

        .account-item-heading > div {
            min-width: 0;
            overflow-wrap: anywhere;
        }

        .account-item-heading .profile-edit-button {
            flex-shrink: 0;
        }

        .profile-form-group textarea {
            width: 100%;
            box-sizing: border-box;
            padding: 11px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            background: #fff;
            color: #1e293b;
            font-family: inherit;
            font-size: 14px;
            resize: vertical;
            outline: none;
        }

        .profile-form-group textarea:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, .12);
        }

        @media (max-width: 650px) {
            .account-tab-header {
                flex-direction: column;
                align-items: stretch;
            }

            .account-tab-header .profile-add-button {
                align-self: flex-start;
            }

            .account-item-heading {
                gap: 8px;
            }

            .profile-modal-content {
                max-height: 90vh;
                overflow-y: auto;
                padding: 20px;
            }
        }

        .profile-alert {
            margin-bottom: 20px;
            padding: 12px 15px;
            border-radius: 8px;
            font-size: 13px;
        }

        .profile-alert-success {
            border: 1px solid #bbf7d0;
            background: #f0fdf4;
            color: #166534;
        }

        .profile-alert-error {
            border: 1px solid #fecaca;
            background: #fef2f2;
            color: #991b1b;
        }

        .profile-alert ul {
            margin: 7px 0 0;
            padding-left: 20px;
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
            @if (session('success'))
                <div class="profile-alert profile-alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="profile-alert profile-alert-error">
                    <strong>Periksa kembali data yang kamu masukkan:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
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

                <div class="profile-info-header">
                    <h2>Kelola Rekening Bank</h2>
                    <p>Informasi rekening bank yang terhubung dengan akun kamu.</p>
                </div>

                <div class="profile-section">
                    <div class="profile-section-heading">
                        <h3 class="profile-section-title">Informasi Rekening Bank</h3>

                        <button
                            type="button"
                            class="profile-add-button"
                            data-modal-open="addBankModal"
                        >
                            + Tambah Rekening
                        </button>
                    </div>

                    @forelse ($bankAccounts as $bank)

                        <div class="profile-detail-card" style="margin-bottom: 14px;">
                            <div class="profile-detail-list">

                                <div class="profile-detail">
                                    <span>Nama Rekening</span>
                                    <strong>: {{ $bank->bank_name }}</strong>
                                </div>

                                <div class="profile-detail">
                                    <span>Nama Pemilik Rekening</span>
                                    <strong>: {{ $bank->account_name }}</strong>
                                </div>

                                <div class="profile-detail">
                                    <span>Nomor Rekening</span>
                                    <strong>: {{ $bank->account_number }}</strong>
                                </div>

                            </div>

                            <div style="display:flex; justify-content:flex-end; margin-top:14px;">
                                <button
                                    type="button"
                                    class="profile-edit-button"
                                    data-modal-open="editBank{{ $bank->id }}"
                                >
                                    Ubah
                                </button>
                            </div>
                        </div>

                        {{-- Pertahankan modal Edit Rekening yang sudah ada di sini --}}

                        <div class="profile-modal" id="editBank{{ $bank->id }}">
                            <div class="profile-modal-content">
                                <div class="profile-modal-header">
                                    <h3>Ubah Rekening Bank</h3>
                                    <button type="button" class="profile-modal-close" data-modal-close>&times;</button>
                                </div>

                                <form action="{{ route('profile.bank.update', $bank->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="profile-form-group">
                                        <label>Nama Rekening</label>
                                        <input type="text" name="bank_name" value="{{ $bank->bank_name }}" required>
                                    </div>

                                    <div class="profile-form-group">
                                        <label>Nama Pemilik Rekening</label>
                                        <input type="text" name="account_name" value="{{ $bank->account_name }}" required>
                                    </div>

                                    <div class="profile-form-group">
                                        <label>Nomor Rekening</label>
                                        <input type="text" name="account_number" value="{{ $bank->account_number }}" required>
                                    </div>

                                    <div class="profile-modal-actions">
                                        <button type="button" class="profile-cancel-button" data-modal-close>Batal</button>
                                        <button type="submit" class="profile-save-button">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    @empty
                        <div class="empty-state">
                            <strong>Belum ada rekening bank tersimpan</strong>
                            Tambahkan rekening bank untuk menyimpan informasi pembayaran kamu.
                        </div>
                    @endforelse
                </div>

                {{-- Modal Tambah Rekening --}}
                <div class="profile-modal" id="addBankModal">
                    <div class="profile-modal-content">
                        <div class="profile-modal-header">
                            <h3>Tambah Rekening Bank</h3>
                            <button type="button" class="profile-modal-close" data-modal-close>&times;</button>
                        </div>

                        <form action="{{ route('profile.bank.store') }}" method="POST">
                            @csrf

                            <div class="profile-form-group">
                                <label>Nama Rekening</label>
                                <input type="text" name="bank_name" placeholder="Contoh: BCA" required>
                            </div>

                            <div class="profile-form-group">
                                <label>Nama Pemilik Rekening</label>
                                <input type="text" name="account_name" placeholder="Contoh: John" required>
                            </div>

                            <div class="profile-form-group">
                                <label>Nomor Rekening</label>
                                <input type="text" name="account_number" placeholder="Masukkan nomor rekening" required>
                            </div>

                            <div class="profile-modal-actions">
                                <button type="button" class="profile-cancel-button" data-modal-close>Batal</button>
                                <button type="submit" class="profile-save-button">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>

            @elseif ($activeTab === 'address')

                <div class="profile-info-header">
                    <h2>Kelola Alamat</h2>
                    <p>Informasi alamat yang terhubung dengan akun kamu.</p>
                </div>

                <div class="profile-section">
                    <div class="profile-section-heading">
                        <h3 class="profile-section-title">Informasi Alamat</h3>

                        <button
                            type="button"
                            class="profile-add-button"
                            data-modal-open="addAddressModal"
                        >
                            + Tambah Alamat
                        </button>
                    </div>

                    @forelse ($addresses as $address)

                        <div class="profile-detail-card" style="margin-bottom: 14px;">
                            <div class="profile-detail-list">

                                <div class="profile-detail">
                                    <span>Label Alamat</span>
                                    <strong>: {{ $address->label }}</strong>
                                </div>

                                <div class="profile-detail">
                                    <span>Nama Penerima</span>
                                    <strong>: {{ $address->recipient_name }}</strong>
                                </div>

                                <div class="profile-detail">
                                    <span>Nomor HP</span>
                                    <strong>: {{ $address->phone }}</strong>
                                </div>

                                <div class="profile-detail">
                                    <span>Alamat Lengkap</span>
                                    <strong>: {{ $address->address }}</strong>
                                </div>

                                <div class="profile-detail">
                                    <span>Kota</span>
                                    <strong>: {{ $address->city }}</strong>
                                </div>

                                <div class="profile-detail">
                                    <span>Kode Pos</span>
                                    <strong>: {{ $address->postal_code }}</strong>
                                </div>

                            </div>

                            <div style="display:flex; justify-content:flex-end; margin-top:14px;">
                                <button
                                    type="button"
                                    class="profile-edit-button"
                                    data-modal-open="editAddress{{ $address->id }}"
                                >
                                    Ubah
                                </button>
                            </div>
                        </div>

                        {{-- Modal Edit Alamat --}}
                        <div class="profile-modal" id="editAddress{{ $address->id }}">
                            <div class="profile-modal-content">
                                <div class="profile-modal-header">
                                    <h3>Ubah Alamat</h3>
                                    <button type="button" class="profile-modal-close" data-modal-close>&times;</button>
                                </div>

                                <form action="{{ route('profile.address.update', $address->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="profile-form-group">
                                        <label>Label Alamat</label>
                                        <input type="text" name="label" value="{{ $address->label }}" required>
                                    </div>

                                    <div class="profile-form-group">
                                        <label>Nama Penerima</label>
                                        <input type="text" name="recipient_name" value="{{ $address->recipient_name }}" required>
                                    </div>

                                    <div class="profile-form-group">
                                        <label>Nomor HP</label>
                                        <input type="text" name="phone" value="{{ $address->phone }}" required>
                                    </div>

                                    <div class="profile-form-group">
                                        <label>Alamat Lengkap</label>
                                        <textarea name="address" rows="3" required>{{ $address->address }}</textarea>
                                    </div>

                                    <div class="profile-form-group">
                                        <label>Kota</label>
                                        <input type="text" name="city" value="{{ $address->city }}" required>
                                    </div>

                                    <div class="profile-form-group">
                                        <label>Kode Pos</label>
                                        <input type="text" name="postal_code" value="{{ $address->postal_code }}" required>
                                    </div>

                                    <div class="profile-modal-actions">
                                        <button type="button" class="profile-cancel-button" data-modal-close>Batal</button>
                                        <button type="submit" class="profile-save-button">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    @empty
                        <div class="empty-state">
                            <strong>Belum ada alamat tersimpan</strong>
                            Tambahkan alamat pengiriman untuk memudahkan proses pemesanan.
                        </div>
                    @endforelse
                </div>

                {{-- Modal Tambah Alamat --}}
                <div class="profile-modal" id="addAddressModal">
                    <div class="profile-modal-content">
                        <div class="profile-modal-header">
                            <h3>Tambah Alamat</h3>
                            <button type="button" class="profile-modal-close" data-modal-close>&times;</button>
                        </div>

                        <form action="{{ route('profile.address.store') }}" method="POST">
                            @csrf

                            <div class="profile-form-group">
                                <label>Label Alamat</label>
                                <input type="text" name="label" placeholder="Contoh: Rumah" required>
                            </div>

                            <div class="profile-form-group">
                                <label>Nama Penerima</label>
                                <input type="text" name="recipient_name" value="{{ $user->name }}" required>
                            </div>

                            <div class="profile-form-group">
                                <label>Nomor HP</label>
                                <input type="text" name="phone" value="{{ $user->phone }}" required>
                            </div>

                            <div class="profile-form-group">
                                <label>Alamat Lengkap</label>
                                <textarea name="address" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
                            </div>

                            <div class="profile-form-group">
                                <label>Kota</label>
                                <input type="text" name="city" placeholder="Masukkan kota" required>
                            </div>

                            <div class="profile-form-group">
                                <label>Kode Pos</label>
                                <input type="text" name="postal_code" placeholder="Masukkan kode pos" required>
                            </div>

                            <div class="profile-modal-actions">
                                <button type="button" class="profile-cancel-button" data-modal-close>Batal</button>
                                <button type="submit" class="profile-save-button">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>

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
