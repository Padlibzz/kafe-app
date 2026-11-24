@extends('admin.layout')

@section('title', $menu->exists ? 'Edit Menu' : 'Buat Menu')

@section('content')
    <style>
        main.content:has(.menu-editor) { max-width:none; padding:28px 34px; }
        .menu-editor { max-width:1440px; margin-inline:auto; }
        .menu-crumb { margin-bottom:15px; color:var(--muted); font-size:12px; }
        .menu-page-head { display:flex; align-items:flex-end; justify-content:space-between; gap:20px; margin-bottom:22px; }
        .menu-page-head h1 { font-size:30px; }
        .menu-page-head p { margin:7px 0 0; color:var(--muted); font-size:13px; }
        .menu-head-actions { display:flex; gap:9px; }
        .menu-head-actions a,.menu-head-actions button { min-height:42px; padding:0 15px; border:1px solid var(--line); border-radius:8px; font:650 12px system-ui,sans-serif; cursor:pointer; }
        .menu-head-actions a { display:inline-flex; align-items:center; background:var(--paper); }
        .menu-head-actions button { color:white; background:var(--coffee); border-color:var(--coffee); }
        .menu-columns { display:grid; grid-template-columns:minmax(0,1fr) 320px; align-items:start; gap:20px; }
        .menu-form { display:grid; gap:15px; }
        .menu-section,.menu-preview-card { overflow:hidden; background:var(--paper); border:1px solid var(--line); border-radius:12px; }
        .menu-form-intro { display:flex; align-items:center; gap:12px; padding:17px 20px; border-bottom:1px solid var(--line); }
        .menu-step { display:grid; place-items:center; width:32px; height:32px; flex:none; color:var(--coffee); background:#f2e9df; border-radius:50%; font-size:12px; font-weight:750; }
        .menu-form-intro h2 { margin:0; font:700 16px/1.3 Georgia,serif; }
        .menu-form-intro p { margin:3px 0 0; color:var(--muted); font-size:12px; }
        .menu-fields { display:grid; grid-template-columns:1fr 1fr; align-content:start; gap:17px; padding:20px; }
        .menu-field { display:grid; align-content:start; gap:7px; }
        .menu-field-wide { grid-column:1/-1; }
        .menu-field label,.menu-field-label { font-size:13px; font-weight:650; }
        .menu-field input:not([type=checkbox]),.menu-field textarea { width:100%; min-height:46px; padding:11px 13px; color:var(--ink); background:#fff; border:1px solid #dcd0c4; border-radius:8px; font:inherit; }
        .menu-field textarea { min-height:112px; resize:vertical; }
        .menu-field input:focus,.menu-field textarea:focus { border-color:var(--coffee); outline:3px solid #98663e33; }
        .menu-field [aria-invalid=true] { border-color:#a33d31!important; }
        .menu-help { color:var(--muted); font-size:12px; }
        .menu-photo-field { align-content:start; }
        .menu-photo-picker { display:grid; align-content:start; gap:12px; padding:14px; border:1px dashed #c9b9a9; border-radius:10px; background:#fffdfa; }
        .menu-photo-preview { width:100%; max-height:260px; aspect-ratio:4/3; object-fit:cover; border-radius:8px; background:#f1ebe3; }
        .menu-photo-preview[hidden] { display:none; }
        .menu-photo-picker input[type=file] { width:100%; padding:10px; border:1px solid var(--line); border-radius:8px; background:#fff; font:inherit; font-size:12px; }
        .menu-error { color:#9b3026; font-size:12px; }
        .menu-status-control { display:flex; align-items:flex-start; gap:11px; padding:13px; background:#f7f3ed; border-radius:9px; }
        .menu-availability input { width:18px; height:18px; margin:1px 0 0; accent-color:var(--coffee); }
        .menu-availability label { display:grid; gap:2px; font-size:13px; }
        .menu-availability small { color:var(--muted); font-size:12px; font-weight:400; }
        .menu-preview { position:sticky; top:18px; display:grid; gap:14px; }
        .menu-preview-card { padding:17px; }
        .menu-preview-title { margin:0 0 12px; font-size:13px; }
        .menu-preview-image { width:100%; aspect-ratio:4/3; object-fit:cover; border-radius:9px; background:#f1ebe3; }
        .menu-preview-image[hidden] { display:none; }
        .menu-preview-placeholder { display:grid; place-items:center; width:100%; aspect-ratio:4/3; color:var(--muted); background:#f2eee8; border-radius:9px; font-size:12px; }
        .menu-preview-placeholder[hidden] { display:none; }
        .menu-preview-info { display:grid; gap:5px; padding-top:12px; }
        .menu-preview-info strong { font:700 17px/1.3 Georgia,serif; }
        .menu-preview-description { color:var(--muted); font-size:12px; }
        .menu-preview-price { color:var(--coffee); font-weight:700; }
        .menu-availability { padding:12px 14px; }
        .menu-form-submit { display:flex; justify-content:flex-end; gap:9px; padding-top:4px; }
        .menu-form-submit a,.menu-form-submit button { display:inline-flex; align-items:center; justify-content:center; min-height:44px; padding:0 16px; border:1px solid var(--line); border-radius:8px; font:650 13px system-ui,sans-serif; cursor:pointer; }
        .menu-form-submit a { background:var(--paper); }
        .menu-form-submit button { color:white; background:var(--coffee); border-color:var(--coffee); }
        .menu-form-submit button:hover,.menu-head-actions button:hover { background:#503622; }
        @media(max-width:1050px) { .menu-columns { grid-template-columns:minmax(0,1fr) 280px; gap:14px; } main.content:has(.menu-editor) { padding:24px; } }
        @media(max-width:800px) { .menu-columns { grid-template-columns:1fr; } .menu-preview { position:static; grid-row:1; } .menu-preview-card { display:grid; grid-template-columns:minmax(120px,.8fr) 1fr; align-items:center; gap:14px; } .menu-preview-title { grid-column:1/-1; margin:0; } .menu-preview-image,.menu-preview-placeholder { grid-row:2; } .menu-preview-info { padding:0; } }
        @media(max-width:560px) { main.content:has(.menu-editor) { padding:20px 14px; } .menu-page-head { align-items:flex-start; flex-direction:column; } .menu-page-head h1 { font-size:26px; } .menu-head-actions { width:100%; } .menu-head-actions a,.menu-head-actions button { flex:1; } .menu-fields { grid-template-columns:1fr; padding:17px; } .menu-field-wide { grid-column:auto; } .menu-form-intro { padding:15px 17px; } .menu-form-submit a,.menu-form-submit button { flex:1; } }
    </style>
    <div class="menu-editor">
        <div class="menu-crumb"><a href="{{ route('admin.menus') }}">Kelola Menu &amp; Harga</a> / {{ $menu->exists ? 'Edit Menu' : 'Tambah Menu' }}</div>
        <div class="menu-page-head"><div><h1>{{ $menu->exists ? 'Edit Menu Racikan' : 'Tambah Menu Racikan Baru' }}</h1><p>Atur informasi sajian dan lihat pratinjau kartu sebelum disimpan.</p></div><div class="menu-head-actions"><a href="{{ route('admin.menus') }}">Batal</a><button type="submit" form="menu-form">{{ $menu->exists ? 'Simpan Perubahan' : 'Simpan Menu' }}</button></div></div>
        <form id="menu-form" class="menu-form" method="POST" enctype="multipart/form-data" action="{{ $menu->exists ? route('admin.menus.update', $menu) : route('admin.menus.store') }}">
            @csrf
            @if ($menu->exists) @method('PUT') @endif
            <div class="menu-columns">
              <div class="menu-form-main">
                <section class="menu-section" aria-labelledby="menu-info-heading">
                  <div class="menu-form-intro"><span class="menu-step">01</span><div><h2 id="menu-info-heading">Informasi Dasar Produk</h2><p>Nama, cerita sajian, dan harga menu.</p></div></div>
                  <div class="menu-fields">
                    <div class="menu-field menu-field-wide">
                    <label for="nama_menu">Nama menu <span aria-hidden="true">*</span></label>
                    <input id="nama_menu" name="nama_menu" autocomplete="off" value="{{ old('nama_menu', $menu->nama_menu) }}" required maxlength="255" @error('nama_menu') aria-invalid="true" aria-describedby="nama-menu-error" @enderror>
                    @error('nama_menu')<span class="menu-error" id="nama-menu-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                    <div class="menu-field menu-field-wide">
                    <label for="deskripsi">Deskripsi <span aria-hidden="true">*</span></label>
                    <textarea id="deskripsi" name="deskripsi" autocomplete="off" required @error('deskripsi') aria-invalid="true" aria-describedby="deskripsi-error" @enderror>{{ old('deskripsi', $menu->deskripsi) }}</textarea>
                    @error('deskripsi')<span class="menu-error" id="deskripsi-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                    <div class="menu-field menu-field-wide">
                    <label for="harga">Harga (Rp) <span aria-hidden="true">*</span></label>
                    <div style="position:relative"><span aria-hidden="true" style="position:absolute;top:12px;left:13px;color:var(--muted);font-size:13px">Rp</span><input id="harga" style="padding-left:40px" type="number" name="harga" min="0" step=".01" inputmode="decimal" autocomplete="off" value="{{ old('harga', $menu->harga) }}" required @error('harga') aria-invalid="true" aria-describedby="harga-error" @enderror></div>
                    @error('harga')<span class="menu-error" id="harga-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                    <div class="menu-field menu-field-wide">
                    <span class="menu-field-label">Ketersediaan</span>
                    <div class="menu-status-control">
                        <input type="hidden" name="ketersediaan" value="0">
                        <input id="ketersediaan" type="checkbox" name="ketersediaan" value="1" @checked(old('ketersediaan', $menu->exists ? $menu->ketersediaan : true))>
                        <label for="ketersediaan"><strong>Tersedia untuk dipesan</strong><small>Matikan jika menu sedang tidak tersedia.</small></label>
                    </div>
                    </div>
                  </div>
                </section>
                <section class="menu-section" aria-labelledby="menu-photo-heading">
                  <div class="menu-form-intro"><span class="menu-step">02</span><div><h2 id="menu-photo-heading">Media &amp; Visual Sajian</h2><p>Gunakan foto sajian yang jelas untuk kartu menu.</p></div></div>
                  <div class="menu-fields">
                    <div class="menu-field menu-photo-field menu-field-wide">
                    <label for="foto">Foto menu {{ $menu->exists ? '(opsional)' : '' }} @unless ($menu->exists)<span aria-hidden="true">*</span>@endunless</label>
                    <div class="menu-photo-picker">
                        @if ($menu->exists && $menu->foto)<img class="menu-photo-preview" src="{{ asset('storage/'.$menu->foto) }}" alt="Foto menu saat ini">@endif
                        <img class="menu-photo-preview" id="foto-preview" alt="Pratinjau foto yang dipilih" hidden>
                        <input id="foto" type="file" name="foto" accept="image/jpeg,image/png,image/webp" @required(! $menu->exists) @error('foto') aria-invalid="true" aria-describedby="foto-help foto-error" @else aria-describedby="foto-help" @enderror>
                        <span class="menu-help" id="foto-help">JPG, PNG, atau WebP. Maksimal 5 MB. {{ $menu->exists ? 'Kosongkan jika tidak ingin mengganti foto.' : '' }}</span>
                    </div>
                    @error('foto')<span class="menu-error" id="foto-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                  </div>
                </section>
                <div class="menu-form-submit"><a href="{{ route('admin.menus') }}">Batal &amp; Kembali</a><button type="submit">{{ $menu->exists ? 'Simpan Perubahan' : 'Simpan Menu' }}</button></div>
              </div>
              <aside class="menu-preview" aria-label="Pratinjau menu">
                <section class="menu-preview-card">
                    <h2 class="menu-preview-title">Live Preview Kartu Menu</h2>
                    @if ($menu->exists && $menu->foto)<img class="menu-preview-image" id="menu-preview-image" src="{{ asset('storage/'.$menu->foto) }}" alt="Pratinjau {{ $menu->nama_menu }}">@else<img class="menu-preview-image" id="menu-preview-image" alt="Pratinjau foto menu" hidden>@endif
                    <div class="menu-preview-placeholder" id="menu-preview-placeholder" @if ($menu->exists && $menu->foto) hidden @endif>Pratinjau foto akan tampil di sini</div>
                    <div class="menu-preview-info"><strong id="menu-preview-name">{{ old('nama_menu', $menu->nama_menu ?: 'Nama menu') }}</strong><span class="menu-preview-description" id="menu-preview-description">{{ old('deskripsi', $menu->deskripsi ?: 'Deskripsi sajian akan tampil di sini.') }}</span><span class="menu-preview-price" id="menu-preview-price">{{ old('harga', $menu->harga) ? 'Rp'.number_format((float) old('harga', $menu->harga), 0, ',', '.') : 'Harga menu' }}</span></div>
                </section>
                <section class="menu-preview-card"><h2 class="menu-preview-title">Visibilitas Menu</h2><span class="menu-availability" id="menu-preview-availability">● {{ old('ketersediaan', $menu->exists ? $menu->ketersediaan : true) ? 'Tersedia untuk dipesan' : 'Tidak tersedia' }}</span></section>
              </aside>
              </div>
        </form>
    </div>
    <script>
        const photoInput = document.querySelector('#foto');
        let previewUrl;
        photoInput?.addEventListener('change', (event) => {
            const preview = document.querySelector('#foto-preview');
            const cardPreview = document.querySelector('#menu-preview-image');
            const placeholder = document.querySelector('#menu-preview-placeholder');
            const file = event.target.files[0];
            if (file) {
                if (previewUrl) URL.revokeObjectURL(previewUrl);
                previewUrl = URL.createObjectURL(file);
                preview.src = previewUrl;
                cardPreview.src = previewUrl;
                preview.hidden = false;
                cardPreview.hidden = false;
                placeholder.hidden = true;
            } else {
                preview.removeAttribute('src');
                preview.hidden = true;
            }
        });
        document.querySelector('#nama_menu')?.addEventListener('input', (event) => {
            document.querySelector('#menu-preview-name').textContent = event.target.value || 'Nama menu';
        });
        document.querySelector('#deskripsi')?.addEventListener('input', (event) => {
            document.querySelector('#menu-preview-description').textContent = event.target.value || 'Deskripsi sajian akan tampil di sini.';
        });
        document.querySelector('#harga')?.addEventListener('input', (event) => {
            const amount = Number(event.target.value);
            document.querySelector('#menu-preview-price').textContent = amount ? new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(amount) : 'Harga menu';
        });
        document.querySelector('#ketersediaan')?.addEventListener('change', (event) => {
            document.querySelector('#menu-preview-availability').textContent = event.target.checked ? '● Tersedia untuk dipesan' : '● Tidak tersedia';
        });
    </script>
@endsection
