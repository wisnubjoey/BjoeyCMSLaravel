<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'layout',
        'sections',
        'meta',
        'is_published',
        'order'
    ];

    protected $casts = [
        'sections' => 'array',
        'meta' => 'array',
        'is_published' => 'boolean'
    ];

}
