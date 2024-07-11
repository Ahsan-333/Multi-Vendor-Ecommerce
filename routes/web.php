<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
});
