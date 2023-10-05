<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ComentarioController;

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

Route::get('/phpini', function () {
   return view('phpini');
});

//registrar cuenta
Route::get('/crear-cuenta', [RegisterController::class, 'index'])->name('register');
Route::post('/crear-cuenta', [RegisterController::class, 'store']);

//login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

//logout
Route::post('logout', [LogoutController::class, 'store'])->name('logout');

//Publicaciones 
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::post('imagenes', [ImagenController::class, 'store'])->name('imagenes.store');




