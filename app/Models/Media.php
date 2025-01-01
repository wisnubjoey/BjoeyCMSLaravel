<?php

namespace App\Models;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> dbcc2c7c9b5db5d929814c443e3fbef9f6cee618
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
<<<<<<< HEAD
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
=======
    use HasFactory;

    protected $fillable = ['name', 'file_path', 'mime_type', 'size', 'collection_name'];

    public function getUrlAttribute()
    {
        return url($this->file_path);
>>>>>>> dbcc2c7c9b5db5d929814c443e3fbef9f6cee618
    }
}
