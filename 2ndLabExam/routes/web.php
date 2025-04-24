<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
  return view('welcome');
});

Route::resource('/tasks', TaskController::class);
Route::patch('tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');

Route::fallback(function () {
  return redirect()->back()->with('error', 'The requested page does not exist.');
});
