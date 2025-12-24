<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'title',
        'url',
        'type',
        'order',
        'is_active',
        'new_tab'
    ];
    //
}
