<?php

use App\Http\Controllers\DreamController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/admin/dreams',[DreamController::class,'index']);
// Route::get('/admin/dreams/{dream}',[DreamController::class,'show']);
// Route::get('/admin/dreams/create',[DreamController::class,'create']);
// Route::post('/admin/dreams/store',[DreamController::class,'store']);
// Route::get('/admin/dreams/{dream}/edit',[DreamController::class,'edit']);
// Route::put('/admin/dreams/{dream}/update',action: [DreamController::class,'update']);
// Route::delete('/admin/dreams/{dream}/destroy',action: [DreamController::class,'destroy']);


Route::resource('admin/dreams', DreamController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
