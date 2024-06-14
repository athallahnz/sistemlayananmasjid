<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JamaahController;
use App\Http\Controllers\JadwalsholatController;

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

Auth::routes();

Route::get('/admin/login', 'AdminController@login')->name('admin.login');
Route::post('/admin/login', 'AdminController@authenticate')->name('admin.authenticate');
Route::get('/admin/logout', 'AdminController@logout')->name('admin.logout');

Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');


Route::get('/home', [App\Http\Controllers\JamaahController::class, 'index'])->name('home')->middleware('auth');;
// Route untuk menyimpan data dari form
Route::post('/home', [JamaahController::class, 'store'])->name('home.store');

Route::get('/', [App\Http\Controllers\JamaahController::class, 'create'])->name('home');
Route::post('/', [App\Http\Controllers\JamaahController::class, 'store'])->name('home');

// Untuk Menampilkan Detail Infaq

Route::get('/jamaah/{id}', [JamaahController::class, 'show'])->name('infaq.show');
// Route::post('/jamaah/{id}', [JamaahController::class, 'edit'])->name('infaq.edit');
Route::put('/jamaah/{id}', [JamaahController::class, 'edit'])->name('infaq.edit');
Route::delete('/jamaah/{id}', [JamaahController::class, 'destroy'])->name('infaq.destroy');


// Route::resource('jamaah', JamaahController::class);
Route::get('/welcome', [App\Http\Controllers\JadwalsholatController::class, 'showWelcome'])->name('welcome');


Route::post('/sholat/jadwal', [JadwalsholatController::class, 'getJadwalSholat'])->name('sholat.result');
Route::get('/sholat/jadwal', [JadwalsholatController::class, 'showForm'])->name('sholat.form');
