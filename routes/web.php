<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/test-kepribadian', function () {
    return view('test-kepribadian.test');
})->name('test-kepribadian');

Route::get('/hasil-test-kepribadian', function () {
    return view('test-kepribadian.hasil');
})->name('hasil-test-kepribadian');

Route::get('/cek-eligibilitas', function () {
    return view('cek-eligibilitas.index');
})->name('cek-eligibilitas');

Route::get('/cek-eligibilitas-input', function () {
    return view('cek-eligibilitas.input');
})->name('start.input');