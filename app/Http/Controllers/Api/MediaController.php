<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Resources\MediaResource;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $media = Media::latest()->paginate(50);
        return MediaResource::collection($media);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'file_path' => 'required|string',
            'mime_type' => 'required|string',
            'size' => 'required|integer',
            'collection_name' => 'nullable|string',
            'type' => 'nullable|string',
            'uploadthing_url' => 'nullable|string',
            'filename' => 'nullable|string',
        ]);

        $media = Media::create($validated);
        return new MediaResource($media);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $media)
    {
        $media->delete();
        return response()->json(['message' => 'Media deleted successfully']);
    }

    public function getByType(Request $request, string $type)
    {
        $media = Media::where('type', $type)
            ->latest()
            ->paginate(50);
        
        return MediaResource::collection($media);
    }
}
