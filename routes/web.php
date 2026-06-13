<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\AdminOrderController;

// ─── Redirect root ke login ────────────────────────────────
Route::get('/', fn() => redirect()->route('login'));

// ─── Auth (guest only) ─────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ─── Customer (harus login) ────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/menu',    [MenuController::class, 'index'])->name('menu.index');
    Route::get('/orders',  [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
});

// ─── Admin (harus login + role admin) ─────────────────────
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Kelola Menu
    Route::get('/menu',              [AdminMenuController::class, 'index'])->name('menu.index');
    Route::post('/menu',             [AdminMenuController::class, 'store'])->name('menu.store');
    Route::get('/menu/{menu}/edit',  [AdminMenuController::class, 'edit'])->name('menu.edit');
    Route::put('/menu/{menu}',       [AdminMenuController::class, 'update'])->name('menu.update');
    Route::delete('/menu/{menu}',    [AdminMenuController::class, 'destroy'])->name('menu.destroy');

    // Kelola Pesanan
    Route::get('/orders',                        [AdminOrderController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{order}/status',       [AdminOrderController::class, 'updateStatus'])->name('orders.status');

    // Kelola Users
    Route::get('/users',             [AdminController::class, 'users'])->name('users');
    Route::delete('/users/{user}',   [AdminController::class, 'deleteUser'])->name('users.delete');
});
