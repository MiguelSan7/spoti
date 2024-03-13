<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Musica\Albumes;
use App\Http\Controllers\Musica\Artistas;
use App\Http\Controllers\Musica\Canciones;
use App\Http\Controllers\Musica\Genero;
use App\Http\Controllers\Musica\Playlist;

use App\Http\Controllers\Usuario\Descargas;
use App\Http\Controllers\Usuario\Historial;
use App\Http\Controllers\Usuario\Favoritos;
use App\Http\Controllers\Usuario\Suscripciones;
use App\Http\Controllers\Usuario\Usuarios;
use App\Http\Controllers\Usuario\Roles;

use App\Http\Controllers\Canciones_Playlist;
use App\Http\Controllers\Usuarios_Playlist;
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



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Rutas de usuario
Route::prefix('auth')->group(function ($router) {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('logCode', [AuthController::class, 'logCode'])->middleware('active');
    Route::post('verifyCode', [AuthController::class, 'verifyCode']);
    Route::post('me', [AuthController::class, 'me']);
    Route::get('activate/{user}', [AuthController::class, 'activate'])
    ->name('activate')->middleware('signed');
    Route::get('checkActive/{user}', [AuthController::class, 'checkActive'])
    ->name('checkActive');
});

//Rutas de usuario
Route::prefix('usuarios')->group(function ($router) {
    Route::get('/list', [Usuarios::class, 'index']);
    Route::post('/create', [Usuarios::class, 'store']);
    Route::put('/update/{id}', [Usuarios::class, 'update'])->where('id', '[0-9]+');
    Route::delete('/delete/{id}', [Usuarios::class, 'destroy'])->where('id', '[0-9]+');
});

//Rutas de roles
Route::prefix('roles')->group(function ($router) {
    Route::get('/list', [Roles::class, 'index']);
    Route::post('/create', [Roles::class, 'store']);
    Route::put('/update/{id}', [Roles::class, 'update'])->where('id', '[0-9]+');
    Route::delete('/delete/{id}', [Roles::class, 'destroy'])->where('id', '[0-9]+');
});
//Albumes
Route::prefix('albumes')->group(function ($router) {
    Route::get('/list', [Albumes::class, 'index']);
    Route::post('/create', [Albumes::class, 'store']);
    Route::put('/update/{id}', [Albumes::class, 'update'])->where('id', '[0-9]+');
    Route::delete('/delete/{id}', [Albumes::class, 'destroy'])->where('id', '[0-9]+');
});

//Artistas
Route::prefix('artistas')->group(function ($router) {
    Route::get('/list', [Artistas::class, 'index']);
    Route::post('/create', [Artistas::class, 'store']);
    Route::put('/update/{id}', [Artistas::class, 'update'])->where('id', '[0-9]+');
    Route::delete('/delete/{id}', [Artistas::class, 'destroy'])->where('id', '[0-9]+');
});

//Canciones
Route::prefix('canciones')->group(function ($router) {
    Route::get('/list', [Canciones::class, 'index']);
    Route::post('/create', [Canciones::class, 'store']);
    Route::put('/update/{id}', [Canciones::class, 'update'])->where('id', '[0-9]+');
    Route::delete('/delete/{id}', [Canciones::class, 'destroy'])->where('id', '[0-9]+');
});

//Genero
Route::prefix('genero')->group(function ($router) {
    Route::get('/list', [Genero::class, 'index']);
    Route::post('/create', [Genero::class, 'store']);
    Route::put('/update/{id}', [Genero::class, 'update'])->where('id', '[0-9]+');
    Route::delete('/delete/{id}', [Genero::class, 'destroy'])->where('id', '[0-9]+');
});

//Playlist
Route::prefix('playlist')->group(function ($router) {
    Route::get('/list', [Playlist::class, 'index']);
    Route::post('/create', [Playlist::class, 'store']);
    Route::put('/update/{id}', [Playlist::class, 'update'])->where('id', '[0-9]+');
    Route::delete('/delete/{id}', [Playlist::class, 'destroy'])->where('id', '[0-9]+');
});

//Descargas
Route::prefix('descargas')->group(function ($router) {
    Route::get('/list', [Descargas::class, 'index']);
    Route::post('/create', [Descargas::class, 'store']);
    Route::delete('/delete/{id}', [Descargas::class, 'destroy'])->where('id', '[0-9]+');
});

//Historial
Route::prefix('historial')->group(function ($router) {
    Route::get('/list', [Historial::class, 'index']);
    Route::post('/create', [Historial::class, 'store']);
    Route::delete('/delete/{id}', [Historial::class, 'destroy'])->where('id', '[0-9]+');
});

//Favoritos
Route::prefix('favoritos')->group(function ($router) {
    Route::get('/list', [Favoritos::class, 'index']);
    Route::post('/create', [Favoritos::class, 'store']);
    Route::delete('/delete/{id}', [Favoritos::class, 'destroy'])->where('id', '[0-9]+');
});

//Suscripciones
Route::prefix('suscripciones')->group(function ($router) {
    Route::get('/list', [Suscripciones::class, 'index']);
    Route::post('/create', [Suscripciones::class, 'store']);
    Route::put('/update/{id}', [Suscripciones::class, 'update'])->where('id', '[0-9]+');
    Route::delete('/delete/{id}', [Suscripciones::class, 'destroy'])->where('id', '[0-9]+');
});

//Canciones_Playlist
Route::prefix('canciones_playlist')->group(function ($router) {
    Route::get('/list', [Canciones_Playlist::class, 'index']);
    Route::post('/create', [Canciones_Playlist::class, 'store']);
    Route::delete('/delete/{id}', [Canciones_Playlist::class, 'destroy'])->where('id', '[0-9]+');
});
