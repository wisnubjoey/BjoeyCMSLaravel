<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'file_path' => $this->file_path,
            'url' => $this->uploadthing_url ?? $this->url,  // Prioritaskan uploadthing_url
            'type' => $this->type,  // Tidak perlu default karena sudah ada di model
            'mime_type' => $this->mime_type,
            'size' => $this->size,
            'collection_name' => $this->collection_name,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}