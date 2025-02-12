<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FooterSettings;
use Illuminate\Http\Request;

class FooterSettingsController extends Controller
{
    public function check()
    {
        $settings = FooterSettings::first();
        return response()->json([
            'is_generated' => $settings ? $settings->is_generated : false,
            'settings' => $settings,
        ]);
    }

    public function generate()
    {
        $settings = FooterSettings::create([
            'is_generated' => true,
            'company_name' => 'Your Company',
            'description' => 'Short description about your company',
            'copyright_text' => '© 2025 Your Company. All rights reserved.',
            'social_links' => [
                'facebook' => '#',
                'twitter' => '#',
                'instagram' => '#',
            ],
            'quick_links' => [['title' => 'About', 'url' => '/about'], ['title' => 'Contact', 'url' => '/contact'], ['title' => 'Privacy Policy', 'url' => '/privacy']],
            'contact_info' => [
                'email' => 'info@company.com',
                'phone' => '+1234567890',
                'address' => 'Your Address',
            ],
        ]);

        return response()->json($settings);
    }

    public function update(Request $request)
    {
        $settings = FooterSettings::first();

        $validated = $request->validate([
            'company_name' => 'required|string',
            'description' => 'nullable|string',
            'copyright_text' => 'required|string',
            'social_links' => 'nullable|array',
            'quick_links' => 'nullable|array',
            'contact_info' => 'nullable|array',
            'settings' => 'nullable|array',
        ]);

        $settings->update($validated);

        return response()->json($settings);
    }

    public function toggleActive()
    {
        $settings = FooterSettings::first();
        $settings->update(['is_active' => !$settings->is_active]);
        return response()->json($settings);
    }

    public function getPublicFooter()
    {
        $settings = FooterSettings::where('is_active', true)->first();
        return response()->json($settings);
    }
}
