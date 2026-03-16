@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 fw-bold">Halaman Admin - Kelola Kurs</h2>

    <a href="/tambah" class="btn btn-primary mb-3 shadow-sm">+ Tambah Mata Uang</a>
    @if(session('sukses'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('sukses') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive bg-white p-3 rounded-4 shadow-sm border-0">
        <table class="table table-hover text-center align-middle">
            <thead class="table-dark rounded-top">
                <tr>
                    <th>ID</th>
                    <th>Bendera</th> <th>Mata Uang</th>
                    <th>Harga Beli (IDR)</th>
                    <th>Harga Jual (IDR)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data_kurs as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>
                            @if($row->bendera)
                                <img src="{{ asset('bendera/' . $row->bendera) }}" width="60" class="border border-secondary rounded shadow-sm">
                            @else
                                <span class="badge bg-secondary">No Image</span>
                            @endif
                        </td>
                        <td class="fw-bold">{{ $row->mata_uang }}</td>
                        <td>Rp {{ number_format($row->harga_beli, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($row->harga_jual, 0, ',', '.') }}</td>
                        <td>
                            <a href="/edit/{{ $row->id }}" class="btn btn-warning btn-sm fw-bold">Edit</a>
                            <a href="/hapus/{{ $row->id }}" class="btn btn-danger btn-sm fw-bold">Hapus</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if($data_kurs->isEmpty())
            <div class="text-center text-muted my-4">Data masih kosong. Silakan tambah data baru.</div>
        @endif
    </div>
</div>
@endsection
