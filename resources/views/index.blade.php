@extends('layouts.app')

@section('content')
<div class="bg-primary text-white text-center shadow-sm" style="background: linear-gradient(135deg, #0d6efd 0%, #001e4c 100%); padding: 80px 0; margin-top: -1.5rem;">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3">Tukar Uang Asing Lebih Mudah & Menguntungkan</h1>
        <p class="lead mb-4">MOCHANGE memberikan jaminan nilai tukar (rate) terbaik, transparan, dan aman untuk segala kebutuhan transaksi Valas Anda.</p>
        <a href="#kalkulator" class="btn btn-warning btn-lg fw-bold rounded-pill px-5 shadow-sm">Mulai Hitung Kurs</a>
    </div>
</div>

<div class="container mt-5" id="kalkulator" style="margin-top: -60px !important; position: relative; z-index: 10;">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <h3 class="text-center fw-bold text-primary mb-4"><i class="fas fa-calculator me-2"></i>Kalkulator Konversi</h3>

                    <div class="row g-4">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Nominal Uang</label>
                            <input type="number" id="nominal" class="form-control form-control-lg bg-light" placeholder="Contoh: 100" min="0">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Mata Uang Asing</label>
                            <select id="mata_uang" class="form-select form-select-lg bg-light">
                                <option value="">Pilih Valas...</option>
                                @foreach($data_kurs as $row)
                                    <option value="{{ $row->id }}">{{ $row->mata_uang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Saya Ingin...</label>
                            <select id="jenis_transaksi" class="form-select form-select-lg bg-light">
                                <option value="beli">Menukar Valas ke Rupiah</option>
                                <option value="jual">Membeli Valas pakai Rupiah</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-center mt-5 p-4 rounded-4" style="background-color: #f8f9fa; border: 1px dashed #dee2e6;">
                        <p class="text-secondary fw-bold mb-1">Estimasi yang Anda Terima:</p>
                        <h1 class="fw-bold text-success display-4 mb-0" id="hasil_kalkulasi">Rp 0</h1>
                        <small class="text-muted mt-2 d-block" id="keterangan">*Silakan masukkan nominal dan pilih mata uang</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5 mb-5 pb-5">
    <h3 class="text-center fw-bold text-primary mb-4"><i class="fas fa-chart-line me-2"></i>Info Rate Terkini</h3>
    <div class="table-responsive bg-white p-4 rounded-4 shadow-sm border-0">
        <table class="table table-hover text-center align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="py-3">Bendera</th>
                    <th class="py-3">Mata Uang</th>
                    <th class="py-3">Harga Beli (IDR)</th>
                    <th class="py-3">Harga Jual (IDR)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data_kurs as $row)
                    <tr>
                        <td class="py-3">
                            @if($row->bendera)
                                <img src="{{ asset('bendera/' . $row->bendera) }}" width="50" class="border rounded shadow-sm">
                            @else
                                -
                            @endif
                        </td>
                        <td class="fw-bold text-primary fs-5 py-3">{{ $row->mata_uang }}</td>
                        <td class="text-success fw-bold fs-5 py-3">Rp {{ number_format($row->harga_beli, 0, ',', '.') }}</td>
                        <td class="text-danger fw-bold fs-5 py-3">Rp {{ number_format($row->harga_jual, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if($data_kurs->isEmpty())
            <div class="alert alert-warning text-center mt-3 mb-0 rounded-3">
                Belum ada data mata uang di database.
            </div>
        @endif
    </div>
</div>

<script>
    // 🪄 SIHIR LARAVEL: Mengubah data database PHP langsung jadi Array JavaScript!
    const dataKurs = @json($data_kurs);

    // Ambil elemen HTML
    const inputNominal = document.getElementById('nominal');
    const selectMataUang = document.getElementById('mata_uang');
    const selectTransaksi = document.getElementById('jenis_transaksi');
    const textHasil = document.getElementById('hasil_kalkulasi');
    const textKeterangan = document.getElementById('keterangan');

    // Fungsi Hitung Otomatis
    function hitungKurs() {
        let nominal = parseFloat(inputNominal.value);
        let idValas = selectMataUang.value;
        let jenis = selectTransaksi.value;

        // Jika inputan kosong
        if (!nominal || !idValas || nominal <= 0) {
            textHasil.innerText = "Rp 0";
            textHasil.className = "fw-bold text-success display-4 mb-0";
            textKeterangan.innerText = "*Silakan masukkan nominal dan pilih mata uang";
            return;
        }

        // Cari data mata uang yang dipilih di dalam array JavaScript
        let valasTerpilih = dataKurs.find(item => item.id == idValas);

        if (valasTerpilih) {
            let hasil = 0;
            if (jenis === 'beli') {
                // Customer menukar Valas ke Rupiah (Kita Beli)
                hasil = nominal * valasTerpilih.harga_beli;
                textHasil.className = "fw-bold text-success display-4 mb-0";
                textKeterangan.innerText = `*Menggunakan rate Harga Beli: Rp ${valasTerpilih.harga_beli.toLocaleString('id-ID')}`;
            } else {
                // Customer membeli Valas pakai Rupiah (Kita Jual)
                hasil = nominal * valasTerpilih.harga_jual;
                textHasil.className = "fw-bold text-danger display-4 mb-0";
                textKeterangan.innerText = `*Menggunakan rate Harga Jual: Rp ${valasTerpilih.harga_jual.toLocaleString('id-ID')}`;
            }

            // Tampilkan hasil dengan format Rupiah yang rapi
            textHasil.innerText = "Rp " + hasil.toLocaleString('id-ID');
        }
    }

    // Pasang "Telinga" (Event Listener) - Kalau ada yang ngetik/milih, langsung hitung detik itu juga!
    inputNominal.addEventListener('input', hitungKurs);
    selectMataUang.addEventListener('change', hitungKurs);
    selectTransaksi.addEventListener('change', hitungKurs);
</script>
@endsection
