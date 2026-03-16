<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KursMataUang extends Model
{
    // BARIS INI SANGAT PENTING: Mencegah Laravel menambahkan huruf 's'
    protected $table = 'kurs_mata_uang';

    protected $fillable = [
        'mata_uang',
        'bendera',
        'harga_beli',
        'harga_jual'
    ];
}
