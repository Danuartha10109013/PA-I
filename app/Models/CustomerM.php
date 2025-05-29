<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerM extends Model
{
    use HasFactory;

    protected $table = 'customer';

    protected $fillable = [
        'name',
        'company_name',
        'status',
        'link',
        'logo',
    ];
}
