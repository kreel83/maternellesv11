<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DataController;
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

Route::apiResource('posts', AuthController::class)->middleware('auth:sanctum');
Route::post('/auth/login', [AuthController::class, 'loginUser']);
Route::post('/auth/logout', [AuthController::class, 'logout']);
Route::post('/classe', [DataController::class, 'chargerLaClasse']);
Route::post('/resultat/store', [DataController::class, 'ajouterUnResultat']);
Route::post('/resultat/update', [DataController::class, 'modifierUnResultat']);
Route::post('/section', [DataController::class, 'chargerLesSections']);
Route::post('/classe/set', [DataController::class, 'nouvelleClasseParDefaut']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
