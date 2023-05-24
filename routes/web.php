<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CetakSuratController;
use App\Http\Controllers\Admin\GuruBKController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PelanggaranController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\SiswaKeputusanController;
use App\Http\Controllers\Admin\SiswaPelanggaranController;
use App\Http\Controllers\Admin\TahunAjaranController;
use App\Http\Controllers\Admin\WaliKelasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
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
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::post('/data-siswa/import-data-siswa', [SiswaController::class, 'import_siswa'])->name('data-siswa.import-data-siswa')->middleware('role:Admin');
    Route::resource('data-siswa', SiswaController::class)->middleware('role:Admin');
    Route::put('/data-tahun-ajaran/ganti-tahun-ajaran', [TahunAjaranController::class, 'change'])->name('data-tahun-ajaran.ganti-tahun-ajaran')->middleware('role:Admin');
    Route::resource('data-tahun-ajaran', TahunAjaranController::class)->middleware('role:Admin');
    Route::post('/data-kelas/store-siswa-kelas', [KelasController::class, 'store_siswa_kelas'])->name('data-kelas.store-siswa-kelas')->middleware('role:Admin');
    Route::delete('/data-kelas/delete-siswa-kelas/{id}', [KelasController::class, 'destroy_siswa_kelas'])->name('data-kelas.delete-siswa-kelas')->middleware('role:Admin');
    Route::post('/data-kelas/import-siswa-kelas', [KelasController::class, 'import_siswa_kelas'])->name('data-kelas.import-siswa-kelas')->middleware('role:Admin');
    Route::resource('data-kelas', KelasController::class)->middleware('role:Admin');
    Route::resource('data-pelanggaran', PelanggaranController::class)->middleware('role:Admin');
    Route::resource('data-admin', AdminController::class)->middleware('role:Admin');
    Route::resource('data-wali-kelas', WaliKelasController::class)->middleware('role:Admin');
    Route::resource('data-bk', GuruBKController::class)->middleware('role:Admin');
    Route::resource('pelanggaran-siswa', SiswaPelanggaranController::class)->middleware('role2:BK,Wali Kelas');
    Route::resource('keputusan-siswa', SiswaKeputusanController::class)->middleware('role2:BK,Wali Kelas');
    Route::get('/cetak-surat', [CetakSuratController::class, 'index'])->name('cetak-surat.index')->middleware('role3:Admin,BK,Wali Kelas');
    Route::get('/cetak-surat/surat-rekomendasi', [CetakSuratController::class, 'cetak_surat_rekomendasi'])->name('cetak-surat.surat-rekomendasi')->middleware('role3:Admin,BK,Wali Kelas');
    Route::get('/cetak-surat/surat-pernyataan-orang-tua', [CetakSuratController::class, 'cetak_surat_pernyataan_orang_tua'])->name('cetak-surat.surat-pernyataan-orang-tua')->middleware('role3:Admin,BK,Wali Kelas');
    Route::get('/cetak-surat/surat-pernyataan-siswa', [CetakSuratController::class, 'cetak_surat_pernyataan_siswa'])->name('cetak-surat.surat-pernyataan-siswa')->middleware('role3:Admin,BK,Wali Kelas');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index')->middleware('role3:Admin,BK,Wali Kelas');
    Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak')->middleware('role3:Admin,BK,Wali Kelas');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
