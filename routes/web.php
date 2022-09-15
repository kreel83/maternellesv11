<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnfantController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CahierController;
use App\Http\Controllers\ParametreController;
use App\Http\Controllers\FicheController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\GoogleConnect;
use App\Http\Controllers\EcoleController;
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

    Route::get('/connect', [GoogleConnect::class, 'connect'])->name('GoogleConnect');

Route::middleware(['auth'])->group(function () {

    Route::get('/enfants', [EnfantController::class, 'index'])->name('enfants');
    Route::get('/enfants/{id}/items', [ItemController::class, 'index'])->name('items');
    Route::get('/enfants/{id}/cahier', [CahierController::class, 'index'])->name('cahier');
    Route::post('/enfants/{id}/translate', [CahierController::class, 'translate'])->name('translate');
    Route::post('/enfants/{id}/cahier/save', [CahierController::class, 'saveTexte'])->name('saveTexte');
    Route::post('/enfants/{id}/cahier/saveTexteReussite', [CahierController::class, 'definitif'])->name('saveTexteReussite');
    Route::get('/enfants/{id}/cahier/seepdf', [CahierController::class, 'seepdf'])->name('seepdf');
    Route::get('/enfants/{id}/cahier/apercu', [CahierController::class, 'apercu'])->name('apercu');
    Route::post('/enfants/{id}/cahier/definitif', [CahierController::class, 'definitif'])->name('definitif');
    Route::get('/item/saveResultat', [ItemController::class, 'saveResultat']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/deco', [UserController::class, 'deco'])->name('deco');


    Route::get('/parametres', [parametreController::class, 'index'])->name('parametres');
    Route::get('/parametres/phrases', [parametreController::class, 'phrases'])->name('phrases');
    Route::post('/parametres/phrases/save', [parametreController::class, 'savePhrases'])->name('savePhrases');
    Route::get('/parametres/phrases/{id}/delete', [parametreController::class, 'deletePhrase'])->name('deletePhrase');

    Route::get('/fiches', [ficheController::class, 'index'])->name('fiches');
    Route::post('/fiches/choisirSelection', [ficheController::class, 'choisirSelection']);
    Route::get('/fiches/duplicate', [ficheController::class, 'duplicate']);
    Route::get('/fiches/choix', [ficheController::class, 'choix']);
    Route::post('/fiches/save_fiche', [ficheController::class, 'save_fiche'])->name('saveFiche');
    Route::post('/fiches/order', [ficheController::class, 'orderFiche'])->name('orderFiche');

    Route::get('/eleves',[EleveController::class,'liste'])->name('eleves');
    Route::post('/eleves/save',[EleveController::class,'save'])->name('save_eleve');

    Route::get('/ecole',[\App\Http\Controllers\EcoleController::class,'index'])->name('ecole');
    Route::get('/ecole/chercheCommune',[\App\Http\Controllers\EcoleController::class,'chercheCommune'])->name('chercheCommune');
    Route::get('/ecole/chercheEcoles',[\App\Http\Controllers\EcoleController::class,'chercheEcoles'])->name('chercheEcoles');
    Route::get('/ecole/choixEcole',[\App\Http\Controllers\EcoleController::class,'choixEcole'])->name('choixEcole');

    Route::get('/calendar/periodes/init',[\App\Http\Controllers\CalendrierController::class,'init']);
    Route::get('/calendar',[\App\Http\Controllers\CalendrierController::class,'index'])->name('calendar');
    Route::post('/calendar/periodes/save',[\App\Http\Controllers\CalendrierController::class,'savePeriode']);

    Route::get('/calendrier',[\App\Http\Controllers\CalendrierController::class,'calendrier'])->name('calendrier');

    Route::get('/password',[\App\Http\Controllers\EnfantController::class,'password'])->name('password');
    Route::post('/password_operation',[\App\Http\Controllers\EnfantController::class,'password_operation'])->name('password_operation');

    Route::get('/editerPDF/{enfant}', [CahierController::class, 'editerPDF'])->name('editerPDF');
    Route::get('/deleteReussite/{enfant}', [CahierController::class, 'deleteReussite'])->name('deleteReussite');

});


route::get('/resultat/setNote',  [\App\Http\Controllers\ResultatController::class, 'setNote']);



require __DIR__.'/auth.php';
