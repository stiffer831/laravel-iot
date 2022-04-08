<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardGroupsController;

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
Route::get('logout', [LoginController::class, 'out'])->name('logout');
Route::post('login', [LoginController::class, 'submit'])->name('login.submit');

// Need login.
Route::middleware(['iot.login'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'show'])->name('dashboard');
    // Customers
    Route::name('customer.')
        ->prefix('customer')
        ->group(function () {
            Route::get('profile', [CustomerController::class, 'profile'])->name('profile');
        });
    // Dashboard Groups
    Route::name('dashboard_groups.')
        ->prefix('dashboard_groups')
        ->group(function () {
            Route::get('/{group_id}', [DashboardGroupsController::class, 'listInfo'])->name('list_info');
            Route::get('/{id}/detail',[DashboardGroupsController::class, 'detail'])->name('detail');
            Route::get('/{id}/detail_export',[DashboardGroupsController::class, 'detail_export'])->name('detail_export');
        });
});
