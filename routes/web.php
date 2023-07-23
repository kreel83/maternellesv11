<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VitrineController;

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


/*
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AdminProfilController;
use App\Http\Controllers\admin\AdminLicenceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnfantController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GroupeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CahierController;
use App\Http\Controllers\ParametreController;
use App\Http\Controllers\ficheController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\GoogleConnect;
use App\Http\Controllers\EcoleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RegisteredUserController;

use App\Http\Controllers\NewaccountController;
use App\Http\Controllers\Direction\DashboardProController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Http\Request;

// ADMIN URLs (directeurs) protected by 'admin' Middleware
Route::middleware(['admin'])->group(function()
{
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/admin/profil', [AdminProfilController::class, 'loadAdminProfile'])->name('admin.loadprofile');
    Route::post('/admin/profil', [AdminProfilController::class, 'saveAdminProfile'])->name('admin.saveprofile');
    Route::get('/admin/licence', [AdminLicenceController::class, 'index'])->name('admin.licence.index');
    Route::get('/admin/licence/achat', [AdminLicenceController::class, 'achat'])->name('admin.licence.achat');
    Route::post('/admin/licence/achat', [AdminLicenceController::class, 'create'])->name('admin.licence.create');
    Route::post('/admin/licence/assign', [AdminLicenceController::class, 'assign']);  // utilisé dans subscription.js
    Route::get('/admin/licence/remove/{id}', [AdminLicenceController::class, 'remove'])->name('admin.licence.remove');
    Route::get('/admin/licence/invoice', [AdminLicenceController::class, 'invoice'])->name('admin.licence.invoice');
    Route::get('/admin/contact', [AdminController::class, 'contact'])->name('admin.contact');
    //Route::post('/admin/contact/store', [ContactController::class, 'store'])->name('admin.contact.store');
    Route::get('/admin/invoice/{invoice}', function (Request $request, string $invoiceId) {
        return $request->user()->downloadInvoice($invoiceId);
    });
});
// Admin registration URLs
Route::get('/admin/register', [AdminController::class, 'register'])->name('admin.register');
Route::get('/admin/checkcode/{code}', [AdminController::class, 'checkcode'])->name('admin.checkcode');  // utilisé dans admin.js
// User Validation url from admin creation
Route::get('/user/validation/password', [UserController::class, 'valideUserFromAdminCreatePassword'])->name('user.valideUserFromAdminCreatePassword');  // utilisé pour valider une adresse mail depuis email
Route::post('/user/validation', [UserController::class, 'valideUserFromAdminSavePassword'])->name('user.valideUserFromAdminSavePassword');  // sauve le mot de passe et active le compte
// User Validation url from self registration
Route::get('/user/validation/self', [UserController::class, 'validUserFromSelfRegistration'])->name('user.validUserFromSelfRegistration');  // utilisé pour valider une adresse mail depuis email
Route::get('/deleteuser', [UserController::class, 'deleteinactiveuser'])->name('user.deleteinactive');

// Contact form (utilisé dans contact.js seulement)
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');


// A supprimer dans le futur
//Route::get('/dashboardpro', [DashboardProController::class, 'index'])->name('dashboardpro')->middleware('auth.direction');
//Route::get('/decodirection', [UserControllerDirection::class, 'decodirection'])->name('decodirection')->middleware('auth.direction');


Route::get('/parent',[EnfantController::class, 'parent']);
Route::post('/parent',[EnfantController::class, 'parent_mdp'])->name('parent');
Route::get('/connect', [GoogleConnect::class, 'connect'])->name('GoogleConnect');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [parametreController::class, 'welcome'])->name('depart');

    Route::get('/contact', [UserController::class, 'contact'])->name('contact');

    Route::get('/enfants', [EnfantController::class, 'index'])->name('enfants');
    Route::get('/enfants/{id}/items', [ItemController::class, 'index'])->name('items');
    Route::get('/enfants/{id}/cahier', [CahierController::class, 'index'])->name('cahier');
    Route::post('/enfants/{id}/cahier/saveCommentaireGeneral', [CahierController::class, 'saveCommentaireGeneral'])->name('saveCommentaireGeneral');
    Route::post('/enfants/{id}/translate', [CahierController::class, 'translate'])->name('translate');
    Route::post('/enfants/{id}/cahier/save', [CahierController::class, 'saveTexte'])->name('saveTexte');
    Route::post('/enfants/{id}/cahier/saveTexteReussite', [CahierController::class, 'definitif'])->name('saveTexteReussite');
    Route::get('/enfants/{id}/cahier/seepdf/{state}', [CahierController::class, 'seepdf'])->name('seepdf');
    Route::get('/enfants/{id}/cahier/savepdf', [CahierController::class, 'savepdf'])->name('savepdf');
    Route::get('/enfants/{id}/cahier/apercu', [CahierController::class, 'apercu'])->name('apercu');
    Route::post('/enfants/{id}/cahier/definitif', [CahierController::class, 'definitif'])->name('definitif');
    Route::get('/item/saveResultat', [ItemController::class, 'saveResultat']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/deco', [UserController::class, 'deco'])->name('deco');

    Route::get('/get_liste_phrase/{section}/{enfant}', [CahierController::class, 'get_liste_phrase'])->name('get_liste_phrase');


    Route::get('/parametres', [parametreController::class, 'index'])->name('parametres');
    Route::get('/parametres/phrases', [parametreController::class, 'phrases'])->name('phrases');
    Route::post('/parametres/phrases/save', [parametreController::class, 'savePhrases'])->name('savePhrases');
    Route::get('/parametres/phrases/{id}/delete', [parametreController::class, 'deletePhrase'])->name('deletePhrase');

    Route::get('/fiches', [ficheController::class, 'index'])->name('fiches');
    Route::post('/fiches/choisirSelection', [ficheController::class, 'choisirSelection']);
    Route::get('/fiches/duplicate', [ficheController::class, 'duplicate']);
    Route::get('/fiches/choix', [ficheController::class, 'choix']);
    Route::get('/fiches/retirerChoix', [ficheController::class, 'retirerChoix']);
    Route::post('/fiches/save_fiche', [ficheController::class, 'save_fiche'])->name('saveFiche');
    Route::post('/fiches/order', [ficheController::class, 'orderFiche'])->name('orderFiche');
    Route::get('/fiches/create', [ficheController::class, 'createFiche'])->name('createFiche');


    Route::get('/eleves',[EleveController::class,'liste'])->name('eleves');
    Route::post('/eleves/save',[EleveController::class,'save'])->name('save_eleve');
    Route::post('/eleves/ajouterEleves',[EleveController::class,'ajouterEleves'])->name('ajouterEleves');
    Route::get('/eleves/removeEleve',[EleveController::class,'removeEleve'])->name('removeEleve');
    Route::get('eleves/setAnimaux',[EleveController::class,'setAnimaux'])->name('setAnimaux');

    Route::get('/ecole',[\App\Http\Controllers\EcoleController::class,'index'])->name('ecole');
    Route::get('/ecole/chercheCommune',[\App\Http\Controllers\EcoleController::class,'chercheCommune'])->name('chercheCommune');
    Route::get('/ecole/chercheEcoles',[\App\Http\Controllers\EcoleController::class,'chercheEcoles'])->name('chercheEcoles');
    Route::get('/ecole/choixEcole',[\App\Http\Controllers\EcoleController::class,'choixEcole'])->name('choixEcole');
    Route::get('/ecole/confirmation',[\App\Http\Controllers\EcoleController::class,'confirmationEcole'])->name('confirmationEcole');

    Route::get('/calendar/periodes/init',[\App\Http\Controllers\CalendrierController::class,'init']);
    Route::get('/calendar',[\App\Http\Controllers\CalendrierController::class,'index'])->name('calendar');
    Route::get('/periode',[\App\Http\Controllers\CalendrierController::class,'periode'])->name('periode');
    Route::post('/periode/save',[\App\Http\Controllers\CalendrierController::class,'periode_save'])->name('periode_save');
    Route::post('/calendar/periodes/save',[\App\Http\Controllers\CalendrierController::class,'savePeriode']);
    Route::post('/calendar/event/add',[\App\Http\Controllers\CalendrierController::class,'saveEvent'])->name('event');
    Route::get('/calendar/event/delete/{id}',[\App\Http\Controllers\CalendrierController::class,'deleteEvent'])->name('deleteEvent');
    Route::get('/calendar/getEvent/{date}',[\App\Http\Controllers\CalendrierController::class,'getEvent'])->name('getEvent');

    Route::get('/calendrier',[\App\Http\Controllers\CalendrierController::class,'calendrier'])->name('calendrier');

    Route::get('/password',[\App\Http\Controllers\EnfantController::class,'password'])->name('password');
    Route::post('/password_operation',[\App\Http\Controllers\EnfantController::class,'password_operation'])->name('password_operation');


    Route::get('/editerPDF/{enfant}', [CahierController::class, 'editerPDF'])->name('editerPDF');
    Route::get('/deleteReussite/{enfant}', [CahierController::class, 'deleteReussite'])->name('deleteReussite');

    Route::get('/monprofil', [ParametreController::class, 'monprofil'])->name('monprofil');
    Route::post('/monprofil', [ParametreController::class, 'savemonprofil'])->name('savemonprofil');

    Route::get('/aidematernelle', [ParametreController::class, 'aidematernelle'])->name('aidematernelle');
    Route::post('/aidematernelle', [ParametreController::class, 'saveaidematernelle'])->name('aidematernelle');

    Route::get('/mesfiches', [ItemController::class, 'mesfiches'])->name('mesfiches');

    
    Route::get('/initClasse', [AdminController::class, 'initClasse'])->name('initClasse');
    Route::get('/recupClasse', [AdminController::class, 'recupClasse'])->name('recupClasse');

    Route::get('/photos', [EleveController::class, 'photos'])->name('photos');


    Route::get('/subscribe', [SubscriptionController::class, 'index'])->name('subscribe.index');
    Route::get('/subscribe/cardform', [SubscriptionController::class, 'cardform'])->name('subscribe.cardform');
    Route::post('subscribe/create', [SubscriptionController::class, 'subscribe'])->name("subscribe.create");
    Route::get('subscribe/invoice', [SubscriptionController::class, 'invoice'])->name("subscribe.invoice");
    Route::get('subscribe/cancel', [SubscriptionController::class, 'cancel'])->name("subscribe.cancel");
    Route::get('subscribe/cancel/end', [SubscriptionController::class, 'cancelsubscription'])->name("subscribe.cancelsubscription");
    Route::get('subscribe/resume', [SubscriptionController::class, 'resume'])->name("subscribe.resume");
    Route::get('/user/invoice/{invoice}', function (Request $request, string $invoiceId) {
        return $request->user()->downloadInvoice($invoiceId);
    });

});


route::get('/resultat/setNote',  [\App\Http\Controllers\ResultatController::class, 'setNote']);

Route::get('/newaccount', [NewaccountController::class, 'index'])->name('index');
//Route::get('/newaccount', 'RegistrationController@create');
//Route::post('newaccount', 'RegistrationController@store');

require __DIR__.'/auth.php';
*/