<!doctype html>
<html lang="id" data-type="place">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f4f0e9">
    <meta name="page-type" content="place">
    <meta name="site-kind" content="other">
    <meta name="page-kind" content="place">
    <meta name="description" content="Chōgō Coffee — artisan kōhī dan roastery.">
    <title>Chōgō Coffee · Artisan Kōhī &amp; Roastery</title>
    <style>
        * { box-sizing:border-box; }
        :root { --ink:#2f261f; --muted:#71665c; --paper:#fbf9f5; --cream:#f1ece4; --line:#ded5c9; --coffee:#60432e; --dark:#30251d; --serif:Georgia,'Times New Roman',serif; }
        html { scroll-behavior:smooth; }
        body { margin:0; color:var(--ink); background:var(--paper); font:15px/1.55 system-ui,-apple-system,sans-serif; }
        a { color:inherit; text-decoration:none; }
        button,a { -webkit-tap-highlight-color:transparent; }
        :focus-visible { outline:3px solid #a7794e; outline-offset:4px; }
        .skip-link { position:absolute; top:8px; left:8px; z-index:20; padding:10px 14px; color:#fff; background:var(--coffee); border-radius:4px; transform:translateY(-150%); }
        .skip-link:focus { transform:translateY(0); }
        .wrap { width:min(1160px,calc(100% - 64px)); margin-inline:auto; }
        .site-header { position:relative; z-index:5; background:var(--paper); border-bottom:1px solid #e8e1d8; }
        .nav { min-height:78px; display:flex; align-items:center; justify-content:space-between; gap:24px; }
        .brand { display:inline-flex; align-items:center; gap:10px; font:700 19px var(--serif); letter-spacing:.015em; white-space:nowrap; }
        .brand-mark { display:grid; place-items:center; width:35px; height:35px; color:#f8f1e7; background:var(--coffee); border-radius:50%; font-size:15px; }
        .nav-links { display:flex; align-items:center; gap:29px; color:#584b40; font-size:12px; font-weight:600; }
        .nav-links a:not(.nav-cta) { position:relative; padding:10px 0; }
        .nav-links a:not(.nav-cta)::after { position:absolute; right:0; bottom:4px; left:0; height:1px; background:var(--coffee); content:""; transform:scaleX(0); transform-origin:left; transition:transform .2s ease; }
        .nav-links a:not(.nav-cta):hover::after { transform:scaleX(1); }
        .nav-cta,.button { min-height:45px; display:inline-flex; align-items:center; justify-content:center; gap:10px; padding:0 19px; color:white; background:var(--coffee); border:1px solid var(--coffee); font-size:11px; font-weight:700; transition:background .18s ease,transform .18s ease; }
        .nav-cta:hover,.button:hover { background:#493221; transform:translateY(-2px); }
        .button:active,.nav-cta:active { transform:translateY(1px); }
        .menu-toggle { display:none; width:44px; height:44px; color:var(--ink); background:transparent; border:1px solid var(--line); font-size:20px; }
        .hero { min-height:min(750px,calc(100svh - 78px)); display:grid; grid-template-columns:1fr 1fr; align-items:stretch; background:var(--cream); }
        .hero-copy { width:min(580px,100%); justify-self:end; align-self:center; padding:72px 58px 78px 32px; }
        .eyebrow { margin:0 0 17px; color:#806447; font-size:10px; font-weight:750; letter-spacing:.17em; text-transform:uppercase; }
        .hero h1 { max-width:490px; margin:0; font:700 clamp(47px,6.1vw,78px)/.99 var(--serif); letter-spacing:-.045em; }
        .hero-text { max-width:410px; margin:21px 0 0; color:#61564c; font-size:14px; }
        .hero-actions { display:flex; align-items:center; gap:21px; margin-top:29px; }
        .text-link { display:inline-flex; align-items:center; gap:9px; min-height:44px; color:var(--coffee); font-size:11px; font-weight:700; }
        .text-link span { transition:transform .18s ease; }
        .text-link:hover span { transform:translateX(4px); }
        .hero-fact { display:flex; align-items:center; gap:12px; margin-top:47px; color:#64584e; font-size:10px; }
        .hero-fact::before { width:31px; height:1px; background:#9e8264; content:""; }
        .hero-photo { position:relative; min-height:540px; overflow:hidden; background:#8a735f; }
        .hero-photo img { width:100%; height:100%; position:absolute; inset:0; object-fit:cover; object-position:center; }
        .hero-photo::after { position:absolute; inset:0; background:linear-gradient(90deg,#30251d12,transparent 40%); content:""; pointer-events:none; }
        .section { padding:100px 0; }
        .section-head { display:flex; align-items:flex-end; justify-content:space-between; gap:30px; margin-bottom:35px; }
        .section-head h2 { max-width:560px; margin:0; font:700 clamp(34px,4vw,49px)/1.08 var(--serif); letter-spacing:-.035em; }
        .section-head p { max-width:310px; margin:0 0 3px; color:var(--muted); font-size:12px; }
        .menu-section { background:var(--paper); }
        .menu-grid { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:22px; }
        .menu-card { min-width:0; background:#fff; border:1px solid var(--line); transition:transform .2s ease,border-color .2s ease; }
        .menu-card:hover { transform:translateY(-2px); border-color:#bba68e; }
        .menu-image { aspect-ratio:1.27; overflow:hidden; background:#e8dfd4; }
        .menu-image img { width:100%; height:100%; object-fit:cover; transition:transform .35s ease; }
        .menu-card:hover .menu-image img { transform:scale(1.025); }
        .menu-details { padding:17px 18px 19px; }
        .menu-details h3 { margin:0; font:700 20px/1.2 var(--serif); }
        .menu-details p { min-height:40px; margin:8px 0 13px; color:var(--muted); font-size:11px; }
        .menu-price { color:var(--coffee); font-size:12px; font-weight:750; }
        .menu-empty { grid-column:1/-1; padding:30px; border:1px solid var(--line); color:var(--muted); text-align:center; }
        .origin-section { color:#fff8ef; background:var(--dark); }
        .origin-grid { display:grid; grid-template-columns:.92fr 1.08fr; align-items:center; gap:75px; }
        .origin-photo { height:500px; overflow:hidden; background:#75604f; }
        .origin-photo img { width:100%; height:100%; object-fit:cover; }
        .origin-copy .eyebrow { color:#d4b48e; }
        .origin-copy h2 { max-width:510px; margin:0; font:700 clamp(39px,5vw,60px)/1.02 var(--serif); letter-spacing:-.04em; }
        .origin-copy p { max-width:440px; margin:18px 0 0; color:#d8cbbd; font-size:13px; }
        .origin-details { display:grid; grid-template-columns:1fr 1fr; gap:18px; margin-top:31px; padding-top:20px; border-top:1px solid #ffffff28; }
        .origin-details strong { display:block; color:#f2dfc5; font:700 17px var(--serif); }
        .origin-details span { display:block; margin-top:5px; color:#cbbdaf; font-size:10px; }
        .visit-section { background:#eee7dc; }
        .visit-grid { display:grid; grid-template-columns:1fr 1fr; align-items:center; gap:65px; }
        .visit-copy h2 { max-width:480px; margin:0; font:700 clamp(39px,5vw,58px)/1.03 var(--serif); letter-spacing:-.04em; }
        .visit-copy > p { max-width:390px; margin:15px 0 0; color:var(--muted); font-size:13px; }
        .visit-info { display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-top:30px; }
        .visit-info div { padding-top:13px; border-top:1px solid #cfc2b1; }
        .visit-info span { display:block; color:#857568; font-size:9px; font-weight:750; letter-spacing:.1em; text-transform:uppercase; }
        .visit-info strong { display:block; margin-top:5px; font-size:12px; }
        .visit-photo { height:440px; overflow:hidden; background:#c6b6a3; }
        .visit-photo img { width:100%; height:100%; object-fit:cover; }
        .visit-note { margin-top:19px; color:#817366; font-size:10px; }
        .visit-note a { color:var(--coffee); text-decoration:underline; text-underline-offset:3px; }
        .closing { padding:77px 0; color:#fff8ef; background:var(--coffee); }
        .closing-inner { display:flex; align-items:center; justify-content:space-between; gap:35px; }
        .closing h2 { max-width:690px; margin:0; font:700 clamp(34px,4.5vw,54px)/1.05 var(--serif); letter-spacing:-.035em; }
        .closing p { margin:11px 0 0; color:#e4d6c8; font-size:12px; }
        .closing .button { flex:none; color:var(--coffee); background:#fff8ef; border-color:#fff8ef; }
        .closing .button:hover { background:#f0e4d4; }
        .footer { padding:27px 0; color:#c8b9aa; background:#251d17; font-size:10px; }
        .footer-inner { display:flex; align-items:center; justify-content:space-between; gap:18px; }
        .footer-brand { color:#fff8ef; font:700 15px var(--serif); }
        [data-enter] .hero-copy > * { animation:rise .65s both; }
        [data-enter] .hero-copy > :nth-child(2) { animation-delay:.08s; }
        [data-enter] .hero-copy > :nth-child(3) { animation-delay:.15s; }
        [data-enter] .hero-photo { animation:photo-in .75s both; }
        @keyframes rise { from { opacity:0; transform:translateY(12px); } to { opacity:1; transform:translateY(0); } }
        @keyframes photo-in { from { opacity:.6; transform:scale(1.015); } to { opacity:1; transform:scale(1); } }
        @media(max-width:900px) { .wrap { width:min(100% - 44px,760px); } .nav-links { gap:17px; } .hero-copy { padding:56px 32px 56px 24px; } .hero h1 { font-size:clamp(43px,7vw,64px); } .origin-grid { gap:38px; } .origin-photo { height:430px; } .visit-grid { gap:35px; } .visit-photo { height:380px; } }
        @media(max-width:680px) { .wrap { width:calc(100% - 36px); } .nav { min-height:68px; } .menu-toggle { display:block; } .nav-links { position:absolute; top:68px; right:0; left:0; display:none; align-items:stretch; gap:0; padding:12px 18px 18px; background:var(--paper); border-bottom:1px solid var(--line); }
            .nav-links.is-open { display:flex; flex-direction:column; } .nav-links a:not(.nav-cta) { min-height:44px; display:flex; align-items:center; } .nav-links a:not(.nav-cta)::after { display:none; } .nav-cta { margin-top:8px; }
            .hero { min-height:0; grid-template-columns:1fr; } .hero-copy { width:auto; order:1; justify-self:stretch; padding:49px 22px 40px; } .hero h1 { max-width:450px; font-size:clamp(46px,13vw,66px); } .hero-text { font-size:13px; } .hero-fact { margin-top:29px; } .hero-photo { min-height:330px; order:2; }
            .section { padding:69px 0; } .section-head { align-items:flex-start; flex-direction:column; gap:10px; margin-bottom:25px; } .section-head p { max-width:420px; } .menu-grid { grid-template-columns:1fr 1fr; gap:11px; } .menu-image { aspect-ratio:1.05; } .menu-details { padding:12px; } .menu-details h3 { font-size:17px; } .menu-details p { min-height:0; margin:6px 0 9px; }
            .origin-grid,.visit-grid { grid-template-columns:1fr; gap:28px; } .origin-photo { height:360px; order:2; } .origin-copy { order:1; } .origin-copy h2,.visit-copy h2 { font-size:clamp(38px,10vw,52px); } .visit-photo { height:330px; order:2; } .visit-copy { order:1; } .closing { padding:58px 0; } .closing-inner { align-items:flex-start; flex-direction:column; } .closing .button { width:100%; } .footer-inner { align-items:flex-start; flex-direction:column; }
        }
        @media(max-width:390px) { .hero-actions { align-items:flex-start; flex-direction:column; gap:8px; } .menu-grid { grid-template-columns:1fr; } .menu-image { aspect-ratio:1.25; } .origin-details,.visit-info { gap:12px; } }
        @media(prefers-reduced-motion:reduce) { html { scroll-behavior:auto; } *,*::before,*::after { animation-duration:.01ms!important; animation-iteration-count:1!important; transition-duration:.01ms!important; } }
    </style>
</head>
<body>
<a class="skip-link" href="#main-content">Lewati ke konten</a>
<header class="site-header">
    <div class="wrap nav">
        <a class="brand" href="{{ route('home') }}" aria-label="Chōgō Coffee, beranda"><span class="brand-mark" aria-hidden="true">C</span><span>Chōgō Coffee</span></a>
        <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-nav" aria-label="Buka navigasi">☰</button>
        <nav class="nav-links" id="primary-nav" aria-label="Navigasi utama">
            <a href="#menu">Menu</a><a href="#roastery">Roastery</a><a href="#visit">Tentang</a>
            <a class="nav-cta" href="{{ route('admin.login') }}">Masuk akun <span aria-hidden="true">→</span></a>
        </nav>
    </div>
</header>
<main id="main-content">
    <section class="hero" data-enter aria-labelledby="hero-title">
        <div class="hero-copy">
            <p class="eyebrow">Artisan kōhī · Roastery</p>
            <h1 id="hero-title">Kopi pilihan, disangrai dengan perhatian.</h1>
            <p class="hero-text">Chōgō Coffee menyajikan kopi dan minuman yang tercatat pada menu kami. Lihat pilihan yang tersedia hari ini.</p>
            <div class="hero-actions"><a class="button" href="#menu">Lihat menu <span aria-hidden="true">↓</span></a><a class="text-link" href="#roastery">Tentang roastery <span aria-hidden="true">→</span></a></div>
            <div class="hero-fact">Pilihan menu diperbarui dari ketersediaan saat ini</div>
        </div>
        <div class="hero-photo"><img src="https://images.unsplash.com/photo-1442512595331-e89e73853f31?auto=format&amp;fit=crop&amp;w=1500&amp;q=85" alt="Secangkir kopi disiapkan di meja bar kafe" fetchpriority="high"></div>
    </section>

    <section class="section menu-section" id="menu" aria-labelledby="menu-title">
        <div class="wrap">
            <header class="section-head"><div><p class="eyebrow">Menu Chōgō</p><h2 id="menu-title">Pilihan dari menu kami</h2></div><p>Nama, deskripsi, harga, dan ketersediaan ditampilkan dari data menu yang tersimpan.</p></header>
            <div class="menu-grid">
                @forelse ($menus as $menu)
                    <article class="menu-card"><div class="menu-image"><img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($menu->foto) }}" alt="{{ $menu->nama_menu }}" loading="lazy"></div><div class="menu-details"><h3>{{ $menu->nama_menu }}</h3><p>{{ $menu->deskripsi }}</p><div class="menu-price">Rp{{ number_format((float) $menu->harga, 0, ',', '.') }}</div></div></article>
                @empty
                    <p class="menu-empty">Menu belum tersedia untuk ditampilkan.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="section origin-section" id="roastery" aria-labelledby="origin-title">
        <div class="wrap origin-grid">
            <div class="origin-photo"><img src="https://images.unsplash.com/photo-1511537190424-bbbab87ac5eb?auto=format&amp;fit=crop&amp;w=1100&amp;q=85" alt="Biji kopi dan perlengkapan seduh di meja kerja" loading="lazy"></div>
            <div class="origin-copy"><p class="eyebrow">Kopi &amp; proses</p><h2 id="origin-title">Setiap cangkir dimulai dari biji kopi.</h2><p>Kami memilih menu berdasarkan bahan dan proses penyeduhan yang tersedia. Informasi asal biji dan profil sangrai akan ditampilkan saat data tersebut tersedia.</p><div class="origin-details"><div><strong>Menu aktual</strong><span>Diambil dari katalog Chōgō</span></div><div><strong>Ketersediaan</strong><span>Mengikuti status menu tersimpan</span></div></div></div>
        </div>
    </section>

    <section class="section visit-section" id="visit" aria-labelledby="visit-title">
        <div class="wrap visit-grid">
            <div class="visit-copy"><p class="eyebrow">Tentang Chōgō</p><h2 id="visit-title">Temukan menu Chōgō Coffee.</h2><p>Informasi alamat dan jam operasional belum tersedia. Hubungi tim Chōgō untuk detail kunjungan.</p><div class="visit-info"><div><span>Lokasi</span><strong>Informasi belum tersedia</strong></div><div><span>Jam buka</span><strong>Informasi belum tersedia</strong></div></div><p class="visit-note">Punya akun pelanggan? <a href="{{ route('customer.register') }}">Daftar sebagai pelanggan</a>.</p></div>
            <div class="visit-photo"><img src="https://images.unsplash.com/photo-1445116572660-236099ec97a0?auto=format&amp;fit=crop&amp;w=1200&amp;q=85" alt="Interior kedai kopi dengan meja dan kursi" loading="lazy"></div>
        </div>
    </section>

    <section class="closing" aria-labelledby="closing-title"><div class="wrap closing-inner"><div><h2 id="closing-title">Lihat pilihan kopi yang tersedia.</h2><p>Menu Chōgō Coffee ditampilkan langsung dari katalog.</p></div><a class="button" href="#menu">Lihat menu <span aria-hidden="true">↑</span></a></div></section>
</main>
<footer class="footer"><div class="wrap footer-inner"><a class="footer-brand" href="{{ route('home') }}">Chōgō Coffee</a><span>Artisan kōhī &amp; roastery</span><span>© {{ now()->year }} Chōgō Coffee</span></div></footer>
<script>
    const menuButton = document.querySelector('.menu-toggle');
    const primaryNav = document.querySelector('#primary-nav');
    menuButton.addEventListener('click', () => {
        const isExpanded = menuButton.getAttribute('aria-expanded') === 'true';
        menuButton.setAttribute('aria-expanded', String(!isExpanded));
        menuButton.setAttribute('aria-label', isExpanded ? 'Buka navigasi' : 'Tutup navigasi');
        primaryNav.classList.toggle('is-open', !isExpanded);
    });
    primaryNav.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => {
        menuButton.setAttribute('aria-expanded', 'false');
        menuButton.setAttribute('aria-label', 'Buka navigasi');
        primaryNav.classList.remove('is-open');
    }));
</script>
</body>
</html>
