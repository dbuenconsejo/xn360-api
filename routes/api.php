<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DispatchQueueItemController;

// Add this to verify file is loaded
\Illuminate\Support\Facades\Log::info('API routes file loaded');

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Simple test endpoint
Route::get('/test', function () {
    return response('API is working! This is a test endpoint.', 200)
        ->header('Content-Type', 'text/plain');
});

// Test endpoint with JSON
Route::get('/test-json', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'API is working!',
        'timestamp' => now(),
        'url' => request()->url(),
        'path' => request()->path()
    ]);
});

// Root API test - helps verify the /api prefix is working
Route::get('/', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Welcome to the API',
        'endpoints' => [
            '/api/test',
            '/api/test-json',
            '/api/dispatch-queue-items'
        ]
    ]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public API routes for dispatch queue items (no auth)
Route::apiResource('dispatch-queue-items', DispatchQueueItemController::class);

// Or if you want to add authentication:
// Route::middleware('auth:sanctum')->group(function () {
//     Route::apiResource('dispatch-queue-items', DispatchQueueItemController::class);
// });