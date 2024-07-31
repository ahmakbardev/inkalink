<?php

use App\Http\Controllers\EligibilityController;
use App\Http\Controllers\PersonalityTestController;
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

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/tipe-kepribadian', [PersonalityTestController::class, 'showTipe'])->name('tipe-kepribadian');
Route::get('/test-kepribadian', [PersonalityTestController::class, 'index'])->name('test-kepribadian');
Route::post('/submit-test', [PersonalityTestController::class, 'submitTest'])->name('submit.personality.test');


Route::get('/hasil-test-kepribadian', function () {
    return view('test-kepribadian.hasil');
})->name('hasil-test-kepribadian');

Route::get('/cek-eligibilitas', function () {
    return view('cek-eligibilitas.index');
})->name('cek-eligibilitas');

Route::get('/cek-eligibilitas-input', [EligibilityController::class, 'input'])->name('start.input');
Route::post('/cek-eligibilitas/hasil', [EligibilityController::class, 'checkEligibility'])->name('cek-eligibilitas.hasil');
