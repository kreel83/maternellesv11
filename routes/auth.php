<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegisteredUserController::class, 'create'])
                ->middleware('guest')
                ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest');          

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest')
                ->name('login.post');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth')
                ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');

// *******************************                
// Création de compte Admin / User
// *******************************
Route::get('/register/start', [RegisteredUserController::class, 'registrationStart'])->name('registration.start');
Route::get('/register/step1/{role}', [RegisteredUserController::class, 'registrationStep1'])->name('registration.step1');
Route::post('/register/step1', [RegisteredUserController::class, 'registrationStep1Post'])->name('registration.step1.post');
Route::get('/register/step2/{role}/{ecole_id}/{token}', [RegisteredUserController::class, 'registrationStep2'])->name('registration.step2');
Route::post('/register/step2', [RegisteredUserController::class, 'registrationStep2Post'])->name('registration.step2.post');
Route::get('/register/step3/{role}/{ecole_id}/{token}', [RegisteredUserController::class, 'registrationStep3'])->name('registration.step3');
Route::post('/register/step3', [RegisteredUserController::class, 'registrationStep3Post'])->name('registration.step3.post');
Route::get('/register/step4', [RegisteredUserController::class, 'registrationStep4'])->name('registration.step4');
Route::get('/register/validation/{token}', [RegisteredUserController::class, 'valideUser'])->name('registration.validation');  // utilisé pour valider une adresse mail depuis email
// utilisé dans register.js :
Route::post('/register/search/etablissement', [RegisteredUserController::class, 'registrationChercheEtablissement']);
// route pour création simplifiée de compte sans code etablissement, uniquement enseignant :
Route::post('/register/newaccount', [RegisteredUserController::class, 'registrationNewaccountPost'])->name('registration.newaccount.post');