<?php

use App\Http\Controllers\PengunjungController;
use App\Http\Controllers\RakKategoriController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\SirkulasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Http\Middleware\CheckRole;
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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/role-regist',[UserController::class, 'role'])->name('role');

Route::get('/',[LoginController::class,'login'])->name('login')->middleware('guest');
Route::post('/autentikasi',[LoginController::class,'autenticate'])->name('autenticate')->middleware('guest');
Route::post('/logout',[LoginController::class,'Logout'])->name('logout')->middleware('auth');
Route::get('/home',[LoginController::class,'Home'])->name('home')->middleware('auth');
// Route::get('/hello', function () {
//     return view('blank');
// });

Route::middleware(['auth', 'role:Pengunjung'])->group(function () {
  Route::get('/buku-pengunjung',[PengunjungController::class,'addPengunjung'])->name('pengunjung.create')->middleware('auth');
  Route::post('/tambah-pengunjung',[PengunjungController::class,'storePengunjung'])->name('pengunjung.store')->middleware('auth');
});

Route::middleware(['auth', 'role:Petugas'])->group(function (){
  Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard')->middleware('auth');

  //kelola pengguna
  Route::get('/pengguna',[UserController::class,'index'])->name('user.index')->middleware('auth');
  Route::put('/update-pengguna/{id}',[UserController::class,'update'])->name('user.update')->middleware('auth');

  //kelola pengunjung
  Route::get('/pengunjung',[PengunjungController::class,'listPengunjung'])->name('pengunjung.index')->middleware('auth');
  Route::post('/pengunjung/download',[PengunjungController::class,'download'])->name('pengunjung.download')->middleware('auth');

  //kelola rak
  Route::get('/rak-buku',[RakKategoriController::class,'listRak'])->name('rak.index')->middleware('auth');
  Route::post('/tambah-rak',[RakKategoriController::class,'addRak'])->name('rak.store')->middleware('auth');
  Route::put('/rak-update/{id}',[RakKategoriController::class,'updateRak'])->name('rak.update')->middleware('auth');
  Route::delete('/rak-delete/{id}',[RakKategoriController::class,'deleteRak'])->name('rak.destroy')->middleware('auth');

  //kelola kategori
  Route::get('/kategori-buku',[RakKategoriController::class,'listKategori'])->name('kategori.index')->middleware('auth');
  Route::post('/tambah-kategori',[RakKategoriController::class,'addKategori'])->name('kategori.store')->middleware('auth');
  Route::put('/kategori-update/{id}',[RakKategoriController::class,'updateKategori'])->name('kategori.update')->middleware('auth');
  Route::delete('/kategori-delete/{id}',[RakKategoriController::class,'deleteKategori'])->name('kategori.destroy')->middleware('auth');

  //kelola buku
  Route::get('/tambah_buku',[BukuController::class,'create'])->name('buku.create')->middleware('auth');
  Route::post('/tambah_buku/store',[BukuController::class,'store'])->name('buku.store')->middleware('auth');
  Route::get('/buku/edit/{id}',[BukuController::class,'edit'])->name('buku.edit')->middleware('auth');
  Route::put('/buku/update/{id}',[BukuController::class,'update'])->name('buku.update')->middleware('auth');
  Route::delete('/buku/delete/{id}',[BukuController::class, 'destroy'])->name('buku.destroy')->middleware('auth');
  Route::post('/buku/upload',[BukuController::class,'upload'])->name('buku.upload')->middleware('auth');

  // kelola sirkulasi
  Route::get('/peminjaman',[SirkulasiController::class,'pinjam'])->name('sirkulasi.pinjam')->middleware('auth');
  Route::get('/pengembalian',[SirkulasiController::class,'kembali'])->name('sirkulasi.kembali')->middleware('auth');
  Route::get('/tambah-pinjam',[SirkulasiController::class,'create'])->name('sirkulasi.tambah')->middleware('auth');
  Route::post('/input-pinjam',[SirkulasiController::class,'store'])->name('sirkulasi.store')->middleware('auth');
  Route::get('/pinjam/info/{id}',[SirkulasiController::class,'info'])->name('pinjam.info')->middleware('auth');
  Route::delete('/kembali/hapus/{id}',[SirkulasiController::class,'destroy'])->name('pinjam.destroy')->middleware('auth');
  Route::post('/pinjam/kembalikan/{id}',[SirkulasiController::class,'return'])->name('sirkulasi.kembalikan')->middleware('auth');
  Route::get('/pengembalian/info/{id}',[SirkulasiController::class,'detail'])->name('kembali.info')->middleware('auth');

  //denda
  Route::get('/denda',[DendaController::class,'index'])->name('denda.index')->middleware('auth');
  Route::put('/denda/update/{id}',[DendaController::class,'update'])->name('denda.update')->middleware('auth');
});


Route::get('/buku/info/{id}',[BukuController::class,'info'])->name('buku.info')->middleware('auth');
Route::get('/buku', [BukuController::class,'index'])->name('buku.index')->middleware('auth');