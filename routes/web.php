<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DonasiController;

/*
|--------------------------------------------------------------------------
| Web Routes — Berkahin
|--------------------------------------------------------------------------
*/

// ── Beranda ──────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');

// ── Donasi ───────────────────────────────────────────────────────────────
Route::prefix('donasi')->name('donasi.')->group(function () {
    Route::get('/', [DonasiController::class, 'index'])->name('index');
    Route::get('/qurban', [DonasiController::class, 'qurban'])->name('qurban');
    Route::post('/qurban', [DonasiController::class, 'storeQurban'])->name('qurban.store');
    Route::get('/palestina', [DonasiController::class, 'palestina'])->name('palestina');
    Route::get('/beasiswa', [DonasiController::class, 'beasiswa'])->name('beasiswa');
    Route::get('/sukses/{kode}', [DonasiController::class, 'sukses'])->name('sukses');
});

// ── Zakat ─────────────────────────────────────────────────────────────────
Route::get('/zakat', fn() => view('zakat.index'))->name('zakat');
Route::get('/kalkulator-zakat', fn() => view('zakat.kalkulator'))->name('zakat.kalkulator');

// ── Blog ─────────────────────────────────────────────────────────────────
Route::get('/blog', fn() => view('blog.index'))->name('blog');
Route::get('/blog/{slug}', fn($slug) => view('blog.show', ['slug' => $slug]))->name('blog.show');

// ── Kontak ────────────────────────────────────────────────────────────────
Route::get('/kontak', fn() => view('kontak.index'))->name('kontak');

// ── Program ──────────────────────────────────────────────────────────────
Route::get('/program/qurban', fn() => redirect()->route('donasi.qurban'));
Route::get('/program/beasiswa', fn() => redirect()->route('donasi.beasiswa'));

// ── Wakaf ─────────────────────────────────────────────────────────────────
Route::get('/wakaf', fn() => view('wakaf.index'))->name('wakaf');