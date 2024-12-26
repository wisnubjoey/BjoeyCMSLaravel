<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'file_path', 'mime_type', 'size', 'collection_name'];

    public function getUrlAttribute()
    {
        return url($this->file_path);
    }
}
