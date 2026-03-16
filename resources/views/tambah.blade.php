@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center py-3 rounded-top-4">
                    <h4 class="mb-0 fw-bold">Tambah Mata Uang Baru</h4>
                </div>
                <div class="card-body p-4">
                    <form action="/tambah" method="POST" enctype="multipart/form-data">
                        @csrf <div class="mb-3">
                            <label class="form-label fw-bold">Mata Uang (Contoh: USD - US Dollar)</label>
                            <input type="text" name="mata_uang" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Upload Bendera</label>
                            <input type="file" name="bendera" class="form-control" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Harga Beli (IDR)</label>
                            <input type="number" name="harga_beli" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Harga Jual (IDR)</label>
                            <input type="number" name="harga_jual" class="form-control" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="/admin" class="btn btn-secondary px-4 fw-bold">Kembali</a>
                            <button type="submit" class="btn btn-success px-4 fw-bold">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
