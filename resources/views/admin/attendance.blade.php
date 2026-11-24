@extends('admin.layout')

@section('title', 'Absensi')

@section('content')
    <div class="page-head"><div><h1>Absensi</h1><p class="page-subtitle">Daftar kehadiran karyawan.</p></div></div>
    <section class="panel" aria-label="Daftar absensi">
        <table>
            <thead><tr><th>Nama</th><th>Tanggal</th><th>Status</th><th>Jam masuk</th><th>Jam keluar</th></tr></thead>
            <tbody>
            @forelse ($attendances as $attendance)
                <tr><td>{{ $attendance->karyawan?->nama }}</td><td>{{ $attendance->tanggal->format('d/m/Y') }}</td><td>{{ $attendance->status }}</td><td>{{ $attendance->jam_masuk?->format('H:i') ?? '—' }}</td><td>{{ $attendance->jam_keluar?->format('H:i') ?? '—' }}</td></tr>
            @empty
                <tr><td class="empty" colspan="5">Belum ada data absensi.</td></tr>
            @endforelse
            </tbody>
        </table>
    </section>
    <div class="pagination">{{ $attendances->links() }}</div>
@endsection
