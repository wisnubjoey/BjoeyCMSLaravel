<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NavbarMenuItem extends Model
{
    protected $fillable = [
        'navbar_settings_id',
        'title',
        'link',
        'type',
        'order',
        'is_active'
    ];

    public function navbar()
    {
        return $this->belongsTo(NavbarSettings::class, 'navbar_settings_id');
    }

}
