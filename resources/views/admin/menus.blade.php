@extends('admin.layout')

@section('title', 'Katalog Menu')

@section('content')
    <style>
        main.content:has(.catalog-page) { max-width:none; padding:30px 34px; }
        .catalog-page { max-width:1440px; margin:auto; }
        .catalog-head { display:flex; align-items:flex-end; justify-content:space-between; gap:20px; margin-bottom:22px; }
        .catalog-breadcrumb { margin:0 0 8px; color:var(--muted); font-size:11px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; }
        .catalog-head h1 { max-width:600px; font:700 32px/1.15 Georgia,serif; }
        .catalog-head p:last-child { margin:8px 0 0; color:var(--muted); font-size:13px; }
        .catalog-primary { display:inline-flex; align-items:center; justify-content:center; min-height:44px; padding:0 17px; color:#fff; background:var(--coffee); border:1px solid var(--coffee); border-radius:999px; font-size:13px; font-weight:650; white-space:nowrap; }
        .catalog-primary:hover { background:#503622; }
        .catalog-controls { padding:18px; background:var(--paper); border:1px solid var(--line); border-radius:13px 13px 0 0; }
        .catalog-search { width:100%; min-height:46px; padding:0 15px; color:var(--ink); background:#fff; border:1px solid var(--line); border-radius:999px; font:inherit; }
        .catalog-filter-row { display:flex; align-items:center; gap:9px; margin-top:14px; flex-wrap:wrap; }
        .catalog-filter-label { margin-right:3px; color:var(--muted); font-size:10px; font-weight:700; letter-spacing:.08em; }
        .catalog-filter { min-height:34px; padding:0 12px; color:#65564a; background:#f5efe8; border:1px solid transparent; border-radius:999px; font:600 11px system-ui,sans-serif; cursor:pointer; }
        .catalog-filter[aria-pressed="true"] { color:#fff; background:var(--coffee); }
        .catalog-filter:hover { border-color:#cbb9a7; }
        .catalog-filter .available-dot,.catalog-filter .unavailable-dot { display:inline-block; width:7px; height:7px; margin-right:5px; border-radius:50%; }
        .available-dot { background:#66845c; }
        .unavailable-dot { background:#bf6253; }
        .catalog-table-wrap { overflow-x:auto; background:var(--paper); border:1px solid var(--line); border-top:0; border-radius:0 0 13px 13px; }
        .catalog-table { width:100%; min-width:840px; border-collapse:collapse; text-align:left; }
        .catalog-table th { padding:12px 15px; color:var(--muted); background:#fbf8f3; border-bottom:1px solid var(--line); font-size:9px; font-weight:750; letter-spacing:.07em; text-transform:uppercase; white-space:nowrap; }
        .catalog-table td { padding:14px 15px; border-bottom:1px solid #eee7df; vertical-align:middle; }
        .catalog-table tbody tr:last-child td { border-bottom:0; }
        .catalog-product { display:flex; align-items:center; gap:12px; min-width:245px; }
        .catalog-photo { width:54px; height:54px; flex:none; object-fit:cover; border-radius:9px; background:#f1ebe3; }
        .catalog-no-photo { display:grid; place-items:center; color:#887867; font-size:19px; }
        .catalog-name { color:var(--ink); font:700 15px/1.25 Georgia,serif; }
        .catalog-description { display:-webkit-box; max-width:290px; margin-top:4px; overflow:hidden; color:var(--muted); font-size:11px; line-height:1.4; -webkit-line-clamp:2; -webkit-box-orient:vertical; }
        .catalog-price { font-size:13px; font-weight:750; white-space:nowrap; }
        .catalog-status { display:inline-flex; align-items:center; gap:6px; padding:6px 9px; border-radius:999px; font-size:10px; font-weight:700; white-space:nowrap; }
        .catalog-status.is-available { color:#4f714a; background:#edf3e9; }
        .catalog-status.is-unavailable { color:#a34f45; background:#f8e9e5; }
        .catalog-actions { display:flex; align-items:center; justify-content:flex-end; gap:9px; white-space:nowrap; }
        .catalog-actions a { display:inline-flex; align-items:center; min-height:40px; color:var(--coffee); font-size:11px; font-weight:700; }
        .catalog-toggle { min-height:40px; padding:0 10px; color:#66513b; background:#f5efe8; border:1px solid #e7dacc; border-radius:7px; font:650 10px system-ui,sans-serif; cursor:pointer; }
        .catalog-toggle:hover { background:#eee3d7; }
        .catalog-footer { display:flex; justify-content:space-between; align-items:center; gap:12px; margin-top:12px; color:var(--muted); font-size:11px; }
        .catalog-empty { padding:35px!important; color:var(--muted); text-align:center; }
        .catalog-empty[hidden] { display:none; }
        .pagination { margin-top:16px; }
        @media(max-width:760px) { main.content:has(.catalog-page) { padding:24px 17px; } .catalog-head { align-items:flex-start; flex-direction:column; } .catalog-head h1 { font-size:28px; } .catalog-primary { width:100%; } .catalog-controls { padding:14px; } .catalog-footer { align-items:flex-start; flex-direction:column; } }
        @media(prefers-reduced-motion:reduce) { .catalog-page * { scroll-behavior:auto; } }
    </style>

    <div class="catalog-page">
        <header class="catalog-head">
            <div>
                <p class="catalog-breadcrumb">Chōgō Coffee · Katalog aktif</p>
                <h1>Katalog Menu &amp; Manajemen Harga</h1>
                <p>Kelola foto, deskripsi, harga, dan ketersediaan menu.</p>
            </div>
            <a class="catalog-primary" href="{{ route('admin.menus.create') }}">+ Tambah Menu Baru</a>
        </header>

        <section aria-label="Pencarian dan filter menu">
            <div class="catalog-controls">
                <label class="sr-only" for="catalog-search">Cari menu</label>
                <input class="catalog-search" id="catalog-search" type="search" placeholder="Cari nama atau deskripsi menu…" autocomplete="off">
                <div class="catalog-filter-row" role="group" aria-label="Filter ketersediaan menu">
                    <span class="catalog-filter-label">FILTER CEPAT</span>
                    <button class="catalog-filter" type="button" data-stock-filter="all" aria-pressed="true">Semua</button>
                    <button class="catalog-filter" type="button" data-stock-filter="available" aria-pressed="false"><span class="available-dot" aria-hidden="true"></span>Tersedia</button>
                    <button class="catalog-filter" type="button" data-stock-filter="unavailable" aria-pressed="false"><span class="unavailable-dot" aria-hidden="true"></span>Tidak tersedia</button>
                </div>
            </div>

            <div class="catalog-table-wrap">
                <table class="catalog-table">
                    <thead><tr><th>Menu &amp; Deskripsi</th><th>Harga Jual</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody id="catalog-rows">
                    @forelse ($menus as $menu)
                        <tr data-menu-row data-availability="{{ $menu->ketersediaan ? 'available' : 'unavailable' }}" data-search-text="{{ strtolower($menu->nama_menu.' '.$menu->deskripsi) }}">
                            <td>
                                <div class="catalog-product">
                                    @if ($menu->foto)
                                        <img class="catalog-photo" src="{{ asset('storage/'.$menu->foto) }}" alt="Foto {{ $menu->nama_menu }}" width="54" height="54" loading="lazy">
                                    @else
                                        <span class="catalog-photo catalog-no-photo" aria-hidden="true">☕</span>
                                    @endif
                                    <div><div class="catalog-name">{{ $menu->nama_menu }}</div><div class="catalog-description">{{ $menu->deskripsi }}</div></div>
                                </div>
                            </td>
                            <td class="catalog-price">Rp{{ number_format((float) $menu->harga, 0, ',', '.') }}</td>
                            <td><span class="catalog-status {{ $menu->ketersediaan ? 'is-available' : 'is-unavailable' }}">{{ $menu->ketersediaan ? 'Tersedia' : 'Tidak tersedia' }}</span></td>
                            <td>
                                <div class="catalog-actions">
                                    <a href="{{ route('admin.menus.edit', $menu) }}">Edit</a>
                                    <form method="POST" action="{{ route('admin.menus.availability', $menu) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button class="catalog-toggle" type="submit">{{ $menu->ketersediaan ? 'Nonaktifkan' : 'Aktifkan' }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td class="catalog-empty" colspan="4">Belum ada menu. Tambahkan menu untuk mulai mengisi katalog.</td></tr>
                    @endforelse
                    <tr class="catalog-empty" id="catalog-no-results" hidden><td colspan="4">Tidak ada menu yang cocok dengan pencarian dan filter.</td></tr>
                    </tbody>
                </table>
            </div>
            <footer class="catalog-footer"><span>{{ $menus->total() }} menu tercatat · {{ $menus->count() }} ditampilkan di halaman ini</span><span>Pencarian dan filter berlaku untuk halaman ini.</span></footer>
            <div class="pagination">{{ $menus->links() }}</div>
        </section>
    </div>

    <script>
        const catalogSearch = document.querySelector('#catalog-search');
        const catalogFilters = document.querySelectorAll('[data-stock-filter]');
        const catalogRows = [...document.querySelectorAll('[data-menu-row]')];
        const catalogNoResults = document.querySelector('#catalog-no-results');
        let activeStockFilter = 'all';

        const updateCatalogRows = () => {
            const query = catalogSearch.value.trim().toLocaleLowerCase('id');
            let visibleCount = 0;

            catalogRows.forEach((row) => {
                const matchesSearch = row.dataset.searchText.includes(query);
                const matchesAvailability = activeStockFilter === 'all' || row.dataset.availability === activeStockFilter;
                row.hidden = !matchesSearch || !matchesAvailability;
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
    </script>
@endsection
