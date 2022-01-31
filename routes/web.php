<?php

use App\Http\Controllers\loginController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('/auth/github/redirect',[loginController::class,'redirectToProviderGithub']);

Route::get('/auth/github/callback',[loginController::class,'handleProviderCallBackGithub']);

Route::get('/auth/google/redirect',[loginController::class,'redirectToProviderGoogle']);

Route::get('/auth/google/callback',[loginController::class,'handleProviderCallBackGoogle']);





require __DIR__ . '/auth.php';

