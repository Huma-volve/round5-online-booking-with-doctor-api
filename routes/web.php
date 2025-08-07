<?php

<<<<<<< HEAD
use App\Http\Controllers\Admin\DoctorController;
=======

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

>>>>>>> 624c06ca54501a957b2c6a7396845ab2d261256e
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;

use App\Models\Specialty;
use Illuminate\Http\Request;
Route::get('/', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('users',UserController::class);
Route::resource('doctors',DoctorController::class);



require __DIR__.'/auth.php';
