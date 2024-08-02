<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Define the 'beranda' route and name it 'beranda'
Route::get('/', [UserController::class, 'beranda'])->name('beranda');
Route::get('/', [UserController::class, 'testimoni'])->name('beranda');

Route::get('/tentang', [UserController::class, 'tentang'])->name('tentang');

Route::get('/gift_idea', [UserController::class, 'giftIdea'])->name('gift_idea');

Route::get('/jenis_cokelat', function () {
    return view('jenis_cokelat');
})->name('jenis_cokelat');

Route::get('/karakter_cokelat', function () {
    return view('karakter_cokelat');
})->name('karakter_cokelat');

Route::get('/kustomisasi_cokelat', function () {
    return view('kustomisasi_cokelat');
})->name('kustomisasi_cokelat');

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

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
