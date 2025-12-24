<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'category',
        'sub_category',
        'image',
        'features',
    ];

    protected $casts = [
        'features' => 'array',
    ];
}
