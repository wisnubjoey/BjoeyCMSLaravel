<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\NavbarMenuItem;


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

    public function menuItems() {
        return $this->hasMany(NavbarMenuItem::class)->orderBy('order');

    }
}
