<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/multable', function () {
    return view('multable');
})->name('multable');

Route::get('/even', function () {
    return view('even_number');
})->name('even');

Route::get('/prime', function () {
    return view('prime_number');
})->name('prime');


Route::resource('users', UserController::class);
