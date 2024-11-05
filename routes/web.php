<?php

use App\Http\Controllers\DreamController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    $dreams = DB::table('dreams')
    ->join('users','dreams.user_id','=','users.id')
    ->select(
        'dreams.id as dream_id',
        'dreams.content',
        'dreams.created_at',
        'dreams.user_id',
        'users.name',
        'users.email'
    )
    ->get();


    $dreams->map(function($dream){
        // $dream->created_at = Carbon::make($dream->created_at);
        $dream->created_at = Carbon::make($dream->created_at);

    });

    // dd($dreams);
    return view('welcome-1',compact('dreams'));
});

// Route::get('/test',function(){
//     return view('welcome-1');
// });


Route::resource('admin/dreams', DreamController::class)->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
