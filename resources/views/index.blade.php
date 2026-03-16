@extends('layouts.app') @section('content') <div class="container mt-4 text-center">
    <h1 class="fw-bold text-primary">Selamat Datang di MOCHANGE 2.0</h1>
    <p class="lead text-secondary">Aplikasi yang sama, dengan mesin Enterprise Laravel yang jauh lebih canggih!</p>
</div>

<div class="container mt-5 mb-5">
    <div class="table-responsive bg-white p-3 rounded-4 shadow border-0">
        <table class="table table-hover text-center align-middle">
                <thead class="table-light border-bottom">
                    <tr>
                        <th>Bendera</th> <th>Mata Uang</th>
                        <th>Harga Beli (IDR)</th>
                        <th>Harga Jual (IDR)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data_kurs as $row)
                        <tr>
                            <td>
                                @if($row->bendera)
                                    <img src="{{ asset('bendera/' . $row->bendera) }}" width="50" class="border rounded shadow-sm">
                                @else
                                    -
                                @endif
                            </td>
                            <td class="fw-bold text-primary fs-5">{{ $row->mata_uang }}</td>
                            <td class="text-success fw-bold fs-5">Rp {{ number_format($row->harga_beli, 0, ',', '.') }}</td>
                            <td class="text-danger fw-bold fs-5">Rp {{ number_format($row->harga_jual, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        @if($data_kurs->isEmpty())
            <div class="alert alert-warning text-center mt-3">
                Belum ada data mata uang di database.
            </div>
        @endif
    </div>
</div>
@endsection
