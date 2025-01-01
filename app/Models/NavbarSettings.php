<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavbarSettings extends Model
{
    protected $fillable = [
        'is_generated',
        'logo_url',
        'site_name',
        'settings'
    ];

    protected $casts = [
        'is_generated' => 'boolean',
        'settings' => 'array'
    ];
}
