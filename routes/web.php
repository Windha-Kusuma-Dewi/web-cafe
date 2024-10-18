<?php

use Illuminate\Support\Facades\Route;

use App\http\Controllers\LandingPageController;
use App\Http\Controllers\CafeController;
use App\Http\Controllers\UserController;
use App\Models\Cafe;


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

// Route::get('/', function () {
//     return view('welcome');
// });

//halaman landing page
Route::get('/', [LandingPageController::class,'index'])->name('landing_page');

// halaman cafe
Route::get('/home', [CafeController::class, 'index'])->name('home');
Route::get('/cafes/add', [CafeController::class, 'create'])->name('cafes.add');
Route::post('/cafes/add', [CafeController::class, 'store'])->name('cafes.add.store');
Route::delete('/cafes/delete/{id}', [CafeController::class, 'destroy'])->name('cafes.delete');
Route::get('/cafes/edit/{id}', [CafeController::class, 'edit'])->name('cafes.edit');
Route::patch('/cafes/edit/{id}', [CafeController::class, 'update'])->name('cafes.edit.update');

//halaman user
Route::get('/user', [UserController::class, 'index'])->name('user');
Route::get('/user/tambah', [UserController::class, 'create'])->name('user.tambah');
Route::post('/user/tambah', [UserController::class, 'store'])->name('user.tambah.store');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::patch('/user/edit/{id}', [UserController::class, 'update'])->name('user.edit.update');
Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
