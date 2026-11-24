<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk Admin · Chōgō</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; display: grid; place-items: center; padding: 24px; color: #33271f; background: #f4eee6; font: 16px/1.5 system-ui, sans-serif; }
        main { width: min(100%, 420px); padding: 38px; background: #fffdf9; border: 1px solid #e8dccd; border-radius: 18px; box-shadow: 0 18px 50px #59432a18; }
        .icon { font-size: 36px; }
        h1 { margin: 8px 0 4px; font: 700 30px/1.2 Georgia, serif; }
        p { margin: 0 0 24px; color: #75675b; }
        label { display: block; margin: 16px 0 6px; font-weight: 600; }
        input { width: 100%; padding: 12px; border: 1px solid #d9cabb; border-radius: 8px; font: inherit; }
        input:focus { outline: 2px solid #98663e; outline-offset: 2px; }
        button { width: 100%; margin-top: 22px; padding: 13px; border: 0; border-radius: 8px; color: white; background: #65452f; font: inherit; font-weight: 700; cursor: pointer; }
        .errors { padding: 12px 14px; color: #8c3028; background: #fff0ed; border-radius: 8px; }
    </style>
</head>
<body>
<main>
    <div class="icon" aria-hidden="true">☕</div>
    <h1>Selamat datang</h1>
    <p>Masuk untuk mengelola pesanan kedai.</p>
    @if ($errors->any())
        <div class="errors" role="alert" aria-live="assertive">{{ $errors->first() }}</div>
    @endif
    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf
        <label for="username">Username</label>
        <input id="username" name="username" type="text" value="{{ old('username') }}" autocomplete="username" required>
        <label for="password">Password</label>
        <input id="password" name="password" type="password" autocomplete="current-password" required>
        <button type="submit">Masuk</button>
    </form>
</main>
</body>
</html>
