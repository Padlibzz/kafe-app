@extends('admin.layout')

@section('title', 'Laporan keuangan')

@section('content')
    <div class="page-head">
        <div>
            <h1>Laporan keuangan</h1>
            <p class="page-subtitle">Data laporan keuangan yang tersimpan.</p>
        </div>
    </div>
    <div class="panel">
        <table>
            <thead>
                <tr>
                    <th>Periode mulai</th>
                    <th>Periode akhir</th>
                    <th>Total pendapatan</th>
                    <th>Total biaya</th>
                    <th>Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reports as $report)
                    <tr>
                        <td>{{ $report->start_date->format('d/m/Y') }}</td>
                        <td>{{ $report->end_date->format('d/m/Y') }}</td>
                        <td>{{ $report->total_pendapatan }}</td>
                        <td>{{ $report->total_biaya }}</td>
                        <td>{{ $report->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr><td class="empty" colspan="5">Belum ada laporan keuangan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination">{{ $reports->links() }}</div>
@endsection
