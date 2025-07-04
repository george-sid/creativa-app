<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::post('/language', [HomeController::class, 'language'])->name('language');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('employees')->group(function(){
        Route::get('/',[EmployeeController::class,'index'])->name('employee.list');
        Route::get('/create',[EmployeeController::class,'create'])->name('employee.create');
        Route::get('/{id}',[EmployeeController::class,'update'])->name('employee.update');
        Route::prefix('/ajax')->group(function(){
            Route::post('/store', [EmployeeController::class, 'store'])->name('employee.store');
            Route::post('/delete', [EmployeeController::class, 'destroy'])->name('employee.destroy');
        });
    });

    Route::prefix('companies')->group(function(){
        Route::get('/',[CompanyController::class,'index'])->name('company.list');
        Route::get('/create',[CompanyController::class,'create'])->name('company.create');
        Route::get('/{id}',[CompanyController::class,'update'])->name('company.update');
        Route::prefix('/ajax')->group(function(){
            Route::post('/store', [CompanyController::class, 'store'])->name('company.store');
            Route::post('/delete', [CompanyController::class, 'destroy'])->name('company.destroy');
        });
    });
});

require __DIR__.'/auth.php';
