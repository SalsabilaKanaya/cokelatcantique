<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\JenisCokelatController;
use App\Http\Controllers\KarakterCokelatController;
use App\Http\Controllers\KustomisasiCokelatController;
use App\Http\Controllers\PilihKarakterController;


// Rute default untuk halaman login
Route::get('/', function () {
    return redirect()->route('login'); // Redirect ke halaman login
})->name('home');

// Rute untuk login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Rute untuk register
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Route untuk login
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Rute untuk halaman beranda
Route::get('/beranda', [WebController::class, 'beranda'])->name('beranda')->middleware('auth');

// Rute lainnya
Route::get('/tentang', [WebController::class, 'tentang'])->name('tentang');

Route::get('/gift_idea', [WebController::class, 'giftIdea'])->name('gift_idea');

Route::get('/jenis_cokelat', [JenisCokelatController::class, 'index'])->name('jenis_cokelat');
Route::get('/jenis_cokelat/{id}', [JenisCokelatController::class, 'show'])->name('detail_jenis_cokelat.show');

Route::get('/karakter_cokelat', [KarakterCokelatController::class, 'index'])->name('karakter_cokelat');
Route::get('/karakter_cokelat/{id}', [KarakterCokelatController::class, 'show'])->name('detail_karakter_cokelat.show');

Route::get('/kustomisasi_cokelat', [KustomisasiCokelatController::class, 'index'])->name('kustomisasi_cokelat');
Route::post('/store-jenis-cokelat-selection', [KustomisasiCokelatController::class, 'storeJenisCokelatSelection'])->name('store_jenis_cokelat_selection');

Route::get('/pilih_karakter', [PilihKarakterController::class, 'index'])->name('pilih_karakter');
Route::get('/karakter_cokelat/{id}', [PilihKarakterController::class, 'getKarakterDetails'])->name('karakter_cokelat.details');
Route::post('/store-selection', [PilihKarakterController::class, 'storeSelection'])->name('store_selection');


Route::get('/kontak', [KontakController::class, 'create'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');
Route::get('/keranjang', [WebController::class, 'keranjang'])->name('keranjang');
Route::get('/histori', [WebController::class, 'histori'])->name('histori');
Route::get('/profil', function () {
    return view('profil');
})->name('profil');
Route::get('/faq', [WebController::class, 'faq'])->name('faq');
Route::get('/cara_pemesanan', [WebController::class, 'caraPemesanan'])->name('cara_pemesanan');
