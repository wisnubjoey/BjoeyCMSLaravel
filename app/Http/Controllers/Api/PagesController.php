<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Str;

class PagesController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('order')->get();
        return response()->json($pages);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'layout' => 'required|in:default,full-width,sidebar',
            'is_published' => 'boolean',
            'meta' => 'nullable|array'
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $page = Page::create($validated);

        return response()->json($page, 201);
    }

    public function show($id)
    {
        $page = Page::findOrFail($id);
        return response()->json($page);
    }

    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'layout' => 'required|in:default,full-width,sidebar',
            'is_published' => 'boolean',
            'meta' => 'nullable|array'
        ]);

        if ($request->title !== $page->title) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $page->update($validated);

        return response()->json($page);
    }

    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();

        return response()->json(null, 204);
    }

    public function getBySlug($slug)
    {
        $page = Page::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();
            
        return response()->json($page);
    }
}
