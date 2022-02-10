<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PelletController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'restricted', // see Kernel.php routeMiddleware
], function ($router) {
    Route::get('/categories/{locale}', [CategoriesController::class, 'show']);
    Route::post('/pellet/consume', [PelletController::class, 'consume']);
}
);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




//Route::get('/categories/{locale}', [CategoriesController::class, 'show']);
Route::post('/categories', [CategoriesController::class, 'add']);
Route::delete('/categories', [CategoriesController::class, 'delete']);
