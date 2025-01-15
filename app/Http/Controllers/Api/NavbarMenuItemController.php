<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NavbarMenuItem;
use App\Models\NavbarSettings;
use Illuminate\Http\Request;

class NavbarMenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($navbarId)
    {
        $menuItems = NavbarMenuItem::where('navbar_settings_id', $navbarId)
            ->orderBy('order')
            ->get();

        return response()->json($menuItems);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $navbarId)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'nullable|string',
            'type' => 'required|in:custom,page',
        ]);

        $lastOrder = NavbarMenuItem::where('navbar_settings_id', $navbarId)
            ->max('order') ?? 0;

        $menuItem = NavbarMenuItem::create([
            'navbar_settings_id' => $navbarId,
            'title' => $validated['title'],
            'link' => $validated['link'],
            'type' => $validated['type'],
            'order' => $lastOrder + 1,
            'is_active' => true,
        ]);

        return response()->json($menuItem, 201);
    }

    /**
     * Display the specified resource.
     */
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NavbarMenuItem $menuItem)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'nullable|string',
            'type' => 'required|in:custom,page',
            'is_active' => 'boolean',
        ]);

        $menuItem->update($validated);

        return response()->json($menuItem);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NavbarMenuItem $menuItem)
{
    try {
        $menuItem->delete();
        
        // Perbaiki format response
        return response()->json(['message' => 'Menu item deleted successfully'], 200);
        // atau
        // return response()->noContent(); // HTTP 204
    } catch (\Exception $e) {
        \Log::error('Failed to delete menu item: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to delete menu item'], 500);
        }
    }
    
    public function reorder(Request $request, $navbarId) {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:navbar_menu_items,id',
            'items.*.order' => 'required|integer|min:0',
        ]);

        foreach ($request->items as $item) {
            NavbarMenuItem::where('id', $item['id'])
                ->update(['order' => $item['order']]);
        }

        return response()->json(['message' => 'Menu order updated successfully']);
    }
}
