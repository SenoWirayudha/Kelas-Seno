<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

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
    return view('welcome');
});

Route::get('halo', function() {
    echo 'halo bosku';
});

Route::get('belajar', function() {
    return view('belajar');
});

Route::get('/', function () {
    return view('home');
});

Route::get('/profil', function () {
    return view('profil');
});

Route::get('/kontak', function () {
    return view('kontak');
});

Route::get('/jurusan', function () {
    return view('jurusan');
});

Route::get('/', [PageController::class, 'home']);
Route::get('/profil', [PageController::class, 'profil']);
Route::get('/order', [PageController::class, 'order']);
Route::get('/kontak', [PageController::class, 'kontak']);
Route::get('/chatting', [PageController::class, 'chatting']);
