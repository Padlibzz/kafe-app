@extends('admin.layout')

@section('title', 'Pelanggan')

@section('content')
    <style>
        main.content:has(.crm-page) { max-width:none; padding:30px 34px; }
        .crm-page { max-width:1440px; margin:auto; }
        .crm-breadcrumb { margin:0 0 8px; color:var(--muted); font-size:11px; font-weight:700; letter-spacing:.09em; text-transform:uppercase; }
        .crm-head { display:flex; justify-content:space-between; align-items:flex-end; gap:20px; margin-bottom:21px; }
        .crm-head h1 { font:700 30px/1.15 Georgia,serif; }
        .crm-head p:last-child { margin:7px 0 0; color:var(--muted); font-size:13px; }
        .crm-head-actions { display:flex; gap:8px; }
        .crm-head-actions a { display:inline-flex; align-items:center; justify-content:center; min-height:42px; padding:0 14px; color:var(--coffee); background:var(--paper); border:1px solid var(--line); border-radius:999px; font-size:12px; font-weight:650; white-space:nowrap; }
        .crm-stats { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:13px; margin-bottom:19px; }
        .crm-stat,.crm-panel { background:var(--paper); border:1px solid var(--line); border-radius:12px; }
        .crm-stat { min-height:127px; padding:17px 18px; }
        .crm-stat-label { color:var(--muted); font-size:10px; font-weight:750; letter-spacing:.08em; text-transform:uppercase; }
        .crm-stat-value { margin-top:9px; font:700 27px/1.1 Georgia,serif; }
        .crm-stat-note { margin-top:7px; color:var(--muted); font-size:11px; }
        .crm-tabs { display:flex; gap:5px; padding:5px; margin-bottom:15px; overflow-x:auto; background:#eee7df; border-radius:10px; }
        .crm-tab { min-height:39px; padding:0 14px; color:#6c5c4d; border-radius:7px; font-size:11px; font-weight:650; white-space:nowrap; }
        .crm-tab[aria-current="page"] { color:#fff; background:var(--coffee); }
        .crm-search-row { display:grid; grid-template-columns:minmax(0,1fr) 230px; gap:10px; padding:14px; border-bottom:1px solid var(--line); }
        .crm-search,.crm-filter { min-height:42px; padding:0 12px; color:var(--ink); background:#fff; border:1px solid var(--line); border-radius:8px; font:inherit; font-size:12px; }
        .crm-body { display:grid; grid-template-columns:minmax(0,1fr) 285px; gap:15px; align-items:start; }
        .crm-panel { overflow:hidden; }
        .crm-panel-heading { display:flex; justify-content:space-between; align-items:center; gap:12px; padding:16px 18px; border-bottom:1px solid var(--line); }
        .crm-panel-heading h2 { margin:0; font:700 16px Georgia,serif; }
        .crm-panel-heading span { color:var(--muted); font-size:11px; }
        .crm-table-wrap { overflow-x:auto; }
        .crm-table { width:100%; min-width:550px; border-collapse:collapse; text-align:left; }
        .crm-table th { padding:11px 14px; color:var(--muted); background:#fbf8f3; border-bottom:1px solid var(--line); font-size:9px; letter-spacing:.07em; text-transform:uppercase; white-space:nowrap; }
        .crm-table td { padding:13px 14px; border-bottom:1px solid #eee7df; vertical-align:middle; }
        .crm-table tbody tr:last-child td { border-bottom:0; }
        .crm-person { display:flex; align-items:center; gap:10px; min-width:175px; }
        .crm-avatar { display:grid; place-items:center; width:36px; height:36px; flex:none; color:#684a32; background:#f1e6d8; border-radius:50%; font-size:11px; font-weight:750; }
        .crm-person strong { display:block; font-size:12px; }
        .crm-person small { display:block; margin-top:3px; color:var(--muted); font-size:10px; }
        .crm-points { font-size:13px; font-weight:750; white-space:nowrap; }
        .crm-tier { display:inline-flex; padding:5px 8px; color:#5b704e; background:#edf3e9; border-radius:999px; font-size:10px; font-weight:700; }
        .crm-tier.has-points { color:#825b38; background:#f6eadb; }
        .crm-empty { padding:26px!important; color:var(--muted); text-align:center; }
        .crm-detail { position:sticky; top:18px; padding:17px; }
        .crm-detail h2 { margin:0; font:700 16px Georgia,serif; }
        .crm-detail > p { margin:6px 0 15px; color:var(--muted); font-size:11px; }
        .crm-loyalty-card { padding:17px; color:#fff8ef; background:#483323; border-radius:10px; }
        .crm-card-brand { color:#e5cba8; font-size:9px; font-weight:750; letter-spacing:.12em; }
        .crm-card-value { margin-top:21px; font:700 28px Georgia,serif; }
        .crm-card-value small { font:500 11px system-ui,sans-serif; }
        .crm-card-caption { margin-top:4px; color:#d8c7b5; font-size:10px; }
        .crm-card-rule { height:1px; margin:16px 0 12px; background:#755b43; }
        .crm-card-member { font-size:10px; font-weight:700; letter-spacing:.1em; }
        .crm-benefits { margin-top:14px; padding:12px; color:#6c5c4d; background:#f7f3ed; border-radius:8px; font-size:11px; line-height:1.5; }
        .crm-detail-note { margin-top:11px; color:var(--muted); font-size:10px; line-height:1.5; }
        .crm-footer { display:flex; justify-content:space-between; gap:12px; margin-top:11px; color:var(--muted); font-size:11px; }
        .pagination { margin-top:15px; }
        @media(max-width:1000px) { .crm-body { grid-template-columns:minmax(0,1fr) 250px; gap:10px; } .crm-search-row { grid-template-columns:minmax(0,1fr) 190px; } }
        @media(max-width:760px) { main.content:has(.crm-page) { padding:24px 17px; } .crm-head { align-items:flex-start; flex-direction:column; } .crm-head h1 { font-size:27px; } .crm-head-actions { width:100%; } .crm-head-actions a { flex:1; } .crm-stats { grid-template-columns:1fr; gap:9px; } .crm-stat { min-height:auto; padding:14px 16px; } .crm-stat-value { font-size:23px; } .crm-body { grid-template-columns:1fr; } .crm-detail { position:static; } }
        @media(max-width:520px) { .crm-search-row { grid-template-columns:1fr; } .crm-footer { flex-direction:column; } }
    </style>

    <div class="crm-page">
        <header class="crm-head">
            <div>
                <p class="crm-breadcrumb">Katalog &amp; Resto · CRM &amp; Loyalty</p>
                <h1>Manajemen Pelanggan</h1>
                <p>Kelola data pelanggan dan saldo poin yang tercatat di Chōgō Coffee.</p>
            </div>
            <div class="crm-head-actions"><span class="crm-tier">Data tersimpan</span></div>
        </header>

        <section class="crm-stats" aria-label="Ringkasan pelanggan dan poin">
            <article class="crm-stat"><div class="crm-stat-label">Total Pelanggan</div><div class="crm-stat-value">{{ number_format($customers->total(), 0, ',', '.') }}</div><div class="crm-stat-note">Pelanggan terdaftar di sistem.</div></article>
            <article class="crm-stat"><div class="crm-stat-label">Poin di Halaman Ini</div><div class="crm-stat-value">{{ number_format($customers->getCollection()->sum('saldo_poin'), 0, ',', '.') }}</div><div class="crm-stat-note">Jumlah poin dari hasil halaman saat ini.</div></article>
            <article class="crm-stat"><div class="crm-stat-label">Tier &amp; Riwayat</div><div class="crm-stat-value">Belum tersedia</div><div class="crm-stat-note">Tier, transaksi, dan aktivitas belum disimpan di database.</div></article>
        </section>

        <nav class="crm-tabs" aria-label="Bagian manajemen pelanggan"><span class="crm-tab" aria-current="page">Database Pelanggan</span><a class="crm-tab" href="{{ route('admin.loyalty') }}">Aturan Poin</a></nav>

        <div class="crm-body">
            <section class="crm-panel" aria-labelledby="crm-list-title">
                <div class="crm-panel-heading"><h2 id="crm-list-title">Daftar Pelanggan</h2><span>{{ $customers->total() }} pelanggan</span></div>
                <div class="crm-search-row">
                    <label class="sr-only" for="customer-search">Cari nama pelanggan di halaman ini</label>
                    <input class="crm-search" id="customer-search" type="search" placeholder="Cari nama pelanggan di halaman ini…" autocomplete="off">
                    <label class="sr-only" for="customer-filter">Filter saldo poin</label>
                    <select class="crm-filter" id="customer-filter"><option value="all">Semua saldo poin</option><option value="has-points">Memiliki poin</option><option value="no-points">Belum memiliki poin</option></select>
                </div>
                <div class="crm-table-wrap">
                    <table class="crm-table">
                        <thead><tr><th>Pelanggan</th><th>Tier</th><th>Saldo Poin</th></tr></thead>
                        <tbody>
                        @forelse ($customers as $customer)
                            <tr data-customer-row data-customer-name="{{ mb_strtolower($customer->nama) }}" data-customer-points="{{ $customer->saldo_poin > 0 ? 'has-points' : 'no-points' }}">
                                <td><div class="crm-person"><span class="crm-avatar" aria-hidden="true">{{ mb_strtoupper(mb_substr($customer->nama, 0, 1)) }}</span><div><strong>{{ $customer->nama }}</strong><small>ID pelanggan {{ $customer->id_customer }}</small></div></div></td>
                                <td><span class="crm-tier">Tier belum ditetapkan</span></td>
                                <td class="crm-points">{{ number_format($customer->saldo_poin, 0, ',', '.') }} poin</td>
                            </tr>
                        @empty
                            <tr><td class="crm-empty" colspan="3">Belum ada pelanggan terdaftar.</td></tr>
                        @endforelse
                        <tr class="crm-empty" id="customer-no-results" hidden><td colspan="3">Tidak ada pelanggan yang sesuai dengan pencarian.</td></tr>
                        </tbody>
                    </table>
                </div>
                <footer class="crm-footer"><span>{{ $customers->count() }} dari {{ $customers->total() }} pelanggan ditampilkan</span><span>Pencarian berlaku pada halaman ini.</span></footer>
                <div class="pagination">{{ $customers->links() }}</div>
            </section>

            <aside class="crm-panel crm-detail" aria-labelledby="crm-card-title">
                <h2 id="crm-card-title">Ringkasan Program Poin</h2>
                <p>Informasi dari saldo yang tersedia di database.</p>
                <div class="crm-loyalty-card">
                    <div class="crm-card-brand">CHŌGŌ · LOYALTY</div>
                    <div class="crm-card-value">{{ number_format($customers->getCollection()->sum('saldo_poin'), 0, ',', '.') }} <small>poin</small></div>
                    <div class="crm-card-caption">Akumulasi pada halaman ini</div>
                    <div class="crm-card-rule"></div>
                    <div class="crm-card-member">PROGRAM POIN PELANGGAN</div>
                </div>
                <div class="crm-benefits">Saldo poin tampil sebagai angka tersimpan. Nilai tukar, tier keanggotaan, dan benefit belum dikonfigurasi.</div>
                <div class="crm-detail-note">Panel ini tidak menampilkan email atau data autentikasi pelanggan.</div>
            </aside>
        </div>
    </div>

    <script>
        const customerSearch = document.querySelector('#customer-search');
        const customerFilter = document.querySelector('#customer-filter');
        const customerRows = [...document.querySelectorAll('[data-customer-row]')];
        const customerNoResults = document.querySelector('#customer-no-results');

        const updateCustomers = () => {
            const query = customerSearch.value.trim().toLocaleLowerCase('id');
            let visibleCount = 0;

            customerRows.forEach((row) => {
                const matchesName = row.dataset.customerName.includes(query);
                const matchesPoints = customerFilter.value === 'all' || row.dataset.customerPoints === customerFilter.value;
                row.hidden = !matchesName || !matchesPoints;
                visibleCount += Number(!row.hidden);
            });

            customerNoResults.hidden = visibleCount > 0 || customerRows.length === 0;
        };

        customerSearch?.addEventListener('input', updateCustomers);
        customerFilter?.addEventListener('change', updateCustomers);
    </script>
@endsection
