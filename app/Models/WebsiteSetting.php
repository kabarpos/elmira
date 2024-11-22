<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'logo',
        'address',
        'whatsapp',
        'meta_ads'
    ];

    protected $casts = [
        'meta_ads' => 'array'
    ];
}
