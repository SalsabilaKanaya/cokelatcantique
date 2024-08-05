<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\JenisCokelatController;
use App\Http\Controllers\KarakterCokelatController;
use App\Http\Controllers\KustomisasiCokelatController;
use App\Http\Controllers\PilihKarakterController;

// Define the 'beranda' route and name it 'beranda'
Route::get('/', [UserController::class, 'beranda'])->name('beranda');
Route::get('/', [UserController::class, 'testimoni'])->name('beranda');

Route::get('/tentang', [UserController::class, 'tentang'])->name('tentang');

Route::get('/gift_idea', [UserController::class, 'giftIdea'])->name('gift_idea');

Route::get('/jenis_cokelat', [JenisCokelatController::class, 'index'])->name('jenis_cokelat'); // Menampilkan daftar jenis cokelat
Route::get('/jenis_cokelat/{id}', [JenisCokelatController::class, 'show'])->name('detail_jenis_cokelat.show');

Route::get('/karakter_cokelat', [KarakterCokelatController::class, 'index'])->name('karakter_cokelat'); // Menampilkan daftar karakter cokelat
Route::get('/karakter_cokelat/{id}', [KarakterCokelatController::class, 'show'])->name('detail_karakter_cokelat.show');

Route::get('/kustomisasi_cokelat', [KustomisasiCokelatController::class, 'index'])->name('kustomisasi_cokelat');

Route::get('/pilih_karakter', [PilihKarakterController::class, 'index'])->name('pilih_karakter');
Route::get('/karakter_cokelat/{id}', [KarakterController::class, 'getKarakterDetails'])->name('pilih_karakter.details');

Route::get('/kontak', [KontakController::class, 'create'])->name('kontak'); // Halaman form untuk menambah jenis cokelat
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store'); // Menyimpan data jenis cokelat

Route::get('/keranjang', function () {
    return view('keranjang');
})->name('keranjang');

Route::get('/histori', function () {
    return view('histori');
})->name('histori');

Route::get('/profil', function () {
    return view('profil');
})->name('profil');

Route::get('/faq', [UserController::class, 'faq'])->name('faq');

Route::get('/cara_pemesanan', [UserController::class, 'caraPemesanan'])->name('cara_pemesanan');

Route::get('/histori', [UserController::class, 'histori'])->name('histori');

Route::get('/keranjang', [UserController::class, 'keranjang'])->name('keranjang');