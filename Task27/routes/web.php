<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
  return view('welcome');
});

Route::middleware('auth')->group(function () {
  Route::get('/dashboard', [UserController::class, 'Dashboard'])->name('dashboard');
  Route::post('/logout', [UserController::class, 'LogoutUser'])->name('logout');
});

Route::middleware('guest')->group(function () {
  Route::get('/authform', [UserController::class, 'AuthForm'])->name('authform');
  Route::post('/login', [UserController::class, 'LoginUser'])->name('login');
  Route::post('/register', [UserController::class, 'RegisterUser'])->name('register');
});

Route::fallback(function () {
  return redirect()->back()->with('toast_error', 'The requested page does not exist.')
    ->withFallback(Auth::check() ? route('dashboard') : route('authform'));
});
