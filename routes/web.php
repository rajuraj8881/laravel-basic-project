<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEnd\FrontController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontController::class, 'index'])->name('home');

Route::get('/login', [FrontController::class, 'login'])->name('login');
Route::post('/login', [FrontController::class, 'loginProcess']);

Route::get('/register', [FrontController::class, 'register'])->name('register');
Route::post('/register', [FrontController::class, 'processRegister']);

Route::get('/recover-your-password', [FrontController::class, 'recoverPassword'])->name('recoverPassword');

Route::get('/logout',[FrontController::class, 'logout'])->name('logout');
