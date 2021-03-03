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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [FrontController::class, 'index'])->name('index');
Route::get('/login', [FrontController::class, 'login'])->name('login');
Route::get('/recover-your-password', [FrontController::class, 'recoverPassword'])->name('recoverPassword');
Route::get('/register', [FrontController::class, 'register'])->name('register');
Route::post('/register', [FrontController::class, 'processRegister']);
