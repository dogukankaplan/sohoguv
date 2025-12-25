<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'summary',
        'content',
        'icon',
        'is_active',
        'seo_title',
        'seo_description',
        'image',
        'slug',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
