<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\PasswordConfirmationController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Calender\CalendarController;
use App\Http\Controllers\Calender\EventsInvitesController;
use App\Http\Controllers\Main\UserController;
use App\Http\Controllers\Main\IndexController;
use App\Http\Controllers\Main\ContactsControler;
use App\Http\Controllers\Main\AboutUsController;
use App\Http\Controllers\Main\TermsController;
use App\Http\Controllers\Main\UpdateController;
use App\Http\Controllers\Main\FriendsController;
use App\Http\Controllers\Friend\ProfileController;
use App\Http\Controllers\Friend\SearchController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/auth/{provider}/redirect', [ProviderController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [ProviderController::class, 'callback']);

Route::get('/', [IndexController::class, '__invoke'])
    ->name('index');

Route::get('/contacts', [ContactsControler::class, 'index'])
    ->name('contacts');

Route::get('/about-us', [AboutUsController::class, 'index'])
    ->name('about-us');

Route::get('/terms', [TermsController::class, 'index'])
    ->name('terms');

Route::post('/change/password', [UpdateController::class, 'update_password'])
    ->name('change_password');

Route::middleware('auth')->group(function ()
{
    Route::get('/calendar/index', [CalendarController::class, 'index'])
        ->middleware('verified')->name('dashboard');
    Route::post('/calendar', [CalendarController::class, 'store'])
        ->middleware('verified')->name('calendar.store');
    Route::post('/calendar/invite', [EventsInvitesController::class, 'store'])
        ->middleware('verified')->name('invite.store');
    Route::patch('/calendar/update/{id}', [CalendarController::class, 'update'])
        ->middleware('verified')->name('calendar.update');
    Route::patch('/calendar/update_done/{id}', [CalendarController::class, 'update_done'])
        ->middleware('verified')->name('calendar.update_done');
    Route::patch('/calendar/update_draggable/{id}', [CalendarController::class, 'update_draggable'])
        ->middleware('verified')->name('calendar.update_draggable');
    Route::delete('/calendar/destroy/{id}', [CalendarController::class, 'destroy'])
        ->middleware('verified')->name('calendar.destroy');

    Route::get('/friends', [FriendsController::class, 'index'])
        ->middleware('verified')->name('friends');
    Route::get('/friends/add/{user_id}', [FriendsController::class, 'getAdd'])
        ->middleware('verified')->name('friend-add');
    Route::get('/friends/accept/{user_id}', [FriendsController::class, 'getAccept'])
        ->middleware('verified')->name('friend-accept');
    Route::post('/friends/delete/{user_id}', [FriendsController::class, 'deleteFriend'])
        ->middleware('verified')->name('friend-delete');
    Route::get('/user/{user_id}', [ProfileController::class, 'getProfile'])
        ->middleware('verified')->name('profile');
    Route::get('/friends/requests', [FriendsController::class, 'requests'])
        ->middleware('verified')->name('requests-friends');
    Route::get('/friends/search', [SearchController::class, 'getResults'])
        ->middleware('verified')->name('search-results');
    Route::get('/friends/invites', [EventsInvitesController::class, 'eventsInvites'])
        ->middleware('verified')->name('events-invites');
    Route::delete('/friends/invites/decline/{invite_id}', [EventsInvitesController::class, 'invitesDecline'])
        ->middleware('verified')->name('events-invites-decline');
    Route::post('/friends/invites/accept/{invite_id}', [EventsInvitesController::class, 'invitesAccept'])
        ->middleware('verified')->name('events-invites-accept');

    Route::get('/account', [UserController::class, 'account'])
        ->middleware('verified')->name('account');

    Route::get('/change/password', [UpdateController::class, 'change_password'])
        ->name('change_password');

    Route::get('/change/email', [UpdateController::class, 'change_email'])
        ->middleware('password.confirm')->name('change_email');

    Route::post('/change/email', [UpdateController::class, 'update_email'])
        ->name('change_email');

    Route::get('/confirm-password', [PasswordConfirmationController::class, 'show'])
        ->name('password.confirm');

    Route::post('/confirm-password', [PasswordConfirmationController::class, 'store']);

    Route::get('/account/edit', [UpdateController::class, 'account_update'])
        ->name('account-update');

    Route::post('/account/edit', [UpdateController::class, 'account_update_submit'])
        ->name('account-update');

    Route::post('/account/logout', [LoginController::class, 'destroy'])
        ->name('logout');

    Route::get('/account/email/verify', [EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');

    Route::get('/account/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware('signed')->name('verification.verify');

    Route::post('/account/email/verification-notification', [EmailVerificationNotificationController::class, '__invoke'])
        ->name('verification.send');

});

Route::middleware('guest')->group(function ()
{
    Route::get('/account/login', [LoginController::class, 'create_with_email'])
        ->name('login');

    Route::post('/account/login', [LoginController::class, 'store_with_email'])
        ->name('login');

    Route::get('/account/sign-up', [RegisterController::class, 'index'])
        ->name('register');

    Route::get('/account/sign-up-email', [RegisterController::class, 'create_with_email'])
        ->name('register-email');

    Route::post('/account/sign-up-email', [RegisterController::class, 'store_with_email'])
        ->name('register-email');

    Route::get('/account/forgot-password', [ForgotPasswordController::class, 'create'])
        ->name('password.request');

    Route::post('/account/forgot-password', [ForgotPasswordController::class, 'store'])
        ->name('password.email');

    Route::get('/account/reset-password', [ResetPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('/account/reset-password', [ResetPasswordController::class, 'store'])
        ->name('password.update');

});












