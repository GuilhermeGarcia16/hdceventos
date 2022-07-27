<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

Route::get('/',[EventController::class, 'index'])->name('index');
Route::get('/events/create', [EventController::class, 'create'])->name('create')->middleware('auth');
Route::post('/events/store', [EventController::class, 'store'])->name('store');
Route::get('/events/{id}', [EventController::class, 'show'])->name('show');
Route::get('/dashboard', [EventController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/events/edit/{id}', [EventController::class,'edit'])->name('edit')->middleware('auth');
Route::put('/events/update/{id}',[EventController::class, 'update'])->name('update')->middleware('auth');
Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('destroy')->middleware(('auth'));
Route::post('/events/join/{id}', [EventController::class, 'join'])->name('join')->middleware('auth');
Route::delete('/events/leave/{id}', [EventController::class, 'leave'])->name('leave')->middleware('auth');

Route::get('/contact', function(){
    return view('contact');
});
