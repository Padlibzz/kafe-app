<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') · Chōgō Admin</title>
    <style>
        * { box-sizing: border-box; }
        :root { color-scheme: light; --ink:#34271f; --muted:#83766b; --line:#e9dfd3; --paper:#fffdf9; --canvas:#f5f1eb; --coffee:#65452f; }
        body { margin:0; color:var(--ink); background:var(--canvas); font:15px/1.5 system-ui,sans-serif; }
        a { color:inherit; text-decoration:none; }
        :focus-visible { outline:3px solid #98663e; outline-offset:3px; }
        .skip-link { position:absolute; top:8px; left:8px; z-index:10; padding:10px 14px; color:#fff; background:var(--coffee); border-radius:8px; transform:translateY(-150%); }
        .skip-link:focus { transform:translateY(0); }
        .shell { min-height:100vh; }
        aside { position:fixed; inset:0 auto 0 0; z-index:5; width:252px; padding:27px 18px; background:#fffdf9; border-right:1px solid var(--line); display:flex; flex-direction:column; overflow-y:auto; }
        .brand { display:flex; align-items:center; gap:12px; padding:0 10px 28px; font:700 22px Georgia,serif; }
        .brand-mark { display:grid; place-items:center; width:38px; height:38px; border-radius:12px; color:#fff; background:var(--coffee); font:700 17px Georgia,serif; }
        .nav-label { margin:13px 10px 8px; color:#a09489; font-size:10px; font-weight:700; letter-spacing:.13em; text-transform:uppercase; }
        .nav-link { display:flex; align-items:center; gap:12px; min-height:44px; margin:2px 0; padding:0 12px; border-radius:9px; color:#695c51; }
        .nav-link:hover { background:#f5f0e9; transform:translateX(2px); }
        .nav-link:focus-visible { background:#f5f0e9; }
        .nav-link.active { color:#563a28; background:#f2e9df; font-weight:650; }
        .nav-icon { width:21px; text-align:center; font-size:17px; }
        .nav-link.disabled { color:#b6aaa0; cursor:default; }
        .soon { margin-left:auto; font-size:10px; }
        .aside-bottom { margin-top:auto; border-top:1px solid var(--line); padding:14px 10px 0; color:var(--muted); font-size:12px; }
        .work { margin-left:252px; min-height:100vh; }
        .topbar { height:72px; display:flex; align-items:center; justify-content:space-between; padding:0 36px; background:var(--paper); border-bottom:1px solid var(--line); }
        .crumb { color:var(--muted); font-size:13px; }
        .logout button { border:1px solid var(--line); border-radius:8px; background:transparent; color:var(--ink); padding:8px 13px; font:inherit; cursor:pointer; }
        .content { max-width:1280px; padding:36px; margin:auto; }
        .page-head { display:flex; align-items:end; justify-content:space-between; gap:16px; margin-bottom:25px; }
        h1 { margin:0; font:700 32px/1.15 Georgia,serif; }
        .page-subtitle { margin:7px 0 0; color:var(--muted); }
        .panel { overflow-x:auto; background:var(--paper); border:1px solid var(--line); border-radius:13px; }
        table { width:100%; border-collapse:collapse; text-align:left; }
        th,td { padding:14px 16px; border-bottom:1px solid #eee7df; white-space:nowrap; }
        th { color:var(--muted); font-size:11px; text-transform:uppercase; letter-spacing:.07em; }
        tr:last-child td { border-bottom:0; }
        .empty { padding:30px 16px; color:var(--muted); text-align:center; }
        .pagination { margin-top:18px; }
        .menu-toggle { display:none; border:0; background:transparent; font-size:22px; color:var(--ink); }
        @media(max-width:760px) {
            aside { transform:translateX(-100%); transition:transform .2s ease; }
            body.nav-open aside { transform:translateX(0); }
            body.nav-open::after { content:""; position:fixed; inset:0; z-index:4; background:#21180f66; }
            .work { margin-left:0; }
            .topbar { height:62px; padding:0 18px; }
            .menu-toggle { display:block; min-width:44px; min-height:44px; }
            .content { padding:27px 17px; }
            .page-head { align-items:flex-start; }
            h1 { font-size:28px; }
        }
        @media(prefers-reduced-motion:reduce) { *,*::before,*::after { transition:none!important; } }
    </style>
</head>
<body>
<a class="skip-link" href="#main-content">Lewati ke konten</a>
<div class="shell">
    <aside aria-label="Navigasi admin">
        <a class="brand" href="{{ route('admin.orders') }}"><span class="brand-mark">C</span><span>Chōgō</span></a>
        <div class="nav-label">Operasional</div>
        <a class="nav-link {{ request()->routeIs('admin.orders') ? 'active' : '' }}" href="{{ route('admin.orders') }}"><span class="nav-icon" aria-hidden="true">▤</span>Pesanan</a>
        <a class="nav-link {{ request()->routeIs('admin.kds') ? 'active' : '' }}" href="{{ route('admin.kds') }}"><span class="nav-icon" aria-hidden="true">◷</span>KDS</a>
        <a class="nav-link {{ request()->routeIs('admin.attendance') ? 'active' : '' }}" href="{{ route('admin.attendance') }}"><span class="nav-icon" aria-hidden="true">◷</span>Absensi</a>
        <div class="nav-label">Katalog &amp; pelanggan</div>
        <a class="nav-link {{ request()->routeIs('admin.menus') ? 'active' : '' }}" href="{{ route('admin.menus') }}"><span class="nav-icon" aria-hidden="true">◫</span>Menu</a>
        <a class="nav-link {{ request()->routeIs('admin.tables') ? 'active' : '' }}" href="{{ route('admin.tables') }}"><span class="nav-icon" aria-hidden="true">⌑</span>Meja &amp; QR</a>
        <a class="nav-link {{ request()->routeIs('admin.customers') ? 'active' : '' }}" href="{{ route('admin.customers') }}"><span class="nav-icon" aria-hidden="true">♙</span>Pelanggan</a>
        <a class="nav-link {{ request()->routeIs('admin.loyalty') ? 'active' : '' }}" href="{{ route('admin.loyalty') }}"><span class="nav-icon" aria-hidden="true">★</span>Loyalty</a>
        <div class="nav-label">Analitik</div>
        <a class="nav-link {{ request()->routeIs('admin.finance-reports') ? 'active' : '' }}" href="{{ route('admin.finance-reports') }}"><span class="nav-icon" aria-hidden="true">▥</span>Laporan</a>
        <div class="aside-bottom">Panel pengelolaan kedai</div>
    </aside>
    <div class="work">
        <header class="topbar">
            <div style="display:flex;align-items:center;gap:14px"><button class="menu-toggle" type="button" aria-label="Buka navigasi" aria-expanded="false"><span aria-hidden="true">☰</span></button><span class="crumb">Admin <span aria-hidden="true">/</span> @yield('title')</span></div>
            <form class="logout" method="POST" action="{{ route('admin.logout') }}">@csrf<button type="submit">Keluar</button></form>
        </header>
        <main class="content" id="main-content">@yield('content')</main>
    </div>
</div>
<script>
    const navigationToggle = document.querySelector('.menu-toggle');
    const navigation = document.querySelector('aside');
    navigationToggle?.addEventListener('click', () => {
        const isOpen = document.body.classList.toggle('nav-open');
        navigationToggle.setAttribute('aria-expanded', String(isOpen));
        navigationToggle.setAttribute('aria-label', isOpen ? 'Tutup navigasi' : 'Buka navigasi');
    });
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && document.body.classList.contains('nav-open')) {
            document.body.classList.remove('nav-open');
            navigationToggle?.setAttribute('aria-expanded', 'false');
            navigationToggle?.setAttribute('aria-label', 'Buka navigasi');
        }
    });
    document.addEventListener('click', (event) => {
        if (window.matchMedia('(max-width: 760px)').matches && document.body.classList.contains('nav-open') && !navigation?.contains(event.target) && !navigationToggle?.contains(event.target)) {
            document.body.classList.remove('nav-open');
            navigationToggle?.setAttribute('aria-expanded', 'false');
            navigationToggle?.setAttribute('aria-label', 'Buka navigasi');
        }
    });
</script>
</body>
</html>
