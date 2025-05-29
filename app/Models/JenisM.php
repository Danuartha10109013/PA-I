<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisM extends Model
{
    use HasFactory;

    protected $table = 'jenis';

    protected $fillable = [
        'name',
        'deskripsi',
    ];
}
