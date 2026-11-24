@extends('admin.layout')


@section('title', 'KDS')

@section('content')
    <style>
        main.content:has(.kds-head) { max-width:none; padding:24px; }
        .kds-head { display:flex; align-items:center; justify-content:space-between; gap:20px; margin-bottom:20px; }
        .kds-head h1 { font-size:27px; }
        .kds-live { color:#56704e; font-size:12px; font-weight:700; }
        .kds-counts { display:flex; flex-wrap:wrap; gap:8px; margin-top:10px; color:var(--muted); font-size:12px; }
        .kds-counts > span { padding:7px 11px; background:#fffdf9; border:1px solid var(--line); border-radius:999px; }
        .kds-filter { display:flex; flex-wrap:wrap; gap:7px; margin-bottom:18px; }
        .kds-filter a,.kds-filter button { padding:7px 10px; border:0; border-radius:999px; color:var(--muted); background:transparent; font:inherit; font-size:12px; cursor:pointer; }
        .kds-filter a.active { color:#fff; background:var(--coffee); }
        .kds-filter a[aria-current="page"] { color:#fff; background:var(--coffee); }
        .kds-filter a:focus-visible,.kds-action:focus-visible { outline:3px solid #98663e; outline-offset:2px; }
        .kds-action { display:block; width:100%; margin-top:12px; padding:9px; border:0; border-radius:8px; color:white; background:var(--coffee); font:inherit; font-size:12px; font-weight:650; cursor:pointer; }
        .kds-action:hover { background:#503622; }
        .kds-board { display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:14px; align-items:start; }
        .kds-lane { min-height:300px; padding:12px; background:#eee8df; border-radius:13px; }
        .kds-lane h2 { display:flex; justify-content:space-between; gap:10px; margin:0 0 12px; font-size:14px; }
        .kds-lane h2 span { color:var(--muted); font-size:11px; font-weight:500; }
        .kds-card { margin-bottom:10px; padding:13px; background:var(--paper); border:1px solid var(--line); border-radius:11px; }
        .kds-order-head { display:flex; justify-content:space-between; gap:8px; font-size:12px; }
        .kds-order-head strong { font-size:14px; }
        .kds-meta { margin:5px 0 10px; color:var(--muted); font-size:11px; }
        .kds-item { padding:8px 0; border-top:1px solid #eee7df; font-size:12px; }
        .kds-item strong { display:block; }
        .kds-note { display:block; margin-top:3px; color:var(--muted); font-size:11px; }
        .kds-empty { color:var(--muted); font-size:12px; }
        .kds-toast { margin-bottom:14px; padding:10px 13px; color:#365b35; background:#edf5e9; border-radius:9px; }
        @media(max-width:1200px) { .kds-board { grid-template-columns:repeat(2,minmax(0,1fr)); } }
        @media(max-width:620px) { main.content:has(.kds-head) { padding:20px 14px; } .kds-head { align-items:flex-start; flex-direction:column; } .kds-board { grid-template-columns:1fr; } }
    </style>
    @if (session('status'))<div class="kds-toast" role="status">{{ session('status') }}</div>@endif
    @php
        $lanes = [
            'pending' => 'Pesanan Masuk',
            'dibuat' => 'Pesanan Dibuat',
            'diproses' => 'Proses Dapur & Barista',
            'dibayar' => 'Siap Saji / Ambil',
            'selesai' => 'Selesai Hari Ini',
        ];
        $counts = $statusCounts;
        $activeFilter = request('status', 'semua');
    @endphp
    <div class="kds-head">
        <div>
            <h1>Live KDS Display</h1>
            <div class="kds-counts"><span><span class="kds-live">● LIVE</span> · KITCHEN &amp; BAR</span><span>{{ $counts->get('pending', 0) + $counts->get('dibuat', 0) }} pesanan antre</span><span>{{ $counts->get('diproses', 0) }} sedang diproses</span><span>{{ $counts->get('dibayar', 0) }} siap saji</span></div>
        </div>
        <span class="kds-live">Diperbarui {{ now()->format('H:i') }}</span>
    </div>
    <nav class="kds-filter" aria-label="Filter pesanan KDS">
        <a class="{{ $activeFilter === 'semua' ? 'active' : '' }}" @if ($activeFilter === 'semua') aria-current="page" @endif href="{{ route('admin.kds') }}">Semua Pesanan ({{ $statusCounts->sum() }})</a>
        @foreach (['pending' => 'Pesanan Masuk', 'diproses' => 'Sedang Diproses', 'dibayar' => 'Siap Saji', 'selesai' => 'Selesai Hari Ini'] as $filterStatus => $filterLabel)
            <a class="{{ $activeFilter === $filterStatus ? 'active' : '' }}" @if ($activeFilter === $filterStatus) aria-current="page" @endif href="{{ route('admin.kds', ['status' => $filterStatus]) }}">{{ $filterLabel }} ({{ $counts->get($filterStatus, 0) }})</a>
        @endforeach
        <a href="{{ route('admin.kds', array_filter(['sort' => request('sort') === 'baru' ? 'lama' : 'baru', 'status' => request('status')])) }}">Urutan {{ request('sort') === 'baru' ? 'Terbaru' : 'Terlama (FIFO)' }}</a>
    </nav>
    <div class="kds-board">
        @foreach ($lanes as $status => $label)
            <section class="kds-lane" aria-label="{{ $label }}">
                <h2>{{ $label }} <span>{{ $counts->get($status, 0) }} pesanan</span></h2>
                @if ($activeFilter === 'semua' || $activeFilter === $status)
                @forelse ($orders->where('status', $status) as $order)
                    <article class="kds-card">
                        <div class="kds-order-head"><strong>#CHG-{{ $order->id }}</strong><span>{{ $order->created_at?->format('H:i') }}</span></div>
                        <div class="kds-meta">{{ $order->meja?->nomor_meja ? 'Meja '.$order->meja->nomor_meja : 'Takeaway' }} · {{ $order->customer?->nama ?? 'Pesanan POS' }}</div>
                        @foreach ($order->detailPesanan as $detail)
                            <div class="kds-item"><strong>{{ $detail->jumlah }}× {{ $detail->menu?->nama_menu ?? 'Menu dihapus' }}</strong>
                                @if ($order->catatan)<span class="kds-note">Catatan: {{ $order->catatan }}</span>@endif
                            </div>
                        @endforeach
                        @if ($order->status === 'pending' || $order->status === 'dibuat')
                            <form method="POST" action="{{ route('admin.kds.transition', $order) }}">@csrf @method('PATCH')<button class="kds-action" type="submit">Mulai Proses</button></form>
                        @elseif ($order->status === 'diproses')
                            <form method="POST" action="{{ route('admin.kds.transition', $order) }}">@csrf @method('PATCH')<button class="kds-action" type="submit">Tandai Siap Saji</button></form>
                        @elseif ($order->status === 'dibayar')
                            <form method="POST" action="{{ route('admin.kds.transition', $order) }}">@csrf @method('PATCH')<button class="kds-action" type="submit">Selesaikan Pesanan</button></form>
                        @endif
                    </article>
                @empty
                    <p class="kds-empty">Belum ada pesanan.</p>
                @endforelse
                @else
                    <p class="kds-empty">Gunakan filter untuk melihat pesanan.</p>
                @endif
            </section>
        @endforeach
    </div>
    <script>setTimeout(() => window.location.reload(), 30000);</script>
@endsection
