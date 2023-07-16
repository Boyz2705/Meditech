<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PegawaiController;
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

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/listpegawai', [PegawaiController::class, 'index'])->middleware('auth');
Route::get('/createpegawaibaru', [PegawaiController::class, 'create'])->middleware('admin');
Route::post('/createpegawaibaru', [PegawaiController::class, 'store'])->middleware('admin');
Route::get('/mymember/{username}', [PegawaiController::class, 'listmember'])->middleware('auth');

Route::get('/listobat', [ObatController::class, 'index'])->middleware('auth');
Route::get('/createobat', [ObatController::class, 'create'])->middleware('auth');
Route::post('/createobat', [ObatController::class, 'store'])->middleware('auth');
Route::post('/deleteobat', [ObatController::class, 'delete'])->middleware('auth');
Route::get('/updateobat/{slug}', [ObatController::class, 'edit'])->middleware('auth');
Route::post('/updateobat', [ObatController::class, 'update'])->middleware('auth');

Route::get('/listmember', [MemberController::class, 'index'])->middleware('auth');
Route::get('/createmember', [MemberController::class, 'create'])->middleware('auth');
Route::post('/createmember', [MemberController::class, 'store'])->middleware('auth');

Route::get('/historychat', [ChatController::class, 'index'])->middleware('auth');
Route::get('/historychat/{id}', [ChatController::class, 'detail'])->middleware('auth');
