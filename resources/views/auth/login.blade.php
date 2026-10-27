<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | KOTOKO</title>

    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            --purple: #080808;
            --pink: #f5f1e9;
            --muted: #777773;

            --bg-main: #fbf9f5;
            --bg-header: #f5f1e9;
            --border: #e3e0da;
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
            padding: 35px;
            font-family: Arial, sans-serif;
            color: var(--text-main);
            background: var(--bg-main);
        }

        .login-shell {
            display: grid;
            grid-template-columns: 32% 68%;
            width: 100%;
            max-width: 1050px;
            min-height: 490px;
            overflow: hidden;
            border: 1px solid #e3e0da;
            border-radius: 22px;
            background: #fbf9f5;
            box-shadow: 0 24px 70px rgba(0, 0, 0, .10);
            animation: shellAppear .7s ease both;
        }

        /* Panel kiri */
        .login-panel {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 38px 32px;
            background: #fff;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 35px;
            color: #080808;
            text-decoration: none;
            font-size: 17px;
            font-weight: 800;
            letter-spacing: -.5px;
        }

        .brand-mark {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 27px;
            height: 27px;
            border-radius: 8px;
            background: #080808;
            color: #ffffff;
            font-size: 15px;
        }

        .login-avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 120px;
            height: 80px;
            margin: 0 auto 25px;
            background: transparent;
            border-radius: 0;
        }

        .login-avatar-logo {
            display: block;
            width: 100%;
            max-width: 120px;
            height: auto;
            object-fit: contain;
        }

        h1 {
            margin: 0 0 8px;
            text-align: center;
            font-size: 23px;
            letter-spacing: -.6px;
            color: #080808;
        }

        .subtitle {
            margin: 0 0 25px;
            color: #777773;
            text-align: center;
            font-size: 12px;
            line-height: 1.7;
        }

        .form-group {
            margin-bottom: 13px;
        }

        .form-group label {
            display: block;
            margin: 0 0 7px 3px;
            color: #6e687b;
            font-size: 11px;
            font-weight: 700;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap svg {
            position: absolute;
            top: 50%;
            left: 12px;
            width: 16px;
            height: 16px;
            color: #71677f;
            transform: translateY(-50%);
            pointer-events: none;
        }

        input {
            display: block;
            width: 100%;
            height: 42px;
            padding: 0 12px 0 37px;
            border-radius: 10px;
            outline: none;
            font-size: 12px;
            transition: border-color .2s, box-shadow .2s;
            border: 1.5px solid #d5d0c7;
            background: #ffffff;
            color: #080808;
        }

        input::placeholder {
            color: #99958d;
        }

        input:focus {
            border-color: #080808;
            box-shadow: 0 0 0 3px rgb(8 8 8 / 8%);
        }

        .login-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            min-height: 42px;
            margin-top: 18px;
            padding: 10px 15px;
            border: 0;
            border-radius: 10px;
            background: #080808;
            color: #ffffff;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: background .2s, transform .2s;
        }

        .login-button:hover {
            background: #333333;
        }

        .login-button:active {
            transform: scale(.98);
        }

        .register-text {
            margin: 17px 0 0;
            color: #777773;
            text-align: center;
            font-size: 12px;
            line-height: 1.7;
        }

        a {
            color: #333333;
            font-weight: 700;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .error {
            margin-bottom: 15px;
            padding: 10px 12px;
            border: 1px solid #f2c5d7;
            border-radius: 9px;
            border-color: #e3b8b8;
            background: #fff1f1;
            color: #a12d2d;
            font-size: 11px;
            line-height: 1.6;
        }

        .error p {
            margin: 3px 0;
        }

        .login-dots {
            display: flex;
            justify-content: center;
            gap: 5px;
            margin-top: 28px;
        }

        .login-dots span {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #080808;
        }

        /* Panel kanan */
        .welcome-panel {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-width: 0;
            overflow: hidden;
            padding: 65px;
            background: #f5f1e9;
            color: #080808;
        }

        .welcome-panel::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(
                120deg,
                transparent 15%,
                rgba(255, 255, 255, .04) 40%,
                transparent 65%
            );
            pointer-events: none;
        }

        .top-nav {
            position: absolute;
            top: 28px;
            right: 30px;
            left: 30px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 23px;
            z-index: 1;
            color: #555550;
        }

        .top-nav a {
            color: #080808;
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .top-nav .nav-login {
            padding: 8px 17px;
            border-radius: 20px;
            background: #080808;
            color: #ffffff;
            font-weight: 700;
        }

        .welcome-content {
            position: relative;
            z-index: 1;
            align-self: flex-end;
            width: 100%;
            max-width: 490px;
            margin-top: 20px;
            text-align: right;
            animation: welcomeAppear .9s .15s ease both;
        }

        .welcome-content h2 {
            margin: 0 0 17px;
            font-size: clamp(38px, 5vw, 62px);
            line-height: 1.05;
            letter-spacing: -2px;
        }

        .welcome-content p {
            max-width: 350px;
            margin: 0 0 0 auto;
            color: #777773;
            font-size: 12px;
            line-height: 1.9;
        }

        .welcome-footer {
            position: absolute;
            right: 30px;
            bottom: 25px;
            z-index: 1;
            color: #777773;
            font-size: 10px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            align-self: flex-start;
            width: fit-content;
            margin-bottom: 35px;
            text-decoration: none;
        }

        .login-logo {
            display: block;
            width: 120px;
            max-width: 100%;
            height: auto;
            object-fit: contain;
        }

        @media (max-width: 550px) {
            .login-logo {
                width: 150px;
            }
        }
        
        @keyframes shellAppear {
            from {
                opacity: 0;
                transform: translateY(16px) scale(.99);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes welcomeAppear {
            from {
                opacity: 0;
                transform: translateY(12px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (min-width: 1100px) {
            .login-shell {
                min-height: 500px;
            }
        }

        @media (max-width: 700px) {
            body {
                padding: 20px;
            }

            .login-shell {
                grid-template-columns: 1fr;
                max-width: 420px;
                min-height: auto;
                border-radius: 18px;
            }

            .welcome-panel {
                grid-row: 1;
                min-height: 220px;
                padding: 75px 28px 35px;
            }

            .top-nav {
                top: 20px;
                right: 20px;
                left: 20px;
                gap: 14px;
            }

            .top-nav a {
                font-size: 8px;
            }

            .top-nav a:nth-child(2),
            .top-nav a:nth-child(3),
            .top-nav a:nth-child(4) {
                display: none;
            }

            .welcome-content {
                margin-top: 10px;
            }

            .welcome-content h2 {
                font-size: 40px;
            }

            .welcome-content p {
                font-size: 11px;
            }

            .login-panel {
                grid-row: 2;
                padding: 30px 28px 25px;
            }

            .brand {
                margin-bottom: 25px;
            }

            .login-dots {
                margin-top: 20px;
            }

            .welcome-footer {
                right: 20px;
                bottom: 14px;
                font-size: 9px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation: none !important;
                transition: none !important;
            }
        }
    </style>
</head>

<body>
    <main class="login-shell">

        <section class="login-panel">

            <div class="login-avatar">
                <img
                    src="{{ asset('images/KOTOKO black text1.png') }}"
                    alt="Logo KOTOKO"
                    class="login-avatar-logo"
                >
            </div>

            <h1>Selamat Datang</h1>
            <p class="subtitle">Masuk ke akun KOTOKO kamu.</p>

            @if ($errors->any())
                <div class="error" role="alert">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ url('/login') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">Alamat email</label>
                    <div class="input-wrap">
                        <svg viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round"
                             aria-hidden="true">
                            <circle cx="12" cy="8" r="4"/>
                            <path d="M5 21a7 7 0 0 1 14 0"/>
                        </svg>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Masukkan alamat email"
                            autocomplete="username"
                            required
                            autofocus
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <svg viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round"
                             aria-hidden="true">
                            <rect x="4" y="10" width="16" height="11" rx="2"/>
                            <path d="M8 10V7a4 4 0 0 1 8 0v3"/>
                        </svg>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                            required
                        >
                    </div>
                </div>

                <button type="submit" class="login-button">
                    Login
                </button>
            </form>

            <p class="register-text">
                Belum punya akun?
                <a href="{{ route('register') }}">Daftar sekarang</a>
            </p>

            <div class="login-dots" aria-hidden="true">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </section>

        <section class="welcome-panel">
            <nav class="top-nav" aria-label="Navigasi">
                <a href="{{ url('/produk') }}">Produk</a>
                <a href="{{ url('/produk') }}">Tentang</a>
                <a href="{{ url('/produk') }}">Kontak</a>
                <a href="{{ route('register') }}" class="nav-login">Daftar</a>
            </nav>

            <div class="welcome-content">
                <h2>Welcome.</h2>
                <p>
                    Temukan produk favoritmu dan nikmati pengalaman
                    belanja online yang nyaman bersama KOTOKO.
                </p>
            </div>

            <div class="welcome-footer">
                &copy; {{ date('Y') }} KOTOKO · Online Store
            </div>
        </section>

    </main>
</body>
</html>
