@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row bg-white p-5 shadow-sm rounded-4 border-0">
        <div class="col-md-6 mb-4">
            <h3 class="fw-bold text-primary mb-4">Hubungi MOCHANGE</h3>
            <p class="text-secondary mb-4">Punya pertanyaan seputar ketersediaan stok mata uang atau ingin *booking rate* dalam jumlah besar? Jangan ragu untuk menghubungi kami.</p>

            <h5 class="fw-bold"><i class="fas fa-map-marker-alt text-danger me-2"></i> Alamat Kantor</h5>
            <p class="text-secondary ms-4">Jl. Jendral Sudirman No. 123, Jakarta Pusat</p>

            <h5 class="fw-bold mt-4"><i class="fab fa-whatsapp text-success me-2"></i> WhatsApp / Telepon</h5>
            <p class="text-secondary ms-4">+62 812-3456-7890</p>
        </div>

        <div class="col-md-6">
            <h4 class="fw-bold mb-3">Tinggalkan Pesan</h4>
            <form>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Nama Lengkap" required>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" placeholder="Alamat Email" required>
                </div>
                <div class="mb-3">
                    <textarea class="form-control" rows="4" placeholder="Pesan Anda..." required></textarea>
                </div>
                <button type="button" class="btn btn-primary w-100 fw-bold" onclick="alert('Pesan berhasil dikirim! (Ini hanya simulasi)')">Kirim Pesan</button>
            </form>
        </div>
    </div>
</div>
@endsection
