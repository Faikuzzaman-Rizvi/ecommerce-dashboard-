<?php

use App\Http\Controllers\DemoController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\DemoMiddleware;
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

require __DIR__.'/auth.php';

// Route::get('/hello', [DemoController::class, 'action']);
// Route::get('/hello/{name}', [DemoController::class, 'action']);
// Route::get('/hello/{name}/{age}', [DemoController::class, 'action']);
// Route::get('/hello1/{key}', [DemoController::class, 'DemoAction1'])->middleware([DemoMiddleware::class]);
// Route::get('/hello2/{key}', [DemoController::class, 'DemoAction2'])->middleware([DemoMiddleware::class]);
// Route::get('/hello3/{key}', [DemoController::class, 'DemoAction3'])->middleware([DemoMiddleware::class]);
// Route::get('/hello4/{key}', [DemoController::class, 'DemoAction4'])->middleware([DemoMiddleware::class]);
// Route::get('/hello2', [DemoController::class, 'DemoAction2']);


Route::middleware(["demo"])->group(function(){

    Route::get('/hello1/{key}', [DemoController::class, 'DemoAction1']);
    Route::get('/hello2/{key}', [DemoController::class, 'DemoAction2']);
    Route::get('/hello3/{key}', [DemoController::class, 'DemoAction3']);
    Route::get('/hello4/{key}', [DemoController::class, 'DemoAction4']);
    
});

