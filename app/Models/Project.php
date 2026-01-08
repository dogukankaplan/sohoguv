<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'image',
        'gallery',
        'status', // completed, ongoing
        'client',
        'location',
        'completion_date',
        'is_active',
    ];

    protected $casts = [
        'gallery' => 'array',
        'completion_date' => 'date',
        'is_active' => 'boolean',
    ];
}
