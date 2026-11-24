@extends('admin.layout')

@section('title', 'Meja & QR')

@section('content')
    <div class="page-head"><div><h1>Meja &amp; QR</h1><p class="page-subtitle">Daftar meja dan kode QR yang terdaftar.</p></div><a href="{{ route('admin.tables.create') }}">Tambah meja</a></div>
    <section class="panel" aria-label="Daftar meja dan kode QR">
        <table>
            <thead><tr><th>ID</th><th>Nomor meja</th><th>Kode QR</th><th>Aksi</th></tr></thead>
            <tbody>
            @forelse ($tables as $table)
                <tr><td>{{ $table->id_meja }}</td><td>{{ $table->nomor_meja }}</td><td><span style="white-space:normal;overflow-wrap:anywhere">{{ $table->kode_qr }}</span></td><td><a href="{{ route('admin.tables.edit', $table) }}">Ubah</a></td></tr>
            @empty
                <tr><td class="empty" colspan="4">Belum ada meja.</td></tr>
            @endforelse
            </tbody>
        </table>
    </section>
    <div class="pagination">{{ $tables->links() }}</div>
@endsection
