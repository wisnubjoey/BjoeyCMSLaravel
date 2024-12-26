<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\SettingController;
use Illuminate\Support\Facades\Route;

// Public routes (jika diperlukan)
Route::get('posts/{post:slug}', [PostController::class, 'show']);

// Protected routes (perlu login)
Route::middleware(['auth:sanctum'])->group(function () {
    // Posts Management
    Route::apiResource('posts', PostController::class);
    
    // Media Management
    Route::prefix('media')->group(function () {
        Route::get('/', [MediaController::class, 'index']);
        Route::post('/', [MediaController::class, 'store']);
        Route::delete('/{media}', [MediaController::class, 'destroy']);
    });
    
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