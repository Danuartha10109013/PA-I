<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderM extends Model
{
    use HasFactory;

    protected $table = 'slider';

    protected $fillable = [
        'image',
    ];
}
