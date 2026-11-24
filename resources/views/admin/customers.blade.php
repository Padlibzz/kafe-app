@extends('admin.layout')

@section('title', 'Pelanggan')

@section('content')
    <div class="page-head"><div><h1>Pelanggan</h1><p class="page-subtitle">Daftar pelanggan dan saldo poin.</p></div></div>
    <section class="panel" aria-label="Daftar pelanggan">
        <table>
            <thead><tr><th>ID</th><th>Nama</th><th>Saldo poin</th></tr></thead>
            <tbody>
            @forelse ($customers as $customer)
                <tr><td>{{ $customer->id_customer }}</td><td>{{ $customer->nama }}</td><td>{{ $customer->saldo_poin }}</td></tr>
            @empty
                <tr><td class="empty" colspan="3">Belum ada pelanggan.</td></tr>
            @endforelse
            </tbody>
        </table>
    </section>
    <div class="pagination">{{ $customers->links() }}</div>
@endsection
