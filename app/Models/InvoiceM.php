<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceM extends Model
{
    protected $table = 'invoice';

    protected $fillable = [
        'no_invoice',
        'pembeli_id',
            'no_ref',
            'date',
            'due_date',
            'product',
            'description',
            'qty',
            'price',
            'total',
            'dpp',
            'vat',
            'grand_total',
            'bank_account',
            'bank_name',
            'date_kirim',
            'best_regards',
            'best_regards_signature',
    ];
}
