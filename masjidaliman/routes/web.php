<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JamaahController;
use App\Http\Controllers\JadwalsholatController;
use App\Http\Controllers\HomeuserController;
use App\Http\Controllers\KajianController;
use App\Http\Controllers\UserKajianController;
use App\Http\Controllers\FeedbackController;


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
    return view('welcome')->name('landing');
});

Auth::routes();

// Route::get('/admin/login', 'AdminController@login')->name('admin.login');
// Route::post('/admin/login', 'AdminController@authenticate')->name('admin.authenticate');
// Route::get('/admin/logout', 'AdminController@logout')->name('admin.logout');
// Route::get('/admin/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware(['auth:admin', 'verified'])->name('admin.dashboard');

// require __DIR__.'/adminauth.php';

// Route::get('/dashboard', function(){
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');
// Route::get('/admin', function(){
//     return view('admin.index');
// })->middleware(['auth', 'role:admin'])->name('admin.index');

//Route Admin User
Route::group(['middleware' => ['role:admin']], function () {Route::get('/testadmin', function () {return 'Welcome Admin'; }); });Route::group(['middleware' => ['role:user']], function () {Route::get('/testuser', function () { return 'Welcome User'; }); });

//Route Home Admin
Route::get('/home', [App\Http\Controllers\JamaahController::class, 'index'])->name('home')->middleware('auth', 'role:admin');

//Route Home User
Route::get('/homeuser', [App\Http\Controllers\HomeuserController::class, 'index'])->name('homeuser')->middleware('role:user');
Route::post('/homeuser', [HomeuserController::class, 'store'])->name('homeuser.store');
//bismillah
Route::resource('homeuser', HomeuserController::class)->middleware('auth');
Route::post('/home/store', [HomeuserController::class, 'store' ])->name('home.store');


// Route untuk menyimpan data dari form
// Route::post('/home', [JamaahController::class, 'store'])->name('home.store');

Route::get('/', [App\Http\Controllers\JamaahController::class, 'create'])->name('home')->middleware(['auth']);
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

//Route Kajian
Route::resource('kajians', KajianController::class);

//Route User Kajian
Route::get('user/kajians', [UserKajianController::class, 'index'])->name('user.kajians.index');
Route::get('user/kajians/{kajian}', [UserKajianController::class, 'show'])->name('user.kajians.show');

//Route Feedback
Route::get('/welcome', [FeedbackController::class, 'index'])->name('feedback.index');
Route::post('/welcome', [FeedbackController::class, 'send'])->name('feedback.send');
