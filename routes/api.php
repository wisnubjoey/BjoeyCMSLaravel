<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\NavigationController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NavbarSettingsController;
use App\Http\Controllers\Api\NavbarMenuItemController;
use Illuminate\Support\Facades\Route;

//login
Route::post('login', [AuthController::class, 'login'])->withoutMiddleware(['auth:sanctum', 'verified']);

// Public routes (jika diperlukan)
Route::get('posts/{post:slug}', [PostController::class, 'show']);
Route::get('/public/navigation', [NavigationController::class, 'getNavigation']);

Route::prefix('media')->group(function () {
    Route::get('/', [MediaController::class, 'index']);
    Route::post('/', [MediaController::class, 'store']);
    Route::delete('/{media}', [MediaController::class, 'destroy']);
    Route::get('/type/{type}', [MediaController::class, 'getByType']);
});

Route::get('/public/navbar', [NavbarSettingsController::class, 'getPublicNavbar']);

// Protected routes (perlu login)
Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);

    // Navigation Management
    Route::prefix('navigation')->group(function () {
        Route::get('/', [NavigationController::class, 'getNavigation']);
        Route::post('/update', [NavigationController::class, 'updateNavigation']);
        Route::post('/items', [NavigationController::class, 'addMenuItem']);
        Route::put('/items/{item}', [NavigationController::class, 'updateMenuItem']);
        Route::delete('/items/{item}', [NavigationController::class, 'deleteMenuItem']);
        Route::post('/items/reorder', [NavigationController::class, 'reorderItems']);
    });

    // Toggle Active Navbar
    Route::post('/navbar/toggle', [NavbarSettingsController::class, 'toggleActive']);

    //Menu Items Management
    Route::get('/navbar/{navbarId}/menu-items', [NavbarMenuItemController::class, 'index']);
    Route::post('/navbar/{navbarId}/menu-items', [NavbarMenuItemController::class, 'store']);
    Route::put('/navbar/menu-items/{menuItem}', [NavbarMenuItemController::class, 'update']);
    Route::delete('/navbar/menu-items/{menuItem}', [NavbarMenuItemController::class, 'destroy']);
    Route::post('/navbar/{navbarId}/menu-items/reorder', [NavbarMenuItemController::class, 'reorder']);

    // Posts Management
    Route::apiResource('posts', PostController::class);
    
    // Media Management
    
    // Settings Management
    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingController::class, 'index']);
        Route::post('/update', [SettingController::class, 'update']);
    });

    // Navbar Settings
    Route::get('/navbar/check', [NavbarSettingsController::class, 'check']);
    Route::post('/navbar/generate', [NavbarSettingsController::class, 'generate']);
    Route::put('/navbar/update', [NavbarSettingsController::class, 'update']);
    
    // Dashboard Stats (optional, bisa ditambahkan nanti)
    Route::get('/dashboard/stats', function () {
        return response()->json([
            'total_posts' => \App\Models\Post::count(),
            'published_posts' => \App\Models\Post::where('status', 'published')->count(),
            'total_media' => \App\Models\Media::count()
        ]);
    });
});