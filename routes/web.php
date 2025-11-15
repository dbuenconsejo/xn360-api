<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/aw', function () {
    return 'asdf';
    return view('welcome');
});

// Debug route to check if routing works
Route::get('/debug', function () {
    return response()->json([
        'message' => 'Web routes are working',
        'api_url' => url('/api'),
        'try' => [
            url('/api/'),
            url('/api/test'),
            url('/api/test-json')
        ]
    ]);
});
