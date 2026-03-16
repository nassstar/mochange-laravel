@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-warning text-dark text-center py-3 rounded-top-4">
                    <h4 class="mb-0 fw-bold">Edit Mata Uang</h4>
                </div>
                <div class="card-body p-4">
                    <form action="/edit/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold">Mata Uang</label>
                            <input type="text" name="mata_uang" class="form-control" value="{{ $data->mata_uang }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Gambar Bendera</label><br>
                            @if($data->bendera)
                                <img src="{{ asset('bendera/' . $data->bendera) }}" width="80" class="mb-2 border rounded shadow-sm">
                            @endif
                            <small class="text-muted d-block mb-2">Gambar saat ini</small>
                            <input type="file" name="bendera" class="form-control" accept="image/*">
                            <small class="text-danger">*Kosongkan jika tidak ingin mengubah gambar.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Harga Beli (IDR)</label>
                            <input type="number" name="harga_beli" class="form-control" value="{{ $data->harga_beli }}" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Harga Jual (IDR)</label>
                            <input type="number" name="harga_jual" class="form-control" value="{{ $data->harga_jual }}" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="/admin" class="btn btn-secondary px-4 fw-bold">Kembali</a>
                            <button type="submit" class="btn btn-success px-4 fw-bold">Update Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
