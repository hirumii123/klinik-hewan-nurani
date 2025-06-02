<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\Admin\PenyakitController;
use App\Http\Controllers\Admin\GejalaController;
use App\Http\Controllers\Admin\KategoriGejalaController;
use App\Http\Controllers\Admin\RulesController;
use App\Http\Controllers\Admin\ShortcutRuleController;
use App\Http\Controllers\Admin\AdminController;

Route::get('/diagnosa', [DiagnosaController::class, 'index'])->name('diagnosa.index');
Route::post('/diagnosa/konfirmasi', [DiagnosaController::class, 'konfirmasi'])->name('diagnosa.konfirmasi');
Route::post('/diagnosa/hasil', [DiagnosaController::class, 'hasil'])->name('diagnosa.hasil');
Route::post('/diagnosa/export', [App\Http\Controllers\DiagnosaController::class, 'exportPdf'])->name('diagnosa.export');
Route::get('/diagnosa/reset', function() {
    session()->forget(['hasil_diagnosa', 'cf_user_inputs']);
    return redirect()->route('diagnosa.index')
        ->with('success', 'Sesi diagnosa sebelumnya telah dihapus.');
})->name('diagnosa.reset');
Route::get('/penyakit', [DiseaseController::class, 'index'])->name('penyakit');
Route::get('/', function () {
    return view('home');
});
Route::get('/info-diagnosa', [DiseaseController::class, 'info'])->name('info-diagnosa');


Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('/penyakit', PenyakitController::class)->names('penyakit');
    Route::resource('/gejala', GejalaController::class)->names('gejala');
    Route::resource('/kategori-gejala', KategoriGejalaController::class)
        ->parameters(['kategori-gejala' => 'kategori'])
        ->names('kategori-gejala');
    Route::resource('/rules', RulesController::class)->names('rules');
    Route::resource('/shortcut-rules', ShortcutRuleController::class)->names('shortcut-rules');
});
