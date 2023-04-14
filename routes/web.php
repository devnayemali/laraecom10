<?php

use App\Http\Controllers\Admin\AdminController;
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



// Frontend Route
Route::get('/', function(){
    return 'Front End';
});


// Admin Panel Route
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');

    // update profile
    Route::post('update-admin-profile', [AdminController::class, 'update_profile'])->name('admin.updateprofile');
    // check password
    Route::post('check-current-password', [AdminController::class, 'check_current_password'])->name('check-current-password');
    // update password
    Route::post('update-password', [AdminController::class, 'update_password'])->name('admin.updatepassword');




});
require __DIR__ . '/auth.php';
