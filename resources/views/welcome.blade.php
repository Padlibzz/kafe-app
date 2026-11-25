
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#fff5ee">
    <meta name="description" content="Chōgō Coffee — Artisan Kōhī & Roastery.">
    <title>Chōgō Coffee · Artisan Kōhī & Roastery</title>

    <style>
        * { box-sizing: border-box; }

        :root {
            --ink: #493326;
            --muted: #88766a;
            --paper: #fff9f5;
            --cream: #fff0e6;
            --peach: #fce9dd;
            --coffee: #69432e;
            --dark: #593a29;
            --green: #788b68;
            --line: #eee0d6;
            --serif: Georgia, 'Times New Roman', serif;
        }

        html { scroll-behavior: smooth; }

        body {
            margin: 0;
            color: var(--ink);
            background: var(--paper);
            font: 14px/1.6 system-ui, sans-serif;
        }

        a { color: inherit; text-decoration: none; }

        button { font: inherit; cursor: pointer; }

        img { display: block; max-width: 100%; }

        .wrap {
            width: min(1200px, calc(100% - 64px));
            margin: auto;
        }

        /* HEADER */

        .site-header {
            position: sticky;
            top: 0;
            z-index: 20;
            background: rgba(255,249,245,.96);
            border-bottom: 1px solid var(--line);
            backdrop-filter: blur(12px);
        }

        .nav {
            min-height: 76px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 9px;
            white-space: nowrap;
            font: 700 22px var(--serif);
        }

        .brand-mark {
            width: 34px;
            height: 34px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: var(--coffee);
            color: white;
            font-size: 16px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 23px;
            font-size: 10px;
            font-weight: 650;
            color: #675447;
        }

        .nav-links a:not(.nav-cta):hover {
            color: #a16d49;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .language {
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .nav-login {
            width: 35px;
            height: 35px;
            display: grid;
            place-items: center;
            border: 1px solid var(--line);
            border-radius: 50%;
            font-size: 15px;
        }

        .nav-cta, .button {
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 0 18px;
            border: 1px solid var(--coffee);
            border-radius: 30px;
            color: white;
            background: var(--coffee);
            font-size: 10px;
            font-weight: 750;
            transition: .2s;
        }

        .nav-cta:hover, .button:hover {
            background: #493020;
            transform: translateY(-2px);
        }

        .menu-toggle {
            display: none;
            width: 40px;
            height: 40px;
            border: 1px solid var(--line);
            border-radius: 50%;
            background: white;
            color: var(--coffee);
        }

        /* HERO */

        .hero {
            display: grid;
            grid-template-columns: 1.15fr .85fr;
            align-items: center;
            min-height: 570px;
            padding: 55px max(32px, calc((100vw - 1200px)/2));
            gap: 35px;
            background: var(--cream);
        }

        .hero-copy { padding: 20px 0; }

        .eyebrow {
            margin: 0 0 13px;
            color: #8c6a4e;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: .16em;
            text-transform: uppercase;
        }

        .hero h1 {
            max-width: 580px;
            margin: 0;
            font: 700 clamp(42px, 5vw, 67px)/1.05 var(--serif);
            letter-spacing: -.045em;
        }

        .hero h1 em {
            font-weight: 400;
        }

        .hero-text {
            max-width: 470px;
            margin: 18px 0 24px;
            color: #756357;
            font-size: 12px;
        }

        .hero-actions {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .button-light {
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0 18px;
            border-radius: 30px;
            background: #fffaf6;
            color: var(--coffee);
            font-size: 10px;
            font-weight: 750;
        }

        .hero-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 9px;
            margin-top: 35px;
        }

        .stat {
            padding: 12px 10px;
            border-radius: 12px;
            background: rgba(255,255,255,.8);
        }

        .stat strong {
            display: block;
            font: 700 16px var(--serif);
        }

        .stat span {
            display: block;
            color: var(--muted);
            font-size: 8px;
        }

        .hero-visual {
            position: relative;
            min-width: 0;
            padding: 20px 0;
        }

        .hero-photo {
            height: 390px;
            overflow: hidden;
            border-radius: 17px;
            box-shadow: 0 12px 25px #513a2820;
        }

        .hero-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-badge {
            position: absolute;
            top: 0;
            left: -18px;
            padding: 11px 15px;
            border-radius: 12px;
            background: white;
            box-shadow: 0 5px 15px #00000012;
            font-size: 9px;
            font-weight: 750;
        }

        .hero-product {
            position: absolute;
            right: 12px;
            bottom: 4px;
            left: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 15px;
            border-radius: 12px;
            background: white;
            box-shadow: 0 5px 20px #00000015;
        }

        .hero-product strong {
            display: block;
            font-size: 10px;
        }

        .hero-product span {
            color: var(--muted);
            font-size: 8px;
        }

        /* SECTION UMUM */

        .section {
            padding: 75px 0;
        }

        .section-head {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 28px;
        }

        .section-head h2 {
            margin: 0;
            font: 700 clamp(30px, 3.5vw, 43px)/1.1 var(--serif);
            letter-spacing: -.035em;
        }

        .section-head p {
            max-width: 430px;
            margin: 9px 0 0;
            color: var(--muted);
            font-size: 11px;
        }

        .section-link {
            flex: none;
            font-size: 9px;
            font-weight: 750;
        }

        /* MENU */

        .menu-section { background: var(--paper); }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0,1fr));
            gap: 17px;
        }

        .menu-card {
            min-width: 0;
            overflow: hidden;
            border: 1px solid #f0e5dc;
            border-radius: 13px;
            background: white;
            transition: .2s;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 9px 22px #68432e12;
        }

        .menu-image {
            position: relative;
            aspect-ratio: 1.15;
            overflow: hidden;
            background: #eee1d5;
        }

        .menu-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .35s;
        }

        .menu-card:hover .menu-image img {
            transform: scale(1.05);
        }

        .menu-label {
            position: absolute;
            top: 10px;
            left: 10px;
            padding: 5px 9px;
            border-radius: 20px;
            background: white;
            font-size: 8px;
            font-weight: 750;
        }

        .menu-details { padding: 14px; }

        .menu-details h3 {
            margin: 0;
            font: 700 17px var(--serif);
        }

        .menu-details p {
            min-height: 43px;
            margin: 7px 0 13px;
            color: var(--muted);
            font-size: 9px;
        }

        .menu-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .menu-price {
            color: var(--coffee);
            font-size: 12px;
            font-weight: 800;
        }

        .menu-price small {
            display: block;
            color: var(--muted);
            font-size: 8px;
            font-weight: 400;
        }

        .menu-add {
            width: 30px;
            height: 30px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: var(--cream);
            color: var(--coffee);
            font-size: 18px;
        }

        .menu-empty {
            grid-column: 1/-1;
            padding: 30px;
            border-radius: 12px;
            background: white;
            text-align: center;
            color: var(--muted);
        }

        /* QR ORDER */

        .order-section {
            background: #fbede3;
        }

        .order-grid {
            display: grid;
            grid-template-columns: 1.25fr .75fr;
            align-items: center;
            gap: 55px;
        }

        .order-copy h2 {
            max-width: 540px;
            margin: 0;
            font: 700 clamp(31px, 3.5vw, 43px)/1.12 var(--serif);
        }

        .order-copy > p {
            max-width: 540px;
            margin: 13px 0 23px;
            color: var(--muted);
            font-size: 11px;
        }

        .order-steps {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .order-step {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 16px;
            border: 1px solid #f0e3d9;
            border-radius: 12px;
            background: white;
        }

        .step-number {
            width: 25px;
            height: 25px;
            flex: none;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: var(--coffee);
            color: white;
            font-size: 9px;
            font-weight: 800;
        }

        .order-step strong {
            display: block;
            font-size: 10px;
        }

        .order-step p {
            margin: 5px 0 0;
            color: var(--muted);
            font-size: 9px;
        }

        .qr-card {
            max-width: 340px;
            width: 100%;
            justify-self: center;
            padding: 27px;
            border-radius: 18px;
            background: white;
            text-align: center;
            box-shadow: 0 10px 24px #6b422416;
        }

        .qr-brand {
            font: 700 23px var(--serif);
        }

        .qr-subtitle {
            margin-top: 5px;
            color: var(--muted);
            font-size: 9px;
        }

        .qr-placeholder {
            width: 170px;
            height: 170px;
            display: grid;
            place-items: center;
            margin: 23px auto 15px;
            border: 8px solid #f9f1e9;
            border-radius: 10px;
            background:
                repeating-conic-gradient(#63432f 0 25%, transparent 0 50%)
                0 0 / 16px 16px;
            position: relative;
        }

        .qr-placeholder::after {
            content: "QR";
            width: 54px;
            height: 54px;
            display: grid;
            place-items: center;
            border: 6px solid white;
            border-radius: 8px;
            background: var(--coffee);
            color: white;
            font-weight: 800;
            font-size: 16px;
        }

        .qr-caption {
            color: var(--muted);
            font-size: 9px;
        }

        .qr-note {
            margin-top: 15px;
            padding: 10px;
            border-radius: 8px;
            background: #edf3e8;
            color: #637b58;
            font-size: 9px;
        }

        /* ROASTERY */

        .roastery-section { background: var(--paper); }

        .roastery-grid {
            display: grid;
            grid-template-columns: .9fr 1.1fr;
            align-items: center;
            gap: 45px;
        }

        .roastery-photo {
            position: relative;
            height: 430px;
            overflow: hidden;
            border-radius: 17px;
        }

        .roastery-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .photo-caption {
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
            padding: 25px 18px 17px;
            color: white;
            background: linear-gradient(transparent, #000000a8);
            font: 700 18px var(--serif);
        }

        .roastery-copy h2 {
            margin: 0;
            font: 700 clamp(32px, 3.5vw, 43px)/1.1 var(--serif);
        }

        .roastery-copy > p {
            color: var(--muted);
            font-size: 11px;
        }

        .roastery-features {
            display: grid;
            gap: 12px;
            margin-top: 23px;
        }

        .roastery-feature {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            padding: 15px;
            border-radius: 11px;
            background: #fff0e6;
        }

        .feature-icon {
            width: 32px;
            height: 32px;
            flex: none;
            display: grid;
            place-items: center;
            border-radius: 9px;
            background: var(--coffee);
            color: white;
        }

        .roastery-feature strong {
            display: block;
            font-size: 10px;
        }

        .roastery-feature p {
            margin: 4px 0 0;
            color: var(--muted);
            font-size: 9px;
        }

        /* ULASAN */

        .review-section {
            background: #fbede5;
            text-align: center;
        }

        .review-section .eyebrow { margin-bottom: 8px; }

        .review-section h2 {
            margin: 0;
            font: 700 clamp(31px, 3.5vw, 43px) var(--serif);
        }

        .review-intro {
            max-width: 530px;
            margin: 10px auto 28px;
            color: var(--muted);
            font-size: 11px;
        }

        .review-grid {
            display: grid;
            grid-template-columns: repeat(3,1fr);
            gap: 16px;
            text-align: left;
        }

        .review-card {
            padding: 20px;
            border-radius: 14px;
            background: white;
        }

        .stars {
            color: #a66b2e;
            letter-spacing: 2px;
            font-size: 13px;
        }

        .review-card > p {
            min-height: 75px;
            margin: 12px 0 17px;
            color: #6f6259;
            font-size: 10px;
        }

        .review-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .review-avatar {
            width: 34px;
            height: 34px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: var(--cream);
            font-size: 10px;
            font-weight: 800;
        }

        .review-user strong {
            display: block;
            font-size: 10px;
        }

        .review-user span {
            display: block;
            color: var(--muted);
            font-size: 8px;
        }

        /* LOKASI */

        .location-section { background: var(--paper); }

        .location-grid {
            display: grid;
            grid-template-columns: 1.2fr .8fr;
            gap: 25px;
        }

        .location-card {
            padding: 27px;
            border-radius: 17px;
            background: #fff0e6;
        }

        .location-card h2 {
            margin: 0;
            font: 700 35px var(--serif);
        }

        .location-card > p {
            color: var(--muted);
            font-size: 10px;
        }

        .map-frame {
            height: 290px;
            overflow: hidden;
            margin-top: 20px;
            border: 5px solid white;
            border-radius: 12px;
            background: #e9e1d7;
        }

        .map-frame iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }

        .map-link {
            display: inline-flex;
            margin-top: 13px;
            color: var(--coffee);
            font-size: 10px;
            font-weight: 800;
            text-decoration: underline;
            text-underline-offset: 4px;
        }

        .location-details {
            display: grid;
            grid-template-columns: repeat(2,1fr);
            gap: 10px;
            margin-top: 17px;
        }

        .location-detail {
            padding: 12px;
            border-radius: 9px;
            background: white;
            font-size: 9px;
        }

        .location-detail strong {
            display: block;
            margin-bottom: 3px;
        }

        .reservation-card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 100%;
            padding: 30px;
            border-radius: 17px;
            color: #fff8ef;
            background: var(--dark);
        }

        .reservation-card h2 {
            margin: 17px 0;
            font: 700 36px/1.15 var(--serif);
        }

        .reservation-card p {
            color: #e2d2c4;
            font-size: 11px;
        }

        .reservation-info {
            margin-top: 20px;
            font-size: 10px;
        }

        .reservation-card .button {
            width: 100%;
            margin-top: 30px;
            color: var(--coffee);
            background: white;
            border-color: white;
        }

        /* FOOTER */

        .footer {
            padding: 55px 0 20px;
            background: #fceee4;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.3fr 1fr 1fr 1.1fr;
            gap: 30px;
        }

        .footer-brand {
            font: 700 24px var(--serif);
        }

        .footer p {
            color: var(--muted);
            font-size: 9px;
        }

        .footer h4 {
            margin: 0 0 14px;
            font-size: 11px;
        }

        .footer-links {
            display: grid;
            gap: 9px;
        }

        .footer-links a {
            color: var(--muted);
            font-size: 9px;
        }

        .footer-links a:hover { color: var(--coffee); }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            margin-top: 40px;
            padding-top: 17px;
            border-top: 1px solid #eadbd0;
            color: var(--muted);
            font-size: 9px;
        }

        /* RESPONSIVE */

        @media(max-width:1000px) {
            .nav-links { gap: 12px; }
            .nav-links { font-size: 9px; }
            .brand { font-size: 18px; }
            .hero { padding-inline: 30px; }
            .hero-stats { grid-template-columns: repeat(2,1fr); }
        }

        @media(max-width:760px) {
            .wrap { width: calc(100% - 36px); }

            .nav { min-height: 68px; }

            .menu-toggle { display: block; }

            .nav-links {
                position: absolute;
                top: 68px;
                right: 0;
                left: 0;
                display: none;
                align-items: stretch;
                flex-direction: column;
                gap: 0;
                padding: 15px 20px;
                background: var(--paper);
                border-bottom: 1px solid var(--line);
            }

            .nav-links.is-open { display: flex; }

            .nav-links a { padding: 12px 0; }

            .nav-actions { display: none; }

            .nav-cta { margin-top: 8px; }

            .hero {
                grid-template-columns: 1fr;
                padding: 42px 22px;
            }

            .hero-copy { order: 1; }

            .hero-visual { order: 2; }

            .hero-photo { height: 330px; }

            .hero h1 { font-size: clamp(42px, 11vw, 58px); }

            .section { padding: 60px 0; }

            .section-head {
                align-items: flex-start;
                flex-direction: column;
            }

            .menu-grid { grid-template-columns: repeat(2,1fr); }

            .order-grid,
            .roastery-grid,
            .location-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .qr-card { max-width: 100%; }

            .roastery-photo { height: 340px; }

            .review-grid { grid-template-columns: 1fr; }

            .review-card > p { min-height: 0; }

            .reservation-card { min-height: 340px; }

            .footer-grid { grid-template-columns: 1fr 1fr; }
        }

        @media(max-width:420px) {
            .menu-grid { grid-template-columns: 1fr 1fr; gap: 10px; }
            .menu-details { padding: 10px; }
            .menu-details h3 { font-size: 14px; }
            .menu-details p { font-size: 8px; }
            .order-steps { grid-template-columns: 1fr; }
            .hero-stats { gap: 7px; }
            .hero-product { left: 7px; right: 7px; }
            .footer-grid { grid-template-columns: 1fr; }
            .footer-bottom { flex-direction: column; }
        }

        @media(prefers-reduced-motion:reduce) {
            *,*::before,*::after {
                scroll-behavior: auto !important;
                animation: none !important;
                transition: none !important;
            }
        }
    </style>
</head>

<body>

<header class="site-header">
    <div class="wrap nav">

        <a class="brand" href="{{ route('home') }}">
            <span class="brand-mark">C</span>
            <span>Chōgō Coffee</span>
        </a>

        <button class="menu-toggle"
                type="button"
                aria-expanded="false"
                aria-controls="primary-nav"
                aria-label="Buka navigasi">
            ☰
        </button>

        <nav class="nav-links" id="primary-nav">
            <a href="{{ route('home') }}">Beranda</a>
            <a href="#roastery">Filosofi & Roastery</a>
            <a href="#menu">Menu Pilihan</a>
            <a href="#order">Pengalaman Dine-In & QR</a>
            <a href="#visit">Lokasi Kedai</a>
            <a href="{{ route('admin.login') }}">Masuk Portal Staf</a>

            <a class="nav-cta" href="#order">
                Pesan Online / QR Menu →
            </a>
        </nav>

        <div class="nav-actions">
            <span class="language">◉ ID / EN</span>

            <a class="nav-login"
               href="{{ route('admin.login') }}"
               aria-label="Masuk akun">
                ♙
            </a>
        </div>

    </div>
</header>

<main>

    <!-- HERO -->

    <section class="hero">

        <div class="hero-copy">

            <p class="eyebrow">Artisan Kōhī · Roastery</p>

            <h1>
                Menyapa Hari dengan
                <em>Keseimbangan Rasa & Presisi</em>
                Kōhī
            </h1>

            <p class="hero-text">
                Eksplorasi cita rasa biji kopi pilihan dengan presisi
                roasting dan penyajian yang istimewa. Nikmati setiap
                cangkir kopi dengan karakter dan kualitas terbaik.
            </p>

            <div class="hero-actions">
                <a class="button" href="#menu">
                    Lihat Buku Menu Digital ×
                </a>

                <a class="button-light" href="#roastery">
                    Eksplorasi Filosofi Roastery →
                </a>
            </div>

            <div class="hero-stats">

                <div class="stat">
                    <strong>100%</strong>
                    <span>Biji Kopi Pilihan</span>
                </div>

                <div class="stat">
                    <strong>Harian</strong>
                    <span>Micro-Roasting</span>
                </div>

                <div class="stat">
                    <strong>0 Menit</strong>
                    <span>Antre via QR Menu*</span>
                </div>

                <div class="stat">
                    <strong>4.9/5</strong>
                    <span>Kualitas Rasa</span>
                </div>

            </div>

        </div>

        <div class="hero-visual">

            <div class="hero-badge">
                ◉ Artisan Selected
                <br>Specialty Coffee
            </div>

            <div class="hero-photo">
                <img
                    src="https://images.unsplash.com/photo-1442512595331-e89e73853f31?auto=format&fit=crop&w=1200&q=85"
                    alt="Suasana penyajian kopi Chogo"
                    fetchpriority="high">
            </div>

            <div class="hero-product">
                <div>
                    <strong>Batch Pagi: Gayo Honey</strong>
                    <span>Fresh Roasted · Specialty Coffee</span>
                </div>
                <span>Fresh Roasted</span>
            </div>

        </div>

    </section>


    <!-- MENU -->

    <section class="section menu-section" id="menu">

        <div class="wrap">

            <div class="section-head">

                <div>
                    <p class="eyebrow">Kurasi Rasa Ikonik</p>

                    <h2>Koleksi Rasa Ikonik Chōgō</h2>

                    <p>
                        Disajikan dari hasil eksperimen rasa dan pilihan
                        bahan berkualitas. Setiap racikan menghadirkan
                        karakter kopi yang istimewa.
                    </p>
                </div>

                <a href="#menu" class="section-link">
                    Buka Seluruh Kategori Menu →
                </a>

            </div>

            <div class="menu-grid">

                @forelse ($menus as $menu)

                    <article class="menu-card">

                        <div class="menu-image">

                            <img
                                src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($menu->foto) }}"
                                alt="{{ $menu->nama_menu }}"
                                loading="lazy">

                            <span class="menu-label">
                                Chōgō Selected
                            </span>

                        </div>

                        <div class="menu-details">

                            <h3>{{ $menu->nama_menu }}</h3>

                            <p>{{ $menu->deskripsi }}</p>

                            <div class="menu-bottom">

                                <div class="menu-price">
                                    <small>Mulai dari</small>
                                    Rp{{ number_format((float) $menu->harga, 0, ',', '.') }}
                                </div>

                                <a href="#order"
                                   class="menu-add"
                                   aria-label="Lihat cara pemesanan">
                                    +
                                </a>

                            </div>

                        </div>

                    </article>

                @empty

                    <p class="menu-empty">
                        Menu belum tersedia untuk ditampilkan.
                    </p>

                @endforelse

            </div>

        </div>

    </section>


    <!-- PENGALAMAN DINE IN DAN QR -->

    <section class="section order-section" id="order">

        <div class="wrap order-grid">

            <div class="order-copy">

                <p class="eyebrow">Pengalaman Tanpa Hambatan</p>

                <h2>
                    Kenyamanan Duduk Santai,
                    Pesan Langsung dari Meja
                </h2>

                <p>
                    Hilangkan kerumitan antrean dalam menikmati kopi.
                    Melalui sistem pemesanan digital Chōgō, pelanggan
                    dapat melihat menu dan melakukan pemesanan dengan mudah.
                </p>

                <div class="order-steps">

                    <div class="order-step">
                        <span class="step-number">1</span>
                        <div>
                            <strong>Pilih Menu Favorit</strong>
                            <p>
                                Pelanggan melihat pilihan menu dan
                                menentukan minuman yang diinginkan.
                            </p>
                        </div>
                    </div>

                    <div class="order-step">
                        <span class="step-number">2</span>
                        <div>
                            <strong>Pindai QR</strong>
                            <p>
                                Pelanggan memindai QR yang tersedia
                                pada meja untuk membuka menu digital.
                            </p>
                        </div>
                    </div>

                    <div class="order-step">
                        <span class="step-number">3</span>
                        <div>
                            <strong>Kustomisasi & QRIS</strong>
                            <p>
                                Pelanggan menyelesaikan pesanan dan
                                melakukan pembayaran melalui kasir
                                atau metode yang tersedia.
                            </p>
                        </div>
                    </div>

                    <div class="order-step">
                        <span class="step-number">4</span>
                        <div>
                            <strong>Pesanan Diantar</strong>
                            <p>
                                Pelanggan menunggu pemberitahuan
                                hingga pesanan siap diambil.
                            </p>
                        </div>
                    </div>

                </div>

            </div>

            <div class="qr-card">

                <div class="qr-brand">Chōgō</div>

                <div class="qr-subtitle">
                    DINE-IN · NOMOR MEJA: 05 · SLOW BAR AREA
                </div>

                <div class="qr-placeholder" aria-hidden="true"></div>

                <div class="qr-caption">
                    PEMESANAN MENU DIGITAL
                </div>

                <div class="qr-note">
                    ◉ QR Menu Digital Chōgō Coffee
                </div>

            </div>

        </div>

    </section>


    <!-- FILOSOFI ROASTERY -->

    <section class="section roastery-section" id="roastery">

        <div class="wrap roastery-grid">

            <div class="roastery-photo">

                <img
                    src="https://images.unsplash.com/photo-1511537190424-bbbab87ac5eb?auto=format&fit=crop&w=1100&q=85"
                    alt="Peralatan roasting biji kopi"
                    loading="lazy">

                <div class="photo-caption">
                    Micro-Roaster: Precision Craft
                </div>

            </div>

            <div class="roastery-copy">

                <p class="eyebrow">Filosofi Craftsmanship</p>

                <h2>
                    Dari Perkebunan Terpilih
                    Hingga Presisi Ekstraksi
                </h2>

                <p>
                    Kami meyakini secangkir kopi terbaik bermula
                    dari kejelian memilih biji kopi dan proses
                    pengolahan yang tepat.
                </p>

                <div class="roastery-features">

                    <div class="roastery-feature">
                        <span class="feature-icon">◈</span>
                        <div>
                            <strong>Etika Pengadaan Biji</strong>
                            <p>
                                Memilih biji kopi dari sumber yang
                                memperhatikan kualitas dan keberlanjutan.
                            </p>
                        </div>
                    </div>

                    <div class="roastery-feature">
                        <span class="feature-icon">◉</span>
                        <div>
                            <strong>Profil Sangrai Mikro Terukur</strong>
                            <p>
                                Setiap proses sangrai dilakukan
                                dengan perhatian pada karakter biji kopi.
                            </p>
                        </div>
                    </div>

                    <div class="roastery-feature">
                        <span class="feature-icon">▥</span>
                        <div>
                            <strong>Kalibrasi Harian Bersertifikasi</strong>
                            <p>
                                Menjaga konsistensi rasa dan kualitas
                                ekstraksi pada setiap penyajian.
                            </p>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- ULASAN -->

    <section class="section review-section">

        <div class="wrap">

            <p class="eyebrow">Ulasan Pengunjung</p>

            <h2>Ketenangan Ruang & Konsistensi Seduh</h2>

            <p class="review-intro">
                Apresiasi dari pelanggan menjadi bagian dari perjalanan
                kami dalam menghadirkan pengalaman menikmati kopi.
            </p>

            <div class="review-grid">

                <article class="review-card">

                    <div class="stars">★★★★★</div>

                    <p>
                        "Tempat yang nyaman untuk menikmati kopi.
                        Suasananya tenang dan kualitas rasa kopinya
                        terasa istimewa."
                    </p>

                    <div class="review-user">
                        <div class="review-avatar">AN</div>
                        <div>
                            <strong>Anindya Nadhira</strong>
                            <span>Pelanggan Chōgō Coffee</span>
                        </div>
                    </div>

                </article>

                <article class="review-card">

                    <div class="stars">★★★★★</div>

                    <p>
                        "Sistem pemesanan digital sangat membantu.
                        Pelayanan terasa lebih praktis dan pengalaman
                        menikmati kopi menjadi menyenangkan."
                    </p>

                    <div class="review-user">
                        <div class="review-avatar">DH</div>
                        <div>
                            <strong>Dimas Hartono</strong>
                            <span>Customer & Coffee Enthusiast</span>
                        </div>
                    </div>

                </article>

                <article class="review-card">

                    <div class="stars">★★★★★</div>

                    <p>
                        "Suasananya nyaman dan pilihan menu kopinya
                        menarik. Cocok untuk menikmati waktu
                        bersama teman."
                    </p>

                    <div class="review-user">
                        <div class="review-avatar">SK</div>
                        <div>
                            <strong>Sarah Kirana</strong>
                            <span>Regular Coffee Lover</span>
                        </div>
                    </div>

                </article>

            </div>

        </div>

    </section>


    <!-- LOKASI DAN GOOGLE MAPS -->

    <section class="section location-section" id="visit">

        <div class="wrap location-grid">

            <div class="location-card">

                <p class="eyebrow">Temukan Kami</p>

                <h2>Chōgō Coffee Central Hub</h2>

                <p>
                    Kunjungi kedai Chōgō Coffee dan nikmati pengalaman
                    artisan coffee bersama kami.
                </p>

                <div class="location-details">

                    <div class="location-detail">
                        <strong>◉ Lokasi</strong>
                        Google Maps
                    </div>

                    <div class="location-detail">
                        <strong>☕ Suasana</strong>
                        Coffee & Roastery
                    </div>

                </div>

                <div class="map-frame">

                    <iframe
                        src="https://share.google/wm6C4hzv2kb581cvF"
                        title="Lokasi Chōgō Coffee di Google Maps"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        allowfullscreen>
                    </iframe>

                </div>

                <a
                    class="map-link"
                    href="https://share.google/wm6C4hzv2kb581cvF"
                    target="_blank"
                    rel="noopener noreferrer">
                    Buka Lokasi di Google Maps →
                </a>

            </div>


            <div class="reservation-card">

                <div>

                    <p class="eyebrow" style="color:#e5c7a9">
                        ◉ Chōgō Coffee Experience
                    </p>

                    <h2>
                        Sisi Cupping Eksklusif:
                        Lot Baru Flores Bajawa
                    </h2>

                    <p>
                        Nikmati pengalaman mengenal karakter kopi
                        pilihan melalui eksplorasi rasa dan aroma
                        khas Chōgō Coffee.
                    </p>

                    <div class="reservation-info">
                        ◷ Pengalaman Coffee Tasting
                        <br><br>
                        ◈ Chōgō Coffee
                    </div>

                </div>

                <a href="#menu" class="button">
                    Jelajahi Menu Chōgō →
                </a>

            </div>

        </div>

    </section>

</main>


<!-- FOOTER -->

<footer class="footer">

    <div class="wrap">

        <div class="footer-grid">

            <div>

                <div class="footer-brand">Chōgō Coffee</div>

                <p>
                    Artisan Kōhī & Roastery.
                    Menyajikan pengalaman menikmati kopi
                    dengan kualitas dan karakter rasa terbaik.
                </p>

            </div>

            <div>

                <h4>Eksplorasi</h4>

                <div class="footer-links">
                    <a href="{{ route('home') }}">Beranda</a>
                    <a href="#roastery">Filosofi & Roastery</a>
                    <a href="#menu">Menu & Minuman</a>
                    <a href="#order">Pengalaman Dine-In</a>
                    <a href="#visit">Lokasi Kedai</a>
                </div>

            </div>

            <div>

                <h4>Jam Operasional</h4>

                <div class="footer-links">
                    <span>Senin - Kamis</span>
                    <span>Jumat - Sabtu</span>
                    <span>Minggu & Libur</span>
                </div>

            </div>

            <div>

                <h4>Portal Staf</h4>

                <p>
                    Akses portal untuk pengelolaan
                    operasional Chōgō Coffee.
                </p>

                <div class="footer-links">
                    <a href="{{ route('admin.login') }}">
                        Masuk Portal Admin →
                    </a>

                    <a href="{{ route('customer.register') }}">
                        Daftar sebagai Pelanggan →
                    </a>
                </div>

            </div>

        </div>

        <div class="footer-bottom">

            <span>
                © {{ now()->year }} Chōgō Coffee.
                Seluruh hak cipta dilindungi.
            </span>

            <span>
                Privasi Konsumen · Ketentuan Layanan
            </span>

        </div>

    </div>

</footer>


<script>

    const menuButton = document.querySelector('.menu-toggle');
    const primaryNav = document.querySelector('#primary-nav');

    menuButton.addEventListener('click', () => {

        const isExpanded =
            menuButton.getAttribute('aria-expanded') === 'true';

        menuButton.setAttribute(
            'aria-expanded',
            String(!isExpanded)
        );

        menuButton.setAttribute(
            'aria-label',
            isExpanded ? 'Buka navigasi' : 'Tutup navigasi'
        );

        primaryNav.classList.toggle('is-open', !isExpanded);

    });

    primaryNav.querySelectorAll('a').forEach((link) => {

        link.addEventListener('click', () => {

            menuButton.setAttribute('aria-expanded', 'false');

            menuButton.setAttribute(
                'aria-label',
                'Buka navigasi'
            );

            primaryNav.classList.remove('is-open');

        });

    });

</script>

</body>
</html>
