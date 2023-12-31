<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\CategoriaController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('saludo', function () {
    return response()->json(['message' => 'Hola Mundo'], 200);
});

Route::apiResource('peliculas', PeliculaController::class);
Route::apiResource('directores', DirectorController::class);
Route::apiResource('categorias', CategoriaController::class);

