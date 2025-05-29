<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianM extends Model
{
    use HasFactory;

    protected $table = 'pembelian';

    protected $fillable = [
        'user_id',
        'product_id',
        'status',
        'invoice',
        'no_do',
        'faktur',
    ];
}
