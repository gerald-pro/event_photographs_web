<?php

use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InvitationController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/register', [AuthApiController::class, 'register']);
Route::middleware('auth:api')->group(function () {
    Route::get('/logout', [AuthApiController::class, 'logout']);
    Route::get('/refresh', [AuthApiController::class, 'refresh']);
});

Route::post('invitations/store', [InvitationController::class, 'sendInvitationMail'])->name('api.invitations.store');


Route::middleware('auth:sanctum')->group(function () {
    Route::get('events', [EventController::class, 'index']);
    Route::get('events/{event}', [EventController::class, 'show']);
    Route::get('user', [UserController::class, 'show']);
    Route::get('events/{event}/pictures', [EventController::class, 'pictures']);
    Route::get('my-pictures', [EventController::class, 'myPictures']);

    //Route::get('/qr-generate', [PaymentController::class, 'generate']);
    Route::get('/check-transactions', [PaymentController::class, 'checkTransactions']);
    Route::post('/save-sale-note', [PaymentController::class, 'saveSaleNote']);
});

//Route::get('/qr-generate', [PaymentController::class, 'generate']);
Route::get('/qr-generate', [PaymentController::class, 'generate']);
Route::get('/consultar', [PaymentController::class, 'consultarEstado']);
Route::get('/check', [PaymentController::class, 'checkTransactions']);

Route::get('users', function () {
    return User::all();
});

Route::post('token', [AuthController::class, 'requestToken']);
