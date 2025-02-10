<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FeaturesSettings;
use App\Models\FeatureItem;
use Illuminate\Http\Request;

class FeaturesSettingsController extends Controller
{
    public function check()
    {
        $settings = FeaturesSettings::with('items')->first();
        return response()->json([
            'is_generated' => $settings ? $settings->is_generated : false,
            'settings' => $settings
        ]);
    }

    public function generate()
    {
        $settings = FeaturesSettings::create([
            'is_generated' => true,
            'section_title' => 'Our Features',
            'section_description' => 'Discover what makes us special',
            'layout' => 'grid',
            'settings' => [
                'columns' => 3,
                'spacing' => 'medium'
            ]
        ]);

        // Create sample features
        $defaultFeatures = [
            [
                'title' => 'Feature 1',
                'description' => 'Description for feature 1',
                'icon' => 'Star',
                'order' => 1
            ],
            [
                'title' => 'Feature 2',
                'description' => 'Description for feature 2',
                'icon' => 'Heart',
                'order' => 2
            ],
            [
                'title' => 'Feature 3',
                'description' => 'Description for feature 3',
                'icon' => 'Zap',
                'order' => 3
            ]
        ];

        foreach ($defaultFeatures as $feature) {
            $settings->items()->create($feature);
        }

        return response()->json($settings->load('items'));
    }

    public function update(Request $request)
    {
        $settings = FeaturesSettings::first();
        
        if (!$settings) {
            return response()->json(['error' => 'Features section not generated yet'], 404);
        }

        $validated = $request->validate([
            'section_title' => 'required|string',
            'section_description' => 'nullable|string',
            'layout' => 'required|in:grid,columns,cards',
            'settings' => 'nullable|array'
        ]);

        $settings->update($validated);

        return response()->json($settings->load('items'));
    }

    public function toggleActive()
    {
        $settings = FeaturesSettings::first();
        
        if (!$settings) {
            return response()->json(['error' => 'Features section not found'], 404);
        }

        $settings->update([
            'is_active' => !$settings->is_active
        ]);

        return response()->json($settings->load('items'));
    }

    public function addFeature(Request $request)
    {
        $settings = FeaturesSettings::first();

        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'icon' => 'nullable|string'
        ]);

        $validated['order'] = $settings->items()->max('order') + 1;
        
        $feature = $settings->items()->create($validated);

        return response()->json($feature);
    }

    public function updateFeature(Request $request, FeatureItem $feature)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'icon' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $feature->update($validated);

        return response()->json($feature);
    }

    public function deleteFeature(FeatureItem $feature)
    {
        $feature->delete();
        return response()->json(null, 204);
    }

    public function reorderFeatures(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:feature_items,id',
            'items.*.order' => 'required|integer'
        ]);

        foreach ($request->items as $item) {
            FeatureItem::where('id', $item['id'])
                ->update(['order' => $item['order']]);
        }

        return response()->json(['message' => 'Features reordered successfully']);
    }

    public function getPublicFeatures()
    {
        $settings = FeaturesSettings::where('is_active', true)
            ->with(['items' => function($query) {
                $query->where('is_active', true)->orderBy('order');
            }])
            ->first();

        return response()->json($settings);
    }
}
