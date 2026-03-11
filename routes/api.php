<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MainPageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Твой API для главной страницы
Route::get('/v1/main-page', [MainPageController::class, '__invoke']);

// Тестовый роут для проверки
Route::get('/test', function() {
    return response()->json([
        'status' => 'ok',
        'message' => 'API работает',
        'time' => now()->toDateTimeString()
    ]);
});