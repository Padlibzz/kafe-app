@extends('admin.layout')

@section('title', 'Loyalty')

@section('content')
    <style>
        main.content:has(.loyalty-page) { max-width:none; padding:28px 34px 42px; }
        .loyalty-page { max-width:1360px; margin:auto; }
        .loyalty-head { display:flex; align-items:flex-end; justify-content:space-between; gap:20px; margin-bottom:20px; }
        .loyalty-eyebrow { margin:0 0 7px; color:var(--muted); font-size:10px; font-weight:750; letter-spacing:.11em; text-transform:uppercase; }
        .loyalty-head h1 { font:700 30px/1.15 Georgia,serif; }
        .loyalty-head p:last-child { margin:7px 0 0; color:var(--muted); font-size:13px; }
        .loyalty-head-link { display:inline-flex; align-items:center; min-height:42px; padding:0 14px; color:var(--coffee); background:var(--paper); border:1px solid var(--line); border-radius:8px; font-size:11px; font-weight:700; white-space:nowrap; }
        .loyalty-tabs { display:flex; gap:4px; overflow-x:auto; padding:5px; margin-bottom:17px; background:#eee7df; border-radius:10px; }
        .loyalty-tabs a { display:inline-flex; align-items:center; min-height:39px; padding:0 15px; color:#6c5c4d; border-radius:7px; font-size:11px; font-weight:650; white-space:nowrap; }
        .loyalty-tabs a[aria-current="page"] { color:#fff; background:var(--coffee); }
        .loyalty-overview { display:grid; grid-template-columns:minmax(0,1.5fr) repeat(3,minmax(130px,.7fr)); gap:11px; margin-bottom:16px; }
        .loyalty-program,.loyalty-stat,.loyalty-panel { background:var(--paper); border:1px solid var(--line); border-radius:12px; }
        .loyalty-program { display:flex; justify-content:space-between; align-items:center; gap:18px; min-height:112px; padding:18px 20px; color:#fff8ef; background:#483323; border-color:#483323; }
        .loyalty-program-label { color:#e5cba8; font-size:9px; font-weight:750; letter-spacing:.12em; text-transform:uppercase; }
        .loyalty-program h2 { margin:7px 0 0; font:700 20px/1.2 Georgia,serif; }
        .loyalty-program p { margin:5px 0 0; color:#d8c7b5; font-size:10px; }
        .loyalty-program-total { text-align:right; white-space:nowrap; }
        .loyalty-program-total strong { display:block; font:700 27px/1 Georgia,serif; }
        .loyalty-program-total span { display:block; margin-top:5px; color:#d8c7b5; font-size:10px; }
        .loyalty-stat { display:flex; flex-direction:column; justify-content:center; min-height:112px; padding:15px 16px; }
        .loyalty-stat-label { color:var(--muted); font-size:9px; font-weight:750; letter-spacing:.08em; text-transform:uppercase; }
        .loyalty-stat-value { margin-top:8px; font:700 23px/1.1 Georgia,serif; }
        .loyalty-stat-note { margin-top:5px; color:var(--muted); font-size:10px; }
        .loyalty-rule-grid { display:grid; grid-template-columns:minmax(0,1.55fr) minmax(260px,.75fr); gap:14px; align-items:start; }
        .loyalty-panel { overflow:hidden; }
        .loyalty-panel-header { display:flex; justify-content:space-between; align-items:center; gap:12px; padding:16px 18px; border-bottom:1px solid var(--line); }
        .loyalty-panel-header h2 { margin:0; font:700 16px Georgia,serif; }
        .loyalty-panel-header p { margin:5px 0 0; color:var(--muted); font-size:10px; }
        .loyalty-count { color:var(--muted); font-size:10px; white-space:nowrap; }
        .loyalty-table-wrap { overflow-x:auto; }
        .loyalty-table { width:100%; min-width:560px; border-collapse:collapse; text-align:left; }
        .loyalty-table th { padding:11px 14px; color:var(--muted); background:#fbf8f3; border-bottom:1px solid var(--line); font-size:9px; letter-spacing:.07em; text-transform:uppercase; white-space:nowrap; }
        .loyalty-table td { padding:12px 14px; border-bottom:1px solid #eee7df; vertical-align:middle; font-size:11px; }
        .loyalty-table tbody tr:last-child td { border-bottom:0; }
        .loyalty-rule-name { font-size:11px; font-weight:700; }
        .loyalty-rule-description { max-width:320px; margin-top:3px; color:var(--muted); font-size:10px; line-height:1.4; }
        .loyalty-number { font-size:12px!important; font-weight:750; white-space:nowrap; }
        .loyalty-summary-list { display:grid; }
        .loyalty-summary-row { display:flex; justify-content:space-between; align-items:center; gap:12px; padding:13px 17px; border-bottom:1px solid #eee7df; font-size:11px; }
        .loyalty-summary-row:last-child { border-bottom:0; }
        .loyalty-summary-row span { color:var(--muted); }
        .loyalty-summary-row strong { font-size:13px; }
        .loyalty-history { margin-top:15px; }
        .loyalty-status { display:inline-flex; align-items:center; padding:4px 8px; color:#795a3b; background:#f5eee5; border-radius:999px; font-size:9px; font-weight:700; white-space:nowrap; }
        .loyalty-status.is-positive,.loyalty-status.is-used { color:#526b48; background:#edf3e9; }
        .loyalty-empty { padding:25px!important; color:var(--muted); text-align:center; }
        .loyalty-note { margin-top:14px; padding:12px 14px; color:#69563f; background:#f7f2ea; border-radius:9px; font-size:10px; line-height:1.5; }
        .pagination { margin-top:14px; }
        @media(max-width:1050px) { .loyalty-overview { grid-template-columns:repeat(3,minmax(0,1fr)); } .loyalty-program { grid-column:1/-1; } }
        @media(max-width:850px) { .loyalty-rule-grid { grid-template-columns:1fr; } }
        @media(max-width:760px) { main.content:has(.loyalty-page) { padding:23px 17px 32px; } .loyalty-head { align-items:flex-start; flex-direction:column; } .loyalty-head h1 { font-size:27px; } .loyalty-head-link { width:100%; justify-content:center; } .loyalty-overview { grid-template-columns:1fr 1fr; gap:8px; } .loyalty-program { grid-column:1/-1; } .loyalty-stat { min-height:92px; padding:12px; } .loyalty-stat-value { font-size:21px; } .loyalty-panel-header { align-items:flex-start; } }
        @media(max-width:420px) { .loyalty-program { align-items:flex-start; flex-direction:column; gap:12px; } .loyalty-program-total { text-align:left; } .loyalty-overview { grid-template-columns:1fr 1fr; } }
    </style>

    <div class="loyalty-page">
        <header class="loyalty-head">
            <div><p class="loyalty-eyebrow">CRM · program loyalitas</p><h1>Aturan Poin &amp; Loyalty</h1><p>Atur cara poin diperoleh dan pantau aktivitas program pelanggan.</p></div>
            <a class="loyalty-head-link" href="{{ route('admin.customers') }}">Lihat database pelanggan <span aria-hidden="true">&nbsp;→</span></a>
        </header>

        <nav class="loyalty-tabs" aria-label="Bagian program loyalty">
            <a href="#loyalty-rules" aria-current="page">Aturan poin</a>
            <a href="#loyalty-points-history">Riwayat poin</a>
            <a href="#loyalty-rewards-history">Penukaran reward</a>
        </nav>

        <section class="loyalty-overview" aria-label="Ringkasan loyalty">
            <article class="loyalty-program"><div><div class="loyalty-program-label">Chōgō · Member points</div><h2>Program poin pelanggan</h2><p>Poin per transaksi dan minimum tercatat</p></div><div class="loyalty-program-total"><strong>{{ number_format($rules->total(), 0, ',', '.') }}</strong><span>aturan tersimpan</span></div></article>
            <article class="loyalty-stat"><span class="loyalty-stat-label">Poin per transaksi</span><strong class="loyalty-stat-value">{{ $rules->count() ? number_format((int) $rules->max('poin_per_transaksi'), 0, ',', '.') : '—' }}</strong><span class="loyalty-stat-note">Nilai tertinggi pada halaman ini</span></article>
            <article class="loyalty-stat"><span class="loyalty-stat-label">Minimum poin</span><strong class="loyalty-stat-value">{{ $rules->count() ? number_format((int) $rules->min('minimal_poin'), 0, ',', '.') : '—' }}</strong><span class="loyalty-stat-note">Nilai terendah pada halaman ini</span></article>
            <article class="loyalty-stat"><span class="loyalty-stat-label">Reward tercatat</span><strong class="loyalty-stat-value">{{ number_format((int) $rewardSummary->sum(), 0, ',', '.') }}</strong><span class="loyalty-stat-note">Semua status penukaran</span></article>
        </section>

        <div class="loyalty-rule-grid">
            <section class="loyalty-panel" id="loyalty-rules" aria-labelledby="loyalty-rules-title">
                <header class="loyalty-panel-header"><div><h2 id="loyalty-rules-title">Aturan perolehan poin</h2><p>Daftar aturan yang tersimpan pada sistem.</p></div><span class="loyalty-count">{{ number_format($rules->total(), 0, ',', '.') }} aturan</span></header>
                <div class="loyalty-table-wrap"><table class="loyalty-table"><thead><tr><th>Nama aturan</th><th>Poin / transaksi</th><th>Minimum</th></tr></thead><tbody>
                    @forelse ($rules as $rule)
                        <tr><td><div class="loyalty-rule-name">{{ $rule->nama }}</div><div class="loyalty-rule-description">{{ $rule->deskripsi ?: 'Tidak ada deskripsi.' }}</div></td><td class="loyalty-number">{{ number_format($rule->poin_per_transaksi, 0, ',', '.') }}</td><td class="loyalty-number">{{ number_format($rule->minimal_poin, 0, ',', '.') }}</td></tr>
                    @empty
                        <tr><td class="loyalty-empty" colspan="3">Belum ada aturan poin yang tersimpan.</td></tr>
                    @endforelse
                </tbody></table></div>
                <div class="pagination">{{ $rules->links() }}</div>
            </section>

            <aside class="loyalty-panel" aria-labelledby="loyalty-redemptions-title">
                <header class="loyalty-panel-header"><div><h2 id="loyalty-redemptions-title">Status penukaran</h2><p>Jumlah reward per status</p></div></header>
                <div class="loyalty-summary-list">
                    <div class="loyalty-summary-row"><span>Menunggu</span><strong>{{ number_format((int) ($rewardSummary['pending'] ?? 0), 0, ',', '.') }}</strong></div>
                    <div class="loyalty-summary-row"><span>Digunakan</span><strong>{{ number_format((int) ($rewardSummary['digunakan'] ?? 0), 0, ',', '.') }}</strong></div>
                    <div class="loyalty-summary-row"><span>Kedaluwarsa</span><strong>{{ number_format((int) ($rewardSummary['kadaluarsa'] ?? 0), 0, ',', '.') }}</strong></div>
                </div>
                <div class="loyalty-note" style="margin:12px">Tier member dan katalog reward bernama belum tersedia. Status di atas berasal dari catatan penukaran yang tersimpan.</div>
            </aside>
        </div>

        <section class="loyalty-panel loyalty-history" id="loyalty-points-history" aria-labelledby="loyalty-points-history-title">
            <header class="loyalty-panel-header"><div><h2 id="loyalty-points-history-title">Aktivitas poin terbaru</h2><p>Delapan catatan terakhir dari riwayat pelanggan.</p></div></header>
            <div class="loyalty-table-wrap"><table class="loyalty-table"><thead><tr><th>Pelanggan</th><th>Aktivitas</th><th>Poin</th><th>Keterangan</th><th>Waktu</th></tr></thead><tbody>
                @forelse ($pointHistory as $entry)
                    <tr><td>{{ $entry->customer?->nama ?? 'Pelanggan tidak tersedia' }}</td><td><span class="loyalty-status {{ $entry->tipe === 'tambah' ? 'is-positive' : '' }}">{{ $entry->tipe === 'tambah' ? 'Poin masuk' : 'Poin keluar' }}</span></td><td class="loyalty-number">{{ number_format($entry->poin, 0, ',', '.') }}</td><td>{{ $entry->keterangan ?: $entry->aturanLoyalty?->nama ?: ($entry->reward ? 'Penukaran reward' : '—') }}</td><td>{{ $entry->created_at?->format('d/m/Y H:i') ?? '—' }}</td></tr>
                @empty
                    <tr><td class="loyalty-empty" colspan="5">Belum ada aktivitas poin.</td></tr>
                @endforelse
            </tbody></table></div>
        </section>

        <section class="loyalty-panel loyalty-history" id="loyalty-rewards-history" aria-labelledby="loyalty-rewards-history-title">
            <header class="loyalty-panel-header"><div><h2 id="loyalty-rewards-history-title">Riwayat penukaran reward</h2><p>Delapan catatan penukaran terakhir.</p></div></header>
            <div class="loyalty-table-wrap"><table class="loyalty-table"><thead><tr><th>Pelanggan</th><th>Aturan terkait</th><th>Poin digunakan</th><th>Status</th><th>Waktu</th></tr></thead><tbody>
                @forelse ($rewardHistory as $reward)
                    <tr><td>{{ $reward->customer?->nama ?? 'Pelanggan tidak tersedia' }}</td><td>{{ $reward->aturanLoyalty?->nama ?? 'Aturan tidak tersedia' }}</td><td class="loyalty-number">{{ number_format($reward->poin_digunakan, 0, ',', '.') }}</td><td><span class="loyalty-status {{ $reward->status === 'digunakan' ? 'is-used' : '' }}">{{ ['pending' => 'Menunggu', 'digunakan' => 'Digunakan', 'kadaluarsa' => 'Kedaluwarsa'][$reward->status] ?? $reward->status }}</span></td><td>{{ $reward->created_at?->format('d/m/Y H:i') ?? '—' }}</td></tr>
                @empty
                    <tr><td class="loyalty-empty" colspan="5">Belum ada penukaran reward.</td></tr>
                @endforelse
            </tbody></table></div>
        </section>
    </div>
@endsection
