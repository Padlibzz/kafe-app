@extends('admin.layout')

@section('title', 'Meja & QR')

@section('content')
    <style>
        main.content:has(.tables-page) { max-width:none; padding:30px 34px; }
        .tables-page { max-width:1440px; margin:auto; }
        .tables-eyebrow { margin:0 0 7px; color:var(--muted); font-size:11px; font-weight:700; letter-spacing:.12em; text-transform:uppercase; }
        .tables-head { display:flex; align-items:flex-end; justify-content:space-between; gap:20px; margin-bottom:22px; }
        .tables-head h1 { font-size:30px; }
        .tables-head p:last-child { margin:8px 0 0; color:var(--muted); font-size:13px; }
        .tables-primary { display:inline-flex; align-items:center; justify-content:center; min-height:44px; padding:0 16px; border:1px solid var(--coffee); border-radius:8px; font:650 13px system-ui,sans-serif; }
        .tables-primary { color:white; background:var(--coffee); }
        .tables-primary:hover { background:#503622; }
        .tables-stats { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:14px; margin-bottom:22px; }
        .tables-stat,.table-card,.tables-preview-card { background:var(--paper); border:1px solid var(--line); border-radius:12px; }
        .tables-stat { padding:17px 19px; }
        .tables-stat-label { color:var(--muted); font-size:10px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; }
        .tables-stat-value { display:flex; align-items:baseline; gap:7px; margin-top:8px; font:700 28px/1.1 Georgia,serif; }
        .tables-stat-value small { color:var(--muted); font:500 12px system-ui,sans-serif; }
        .tables-stat-note { margin-top:6px; color:var(--muted); font-size:11px; }
        .tables-layout { display:grid; grid-template-columns:minmax(0,1fr) 320px; gap:20px; align-items:start; }
        .tables-list-head { display:flex; justify-content:space-between; align-items:center; gap:12px; margin-bottom:12px; }
        .tables-list-head h2 { margin:0; font:700 18px Georgia,serif; }
        .tables-list-head span { color:var(--muted); font-size:12px; }
        .tables-search { width:100%; min-height:44px; margin-bottom:14px; padding:0 13px; border:1px solid var(--line); border-radius:8px; background:var(--paper); color:var(--ink); font:inherit; }
        .tables-grid { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:12px; }
        .table-card { padding:16px; }
        .table-card-top { display:flex; align-items:flex-start; justify-content:space-between; gap:12px; }
        .table-card-number { color:var(--muted); font-size:10px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; }
        .table-card h3 { margin:4px 0 0; font:700 18px Georgia,serif; overflow-wrap:anywhere; }
        .table-qr-token { margin-top:12px; padding:10px; color:#6f6258; background:#f7f3ed; border-radius:7px; font:11px/1.45 ui-monospace,monospace; overflow-wrap:anywhere; }
        .table-card-actions { display:flex; justify-content:space-between; align-items:center; gap:10px; margin-top:13px; }
        .table-card-actions a { min-height:40px; display:inline-flex; align-items:center; color:var(--coffee); font-size:12px; font-weight:650; }
        .table-status { display:inline-flex; align-items:center; gap:6px; padding:5px 9px; color:#66513b; background:#f3ece2; border-radius:999px; font-size:10px; font-weight:700; }
        .tables-preview { position:sticky; top:18px; }
        .tables-preview-card { padding:18px; }
        .tables-preview-card h2 { margin:0; font:700 16px Georgia,serif; }
        .tables-preview-card > p { margin:5px 0 15px; color:var(--muted); font-size:11px; }
        .tent-card { padding:20px 17px; border:1px solid #e5dace; border-radius:10px; background:#fbf6ef; text-align:center; }
        .tent-brand { color:var(--coffee); font:700 17px Georgia,serif; }
        .tent-number { display:inline-flex; margin:12px 0; padding:6px 11px; color:#fff; background:var(--coffee); border-radius:999px; font-size:10px; font-weight:700; letter-spacing:.07em; }
        .tent-card h3 { margin:0; font:700 20px/1.25 Georgia,serif; }
        .tent-card > p { margin:8px 0 14px; color:var(--muted); font-size:11px; }
        .tent-qr { display:grid; place-items:center; width:148px; height:148px; margin:auto; padding:8px; border:1px solid var(--line); border-radius:8px; background:#fff; }
        .tent-qr svg { width:100%; height:100%; }
        .tent-steps { display:grid; gap:6px; margin-top:14px; text-align:left; }
        .tent-steps span { padding:7px 8px; background:#fff; border:1px solid #eee7df; border-radius:6px; font-size:10px; }
        .tent-disclaimer { margin:11px 0 0!important; font-size:10px!important; }
        .tables-preview-note { margin-top:12px; padding:11px; color:var(--muted); background:#f7f3ed; border-radius:8px; font-size:11px; }
        .tables-empty { grid-column:1/-1; padding:30px; color:var(--muted); background:var(--paper); border:1px dashed var(--line); border-radius:12px; text-align:center; }
        .tables-empty[hidden] { display:none; }
        .pagination { margin-top:18px; }
        @media(max-width:1050px) { .tables-layout { grid-template-columns:minmax(0,1fr) 280px; gap:14px; } main.content:has(.tables-page) { padding:24px; } }
        @media(max-width:800px) { .tables-layout { grid-template-columns:1fr; } .tables-preview { position:static; } .tables-preview-card { display:grid; grid-template-columns:minmax(150px,.8fr) 1fr; align-items:center; gap:14px; } .tables-preview-card > h2,.tables-preview-card > p,.tables-preview-note { grid-column:1/-1; } .tables-preview-card > p { margin:-10px 0 0; } .tent-card { grid-row:3/6; } .tables-preview-note { margin:0; } }
        @media(max-width:560px) { main.content:has(.tables-page) { padding:20px 14px; } .tables-head { align-items:flex-start; flex-direction:column; } .tables-head h1 { font-size:26px; } .tables-primary { width:100%; } .tables-stats { grid-template-columns:1fr; gap:9px; } .tables-stat { padding:14px 16px; } .tables-stat-value { font-size:24px; } .tables-grid { grid-template-columns:1fr; } .tables-preview-card { display:block; } .tables-preview-card > p { margin:5px 0 15px; } .tables-preview-note { margin-top:12px; } }
    </style>

    <div class="tables-page">
        <header class="tables-head">
            <div>
                <p class="tables-eyebrow">Katalog &amp; resto operasional · Dine-in order portal</p>
                <h1>Manajemen Meja &amp; QR</h1>
                <p>Kelola nomor meja dan token QR untuk membantu tamu membuka alur pemesanan.</p>
            </div>
            <a class="tables-primary" href="{{ route('admin.tables.create') }}">+ Tambah Meja Baru</a>
        </header>

        <section class="tables-stats" aria-label="Ringkasan meja">
            <article class="tables-stat"><div class="tables-stat-label">Total Meja</div><div class="tables-stat-value">{{ $tables->total() }} <small>terdaftar</small></div><div class="tables-stat-note">Jumlah meja yang tercatat di sistem.</div></article>
            <article class="tables-stat"><div class="tables-stat-label">Token Meja</div><div class="tables-stat-value">{{ $tables->total() }} <small>tersimpan</small></div><div class="tables-stat-note">Token tersedia sebagai identitas meja di sistem.</div></article>
            <article class="tables-stat"><div class="tables-stat-label">Informasi Okupansi</div><div class="tables-stat-value">— <small>belum tersedia</small></div><div class="tables-stat-note">Skema meja belum menyimpan status sesi atau kapasitas.</div></article>
        </section>

        <div class="tables-layout">
            <section aria-labelledby="tables-list-title">
                <div class="tables-list-head"><h2 id="tables-list-title">Daftar Meja</h2><span>{{ $tables->total() }} meja</span></div>
                <label class="sr-only" for="tables-search">Cari nomor meja di halaman ini</label><input class="tables-search" id="tables-search" type="search" placeholder="Cari nomor meja di halaman ini…" aria-describedby="tables-search-help"><span class="sr-only" id="tables-search-help">Pencarian hanya mencakup meja pada halaman saat ini.</span>
                <div class="tables-grid" id="tables-grid">
                    @forelse ($tables as $table)
                        <article class="table-card" data-table-number="{{ strtolower($table->nomor_meja) }}">
                            <div class="table-card-top"><div><div class="table-card-number">ID Meja {{ $table->id_meja }}</div><h3>{{ $table->nomor_meja }}</h3></div><span class="table-status">Terdaftar</span></div>
                            <div class="table-qr-token">Token · {{ $table->kode_qr }}</div>
                            <div class="table-card-actions"><a href="{{ route('admin.tables.edit', $table) }}">Ubah nomor meja</a><a href="{{ route('admin.tables.edit', $table) }}" aria-label="Kelola meja {{ $table->nomor_meja }}">Kelola →</a></div>
                        </article>
                    @empty
                        <div class="tables-empty">Belum ada meja. Tambahkan meja untuk mulai menyiapkan QR.</div>
                    @endforelse
                    <p class="tables-empty" id="tables-no-results" hidden>Tidak ada meja yang cocok dengan pencarian.</p>
                </div>
                <div class="pagination">{{ $tables->links() }}</div>
            </section>

            <aside class="tables-preview" aria-label="Pratinjau QR meja">
                <section class="tables-preview-card">
                    <h2>Preview Tent Card QR</h2>
                    <p>Pratinjau konsep · belum siap cetak</p>
                    <div class="tent-card">
                        <div class="tent-brand">Chōgō Kōhi</div>
                        <span class="tent-number">NOMOR MEJA</span>
                        <h3>Scan untuk melihat menu</h3>
                        <p>Arahkan kamera ke QR meja untuk membuka pemesanan.</p>
                        <div class="tent-qr" aria-hidden="true">
                            <svg viewBox="0 0 21 21"><rect width="21" height="21" fill="white"/><path fill="#34271f" d="M0 0h7v7H0zm2 2v3h3V2zm12-2h7v7h-7zm2 2v3h3V2zM0 14h7v7H0zm2 2v3h3v-3zM9 0h2v2H9zm0 4h2v2H9zm0 5h3v2H9zm4-3h2v3h-2zm4 1h2v2h-2zM8 13h2v2H8zm3 0h2v2h-2zm4 0h2v2h-2zm-6 3h2v2H9zm4 1h2v2h-2zm4-3h4v2h-4zm1 4h2v2h-2z"/></svg>
                        </div>
                        <div class="tent-steps"><span>1. Buka kamera &amp; scan QR</span><span>2. Pilih menu dan catatan</span><span>3. Pesan melalui kedai</span></div>
                    </div>
                    <p class="tent-disclaimer">Ilustrasi desain saja, bukan QR yang dapat dipindai.</p>
                    <div class="tables-preview-note">QR aktif dan cetak tent card belum tersedia. Kapasitas, area, serta status penggunaan meja juga belum disimpan di sistem.</div>
                </section>
            </aside>
        </div>
    </div>
    <script>
        const tableSearch = document.querySelector('#tables-search');
        tableSearch?.addEventListener('input', (event) => {
            const query = event.target.value.trim().toLowerCase();
            let visibleCount = 0;
            document.querySelectorAll('[data-table-number]').forEach((card) => {
                const matches = card.dataset.tableNumber.includes(query);
                card.hidden = !matches;
                visibleCount += Number(matches);
            });
            document.querySelector('#tables-no-results').hidden = visibleCount > 0 || query === '';
        });
    </script>
@endsection
