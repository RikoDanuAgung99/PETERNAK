<?php

use App\Http\Controllers\KematianController;
use App\Http\Controllers\PakanController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\BwController;
use App\Http\Controllers\BedahController;
use App\Http\Controllers\HargaKontrakController;
use App\Http\Controllers\PanenController;
use App\Http\Controllers\RekaptestController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\TransaksiBibitController;
use App\Http\Controllers\TransaksiObatController;
use App\Http\Controllers\TransaksiPakanController;
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
    return redirect('home');
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

Route::group(attributes: ['prefix' => 'admin', 'middleware' => ['auth']], routes: function () {
    Route::resource(name: 'pengguna', controller: UserController::class);
    Route::resource(name: 'bedah', controller: BedahController::class);
    Route::get(uri: 'get-bedah', action: [BedahController::class, 'getBedah'])->name(name: 'get.bedah');
});

Route::group(attributes: ['prefix' => 'admin', 'middleware' => ['auth']], routes: function () {
    Route::resource(name: 'pengguna', controller: UserController::class);
    Route::resource(name: 'rekaptest', controller: RekaptestController::class);
    Route::get(uri: 'get-rekaptest', action: [RekaptestController::class, 'getRekaptest'])->name(name: 'get.rekaptest');
});

Route::group(attributes: ['prefix' => 'admin', 'middleware' => ['auth']], routes: function () {
    Route::resource(name: 'pengguna', controller: UserController::class);
    Route::resource(name: 'rekap', controller: RekapController::class);
    Route::get(uri: 'get-rekap', action: [RekapController::class, 'getRekap'])->name(name: 'get.rekap');
});

// Route::middleware(['auth'])->group(function () {
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

    Route::resource(name: 'bedah', controller: BedahController::class);
    Route::get(uri: 'get-bedah', action: [BedahController::class, 'getBedah'])->name(name: 'get.bedah');
    Route::get('print-bedah', [BedahController::class, 'printPdf'])->name('print.bedah');

    Route::resource(name: 'rekaptest', controller: RekaptestController::class);
    Route::get(uri: 'get-rekaptest', action: [RekaptestController::class, 'getRekaptest'])->name(name: 'get.rekaptest');
    Route::get('print-rekaptest', [RekaptestController::class, 'printPdf'])->name('print.rekaptest');

    Route::resource(name: 'rekap', controller: RekapController::class);
    Route::get(uri: 'get-rekap', action: [RekapController::class, 'getrekap'])->name(name: 'get.rekap');
    Route::get('print-rekap', [RekapController::class, 'printPdf'])->name('print.rekap');

    Route::resource(name: 'transaksiObat', controller: TransaksiObatController::class);
    Route::get('get-transaksiObat', [TransaksiObatController::class, 'gettransaksiObat'])->name('get.transaksiObat');
    Route::get('print-transaksiObat', [TransaksiObatController::class, 'printPdf'])->name('print.transaksiObat');

    Route::resource(name: 'transaksiPakan', controller: TransaksiPakanController::class);
    Route::get('get-transaksiPakan', [TransaksiPakanController::class, 'gettransaksiPakan'])->name('get.transaksiPakan');
    Route::get('print-transaksiPakan', [TransaksiPakanController::class, 'printPdf'])->name('print.transaksiPakan');

    Route::resource(name: 'transaksiBibit', controller: TransaksiBibitController::class);
    Route::get('get-transaksiBibit', [TransaksiBibitController::class, 'gettransaksiBibit'])->name('get.transaksiBibit');
    Route::get('print-transaksiBibit', [TransaksiBibitController::class, 'printPdf'])->name('print.transaksiBibit');


    Route::resource(name: 'panen', controller: PanenController::class);
    Route::get('get-panen', [PanenController::class, 'getPanen'])->name('get.panen');
    Route::get('print-panen', [PanenController::class, 'printPdf'])->name('print.panen');
// });
// Route::middleware(['auth'])->group(function () {
//     Route::get('get-pakan', [PakanController::class, 'getPakan'])->name('get.pakan')->middleware('can:isAdmin');
//     Route::get('print-pakan', [PakanController::class, 'printPdf'])->name('print.pakan')->middleware('can:isAdmin');

//     Route::get('get-kematian', [KematianController::class, 'getKematian'])->name('get.kematian')->middleware('can:isAdmin');
//     Route::get('print-kematian', [KematianController::class, 'printPdf'])->name('print.kematian')->middleware('can:isAdmin');

//     Route::get('get-obat', [ObatController::class, 'getObat'])->name('get.obat')->middleware('can:isAdmin');
//     Route::get('print-obat', [ObatController::class, 'printPdf'])->name('print.obat')->middleware('can:isAdmin');

//     Route::get('get-bw', [BWController::class, 'getBw'])->name('get.bw')->middleware('can:isAdmin');
//     Route::get('print-bw', [BWController::class, 'printPdf'])->name('print.bw')->middleware('can:isAdmin');

//     Route::get('get-bedah', [BedahController::class, 'getBedah'])->name('get.bedah')->middleware('can:isAdmin');
//     Route::get('print-bedah', [BedahController::class, 'printPdf'])->name('print.bedah')->middleware('can:isAdmin');

//     Route::get('get-rekaptest', [RekaptestController::class, 'getRekaptest'])->name('get.rekaptest')->middleware('can:isAdmin');
//     Route::get('print-rekaptest', [RekaptestController::class, 'printPdf'])->name('print.rekaptest')->middleware('can:isAdmin');

//     Route::get('get-rekap', [RekapController::class, 'getrekap'])->name('get.rekap')->middleware('can:isAdmin');
//     Route::get('print-rekap', [RekapController::class, 'printPdf'])->name('print.rekap')->middleware('can:isAdmin');

//     Route::get('get-transaksiObat', [TransaksiObatController::class, 'gettransaksiObat'])->name('get.transaksiObat')->middleware('can:isAdmin');
//     Route::get('print-transaksiObat', [TransaksiObatController::class, 'printPdf'])->name('print.transaksiObat')->middleware('can:isAdmin');

//     Route::get('get-transaksiPakan', [TransaksiPakanController::class, 'gettransaksiPakan'])->name('get.transaksiPakan')->middleware('can:isAdmin');
//     Route::get('print-transaksiPakan', [TransaksiPakanController::class, 'printPdf'])->name('print.transaksiPakan')->middleware('can:isAdmin');

//     Route::get('get-transaksiBibit', [TransaksiBibitController::class, 'gettransaksiBibit'])->name('get.transaksiBibit')->middleware('can:isAdmin');
//     Route::get('print-transaksiBibit', [TransaksiBibitController::class, 'printPdf'])->name('print.transaksiBibit')->middleware('can:isAdmin');

//     Route::get('get-panen', [PanenController::class, 'getPanen'])->name('get.panen')->middleware('can:isAdmin');
//     Route::get('print-panen', [PanenController::class, 'printPdf'])->name('print.panen')->middleware('can:isAdmin');
// });


// Route::middleware(['auth'])->group(function () {
//     // Recording untuk Peternak
//     Route::get('get-pakan', [PakanController::class, 'getPakan'])->name('get.pakan')->middleware('can:isPeternak');
//     Route::get('print-pakan', [PakanController::class, 'printPdf'])->name('print.pakan')->middleware('can:isPeternak');

//     Route::resource('pakan', PakanController::class)->middleware('can:isPeternak');
//     Route::get('get-pakan', [PakanController::class, 'getPakan'])->name('get.pakan')->middleware('can:isPeternak');

//     Route::resource('obat', ObatController::class)->middleware('can:isPeternak');
//     Route::get('get-obat', [ObatController::class, 'getObat'])->name('get.obat')->middleware('can:isPeternak');

//     Route::resource('bw', BWController::class)->middleware('can:isPeternak');
//     Route::get('get-bw', [BWController::class, 'getBw'])->name('get.bw')->middleware('can:isPeternak');

//     Route::resource('bedah', BedahController::class)->middleware('can:isPeternak');
//     Route::get('get-bedah', [BedahController::class, 'getBedah'])->name('get.bedah')->middleware('can:isPeternak');

//     Route::resource('rekap', RekapController::class)->middleware('can:isPeternak');
//     Route::get('get-rekap', [RekapController::class, 'getrekap'])->name('get.rekap')->middleware('can:isPeternak');
// });


// TS: bibit, pakan, obat, view recording, panen
// Route::middleware(['auth', 'role:TS'])->group(function () {
//     Route::resources([
//         'transaksiBibit' => TransaksiBibitController::class,
//         'transaksiPakan' => TransaksiPakanController::class,
//         'transaksiObat' => TransaksiObatController::class,
//         'rekap' => RekapController::class, // view recording
//         'panen' => PanenController::class,
//     ]);

//     Route::get('get-transaksiBibit', [TransaksiBibitController::class, 'gettransaksiBibit'])->name('get.transaksiBibit');
//     Route::get('get-transaksiPakan', [TransaksiPakanController::class, 'gettransaksiPakan'])->name('get.transaksiPakan');
//     Route::get('get-transaksiObat', [TransaksiObatController::class, 'gettransaksiObat'])->name('get.transaksiObat');
//     Route::get('get-rekap', [RekapController::class, 'getrekap'])->name('get.rekap');
//     Route::get('get-panen', [PanenController::class, 'getPanen'])->name('get.panen');
// });



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
