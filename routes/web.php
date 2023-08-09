<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
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

Route::get('/', [HomeController::class, 'index'])->name('homepage');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('/companies')->group(function () {

    Route::get('/{id}/profile', [CompanyController::class, 'show'])->name('company.show');
    Route::get('/{id}/jobs', [CompanyController::class, 'jobsList'])->name('company.jobs');

    Route::middleware(['auth:company'])->group(function () {
        Route::get('/edit', [CompanyController::class, 'edit'])->name('company.edit');
        Route::post('/store', [CompanyController::class, 'store'])->name('company.store');
    });
});

Route::prefix('/users')->group(function () {

    Route::get('/{id}/profile', [UserController::class, 'show'])->name('user.show');

    Route::middleware(['auth:user'])->group(function () {
        Route::post('/upload/cv', [UserController::class, 'uploadCv'])->name('user.uploadCv');
        Route::get('/apply/{jobId}', [UserController::class, 'apply'])->name('user.apply');
        Route::get('/applied-job', [UserController::class, 'appliedJobs'])->name('user.appliedJobs');
    });
});

Route::prefix('/jobs')->group(function () {

    Route::middleware(['auth:company'])->group(function () {
        Route::get('/edit', [JobController::class, 'edit'])->name('job.edit');
        Route::post('/store', [JobController::class, 'store'])->name('job.store');
    });

    Route::get('/', [JobController::class, 'index'])->name('job.index');
    Route::get('/filter', [JobController::class, 'filter'])->name('job.filter');
    Route::get('/{id}', [JobController::class, 'show'])->name('job.show');
});
