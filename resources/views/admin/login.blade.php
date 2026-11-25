
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#fff8f4">
    <title>Masuk · Chōgō Coffee</title>

    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            --ink: #30251e;
            --muted: #81746a;
            --coffee: #60402c;
            --coffee-light: #80563d;
            --cream: #fff0e5;
            --paper: #fffaf7;
            --line: #eee3da;
            --serif: Georgia, 'Times New Roman', serif;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            color: var(--ink);
            background: #fff9f5;
            font: 14px/1.5 system-ui, sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button, input {
            font: inherit;
        }

        :focus-visible {
            outline: 3px solid #b58b69;
            outline-offset: 3px;
        }

        /* HEADER */

        .site-header {
            min-height: 80px;
            display: flex;
            align-items: center;
            padding: 0 48px;
            background: #fffaf7;
            border-bottom: 1px solid #f0e6df;
        }

        .header-inner {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font: 700 21px var(--serif);
            white-space: nowrap;
        }

        .brand-mark {
            width: 40px;
            height: 40px;
            display: grid;
            place-items: center;
            color: var(--coffee);
            background: #faeade;
            border-radius: 50%;
            font-size: 19px;
        }

        .header-nav {
            display: flex;
            align-items: center;
            gap: 27px;
            color: #5e4a3e;
            font-size: 13px;
            font-weight: 600;
        }

        .header-nav a:hover {
            color: #a16b48;
        }

        .language {
            display: flex;
            align-items: center;
            gap: 3px;
            padding: 5px;
            background: var(--cream);
            border-radius: 30px;
            font-size: 10px;
        }

        .language span {
            padding: 4px 9px;
            border-radius: 20px;
        }

        .language .active {
            color: var(--coffee);
            background: white;
        }

        .profile-icon {
            width: 34px;
            height: 34px;
            display: grid;
            place-items: center;
            color: white;
            background: var(--coffee);
            border-radius: 50%;
            font-size: 15px;
        }

        /* MAIN */

        .login-main {
            flex: 1;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 45px 5%;
        }

        .login-layout {
            width: min(100%, 1152px);
            min-height: 770px;
            display: grid;
            grid-template-columns: .82fr 1.18fr;
            gap: 24px;
        }

        /* LEFT PANEL */

        .auth-story {
            position: relative;
            min-height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 40px;
            overflow: hidden;
            color: #fff8f0;
            background:
                linear-gradient(
                    180deg,
                    rgba(67, 39, 24, .79),
                    rgba(58, 39, 28, .95)
                ),
                url('https://images.unsplash.com/photo-1442512595331-e89e73853f31?auto=format&fit=crop&w=1200&q=85')
                center/cover;
            border-radius: 13px;
            box-shadow: 0 12px 25px #3b29191c;
        }

        .story-top {
            position: relative;
            z-index: 1;
        }

        .status-pill {
            width: fit-content;
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 7px 15px;
            color: #fff9f1;
            background: #ffffff32;
            border: 1px solid #ffffff20;
            border-radius: 30px;
            font-size: 10px;
            font-weight: 650;
            letter-spacing: .04em;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background: #c9dfb7;
            border-radius: 50%;
        }

        .story-copy {
            position: relative;
            z-index: 1;
            margin: auto 0;
            padding: 40px 0;
        }

        .story-line {
            width: 48px;
            height: 4px;
            margin-bottom: 22px;
            background: #e9a47e;
            border-radius: 10px;
        }

        .story-copy blockquote {
            max-width: 430px;
            margin: 0;
            font: italic 30px/1.5 var(--serif);
            letter-spacing: -.02em;
        }

        .story-copy p {
            margin: 12px 0 0;
            color: #e2c9b6;
            font-size: 11px;
            letter-spacing: .12em;
        }

        .story-bottom {
            position: relative;
            z-index: 1;
        }

        .story-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            padding: 19px 17px;
            background: #ffffff25;
            border: 1px solid #ffffff13;
            border-radius: 9px;
        }

        .stat-label {
            display: block;
            color: #e6d1c1;
            font-size: 9px;
            letter-spacing: .07em;
            text-transform: uppercase;
        }

        .stat-value {
            display: block;
            margin-top: 5px;
            color: white;
            font: 24px var(--serif);
        }

        .stat-description {
            display: block;
            color: #d5bba7;
            font-size: 11px;
        }

        .story-footer {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 13px;
            color: #d9c2ae;
            font-size: 10px;
        }

        /* RIGHT PANEL */

        .auth-main {
            min-width: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px;
            background: #fff;
            border: 1px solid #f0e9e3;
            border-radius: 13px;
            box-shadow: 0 12px 25px #3b291911;
        }

        .auth-content {
            width: 100%;
            max-width: 570px;
            margin: 0 auto;
        }

        .auth-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
            font: 700 21px var(--serif);
        }

        .auth-brand .brand-mark {
            width: 40px;
            height: 40px;
        }

        .auth-heading {
            margin-bottom: 24px;
        }

        .auth-heading h1 {
            margin: 0;
            font: 700 clamp(27px, 3vw, 34px)/1.2 var(--serif);
            letter-spacing: -.035em;
        }

        .auth-heading p {
            margin: 7px 0 0;
            color: var(--muted);
            font-size: 13px;
        }

        /* ACCOUNT TABS */

        .account-tabs {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 4px;
            margin-bottom: 26px;
            padding: 4px;
            background: var(--cream);
            border-radius: 30px;
        }

        .account-tab {
            min-height: 38px;
            padding: 7px 5px;
            color: #675449;
            background: transparent;
            border: 0;
            border-radius: 25px;
            font-size: 11px;
            font-weight: 650;
            cursor: pointer;
            transition: .2s ease;
        }

        .account-tab.active {
            color: white;
            background: var(--coffee);
            box-shadow: 0 2px 5px #39251b20;
        }

        .account-tab:hover:not(.active) {
            background: #f9e4d6;
        }

        /* FORM */

        .auth-form {
            display: grid;
            gap: 17px;
        }

        .auth-field {
            display: grid;
            gap: 7px;
        }

        .field-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .auth-field label {
            font-size: 12px;
            font-weight: 700;
        }

        .field-hint {
            color: #938278;
            font-size: 9px;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            left: 16px;
            color: #937b6b;
            font-size: 17px;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .auth-field input {
            width: 100%;
            height: 47px;
            padding: 0 43px;
            color: var(--ink);
            background: #fff1e7;
            border: 1px solid transparent;
            border-radius: 9px;
            font-size: 12px;
            transition: .2s ease;
        }

        .auth-field input::placeholder {
            color: #9a897d;
        }

        .auth-field input:focus {
            background: white;
            border-color: #9b7357;
            outline: 3px solid #98663e1c;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 14px;
            padding: 3px;
            color: #89776a;
            background: transparent;
            border: 0;
            font-size: 16px;
            cursor: pointer;
            transform: translateY(-50%);
        }

        .auth-inline {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-top: 1px;
        }

        .auth-remember {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #75675e;
            font-size: 11px;
        }

        .auth-remember input {
            width: 16px;
            height: 16px;
            accent-color: var(--coffee);
        }

        .auth-link {
            color: var(--coffee);
            font-size: 11px;
            font-weight: 700;
        }

        .auth-link:hover {
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        .shift-status {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 5px 11px;
            color: #607052;
            background: #edf3e7;
            border-radius: 20px;
            font-size: 9px;
            font-weight: 650;
        }

        .shift-status span {
            width: 6px;
            height: 6px;
            background: #71885b;
            border-radius: 50%;
        }

        .auth-submit {
            min-height: 49px;
            margin-top: 3px;
            color: white;
            background: var(--coffee-light);
            border: 0;
            border-radius: 30px;
            box-shadow: 0 4px 8px #50352230;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s ease;
        }

        .auth-submit:hover {
            background: var(--coffee);
            transform: translateY(-2px);
        }

        .auth-submit:active {
            transform: translateY(0);
        }

        .auth-submit span {
            margin-left: 5px;
            font-size: 17px;
            vertical-align: -1px;
        }

        .auth-error {
            margin-bottom: 15px;
            padding: 12px 14px;
            color: #8c3028;
            background: #fff0ed;
            border: 1px solid #f0d0cb;
            border-radius: 8px;
            font-size: 11px;
        }

        .auth-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 21px 0;
            color: #9b8d82;
            font-size: 9px;
            font-weight: 600;
            text-align: center;
        }

        .auth-divider::before,
        .auth-divider::after {
            flex: 1;
            height: 1px;
            background: var(--line);
            content: "";
        }

        .auth-bottom {
            margin-top: 100px;
            text-align: center;
        }

        .auth-register {
            margin: 0;
            color: #71665e;
            font-size: 12px;
        }

        .auth-register a {
            color: var(--coffee);
            font-weight: 750;
        }

        .auth-footnote {
            margin: 10px 0 0;
            color: #998b80;
            font-size: 10px;
        }

        /* FOOTER */

        .site-footer {
            min-height: 82px;
            display: flex;
            align-items: center;
            padding: 16px 48px;
            background: #fff0e7;
        }

        .footer-inner {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .footer-copy {
            color: #71635a;
            font-size: 11px;
        }

        .footer-copy p {
            margin: 0;
        }

        .footer-copy small {
            color: #8f8075;
            font-size: 10px;
        }

        .footer-links {
            display: flex;
            align-items: center;
            gap: 25px;
            color: #55463d;
            font-size: 11px;
            font-weight: 600;
        }

        .footer-status {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .footer-status span {
            width: 8px;
            height: 8px;
            background: #71885b;
            border-radius: 50%;
        }

        /* RESPONSIVE */

        @media(max-width:1050px) {
            .site-header {
                padding: 0 25px;
            }

            .login-main {
                padding: 35px 25px;
            }

            .login-layout {
                grid-template-columns: .85fr 1.15fr;
                min-height: 700px;
            }

            .auth-main {
                padding: 35px;
            }

            .auth-story {
                padding: 30px;
            }

            .story-copy blockquote {
                font-size: 25px;
            }

            .header-nav {
                gap: 15px;
            }

            .site-footer {
                padding-inline: 25px;
            }
        }

        @media(max-width:760px) {
            .site-header {
                min-height: 70px;
                padding: 0 18px;
            }

            .header-nav {
                gap: 13px;
                font-size: 11px;
            }

            .header-nav > a:nth-child(3),
            .language {
                display: none;
            }

            .login-main {
                padding: 25px 18px;
            }

            .login-layout {
                max-width: 520px;
                min-height: auto;
                grid-template-columns: 1fr;
            }

            .auth-story {
                min-height: 330px;
                padding: 25px;
            }

            .story-copy {
                padding: 25px 0;
            }

            .story-copy blockquote {
                font-size: 23px;
            }

            .story-stats {
                padding: 13px;
            }

            .stat-value {
                font-size: 20px;
            }

            .auth-main {
                min-height: 650px;
                padding: 30px 25px;
            }

            .auth-bottom {
                margin-top: 55px;
            }

            .site-footer {
                padding: 20px 18px;
            }

            .footer-inner {
                align-items: flex-start;
                flex-direction: column;
                gap: 14px;
            }

            .footer-links {
                flex-wrap: wrap;
                gap: 14px;
            }
        }

        @media(max-width:430px) {
            .brand {
                font-size: 18px;
            }

            .header-nav {
                gap: 9px;
            }

            .header-nav > a:nth-child(2) {
                display: none;
            }

            .auth-main {
                padding: 26px 19px;
            }

            .auth-heading h1 {
                font-size: 27px;
            }

            .account-tab {
                font-size: 10px;
            }

            .field-hint {
                font-size: 8px;
            }

            .auth-bottom {
                margin-top: 45px;
            }
        }

        @media(prefers-reduced-motion:reduce) {
            *,
            *::before,
            *::after {
                animation-duration: .01ms !important;
                transition-duration: .01ms !important;
                scroll-behavior: auto !important;
            }
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <header class="site-header">
        <div class="header-inner">

            <a class="brand" href="{{ route('admin.login') }}">
                <span class="brand-mark" aria-hidden="true">♧</span>
                <span>Chōgō Coffee</span>
            </a>

            <nav class="header-nav" aria-label="Navigasi utama">
                <a href="{{ route('admin.login') }}">Masuk</a>

                <a href="{{ route('customer.register') }}">
                    Daftar Akun
                </a>

                <a href="#account-help">Bantuan</a>

                <div class="language" aria-label="Pilihan bahasa">
                    <span class="active">ID</span>
                    <span>EN</span>
                </div>

                <a href="{{ route('admin.login') }}"
                   class="profile-icon"
                   aria-label="Halaman login">
                    ♙
                </a>
            </nav>

        </div>
    </header>


    <!-- MAIN LOGIN -->
    <main class="login-main">

        <div class="login-layout">

            <!-- LEFT STORY PANEL -->
            <section class="auth-story" aria-label="Filosofi Chōgō Coffee">

                <div class="story-top">
                    <div class="status-pill">
                        <span class="status-dot"></span>
                        REGOL WETAN • BUKA 08:00 – 23:00
                    </div>
                </div>

                <div class="story-copy">

                    <div class="story-line"></div>

                    <blockquote>
                        “Setiap cangkir diseduh dengan presisi,
                        dikelola dengan dedikasi.”
                    </blockquote>

                    <p>— FILOSOFI KŌHĪ CHŌGŌ</p>

                </div>

                <div class="story-bottom">

                    <div class="story-stats">

                        <div>
                            <span class="stat-label">
                                Lantai Operasional
                            </span>

                            <strong class="stat-value">24 Meja</strong>

                            <span class="stat-description">
                                Terkelola Real-time
                            </span>
                        </div>

                        <div>
                            <span class="stat-label">
                                Katalog Bar
                            </span>

                            <strong class="stat-value">7 Kategori</strong>

                            <span class="stat-description">
                                Racikan Spesial
                            </span>
                        </div>

                    </div>

                    <div class="story-footer">
                        <span>◉ Latency 14ms</span>
                        <span>Shift Siang • Tim Alpha</span>
                    </div>

                </div>

            </section>


            <!-- RIGHT LOGIN PANEL -->
            <section class="auth-main" aria-labelledby="login-title">

                <div class="auth-content">

                    <a class="auth-brand" href="{{ route('admin.login') }}">
                        <span class="brand-mark" aria-hidden="true">♧</span>
                        <span>Chōgō Coffee</span>
                    </a>

                    <header class="auth-heading">
                        <h1 id="login-title">
                            Selamat Datang Kembali
                        </h1>

                        <p>
                            Masuk ke portal operasional, kasir kas,
                            dan manajemen inventori Chōgō Coffee.
                        </p>
                    </header>


                    @if ($errors->any())
                        <div class="auth-error"
                             role="alert"
                             aria-live="assertive">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    @if (session('account_notice'))
                        <div class="auth-error" role="status">
                            {{ session('account_notice') }}
                        </div>
                    @endif


                    <!-- ACCOUNT TYPE TABS -->
                    <div class="account-tabs"
                         role="group"
                         aria-label="Pilih jenis akun">

                        <button type="button"
                                class="account-tab"
                                data-account="employee"
                                aria-pressed="false">
                            ♙ Staff
                        </button>

                        <button type="button"
                                class="account-tab"
                                data-account="admin"
                                aria-pressed="true">
                            ♧ Admin
                        </button>

                        <button type="button"
                                class="account-tab"
                                data-account="customer"
                                aria-pressed="false">
                            ♡ Pelanggan
                        </button>

                    </div>


                    <!-- FORM LOGIN -->
                    <form class="auth-form"
                          method="POST"
                          action="{{ route('admin.login.submit') }}">

                        @csrf

                        <!-- Tetap menggunakan account_type -->
                        <input type="hidden"
                               id="account_type"
                               name="account_type"
                               value="{{ old('account_type', 'admin') }}"
                               required>


                        <!-- USERNAME / EMAIL -->
                        <div class="auth-field">

                            <div class="field-heading">

                                <label for="username"
                                       id="identity-label">
                                    Username
                                </label>

                                <span class="field-hint"
                                      id="identity-hint">
                                    ID Admin / POS ID
                                </span>

                            </div>

                            <div class="input-wrap">

                                <span class="input-icon"
                                      aria-hidden="true">
                                    @
                                </span>

                                <input
                                    id="username"
                                    name="username"
                                    type="text"
                                    value="{{ old('username') }}"
                                    autocomplete="username"
                                    placeholder="Masukkan username"
                                    required
                                >

                            </div>

                        </div>


                        <!-- PASSWORD -->
                        <div class="auth-field">

                            <div class="field-heading">

                                <label for="password">
                                    Kata Sandi
                                </label>

                                <a class="auth-link"
                                   href="#account-help">
                                    Lupa Kata Sandi?
                                </a>

                            </div>

                            <div class="input-wrap">

                                <span class="input-icon"
                                      aria-hidden="true">
                                    ♙
                                </span>

                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    autocomplete="current-password"
                                    placeholder="Masukkan kata sandi akun Anda"
                                    required
                                >

                                <button class="password-toggle"
                                        type="button"
                                        id="toggle-password"
                                        aria-label="Tampilkan kata sandi">
                                    ◉
                                </button>

                            </div>

                        </div>


                        <!-- REMEMBER -->
                        <div class="auth-inline">

                            <label class="auth-remember">
                                <input
                                    type="checkbox"
                                    name="remember"
                                    value="1"
                                    @checked(old('remember'))
                                >

                                Ingat sesi saya di terminal ini
                            </label>

                            <span class="shift-status">
                                <span></span>
                                Shift Aktif
                            </span>

                        </div>


                        <!-- SUBMIT -->
                        <button class="auth-submit" type="submit">
                            Masuk ke Portal Operasional
                            <span>→</span>
                        </button>

                    </form>


                    <div class="auth-divider">
                        ATAU AKSES CEPAT KASIR
                    </div>

                </div>


                <!-- REGISTER AND HELP -->
                <div class="auth-bottom">

                    <p class="auth-register">
                        Belum memiliki akun terdaftar?

                        <a href="{{ route('customer.register') }}">
                            Daftar Akun Baru
                        </a>

                        &nbsp;•&nbsp;

                        <a href="#account-help">
                            Hubungi Superadmin
                        </a>
                    </p>

                    <p class="auth-footnote" id="account-help">
                        ♙ Enkripsi data operasional standar POS &
                        Cloud SSL terenkripsi.
                    </p>

                    <p class="auth-footnote">
                        Akun admin dan karyawan dibuat melalui
                        undangan yang sah.
                    </p>

                </div>

            </section>

        </div>

    </main>


    <!-- FOOTER -->
    <footer class="site-footer">

        <div class="footer-inner">

            <div class="footer-copy">

                <p>
                    © 2024 PT Chōgō Kopi Nusantara.
                    Hak Cipta Dilindungi.
                </p>

                <small>
                    Kurasi biji kopi pilihan dari perkebunan
                    Nusantara dengan metode roasting presisi.
                </small>

            </div>

            <nav class="footer-links" aria-label="Informasi layanan">

                <a href="#account-help">Pusat Layanan</a>

                <a href="#account-help">Privasi & Ketentuan</a>

                <span class="footer-status">
                    <span></span>
                    Status Roastery
                </span>

            </nav>

        </div>

    </footer>


    <!-- JAVASCRIPT -->
    <script>

        // ACCOUNT TYPE
        const accountType = document.querySelector('#account_type');

        const identityLabel =
            document.querySelector('#identity-label');

        const identityInput =
            document.querySelector('#username');

        const identityHint =
            document.querySelector('#identity-hint');

        const accountTabs =
            document.querySelectorAll('.account-tab');


        // Mempertahankan logika perubahan identitas
        const updateIdentity = () => {

            const isCustomer = accountType.value === 'customer';

            identityLabel.textContent =
                isCustomer ? 'Email' : 'Username';

            identityInput.type =
                isCustomer ? 'email' : 'text';

            identityInput.autocomplete =
                isCustomer ? 'email' : 'username';

            identityInput.placeholder =
                isCustomer
                    ? 'Masukkan email'
                    : 'Masukkan username';

            identityHint.textContent =
                isCustomer
                    ? 'Email pelanggan'
                    : accountType.value === 'employee'
                        ? 'ID Barista / POS ID'
                        : 'ID Admin / POS ID';


            // Update tampilan tab
            accountTabs.forEach((tab) => {

                const isActive =
                    tab.dataset.account === accountType.value;

                tab.classList.toggle('active', isActive);

                tab.setAttribute(
                    'aria-pressed',
                    String(isActive)
                );

            });

        };


        // Pilihan jenis akun
        accountTabs.forEach((tab) => {

            tab.addEventListener('click', () => {

                accountType.value = tab.dataset.account;

                updateIdentity();

            });

        });


        // Sinkronisasi ketika halaman pertama kali dibuka
        accountType.addEventListener('change', updateIdentity);

        updateIdentity();


        // SHOW / HIDE PASSWORD
        const passwordInput =
            document.querySelector('#password');

        const togglePassword =
            document.querySelector('#toggle-password');

        togglePassword.addEventListener('click', () => {

            const isPassword =
                passwordInput.type === 'password';

            passwordInput.type =
                isPassword ? 'text' : 'password';

            togglePassword.setAttribute(
                'aria-label',
                isPassword
                    ? 'Sembunyikan kata sandi'
                    : 'Tampilkan kata sandi'
            );

        });

    </script>

</body>
</html>
