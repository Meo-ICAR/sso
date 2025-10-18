<?php

use App\Http\Controllers\Auth\AzureAuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\MicrosoftAuthController;
use App\Http\Controllers\ProfileController;
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

// Test route for Microsoft OAuth
Route::get('/test/microsoft', function () {
    try {
        $provider = \Laravel\Socialite\Facades\Socialite::driver('microsoft');
        
        // Debug: Check if the provider is properly initialized
        if (!($provider instanceof \Laravel\Socialite\Two\AbstractProvider)) {
            throw new \Exception('Provider is not an instance of AbstractProvider');
        }
        
        return response()->json([
            'status' => 'success',
            'provider' => get_class($provider),
            'config' => [
                'client_id' => config('services.microsoft.client_id'),
                'redirect' => config('services.microsoft.redirect'),
                'tenant' => config('services.microsoft.tenant', 'common'),
                'config_path' => config_path('services.php'),
                'env' => [
                    'client_id' => env('MICROSOFT_CLIENT_ID'),
                    'redirect' => env('MICROSOFT_REDIRECT_URI'),
                    'tenant' => env('MICROSOFT_TENANT_ID')
                ]
            ]
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
            'providers' => array_keys(config('app.providers')),
            'services_config' => config('services.microsoft')
        ], 500);
    }
});

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile Routes
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
        
        // Password Routes
        Route::get('/password', [ProfileController::class, 'editPassword'])->name('password.edit');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    });
    
    // Alias for password update to match the view's form action
    Route::put('/password', [ProfileController::class, 'updatePassword'])
        ->name('password.update');
});
