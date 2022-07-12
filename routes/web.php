<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

Route::get('/',[EventController::class, 'index'])->name('index');
Route::get('/events/create', [EventController::class, 'create'])->name('create');
Route::post('/events/store', [EventController::class, 'store'])->name('store');
Route::get('/events/{id}', [EventController::class, 'show'])->name('show');




Route::get('/contact', function(){
    return view('contact');
});
