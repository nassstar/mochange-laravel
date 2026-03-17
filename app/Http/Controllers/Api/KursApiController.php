<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KursMataUang;

class KursApiController extends Controller
{
    // 1. READ: Ambil SEMUA data
    public function index()
    {
        $data_kurs = KursMataUang::all();
        return response()->json(['status' => 'sukses', 'data' => $data_kurs], 200);
    }

    // 2. READ: Ambil SATU data spesifik berdasarkan ID
    public function show($id)
    {
        $kurs = KursMataUang::find($id);
        if ($kurs) {
            return response()->json(['status' => 'sukses', 'data' => $kurs], 200);
        }
        return response()->json(['status' => 'gagal', 'pesan' => 'Data tidak ditemukan'], 404);
    }

    // 3. CREATE: Tambah data baru dari HP
    public function store(Request $request)
    {
        $request->validate([
            'mata_uang' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
        ]);

        $nama_file = null;
        if ($request->hasFile('bendera')) {
            $file = $request->file('bendera');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('bendera'), $nama_file);
        }

        $kurs = KursMataUang::create([
            'mata_uang' => $request->mata_uang,
            'bendera' => $nama_file,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual
        ]);

        return response()->json(['status' => 'sukses', 'pesan' => 'Data berhasil ditambahkan', 'data' => $kurs], 201);
    }

    // 4. UPDATE: Edit data dari HP (Pake POST biar HP gampang kirim gambar)
    public function update(Request $request, $id)
    {
        $kurs = KursMataUang::find($id);
        if (!$kurs) {
            return response()->json(['status' => 'gagal', 'pesan' => 'Data tidak ditemukan'], 404);
        }

        $nama_file = $kurs->bendera;
        if ($request->hasFile('bendera')) {
            if ($kurs->bendera && file_exists(public_path('bendera/' . $kurs->bendera))) {
                unlink(public_path('bendera/' . $kurs->bendera));
            }
            $file = $request->file('bendera');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('bendera'), $nama_file);
        }

        $kurs->update([
            'mata_uang' => $request->mata_uang ?? $kurs->mata_uang,
            'bendera' => $nama_file,
            'harga_beli' => $request->harga_beli ?? $kurs->harga_beli,
            'harga_jual' => $request->harga_jual ?? $kurs->harga_jual
        ]);

        return response()->json(['status' => 'sukses', 'pesan' => 'Data berhasil diupdate', 'data' => $kurs], 200);
    }

    // 5. DELETE: Hapus data dari HP
    public function destroy($id)
    {
        $kurs = KursMataUang::find($id);
        if (!$kurs) {
            return response()->json(['status' => 'gagal', 'pesan' => 'Data tidak ditemukan'], 404);
        }

        if ($kurs->bendera && file_exists(public_path('bendera/' . $kurs->bendera))) {
            unlink(public_path('bendera/' . $kurs->bendera));
        }

        $kurs->delete();
        return response()->json(['status' => 'sukses', 'pesan' => 'Data berhasil dihapus'], 200);
    }
}
