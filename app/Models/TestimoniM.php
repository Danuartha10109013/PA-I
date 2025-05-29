<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestimoniM extends Model
{
    use HasFactory;

    protected $table = 'testimoni';

    protected $fillable = [
        'person_name',
        'person_picture',
        'company_name',
        'company_logo',
        'product_name',
        'testimonial',
        'rating',
    ];
}
