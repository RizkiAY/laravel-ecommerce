<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Kotoko</title>

    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            --bg-main: #fbf9f5;
            --bg-card: #fbf9f5;
            --bg-secondary: #f5f1e9;
            --border: #e3e0da;
            --border-input: #d5d0c7;
            --text-main: #080808;
            --text-muted: #777773;
            --accent: #080808;
            --accent-hover: #333333;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: var(--bg-main);
            font-family: Arial, sans-serif;
            color: var(--text-main);
        }

        .register-card {
            width: 100%;
            max-width: 440px;
            padding: 32px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .07);
        }

        h1 {
            margin: 0 0 8px;
            color: var(--text-main);
            font-size: 27px;
        }

        .subtitle {
            margin: 0 0 25px;
            color: var(--text-muted);
            font-size: 14px;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 17px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            color: #555550;
            font-size: 14px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid var(--border-input);
            border-radius: 8px;
            background: #ffffff;
            color: var(--text-main);
            font-family: inherit;
            font-size: 14px;
            transition: border-color .2s, box-shadow .2s;
        }

        input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgb(8 8 8 / 8%);
        }

        input::placeholder {
            color: #99958d;
        }

        .hint {
            margin-top: 6px;
            color: var(--text-muted);
            font-size: 12px;
            line-height: 1.5;
        }

        .error {
            margin-top: 6px;
            color: #a12d2d;
            font-size: 13px;
        }

        .alert {
            margin-bottom: 18px;
            padding: 12px;
            border: 1px solid #e3b8b8;
            border-radius: 8px;
            background: #fff1f1;
            color: #a12d2d;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 13px;
            border: 1px solid var(--accent);
            border-radius: 8px;
            background: var(--accent);
            color: #ffffff;
            font-family: inherit;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: background .2s, transform .2s;
        }

        button:hover {
            background: var(--accent-hover);
        }

        button:active {
            transform: scale(.98);
        }

        .login-link {
            margin: 20px 0 0;
            text-align: center;
            color: var(--text-muted);
            font-size: 14px;
        }

        a {
            color: #080808;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .admin-code-group {
            display: grid;
            grid-template-rows: 0fr;
            opacity: 0;
            transform: translateY(-12px);
            margin-bottom: 0;
            visibility: hidden;
            pointer-events: none;

            transition:
                grid-template-rows 350ms ease,
                opacity 250ms ease,
                transform 350ms ease,
                margin-bottom 350ms ease,
                visibility 350ms;
        }

        .admin-code-inner {
            min-height: 0;
            overflow: hidden;
        }

        .admin-code-group.show {
            grid-template-rows: 1fr;
            opacity: 1;
            transform: translateY(0);
            margin-bottom: 17px;
            visibility: visible;
            pointer-events: auto;
        }

        @media (max-width: 480px) {
            .register-card {
                padding: 26px 22px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .admin-code-group {
                transition: none;
            }

            button {
                transition: none;
            }
        }
    </style>
</head>
<body>
    <main class="register-card">
        <h1>Buat Akun</h1>
        <p class="subtitle">
            Daftar untuk mulai menggunakan toko online Kotoko.
        </p>

        @if ($errors->any())
            <div class="alert">
                Ada data yang perlu diperiksa. Silakan lihat pesan di bawah setiap kolom.
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    maxlength="255"
                    autocomplete="name"
                >
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    maxlength="255"
                    autocomplete="email"
                >
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group admin-code-group" id="adminCodeGroup">
                <div class="admin-code-inner">
                    <label for="admin_code">Kode Rahasia Admin</label>
                    <input
                        id="admin_code"
                        type="password"
                        name="admin_code"
                        autocomplete="off"
                        tabindex="-1"
                    >

                    <div class="hint">
                        Hanya diperlukan untuk mendaftar sebagai admin.
                    </div>

                    @error('admin_code')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    minlength="8"
                    autocomplete="new-password"
                >
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    minlength="8"
                    autocomplete="new-password"
                >
            </div>

            <button type="submit">Daftar Sekarang</button>
        </form>

        <p class="login-link">
            Sudah punya akun?
            <a href="{{ route('login') }}">Masuk di sini</a>
        </p>
    </main>

    <script>
        const emailInput = document.getElementById('email');
        const adminCodeGroup = document.getElementById('adminCodeGroup');
        const adminCodeInput = document.getElementById('admin_code');

        function toggleAdminCode() {
            const email = emailInput.value.trim().toLowerCase();
            const isAdminEmail = email.endsWith('@kotoko.id');

            adminCodeGroup.classList.toggle('show', isAdminEmail);

            adminCodeInput.tabIndex = isAdminEmail ? 0 : -1;

            if (!isAdminEmail) {
                adminCodeInput.value = '';
            }
        }

        emailInput.addEventListener('input', toggleAdminCode);

        toggleAdminCode();
    </script>

</body>
</html>
