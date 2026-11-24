@extends('admin.layout')

@section('title', 'Loyalty')

@section('content')
    <style>
        main.content:has(.loyalty-page) { max-width:none; padding:30px 34px; }
        .loyalty-page { max-width:1320px; margin:auto; }
        .loyalty-head { margin-bottom:20px; }
        .loyalty-eyebrow { margin:0 0 8px; color:var(--muted); font-size:10px; font-weight:750; letter-spacing:.1em; text-transform:uppercase; }
        .loyalty-head h1 { font:700 30px/1.15 Georgia,serif; }
        .loyalty-head p:last-child { margin:7px 0 0; color:var(--muted); font-size:13px; }
        .loyalty-summary { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:12px; margin-bottom:16px; }
        .loyalty-stat,.loyalty-panel { background:var(--paper); border:1px solid var(--line); border-radius:12px; }
        .loyalty-stat { padding:16px 18px; }
        .loyalty-stat span { color:var(--muted); font-size:9px; font-weight:750; letter-spacing:.08em; text-transform:uppercase; }
        .loyalty-stat strong { display:block; margin-top:8px; font:700 24px Georgia,serif; }
        .loyalty-layout { display:grid; grid-template-columns:minmax(0,1fr) 300px; gap:14px; align-items:start; }
        .loyalty-panel { overflow:hidden; }
        .loyalty-panel-head { padding:15px 17px; border-bottom:1px solid var(--line); }
        .loyalty-panel-head h2 { margin:0; font:700 16px Georgia,serif; }
        .loyalty-panel-head p { margin:5px 0 0; color:var(--muted); font-size:11px; }
        .loyalty-table-wrap { overflow-x:auto; }
        .loyalty-table { width:100%; min-width:570px; border-collapse:collapse; text-align:left; }
        .loyalty-table th { padding:11px 14px; color:var(--muted); background:#fbf8f3; border-bottom:1px solid var(--line); font-size:9px; letter-spacing:.07em; text-transform:uppercase; }
        .loyalty-table td { padding:13px 14px; border-bottom:1px solid #eee7df; vertical-align:top; }
        .loyalty-table tbody tr:last-child td { border-bottom:0; }
        .loyalty-rule-name { font-size:12px; font-weight:700; }
        .loyalty-rule-description { max-width:340px; margin-top:4px; color:var(--muted); font-size:10px; line-height:1.45; }
        .loyalty-points { white-space:nowrap; font-size:12px; font-weight:750; }
        .loyalty-note { padding:16px; color:#69563f; background:#f7f2ea; border-radius:9px; font-size:11px; line-height:1.55; }
        .loyalty-section { margin-top:16px; }
        .loyalty-status { display:inline-flex; padding:4px 8px; color:#69563f; background:#f5eee5; border-radius:999px; font-size:10px; font-weight:700; white-space:nowrap; }
        .loyalty-status.used { color:#526b48; background:#edf3e9; }
        .loyalty-subnav { display:flex; gap:8px; margin-bottom:16px; }
        .loyalty-subnav a { display:inline-flex; align-items:center; min-height:40px; padding:0 13px; color:var(--coffee); background:var(--paper); border:1px solid var(--line); border-radius:8px; font-size:11px; font-weight:650; }
        .loyalty-empty { padding:26px!important; color:var(--muted); text-align:center; }
        .pagination { margin-top:15px; }
        @media(max-width:900px) { .loyalty-layout { grid-template-columns:1fr; } }
        @media(max-width:760px) { main.content:has(.loyalty-page) { padding:24px 17px; } .loyalty-head h1 { font-size:27px; } .loyalty-summary { grid-template-columns:1fr; gap:8px; } .loyalty-stat { padding:13px 15px; } .loyalty-stat strong { font-size:21px; } }
    </style>

    <div class="loyalty-page">
        <header class="loyalty-head"><p class="loyalty-eyebrow">CRM &amp; program poin</p><h1>Aturan Poin &amp; Loyalty</h1><p>Aturan perolehan poin yang saat ini tersimpan di sistem.</p></header>
        <nav class="loyalty-subnav" aria-label="Navigasi loyalty"><a href="#point-rules">Aturan poin</a><a href="#point-history">Riwayat poin</a><a href="#reward-history">Riwayat reward</a></nav>
        <section class="loyalty-summary" aria-label="Ringkasan aturan poin">
            <article class="loyalty-stat"><span>Aturan terdaftar</span><strong>{{ number_format($rules->total(), 0, ',', '.') }}</strong></article>
            <article class="loyalty-stat"><span>Poin tertinggi per transaksi</span><strong>{{ $rules->count() ? number_format((int) $rules->max('poin_per_transaksi'), 0, ',', '.') : '—' }}</strong></article>
            <article class="loyalty-stat"><span>Minimum poin</span><strong>{{ $rules->count() ? number_format((int) $rules->min('minimal_poin'), 0, ',', '.') : '—' }}</strong></article>
        </section>
        <div class="loyalty-layout">
            <section class="loyalty-panel" id="point-rules" aria-labelledby="loyalty-rules-title">
                <header class="loyalty-panel-head"><h2 id="loyalty-rules-title">Aturan yang Berlaku</h2><p>{{ $rules->count() }} aturan pada halaman ini</p></header>
                <div class="loyalty-table-wrap"><table class="loyalty-table"><thead><tr><th>Aturan</th><th>Poin / Transaksi</th><th>Minimum Poin</th></tr></thead><tbody>
                    @forelse ($rules as $rule)
                        <tr><td><div class="loyalty-rule-name">{{ $rule->nama }}</div><div class="loyalty-rule-description">{{ $rule->deskripsi ?: 'Tidak ada deskripsi.' }}</div></td><td class="loyalty-points">{{ number_format($rule->poin_per_transaksi, 0, ',', '.') }}</td><td class="loyalty-points">{{ number_format($rule->minimal_poin, 0, ',', '.') }}</td></tr>
                    @empty
                        <tr><td class="loyalty-empty" colspan="3">Belum ada aturan poin.</td></tr>
                    @endforelse
                </tbody></table></div>
            </section>
            <aside class="loyalty-panel"><header class="loyalty-panel-head"><h2>Penukaran Reward</h2><p>Status penukaran yang tercatat</p></header><div class="loyalty-table-wrap"><table class="loyalty-table" style="min-width:260px"><thead><tr><th>Status</th><th>Jumlah</th></tr></thead><tbody><tr><td>Menunggu</td><td class="loyalty-points">{{ number_format((int) ($rewardSummary['pending'] ?? 0), 0, ',', '.') }}</td></tr><tr><td>Digunakan</td><td class="loyalty-points">{{ number_format((int) ($rewardSummary['digunakan'] ?? 0), 0, ',', '.') }}</td></tr><tr><td>Kedaluwarsa</td><td class="loyalty-points">{{ number_format((int) ($rewardSummary['kadaluarsa'] ?? 0), 0, ',', '.') }}</td></tr></tbody></table></div></aside>
        </div>
        <div class="pagination">{{ $rules->links() }}</div>

        <section class="loyalty-panel loyalty-section" id="point-history" aria-labelledby="point-history-title">
            <header class="loyalty-panel-head"><h2 id="point-history-title">Riwayat Poin Terbaru</h2><p>Maksimal 8 aktivitas terakhir. Tidak ada perubahan saldo dari halaman ini.</p></header>
            <div class="loyalty-table-wrap"><table class="loyalty-table"><thead><tr><th>Pelanggan</th><th>Jenis</th><th>Poin</th><th>Keterangan</th><th>Waktu</th></tr></thead><tbody>
                @forelse ($pointHistory as $entry)
                    <tr><td>{{ $entry->customer?->nama ?? 'Pelanggan tidak tersedia' }}</td><td><span class="loyalty-status {{ $entry->tipe === 'tambah' ? 'used' : '' }}">{{ $entry->tipe === 'tambah' ? 'Poin masuk' : 'Poin keluar' }}</span></td><td class="loyalty-points">{{ number_format($entry->poin, 0, ',', '.') }}</td><td>{{ $entry->keterangan ?: $entry->aturanLoyalty?->nama ?: ($entry->reward ? 'Penukaran reward' : '—') }}</td><td>{{ $entry->created_at?->format('d/m/Y H:i') ?? '—' }}</td></tr>
                @empty
                    <tr><td class="loyalty-empty" colspan="5">Belum ada riwayat poin.</td></tr>
                @endforelse
            </tbody></table></div>
        </section>

        <section class="loyalty-panel loyalty-section" id="reward-history" aria-labelledby="reward-history-title">
            <header class="loyalty-panel-head"><h2 id="reward-history-title">Riwayat Penukaran Reward</h2><p>Nama aturan terhubung ditampilkan sebagai label reward karena katalog reward belum memiliki nama sendiri.</p></header>
            <div class="loyalty-table-wrap"><table class="loyalty-table"><thead><tr><th>Pelanggan</th><th>Reward / aturan</th><th>Poin digunakan</th><th>Status</th><th>Waktu</th></tr></thead><tbody>
                @forelse ($rewardHistory as $reward)
                    <tr><td>{{ $reward->customer?->nama ?? 'Pelanggan tidak tersedia' }}</td><td>{{ $reward->aturanLoyalty?->nama ?? 'Aturan tidak tersedia' }}</td><td class="loyalty-points">{{ number_format($reward->poin_digunakan, 0, ',', '.') }}</td><td><span class="loyalty-status {{ $reward->status === 'digunakan' ? 'used' : '' }}">{{ ['pending' => 'Menunggu', 'digunakan' => 'Digunakan', 'kadaluarsa' => 'Kedaluwarsa'][$reward->status] ?? $reward->status }}</span></td><td>{{ $reward->created_at?->format('d/m/Y H:i') ?? '—' }}</td></tr>
                @empty
                    <tr><td class="loyalty-empty" colspan="5">Belum ada penukaran reward.</td></tr>
                @endforelse
            </tbody></table></div>
        </section>
    </div>
@endsection
