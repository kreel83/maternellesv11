<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AdminLicenceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnfantController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GroupeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CahierController;
use App\Http\Controllers\ParametreController;
use App\Http\Controllers\ficheController;
use App\Http\Controllers\GoogleConnect;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TutoController;
use App\Http\Controllers\NewaccountController;
use App\Http\Controllers\PartageController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Http\Request;


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

// USER DASHBOARD
/*
Route::get('/user_dashboard', function () {
    return view('user_dashboard');
})->middleware('user')->name('user_dashboard');

*/
// ADMIN URLs (directeurs) protected by 'admin' Middleware
Route::middleware(['admin'])->group(function()
{
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin/dashboard', [AdminController::class, 'chercherUnEleve'])->name('admin.chercherUnEleve');
    Route::get('/admin/dashboard/{user_id}', [AdminController::class, 'voirClasse'])->name('admin.voirClasse');
    //Route::get('/admin/eleve/view/{user_id}/{id}', [AdminController::class, 'voirEleve'])->name('admin.voirEleve');
    Route::get('/admin/eleve/view/{enfant_id}', [AdminController::class, 'voirEleve'])->name('admin.voirEleve');
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/admin/profil', [AdminController::class, 'loadAdminProfile'])->name('admin.loadprofile');
    Route::post('/admin/profil', [AdminController::class, 'saveAdminProfile'])->name('admin.saveprofile');
    Route::get('/admin/pwd', [AdminController::class, 'changerLeMotDePasse'])->name('admin.changerLeMotDePasse');
    Route::post('/admin/pwd', [AdminController::class, 'sauverLeMotDePasse'])->name('admin.sauverLeMotDePasse');
    Route::get('/admin/licence', [AdminLicenceController::class, 'index'])->name('admin.licence.index');
    Route::post('/admin/licence', [AdminLicenceController::class, 'renew'])->name('admin.licence.renew');
    Route::get('/admin/licence/achat', [AdminLicenceController::class, 'achat'])->name('admin.licence.achat');
    Route::post('/admin/licence/achat', [AdminLicenceController::class, 'create'])->name('admin.licence.create');
    //Route::post('/admin/licence/assign', [AdminLicenceController::class, 'assign']);  // dans subscription.js prefixé par /app
    Route::get('/admin/licence/remove/{licence_name}', [AdminLicenceController::class, 'confirmationRetraitLicence'])->name('admin.licence.remove');
    Route::post('/admin/licence/remove', [AdminLicenceController::class, 'retraitLicence'])->name('admin.licence.remove.post');
    Route::get('/admin/invoice', [AdminLicenceController::class, 'invoice'])->name('admin.licence.invoice');
    Route::get('/admin/invoice/{number}', [AdminLicenceController::class, 'downloadInvoice'])->name('admin.invoice.download');
    // cette routes est appellée par Stripe dans le cas d'une authentification 3DS en retour de paiement
    // routes utilisées dans AdminLicenceController@create dans la gestion d'exception
    Route::get('/admin/licence/{method}', [AdminLicenceController::class, 'stripeRedirect'])->name('admin.stripe.redirect');
    Route::get('/admin/licence/reminder/{licence_name}', [AdminLicenceController::class, 'sendReminder'])->name('admin.licence.sendreminder');
    
    Route::get('/admin/licence/assign/{licence_name}', [AdminLicenceController::class, 'assigneLicenceStep1'])->name('admin.licence.assign.step1');
    Route::post('/admin/licence/assign/', [AdminLicenceController::class, 'assigneLicenceStep1Post'])->name('admin.licence.assign.step1Post');

    Route::get('/admin/contact', [AdminController::class, 'contact'])->name('admin.contact');
    Route::post('/admin/contact', [ContactController::class, 'envoiLaDemandeDeContact'])->name('admin.contact.post');
    //Route::post('/admin/contact/store', [ContactController::class, 'store'])->name('admin.contact.store');    
    /*
    Route::get('/admin/invoice/{invoice}', function (Request $request, string $invoiceId) {
        return $request->user()->downloadInvoice($invoiceId);
    });
    */
});

// Admin registration URLs
/*
// User Validation url from admin creation
Route::get('/user/validation/{token}', [UserController::class, 'valideUserFromAdminCreatePassword'])->name('user.valideUserFromAdminCreatePassword');  // utilisé pour valider une adresse mail depuis email
Route::post('/user/validation/store', [UserController::class, 'valideUserFromAdminSavePassword'])->name('user.valideUserFromAdminSavePassword');  // sauve le mot de passe et active le compte
Route::get('/user/validation/reminder/{token}', [UserController::class, 'valideUserFromReminderEmail'])->name('user.valideUserFromReminderEmail');  // utilisé pour valider une adresse mail depuis email
// User Validation url from self registration
Route::get('/user/validation/self', [UserController::class, 'validUserFromSelfRegistration'])->name('user.validUserFromSelfRegistration');  // utilisé pour valider une adresse mail depuis email
*/

// CRON routes
Route::get('/deleteuser', [UserController::class, 'deleteinactiveuser'])->name('user.deleteinactive');

// Contact form (utilisé dans contact.js seulement avec prefix /app )
//Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');

Route::get('/parent',[EnfantController::class, 'parent']);
Route::post('/parent',[EnfantController::class, 'parent_mdp'])->name('parent');
Route::get('/connect', [GoogleConnect::class, 'connect'])->name('GoogleConnect');


// Route::middleware(['auth'])->group(function () {
//     Route::get('/abonnement', [SubscriptionController::class, 'index'])->name('subscribe.index');
    
//     Route::get('/subscribe', [SubscriptionController::class, 'cardform'])->name('subscribe.cardform');
//     Route::post('subscribe/create', [SubscriptionController::class, 'subscribe'])->name("subscribe.create");
//     Route::get('/subscribe/result', [SubscriptionController::class, 'stripeRedirect'])->name('user.stripe.redirect');
//     Route::get('/', [parametreController::class, 'welcome'])->name('depart');
//     Route::get('/contact', [UserController::class, 'contact'])->name('contact');
//     Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
//     Route::get('/home', [HomeController::class, 'index'])->name('home');
//     Route::get('/deco', [UserController::class, 'deco'])->name('deco');
//     Route::get('/error', [parametreController::class, 'error'])->name('error');
// });

//Route::middleware(['auth'])->group(function () {
    // Les URLs ci-dessous nécessitent authentification + abonnement en cours
    Route::middleware(['auth','user'])->group(function () {
        //Route::get('/', [parametreController::class, 'welcome'])->name('depart');
        
        //Route::get('/contact', [UserController::class, 'contact'])->name('contact');

    Route::get('/abonnement', [SubscriptionController::class, 'index'])->name('subscribe.index');

    Route::get('/subscribe', [SubscriptionController::class, 'cardform'])->name('subscribe.cardform');
    Route::post('subscribe/create', [SubscriptionController::class, 'subscribe'])->name("subscribe.create");
    Route::get('/subscribe/result', [SubscriptionController::class, 'stripeRedirect'])->name('user.stripe.redirect');
    Route::get('/', [parametreController::class, 'welcome'])->name('depart');
    Route::get('/contact', [UserController::class, 'contact'])->name('contact');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/deco', [UserController::class, 'deco'])->name('deco');
    Route::get('/error', [parametreController::class, 'error'])->name('error');        
        
    Route::get('/tutos', [TutoController::class, 'index'])->name('tutos');
    Route::get('/tutos/ajax', [TutoController::class, 'ajax'])->name('ajax');
    Route::get('/tutos/modetuto', [TutoController::class, 'modetuto'])->name('modeTuto');
    Route::get('/reussite', [EnfantController::class, 'reussite'])->name('reussite');

    Route::get('/toto', [CahierController::class, 'toto'])->name('cahiertoto');

    Route::get('/enfants', [EnfantController::class, 'index'])->name('enfants');
    Route::get('/enfants/{enfant_id}/items', [ItemController::class, 'index'])->name('items');
    Route::get('/enfants/{enfant_id}/cahier', [CahierController::class, 'index'])->name('cahier');
    Route::get('/enfants/{enfant_id}/cahierV2', [CahierController::class, 'indexv2'])->name('cahierV2');
    Route::get('/enfants/{enfant_id}/pdfview', [CahierController::class, 'pdfview'])->name('pdfview');
    Route::get('/enfants/{enfant_id}/redoPdf', [CahierController::class, 'redoPdf'])->name('redoPdf');
    Route::post('/enfants/{enfant_id}/cahier/saveCommentaireGeneral', [CahierController::class, 'saveCommentaireGeneral'])->name('saveCommentaireGeneral');
    Route::post('/enfants/{enfant_id}/translate', [CahierController::class, 'translate'])->name('translate');
    Route::post('/enfants/{enfant_id}/cahier/save/{section_id}', [CahierController::class, 'saveTexte'])->name('saveTexte');
    Route::post('/enfants/{enfant_id}/cahier/saveTexteReussite', [CahierController::class, 'definitif'])->name('saveTexteReussite');
    Route::post('/enfants/{enfant_id}/cahier/reformuler', [CahierController::class, 'reformuler'])->name('reformuler');
    Route::get('/enfants/{enfant_id}/cahier/reactualiser', [CahierController::class, 'reactualiser'])->name('reactualiser');
    Route::get('/enfants/{enfant_id}/cahier/calcul_duration', [CahierController::class, 'calcul_duration'])->name('calcul_duration');
    Route::get('/enfants/{enfant_id}/cahier/seepdf/{state}', [CahierController::class, 'seepdf'])->name('seepdf');
    Route::get('/enfants/{enfant_id}/add_phrase/{commentaire_id}', [CahierController::class, 'add_phrase'])->name('add_phrase');
    Route::get('/enfants/{enfant_id}/remove_phrase/{phrase_id}', [CahierController::class, 'remove_phrase'])->name('remove_phrase'); // A VERIFIER id si enfant et utilisé cahier.js ligne 41
    Route::get('/cahiers/get_apercu/{enfant_id}', [CahierController::class, 'get_apercu'])->name('get_apercu');
    Route::get('/enfants/{enfant_id}/cahier/savepdf', [CahierController::class, 'savepdf'])->name('savepdf');
    Route::get('/enfants/{enfant_id}/avatar', [EnfantController::class, 'avatarEleve'])->name('avatarEleve');
    Route::get('/enfants/{id}/cahier/apercu', [CahierController::class, 'apercu'])->name('apercu'); // voir doublon avec seepdf
    Route::get('/cahier/{reussite_id}/definitif', [CahierController::class, 'definitif'])->name('definitif');
    /*
    Route::get('/enfants/{id}/items', [ItemController::class, 'index'])->name('items');
    Route::get('/enfants/{id}/cahier', [CahierController::class, 'index'])->name('cahier');
    Route::get('/enfants/{id}/pdfview', [CahierController::class, 'pdfview'])->name('pdfview');
    Route::get('/enfants/{id}/redoPdf', [CahierController::class, 'redoPdf'])->name('redoPdf');
    Route::post('/enfants/{id}/cahier/saveCommentaireGeneral', [CahierController::class, 'saveCommentaireGeneral'])->name('saveCommentaireGeneral');
    Route::post('/enfants/{id}/translate', [CahierController::class, 'translate'])->name('translate');
    Route::post('/enfants/{id}/cahier/save', [CahierController::class, 'saveTexte'])->name('saveTexte');
    Route::post('/enfants/{id}/cahier/saveTexteReussite', [CahierController::class, 'definitif'])->name('saveTexteReussite');
    Route::post('/enfants/{id}/cahier/reformuler', [CahierController::class, 'reformuler'])->name('reformuler');
    Route::get('/enfants/{id}/cahier/reactualiser', [CahierController::class, 'reactualiser'])->name('reactualiser');
    Route::get('/enfants/{id}/cahier/calcul_duration', [CahierController::class, 'calcul_duration'])->name('calcul_duration');
    Route::get('/enfants/{id}/cahier/seepdf/{state}', [CahierController::class, 'seepdf'])->name('seepdf');
    Route::get('/enfants/{id}/add_phrase/{phrase}', [CahierController::class, 'add_phrase'])->name('add_phrase');
    Route::get('/enfants/{id}/remove_phrase/{phrase}', [CahierController::class, 'remove_phrase'])->name('remove_phrase');
    Route::get('/cahiers/get_apercu/{id}', [CahierController::class, 'get_apercu'])->name('get_apercu');
    Route::get('/enfants/{id}/cahier/savepdf', [CahierController::class, 'savepdf'])->name('savepdf');
    Route::get('/enfants/{id}/avatar', [EnfantController::class, 'avatarEleve'])->name('avatarEleve');
    Route::get('/enfants/{id}/cahier/apercu', [CahierController::class, 'apercu'])->name('apercu');
    Route::post('/enfants/{id}/cahier/definitif', [CahierController::class, 'definitif'])->name('definitif');
    */

    Route::get('/item/saveResultat', [ItemController::class, 'saveResultat'])->name('saveResultat');
    Route::get('/item/upgradeResultat', [ItemController::class, 'upgradeResultat'])->name('upgradeResultat');
    //Route::get('/home', [HomeController::class, 'index'])->name('home');
    //Route::get('/deco', [UserController::class, 'deco'])->name('deco');
    Route::get('/choix_enfant_select', [EnfantController::class, 'choix_enfant_select'])->name('choix_enfant_select');
    Route::get('/enfants/cahier/envoi', [CahierController::class, 'envoiCahier'])->name('envoiCahier');
    Route::post('/enfants/cahier/envoi', [CahierController::class, 'envoiCahierPost'])->name('envoiCahier.post');
        
    Route::get('/enfants/cahier/manage', [PdfController::class, 'cahierManage'])->name('cahierManage');
    Route::post('/enfants/cahier/manage', [PdfController::class, 'cahierManagePost'])->name('cahierManage.post');
    Route::get('/enfants/cahier/apercu/{token}/{enfant_id}/{periode}', [CahierController::class, 'seepdf'])->name('cahierApercu');
    //Route::get('/enfants/cahier/apercu', [CahierController::class, 'seepdf'])->name('cahierApercu');
    // cette route est utilisée dans pdf.js :
    Route::post('/enfants/cahier/envoi/individuel', [PdfController::class, 'envoiCahierIndividuel'])->name('cahierManage.individuel');

    Route::get('/get_liste_phrase/{section_id}/{enfant_id}', [CahierController::class, 'get_liste_phrase'])->name('get_liste_phrase');
    Route::get('/get_images/{section_id}', [FicheController::class, 'get_images'])->name('get_images');
    Route::post('/set_image', [FicheController::class, 'set_image'])->name('set_image');
    Route::get('/setNewCategories', [FicheController::class, 'setNewCategories'])->name('setNewCategories');
    Route::get('/set_ordre', [PdfController::class, 'set_ordre'])->name('set_ordre');
    Route::get('/getFiche', [ItemController::class, 'getFiche'])->name('getFiche');
    Route::post('/cahier/CommitSaveReussite', [ItemController::class, 'CommitSaveReussite'])->name('CommitSaveReussite');
    Route::get('/enfants/{enfant_id}/cahier/getReussite', [ItemController::class, 'getReussite'])->name('getReussite');

    Route::get('/affectation_groupe',[GroupeController::class,'affectation_groupe'])->name('affectation_groupe');
    Route::get('/groupe/affectation',[GroupeController::class,'affectation'])->name('affectation');
    Route::get('/groupe',[GroupeController::class,'index'])->name('groupe');
    Route::post('/groupe/saveColor',[GroupeController::class,'saveColor'])->name('saveColor');
    Route::post('/groupe/saveTermes',[GroupeController::class,'saveTermes'])->name('saveTermes');
    Route::get('/groupe/edit/{id}',[GroupeController::class,'editerUnGroupe'])->name('editerUnGroupe');
    Route::get('/groupe/supprimer/{id}',[GroupeController::class,'supprimerUnGroupe'])->name('supprimerUnGroupe');
    Route::post('/groupe/edit',[GroupeController::class,'editerUnGroupePost'])->name('editerUnGroupePost');
    // Route::get('/groupe/remove/{id}',[GroupeController::class,'supprimerUnGroupe'])->name('supprimerUnGroupe');
    // Route::post('/groupe/remove',[GroupeController::class,'supprimerUnGroupePost'])->name('supprimerUnGroupePost');

    Route::get('/parametres', [parametreController::class, 'index'])->name('parametres');
    Route::get('/parametres/phrases', [parametreController::class, 'phrases'])->name('phrases');
    Route::post('/parametres/phrases/save', [parametreController::class, 'savePhrases'])->name('savePhrases');
    Route::get('/parametres/phrases/{commentaire_id}/delete', [parametreController::class, 'deletePhrase'])->name('deletePhrase');
    Route::get('/parametres/get_phrases', [parametreController::class, 'get_phrases'])->name('get_phrases');
    Route::get('/parametres/activeDomaineEleve', [parametreController::class, 'activeDomaineEleve'])->name('activeDomaineEleve');
    Route::get('/parametres/activeAcquisAide', [parametreController::class, 'activeAcquisAide'])->name('activeAcquisAide');
    Route::get('/parametres/classe',[parametreController::class,'parametresClasse'])->name('parametresClasse');

    Route::get('/fiches', [ficheController::class, 'index'])->name('fiches');
    Route::get('/fiches/setClassification', [ficheController::class, 'setClassification'])->name('setClassification');
    Route::get('/fiches/deselectionne', [ficheController::class, 'deselectionne'])->name('deselectionne');
    Route::get('/fiches/{fiche_id}/setLvl', [ficheController::class, 'setLvl'])->name('setLvl');
    
    Route::post('/fiches/choisirSelection', [ficheController::class, 'choisirSelection']);
    Route::get('/fiches/duplicate', [ficheController::class, 'duplicate']);
    Route::get('/fiches/choix', [ficheController::class, 'choix']);
    Route::get('/fiches/retirerChoix', [ficheController::class, 'retirerChoix']);
    Route::post('/fiches/save_fiche', [ficheController::class, 'savefiche'])->name('saveFiche');
    Route::post('/fiches/order', [ficheController::class, 'orderFiche'])->name('orderFiche');
    Route::get('/fiches/create', [ficheController::class, 'createFiche'])->name('createFiche');
    Route::post('/fiches/populate/classification', [ficheController::class, 'populateClassification'])->name('populateClassification');
    Route::post('/fiches/populate/categorie', [ficheController::class, 'populateCategorie'])->name('populateCategorie');
    Route::post('/fiches/setSection', [ficheController::class, 'setSection'])->name('setSection');
    Route::post('/fiches/importTemplate', [ficheController::class, 'importTemplate'])->name('importTemplate');
    Route::post('/fiches/saveTemplate', [ficheController::class, 'saveTemplate'])->name('saveTemplate');


    Route::get('/classe/changer',[ClasseController::class,'changerclasse'])->name('changerClasse');
    Route::get('/classe/create',[ClasseController::class,'createclasse'])->name('createclasse');
    Route::post('/classe/confirme',[ClasseController::class,'confirmeClasse'])->name('confirmeClasse');
    Route::post('/classe/save',[ClasseController::class,'saveclasse'])->name('saveNewClasse');
    Route::get('/classe/edit',[ClasseController::class,'updateclasse'])->name('updateClasse');

    Route::get('/groupe',[GroupeController::class,'index'])->name('groupe');
    Route::get('/maclasse',[EnfantController::class,'maclasse'])->name('maclasse');

    Route::get('/eleves',[EnfantController::class,'liste'])->name('eleves');
    Route::get('/eleves/toggleInactiveEleve',[EnfantController::class,'toggleInactiveEleve'])->name('toggleInactiveEleve');
    // Route::post('/eleves/save',[EnfantController::class,'save'])->name('save_eleve');
    Route::post('/eleves/update',[EnfantController::class,'enregistre'])->name('enregistreEleve');
    Route::post('/eleves/ajouterEleves',[EnfantController::class,'ajouterEleves'])->name('ajouterEleves');
    Route::get('/eleves/removeEleve',[EnfantController::class,'removeEleve'])->name('removeEleve');
    Route::get('eleves/setAnimaux',[EnfantController::class,'setAnimaux'])->name('setAnimaux');
    Route::get('eleves/view/{enfant_id}',[EnfantController::class,'voirEleve'])->name('voirEleve');
    Route::get('eleves/getAnneeEnCours',[EnfantController::class,'getAnneeEnCours'])->name('getAnneeEnCours');
    Route::get('eleves/add',[EnfantController::class,'addEleve'])->name('addEleve');
    Route::get('eleves/import',[EnfantController::class,'import'])->name('import');

    Route::get('/ecole',[\App\Http\Controllers\EcoleController::class,'index'])->name('ecole');
    Route::get('/ecole/chercheCommune',[\App\Http\Controllers\EcoleController::class,'chercheCommune'])->name('chercheCommune');
    Route::get('/ecole/chercheEcoles',[\App\Http\Controllers\EcoleController::class,'chercheEcoles'])->name('chercheEcoles');
    Route::get('/ecole/choixEcole',[\App\Http\Controllers\EcoleController::class,'choixEcole'])->name('choixEcole');
    Route::get('/ecole/confirmation',[\App\Http\Controllers\EcoleController::class,'confirmationEcole'])->name('confirmationEcole');

    Route::get('/calendar/periodes/init',[\App\Http\Controllers\CalendrierController::class,'init']);
    Route::get('/calendar',[\App\Http\Controllers\CalendrierController::class,'index'])->name('calendar');
    Route::get('/periode',[\App\Http\Controllers\CalendrierController::class,'periode'])->name('periode');
    Route::get('/periode/save',[\App\Http\Controllers\CalendrierController::class,'periode_save'])->name('periode_save');
    Route::post('/calendar/periodes/save',[\App\Http\Controllers\CalendrierController::class,'savePeriode']);
    Route::post('/calendar/event/add',[\App\Http\Controllers\CalendrierController::class,'saveEvent'])->name('event');
    Route::get('/calendar/event/delete/{event_id}',[\App\Http\Controllers\CalendrierController::class,'deleteEvent'])->name('deleteEvent');
    Route::get('/calendar/getEvent',[\App\Http\Controllers\CalendrierController::class,'getEvent'])->name('getEvent');
    Route::get('/calendar/getPeriodes',[\App\Http\Controllers\CalendrierController::class,'getPeriodes'])->name('getPeriodes');
    
    Route::get('/calendrier',[\App\Http\Controllers\CalendrierController::class,'calendrier'])->name('calendrier');

    Route::get('/password/change',[\App\Http\Controllers\ParametreController::class,'password_change'])->name('password_change');
    Route::post('/password/change',[\App\Http\Controllers\ParametreController::class,'password_save'])->name('password_save');
    Route::get('/password',[\App\Http\Controllers\EnfantController::class,'password'])->name('password');
    Route::post('/password_operation',[\App\Http\Controllers\EnfantController::class,'password_operation'])->name('password_operation');

    Route::get('/editerPDF/{enfant_id}', [CahierController::class, 'editerPDF'])->name('editerPDF');
    Route::get('/deleteReussite/{enfant_id}', [CahierController::class, 'deleteReussite'])->name('deleteReussite');

    Route::get('/monprofil', [ParametreController::class, 'monprofil'])->name('monprofil');
    Route::post('/monprofil', [ParametreController::class, 'savemonprofil'])->name('savemonprofil');
    Route::get('/pwd', [ParametreController::class, 'changerLeMotDePasse'])->name('changerLeMotDePasse');
    Route::post('/pwd', [ParametreController::class, 'sauverLeMotDePasse'])->name('sauverLeMotDePasse');

    Route::get('/aidematernelle', [ParametreController::class, 'aidematernelle'])->name('aidematernelle');
    Route::post('/aidematernelle', [ParametreController::class, 'saveaidematernelle'])->name('aidematernelle.post');
    Route::get('/directeur', [ParametreController::class, 'directeur'])->name('directeur');
    Route::post('/directeur', [ParametreController::class, 'savedirecteur'])->name('directeur.post');

    Route::get('/mesfiches', [ItemController::class, 'mesfiches'])->name('mesfiches');
    
    Route::get('/initClasse', [AdminController::class, 'initClasse'])->name('initClasse');
    Route::get('/recupClasse', [AdminController::class, 'recupClasse'])->name('recupClasse');

    Route::get('/avatar', [EnfantController::class, 'avatar'])->name('avatar');

    Route::get('/partage', [PartageController::class, 'index'])->name('partager');
    Route::post('/partage/add', [PartageController::class, 'ajoutePartage'])->name('ajoutePartage');
    Route::post('/partage/sendmail', [PartageController::class, 'sendMailPartage'])->name('sendMailPartage');
    Route::get('/partage/remove/{classeuser_id}', [PartageController::class, 'supprimePartage'])->name('supprimePartage');
    Route::post('/partage/remove/final', [PartageController::class, 'supprimePartageFinal'])->name('supprimePartageFinal');
    Route::get('/partage/create/{token}', [PartageController::class, 'acceptePartage'])->name('acceptePartage');
    Route::get('/partage/code/{classeuser_id}', [PartageController::class, 'sendCodePartage'])->name('sendCodePartage');

    //Route::get('/subscribe', [SubscriptionController::class, 'cardform'])->name('subscribe.cardform');
    //Route::post('subscribe/create', [SubscriptionController::class, 'subscribe'])->name("subscribe.create");
    Route::get('subscribe/invoice', [SubscriptionController::class, 'invoice'])->name("subscribe.invoice");
    Route::get('subscribe/cancel', [SubscriptionController::class, 'cancel'])->name("subscribe.cancel");
    Route::get('subscribe/cancel/end', [SubscriptionController::class, 'cancelsubscription'])->name("subscribe.cancelsubscription");
    Route::get('subscribe/resume', [SubscriptionController::class, 'resume'])->name("subscribe.resume");
    Route::post('subscribe/resume', [SubscriptionController::class, 'resumeSubscription'])->name("subscribe.resumesubscription");
    Route::get('subscribe/waiting', [SubscriptionController::class, 'stripeAttenteFinalisation'])->name("subscribe.waiting");

    Route::get('/invoice/download/{facture_number}', [SubscriptionController::class, 'downloadInvoice'])->name('user.invoice.download');
    Route::get('invoice/send/{facture_number}', [SubscriptionController::class, 'sendInvoice'])->name("subscribe.invoice.send");    

});

// un middleware 'abo'  qui est come le auth
//middleware['auth','abo']  pour le reste
// dans abon  mettre fonction qui verifie la licence et redirige sur une vue pour dire non abonné

route::get('/resultat/setNote',  [\App\Http\Controllers\ResultatController::class, 'setNote']);

Route::get('/newaccount', [NewaccountController::class, 'index'])->name('index');
//Route::get('/newaccount', 'RegistrationController@create');
//Route::post('newaccount', 'RegistrationController@store');

require __DIR__.'/auth.php';
