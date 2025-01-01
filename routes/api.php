<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\NavigationController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

//login
Route::post('login', [AuthController::class, 'login'])->withoutMiddleware(['auth:sanctum', 'verified']);

// Public routes (jika diperlukan)
Route::get('posts/{post:slug}', [PostController::class, 'show']);
Route::get('/public/navigation', [NavigationController::class, 'getNavigation']);

<<<<<<< HEAD
Route::prefix('media')->group(function () {
    Route::get('/', [MediaController::class, 'index']);
    Route::post('/', [MediaController::class, 'store']);
    Route::delete('/{media}', [MediaController::class, 'destroy']);
    Route::get('/type/{type}', [MediaController::class, 'getByType']);
});

=======
>>>>>>> dbcc2c7c9b5db5d929814c443e3fbef9f6cee618
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
    // Posts Management
    Route::apiResource('posts', PostController::class);
    
    // Media Management
<<<<<<< HEAD
=======
    Route::prefix('media')->group(function () {
        Route::get('/', [MediaController::class, 'index']);
        Route::post('/', [MediaController::class, 'store']);
        Route::delete('/{media}', [MediaController::class, 'destroy']);
    });
>>>>>>> dbcc2c7c9b5db5d929814c443e3fbef9f6cee618
    
    // Settings Management
    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingController::class, 'index']);
        Route::post('/update', [SettingController::class, 'update']);
    });
    
    // Dashboard Stats (optional, bisa ditambahkan nanti)
    Route::get('/dashboard/stats', function () {
        return response()->json([
            'total_posts' => \App\Models\Post::count(),
            'published_posts' => \App\Models\Post::where('status', 'published')->count(),
            'total_media' => \App\Models\Media::count()
        ]);
    });
});