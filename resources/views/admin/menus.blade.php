@extends('admin.layout')

@section('title', 'Menu')

@section('content')
    <div class="page-head"><div><h1>Menu</h1><p class="page-subtitle">Kelola katalog dan ketersediaan menu.</p></div><a href="{{ route('admin.menus.create') }}">Buat menu</a></div>
    <section class="panel" aria-label="Daftar menu"><table>
        <thead><tr><th>Foto</th><th>Nama</th><th>Harga</th><th>Ketersediaan</th><th>Aksi</th></tr></thead><tbody>
        @forelse ($menus as $menu)
            <tr><td>@if ($menu->foto)<img src="{{ asset('storage/'.$menu->foto) }}" alt="Foto {{ $menu->nama_menu }}" width="64" height="48" style="object-fit:cover;border-radius:6px">@else—@endif</td><td>{{ $menu->nama_menu }}</td><td>Rp{{ number_format((float) $menu->harga, 0, ',', '.') }}</td><td>{{ $menu->ketersediaan ? 'Tersedia' : 'Tidak tersedia' }}</td><td><a href="{{ route('admin.menus.edit', $menu) }}">Edit</a> <form method="POST" action="{{ route('admin.menus.availability', $menu) }}" style="display:inline">@csrf @method('PATCH')<button type="submit">{{ $menu->ketersediaan ? 'Nonaktifkan' : 'Aktifkan' }}</button></form></td></tr>
        @empty
            <tr><td class="empty" colspan="5">Belum ada menu.</td></tr>
        @endforelse
        </tbody></table></section><div class="pagination">{{ $menus->links() }}</div>
@endsection
