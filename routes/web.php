<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AzureAuthController;

Route::get('/', function () {
    return view('welcome');

Route::get('/auth/azure', [AzureAuthController::class, 'redirectToAzure'])->name('login.azure');
Route::get('/auth/azure/callback', [AzureAuthController::class, 'handleAzureCallback']);
});
