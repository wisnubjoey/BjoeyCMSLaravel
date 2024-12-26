<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    protected $table = 'navigation';
    
    protected $fillable = [
        'logo',
        'site_name',
        'is_active'
    ];

    public function items()
    {
        return $this->hasMany(NavigationItem::class);
    }
}
