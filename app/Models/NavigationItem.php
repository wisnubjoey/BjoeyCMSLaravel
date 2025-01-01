<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NavigationItem extends Model
{
    protected $table = 'navigation_items';

    protected $fillable = [
        'title',
        'slug',
        'type',
        'content',
        'order',
        'is_active'
    ];
}
