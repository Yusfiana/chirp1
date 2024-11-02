<?php

use App\Http\Controllers\ChirpController; // Rute yang menghubungkan ke chirp controller 
use App\Http\Controllers\ProfileController; // Rute yang menghubungkan ke chirp profile controller 
use Illuminate\Support\Facades\Route; //Rute yang menghubungkan ke rute yang ada di folder illuminate  

Route::get('/chirps/{chirp}', [ChirpController::class, 'show'])->name('chirps.show'); //rute yang akan mengambil dan meanampilkan dimailpit saat chirps

Route::get('/', function () {
    return view('welcome'); 
});
//rute yang akan menghubungkan ke dashboard.blade.hp (menu utama) setelah melakukan login/registrasi
Route::get('/dashboard', [ChirpController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard'); 


//rute untuk edit profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); //rute yang menghubunhkan ke profil edit untuk user mengedit informasi dari akun
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); //mengupdate profile akun
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');//menghapus akun
});

//memanage rute untuk managing chirps
Route::resource('chirps', ChirpController::class)//rute akan menerima data dari formulir dan memperbarui model
    ->only(['index', 'store', 'edit', 'update','destroy']) //rute akan menerima data dari formulir dan memperbarui model
    ->middleware(['auth', 'verified']);//memverifikasi autentikasi


require __DIR__.'/auth.php'; //untuk autentikasi