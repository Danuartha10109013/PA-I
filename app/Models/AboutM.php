<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutM extends Model
{
    use HasFactory;

    protected $table = 'about';

    protected $fillable = [
        'judul',
        'desc_judul',
        'item',
        'desc_item',
        'visi',
        'misi',
        'misi_tagline',
        'link_map',
        'hotline',
        'email',
    ];
}
