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

// serve static swagger JSON (robust): return JSON content if file exists, otherwise a minimal fallback
Route::get('/docs', function () {
    $path = public_path('swagger.json');

    if (file_exists($path) && is_readable($path)) {
        $content = file_get_contents($path);
        // try to decode to ensure valid JSON; if invalid, send raw string as text
        $decoded = json_decode($content, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            return response()->json($decoded, 200);
        }
        return response($content, 200)->header('Content-Type', 'application/json');
    }

    // Fallback minimal spec so route never 404
    $fallback = [
        'openapi' => '3.0.0',
        'info' => [
            'title' => 'XN360 API (fallback)',
            'version' => '1.0.0',
            'description' => 'Fallback OpenAPI spec - original swagger.json not found'
        ],
        'paths' => new \stdClass()
    ];

    return response()->json($fallback, 200);
});

// New: interactive Swagger UI page that loads the /api/docs spec
Route::get('/docs/ui', function () {
    $html = <<<'HTML'
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>XN360 API - Swagger UI</title>
  <link rel="stylesheet" href="https://unpkg.com/swagger-ui-dist@4/swagger-ui.css" />
  <style>body { margin:0; padding:0; }</style>
</head>
<body>
  <div id="swagger-ui"></div>
  <script src="https://unpkg.com/swagger-ui-dist@4/swagger-ui-bundle.js"></script>
  <script src="https://unpkg.com/swagger-ui-dist@4/swagger-ui-standalone-preset.js"></script>
  <script>
    window.onload = function() {
      const ui = SwaggerUIBundle({
        url: '/api/v2/docs',
        dom_id: '#swagger-ui',
        presets: [ SwaggerUIBundle.presets.apis, SwaggerUIStandalonePreset ],
        layout: "BaseLayout",
        deepLinking: true,
        tryItOutEnabled: true
      });
      window.ui = ui;
    };
  </script>
</body>
</html>
HTML;

    return response($html, 200)->header('Content-Type', 'text/html; charset=utf-8');
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