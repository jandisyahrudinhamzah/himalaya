<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\StrukturController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\PengaturanController;

/*
|--------------------------------------------------------------------------
| 1. ROOT → Redirect ke public home
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('public.home');
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| 2. PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/home', [PublicController::class, 'home'])->name('public.home');
Route::get('/articles', [PublicController::class, 'articles'])->name('public.articles');
Route::get('/articles/{id}', [PublicController::class, 'articleShow'])->name('public.article.show');
Route::get('/gallery', [PublicController::class, 'gallery'])->name('public.gallery');
Route::get('/activities', [PublicController::class, 'activities'])->name('public.activities');
Route::get('/activities/{id}', [PublicController::class, 'activityShow'])->name('public.activity.show');
Route::get('/members', [PublicController::class, 'members'])->name('public.members');

/*
|--------------------------------------------------------------------------
| 3. ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('artikel', ArtikelController::class);
    Route::resource('galeri', AdminGaleriController::class);
    Route::resource('struktur', StrukturController::class);
    Route::get('/pengaturen', [PengaturanController::class, 'index'])->name('pengaturen');

    Route::resource('anggota', AnggotaController::class)
        ->parameters(['anggota' => 'anggota']);
    Route::resource('kegiatans', KegiatanController::class);
});

/*
|--------------------------------------------------------------------------
| 4. BENDAHARA ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:bendahara'])->group(function () {
    Route::get('/bendahara/dashboard', function () {
        return view('bendahara.dashboard');
    })->name('bendahara.dashboard');
});

/*
|--------------------------------------------------------------------------
| 5. ANGGOTA ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:anggota'])->group(function () {
    Route::get('/anggota/dashboard', function () {
        return view('anggota.dashboard');
    })->name('anggota.dashboard');
});

/*
|--------------------------------------------------------------------------
| 6. LOGOUT
|--------------------------------------------------------------------------
*/
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

/*
|--------------------------------------------------------------------------
| AUTH (BREEZE)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';