<?php

use App\Http\Controllers\AlamatMobileController;
use App\Http\Controllers\AuthMobileController;
use App\Http\Controllers\BarangMobileController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\PembelianMobileController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\PembeliMobileController;
use App\Http\Controllers\PenitipMobileController;
use App\Http\Controllers\RequestController;
use App\Models\Organisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', [OrganisasiController::class, 'login']);

Route::get('/', [PembeliController::class, 'index']);
Route::post('/pembeli', [PembeliController::class, 'store']);

Route::get('/organisasi/index', [OrganisasiController::class, 'index']);
Route::post('/organisasi', [OrganisasiController::class, 'store']);

Route::get('/request/index', [RequestController::class, 'index']);

Route::middleware('auth:organisasi')->group(function () {
    Route::post('/request', [RequestController::class, 'store']);

    Route::post('/logout', [OrganisasiController::class, 'logout']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/barang/tersedia', [BarangMobileController::class, 'index']);

Route::post('/login', [AuthMobileController::class, 'login']);

Route::get('/barang', [BarangMobileController::class, 'semuaBarang']);

Route::get('/pembeli/{id}', [PembeliMobileController::class, 'show']);

Route::get('/pembelian/pembeli/{id}', [PembelianMobileController::class, 'getPembelianByPembeli']);

Route::get('/alamat/pembeli/{id}', [AlamatMobileController::class, 'getByPembeli']);

Route::get('/penitip-mobile/{id}/history-barang', [PenitipMobileController::class, 'getHistoryBarang']);

Route::get('/penitip/{id}/profil', [PenitipMobileController::class, 'getProfil']);


