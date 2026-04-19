<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ZakatController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes — Berkahin
|--------------------------------------------------------------------------
*/

// ── Beranda ───────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');

// ── Donasi ────────────────────────────────────────────────────────────────
Route::prefix('donasi')->name('donasi.')->group(function () {
    Route::get('/',              [DonasiController::class, 'index'])->name('index');
    Route::get('/qurban',        [DonasiController::class, 'qurban'])->name('qurban');
    Route::post('/qurban',       [DonasiController::class, 'storeQurban'])->name('qurban.store');
    Route::get('/palestina',     [DonasiController::class, 'palestina'])->name('palestina');
    Route::get('/beasiswa',      [DonasiController::class, 'beasiswa'])->name('beasiswa');
    Route::get('/sukses/{kode}', [DonasiController::class, 'sukses'])->name('sukses');
});

// ── Zakat ─────────────────────────────────────────────────────────────────
// Gunakan ZakatController (dari file 2) — lebih lengkap dari closure biasa
Route::get('/zakat',            [ZakatController::class, 'index'])->name('zakat.index');
Route::post('/zakat/store',     [ZakatController::class, 'store'])->name('zakat.store');
Route::get('/kalkulator-zakat', fn() => view('zakat.kalkulator'))->name('zakat.kalkulator');

// ── Blog ──────────────────────────────────────────────────────────────────
// Gunakan BlogController (konsisten dengan file 1 & baris bawah file 2)
Route::get('/blog',        [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', fn($slug) => view('blog.show', ['slug' => $slug]))->name('blog.show');

// ── Kontak ────────────────────────────────────────────────────────────────
// Gunakan KontakController (dari file 2) — lebih lengkap dari closure biasa
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.index');

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('guest')->group(function () {
    Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ── Program ───────────────────────────────────────────────────────────────
Route::get('/program/qurban',   fn() => redirect()->route('donasi.qurban'));
Route::get('/program/beasiswa', fn() => redirect()->route('donasi.beasiswa'));

// ── Wakaf ─────────────────────────────────────────────────────────────────
Route::get('/wakaf', fn() => view('wakaf.index'))->name('wakaf');

// ── Admin ─────────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');

    // Campaign — CRUD
    Route::get('/campaigns',                       [CampaignController::class, 'index'])->name('campaigns.index');
    Route::get('/campaigns/create',                [CampaignController::class, 'create'])->name('campaigns.create');
    Route::post('/campaigns',                      [CampaignController::class, 'store'])->name('campaigns.store');
    Route::delete('/campaigns/{campaign}',         [CampaignController::class, 'destroy'])->name('campaigns.destroy');
    Route::patch('/campaigns/{campaign}/status',   [CampaignController::class, 'updateStatus'])->name('campaigns.status');

}); 