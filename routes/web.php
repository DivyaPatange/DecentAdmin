<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Admin\AcademicYearController;
use App\Http\Controllers\Admin\StandardController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\JuniorAdmissionController;

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

Route::prefix('admin')->name('admin.')->group(function() {
    // Admin Authentication Route
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('logout');
    // Academic Year Route
    Route::resource('/academic-year', AcademicYearController::class);
    Route::post('/get-academic-year', [AcademicYearController::class, 'getAcademicYear'])->name('get.academic-year');
    Route::post('/academic-year/update', [AcademicYearController::class, 'updateAcademicYear']);
    // Standard Route
    Route::resource('/standards', StandardController::class);
    Route::post('/get-standard', [StandardController::class, 'getStandard'])->name('get.standard');
    Route::post('/standard/update', [StandardController::class, 'updateStandard']);
    // Section Route
    Route::resource('/sections', SectionController::class);
    Route::post('/get-section', [SectionController::class, 'getSection'])->name('get.section');
    Route::post('/section/update', [SectionController::class, 'updateSection']);
    // Class Route
    Route::resource('/class', ClassController::class);
    Route::post('/get-class', [ClassController::class, 'getClass'])->name('get.class');
    Route::post('/class/update', [ClassController::class, 'updateClass']);
    // Junior College Admission Route
    Route::resource('/junior-college-admission', JuniorAdmissionController::class);
});
