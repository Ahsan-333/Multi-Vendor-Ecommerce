<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorProfileController;

Route::get('dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
Route::get('profile', [VendorProfileController::class, 'index'])->name('profile');
Route::put('/profile', [UserProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('/profile', [UserProfileController::class, 'updatePassword'])->name('profile.update.password');