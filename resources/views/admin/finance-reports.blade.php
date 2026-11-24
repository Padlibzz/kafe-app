@extends('admin.layout')

@section('title', 'Laporan keuangan')

@section('content')
    <style>
        main.content:has(.reports-page) { max-width:none; padding:30px 34px; }
        .reports-page { max-width:1320px; margin:auto; }
        .reports-head { display:flex; justify-content:space-between; align-items:flex-end; gap:18px; margin-bottom:20px; }
        .reports-eyebrow { margin:0 0 8px; color:var(--muted); font-size:10px; font-weight:750; letter-spacing:.1em; text-transform:uppercase; }
        .reports-head h1 { font:700 30px/1.15 Georgia,serif; }
        .reports-head p:last-child { margin:7px 0 0; color:var(--muted); font-size:13px; }
        .reports-period { color:var(--muted); font-size:11px; white-space:nowrap; }
        .reports-summary { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:12px; margin-bottom:16px; }
        .reports-stat,.reports-panel { background:var(--paper); border:1px solid var(--line); border-radius:12px; }
        .reports-stat { padding:16px 18px; }
        .reports-stat span { color:var(--muted); font-size:9px; font-weight:750; letter-spacing:.08em; text-transform:uppercase; }
        .reports-stat strong { display:block; margin-top:8px; font:700 22px Georgia,serif; }
        .reports-panel { overflow:hidden; }
        .reports-panel-head { padding:15px 17px; border-bottom:1px solid var(--line); }
        .reports-panel-head h2 { margin:0; font:700 16px Georgia,serif; }
        .reports-panel-head p { margin:5px 0 0; color:var(--muted); font-size:11px; }
        .reports-table-wrap { overflow-x:auto; }
        .reports-table { width:100%; min-width:650px; border-collapse:collapse; text-align:left; }
        .reports-table th { padding:11px 14px; color:var(--muted); background:#fbf8f3; border-bottom:1px solid var(--line); font-size:9px; letter-spacing:.07em; text-transform:uppercase; }
        .reports-table td { padding:13px 14px; border-bottom:1px solid #eee7df; font-size:12px; }
        .reports-table tr:last-child td { border-bottom:0; }
        .reports-amount { font-variant-numeric:tabular-nums; white-space:nowrap; }
        .reports-empty { padding:28px!important; color:var(--muted); text-align:center; }
        .reports-note { margin-top:14px; padding:13px 15px; color:#69563f; background:#f7f2ea; border-radius:9px; font-size:11px; line-height:1.5; }
        .pagination { margin-top:15px; }
        @media(max-width:760px) { main.content:has(.reports-page) { padding:24px 17px; } .reports-head { align-items:flex-start; flex-direction:column; } .reports-head h1 { font-size:27px; } .reports-summary { grid-template-columns:1fr; gap:8px; } .reports-stat { padding:13px 15px; } .reports-stat strong { font-size:20px; } }
    </style>

    @php($reportCount = $reports->total())
    @php($pageRevenue = $reports->getCollection()->sum(fn ($report) => (float) $report->total_pendapatan))
    @php($pageCosts = $reports->getCollection()->sum(fn ($report) => (float) $report->total_biaya))
    <div class="reports-page">
        <header class="reports-head"><div><p class="reports-eyebrow">Analitik · keuangan</p><h1>Laporan Keuangan</h1><p>Rekap periode yang telah disimpan untuk kedai.</p></div><span class="reports-period">{{ number_format($reportCount, 0, ',', '.') }} laporan tersimpan</span></header>
        <section class="reports-summary" aria-label="Ringkasan pada halaman ini">
            <article class="reports-stat"><span>Pendapatan · halaman ini</span><strong>Rp{{ number_format($pageRevenue, 0, ',', '.') }}</strong></article>
            <article class="reports-stat"><span>Biaya · halaman ini</span><strong>Rp{{ number_format($pageCosts, 0, ',', '.') }}</strong></article>
            <article class="reports-stat"><span>Selisih · halaman ini</span><strong>Rp{{ number_format($pageRevenue - $pageCosts, 0, ',', '.') }}</strong></article>
        </section>
        <section class="reports-panel" aria-labelledby="reports-list-title">
            <header class="reports-panel-head"><h2 id="reports-list-title">Riwayat Laporan</h2><p>Nilai ringkasan hanya menjumlahkan laporan pada halaman aktif.</p></header>
            <div class="reports-table-wrap"><table class="reports-table"><thead><tr><th>Periode</th><th>Pendapatan</th><th>Biaya</th><th>Dibuat</th></tr></thead><tbody>
                @forelse ($reports as $report)
                    <tr><td>{{ $report->start_date->format('d/m/Y') }} — {{ $report->end_date->format('d/m/Y') }}</td><td class="reports-amount">Rp{{ number_format((float) $report->total_pendapatan, 0, ',', '.') }}</td><td class="reports-amount">Rp{{ number_format((float) $report->total_biaya, 0, ',', '.') }}</td><td>{{ $report->created_at?->format('d/m/Y H:i') ?? '—' }}</td></tr>
                @empty
                    <tr><td class="reports-empty" colspan="4">Belum ada laporan keuangan tersimpan.</td></tr>
                @endforelse
            </tbody></table></div>
        </section>
        <div class="reports-note">Ini adalah laporan yang tersimpan, bukan rekonsiliasi kas real-time. Rincian sumber transaksi dan audit kas belum tersedia pada data laporan.</div>
        <div class="pagination">{{ $reports->links() }}</div>
    </div>
@endsection
