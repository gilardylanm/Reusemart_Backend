<?php

use App\Models\Organisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\RequestController;


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