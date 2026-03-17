<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Kurs - MOCHANGE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Menyembunyikan tombol saat kertas di-print */
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body class="bg-white">

    <div class="container mt-5">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-uppercase">Laporan Data Kurs Valuta Asing</h2>
            <h4 class="fw-bold text-primary">MOCHANGE</h4>
            <p class="mb-0">Jl. Jendral Sudirman No. 123, Jakarta Pusat</p>
            <p>WhatsApp/Telp: +62 812-3456-7890 | Email: cs@mochange.com</p>
            <hr style="border: 2px solid black;">
        </div>

        <table class="table table-bordered table-striped text-center align-middle mt-4">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Bendera</th> <th>Mata Uang</th>
                    <th>Harga Beli (IDR)</th>
                    <th>Harga Jual (IDR)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data_kurs as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            @if($row->bendera)
                                <img src="{{ asset('bendera/' . $row->bendera) }}" width="40" style="border: 1px solid #ccc;">
                            @else
                                <span style="color: #999;">-</span>
                            @endif
                        </td>

                        <td class="fw-bold">{{ $row->mata_uang }}</td>
                        <td>Rp {{ number_format($row->harga_beli, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($row->harga_jual, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row mt-5">
            <div class="col-8"></div>
            <div class="col-4 text-center">
                <p>Jakarta, {{ date('d-m-Y') }}</p>
                <p>Administrator,</p>
                <br><br><br>
                <p class="fw-bold text-decoration-underline">Admin MOCHANGE</p>
            </div>
        </div>

        <div class="text-center mt-5 mb-5 no-print">
            <button onclick="window.print()" class="btn btn-primary px-4 me-2">🖨️ Print / Save as PDF</button>
            <button onclick="window.close()" class="btn btn-secondary px-4">Tutup</button>
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>

</body>
</html>
