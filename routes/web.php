<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//  USER
use App\Http\Controllers\User\SocialController;
use App\Http\Controllers\User\WebController;
use App\Http\Controllers\User\KontakController;
use App\Http\Controllers\User\JenisCokelatController;
use App\Http\Controllers\User\KarakterCokelatController;
use App\Http\Controllers\User\KustomisasiCokelatController;
use App\Http\Controllers\User\PilihKarakterController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\PesanController;
use App\Http\Controllers\User\ProsesOrderController;
use App\Http\Controllers\User\RajaOngkirController;
use App\Http\Controllers\User\KurirController;
use App\Http\Controllers\User\OngkirController;
use App\Http\Controllers\User\AddressController;
use App\Http\Controllers\User\HistoriController;

// ADMIN
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CreateJenisCokelatController;
use App\Http\Controllers\Admin\CreateKarakterCokelatController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\KontakMasukController;
use App\Http\Controllers\Admin\OrderMasukController;


// Rute User
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/auth/redirect', [SocialController::class, 'redirect'])->name('google.redirect');
    Route::get('/google/redirect', [SocialController::class, 'googleCallback'])->name('google.callback');
    
    Route::middleware('auth:user')->group(function () {
        Route::get('/beranda', [WebController::class, 'beranda'])->name('beranda');
        Route::get('/tentang', [WebController::class, 'tentang'])->name('tentang');
        Route::get('/gift_idea', [WebController::class, 'giftIdea'])->name('gift_idea');
        Route::get('/jenis_cokelat', [JenisCokelatController::class, 'index'])->name('jenis_cokelat');
        Route::get('/jenis_cokelat/{id}', [JenisCokelatController::class, 'show'])->name('detail_jenis_cokelat.show');
        Route::get('/karakter_cokelat', [KarakterCokelatController::class, 'index'])->name('karakter_cokelat');
        Route::get('/karakter_cokelat/{id}', [KarakterCokelatController::class, 'show'])->name('detail_karakter_cokelat.show');
        Route::post('/store-selection', [PilihKarakterController::class, 'storeSelection'])->name('store.selection');
        Route::get('/kustomisasi_cokelat', [KustomisasiCokelatController::class, 'index'])->name('kustomisasi_cokelat');
        Route::post('/store-jenis-cokelat-selection', [KustomisasiCokelatController::class, 'storeJenisCokelatSelection'])->name('store_jenis_cokelat_selection');
        Route::get('/pilih_karakter', [PilihKarakterController::class, 'index'])->name('pilih_karakter');
        Route::get('/karakter_cokelat/details/{id}', [PilihKarakterController::class, 'getKarakterDetails'])->name('karakter_cokelat.details');
        Route::post('/store-selection', [PilihKarakterController::class, 'storeSelection'])->name('store_selection');
        Route::get('/get-progress', [PilihKarakterController::class, 'getProgress']);
        Route::post('/process-order', [PilihKarakterController::class, 'processOrder'])->name('process_order');
        Route::get('/pemesanan', [ProsesOrderController::class, 'index'])->name('pemesanan');
        Route::post('/available_services', [ProsesOrderController::class, 'shippingfee'])->name('shippingfee');
        Route::post('/choose-package', [ProsesOrderController::class, 'choosePackage'])->name('choosepackage');
        Route::post('/order', [ProsesOrderController::class, 'store'])->name('order.store');
        Route::get('/kontak', [KontakController::class, 'create'])->name('kontak');
        Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');
        Route::get('/keranjang', [WebController::class, 'keranjang'])->name('keranjang');
        Route::get('/histori', [HistoriController::class, 'showHistori'])->name('histori');
        Route::get('/pesanan/{order}', [HistoriController::class, 'showDetail'])->name('pesanan.detail');
        Route::get('/profil', [ProfileController::class, 'profil'])->name('profil');
        Route::put('/profil/update', [ProfileController::class, 'updateProfil'])->name('profil.update');
        Route::get('/profil/edit', [ProfileController::class, 'editProfil'])->name('profil.edit');
        Route::get('/address/edit', [AddressController::class, 'edit'])->name('address.editAddress');
        Route::put('/address/update', [AddressController::class, 'update'])->name('address.updateAddress');
        Route::get('/api/get-provinces', [AddressController::class, 'getProvinces']);
        Route::get('/api/get-cities/{provinceId}', [AddressController::class, 'getCities']);
        Route::get('/faq', [WebController::class, 'faq'])->name('faq');
        Route::get('/cara_pemesanan', [WebController::class, 'caraPemesanan'])->name('cara_pemesanan');
        Route::post('/logout', [SocialController::class, 'logout'])->name('logout');
    });
});


// Rute Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.login');
    });

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'Login']);

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [OrderMasukController::class, 'dashboard'])->name('dashboard');
        Route::post('/order/{order}/accept', [OrderMasukController::class, 'acceptOrder'])->name('order.accept');
        Route::post('/order/{order}/reject', [OrderMasukController::class, 'rejectOrder'])->name('order.reject');
        Route::get('/order_list', [OrderMasukController::class, 'orderList'])->name('order_list');
        Route::get('/order/{order}/detail', [OrderMasukController::class, 'detailOrder'])->name('detail_order');

        Route::get('/jenis_cokelat', [CreateJenisCokelatController::class, 'index'])->name('jenis_cokelat');
        Route::delete('/jenis_cokelat/{id}', [CreateJenisCokelatController::class, 'destroy'])->name('delete_jenis');
        Route::get('/create_jenis', [CreateJenisCokelatController::class, 'create'])->name('create_jenis');
        Route::post('/create_jenis', [CreateJenisCokelatController::class, 'store'])->name('create_jenis.store');
        Route::get('/edit_jenis/{id}', [CreateJenisCokelatController::class, 'edit'])->name('edit_jenis');
        Route::put('/edit_jenis/{id}', [CreateJenisCokelatController::class, 'update'])->name('edit_jenis.update');

        Route::get('/karakter_cokelat', [CreateKarakterCokelatController::class, 'index'])->name('karakter_cokelat');
        Route::delete('/karakter_cokelat/{id}', [CreateKarakterCokelatController::class, 'destroy'])->name('delete_karakter');
        Route::get('/create_karakter', [CreateKarakterCokelatController::class, 'create'])->name('create_karakter');
        Route::post('/create_karakter', [CreateKarakterCokelatController::class, 'store'])->name('create_karakter.store');
        Route::get('/edit_karakter/{id}', [CreateKarakterCokelatController::class, 'edit'])->name('edit_karakter');
        Route::put('/edit_karakter/{id}', [CreateKarakterCokelatController::class, 'update'])->name('edit_karakter.update');

        Route::get('/kontak', [KontakMasukController::class, 'index'])->name('kontak');
    });

    Route::post('/logout', [AuthController::class, 'adminLogout'])->name('logout');
});

