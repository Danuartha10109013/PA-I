<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontakM extends Model
{
    use HasFactory;

    protected $table = 'kontak';

    protected $fillable = [
        'name',
        'phone',
        'operation_time',
        'profile',
    ];
}
