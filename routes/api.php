<?php

use App\Http\Controllers\InstanceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login',[LoginController::class, 'login'])->name('login.login');
Route::get('/home', function () {
    return view('welcome');
});

Route::post('/save', [MessageController::class, 'store'])->name('message.store');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user',[UserController::class, 'edit'])->name('user.edit');

    Route::prefix('message')->group(function() {
        Route::post('/text', [MessageController::class, 'text'])->name('message.text');
        Route::post('/image', [MessageController::class, 'image'])->name('message.image');
        Route::post('/texto', [MessageController::class, 'text'])->name('message.texto');
    });
    Route::prefix('instance')->group(function() {
        Route::get('/', [InstanceController::class, 'index'])->name('instance.index');
        Route::get('/restore', [InstanceController::class, 'restore'])->name('instance.restore');
        Route::get('/init/{key_name}', [InstanceController::class, 'init'])->name('instance.init');
        Route::delete('/delete/{key_name}', [InstanceController::class, 'delete'])->name('instance.delete');
        Route::delete('/logout/{key_name}', [InstanceController::class, 'logout'])->name('instance.logout');
    });

});
