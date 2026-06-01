<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CacheMonitorController;

// Basic Pages
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/db-test', [PageController::class, 'dbTest'])->name('db-test');
Route::get('/users', [PageController::class, 'users'])->name('users');
Route::get('/performance', [PageController::class, 'performance'])->name('performance');
Route::get('/event-test', [PageController::class, 'eventTest'])->name('event.test');

// AJAX Routes
Route::get('/ajax-test', [PageController::class, 'ajaxView'])->name('ajax.test');
Route::get('/get-ajax-data', [PageController::class, 'ajaxData']);

// User Management Routes
Route::prefix('users/manage')->name('users.manage.')->group(function () {
    Route::get('/', [UserManagementController::class, 'index'])->name('index');
    Route::get('/create', [UserManagementController::class, 'create'])->name('create');
    Route::post('/', [UserManagementController::class, 'store'])->name('store');
    Route::get('/{user}/edit', [UserManagementController::class, 'edit'])->name('edit');
    Route::put('/{user}', [UserManagementController::class, 'update'])->name('update');
    Route::delete('/{user}', [UserManagementController::class, 'destroy'])->name('destroy');
    Route::get('/{user}/logs', [UserManagementController::class, 'logs'])->name('logs');
});

// Posts Routes
Route::resource('posts', PostController::class);

// Dashboard Route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Cache Monitor Routes
Route::get('/cache-monitor', [CacheMonitorController::class, 'index'])->name('cache.monitor');
Route::post('/cache-clear', [CacheMonitorController::class, 'clear'])->name('cache.clear');

// Add this route
Route::get('/event-test-page', [PageController::class, 'eventTestPage'])->name('event.test.page');