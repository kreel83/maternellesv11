<?php

//use App\Http\Controllers\admin\AdminLicenceController;
//use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\CahierController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VitrineController;
use App\Http\Controllers\MfController;
//use App\Models\Facture;

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

Route::get('/mf', [MfController::class, 'index'])->name('mf.index');
Route::get('/mf/cahier', [MfController::class, 'cahier'])->name('mf.cahier');
Route::get('/mf/eleves', [MfController::class, 'eleves'])->name('mf.eleves');
Route::get('/mf/fiches', [MfController::class, 'fiches'])->name('mf.fiches');
Route::get('/mf/calendrier', [MfController::class, 'calendrier'])->name('mf.calendrier');
Route::get('/mf/parametrage', [MfController::class, 'parametrage'])->name('mf.parametrage');
Route::get('/mf/compagnon', [MfController::class, 'compagnon'])->name('mf.compagnon');
Route::get('/mf/tarif', [MfController::class, 'tarif'])->name('mf.tarif');
Route::get('/mf/conditions', [MfController::class, 'conditions'])->name('mf.conditions');
Route::get('/mf/mentions', [MfController::class, 'mentions'])->name('mf.mentions');
Route::get('/mf/confidentialite', [MfController::class, 'confidentialite'])->name('mf.confidentialite');
Route::get('/mf/cookies', [MfController::class, 'cookies'])->name('mf.cookies');


Route::get('/', [VitrineController::class, 'index'])->name('vitrine.index');
Route::get('/cahier', [VitrineController::class, 'cahier'])->name('vitrine.cahier');
Route::get('/eleves', [VitrineController::class, 'eleves'])->name('vitrine.eleves');
Route::get('/fiches', [VitrineController::class, 'fiches'])->name('vitrine.fiches');
Route::get('/calendrier', [VitrineController::class, 'calendrier'])->name('vitrine.calendrier');
Route::get('/parametrage', [VitrineController::class, 'parametrage'])->name('vitrine.parametrage');
Route::get('/compagnon', [VitrineController::class, 'compagnon'])->name('vitrine.compagnon');
Route::get('/tarif', [VitrineController::class, 'tarif'])->name('vitrine.tarif');
Route::get('/conditions', [VitrineController::class, 'conditions'])->name('vitrine.conditions');
Route::get('/mentions', [VitrineController::class, 'mentions'])->name('vitrine.mentions');
Route::get('/confidentialite', [VitrineController::class, 'confidentialite'])->name('vitrine.confidentialite');
Route::get('/cookies', [VitrineController::class, 'cookies'])->name('vitrine.cookies');

Route::get('/contact', [VitrineController::class, 'contact'])->name('vitrine.contact');
Route::post('/contact', [VitrineController::class, 'contactSend'])->name('vitrine.contact.send');

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