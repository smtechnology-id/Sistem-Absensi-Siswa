<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;

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

Route::get('/', [GuestController::class, 'index'])->name('absen');
Route::get('/login', [GuestController::class, 'login'])->name('login');
Route::post('/loginPost', [GuestController::class, 'loginPost'])->name('loginPost');

Route::get('/logout', [GuestController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Siswa
    Route::get('/admin/data-Siswa', [AdminController::class, 'kelas'])->name('admin.kelas'); 
    Route::get('/admin/deleteStudent/{id}', [AdminController::class, 'deleteStudent'])->name('admin.deleteStudent');
    Route::post('/admin/addStudentPost', [AdminController::class, 'addStudentPost'])->name('admin.addStudentPost');
    Route::post('/admin/updateStudentPost', [AdminController::class, 'updateStudentPost'])->name('admin.updateStudentPost');
    
    //Kelas
    Route::post('/admin/addKelasPost', [AdminController::class, 'addKelasPost'])->name('admin.addKelasPost');
    Route::post('/admin/updateKelasPost', [AdminController::class, 'updateKelasPost'])->name('admin.updateKelasPost');
    Route::get('/admin/dataSiswa/{id}', [AdminController::class, 'dataSiswa'])->name('admin.dataSiswa');
    
    // Absensi
    Route::get('/admin/absensi', [AdminController::class, 'absensi'])->name('admin.absensi'); 
    Route::get('/admin/absensiSiswa/{id}', [AdminController::class, 'absensiSiswa'])->name('admin.absensiSiswa'); 
});