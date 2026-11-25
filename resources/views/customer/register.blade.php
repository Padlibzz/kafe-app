
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#fff8f4">
    <title>Buat Akun Pelanggan · Chōgō Coffee</title>

    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            --ink: #30241d;
            --muted: #827267;
            --coffee: #68442e;
            --coffee-light: #80583e;
            --paper: #fffaf7;
            --peach: #fff0e5;
            --line: #f0e5dc;
            --serif: Georgia, 'Times New Roman', serif;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            min-height: 100vh;
            margin: 0;
            color: var(--ink);
            background: #fff8f4;
            font: 14px/1.5 system-ui, -apple-system, sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input {
            font: inherit;
        }

        :focus-visible {
            outline: 3px solid #b18a69;
            outline-offset: 3px;
        }

        /* HEADER */

        .topbar {
            min-height: 82px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 48px;
            background: #fffaf7;
            border-bottom: 1px solid #f4ece6;
        }

        .top-brand {
            display: flex;
            align-items: center;
            gap: 11px;
            font: 700 20px var(--serif);
            color: var(--coffee);
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            display: grid;
            place-items: center;
            color: var(--coffee);
            background: #f9eade;
            border-radius: 50%;
            font-size: 19px;
        }

        .top-navigation {
            display: flex;
            align-items: center;
            gap: 27px;
            color: #584a40;
            font-size: 12px;
            font-weight: 600;
        }

        .top-navigation a {
            transition: color .2s;
        }

        .top-navigation a:hover {
            color: #a06b45;
        }

        .language {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 5px 10px;
            background: #fff0e5;
            border-radius: 30px;
            font-size: 10px;
        }

        .language span:first-child {
            padding: 3px 7px;
            background: white;
            border-radius: 20px;
        }

        .user-icon {
            width: 34px;
            height: 34px;
            display: grid;
            place-items: center;
            color: white;
            background: var(--coffee);
            border-radius: 50%;
        }

        /* MAIN LAYOUT */

        .register-container {
            width: min(1200px, calc(100% - 80px));
            margin: 38px auto 42px;
            display: grid;
            grid-template-columns: .88fr 1.22fr;
            align-items: stretch;
            gap: 22px;
        }

        /* LEFT PANEL */

        .register-story {
            display: flex;
            flex-direction: column;
            padding: 38px;
            background: linear-gradient(
                145deg,
                #f7ddcc 0%,
                #f9e8dc 60%,
                #e9ead9 100%
            );
            border-radius: 14px;
        }

        .story-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .story-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 6px 12px;
            color: #72533d;
            background: #fffaf4;
            border-radius: 30px;
            font-size: 9px;
            font-weight: 750;
            letter-spacing: .06em;
        }

        .story-badge::before {
            width: 7px;
            height: 7px;
            content: "";
            background: #78906d;
            border-radius: 50%;
        }

        .story-edition {
            color: #927a68;
            font-size: 9px;
        }

        .story-heading {
            margin-top: 25px;
        }

        .story-kicker {
            margin: 0 0 9px;
            color: #89644c;
            font-size: 10px;
            font-weight: 750;
            letter-spacing: .12em;
        }

        .story-heading h1 {
            max-width: 430px;
            margin: 0;
            font: 700 clamp(31px, 3vw, 43px)/1.1 var(--serif);
            letter-spacing: -.035em;
        }

        .story-heading h1 em {
            font-weight: 400;
        }

        .story-description {
            max-width: 410px;
            margin: 12px 0 0;
            color: #69594d;
            font-size: 13px;
            line-height: 1.7;
        }

        /* STORY IMAGE */

        .story-image {
            position: relative;
            height: 170px;
            margin-top: 23px;
            overflow: hidden;
            background: #b59b83;
            border-radius: 10px;
            box-shadow: 0 5px 12px #5b39231c;
        }

        .story-image img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
            object-position: center;
        }

        .story-image::after {
            position: absolute;
            inset: 35% 0 0;
            content: "";
            background: linear-gradient(transparent, #30201699);
        }

        .image-caption {
            position: absolute;
            z-index: 1;
            right: 12px;
            bottom: 12px;
            left: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            font-size: 9px;
            font-weight: 700;
        }

        .image-version {
            padding: 4px 8px;
            background: #ffffff42;
            border-radius: 20px;
        }

        /* FEATURE CARDS */

        .story-features {
            display: grid;
            gap: 9px;
            margin-top: 24px;
        }

        .feature-card {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            padding: 15px;
            background: #fffaf7;
            border: 1px solid #ffffffb0;
            border-radius: 10px;
        }

        .feature-icon {
            width: 39px;
            height: 39px;
            flex: 0 0 39px;
            display: grid;
            place-items: center;
            background: #f7e6d8;
            border-radius: 50%;
            font-size: 17px;
        }

        .feature-card:nth-child(2) .feature-icon {
            background: #dce8d0;
        }

        .feature-card:nth-child(3) .feature-icon {
            background: #ffdfca;
        }

        .feature-content h3 {
            margin: 1px 0 4px;
            font-size: 13px;
            font-weight: 700;
        }

        .feature-content p {
            margin: 0;
            color: #78685d;
            font-size: 11px;
            line-height: 1.55;
        }

        /* TESTIMONIAL */

        .story-testimonial {
            margin-top: 20px;
            padding: 17px;
            background: #ffffff40;
            border-radius: 10px;
        }

        .testimonial-stars {
            color: #79502f;
            font-size: 16px;
            letter-spacing: 2px;
        }

        .story-testimonial blockquote {
            margin: 5px 0 10px;
            color: #514136;
            font-size: 12px;
            font-style: italic;
            line-height: 1.6;
        }

        .testimonial-author {
            font-weight: 750;
            font-size: 12px;
        }

        .testimonial-position {
            color: #8d7a6d;
            font-size: 10px;
        }

        /* RIGHT FORM PANEL */

        .register-main {
            display:flex;
            flex-direction:column;
            justify-content:flex-start;
            align-self:stretch;
            padding:38px clamp(27px,5vw,58px);
            min-width:0;
        }

        .register-mobile-brand {
            display: none;
        }

        .form-heading {
            margin-bottom: 22px;
        }

        .form-kicker {
            display: flex;
            align-items: center;
            gap: 9px;
            margin: 0 0 9px;
            color: #756357;
            font-size: 11px;
            font-weight: 750;
            letter-spacing: .04em;
        }

        .form-heading h2 {
            font-size: clamp(27px, 2.5vw, 34px);
            line-height: 1.2;
        }

        .form-heading > p:last-child {
            margin: 8px 0 0;
            color: var(--muted);
            font-size: 12px;
        }

        /* FORM */

        .register-form {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));

            gap: 16px 14px;
            width: 100%;
        }

        .register-field {
            min-width: 0;
            gap: 7px;
        }

        .register-field label {
            font-size: 12px;
            font-weight: 650;
        }

        .field-input {
            width: 100%;
        }

        .field-input input {
            width: 100%;
            min-height: 45px;
            padding: 0 13px;

            background: #fff0e6;
            border: 1px solid transparent;
            border-radius: 8px;

            font-size: 12px;
        }

        .field-input input::placeholder {
            color: #a28f82;
        }

        .field-input input:focus {
            background: #fffaf7;
            border-color: #b58b69;
            outline: 3px solid #98663e18;
        }

        .field-input input[aria-invalid="true"] {
            border-color: #b64b40;
        }

        .register-error {
            color: #9b3329;
            font-size: 10px;
        }

        /* GLOBAL MESSAGES */

        .register-global-error {
            margin-bottom: 15px;
            padding: 11px 13px;
            color: #8c3028;
            background: #fff0ed;
            border: 1px solid #f0d0cb;
            border-radius: 8px;
            font-size: 11px;
        }

        .register-success {
            color: #526b48;
            background: #edf3e9;
            border-color: #d9e5d1;
        }

        /* PASSWORD AREA */

        .password-strength {
            grid-column: 1 / -1;
            width: 100%;
            padding: 11px 12px;
            margin-top: 0;
        }

        .strength-heading {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            color: #806d60;
            font-size: 9px;
        }

        .strength-bars {
            display: flex;
            gap: 4px;
            margin: 8px 0;
        }

        .strength-bars span {
            height: 5px;
            flex: 1;
            background: #e9d8ca;
            border-radius: 10px;
        }

        .strength-hints {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            color: #8c796c;
            font-size: 9px;
        }

        /* CONSENT */

        .register-consent {
            grid-column: 1 / -1;

            display: flex;
            align-items: flex-start;

            gap: 10px;
            margin-top: 3px;

            font-size: 11px;
            line-height: 1.6;
        }

        .register-consent input {
            flex-shrink: 0;
            margin-top: 2px;
        }

        .register-consent a {
            color: var(--coffee);
            font-weight: 700;
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        /* SUBMIT BUTTON */

        .register-button {
            grid-column: 1 / -1;

            width: 100%;
            min-height: 50px;

            margin-top: 3px;

            border-radius: 30px;
            font-size: 13px;
        }

        .register-button:hover {
            background: #563723;
            transform: translateY(-2px);
        }

        .register-button:active {
            transform: translateY(0);
        }

        /* BOTTOM LOGIN */

        .form-bottom {
            width: 100%;

            display: flex;
            justify-content: space-between;
            align-items: center;

            gap: 12px;

            margin-top: 28px;

            padding: 18px 15px;

            background: #fff8f3;
            border-radius: 9px;
        }

        .security-note {
            font-size: 10px;
            line-height: 1.5;
        }

        .login-link {
            font-size: 11px;
            text-align: right;
        }

        .login-link a {
            font-weight: 750;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* FOOTER */

        .site-footer {
            min-height: 78px;
            padding: 17px 48px;
        }

        .footer-description p {
            margin: 3px 0 0;
            color: #927f71;
            font-size: 9px;
        }

        .footer-links {
            display: flex;
            gap: 24px;
            font-weight: 600;
        }

        .footer-links a:hover {
            color: var(--coffee);
        }

        .footer-status {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .footer-status::before {
            width: 7px;
            height: 7px;
            content: "";
            background: #6d8060;
            border-radius: 50%;
        }

        /* RESPONSIVE */

        @media(max-width:1000px) {
            .register-container {
                width: calc(100% - 40px);
                grid-template-columns: 0.85fr 1.15fr;
                gap: 15px;
            }

            .register-story {
                padding: 26px;
            }

            .register-main {
                padding: 30px 25px;
                min-height: 700px;
            }

            .story-heading h1 {
                font-size: 34px;
            }
        }

        @media(max-width:760px) {
            .register-container {
                width: calc(100% - 32px);
                max-width: 570px;

                grid-template-columns: 1fr;
                align-items: stretch;

                margin: 24px auto;
            }

            .register-story {
                padding: 27px;
            }

            .register-main {
                width: 100%;
                min-height: 0;

                padding: 29px 25px;

                align-self: stretch;
            }

            .register-form {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .form-bottom {
                margin-top: 25px;
            }

            .site-footer {
                padding: 20px;
            }
        }

        @media(max-width:520px) {
            .register-container {
                width: calc(100% - 22px);
                margin: 14px auto 24px;
            }

            .register-main {
                padding: 25px 19px;
                min-height: 0;
            }

            .register-form {
                grid-template-columns: 1fr;
                gap: 14px;
            }

            .password-strength,
            .register-consent,
            .register-button {
                grid-column: 1;
            }

            .form-bottom {
                align-items: flex-start;
                flex-direction: column;

                margin-top: 22px;
                padding: 17px;
            }

            .login-link {
                text-align: left;
                white-space: normal;
            }

            .site-footer {
                align-items: flex-start;
                flex-direction: column;
                gap: 15px;
            }

            .footer-links {
                flex-wrap: wrap;
                gap: 12px 20px;
            }
        }

        @media (max-width: 380px) {
            .register-main {
                padding: 22px 15px;
            }

            .register-story {
                padding: 20px;
            }

            .form-bottom {
                padding: 14px;
            }

        }
    </style>
</head>

<body>

<!-- HEADER -->
<header class="topbar">

    <a class="top-brand" href="{{ route('admin.login') }}">
        <span class="brand-icon" aria-hidden="true">♨</span>
        <span>Chōgō Coffee</span>
    </a>

    <nav class="top-navigation" aria-label="Navigasi utama">

        <a href="{{ route('admin.login') }}">Masuk</a>

        <a href="{{ route('customer.register') }}">Daftar Akun</a>

        <a href="#register-help">Bantuan</a>

        <div class="language">
            <span>ID</span>
            <span>EN</span>
        </div>

        <span class="user-icon" aria-hidden="true">♙</span>

    </nav>

</header>


<!-- MAIN -->
<main class="register-container">

    <!-- LEFT PANEL -->
    <section class="register-story" aria-label="Keanggotaan Chōgō Coffee">

        <div class="story-top">

            <span class="story-badge">
                PORTAL MITRA &amp; KARYAWAN
            </span>

            <span class="story-edition">
                EDISI ROASTERY 2024
            </span>

        </div>


        <div class="story-heading">

            <p class="story-kicker">
                KEMITRAAN &amp; EKOSISTEM KOPI
            </p>

            <h1>
                Bergabung dengan Tim &amp; Ekosistem
                <em>Chōgō Coffee</em>
            </h1>

            <p class="story-description">
                Platform operasional terkurasi untuk menyelaraskan
                keahlian barista, presisi peracikan, dan ketepatan
                inventaris di setiap cangkir.
            </p>

        </div>


        <!-- IMAGE -->
        <div class="story-image">

            <img
                src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=1000&q=85"
                alt="Aktivitas barista menyiapkan kopi di kedai"
            >

            <div class="image-caption">

                <span>⚙ STANDAR KEAHLIAN CHŌGŌ</span>

                <span class="image-version">SOP V3.2</span>

            </div>

        </div>


        <!-- FEATURES -->
        <div class="story-features">

            <article class="feature-card">

                <div class="feature-icon">♨</div>

                <div class="feature-content">

                    <h3>Akses Terintegrasi POS &amp; KDS</h3>

                    <p>
                        Kelola aliran tiket pesanan meja dan takeaway
                        secara real-time langsung ke stasiun brewing
                        tanpa jeda.
                    </p>

                </div>

            </article>


            <article class="feature-card">

                <div class="feature-icon">◷</div>

                <div class="feature-content">

                    <h3>Pelacakan Presensi &amp; Shift Digital</h3>

                    <p>
                        Pencatatan jam kerja, rotasi cupping,
                        serta absensi harian berbasis geofencing
                        gerai dengan akurasi tinggi.
                    </p>

                </div>

            </article>


            <article class="feature-card">

                <div class="feature-icon">▣</div>

                <div class="feature-content">

                    <h3>Manajemen Stok &amp; Menu Otomatis</h3>

                    <p>
                        Monitoring ketersediaan batch beans harian,
                        susu oat, dan kurasi biji single-origin
                        dari satu dasbor terpusat.
                    </p>

                </div>

            </article>

        </div>


        <!-- TESTIMONIAL -->
        <div class="story-testimonial">

            <div class="testimonial-stars">
                ★★★★★
            </div>

            <blockquote>
                "Sistem yang memudahkan fokus kami menyeduh rasa
                terbaik untuk pelanggan tanpa terbebani kerumitan
                administratif."
            </blockquote>

            <div class="testimonial-author">
                Dimas Prasetyo
            </div>

            <div class="testimonial-position">
                Head Barista &amp; Q-Grader, Tebet Central Hub
            </div>

        </div>

    </section>


    <!-- RIGHT FORM -->
    <section class="register-main" aria-labelledby="register-title">

        <header class="form-heading">

            <p class="form-kicker">
                ♙ FORMULIR PENDAFTARAN PELANGGAN
            </p>

            <h2 id="register-title">
                Daftar Akun Baru
            </h2>

            <p>
                Lengkapi data diri Anda untuk membuat akun
                dan menikmati layanan Chōgō Coffee.
            </p>

        </header>


        <!-- SUCCESS MESSAGE -->
        @if (session('registration_success'))

            <div class="register-global-error register-success"
                 role="status">

                Akun pelanggan berhasil dibuat.
                Silakan masuk menggunakan email dan kata sandi.

            </div>

        @endif


        <!-- GLOBAL ERROR -->
        @if ($errors->any() && ! $errors->has('nama') && ! $errors->has('email') && ! $errors->has('password') && ! $errors->has('terms'))

            <div class="register-global-error" role="alert">

                {{ $errors->first() }}

            </div>

        @endif


        <!-- TERMS ERROR -->
        @error('terms')

            <div class="register-global-error" role="alert">
                {{ $message }}
            </div>

        @enderror


        <!-- REGISTER FORM -->
        <form
            class="register-form"
            method="POST"
            action="{{ route('customer.register.submit') }}"
        >

            @csrf


            <!-- NAME -->
            <div class="register-field">

                <label for="nama">
                    Nama Lengkap
                </label>

                <div class="field-input">

                    <input
                        id="nama"
                        name="nama"
                        type="text"
                        value="{{ old('nama') }}"
                        autocomplete="name"
                        maxlength="255"
                        placeholder="Contoh: Dimas Prasetyo"
                        required
                        @error('nama')
                            aria-invalid="true"
                            aria-describedby="nama-error"
                        @enderror
                    >

                </div>

                @error('nama')

                    <span class="register-error"
                          id="nama-error"
                          role="alert">

                        {{ $message }}

                    </span>

                @enderror

            </div>


            <!-- EMAIL -->
            <div class="register-field">

                <label for="email">
                    Email Kerja / Pribadi
                </label>

                <div class="field-input">

                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        autocomplete="email"
                        maxlength="255"
                        placeholder="nama@email.com"
                        required
                        @error('email')
                            aria-invalid="true"
                            aria-describedby="email-error"
                        @enderror
                    >

                </div>

                @error('email')

                    <span class="register-error"
                          id="email-error"
                          role="alert">

                        {{ $message }}

                    </span>

                @enderror

            </div>


            <!-- PASSWORD -->
            <div class="register-field">

                <label for="password">
                    Kata Sandi Baru
                </label>

                <div class="field-input">

                    <input
                        id="password"
                        name="password"
                        type="password"
                        autocomplete="new-password"
                        minlength="8"
                        placeholder="Minimal 8 karakter"
                        required
                        @error('password')
                            aria-invalid="true"
                            aria-describedby="password-error"
                        @enderror
                    >

                </div>

                @error('password')

                    <span class="register-error"
                          id="password-error"
                          role="alert">

                        {{ $message }}

                    </span>

                @enderror

            </div>


            <!-- CONFIRM PASSWORD -->
            <div class="register-field">

                <label for="password_confirmation">
                    Konfirmasi Kata Sandi
                </label>

                <div class="field-input">

                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        autocomplete="new-password"
                        minlength="8"
                        placeholder="Ketik ulang kata sandi"
                        required
                    >

                </div>

            </div>


            <!-- PASSWORD VISUAL -->
            <div class="password-strength">

                <div class="strength-heading">

                    <strong>Kekuatan Kata Sandi:</strong>

                    <span>Minimal 8 karakter</span>

                </div>

                <div class="strength-bars">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

                <div class="strength-hints">

                    <span>○ Min. 8 karakter</span>

                    <span>○ Huruf besar &amp; angka</span>

                    <span>○ Konfirmasi cocok</span>

                </div>

            </div>


            <!-- TERMS -->
            <label class="register-consent">

                <input
                    type="checkbox"
                    name="terms"
                    value="1"
                    required
                    @checked(old('terms'))
                >

                <span>
                    Saya menyetujui
                    <a href="#register-help">Kebijakan Privasi</a>
                    dan
                    <a href="#register-help">Standar Operasional (SOP) Chōgō Coffee</a>
                    dalam pengelolaan data pelanggan.
                </span>

            </label>


            <!-- SUBMIT -->
            <button class="register-button" type="submit">

                Buat Akun Pelanggan →
                
            </button>

        </form>


        <!-- BOTTOM INFORMATION -->
        <div class="form-bottom">

            <div class="security-note">
                ♧ Data pendaftaran pelanggan terlindungi
            </div>

            <div class="login-link">

                Sudah memiliki akun?

                <a href="{{ route('admin.login') }}">
                    Masuk ke Portal Login →
                </a>

            </div>

        </div>

    </section>

</main>


<!-- FOOTER -->
<footer class="site-footer">

    <div class="footer-description">

        <span>
            © {{ now()->year }} PT Chōgō Kopi Nusantara.
            Hak Cipta Dilindungi.
        </span>

        <p>
            Kurasi biji kopi pilihan dari perkebunan Nusantara
            dengan metode roasting presisi.
        </p>

    </div>


    <nav class="footer-links" aria-label="Informasi layanan">

        <a href="#register-help">
            Pusat Layanan
        </a>

        <a href="#register-help">
            Privasi &amp; Ketentuan
        </a>

        <span class="footer-status">
            Status Roastery
        </span>

    </nav>

</footer>

</body>
</html>
