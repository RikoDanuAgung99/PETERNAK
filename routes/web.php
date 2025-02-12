<?php

use App\Http\Controllers\KematianController;
use App\Http\Controllers\PakanController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\BwController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::resource('pengguna', UserController::class);
});

Route::group(attributes: ['prefix' => 'admin', 'middleware' => ['auth']], routes: function () {
    Route::resource(name: 'pengguna', controller: UserController::class);
    Route::resource(name: 'kematian', controller: KematianController::class);
    Route::get(uri: 'get-kematian', action: [KematianController::class, 'getKematian'])->name(name: 'get.kematian');
});

Route::group(attributes: ['prefix' => 'admin', 'middleware' => ['auth']], routes: function () {
    Route::resource(name: 'pengguna', controller: UserController::class);
    Route::resource(name: 'pakan', controller: PakanController::class);
    Route::get(uri: 'get-pakan', action: [PakanController::class, 'getPakan'])->name(name: 'get.pakan');
});

Route::group(attributes: ['prefix' => 'admin', 'middleware' => ['auth']], routes: function () {
    Route::resource(name: 'pengguna', controller: UserController::class);
    Route::resource(name: 'obat', controller: ObatController::class);
    Route::get(uri: 'get-obat', action: [ObatController::class, 'getObat'])->name(name: 'get.obat');
});

Route::group(attributes: ['prefix' => 'admin', 'middleware' => ['auth']], routes: function () {
    Route::resource(name: 'pengguna', controller: UserController::class);
    Route::resource(name: 'bw', controller: BwController::class);
    Route::get(uri: 'get-bw', action: [BwController::class, 'getBw'])->name(name: 'get.bw');
});

Route::resource(name: 'pakan', controller: PakanController::class);
Route::get(uri: 'get-pakan', action: [PakanController::class, 'getPakan'])->name(name: 'get.pakan');
Route::get('print-pakan', [PakanController::class, 'printPdf'])->name('print.pakan');

Route::resource(name: 'kematian', controller: KematianController::class);
Route::get(uri: 'get-kematian', action: [KematianController::class, 'getKematian'])->name(name: 'get.kematian');
Route::get('print-kematian', [KematianController::class, 'printPdf'])->name('print.kematian');

Route::resource(name: 'obat', controller: ObatController::class);
Route::get(uri: 'get-obat', action: [ObatController::class, 'getObat'])->name(name: 'get.obat');
Route::get('print-obat', [ObatController::class, 'printPdf'])->name('print.obat');

Route::resource(name: 'bw', controller: BWController::class);
Route::get(uri: 'get-bw', action: [BWController::class, 'getBw'])->name(name: 'get.bw');
Route::get('print-bw', [BwController::class, 'printPdf'])->name('print.bw');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
