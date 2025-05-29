<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananM extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $fillable = [
        'name',
        'whatsapp',
        'email',
        'company_name',
        'alamat_perusahaan',
        'email_perusahaan',
        'product_id',
        'total_order',
    ];
}
