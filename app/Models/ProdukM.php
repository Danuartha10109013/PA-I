<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukM extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'kode_produk',
        'name',
        'deskripsi',
        'gambar',
        'harga',
        'sfesifikasi',
        'jenis_id',
        'kategori_id',
        'detail',
        'manual_book',
        'brosur',
    ];
}
