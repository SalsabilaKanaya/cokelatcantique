<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\JenisCokelatController;
use App\Http\Controllers\KarakterCokelatController;
use App\Http\Controllers\KustomisasiCokelatController;
use App\Http\Controllers\PilihKarakterController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('login');
});

Route::get('/auth/redirect', [SocialController::class, 'redirect'])->name('google.redirect');
Route::get('/google/redirect', [SocialController::class, 'googleCallback'])->name('google.callback');

// Route::middleware('auth')->group(function () {
//     Route::get('/beranda', function () {
//         return view('beranda');
//     })->name('beranda');
// });

Route::get('/beranda', [WebController::class, 'beranda'])->name('beranda');


Route::get('/tentang', [WebController::class, 'tentang'])->name('tentang');

Route::get('/gift_idea', [WebController::class, 'giftIdea'])->name('gift_idea');


Route::get('/jenis_cokelat', [JenisCokelatController::class, 'index'])->name('jenis_cokelat');
Route::get('/jenis_cokelat/{id}', [JenisCokelatController::class, 'show'])->name('detail_jenis_cokelat.show');

Route::get('/karakter_cokelat', [KarakterCokelatController::class, 'index'])->name('karakter_cokelat');
Route::get('/karakter_cokelat/{id}', [KarakterCokelatController::class, 'show'])->name('detail_karakter_cokelat.show');
Route::post('/store-selection', [KarakterController::class, 'storeSelection'])->name('store.selection');

Route::get('/kustomisasi_cokelat', [KustomisasiCokelatController::class, 'index'])->name('kustomisasi_cokelat');
Route::post('/store-jenis-cokelat-selection', [KustomisasiCokelatController::class, 'storeJenisCokelatSelection'])->name('store_jenis_cokelat_selection');
Route::get('/pilih-karakter', [KustomisasiKarakterController::class, 'index'])->name('pilih_karakter');

Route::get('/pilih_karakter', [PilihKarakterController::class, 'index'])->name('pilih_karakter');
Route::get('/karakter_cokelat/{id}', [PilihKarakterController::class, 'getKarakterDetails'])->name('karakter_cokelat.details');
Route::post('/store-selection', [PilihKarakterController::class, 'storeSelection'])->name('store_selection');
Route::get('/get-progress', [PilihKarakterController::class, 'getProgress']);


Route::get('/proses-pemesanan', [ProsesOrderController::class, 'showForm'])->name('proses_pesanan');
Route::post('/simpan-pesanan', [ProsesOrderController::class, 'store'])->name('simpan_pesanan');
Route::post('/finalisasi-pesanan', [ProsesOrderController::class, 'store'])->name('finalize_pesanan');

Route::get('/kontak', [KontakController::class, 'create'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');
Route::get('/keranjang', [WebController::class, 'keranjang'])->name('keranjang');
Route::get('/histori', [WebController::class, 'histori'])->name('histori');


Route::get('/profil', [ProfileController::class, 'profil'])->name('profil');
Route::put('/profil/update', [ProfileController::class, 'updateProfil'])->name('profil.update');
Route::get('/profil/edit', [ProfileController::class, 'editProfil'])->name('profil.edit');

Route::get('/faq', [WebController::class, 'faq'])->name('faq');
Route::get('/cara_pemesanan', [WebController::class, 'caraPemesanan'])->name('cara_pemesanan');

Route::post('/logout', [SocialController::class, 'logout'])->name('logout');