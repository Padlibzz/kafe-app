@extends('admin.layout')

@section('title', 'Dashboard Utama')

@section('content')
    <style>
        main.content:has(.dashboard-page) { max-width:none; padding:30px 34px; }
        .dashboard-page { max-width:1440px; margin:auto; }
        .dashboard-head { display:flex; align-items:flex-end; justify-content:space-between; gap:20px; margin-bottom:21px; }
        .dashboard-eyebrow { margin:0 0 7px; color:var(--muted); font-size:10px; font-weight:750; letter-spacing:.1em; text-transform:uppercase; }
        .dashboard-head h1 { font:700 30px/1.15 Georgia,serif; }
        .dashboard-head p:last-child { margin:7px 0 0; color:var(--muted); font-size:13px; }
        .dashboard-date { color:var(--muted); font-size:11px; white-space:nowrap; }
        .dashboard-stats { display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:12px; margin-bottom:17px; }
        .dashboard-stat,.dashboard-panel { background:var(--paper); border:1px solid var(--line); border-radius:12px; }
        .dashboard-stat { padding:16px 17px; }
        .dashboard-label { color:var(--muted); font-size:9px; font-weight:750; letter-spacing:.09em; text-transform:uppercase; }
        .dashboard-value { margin-top:10px; font:700 25px/1.1 Georgia,serif; }
        .dashboard-note { margin-top:6px; color:var(--muted); font-size:10px; }
        .dashboard-columns { display:grid; grid-template-columns:minmax(0,1.5fr) minmax(260px,1fr); gap:14px; }
        .dashboard-panel { overflow:hidden; }
        .dashboard-panel-head { display:flex; justify-content:space-between; align-items:center; gap:12px; padding:15px 17px; border-bottom:1px solid var(--line); }
        .dashboard-panel-head h2 { margin:0; font:700 15px Georgia,serif; }
        .dashboard-panel-head a { color:var(--coffee); font-size:11px; font-weight:700; }
        .dashboard-order-list { display:grid; }
        .dashboard-order { display:grid; grid-template-columns:1fr auto; gap:8px 12px; padding:12px 17px; border-bottom:1px solid #eee7df; }
        .dashboard-order:last-child { border-bottom:0; }
        .dashboard-order strong { font-size:11px; }
        .dashboard-order small { color:var(--muted); font-size:10px; }
        .dashboard-order-total { font-size:11px; font-weight:750; white-space:nowrap; }
        .dashboard-order-status { justify-self:end; color:#69563f; font-size:10px; }
        .dashboard-list { display:grid; gap:0; }
        .dashboard-list-item { display:flex; justify-content:space-between; gap:12px; padding:12px 17px; border-bottom:1px solid #eee7df; font-size:11px; }
        .dashboard-list-item:last-child { border-bottom:0; }
        .dashboard-list-item strong { font-weight:650; }
        .dashboard-list-item span { color:var(--muted); }
        .dashboard-empty { padding:22px 17px; color:var(--muted); font-size:11px; }
        .dashboard-shortcuts { display:flex; flex-wrap:wrap; gap:8px; margin-top:14px; }
        .dashboard-shortcuts a { display:inline-flex; align-items:center; min-height:40px; padding:0 12px; color:var(--coffee); background:var(--paper); border:1px solid var(--line); border-radius:8px; font-size:11px; font-weight:650; }
        @media(max-width:1050px) { .dashboard-stats { grid-template-columns:repeat(2,minmax(0,1fr)); } }
        @media(max-width:760px) { main.content:has(.dashboard-page) { padding:24px 17px; } .dashboard-head { align-items:flex-start; flex-direction:column; } .dashboard-head h1 { font-size:27px; } .dashboard-columns { grid-template-columns:1fr; } }
        @media(max-width:440px) { .dashboard-stats { grid-template-columns:1fr; gap:8px; } .dashboard-stat { padding:13px 15px; } .dashboard-value { font-size:22px; } }
    </style>

    @php($statusLabels = ['pending' => 'Menunggu', 'dibuat' => 'Dibuat', 'dibayar' => 'Dibayar', 'diproses' => 'Diproses', 'selesai' => 'Selesai', 'dibatalkan' => 'Dibatalkan'])
    <div class="dashboard-page">
        <header class="dashboard-head">
            <div><p class="dashboard-eyebrow">Ringkasan operasional · Chōgō Coffee</p><h1>Dashboard Utama</h1><p>Ringkasan penjualan dan aktivitas yang tercatat hari ini.</p></div>
            <span class="dashboard-date">{{ now()->translatedFormat('l, d F Y') }}</span>
        </header>

        <section class="dashboard-stats" aria-label="Ringkasan hari ini">
            <article class="dashboard-stat"><div class="dashboard-label">Pendapatan Tercatat</div><div class="dashboard-value">Rp{{ number_format((float) $todayRevenue, 0, ',', '.') }}</div><div class="dashboard-note">Dari pesanan dibayar, diproses, dan selesai hari ini.</div></article>
            <article class="dashboard-stat"><div class="dashboard-label">Pesanan Hari Ini</div><div class="dashboard-value">{{ number_format((int) $orderCounts->sum(), 0, ',', '.') }}</div><div class="dashboard-note">Semua status pesanan hari ini.</div></article>
            <article class="dashboard-stat"><div class="dashboard-label">Sedang Berjalan</div><div class="dashboard-value">{{ number_format((int) ($orderCounts['pending'] ?? 0) + ($orderCounts['dibuat'] ?? 0) + ($orderCounts['dibayar'] ?? 0) + ($orderCounts['diproses'] ?? 0), 0, ',', '.') }}</div><div class="dashboard-note">Menunggu, dibuat, dibayar, atau diproses.</div></article>
            <article class="dashboard-stat"><div class="dashboard-label">Menu Tidak Tersedia</div><div class="dashboard-value">{{ number_format($unavailableMenuCount, 0, ',', '.') }}</div><div class="dashboard-note">Menu yang ditandai tidak tersedia.</div></article>
        </section>

        <div class="dashboard-columns">
            <section class="dashboard-panel" aria-labelledby="dashboard-orders-title">
                <header class="dashboard-panel-head"><h2 id="dashboard-orders-title">Pesanan Terbaru</h2><a href="{{ route('admin.orders') }}">Lihat semua →</a></header>
                <div class="dashboard-order-list">
                    @forelse ($latestOrders as $order)
                        <article class="dashboard-order"><div><strong>#{{ $order->id }} · {{ $order->customer?->nama ?? 'Pelanggan umum' }}</strong><br><small>{{ $order->meja?->nomor_meja ?? 'Tanpa meja' }} · {{ $order->created_at?->format('H:i') }}</small></div><div class="dashboard-order-total">Rp{{ number_format((float) $order->total_harga, 0, ',', '.') }}<br><span class="dashboard-order-status">{{ $statusLabels[$order->status] ?? $order->status }}</span></div></article>
                    @empty
                        <div class="dashboard-empty">Belum ada pesanan hari ini.</div>
                    @endforelse
                </div>
            </section>

            <section class="dashboard-panel" aria-labelledby="dashboard-bestsellers-title">
                <header class="dashboard-panel-head"><h2 id="dashboard-bestsellers-title">Menu Terjual Hari Ini</h2><a href="{{ route('admin.menus') }}">Buka katalog →</a></header>
                <div class="dashboard-list">
                    @forelse ($topMenus as $menu)
                        <div class="dashboard-list-item"><strong>{{ $menu->nama_menu }}</strong><span>{{ number_format((int) $menu->total_terjual, 0, ',', '.') }} terjual</span></div>
                    @empty
                        <div class="dashboard-empty">Belum ada detail penjualan hari ini.</div>
                    @endforelse
                </div>
            </section>

            <section class="dashboard-panel" aria-labelledby="dashboard-unavailable-title">
                <header class="dashboard-panel-head"><h2 id="dashboard-unavailable-title">Menu Tidak Tersedia</h2><a href="{{ route('admin.menus') }}">Kelola menu →</a></header>
                <div class="dashboard-list">
                    @forelse ($unavailableMenus as $menu)
                        <div class="dashboard-list-item"><strong>{{ $menu->nama_menu }}</strong><a href="{{ route('admin.menus.edit', $menu) }}">Edit</a></div>
                    @empty
                        <div class="dashboard-empty">Tidak ada menu yang ditandai tidak tersedia.</div>
                    @endforelse
                </div>
            </section>
            <section class="dashboard-panel" aria-labelledby="dashboard-shortcuts-title">
                <header class="dashboard-panel-head"><h2 id="dashboard-shortcuts-title">Akses Cepat</h2></header>
                <div class="dashboard-shortcuts"><a href="{{ route('admin.kds') }}">Buka KDS</a><a href="{{ route('admin.tables') }}">Meja &amp; QR</a><a href="{{ route('admin.attendance') }}">Absensi</a><a href="{{ route('admin.finance-reports') }}">Laporan</a></div>
            </section>
        </div>
    </div>
@endsection
