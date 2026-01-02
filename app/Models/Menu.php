<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'route',
        'location',
        'parent_id',
        'order',
        'is_active',
        'new_tab',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'new_tab' => 'boolean',
    ];

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order');
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    // Helper to get link
    public function getLinkAttribute()
    {
        if ($this->route) {
            try {
                return route($this->route);
            } catch (\Exception $e) {
                return '#';
            }
        }
        return $this->url ?? '#';
    }
}
