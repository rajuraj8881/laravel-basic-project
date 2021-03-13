<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEnd\FrontController;
use App\Http\Controllers\FrontEnd\PostController;
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


Route::get('/dashboard',[PostController::class,'ShowAllPost'])->middleware('adminAuth')->name('dashboard');
Route::get('/logout',[FrontController::class, 'logout'])->middleware('adminAuth')->name('logout');
Route::get('/profile', [FrontController::class, 'profile'])->middleware('adminAuth')->name('profile');

Route::get('/add-post', [PostController::class, 'PostAdd'])->middleware('adminAuth')->name('addPost');
Route::post('/add-post', [PostController::class, 'savePost'])->middleware('adminAuth')->name('save.post');
Route::get('/all-post', [PostController::class, 'ShowUserPost'])->middleware('adminAuth')->name('allPost');
Route::get('/edit-post/{id}', [PostController::class, 'editPost'])->middleware('adminAuth')->name('post.Edit');
Route::post('/update-post', [PostController::class, 'UpdatePost'])->middleware('adminAuth')->name('Update.post');
Route::get('/delete-post/{id}', [PostController::class, 'PostDelete'])->middleware('adminAuth')->name('deletePost');
Route::get('/single-post/{id}', [PostController::class, 'singlePost'])->middleware('adminAuth')->name('single');
Route::get('/search', [PostController::class, 'ProductSearch'])->middleware('adminAuth')->name('search');
