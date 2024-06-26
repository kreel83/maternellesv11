<?php

use App\Http\Controllers\PdfController;
use App\Http\Controllers\CahierController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MfController;

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

Route::get('/', [MfController::class, 'index'])->name('mf.index');
Route::get('/etablissement', [MfController::class, 'etablissement'])->name('mf.etablissement');
Route::get('/application', [MfController::class, 'application'])->name('mf.application');
Route::get('/compagnon', [MfController::class, 'compagnon'])->name('mf.compagnon');
Route::get('/tarifs', [MfController::class, 'tarifs'])->name('mf.tarifs');
Route::get('/contact', [MfController::class, 'contact'])->name('mf.contact');
Route::post('/contact', [MfController::class, 'contactSend'])->name('mf.contact.send');
Route::get('/mentions', [MfController::class, 'mentions'])->name('mf.mentions');
Route::get('/donnees-personnelles', [MfController::class, 'donnees'])->name('mf.donnees');
Route::get('/cookies', [MfController::class, 'cookies'])->name('mf.cookies');
Route::get('/conditions', [MfController::class, 'conditions'])->name('mf.conditions');
Route::post('/newsletter', [MfController::class, 'newsletter'])->name('mf.newsletter');
// Route::get('/parametrage', [MfController::class, 'parametrage'])->name('mf.parametrage');

// utilisé dans public/assets/js/index.js pour la recherche d'établissement en Homepage
Route::post('/search-school', [MfController::class, 'searchSchool'])->name('mf.searchSchool');


// Route::get('/', [VitrineController::class, 'index'])->name('vitrine.index');
// Route::get('/cahier', [VitrineController::class, 'cahier'])->name('vitrine.cahier');
// Route::get('/eleves', [VitrineController::class, 'eleves'])->name('vitrine.eleves');
// Route::get('/fiches', [VitrineController::class, 'fiches'])->name('vitrine.fiches');
// Route::get('/calendrier', [VitrineController::class, 'calendrier'])->name('vitrine.calendrier');
// Route::get('/parametrage', [VitrineController::class, 'parametrage'])->name('vitrine.parametrage');
// Route::get('/compagnon', [VitrineController::class, 'compagnon'])->name('vitrine.compagnon');
// Route::get('/tarif', [VitrineController::class, 'tarif'])->name('vitrine.tarif');
// Route::get('/conditions', [VitrineController::class, 'conditions'])->name('vitrine.conditions');
// Route::get('/mentions', [VitrineController::class, 'mentions'])->name('vitrine.mentions');
// Route::get('/confidentialite', [VitrineController::class, 'confidentialite'])->name('vitrine.confidentialite');
// Route::get('/cookies', [VitrineController::class, 'cookies'])->name('vitrine.cookies');
// Route::get('/contact', [VitrineController::class, 'contact'])->name('vitrine.contact');
// Route::post('/contact', [VitrineController::class, 'contactSend'])->name('vitrine.contact.send');

Route::get('/cahier/auth/{token}', [PdfController::class, 'telechargementDuCahierParLesParents'])->name('cahier.predownload');
Route::post('/cahier/auth', [PdfController::class, 'telechargementDuCahierParLesParentsPost'])->name('cahier.predownload.post');
//Route::get('/cahier/link/{id}', [PdfController::class, 'genereLienVersCahierEnPdf']);
Route::get('/cahier/download/{token}', [CahierController::class, 'seepdf'])->name('cahier.seepdf');

/*
|--------------------------------------------------------------------------
| TEST Routes
|--------------------------------------------------------------------------
|
| Pour faire des tests rapides
|
*/
Route::get('/testemail', [TestController::class, 'testemaillogo']);
Route::get('/crondeleteuser', [TestController::class, 'crondeleteusers']);
Route::get('/waitpayment', [TestController::class, 'waitingStripe']);

/*
|--------------------------------------------------------------------------
| SUPER ADMIN Routes
|--------------------------------------------------------------------------
|
| Fonctions de gestion de l'application
|
*/
Route::get('/sa-chargevacances', [SuperAdminController::class, 'chargementDesVacancesScolaires']);
Route::get('/sa-checkenv', [SuperAdminController::class, 'checkEnvVariables']);
Route::get('/sa-items', [SuperAdminController::class, 'checkItems']);
Route::get('/sa-thumb', [SuperAdminController::class, 'thumbnails']);