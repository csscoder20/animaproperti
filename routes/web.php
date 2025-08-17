<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgenController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\RegistrationController;

Route::get('/registrasi-agen', [RegistrationController::class, 'index']);
Route::get('/formulir-registrasi-agen', [RegistrationController::class, 'form_registrasi_agen']);

Route::get('/tentang-kami', [AboutUsController::class, 'index']);
Route::get('/kontak-kami', [ContactController::class, 'index']);
Route::get('/terms/{kategori}', [ContactController::class, 'show'])->name('terms.show');

Route::get('/', [HomeController::class, 'index'])->name('properties.index');
Route::get('/properties/search', [HomeController::class, 'search'])->name('properties.search');
Route::get('/cari', [HomeController::class, 'searchRedirect'])->name('search.redirect');



Route::get('/properti', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properti/{id}', [PropertyController::class, 'show'])->name('property.show');


Route::get('/pendaftaran', [RegistrationController::class, 'index'])->name('agen.index');
Route::post('/pendaftaran', [RegistrationController::class, 'store'])->name('agen.submit');


Route::get('/api/wilayah/{parentKode}', [RegistrationController::class, 'getChildren']);

// Cetak invoice penjualan
Route::get('/invoice/{id}', [InvoiceController::class, 'show'])->name('invoice.show');

Route::get('/kontak-agen', [AgenController::class, 'index']);
Route::get('/agen/{id}/properti', [AgenController::class, 'showProperti'])->name('agen.properti');
Route::get('/agen/{id}', [AgenController::class, 'show'])->name('agen.show');

// Informasi routes
Route::get('/berita', [InformasiController::class, 'berita'])->name('berita.index');
Route::get('/berita/{slug}', [InformasiController::class, 'detail_berita'])->name('berita.detail');


Route::get('/api/announcement/active', [AnnouncementController::class, 'getActive']);
