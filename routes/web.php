<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

Route::get('/', [EventController::class, 'index'])->name('events.index');

Route::get('/events/create', [EventController::class, 'create'])->middleware('auth')->name('events.create');
Route::get('/events/edit/{event}', [EventController::class, 'edit'])->middleware('auth')->name('events.edit');
Route::put('/events/update/{event}', [EventController::class, 'update'])->middleware('auth')->name('events.update');

Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::post('/events', [EventController::class, 'store'])->middleware('auth')->name('events.store');
Route::delete('/events/{event}', [EventController::class, 'destroy'])->middleware('auth')->name('events.destroy');

Route::post('/events/join/{event}', [EventController::class, 'joinEvent'])->middleware('auth')->name('events.join');
Route::delete('/events/leave/{event}', [EventController::class, 'leaveEvent'])->middleware('auth')->name('events.leave');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/dashboard', [EventController::class, 'dashboard'])->middleware('auth')->name('dashboard');
