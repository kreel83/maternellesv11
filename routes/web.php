<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnfantController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CahierController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth'])->group(function () {

    Route::get('/enfants', [EnfantController::class, 'index'])->name('enfants');
    Route::get('/enfants/{id}/items', [ItemController::class, 'index'])->name('items');
    Route::get('/enfants/{id}/cahier/{periode}', [CahierController::class, 'index'])->name('cahier');
    Route::post('/enfants/{id}/translate', [CahierController::class, 'translate'])->name('translate');
    Route::post('/enfants/{id}/cahier/{periode}/save', [CahierController::class, 'saveTexte'])->name('saveTexte');
    Route::get('/enfants/{id}/cahier/{periode}/apercu', [CahierController::class, 'apercu'])->name('apercu');
    Route::get('/enfants/{id}/cahier/{periode}/definitif', [CahierController::class, 'definitif'])->name('definitif');
    Route::get('/item/saveResultat', [ItemController::class, 'saveResultat']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/deco', [UserController::class, 'deco'])->name('deco');
});


route::get('/resultat/setNote',  [\App\Http\Controllers\ResultatController::class, 'setNote']);



require __DIR__.'/auth.php';
