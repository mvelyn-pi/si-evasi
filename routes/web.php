<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Evaluator;
use App\Http\Controllers\KuesionerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — SI-EVASI (Sistem Evaluasi Aplikasi SAKTI)
|--------------------------------------------------------------------------
*/

// ─── Halaman Publik (Kuesioner) ─────────────────────────────────────────────

Route::get('/', [KuesionerController::class, 'index'])->name('home');

Route::prefix('kuesioner')->name('kuesioner.')->group(function () {
    Route::get('/mulai', [KuesionerController::class, 'mulai'])->name('mulai');
    Route::post('/mulai', [KuesionerController::class, 'storeMulai'])->name('storeMulai');

    Route::get('/pemahaman/{kode}', [KuesionerController::class, 'pemahaman'])->name('pemahaman');
    Route::post('/pemahaman/{kode}', [KuesionerController::class, 'storePemahaman'])->name('storePemahaman');

    Route::get('/tam/{kode}', [KuesionerController::class, 'tam'])->name('tam');
    Route::post('/tam/{kode}', [KuesionerController::class, 'storeTam'])->name('storeTam');

    Route::get('/sus/{kode}', [KuesionerController::class, 'sus'])->name('sus');
    Route::post('/sus/{kode}', [KuesionerController::class, 'storeSus'])->name('storeSus');

    Route::get('/selesai', [KuesionerController::class, 'selesai'])->name('selesai');
});

// ─── Auth (Breeze) ───────────────────────────────────────────────────────────

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ─── Admin Routes ────────────────────────────────────────────────────────────

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');

    // Polres CRUD
    Route::resource('polres', Admin\PolresController::class)->except(['show']);

    // Responden (view + hapus)
    Route::get('/responden', [Admin\RespondenController::class, 'index'])->name('responden.index');
    Route::get('/responden/{responden}', [Admin\RespondenController::class, 'show'])->name('responden.show');
    Route::delete('/responden/{responden}', [Admin\RespondenController::class, 'destroy'])->name('responden.destroy');

    // Pertanyaan CRUD + toggle
    Route::resource('pertanyaan', Admin\PertanyaanController::class);
    Route::patch('/pertanyaan/{pertanyaan}/toggle', [Admin\PertanyaanController::class, 'toggleStatus'])
        ->name('pertanyaan.toggle');

    // Manajemen User/Evaluator
    Route::resource('users', Admin\UserController::class);

    // Laporan
    Route::get('/laporan', [Admin\LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export-pdf', [Admin\LaporanController::class, 'exportPdf'])->name('laporan.pdf');
    Route::get('/laporan/export-excel', [Admin\LaporanController::class, 'exportExcel'])->name('laporan.excel');
});

// ─── Evaluator Routes ────────────────────────────────────────────────────────

Route::middleware(['auth', 'evaluator'])->prefix('evaluator')->name('evaluator.')->group(function () {
    Route::get('/dashboard', [Evaluator\DashboardController::class, 'index'])->name('dashboard');

    // Laporan
    Route::get('/laporan', [Evaluator\LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export-pdf', [Evaluator\LaporanController::class, 'exportPdf'])->name('laporan.pdf');
    Route::get('/laporan/export-excel', [Evaluator\LaporanController::class, 'exportExcel'])->name('laporan.excel');
});

// ─── Login Redirect: setelah login, arahkan ke dashboard sesuai role ─────────

Route::middleware('auth')->get('/dashboard', function () {
    return auth()->user()->isAdmin()
        ? redirect()->route('admin.dashboard')
        : redirect()->route('evaluator.dashboard');
})->name('dashboard');
