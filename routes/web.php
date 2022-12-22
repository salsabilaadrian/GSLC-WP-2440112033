<?php

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

Route::get('/', function () {
    return view('loginuser');
});

Route::get('auth/google', [App\Http\Controllers\LoginController::class,'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [App\Http\Controllers\LoginController::class,'handleGoogleCallback'])->name('google.callback');

Route::get('auth/facebook', [App\Http\Controllers\LoginController::class,'redirectToFacebook'])->name('facebook.login');
Route::get('auth/facebook/callback', [App\Http\Controllers\LoginController::class,'handleFacebookCallback'])->name('facebook.callback');

Route::post('/regisuser', [App\Http\Controllers\LoginController::class,'regisuser'])->name('regisuser');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

