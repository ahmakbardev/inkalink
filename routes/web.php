<?php

use App\Http\Controllers\AuthController;
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

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/tipe-kepribadian', [PersonalityTestController::class, 'showTipe'])->name('tipe-kepribadian');

Route::middleware(['auth.middleware'])->group(function () {
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

    Route::get('/jurnal-karir', function () {
        return view('jurnal.index');
    })->name('jurnal-karir');
});
