<?php

use App\Http\Controllers\Backend\AdminController;
// use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\UserProfileController;

// Route::get('/', function () {
//     return view('frontend.home.home');
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->middleware('role:admin')->name('admin.dashboard');
// Route::get('vendor/dashboard', [VendorController::class, 'dashboard'])->middleware('role:vendor')->name('vendor.dashboard');

Route::get('admin/login', [AdminController::class, 'login']);
Route::get('/', [HomeController::class, 'index']);
                
Route::group(['middleware'=>['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function(){
   Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
   Route::get('/profile', [UserProfileController::class, 'index'])->name('profile');
   Route::put('/profile', [UserProfileController::class, 'updateProfile'])->name('profile.update');
   Route::post('/profile', [UserProfileController::class, 'updatePassword'])->name('profile.update.password');
});
