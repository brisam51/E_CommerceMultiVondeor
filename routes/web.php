<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Admin\AdminController;


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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';




Route::prefix('/admin')->group(function () {
    Route::match(['get', 'post'], 'login', [AdminController::class, 'login']);
    Route::group(['middleware' => ['admin']], function () {
        //Admin dashboard
        Route::get('dashboard', [AdminController::class, 'dashboard']);
        //admin log out
        Route::get('logout', [AdminController::class, 'logout']);

        //admin update  password
        Route::match(['get', 'post'], 'update-admin-password', [AdminController::class, 'updateAdminPassword']);
        //check  admin current password
        Route::post('check-admin-password', [AdminController::class, 'checkAdminPassword']);
        
        //update vendor details
        Route::match(['get','post'], 'update-vendor-details/{slug}', [AdminController::class, 'updateVendorDetails']);

        //slug test
        Route::match(['get','post'], 'update-vendor-slugtest/{slug}', [AdminController::class, 'slugtest']);

        //View Admins/Sub Admins and Vendors
        Route::get('admins/{type?}',[AdminController::class,'admins']);
        //admin update details
        Route::match(['get', 'post'], 'update-admin-detials', [AdminController::class, 'updateAdminDetails']);
    });
});
