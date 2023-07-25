<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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
Route::get('/registrasi', [AuthController::class, 'registrasi']);
Route::get('/login', [AuthController::class, 'login']);
Route::post('/postRegistrasi', [AuthController::class, 'postRegistrasi']);
Route::post('/postLogin', [AuthController::class, 'postLogin']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'dashboard']);
Route::get('/tambah-mobil', [DashboardController::class, 'tambahMobil']);
Route::get('/cari-mobil', [DashboardController::class, 'cariMobil']);
Route::post('/postMobil', [DashboardController::class, 'postMobil']);
Route::get('/pesan-mobil', [DashboardController::class, 'pesanMobil']);
Route::post('/postPesanMobil', [DashboardController::class, 'postPesanMobil']);
Route::post('/changeStatus', [DashboardController::class, 'postChangeStatus']);
Route::get('/transaksi', [DashboardController::class, 'transaksi']);
Route::get('/transaksi-detail', [DashboardController::class, 'transaksiDetail']);
