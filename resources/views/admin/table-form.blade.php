@extends('admin.layout')

@section('title', $table->exists ? 'Ubah meja' : 'Tambah meja')

@section('content')
    <style>
        main.content:has(.table-form-page) { max-width:none; padding:30px 34px; }
        .table-form-page { max-width:1120px; margin:auto; }
        .table-form-crumb { display:flex; flex-wrap:wrap; gap:8px; align-items:center; margin:0 0 20px; color:var(--muted); font-size:11px; }
        .table-form-crumb a { color:var(--coffee); font-weight:650; }
        .table-form-head { margin-bottom:22px; }
        .table-form-eyebrow { margin:0 0 7px; color:var(--muted); font-size:10px; font-weight:750; letter-spacing:.11em; text-transform:uppercase; }
        .table-form-head h1 { font:700 30px/1.15 Georgia,serif; }
        .table-form-head p:last-child { margin:7px 0 0; color:var(--muted); font-size:13px; }
        .table-form-layout { display:grid; grid-template-columns:minmax(0,1fr) 300px; gap:18px; align-items:start; }
        .table-form-panel,.table-form-aside { background:var(--paper); border:1px solid var(--line); border-radius:13px; }
        .table-form-panel { overflow:hidden; }
        .table-form-section { padding:21px 23px; border-bottom:1px solid var(--line); }
        .table-form-section:last-child { border-bottom:0; }
        .table-form-section-head { display:flex; gap:13px; align-items:flex-start; margin-bottom:18px; }
        .table-form-step { display:grid; place-items:center; width:31px; height:31px; flex:none; color:#fff; background:var(--coffee); border-radius:9px; font:700 12px Georgia,serif; }
        .table-form-section-head h2 { margin:0; font:700 16px Georgia,serif; }
        .table-form-section-head p { margin:4px 0 0; color:var(--muted); font-size:11px; }
        .table-form-field { display:grid; gap:7px; }
        .table-form-field label { font-size:12px; font-weight:700; }
        .table-form-field input { width:100%; min-height:48px; padding:0 13px; color:var(--ink); background:#fff; border:1px solid var(--line); border-radius:8px; font:inherit; font-size:14px; }
        .table-form-field input:focus { border-color:var(--coffee); outline:3px solid #98663e33; }
        .table-form-hint { color:var(--muted); font-size:10px; }
        .table-form-error { color:#9b3329; font-size:11px; }
        .table-form-error[role=alert] { padding:10px 12px; background:#fff3f1; border:1px solid #f0c8c2; border-radius:7px; }
        .table-form-actions { display:flex; justify-content:space-between; align-items:center; gap:12px; padding:17px 23px; background:#fbf8f3; }
        .table-form-cancel,.table-form-submit { display:inline-flex; align-items:center; justify-content:center; min-height:44px; padding:0 16px; border-radius:8px; font:650 12px system-ui,sans-serif; }
        .table-form-cancel { color:var(--ink); border:1px solid var(--line); background:var(--paper); }
        .table-form-submit { color:white; border:1px solid var(--coffee); background:var(--coffee); cursor:pointer; }
        .table-form-submit:hover { background:#503622; }
        .table-form-aside { position:sticky; top:18px; padding:18px; }
        .table-form-aside h2 { margin:0; font:700 16px Georgia,serif; }
        .table-form-aside > p { margin:6px 0 16px; color:var(--muted); font-size:11px; }
        .table-form-summary { padding:15px; background:#f7f2ea; border:1px solid #eee3d5; border-radius:9px; }
        .table-form-summary-label { color:var(--muted); font-size:9px; font-weight:750; letter-spacing:.09em; text-transform:uppercase; }
        .table-form-summary-value { margin-top:5px; font:700 20px Georgia,serif; overflow-wrap:anywhere; }
        .table-form-token { margin-top:13px; padding-top:12px; border-top:1px solid #e3d8ca; }
        .table-form-token code { display:block; margin-top:6px; color:var(--ink); font:11px/1.5 ui-monospace,monospace; overflow-wrap:anywhere; }
        .table-form-note { margin-top:13px; padding:12px; color:#69563f; background:#fbf8f3; border-radius:8px; font-size:10px; line-height:1.55; }
        .table-form-aside-link { display:inline-flex; align-items:center; min-height:40px; margin-top:13px; color:var(--coffee); font-size:11px; font-weight:700; }
        @media(max-width:850px) { .table-form-layout { grid-template-columns:1fr; } .table-form-aside { position:static; } }
        @media(max-width:760px) { main.content:has(.table-form-page) { padding:23px 17px; } .table-form-head h1 { font-size:27px; } .table-form-section { padding:18px 17px; } .table-form-actions { padding:14px 17px; } }
        @media(max-width:440px) { .table-form-actions { align-items:stretch; flex-direction:column-reverse; } .table-form-cancel,.table-form-submit { width:100%; } }
    </style>

    <div class="table-form-page">
        <nav class="table-form-crumb" aria-label="Breadcrumb"><a href="{{ route('admin.tables') }}">Meja &amp; QR</a><span aria-hidden="true">/</span><span>{{ $table->exists ? 'Ubah meja' : 'Tambah meja' }}</span></nav>
        <header class="table-form-head"><p class="table-form-eyebrow">Katalog &amp; resto operasional</p><h1>{{ $table->exists ? 'Ubah Data Meja' : 'Tambah Meja Baru' }}</h1><p>{{ $table->exists ? 'Perbarui nomor meja. Token QR yang sudah ada akan tetap dipertahankan.' : 'Daftarkan meja dan buat identitas token QR untuk meja tersebut.' }}</p></header>

        <div class="table-form-layout">
            <form class="table-form-panel" method="POST" action="{{ $table->exists ? route('admin.tables.update', $table) : route('admin.tables.store') }}">
                @csrf
                @if ($table->exists) @method('PUT') @endif
                <section class="table-form-section" aria-labelledby="table-info-title">
                    <div class="table-form-section-head"><span class="table-form-step" aria-hidden="true">01</span><div><h2 id="table-info-title">Informasi Meja</h2><p>Gunakan nomor yang mudah dikenali staf dan pelanggan.</p></div></div>
                    <div class="table-form-field">
                        <label for="nomor_meja">Nomor atau nama meja <span aria-hidden="true">*</span></label>
                        <input id="nomor_meja" name="nomor_meja" value="{{ old('nomor_meja', $table->nomor_meja) }}" required maxlength="255" autocomplete="off" placeholder="Contoh: Meja 01" @error('nomor_meja') aria-invalid="true" aria-describedby="nomor-meja-error" @enderror>
                        <span class="table-form-hint">Maksimal 255 karakter. Nomor meja harus unik.</span>
                        @error('nomor_meja')<span class="table-form-error" id="nomor-meja-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                </section>
                <section class="table-form-section" aria-labelledby="table-qr-title">
                    <div class="table-form-section-head"><span class="table-form-step" aria-hidden="true">02</span><div><h2 id="table-qr-title">Identitas QR</h2><p>Token dikelola oleh sistem agar tidak bisa diubah dari formulir.</p></div></div>
                    @if ($table->exists)
                        <div class="table-form-field"><label for="kode_qr_preview">Token tersimpan</label><input id="kode_qr_preview" value="{{ $table->kode_qr }}" readonly aria-describedby="table-token-note"><span class="table-form-hint" id="table-token-note">Mengubah nama meja tidak mengganti token ini.</span></div>
                    @else
                        <p class="table-form-hint">Token QR akan dibuat otomatis setelah meja disimpan. Pembuatan gambar QR dan file cetak belum tersedia.</p>
                    @endif
                </section>
                <footer class="table-form-actions"><a class="table-form-cancel" href="{{ route('admin.tables') }}">Kembali ke daftar</a><button class="table-form-submit" type="submit">{{ $table->exists ? 'Simpan Perubahan Meja' : 'Simpan Meja' }}</button></footer>
            </form>

            <aside class="table-form-aside" aria-labelledby="table-summary-title">
                <h2 id="table-summary-title">Ringkasan Meja</h2>
                <p>Pratinjau data yang akan disimpan.</p>
                <div class="table-form-summary"><div class="table-form-summary-label">{{ $table->exists ? 'Nomor meja' : 'Nomor meja baru' }}</div><div class="table-form-summary-value" id="table-number-preview">{{ old('nomor_meja', $table->nomor_meja) ?: 'Belum diisi' }}</div>
                    @if ($table->exists)<div class="table-form-token"><div class="table-form-summary-label">ID meja</div><code>{{ $table->id_meja }}</code></div>@endif
                </div>
                <div class="table-form-note">QR yang dapat dipindai, pratinjau tent card, dan proses cetak belum menjadi bagian dari formulir ini. Data meja dan token yang tersimpan tetap dikelola di sistem.</div>
                <a class="table-form-aside-link" href="{{ route('admin.tables') }}">Lihat semua meja →</a>
            </aside>
        </div>
    </div>

    <script>
        const tableNumberInput = document.querySelector('#nomor_meja');
        const tableNumberPreview = document.querySelector('#table-number-preview');
        tableNumberInput?.addEventListener('input', () => {
            tableNumberPreview.textContent = tableNumberInput.value.trim() || 'Belum diisi';
        });
    </script>
@endsection
