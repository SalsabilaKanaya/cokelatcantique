<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\JenisCokelatController;
use App\Http\Controllers\KarakterCokelatController;
use App\Http\Controllers\KustomisasiCokelatController;
use App\Http\Controllers\PilihKarakterController;
use App\Http\Controllers\ProsesOrderController;
use App\Http\Controllers\FinalOrderController;

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/beranda', [WebController::class, 'beranda'])->name('beranda');
});


// Route::get('/', function () {
//     return redirect()->route('beranda');
// })->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/beranda', [WebController::class, 'beranda'])->name('beranda');

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
Route::post('/store-selection', [KarakterController::class, 'storeSelection'])->name('store.selection');

Route::get('/proses-pemesanan', [ProsesOrderController::class, 'showForm'])->name('proses_pesanan');
Route::post('/simpan-pesanan', [ProsesOrderController::class, 'store'])->name('simpan_pesanan');
Route::post('/finalisasi-pesanan', [ProsesOrderController::class, 'store'])->name('finalize_pesanan');


Route::get('/kontak', [KontakController::class, 'create'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');
Route::get('/keranjang', [WebController::class, 'keranjang'])->name('keranjang');
Route::get('/histori', [WebController::class, 'histori'])->name('histori');
Route::get('/profil', function () {
    return view('profil');
})->name('profil');
Route::get('/faq', [WebController::class, 'faq'])->name('faq');
Route::get('/cara_pemesanan', [WebController::class, 'caraPemesanan'])->name('cara_pemesanan');
