<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(50);
        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'nullable',
            'featured_image' => 'nullable|string',
            'seo_title' => 'nullable|max:255',
            'seo_description' => 'nullable',
            'tags' => 'nullable|array',
            'status' => 'required|in:draft,published'
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $post = Post::create($validated);
        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'nullable',
            'featured_image' => 'nullable|string',
            'seo_title' => 'nullable|max:255',
            'seo_description' => 'nullable',
            'tags' => 'nullable|array',
            'status' => 'required|in:draft,published'
        ]);

        if ($request->title !== $post->title) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $post->update($validated);
        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(null, 204);
    }

    public function getRecentPosts()
{
    $posts = Post::where('status', 'published')
        ->latest()
        ->take(5)
        ->get();

    return response()->json($posts);
}
}
