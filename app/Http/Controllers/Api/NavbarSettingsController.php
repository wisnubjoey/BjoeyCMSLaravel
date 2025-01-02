<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NavbarSettings;

class NavbarSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function check()
    {
        try {
            $settings = NavbarSettings::first();
            
            if (!$settings) {
                return response()->json([
                    'is_generated' => false
                ]);
            }

            return response()->json([
                'is_generated' => true,
                'settings' => $settings
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function generate()
    {
        try {
            // Check if already exists
            $existing = NavbarSettings::first();
            if ($existing) {
                return response()->json($existing);
            }

            $settings = NavbarSettings::create([
                'is_generated' => true,
                'site_name' => 'My Website',
                'settings' => [
                    'layout' => 'default',
                    'theme' => 'light'
                ]
            ]);

            return response()->json($settings);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function update(Request $request)
    {
        try {
            $settings = NavbarSettings::first();
            
            if (!$settings) {
                return response()->json(['error' => 'Navbar not generated yet'], 404);
            }

            $settings->update($request->validate([
                'logo_url' => 'nullable|string',
                'site_name' => 'required|string',
                'settings' => 'nullable|array'
            ]));

            return response()->json($settings);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
