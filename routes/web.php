<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MaintenanceController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('/dispositivos', DeviceController::class);
    Route::resource('/clientes', CustomerController::class);

    Route::get('/mantenimientos', [App\Http\Controllers\MaintenanceController::class,'getIndex'])->name('mantenimientos.index');
    Route::get('/mantenimientos/create', [App\Http\Controllers\MaintenanceController::class,'getCreate'])->name('mantenimientos.create');
    Route::post('/mantenimientos/create', [App\Http\Controllers\MaintenanceController::class,'postStore'])->name('mantenimientos.store');
    Route::get('/mantenimientos/edit/{id}', [App\Http\Controllers\MaintenanceController::class,'getEdit'])->name('mantenimientos.edit');
    Route::put('/mantenimientos/update/{id}', [App\Http\Controllers\MaintenanceController::class,'putUpdate'])->name('mantenimientos.update');
    Route::delete('/mantenimientos/delete/{id}', [App\Http\Controllers\MaintenanceController::class,'deleteDestroy'])->name('mantenimientos.destroy');

    Route::resource('/tecnicos', \App\Http\Controllers\TechnicianController::class)->middleware('admin');
});


