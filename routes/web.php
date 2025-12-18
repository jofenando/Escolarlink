<?php

use App\Filament\Resources\PruebaResource;
use App\Http\Controllers\EloquentController;
use Illuminate\Support\Facades\Route;

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', function () {
    return redirect('/app');
});

Route::get('app/eloquent', [EloquentController::class, 'index'])->name('eloquent.index');

