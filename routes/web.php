<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SentenceController;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/auth', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect('/home');
    });
    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/sentence', [SentenceController::class, 'index']);
    Route::get('/sentence/getAll', [SentenceController::class, 'getAll']);
    Route::post('/sentence', [SentenceController::class, 'create']);
    Route::put('/sentence/{sentence}', [SentenceController::class, 'update']);
    Route::delete('/sentence/{sentence}', [SentenceController::class, 'delete']);
});