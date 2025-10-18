<?php

use App\Http\Controllers\Auth\AzureAuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\MicrosoftAuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Homepage
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Azure AD Authentication Routes
Route::get('/auth/azure', [AzureAuthController::class, 'redirectToAzure'])->name('login.azure');
Route::get('/auth/azure/callback', [AzureAuthController::class, 'handleAzureCallback']);

// Microsoft OAuth Routes
Route::get('/auth/microsoft', [MicrosoftAuthController::class, 'redirectToMicrosoft'])->name('login.microsoft');
Route::get('/auth/microsoft/callback', [MicrosoftAuthController::class, 'handleMicrosoftCallback']);

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile Routes
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [\App\Http\Controllers\ProfileController::class, 'show'])->name('show');
        Route::get('/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('edit');
        Route::put('/', [\App\Http\Controllers\ProfileController::class, 'update'])->name('update');
        
        // Password Routes
        Route::get('/password', [\App\Http\Controllers\ProfileController::class, 'editPassword'])->name('password.edit');
        Route::put('/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('password.update');
    });
    
    // Alias for password update to match the view's form action
    Route::put('/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])
        ->name('password.update');
});
