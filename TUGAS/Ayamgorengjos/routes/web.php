<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;

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

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [PageController::class, 'cart'])->name('cart');
    Route::post('/cart/add', [PageController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update', [PageController::class, 'updateCart'])->name('cart.update');
    Route::post('/cart/remove', [PageController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/direct', [PageController::class, 'checkoutDirect'])->name('checkout.direct');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
});

// Admin Auth Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});

// Admin Protected Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Menu Management
    Route::get('/menu', [AdminController::class, 'manageMenu'])->name('admin.menu');
    Route::get('/menu/create', [AdminController::class, 'createMenu'])->name('admin.menu.create');
    Route::post('/menu', [AdminController::class, 'storeMenu'])->name('admin.menu.store');
    Route::get('/menu/{id}/edit', [AdminController::class, 'editMenu'])->name('admin.menu.edit');
    Route::put('/menu/{id}', [AdminController::class, 'updateMenu'])->name('admin.menu.update');
    Route::delete('/menu/{id}', [AdminController::class, 'deleteMenu'])->name('admin.menu.delete');
    
    // User Management
    Route::get('/users', [AdminController::class, 'manageUsers'])->name('admin.users');
    Route::post('/users/{id}/toggle-ban', [AdminController::class, 'toggleBanUser'])->name('admin.users.toggle-ban');
    
    // Order Management
    Route::get('/orders', [AdminController::class, 'manageOrders'])->name('admin.orders');
    Route::post('/orders/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.status');
    
    // Message Management
    Route::get('/messages', [AdminController::class, 'manageMessages'])->name('admin.messages');
    Route::delete('/messages/{id}', [AdminController::class, 'deleteMessage'])->name('admin.messages.delete');
});

// Public Routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/profil', [PageController::class, 'profil']);
Route::get('/kontak', [PageController::class, 'kontak']);
Route::post('/kontak/store', [PageController::class, 'storeMessage'])->name('kontak.store');
Route::get('/belajar', function() {
    return view('belajar');
});
Route::get('/jurusan', function () {
    return view('jurusan');
});
