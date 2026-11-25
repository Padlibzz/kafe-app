@extends('admin.layout')

@section('title', 'Katalog Menu')

@section('content')
    @php
        $menuItems   = $menus->getCollection();
        $categories  = $menuItems->pluck('kategori')->filter()->unique()->values();
        $soldOutPage = $menuItems->where('ketersediaan', false)->count();
        $availPage   = $menuItems->count() - $soldOutPage;
        $margins     = $menuItems->filter(fn ($m) => (float) $m->harga > 0 && ! is_null($m->hpp ?? null))
                                 ->map(fn ($m) => ((float) $m->harga - (float) $m->hpp) / (float) $m->harga * 100);
        $avgMargin   = $margins->count() ? round($margins->avg()) : null;
    @endphp

    <style>
        main.content:has(.catalog-page) { max-width:none; padding:28px 34px; }
        .catalog-page {
            --c-card:#fff; --c-soft:#fdf1e6; --c-soft2:#fbe9da; --c-line:#f3e6d9;
            --c-brown:#6b4631; --c-brown-d:#583625; --c-green:#5b6b4d; --c-red:#d0352b;
            --c-ink:var(--ink,#3a2a20); --c-muted:var(--muted,#8a7667);
            max-width:1440px; margin:auto;
        }
        .catalog-page * { box-sizing:border-box; }
        .catalog-page a { text-decoration:none; }
        .catalog-page svg { flex:none; }

        /* ===== Notifikasi ===== */
        .catalog-alert { display:flex; align-items:flex-start; gap:12px; margin:0 0 16px; padding:14px 18px; border-radius:14px; font-size:13px; line-height:1.5; }
        .catalog-alert svg { margin-top:2px; }
        .catalog-alert strong { display:block; font-weight:700; }
        .catalog-alert ul { margin:4px 0 0; padding-left:18px; }
        .catalog-alert.is-error { color:#8c3028; background:#fff0ed; border:1px solid #f3d3ce; }
        .catalog-alert.is-success { color:#3f5e38; background:#edf3e9; border:1px solid #d6e4cd; }

        /* ===== Header ===== */
        .catalog-head { display:flex; align-items:flex-end; justify-content:space-between; gap:24px; margin-bottom:20px; flex-wrap:wrap; }
        .catalog-head-text { flex:1 1 340px; min-width:0; }
        .catalog-crumbs { display:flex; align-items:center; gap:10px; margin:0 0 10px; flex-wrap:wrap; }
        .catalog-breadcrumb { padding:3px 10px; color:#6f5d4f; background:#f7e6d6; border-radius:6px; font-size:10px; font-weight:700; letter-spacing:.06em; text-transform:uppercase; }
        .catalog-version { color:var(--c-muted); font-size:11px; }
        .catalog-version::before { content:"•"; margin-right:8px; }
        .catalog-head h1 { max-width:560px; margin:0; color:var(--c-ink); font:700 clamp(28px,3.6vw,40px)/1.1 Georgia,"Playfair Display",serif; }
        .catalog-head p.catalog-sub { max-width:460px; margin:12px 0 0; color:#5f5045; font-size:13px; line-height:1.55; }

        .catalog-head-actions { display:flex; align-items:center; gap:12px; flex-wrap:wrap; justify-content:flex-end; }

        /* Grup alat CSV (Export + Import dalam satu kapsul) */
        .catalog-tools { display:flex; align-items:center; min-height:48px; padding:4px; background:var(--c-soft); border-radius:999px; }
        .catalog-tools-divider { width:1px; height:22px; margin:0 4px; background:#ecd5c0; }
        .catalog-tool { display:inline-flex; align-items:center; gap:8px; min-height:40px; padding:0 16px; color:var(--c-ink); background:transparent; border:0; border-radius:999px; font:600 13px system-ui,sans-serif; white-space:nowrap; cursor:pointer; transition:background .15s; }
        .catalog-tool:hover { background:var(--c-soft2); }
        .catalog-tool:focus-visible { outline:2px solid var(--c-brown); outline-offset:1px; }
        .catalog-tool[disabled] { opacity:.45; cursor:not-allowed; }
        .catalog-tool[disabled]:hover { background:transparent; }
        .catalog-tool.is-upload { color:#fff; background:var(--c-brown); }
        .catalog-tool.is-upload:hover { background:var(--c-brown-d); }
        .catalog-tool.is-upload[disabled] { color:var(--c-muted); background:transparent; }
        .catalog-import-form { display:flex; align-items:center; gap:4px; margin:0; }
        .catalog-file-input { position:absolute; width:1px; height:1px; overflow:hidden; clip:rect(0 0 0 0); white-space:nowrap; }
        .catalog-file-name { max-width:150px; padding:0 6px; overflow:hidden; color:var(--c-muted); font-size:11px; text-overflow:ellipsis; white-space:nowrap; }
        .catalog-file-name[hidden] { display:none; }

        .catalog-primary { display:inline-flex; align-items:center; justify-content:center; gap:8px; min-height:48px; padding:0 24px; color:#fff!important; background:var(--c-brown); border:0; border-radius:999px; font-size:13px; font-weight:650; white-space:nowrap; box-shadow:0 8px 18px rgba(107,70,49,.25); transition:background .15s; }
        .catalog-primary:hover { background:var(--c-brown-d); }

        /* ===== Controls ===== */
        .catalog-controls { padding:18px; background:var(--c-soft); border-radius:20px; margin-bottom:18px; }
        .catalog-controls-row { display:flex; align-items:center; gap:22px; flex-wrap:wrap; }
        .catalog-search-wrap { position:relative; flex:1 1 320px; min-width:0; }
        .catalog-search-wrap svg { position:absolute; left:16px; top:50%; width:17px; height:17px; transform:translateY(-50%); color:#8a7667; pointer-events:none; }
        .catalog-search { width:100%; min-height:48px; padding:0 18px 0 44px; color:var(--c-ink); background:#fff; border:1px solid transparent; border-radius:999px; font:inherit; font-size:13px; }
        .catalog-search:focus { outline:2px solid #d9b99c; outline-offset:1px; }
        .catalog-filter-row { display:flex; align-items:center; gap:8px; flex-wrap:wrap; }
        .catalog-filter-label { margin-right:4px; color:var(--c-muted); font-size:10px; font-weight:600; letter-spacing:.05em; }
        .catalog-filter { display:inline-flex; align-items:center; min-height:34px; padding:0 15px; color:#4b3d33; background:#fff; border:1px solid transparent; border-radius:999px; font:600 11.5px system-ui,sans-serif; cursor:pointer; transition:all .15s; white-space:nowrap; }
        .catalog-filter:hover { border-color:#d9b99c; }
        .catalog-filter[data-stock-filter="available"] { background:#dfe9d3; color:#46603e; }
        .catalog-filter[data-stock-filter="unavailable"] { background:#fff; }
        .catalog-filter[aria-pressed="true"] { color:#fff; background:var(--c-brown); }
        .catalog-filter .available-dot,.catalog-filter .unavailable-dot { display:inline-block; width:7px; height:7px; margin-right:6px; border-radius:50%; }
        .available-dot { background:#66845c; }
        .unavailable-dot { background:var(--c-red); }
        .catalog-filter[aria-pressed="true"] .available-dot,.catalog-filter[aria-pressed="true"] .unavailable-dot { background:#fff; }

        .catalog-tabs { display:flex; gap:10px; margin-top:16px; overflow-x:auto; padding-bottom:4px; scrollbar-width:none; }
        .catalog-tabs::-webkit-scrollbar { display:none; }
        .catalog-tab { flex:none; display:inline-flex; align-items:center; gap:9px; min-height:38px; padding:0 17px; color:#4b3d33; background:#fff; border:0; border-radius:999px; font:600 11.5px system-ui,sans-serif; letter-spacing:.03em; text-transform:uppercase; cursor:pointer; transition:all .15s; }
        .catalog-tab:hover { background:#fff8f1; }
        .catalog-tab .count { display:inline-grid; place-items:center; min-width:22px; height:20px; padding:0 6px; color:#7a6858; background:#f3e8dc; border-radius:999px; font-size:10px; font-weight:700; }
        .catalog-tab[aria-pressed="true"] { color:#fff; background:var(--c-brown); }
        .catalog-tab[aria-pressed="true"] .count { color:#fff; background:rgba(255,255,255,.22); }
        .catalog-tab:first-child { text-transform:none; letter-spacing:0; }

        /* ===== Table ===== */
        .catalog-table-wrap { overflow-x:auto; background:var(--c-card); border-radius:20px; box-shadow:0 10px 28px rgba(107,70,49,.07); }
        .catalog-table { width:100%; min-width:980px; border-collapse:collapse; text-align:left; }
        .catalog-table th { padding:18px 16px; color:var(--c-muted); background:var(--c-soft); font-size:10px; font-weight:600; letter-spacing:.06em; text-transform:uppercase; white-space:nowrap; }
        .catalog-table th:first-child, .catalog-table td:first-child { padding-left:18px; }
        .catalog-table td { padding:13px 16px; border-bottom:1px solid var(--c-line); vertical-align:middle; }
        .catalog-table tbody tr:last-child td { border-bottom:0; }
        .th-center, .td-center { text-align:center!important; }
        [data-menu-row][hidden] { display:none!important; }
        [data-menu-row][data-availability="unavailable"] { background:#fff8f3; }
        .catalog-table tbody tr[data-menu-row]:hover { background:#fffaf5; }

        .catalog-product { display:flex; align-items:center; gap:14px; min-width:270px; }
        .catalog-thumb { position:relative; flex:none; width:56px; height:56px; }
        .catalog-photo { width:56px; height:56px; object-fit:cover; border-radius:10px; background:#f1ebe3; display:block; }
        .catalog-no-photo { display:grid; place-items:center; color:#887867; font-size:22px; background:var(--c-soft); border-radius:10px; width:56px; height:56px; }
        [data-availability="unavailable"] .catalog-photo { filter:grayscale(.5) brightness(.8); }
        .catalog-habis-badge { position:absolute; inset:auto 0 18px 0; text-align:center; color:#fff; background:var(--c-red); font:700 9px/1 system-ui,sans-serif; padding:3px 0; letter-spacing:.04em; }
        .catalog-info { min-width:0; }
        .catalog-name-row { display:flex; align-items:center; gap:8px; flex-wrap:wrap; }
        .catalog-name { color:var(--c-ink); font:700 16px/1.25 Georgia,"Playfair Display",serif; }
        .catalog-name:hover { color:var(--c-brown); }
        .catalog-soldout { padding:3px 8px; color:var(--c-red); background:#fde3df; border-radius:4px; font-size:10px; font-weight:700; line-height:1.2; }
        .catalog-description { display:-webkit-box; max-width:300px; margin-top:3px; overflow:hidden; color:#6b5c50; font-size:11.5px; line-height:1.4; -webkit-line-clamp:1; -webkit-box-orient:vertical; }
        .catalog-sku { margin-top:3px; color:#9a8a7c; font-size:10px; letter-spacing:.03em; }

        .catalog-pill { display:inline-block; padding:6px 13px; color:#4b3d33; background:#fbebdc; border-radius:999px; font-size:12px; font-weight:600; white-space:nowrap; }
        .catalog-temps { display:flex; gap:6px; flex-wrap:wrap; }
        .catalog-temp { display:inline-flex; align-items:center; padding:4px 8px; color:#7a5d49; background:#fbebdc; border-radius:6px; font-size:10px; font-weight:600; white-space:nowrap; }
        .catalog-temp.is-hot { color:#b3622f; }
        .catalog-temp.is-iced { color:#3f6f8a; background:#e5eef3; }
        .catalog-price { white-space:nowrap; }
        .catalog-price strong { display:block; color:var(--c-ink); font-size:15px; font-weight:700; }
        .catalog-price small { display:block; margin-top:3px; color:var(--c-muted); font-size:10px; }
        [data-availability="unavailable"] .catalog-price strong { color:var(--c-muted); text-decoration:line-through; }
        .catalog-tag { display:inline-flex; align-items:center; padding:6px 12px; color:#7a4d1c; background:#fbe3c8; border-radius:999px; font-size:11.5px; font-weight:600; white-space:nowrap; }
        .catalog-dash { color:#b8a898; }

        /* Status / switch */
        .catalog-status-cell { text-align:center; }
        .catalog-status-cell form { margin:0; display:flex; flex-direction:column; align-items:center; gap:6px; }
        .catalog-switch { position:relative; width:46px; height:26px; padding:0; border:0; border-radius:999px; background:var(--c-green); cursor:pointer; transition:background .2s; }
        .catalog-switch::after { content:""; position:absolute; top:3px; right:3px; width:20px; height:20px; border-radius:50%; background:#fff; box-shadow:0 1px 3px rgba(0,0,0,.25); transition:all .2s; }
        .catalog-switch.is-off { background:#f1e4d6; }
        .catalog-switch.is-off::after { right:auto; left:3px; }
        .catalog-switch:focus-visible { outline:2px solid var(--c-brown); outline-offset:2px; }
        .catalog-status { font-size:10px; font-weight:500; color:var(--c-muted); }
        .catalog-status.is-unavailable { color:var(--c-red); font-weight:600; }
        .catalog-edit { display:inline-block; margin-top:6px; color:var(--c-brown); font-size:10.5px; font-weight:700; text-decoration:underline!important; text-underline-offset:2px; }

        .catalog-empty { padding:36px!important; color:var(--c-muted); text-align:center; }
        .catalog-empty[hidden] { display:none; }

        /* ===== Footer ===== */
        .catalog-footer { display:flex; justify-content:space-between; align-items:center; gap:14px; padding:16px 22px; background:var(--c-card); border-top:1px solid var(--c-line); border-radius:0 0 20px 20px; flex-wrap:wrap; }
        .catalog-card { background:var(--c-card); border-radius:20px; box-shadow:0 10px 28px rgba(107,70,49,.07); overflow:hidden; }
        .catalog-card .catalog-table-wrap { box-shadow:none; border-radius:0; }
        .catalog-stats { display:flex; align-items:center; gap:14px; flex-wrap:wrap; color:#5f5045; font-size:12px; }
        .catalog-stats .total { color:var(--c-ink); font-size:16px; font-weight:600; }
        .catalog-stats .dot { display:inline-block; width:7px; height:7px; margin-right:6px; border-radius:50%; background:#6b6b5b; }
        .catalog-stats .dot.red { background:var(--c-red); }
        .catalog-stats .habis { color:var(--c-red); font-weight:600; }
        .catalog-margin { padding:4px 10px; color:#46603e; background:#dfe9d3; border-radius:6px; font-size:10.5px; font-weight:700; }
        .catalog-showing { display:flex; align-items:center; gap:14px; color:var(--c-muted); font-size:11px; flex-wrap:wrap; }
        .pagination { display:flex; align-items:center; gap:6px; margin:0; }
        .catalog-pagination-wrap nav { display:flex; }
        .catalog-pagination-wrap svg { width:16px; height:16px; }
        .catalog-pagination-wrap nav > div:first-child { display:none; }
        .catalog-pagination-wrap p { display:none; }

        /* ===== Tablet ===== */
        @media(max-width:1100px) {
            main.content:has(.catalog-page) { padding:24px 20px; }
            .catalog-controls-row { gap:14px; }
            .catalog-head-actions { justify-content:flex-start; width:100%; }
        }

        /* ===== Mobile: tabel menjadi kartu ===== */
        @media(max-width:760px) {
            main.content:has(.catalog-page) { padding:20px 14px; }
            .catalog-head { align-items:flex-start; flex-direction:column; }
            .catalog-head-actions { flex-direction:column; align-items:stretch; width:100%; }
            .catalog-tools { flex-wrap:wrap; justify-content:space-between; border-radius:20px; }
            .catalog-tools > .catalog-tool { flex:1; justify-content:center; }
            .catalog-tools-divider { display:none; }
            .catalog-import-form { flex:1 1 100%; flex-wrap:wrap; justify-content:center; }
            .catalog-import-form .catalog-tool { flex:1; justify-content:center; }
            .catalog-file-name { max-width:100%; flex:1 1 100%; text-align:center; }
            .catalog-primary { width:100%; }
            .catalog-controls { padding:14px; border-radius:16px; }
            .catalog-search-wrap { flex-basis:100%; }
            .catalog-filter-row { flex-wrap:nowrap; overflow-x:auto; width:100%; padding-bottom:4px; scrollbar-width:none; }
            .catalog-filter-row::-webkit-scrollbar { display:none; }
            .catalog-filter-label { flex:none; }
            .catalog-filter { flex:none; }
            .catalog-card { background:transparent; box-shadow:none; overflow:visible; }
            .catalog-card .catalog-table-wrap { overflow:visible; background:transparent; }
            .catalog-table { min-width:0; }
            .catalog-table thead { position:absolute; width:1px; height:1px; overflow:hidden; clip:rect(0 0 0 0); }
            .catalog-table, .catalog-table tbody { display:block; }
            .catalog-table tbody tr[data-menu-row] { display:grid; grid-template-columns:1fr auto; gap:12px; margin-bottom:12px; padding:14px; background:var(--c-card); border-radius:16px; box-shadow:0 6px 18px rgba(107,70,49,.07); }
            .catalog-table tbody tr[data-menu-row][data-availability="unavailable"] { background:#fff8f3; }
            .catalog-table tbody tr.catalog-empty { display:block; background:var(--c-card); border-radius:16px; }
            .catalog-table td { display:block; padding:0!important; border:0; text-align:left!important; }
            .catalog-table td:first-child { grid-column:1 / -1; }
            .catalog-product { min-width:0; }
            .catalog-description { max-width:none; }
            .catalog-table td[data-label]::before { content:attr(data-label); display:block; margin-bottom:4px; color:var(--c-muted); font-size:9px; font-weight:700; letter-spacing:.06em; text-transform:uppercase; }
            .catalog-table td.catalog-status-cell { grid-column:1 / -1; display:flex; align-items:center; justify-content:space-between; gap:10px; padding-top:12px!important; border-top:1px solid var(--c-line); }
            .catalog-table td.catalog-status-cell::before { margin:0; }
            .catalog-status-cell form { flex-direction:row; }
            .catalog-edit { margin:0; }
            .catalog-footer { border-radius:16px; margin-top:6px; box-shadow:0 6px 18px rgba(107,70,49,.07); flex-direction:column; align-items:flex-start; }
            .catalog-showing { width:100%; justify-content:space-between; }
        }
        @media(prefers-reduced-motion:reduce) { .catalog-page * { scroll-behavior:auto; transition:none!important; } }
    </style>

    <div class="catalog-page">
        @if ($errors->has('file'))
            <div class="catalog-alert is-error" role="alert">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 8v5M12 16.5v.01"/></svg>
                <div>
                    <strong>Import gagal. Tidak ada data yang disimpan.</strong>
                    <ul>@foreach ($errors->get('file') as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            </div>
        @endif
        @if (session('status'))
            <div class="catalog-alert is-success" role="status">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M8 12.5l3 3 5-6"/></svg>
                <div>{{ session('status') }}</div>
            </div>
        @endif

        <header class="catalog-head">
            <div class="catalog-head-text">
                <div class="catalog-crumbs">
                    <span class="catalog-breadcrumb">Chōgō Coffee</span>
                    <span class="catalog-version">Katalog Aktif</span>
                </div>
                <h1>Katalog Menu &amp; Manajemen Harga</h1>
                <p class="catalog-sub">Kelola foto, deskripsi, harga, dan ketersediaan menu Chōgō Coffee.</p>
            </div>
            <div class="catalog-head-actions">
                <div class="catalog-tools" role="group" aria-label="Import dan export CSV">
                    <a class="catalog-tool" href="{{ route('admin.menus.export') }}">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 4v11M12 15l-4-4M12 15l4-4M5 20h14"/></svg>
                        Export CSV
                    </a>
                    <span class="catalog-tools-divider" aria-hidden="true"></span>
                    <form class="catalog-import-form" method="POST" action="{{ route('admin.menus.import') }}" enctype="multipart/form-data">
                        @csrf
                        <input class="catalog-file-input" id="menu-csv-file" type="file" name="file" accept=".csv,text/csv" required>
                        <label class="catalog-tool" for="menu-csv-file">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 20V9M12 9l-4 4M12 9l4 4M5 4h14"/></svg>
                            Import CSV
                        </label>
                        <span class="catalog-file-name" id="menu-csv-name" hidden></span>
                        <button class="catalog-tool is-upload" id="menu-csv-submit" type="submit" disabled>Unggah</button>
                    </form>
                </div>
                <a class="catalog-primary" href="{{ route('admin.menus.create') }}">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" aria-hidden="true"><path d="M12 5v14M5 12h14"/></svg>
                    Tambah Menu Baru
                </a>
            </div>
        </header>

        <section aria-label="Pencarian dan filter menu">
            <div class="catalog-controls">
                <div class="catalog-controls-row">
                    <div class="catalog-search-wrap">
                        <label class="sr-only" for="catalog-search">Cari menu</label>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="M20 20l-3.5-3.5"/></svg>
                        <input class="catalog-search" id="catalog-search" type="search" placeholder="Cari nama menu, SKU, atau kategori…" autocomplete="off">
                    </div>
                    <div class="catalog-filter-row" role="group" aria-label="Filter ketersediaan menu">
                        <span class="catalog-filter-label">FILTER CEPAT:</span>
                        <button class="catalog-filter" type="button" data-stock-filter="all" aria-pressed="true">Semua</button>
                        <button class="catalog-filter" type="button" data-stock-filter="available" aria-pressed="false"><span class="available-dot" aria-hidden="true"></span>Stok Tersedia</button>
                        <button class="catalog-filter" type="button" data-stock-filter="unavailable" aria-pressed="false"><span class="unavailable-dot" aria-hidden="true"></span>Stok Habis ({{ $soldOutPage }})</button>
                    </div>
                </div>

                <div class="catalog-tabs" role="group" aria-label="Filter kategori">
                    <button class="catalog-tab" type="button" data-category-filter="all" aria-pressed="true">Semua Menu <span class="count">{{ $menus->total() }}</span></button>
                    @foreach ($categories as $category)
                        <button class="catalog-tab" type="button" data-category-filter="{{ strtolower($category) }}" aria-pressed="false">{{ $category }} <span class="count">{{ $menuItems->where('kategori', $category)->count() }}</span></button>
                    @endforeach
                </div>
            </div>

            <div class="catalog-card">
                <div class="catalog-table-wrap">
                    <table class="catalog-table">
                        <thead>
                            <tr>
                                <th>Menu &amp; Deskripsi</th>
                                <th>Kategori</th>
                                <th>Suhu / Varian</th>
                                <th>Harga Jual</th>
                                <th>Tag &amp; Rekomendasi</th>
                                <th class="th-center">Status Stok</th>
                            </tr>
                        </thead>
                        <tbody id="catalog-rows">
                        @forelse ($menus as $menu)
                            @php
                                $temps = collect(preg_split('/[,|\/]+/', (string) ($menu->suhu ?? '')))->map(fn ($t) => trim($t))->filter();
                            @endphp
                            <tr data-menu-row data-availability="{{ $menu->ketersediaan ? 'available' : 'unavailable' }}" data-category="{{ strtolower($menu->kategori ?? '') }}" data-search-text="{{ strtolower($menu->nama_menu.' '.$menu->deskripsi.' '.($menu->kategori ?? '').' '.($menu->sku ?? '')) }}">
                                <td>
                                    <div class="catalog-product">
                                        <div class="catalog-thumb">
                                            @if ($menu->foto)
                                                <img class="catalog-photo" src="{{ asset('storage/'.$menu->foto) }}" alt="Foto {{ $menu->nama_menu }}" width="56" height="56" loading="lazy">
                                            @else
                                                <span class="catalog-no-photo" aria-hidden="true">☕</span>
                                            @endif
                                            @unless ($menu->ketersediaan)
                                                <span class="catalog-habis-badge">HABIS</span>
                                            @endunless
                                        </div>
                                        <div class="catalog-info">
                                            <div class="catalog-name-row">
                                                <a class="catalog-name" href="{{ route('admin.menus.edit', $menu) }}">{{ $menu->nama_menu }}</a>
                                                @unless ($menu->ketersediaan)<span class="catalog-soldout">Sold Out</span>@endunless
                                            </div>
                                            <div class="catalog-description">{{ $menu->deskripsi }}</div>
                                            @if (! empty($menu->sku))<div class="catalog-sku">SKU: {{ $menu->sku }}</div>@endif
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Kategori">
                                    @if (! empty($menu->kategori))<span class="catalog-pill">{{ $menu->kategori }}</span>@else<span class="catalog-dash">-</span>@endif
                                </td>
                                <td data-label="Suhu / Varian">
                                    @if ($temps->isNotEmpty())
                                        <div class="catalog-temps">
                                            @foreach ($temps as $temp)
                                                <span class="catalog-temp {{ stripos($temp, 'hot') !== false || stripos($temp, 'warm') !== false ? 'is-hot' : (stripos($temp, 'ice') !== false ? 'is-iced' : '') }}">{{ $temp }}</span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="catalog-dash">-</span>
                                    @endif
                                </td>
                                <td class="catalog-price" data-label="Harga Jual">
                                    <strong>Rp{{ number_format((float) $menu->harga, 0, ',', '.') }}</strong>
                                    @if (! is_null($menu->hpp ?? null))<small>HPP: Rp{{ number_format((float) $menu->hpp, 0, ',', '.') }}</small>@endif
                                </td>
                                <td data-label="Tag &amp; Rekomendasi">
                                    @if (! empty($menu->tag))<span class="catalog-tag">{{ $menu->tag }}</span>@else<span class="catalog-dash">-</span>@endif
                                </td>
                                <td class="catalog-status-cell" data-label="Status Stok">
                                    <div>
                                        <form method="POST" action="{{ route('admin.menus.availability', $menu) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button class="catalog-switch {{ $menu->ketersediaan ? '' : 'is-off' }}" type="submit" role="switch" aria-checked="{{ $menu->ketersediaan ? 'true' : 'false' }}" aria-label="{{ $menu->ketersediaan ? 'Nonaktifkan' : 'Aktifkan' }} {{ $menu->nama_menu }}" title="{{ $menu->ketersediaan ? 'Nonaktifkan' : 'Aktifkan' }}"></button>
                                            <span class="catalog-status {{ $menu->ketersediaan ? 'is-available' : 'is-unavailable' }}">{{ $menu->ketersediaan ? 'Tersedia' : 'Habis' }}</span>
                                        </form>
                                    </div>
                                    <a class="catalog-edit" href="{{ route('admin.menus.edit', $menu) }}">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td class="catalog-empty" colspan="6">Belum ada menu. Tambahkan menu untuk mulai mengisi katalog.</td></tr>
                        @endforelse
                        <tr class="catalog-empty" id="catalog-no-results" hidden><td colspan="6">Tidak ada menu yang cocok dengan pencarian dan filter.</td></tr>
                        </tbody>
                    </table>
                </div>

                <footer class="catalog-footer">
                    <div class="catalog-stats">
                        <span class="total">▤ {{ $menus->total() }} Total Item</span>
                        <span><span class="dot"></span>{{ $availPage }} Tersedia</span>
                        <span class="habis"><span class="dot red"></span>{{ $soldOutPage }} Habis</span>
                        @if (! is_null($avgMargin))<span class="catalog-margin">Rata-rata Margin: {{ $avgMargin }}%</span>@endif
                    </div>
                    <div class="catalog-showing">
                        <span>Menampilkan {{ $menus->count() }} dari {{ $menus->total() }} menu</span>
                        <div class="catalog-pagination-wrap pagination">{{ $menus->links() }}</div>
                    </div>
                </footer>
            </div>
        </section>
    </div>

    <script>
        const catalogSearch = document.querySelector('#catalog-search');
        const catalogFilters = document.querySelectorAll('[data-stock-filter]');
        const catalogCategoryTabs = document.querySelectorAll('[data-category-filter]');
        const catalogRows = [...document.querySelectorAll('[data-menu-row]')];
        const catalogNoResults = document.querySelector('#catalog-no-results');
        let activeStockFilter = 'all';
        let activeCategoryFilter = 'all';

        const updateCatalogRows = () => {
            const query = catalogSearch.value.trim().toLocaleLowerCase('id');
            let visibleCount = 0;

            catalogRows.forEach((row) => {
                const matchesSearch = row.dataset.searchText.includes(query);
                const matchesAvailability = activeStockFilter === 'all' || row.dataset.availability === activeStockFilter;
                const matchesCategory = activeCategoryFilter === 'all' || row.dataset.category === activeCategoryFilter;
                row.hidden = !matchesSearch || !matchesAvailability || !matchesCategory;
                visibleCount += Number(!row.hidden);
            });

            catalogNoResults.hidden = visibleCount > 0 || catalogRows.length === 0;
        };

        catalogSearch?.addEventListener('input', updateCatalogRows);
        catalogFilters.forEach((filter) => {
            filter.addEventListener('click', () => {
                activeStockFilter = filter.dataset.stockFilter;
                catalogFilters.forEach((button) => button.setAttribute('aria-pressed', String(button === filter)));
                updateCatalogRows();
            });
        });
        catalogCategoryTabs.forEach((tab) => {
            tab.addEventListener('click', () => {
                activeCategoryFilter = tab.dataset.categoryFilter;
                catalogCategoryTabs.forEach((button) => button.setAttribute('aria-pressed', String(button === tab)));
                updateCatalogRows();
            });
        });

        // Tampilan input import CSV: tampilkan nama file & aktifkan tombol Unggah setelah file dipilih
        const csvInput = document.querySelector('#menu-csv-file');
        const csvName = document.querySelector('#menu-csv-name');
        const csvSubmit = document.querySelector('#menu-csv-submit');
        csvInput?.addEventListener('change', () => {
            const file = csvInput.files[0];
            csvName.textContent = file ? file.name : '';
            csvName.hidden = !file;
            csvSubmit.disabled = !file;
        });
    </script>
@endsection