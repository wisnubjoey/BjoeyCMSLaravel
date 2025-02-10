<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HeroSettings;
use Illuminate\Http\Request;

class HeroSettingsController extends Controller
{
    public function check()
    {
        $settings = HeroSettings::first();
        return response()->json([
            'is_generated' => $settings ? $settings->is_generated : false,
            'settings' => $settings
        ]);
    }

    public function generate()
    {
        $settings = HeroSettings::create([
            'is_generated' => true,
            'title' => 'Welcome to Our Website',
            'subtitle' => 'Your awesome subtitle goes here',
            'background_type' => 'color',
            'background_color' => '#ffffff',
            'alignment' => 'center',
            'settings' => [
                'padding' => 'medium',
                'text_color' => 'dark'
            ]
        ]);

        return response()->json($settings);
    }

    public function update(Request $request)
    {
        $settings = HeroSettings::first();
        
        if (!$settings) {
            return response()->json(['error' => 'Hero section not generated yet'], 404);
        }

        $validated = $request->validate([
            'is_active' => 'boolean',
            'title' => 'nullable|string',
            'subtitle' => 'nullable|string',
            'background_type' => 'required|in:color,image',
            'background_color' => 'nullable|string',
            'background_image' => 'nullable|string',
            'cta_text' => 'nullable|string',
            'cta_link' => 'nullable|string',
            'alignment' => 'required|in:left,center,right',
            'settings' => 'nullable|array'
        ]);

        $settings->update($validated);

        return response()->json($settings);
    }

    public function toggleActive()
    {
        $settings = HeroSettings::first();
        
        if (!$settings) {
            return response()->json(['error' => 'Hero section not found'], 404);
        }

        $settings->update([
            'is_active' => !$settings->is_active
        ]);

        return response()->json($settings);
    }

    public function getPublicHero()
    {
        $settings = HeroSettings::where('is_active', true)->first();
        return response()->json($settings);
    }
}
