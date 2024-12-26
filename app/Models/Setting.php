<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value', 'type', 'group'];

    protected $casts = [
        'value' => 'json',
    ];

    public static function get ($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function set($key, $value, $type = 'text', $group = 'general')
    {
        return static::updateOrCreate(
            [
                'key' => $key,
            ],
            [
                'value' => $value,
                'type' => $type,
                'group' => $group,
            ]
        );
    }
}
