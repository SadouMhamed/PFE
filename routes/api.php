<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NotificationController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/notifications/check', [App\Http\Controllers\NotificationController::class, 'check']);
    Route::get('/notifications/count', function () {
        return response()->json([
            'count' => auth()->check() ? auth()->user()->unreadNotifications->count() : 0
        ]);
    });
});