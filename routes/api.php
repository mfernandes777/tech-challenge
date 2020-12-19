<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ActorController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resources([
    'genres' => GenreController::class,
]);

Route::resources([
    'movies' => MovieController::class,
]);

Route::resources([
    'actors' => ActorController::class,
]);

Route::get('actors/{actor}/movies', [ActorController::class, 'movies']);

Route::get('actors/{actor}/genres', [ActorController::class, 'genres']);
