<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryOrderM extends Model
{
    protected $table = 'delivery_order';

    protected $fillable = [
        'no_do',
    ];
}
