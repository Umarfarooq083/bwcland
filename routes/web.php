<?php

use App\Http\Controllers\PlotsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('plot/list', [PlotsController::class, 'plotsList'])->name('plot.List');
    Route::get('plot/show', [PlotsController::class, 'plotsShow'])->name('plot.show');
    
});

Route::get('plot/qr-data', [PlotsController::class, 'plotsQRCode'])->name('plot.qrcode');

require __DIR__.'/auth.php';
