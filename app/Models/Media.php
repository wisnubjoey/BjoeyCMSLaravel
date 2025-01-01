<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'name',
        'file_path',
        'mime_type',
        'size',
        'collection_name',
        'uploadthing_url',
        'type',
        'filename'
    ];

    protected $casts = [
        'size' => 'integer'
    ];

    protected $attributes = [
        'type' => 'image'
    ];

    public function getUrlAttribute()
    {
        return $this->uploadthing_url ?? url($this->file_path);
    }
}
