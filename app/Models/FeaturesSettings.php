<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturesSettings extends Model
{
    protected $fillable = [
        'is_active',
        'is_generated',
        'section_title',
        'section_description',
        'layout',
        'settings'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_generated' => 'boolean',
        'settings' => 'array'
    ];

    public function items()
    {
        return $this->hasMany(FeatureItem::class)->orderBy('order');
    }
}
