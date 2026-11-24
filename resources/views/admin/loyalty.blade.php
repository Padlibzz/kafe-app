@extends('admin.layout')

@section('title', 'Loyalty')

@section('content')
    <div class="page-head"><div><h1>Loyalty</h1><p class="page-subtitle">Aturan perolehan poin yang berlaku.</p></div></div>
    <section class="panel" aria-label="Daftar aturan loyalty">
        <table>
            <thead><tr><th>Nama aturan</th><th>Deskripsi</th><th>Poin per transaksi</th><th>Minimal poin</th></tr></thead>
            <tbody>
            @forelse ($rules as $rule)
                <tr><td>{{ $rule->nama }}</td><td>{{ $rule->deskripsi ?: '—' }}</td><td>{{ $rule->poin_per_transaksi }}</td><td>{{ $rule->minimal_poin }}</td></tr>
            @empty
                <tr><td class="empty" colspan="4">Belum ada aturan loyalty.</td></tr>
            @endforelse
            </tbody>
        </table>
    </section>
    <div class="pagination">{{ $rules->links() }}</div>
@endsection
