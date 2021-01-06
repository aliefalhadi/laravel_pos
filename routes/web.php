<?php

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

Route::get("/", function () {
    return view("welcome");
});

Auth::routes();

Route::get("/home", \App\Http\Livewire\Dashboard::class);
Route::get("/user", \App\Http\Livewire\User\IndexUser::class)->name(
    "user.index"
);
Route::get("/kategori", \App\Http\Livewire\Kategori\IndexKategori::class)->name(
    "kategori.index"
);
Route::get("/satuan", \App\Http\Livewire\Satuan\IndexSatuan::class)->name(
    "satuan.index"
);

Route::get("/produk", \App\Http\Livewire\Produk\IndexProduk::class)->name(
    "produk.index"
);

Route::get(
    "/produk/tambah",
    \App\Http\Livewire\Produk\TambahProduk::class
)->name("produk.tambah");

Route::get("/select2", \App\Http\Livewire\Shared\RupiahInput::class);
