<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f5f1eb">
    <title>Buat Akun Pelanggan · Chōgō Coffee</title>
    <style>
        * { box-sizing:border-box; }
        :root { color-scheme:light; --ink:#34271f; --muted:#83766b; --line:#e9dfd3; --paper:#fffdf9; --coffee:#65452f; --cream:#f5f1eb; }
        body { min-height:100vh; margin:0; padding:26px; display:grid; place-items:center; color:var(--ink); background:var(--cream); font:14px/1.5 system-ui,sans-serif; }
        .register-shell { width:min(100%,1020px); min-height:650px; display:grid; grid-template-columns:1fr 1fr; overflow:hidden; background:var(--paper); border:1px solid var(--line); border-radius:18px; box-shadow:0 22px 65px #3f2a1712; }
        .register-story { display:flex; flex-direction:column; justify-content:space-between; padding:34px; color:#fff8ef; background:linear-gradient(155deg,#513925,#30251d 74%); }
        .register-brand { display:flex; align-items:center; gap:11px; font:700 20px Georgia,serif; }
        .register-mark { display:grid; place-items:center; width:38px; height:38px; color:var(--coffee); background:#f4e8d8; border-radius:11px; }
        .register-copy { max-width:410px; padding:35px 0; }
        .register-kicker { margin:0 0 12px; color:#d8bd9d; font-size:10px; font-weight:750; letter-spacing:.14em; text-transform:uppercase; }
        .register-copy h1 { margin:0; font:700 clamp(34px,4vw,48px)/1.05 Georgia,serif; letter-spacing:-.03em; }
        .register-copy > p:last-child { margin:15px 0 0; color:#e0d4c8; font-size:13px; line-height:1.7; }
        .register-perks { display:grid; gap:10px; margin-top:25px; padding:0; list-style:none; }
        .register-perks li { display:flex; align-items:center; gap:10px; color:#e0d4c8; font-size:11px; }
        .register-check { display:grid; place-items:center; width:20px; height:20px; color:#f2dfc5; border:1px solid #92795f; border-radius:50%; font-size:10px; }
        .register-story-foot { color:#d8c7b5; font-size:10px; }
        .register-main { display:flex; flex-direction:column; justify-content:center; padding:38px clamp(27px,5vw,58px); }
        .register-mobile-brand { display:none; }
        .register-heading { margin-bottom:22px; }
        .register-heading h2 { margin:0; font:700 27px/1.2 Georgia,serif; }
        .register-heading p { margin:7px 0 0; color:var(--muted); font-size:12px; }
        .register-form { display:grid; gap:13px; }
        .register-field { display:grid; gap:6px; }
        .register-field label { font-size:11px; font-weight:700; }
        .register-field input { width:100%; min-height:44px; padding:0 12px; color:var(--ink); background:#fff; border:1px solid #dfd4c7; border-radius:8px; font:inherit; font-size:12px; }
        .register-field input::placeholder { color:#aa9d91; }
        .register-field input:focus { border-color:var(--coffee); outline:3px solid #98663e22; }
        .register-field input[aria-invalid="true"] { border-color:#b64b40; }
        .register-error { color:#9b3329; font-size:10px; }
        .register-global-error { padding:10px 12px; color:#8c3028; background:#fff0ed; border:1px solid #f0d0cb; border-radius:8px; font-size:11px; }
        .register-success { color:#526b48; background:#edf3e9; border-color:#d9e5d1; }
        .register-consent { display:flex; align-items:flex-start; gap:8px; margin:1px 0 0; color:var(--muted); font-size:10px; line-height:1.45; }
        .register-consent input { margin:2px 0 0; accent-color:var(--coffee); }
        .register-button { min-height:46px; margin-top:2px; color:#fff; background:var(--coffee); border:0; border-radius:8px; font:700 12px system-ui,sans-serif; cursor:pointer; }
        .register-button:hover { background:#503622; }
        .register-divider { display:flex; align-items:center; gap:12px; margin:20px 0 13px; color:#a09489; font-size:9px; }
        .register-divider::before,.register-divider::after { height:1px; flex:1; background:var(--line); content:""; }
        .register-login { margin:0; color:var(--muted); font-size:11px; text-align:center; }
        .register-login a { color:var(--coffee); font-weight:700; text-decoration:underline; text-underline-offset:3px; }
        .register-note { margin-top:19px; color:#a09489; font-size:9px; line-height:1.55; text-align:center; }
        :focus-visible { outline-color:#98663e; }
        @media(max-width:720px) { body { padding:13px; } .register-shell { max-width:480px; min-height:0; grid-template-columns:1fr; border-radius:14px; } .register-story { display:none; } .register-main { padding:26px 24px 23px; } .register-mobile-brand { display:flex; align-items:center; gap:9px; margin-bottom:25px; font:700 18px Georgia,serif; } .register-mobile-brand .register-mark { width:34px; height:34px; } .register-heading { margin-bottom:19px; } .register-heading h2 { font-size:25px; } .register-note { margin-top:15px; } }
        @media(max-width:380px) { body { padding:9px; } .register-main { padding:21px 17px; } }
        @media(prefers-reduced-motion:reduce) { *,*::before,*::after { transition:none!important; scroll-behavior:auto!important; } }
    </style>
</head>
<body>
<main class="register-shell">
    <section class="register-story" aria-label="Keanggotaan Chōgō Coffee">
        <a class="register-brand" href="{{ route('admin.login') }}"><span class="register-mark" aria-hidden="true">C</span><span>Chōgō Coffee</span></a>
        <div class="register-copy"><p class="register-kicker">Member Chōgō</p><h1>Jadi bagian dari cerita kopi kami.</h1><p>Buat akun pelanggan untuk menyimpan profil dan melihat saldo poin yang tercatat pada akun Anda.</p><ul class="register-perks"><li><span class="register-check" aria-hidden="true">✓</span>Profil pelanggan tersimpan</li><li><span class="register-check" aria-hidden="true">✓</span>Saldo poin terhubung ke akun</li></ul></div>
        <div class="register-story-foot">Akun khusus pelanggan · gratis untuk dibuat</div>
    </section>
    <section class="register-main" aria-labelledby="register-title">
        <a class="register-mobile-brand" href="{{ route('admin.login') }}"><span class="register-mark" aria-hidden="true">C</span><span>Chōgō Coffee</span></a>
        <header class="register-heading"><h2 id="register-title">Buat akun pelanggan</h2><p>Isi data berikut untuk mendaftar.</p></header>
        @if (session('registration_success'))<div class="register-global-error register-success" role="status">Akun pelanggan berhasil dibuat. Silakan masuk menggunakan email dan kata sandi.</div>@endif
        @if ($errors->any() && ! $errors->has('nama') && ! $errors->has('email') && ! $errors->has('password') && ! $errors->has('terms'))<div class="register-global-error" role="alert">{{ $errors->first() }}</div>@endif
        @error('terms')<div class="register-global-error" role="alert">{{ $message }}</div>@enderror
        <form class="register-form" method="POST" action="{{ route('customer.register.submit') }}">
            @csrf
            <div class="register-field"><label for="nama">Nama lengkap</label><input id="nama" name="nama" type="text" value="{{ old('nama') }}" autocomplete="name" maxlength="255" placeholder="Nama Anda" required @error('nama') aria-invalid="true" aria-describedby="nama-error" @enderror>@error('nama')<span class="register-error" id="nama-error" role="alert">{{ $message }}</span>@enderror</div>
            <div class="register-field"><label for="email">Email</label><input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" maxlength="255" placeholder="nama@email.com" required @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>@error('email')<span class="register-error" id="email-error" role="alert">{{ $message }}</span>@enderror</div>
            <div class="register-field"><label for="password">Kata sandi</label><input id="password" name="password" type="password" autocomplete="new-password" minlength="8" placeholder="Minimal 8 karakter" required @error('password') aria-invalid="true" aria-describedby="password-error" @enderror>@error('password')<span class="register-error" id="password-error" role="alert">{{ $message }}</span>@enderror</div>
            <div class="register-field"><label for="password_confirmation">Konfirmasi kata sandi</label><input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" minlength="8" placeholder="Ulangi kata sandi" required></div>
            <label class="register-consent"><input type="checkbox" name="terms" value="1" required @checked(old('terms'))><span>Saya setuju data ini digunakan untuk membuat akun pelanggan Chōgō Coffee.</span></label>
            <button class="register-button" type="submit">Buat akun pelanggan</button>
        </form>
        <div class="register-divider">SUDAH PUNYA AKUN?</div>
        <p class="register-login"><a href="{{ route('admin.login') }}">Kembali ke halaman masuk</a></p>
        <p class="register-note">Halaman ini hanya membuat akun pelanggan. Akun admin dan karyawan memerlukan undangan yang sah.</p>
    </section>
</main>
</body>
</html>
