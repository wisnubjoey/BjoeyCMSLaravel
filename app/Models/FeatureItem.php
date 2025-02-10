<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureItem extends Model
{
    protected $fillable = [
        'features_settings_id',
        'title',
        'description',
        'icon',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function features()
    {
        return $this->belongsTo(FeaturesSettings::class);
    }
}
