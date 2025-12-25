<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'bio',
        'photo',
        'email',
        'phone',
        'linkedin',
        'order',
        'is_active',
    ];
}
