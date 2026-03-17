<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KursMataUang; // Memanggil "Satpam" Model

class KursMataUangController extends Controller
{
    public function index()
    {
        // Mengambil SEMUA data dari tabel (Sihir Laravel, pengganti SELECT * FROM)
        $data_kurs = KursMataUang::all();

        // Melempar data tersebut ke file tampilan bernama 'index'
        return view('index', compact('data_kurs'));
    }

    // FUNGSI BARU UNTUK ADMIN
    public function admin()
    {
        $data_kurs = KursMataUang::all();
        return view('admin', compact('data_kurs'));
    }

    // FUNGSI UNTUK MENAMPILKAN FORM TAMBAH
    public function tambah()
    {
        return view('tambah');
    }

    // FUNGSI UNTUK MENYIMPAN DATA (Pengganti $_POST di Native)
    public function simpan(Request $request)
    {
        // 1. Validasi Keamanan (Pastikan inputan tidak kosong dan angka benar)
        $request->validate([
            'mata_uang' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'bendera' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // 2. Logika Upload Gambar Bendera
        $nama_file = null;
        if ($request->hasFile('bendera')) {
            $file = $request->file('bendera');
            // Membuat nama file unik agar tidak bentrok
            $nama_file = time() . "_" . $file->getClientOriginalName();
            // Memindahkan gambar ke folder 'public/bendera'
            $file->move(public_path('bendera'), $nama_file);
        }

        // 3. Simpan ke Database (Sihir Eloquent Laravel!)
        KursMataUang::create([
            'mata_uang' => $request->mata_uang,
            'bendera' => $nama_file,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual
        ]);

        // 4. Arahkan kembali ke halaman admin dengan pesan sukses
        return redirect('/admin')->with('sukses', 'Data mata uang berhasil ditambahkan!');
    }

    // FUNGSI UNTUK MENGHAPUS DATA
    public function hapus($id)
    {
        $kurs = KursMataUang::find($id); // Cari datanya berdasarkan ID

        // Hapus file gambar benderanya dari folder jika ada
        if ($kurs->bendera && file_exists(public_path('bendera/' . $kurs->bendera))) {
            unlink(public_path('bendera/' . $kurs->bendera));
        }

        $kurs->delete(); // Sihir Eloquent untuk menghapus data dari tabel
        return redirect('/admin')->with('sukses', 'Data mata uang berhasil dihapus!');
    }

    // FUNGSI UNTUK MENAMPILKAN FORM EDIT
    public function edit($id)
    {
        $data = KursMataUang::find($id); // Ambil data lama
        return view('edit', compact('data')); // Lempar ke form edit
    }

    // FUNGSI UNTUK MENYIMPAN PERUBAHAN EDIT
    public function update(Request $request, $id)
    {
        $request->validate([
            'mata_uang' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'bendera' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $kurs = KursMataUang::find($id);
        $nama_file = $kurs->bendera; // Default: pakai nama gambar lama

        // Jika user mengupload gambar bendera baru
        if ($request->hasFile('bendera')) {
            // Hapus gambar lama dulu (biar folder tidak penuh)
            if ($kurs->bendera && file_exists(public_path('bendera/' . $kurs->bendera))) {
                unlink(public_path('bendera/' . $kurs->bendera));
            }
            // Upload gambar baru
            $file = $request->file('bendera');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('bendera'), $nama_file);
        }

        // Update ke database
        $kurs->update([
            'mata_uang' => $request->mata_uang,
            'bendera' => $nama_file,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual
        ]);

        return redirect('/admin')->with('sukses', 'Data mata uang berhasil diperbarui!');
    }

    public function layanan()
    {
        return view('layanan');
    }

    public function kontak()
    {
        return view('kontak');
    }

    // FUNGSI UNTUK CETAK LAPORAN
    public function cetak()
    {
        $data_kurs = KursMataUang::all();
        return view('cetak', compact('data_kurs'));
    }
}
