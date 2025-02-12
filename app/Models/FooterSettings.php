<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterSettings extends Model
{
    protected $fillable = [
        'is_active',
        'is_generated',
        'company_name',
        'description',
        'copyright_text',
        'social_links',
        'quick_links',
        'contact_info',
        'settings'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_generated' => 'boolean',
        'social_links' => 'array',
        'quick_links' => 'array',
        'contact_info' => 'array',
        'settings' => 'array'
    ];

}
