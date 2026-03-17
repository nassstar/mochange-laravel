@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <h2 class="text-center fw-bold text-primary mb-5">Layanan Kami</h2>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card h-100 shadow-sm border-0 rounded-4 p-4 text-center">
                <i class="fas fa-money-bill-transfer text-success mb-3" style="font-size: 50px;"></i>
                <h4 class="fw-bold">Jual Beli Valuta Asing</h4>
                <p class="text-secondary mt-2">Kami melayani penukaran lebih dari 20 mata uang negara di dunia dengan kondisi fisik uang yang mulus dan nilai tukar (rate) terbaik di pasaran.</p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100 shadow-sm border-0 rounded-4 p-4 text-center">
                <i class="fas fa-globe text-primary mb-3" style="font-size: 50px;"></i>
                <h4 class="fw-bold">Remittance (Kirim Uang Internasional)</h4>
                <p class="text-secondary mt-2">Kirim uang ke sanak saudara atau mitra bisnis di luar negeri dengan aman, cepat, dan biaya admin yang sangat terjangkau.</p>
            </div>
        </div>
    </div>
</div>
@endsection
