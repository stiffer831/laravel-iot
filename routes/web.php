<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

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

Route::get('login', [LoginController::class, 'show'])->name('login.show');

// Need login.
Route::middleware(['iot.login'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'show'])->name('dashboard');
});
