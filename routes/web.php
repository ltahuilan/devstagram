<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;

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

/**
 * Modificar la variable que aplica el redirect del middleware('guest') 
 * app\Providers\RouteServiceProvider.php
 * modificar el public const HOME
 */

Route::get('/phpini', function () {
   return view('phpini');
});

Route::get('/', HomeController::class)->name('home');

//registrar cuenta
Route::get('/crear-cuenta', [RegisterController::class, 'index'])->middleware('guest')->name('register');
Route::post('/crear-cuenta', [RegisterController::class, 'store']);

//login
Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'store']);

//logout
Route::post('logout', [LogoutController::class, 'store'])->name('logout');

//profile
Route::get('/editar-perfil', [ProfileController::class, 'index'])->name('editar-perfil.index');
Route::post('/editar-perfil', [ProfileController::class, 'store'])->name('editar-perfil.store');

//Publicaciones 
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

//likes
Route::post('/posts/{post}/like', [LikeController::class, 'store'])->name('posts.like.store');
Route::delete('/posts/{post}/like', [LikeController::class, 'destroy'])->name('posts.like.destroy');

//wollowers
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');

//imagenes
Route::post('imagenes', [ImagenController::class, 'store'])->name('imagenes.store');




