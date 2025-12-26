<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'page',
        'badge_text',
        'title',
        'subtitle',
        'cta_text',
        'cta_url',
        'cta_secondary_text',
        'cta_secondary_url',
        'background_image',
        'trust_indicator_1',
        'trust_indicator_2',
        'trust_indicator_3',
        'stat_1_value',
        'stat_1_label',
        'stat_2_value',
        'stat_2_label',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
