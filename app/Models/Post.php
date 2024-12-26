<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'content', 'featured_image', 'seo_title', 'seo_description', 'tags', 'status', 'views'];

    protected $casts = [
        'tags' => 'array',
        'views' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($post) {
            $post->slug = Str::slug($post->title);
        });
    }
}
