<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LicenseController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/license', [LicenseController::class, 'index'])->name('license');
Route::get('/license/create', [LicenseController::class, 'create'])->name('create_license');
Route::post('/license/save', [LicenseController::class, 'store'])->name('save_license');
Route::post('/license/activation/{id}', [LicenseController::class, 'update_activation']);
Route::delete('/license/delete/{id}', [LicenseController::class, 'destroy']);

// no csrf token required
Route::post('/licensing/verify', [LicenseController::class, 'verify_license']);