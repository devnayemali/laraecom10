<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SectionController;
use Illuminate\Routing\Controllers\Middleware;
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
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Profile Route
    Route::get('profile', [ProfileController::class, 'edit'])->name('admin.profile');
    Route::post('profile-update', [ProfileController::class, 'update'])->name('admin.updateprofile');
    Route::post('check-current-password', [ProfileController::class, 'check_current_password'])->name('check-current-password');
    Route::post('update-password', [ProfileController::class, 'update_password'])->name('admin.updatepassword');

    // Vendor Route
    Route::middleware(['vendor'])->group(function () {
        Route::match(['get', 'post'], 'update-vendor-details/{slug}', [ProfileController::class, 'updateVendorDetails'])->name('admin.updatevendordetails');
    });

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('/admin-view/{id}', [AdminController::class, 'admin_view'])->name('admin.admin-view');
    Route::post('/admin-status/{id}', [AdminController::class, 'admin_status'])->name('admin.admin-status');

    Route::get('/section', [SectionController::class, 'index'])->name('admin.section-index');
    Route::get('/section/create', [SectionController::class, 'create'])->name('admin.section-create');
    Route::post('/section', [SectionController::class, 'store'])->name('admin.section-store');
    Route::post('/section/update', [SectionController::class, 'update'])->name('admin.section-update');
    Route::post('/section-status/{id}', [SectionController::class, 'section_status'])->name('admin.section-status');
    Route::delete('/section-delete/{id}', [SectionController::class, 'destroy'])->name('admin.section-destroy');

    // Category
    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category-index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('admin.category-create');
    Route::post('/category', [CategoryController::class, 'store'])->name('admin.category-store');

});
require __DIR__ . '/auth.php';
