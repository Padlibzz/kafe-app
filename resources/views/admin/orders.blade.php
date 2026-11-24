@extends('admin.layout')

@section('title', 'Pesanan')

@section('content')
    <div class="page-head"><div><h1>Pesanan</h1><p class="page-subtitle">Pantau pesanan yang masuk ke kedai.</p></div></div>
    <section class="panel" aria-label="Daftar pesanan">
        <table>
            <thead><tr><th>ID</th><th>Waktu</th><th>Pelanggan</th><th>Meja</th><th>Total</th><th>Status</th></tr></thead>
            <tbody>
            @forelse ($orders as $order)
                @php($statuses = ['pending' => 'Menunggu', 'dibuat' => 'Dibuat', 'dibayar' => 'Dibayar', 'diproses' => 'Diproses', 'selesai' => 'Selesai', 'dibatalkan' => 'Dibatalkan'])
                <tr><td>{{ $order->id }}</td><td>{{ $order->created_at }}</td><td>{{ $order->customer?->nama ?? '—' }}</td><td>{{ $order->meja?->nomor_meja ?? '—' }}</td><td style="font-variant-numeric:tabular-nums">Rp{{ number_format((float) $order->total_harga, 0, ',', '.') }}</td><td>{{ $statuses[$order->status] ?? $order->status }}</td></tr>
            @empty
                <tr><td class="empty" colspan="6">Belum ada pesanan.</td></tr>
            @endforelse
            </tbody>
        </table>
    </section>
    <div class="pagination">{{ $orders->links() }}</div>
@endsection
