<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSettings extends Model
{
    protected $fillable = [
        'is_active',
        'is_generated',
        'title',
        'subtitle',
        'background_type',
        'background_color',
        'background_image',
        'cta_text',
        'cta_link',
        'alignment',
        'settings'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_generated' => 'boolean',
        'settings' => 'array'
    ];
}
