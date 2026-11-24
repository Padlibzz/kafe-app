<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f5f1eb">
    <title>Masuk · Chōgō Coffee</title>
    <style>
        * { box-sizing:border-box; }
        :root { color-scheme:light; --ink:#34271f; --muted:#83766b; --line:#e9dfd3; --paper:#fffdf9; --coffee:#65452f; --cream:#f5f1eb; }
        body { min-height:100vh; margin:0; padding:28px; display:grid; place-items:center; color:var(--ink); background:var(--cream); font:14px/1.5 system-ui,sans-serif; }
        .auth-shell { width:min(100%,980px); min-height:610px; display:grid; grid-template-columns:1fr 1fr; overflow:hidden; background:var(--paper); border:1px solid var(--line); border-radius:18px; box-shadow:0 22px 65px #3f2a1712; }
        .auth-story { position:relative; display:flex; flex-direction:column; justify-content:space-between; min-height:610px; padding:34px; color:#fff8ef; background:linear-gradient(155deg,#513925,#30251d 74%); overflow:hidden; }
        .auth-story::after { position:absolute; right:-110px; bottom:80px; width:360px; height:360px; border:1px solid #ffffff16; border-radius:50%; content:""; box-shadow:0 0 0 35px #ffffff08,0 0 0 70px #ffffff05; pointer-events:none; }
        .auth-brand { position:relative; z-index:1; display:flex; align-items:center; gap:11px; font:700 20px Georgia,serif; }
        .auth-brand-mark { display:grid; place-items:center; width:38px; height:38px; color:var(--coffee); background:#f4e8d8; border-radius:11px; font-size:17px; }
        .auth-story-copy { position:relative; z-index:1; max-width:400px; padding:35px 0; }
        .auth-kicker { margin:0 0 12px; color:#d8bd9d; font-size:10px; font-weight:750; letter-spacing:.14em; text-transform:uppercase; }
        .auth-story h1 { margin:0; font:700 clamp(34px,4vw,50px)/1.05 Georgia,serif; letter-spacing:-.03em; }
        .auth-story-copy > p:last-child { max-width:340px; margin:15px 0 0; color:#e0d4c8; font-size:13px; line-height:1.7; }
        .auth-story-footer { position:relative; z-index:1; display:flex; align-items:center; gap:9px; color:#e0d4c8; font-size:10px; }
        .auth-story-dot { width:7px; height:7px; background:#b7c99c; border-radius:50%; }
        .auth-main { display:flex; flex-direction:column; justify-content:center; padding:48px clamp(28px,5vw,66px); }
        .auth-mobile-brand { display:none; }
        .auth-heading { margin-bottom:27px; }
        .auth-heading h2 { margin:0; font:700 27px/1.2 Georgia,serif; }
        .auth-heading p { margin:7px 0 0; color:var(--muted); font-size:12px; }
        .auth-select { width:100%; min-height:45px; padding:0 12px; color:var(--ink); background:#fff; border:1px solid #dfd4c7; border-radius:8px; font:inherit; font-size:12px; }
        .auth-select:focus { border-color:var(--coffee); outline:3px solid #98663e22; }
        .auth-form { display:grid; gap:15px; margin-top:21px; }
        .auth-field { display:grid; gap:6px; }
        .auth-field label { font-size:11px; font-weight:700; }
        .auth-field input { width:100%; min-height:45px; padding:0 12px; color:var(--ink); background:#fff; border:1px solid #dfd4c7; border-radius:8px; font:inherit; font-size:12px; }
        .auth-field input::placeholder { color:#aa9d91; }
        .auth-field input:focus { border-color:var(--coffee); outline:3px solid #98663e22; }
        .auth-inline { display:flex; justify-content:space-between; align-items:center; gap:10px; margin-top:-2px; }
        .auth-remember { display:flex; align-items:center; gap:7px; color:var(--muted); font-size:10px; }
        .auth-remember input { accent-color:var(--coffee); }
        .auth-link { color:var(--coffee); font-size:10px; font-weight:700; text-decoration:underline; text-underline-offset:3px; }
        .auth-submit { min-height:47px; margin-top:2px; color:white; background:var(--coffee); border:0; border-radius:8px; font:700 12px system-ui,sans-serif; cursor:pointer; }
        .auth-submit:hover { background:#503622; }
        .auth-error { padding:11px 12px; color:#8c3028; background:#fff0ed; border:1px solid #f0d0cb; border-radius:8px; font-size:11px; }
        .auth-divider { display:flex; align-items:center; gap:12px; margin:22px 0 13px; color:#a09489; font-size:9px; }
        .auth-divider::before,.auth-divider::after { height:1px; flex:1; background:var(--line); content:""; }
        .auth-register { margin:0; color:var(--muted); font-size:11px; text-align:center; }
        .auth-footnote { margin-top:24px; color:#a09489; font-size:9px; line-height:1.55; text-align:center; }
        a { color:inherit; }
        :focus-visible { outline-color:#98663e; }
        @media(max-width:700px) { body { padding:14px; } .auth-shell { min-height:0; grid-template-columns:1fr; max-width:470px; border-radius:14px; } .auth-story { display:none; } .auth-main { padding:29px 25px 25px; } .auth-mobile-brand { display:flex; align-items:center; gap:9px; margin-bottom:29px; font:700 18px Georgia,serif; } .auth-mobile-brand .auth-brand-mark { width:34px; height:34px; } .auth-heading { margin-bottom:22px; } .auth-footnote { margin-top:19px; } }
        @media(max-width:380px) { body { padding:10px; } .auth-main { padding:23px 18px; } .auth-heading h2 { font-size:24px; } }
        @media(prefers-reduced-motion:reduce) { *,*::before,*::after { transition:none!important; scroll-behavior:auto!important; } }
    </style>
</head>
<body>
<main class="auth-shell">
    <section class="auth-story" aria-label="Chōgō Coffee">
        <a class="auth-brand" href="{{ route('admin.login') }}"><span class="auth-brand-mark" aria-hidden="true">C</span><span>Chōgō Coffee</span></a>
        <div class="auth-story-copy"><p class="auth-kicker">Ruang kerja kedai</p><h1>Semua operasional, satu tempat.</h1><p>Masuk untuk mengelola layanan Chōgō Coffee sesuai akses akun Anda.</p></div>
        <div class="auth-story-footer"><span class="auth-story-dot" aria-hidden="true"></span>Akses aman untuk tim dan pelanggan</div>
    </section>
    <section class="auth-main" aria-labelledby="login-title">
        <a class="auth-mobile-brand" href="{{ route('admin.login') }}"><span class="auth-brand-mark" aria-hidden="true">C</span><span>Chōgō Coffee</span></a>
        <header class="auth-heading"><h2 id="login-title">Selamat datang kembali</h2><p>Masuk dengan akun yang terdaftar.</p></header>
        @if ($errors->any())<div class="auth-error" role="alert" aria-live="assertive">{{ $errors->first() }}</div>@endif
        @if (session('account_notice'))<div class="auth-error" role="status">{{ session('account_notice') }}</div>@endif
        <form class="auth-form" method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <div class="auth-field"><label for="account_type">Masuk sebagai</label><select class="auth-select" id="account_type" name="account_type" required><option value="admin" @selected(old('account_type', 'admin') === 'admin')>Admin</option><option value="employee" @selected(old('account_type') === 'employee')>Karyawan</option><option value="customer" @selected(old('account_type') === 'customer')>Pelanggan</option></select></div>
            <div class="auth-field"><label for="username" id="identity-label">Username</label><input id="username" name="username" type="text" value="{{ old('username') }}" autocomplete="username" placeholder="Masukkan username" required></div>
            <div class="auth-field"><label for="password">Kata sandi</label><input id="password" name="password" type="password" autocomplete="current-password" placeholder="Masukkan kata sandi" required></div>
            <div class="auth-inline"><label class="auth-remember"><input type="checkbox" name="remember" value="1"> Ingat saya</label><a class="auth-link" href="#account-help">Butuh bantuan?</a></div>
            <button class="auth-submit" type="submit">Masuk ke akun</button>
        </form>
        <div class="auth-divider">AKSES AKUN</div>
        <p class="auth-register">Pelanggan baru? <a class="auth-link" href="{{ route('customer.register') }}">Buat akun pelanggan</a></p>
        <p class="auth-footnote" id="account-help">Akun admin dan karyawan dibuat melalui undangan yang sah. Area akun pelanggan belum tersedia.</p>
    </section>
</main>
<script>
    const accountType = document.querySelector('#account_type');
    const identityLabel = document.querySelector('#identity-label');
    const identityInput = document.querySelector('#username');
    const updateIdentity = () => {
        const isCustomer = accountType.value === 'customer';
        identityLabel.textContent = isCustomer ? 'Email' : 'Username';
        identityInput.type = isCustomer ? 'email' : 'text';
        identityInput.autocomplete = isCustomer ? 'email' : 'username';
        identityInput.placeholder = isCustomer ? 'Masukkan email' : 'Masukkan username';
    };
    accountType.addEventListener('change', updateIdentity);
    updateIdentity();
</script>
</body>
</html>
