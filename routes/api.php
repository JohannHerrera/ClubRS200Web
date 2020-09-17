<?php

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
use Illuminate\Http\Request;

 Route::apiResource('pilotos','API\PilotosController');
 Route::apiResource('usuarios','API\UsuariosController');

//Route::post('user/login', 'API\APILoginController@login');

// Route::apiResource('pilotos','API\PilotosController');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
