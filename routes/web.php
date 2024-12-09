<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;

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



Route::middleware(['guest'])->controller(LoginController::class)->group(function(){
    Route::get('/login','index')->name('login.show');
    Route::post('/login','login')->name('login');
});
Route::controller(LogoutController::class)->group(function(){
Route::post('/logout','logout')->name('logout');
});

Route::get('/', function () {
    return redirect()->route('login.show');
});

Route::middleware(['auth'])->controller(DashboardController::class)->prefix('admin')->group(function(){
    Route::get('/dashboard','dashboard')->name('dashboard');
});