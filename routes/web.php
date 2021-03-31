<?php

use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth', 'verified')->name('home');

Route::prefix('dashboard')->name('dashboard')->middleware('auth', 'verified')->group(function() {

    Route::view('/', 'dashboard');
    Route::get('/user/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('.user.profile');
    Route::put('/user/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('.user.profile.update');
    Route::post('/user/profile/change-profile-picture', [App\Http\Controllers\ProfileController::class, 'changeProfilePicture'])->name('.user.profile.change-profile-picture');
    
    Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('.user.index');
    Route::get('/user/all', [App\Http\Controllers\UserController::class, 'all'])->name('.user.all');
    Route::post('/user/create', [App\Http\Controllers\UserController::class, 'create'])->name('.user.create');
    Route::get('/user/edit/{uuid}', [App\Http\Controllers\UserController::class, 'edit'])->name('.user.edit');
    Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('.user.update');
    Route::delete('/user/delete/{uuid}', [App\Http\Controllers\UserController::class, 'delete'])->name('.user.delete');
    
    Route::get('/user/export_excel', [App\Http\Controllers\UserController::class, 'exportExcel'])->name('.user.export_excel');
});