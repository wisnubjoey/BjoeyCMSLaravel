<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavbarSettings extends Model
{
    protected $fillable = [
        'is_active',
        'is_generated',
        'logo_url',
        'site_name',
        'settings'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_generated' => 'boolean',
        'settings' => 'array'
    ];
}
