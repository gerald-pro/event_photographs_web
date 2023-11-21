<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\InvitationController;
use App\Models\Event;
use App\Models\User;

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

Route::get('events', function () {
    return Event::all();
});

Route::get('events/{event}/pictures', function (int $eventId) {
    return Event::find($eventId)->pictures;
});

Route::get('users', function () {
    return User::all();
});
