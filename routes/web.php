<?php

use App\Http\Controllers\CutiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\JatahCutiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoleController;
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

Route::get('/login}', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [DashboardController::class, 'index']);
});

// Route::group(['prefix' => 'user'], function () {
//     Route::get('/', [UserController::class, 'index'])->name('user');
//     Route::get('/create', [UserController::class, 'create'])->name('user/create');
//     Route::post('/store', [UserController::class, 'store'])->name('user/store');
//     Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user/edit');
//     Route::post('/update/{id}', [UserController::class, 'update'])->name('user/update');
//     Route::get('/delete/{id}', [UserController::class, 'destroy'])->name('user/destroy');
//     Route::get('/detailuser/{id}', [UserController::class, 'detailuser'])->name('user/detailuser');
// });

// Route::group(['prefix' => 'cuti'], function () {
//     Route::get('/', [CutiController::class, 'index'])->name('cuti');
//     Route::get('/create', [CutiController::class, 'create'])->name('cuti/create');
//     Route::post('/store', [CutiController::class, 'store'])->name('cuti/store');
//     Route::get('/edit/{id}', [CutiController::class, 'edit'])->name('cuti/edit');
//     Route::post('/update/{id}', [CutiController::class, 'update'])->name('cuti/update');
//     Route::get('/delete/{id}', [CutiController::class, 'destroy'])->name('cuti/destroy');
// });

// Route::group(['prefix' => 'divisi'], function () {
//     Route::get('/', [DivisiController::class, 'index'])->name('divisi');
//     Route::get('/create', [DivisiController::class, 'create'])->name('divisi/create');
//     Route::post('/store', [DivisiController::class, 'store'])->name('divisi/store');
//     Route::get('/edit/{id}', [DivisiController::class, 'edit'])->name('divisi/edit');
//     Route::post('/update/{id}', [DivisiController::class, 'update'])->name('divisi/update');
//     Route::get('/delete/{id}', [DivisiController::class, 'destroy'])->name('divisi/destroy');
// });

// Route::group(['prefix' => 'role'], function () {
//     Route::get('/', [RoleController::class, 'index'])->name('role');
//     Route::get('/create', [RoleController::class, 'create'])->name('role/create');
//     Route::post('/store', [RoleController::class, 'store'])->name('role/store');
//     Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('role/edit');
//     Route::post('/update/{id}', [RoleController::class, 'update'])->name('role/update');
//     Route::get('/delete/{id}', [RoleController::class, 'destroy'])->name('role/destroy');
// });


Route::group(['middleware' => ['auth', 'role:hr']], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index'])->name('user');
        Route::get('/create', [UserController::class, 'create'])->name('user/create');
        Route::post('/store', [UserController::class, 'store'])->name('user/store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user/edit');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('user/update');
        Route::get('/delete/{id}', [UserController::class, 'destroy'])->name('user/destroy');
        Route::get('/detailuser/{id}', [UserController::class, 'detailuser'])->name('user/detailuser');
        Route::get('/exportpdf/{id}', [UserController::class, 'exportpdf'])->name('user/exportpdf');
        Route::get('/excel', [UserController::class, 'excel'])->name('user/excel');
        Route::get('/exportexcel', [UserController::class, 'export'])->name('user/exportexcel');
    });

    Route::group(['prefix' => 'cuti'], function () {
        Route::get('/', [CutiController::class, 'index'])->name('cuti');
        Route::get('/create', [CutiController::class, 'create'])->name('cuti/create');
        Route::post('/store', [CutiController::class, 'store'])->name('cuti/store');
        Route::get('/edit/{id}', [CutiController::class, 'edit'])->name('cuti/edit');
        Route::post('/update/{id}', [CutiController::class, 'update'])->name('cuti/update');
        Route::get('/delete/{id}', [CutiController::class, 'destroy'])->name('cuti/destroy');
    });

    Route::group(['prefix' => 'divisi'], function () {
        Route::get('/', [DivisiController::class, 'index'])->name('divisi');
        Route::get('/create', [DivisiController::class, 'create'])->name('divisi/create');
        Route::post('/store', [DivisiController::class, 'store'])->name('divisi/store');
        Route::get('/edit/{id}', [DivisiController::class, 'edit'])->name('divisi/edit');
        Route::post('/update/{id}', [DivisiController::class, 'update'])->name('divisi/update');
        Route::get('/delete/{id}', [DivisiController::class, 'destroy'])->name('divisi/destroy');
    });
});

Route::group(['middleware' => ['auth', 'role:karyawan|hr|manager|it']], function () {
    Route::group(['prefix' => 'jatahcuti'], function () {
        Route::get('/', [JatahCutiController::class, 'index'])->name('jatahcuti');
        Route::get('/create', [JatahCutiController::class, 'create'])->name('jatahcuti/create');
        Route::post('/store', [JatahCutiController::class, 'store'])->name('jatahcuti/store');
        Route::get('/detailcuti/{id}', [JatahCutiController::class, 'details'])->name('jatahcuti/detailcuti');
        Route::get('/exportpdf/{id}', [JatahCutiController::class, 'exportpdf'])->name('jatahcuti/exportpdf');
    });
});

Route::group(['middleware' => ['auth', 'role:manager']], function () {
    Route::group(['prefix' => 'manager'], function () {
        Route::get('/', [JatahCutiController::class, 'manager'])->name('manager');
        Route::post('/approve/{id}', [JatahCutiController::class, 'approve'])->name('manager/approve');
        Route::post('/reject/{id}', [JatahCutiController::class, 'reject'])->name('manager/reject');
    });
});

Route::group(['middleware' => ['auth', 'role:it']], function () {
    Route::group(['prefix' => 'role'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('role');
        Route::get('/create', [RoleController::class, 'create'])->name('role/create');
        Route::post('/store', [RoleController::class, 'store'])->name('role/store');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('role/edit');
        Route::post('/update/{id}', [RoleController::class, 'update'])->name('role/update');
        Route::get('/delete/{id}', [RoleController::class, 'destroy'])->name('role/destroy');
    });
});
