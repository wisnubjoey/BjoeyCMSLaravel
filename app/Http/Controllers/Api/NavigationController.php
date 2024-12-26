<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Navigation;
use App\Models\NavigationItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NavigationController extends Controller
{
    public function getNavigation()
    {
        $navigation = Navigation::with('items')->first();
        return response()->json($navigation);
    }

    public function updateNavigation(Request $request)
    {
        $validated = $request->validate([
            'logo' => 'nullable|string',
            'site_name' => 'required|string',
        ]);

        $navigation = Navigation::firstOrCreate(
            ['id' => 1],
            $validated
        );

        return response()->json($navigation);
    }

    public function addMenuItem(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'type' => 'required|in:page,link',
            'content' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['order'] = NavigationItem::count() + 1;

        $item = NavigationItem::create($validated);

        return response()->json($item);
    }

    public function updateMenuItem(Request $request, NavigationItem $item)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'content' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->title !== $item->title) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $item->update($validated);

        return response()->json($item);
    }

    public function deleteMenuItem(NavigationItem $item)
    {
        $item->delete();
        return response()->json(null, 204);
    }

    public function reorderItems(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:navigation_items,id',
            'items.*.order' => 'required|integer'
        ]);

        foreach ($request->items as $item) {
            NavigationItem::where('id', $item['id'])
                ->update(['order' => $item['order']]);
        }

        return response()->json(['message' => 'Menu order updated successfully']);
    }
}