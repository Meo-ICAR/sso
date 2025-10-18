<?php

use App\Http\Controllers\Auth\AzureAuthController;
use App\Http\Controllers\Auth\LoginController;
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

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
