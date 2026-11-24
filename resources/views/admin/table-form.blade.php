@extends('admin.layout')

@section('title', $table->exists ? 'Ubah meja' : 'Tambah meja')

@section('content')
    <div class="page-head"><div><h1>{{ $table->exists ? 'Ubah meja' : 'Tambah meja' }}</h1></div></div>
    <section class="panel">
        <form method="POST" action="{{ $table->exists ? route('admin.tables.update', $table) : route('admin.tables.store') }}">
            @csrf
            @if ($table->exists) @method('PUT') @endif
            <label for="nomor_meja">Nomor meja</label>
            <input id="nomor_meja" name="nomor_meja" value="{{ old('nomor_meja', $table->nomor_meja) }}" required maxlength="255">
            @error('nomor_meja')<p role="alert">{{ $message }}</p>@enderror
            <button type="submit">Simpan</button>
        </form>
    </section>
@endsection
