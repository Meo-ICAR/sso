@extends('layouts.app')

@section('content')
<!-- Sticky Navigation -->
<nav id="main-nav" class="bg-white shadow-sm sticky top-0 z-40 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="flex items-center">
                    <span class="text-xl font-bold text-indigo-600">{{ config('app.name', 'SSO') }}</span>
                </a>
            </div>
            @if (Route::has('login'))
                <div class="flex items-center space-x-4">
                    <button id="mobile-menu-button" class="md:hidden text-gray-700 hover:text-indigo-600 focus:outline-none" aria-label="Toggle menu" aria-expanded="false">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                    <div id="nav-links" class="hidden md:flex items-center space-x-4">
                        <a href="{{ url('/') }}#features" class="text-gray-700 hover:text-indigo-600 transition-colors duration-200 px-3 py-2 rounded-md">
                            Features
                        </a>
                        <a href="{{ url('/') }}#how-it-works" class="text-gray-700 hover:text-indigo-600 transition-colors duration-200 px-3 py-2 rounded-md">
                            How It Works
                        </a>
                        @auth
                            <a href="{{ url('/dashboard') }}" class="border border-gray-300 hover:border-gray-400 bg-white text-gray-700 hover:bg-gray-50 font-medium py-2 px-4 rounded-lg transition-all duration-200">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-indigo-600 font-medium px-3 py-2 rounded-md">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition-all duration-200">
                                    Get started
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            @endif
        </div>
    </div>
</nav>

<div class="min-h-screen bg-gradient-to-br from-indigo-50 to-white flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="p-8">
                <div class="text-center">
                    <h2 class="text-2xl font-bold text-gray-900">Welcome back</h2>
                    <p class="text-gray-600 mt-2">Sign in to your account</p>
                </div>

                    @if (session('error'))
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-red-700">
                                        {{ session('error') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Traditional Login Form -->
                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                            <div class="mt-1">
                                <input id="email" name="email" type="email" autocomplete="email" required 
                                       class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('email') border-red-500 @enderror"
                                       value="{{ old('email') }}" autofocus>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <div class="mt-1">
                                <input id="password" name="password" type="password" autocomplete="current-password" required
                                       class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('password') border-red-500 @enderror">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember-me" name="remember" type="checkbox" 
                                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember-me" class="ml-2 block text-sm text-gray-700">
                                    Remember me
                                </label>
                            </div>

                            @if (Route::has('password.request'))
                                <div class="text-sm">
                                    <a href="{{ route('password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                                        Forgot your password?
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div>
                            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Sign in
                            </button>
                        </div>
                    </form>

                    <div class="mt-6">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white text-gray-500">Or continue with</span>
                            </div>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('login.azure') }}" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="w-5 h-5 text-[#00A4EF]" fill="currentColor" viewBox="0 0 21 21">
                                    <path d="M14.54 1H7.33c-3.41 0-5.43 2.27-5.43 5.45v7.77c0 3.28 2.19 5.45 5.43 5.45h7.21c3.22 0 5.43-2.17 5.43-5.45V6.45C20 3.2 17.76 1 14.54 1zm-3.52 12.22c0 .4-.34.73-.76.73H7.91c-.42 0-.76-.33-.76-.73v-1.46c0-.4.34-.73.76-.73h2.35c.42 0 .76.33.76.73v1.46zm0-4.35c0 .4-.34.73-.76.73H7.91c-.42 0-.76-.33-.76-.73V7.3c0-.4.34-.73.76-.73h2.35c.42 0 .76.33.76.73v1.57zm4.55 4.35c0 .4-.34.73-.76.73h-2.35c-.42 0-.76-.33-.76-.73v-1.46c0-.4.34-.73.76-.73h2.35c.42 0 .76.33.76.73v1.46zm0-4.35c0 .4-.34.73-.76.73h-2.35c-.42 0-.76-.33-.76-.73V7.3c0-.4.34-.73.76-.73h2.35c.42 0 .76.33.76.73v1.57z"/>
                                </svg>
                                <span class="ml-2">Sign in with Microsoft</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mobile menu -->
<div id="mobile-menu" class="hidden md:hidden fixed inset-0 bg-white z-50 p-4 transition-all duration-300 transform translate-x-full">
    <div class="flex justify-between items-center mb-6">
        <span class="text-xl font-bold text-indigo-600">{{ config('app.name', 'SSO') }}</span>
        <button id="close-mobile-menu" class="text-gray-700 hover:text-indigo-600 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    <div class="flex flex-col space-y-4">
        <a href="{{ url('/') }}#features" class="text-gray-700 hover:text-indigo-600 transition-colors duration-200 px-3 py-2 rounded-md">
            Features
        </a>
        <a href="{{ url('/') }}#how-it-works" class="text-gray-700 hover:text-indigo-600 transition-colors duration-200 px-3 py-2 rounded-md">
            How It Works
        </a>
        @auth
            <a href="{{ url('/dashboard') }}" class="border border-gray-300 hover:border-gray-400 bg-white text-gray-700 hover:bg-gray-50 font-medium py-2 px-4 rounded-lg text-center transition-all duration-200">
                Dashboard
            </a>
        @else
            <a href="{{ route('login') }}" class="text-indigo-600 font-medium px-3 py-2 rounded-md">
                Log in
            </a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg text-center transition-all duration-200">
                    Get started
                </a>
            @endif
        @endauth
    </div>
</div>

@push('scripts')
<script>
    // Mobile menu toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const closeMobileMenu = document.getElementById('close-mobile-menu');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuButton) {
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.remove('hidden');
            setTimeout(() => {
                mobileMenu.classList.remove('translate-x-full');
            }, 10);
        });
    }
    
    if (closeMobileMenu) {
        closeMobileMenu.addEventListener('click', () => {
            mobileMenu.classList.add('translate-x-full');
            setTimeout(() => {
                mobileMenu.classList.add('hidden');
            }, 300);
        });
    }
</script>
@endpush

<style>
    /* Ensure the mobile menu has a smooth transition */
    #mobile-menu {
        transition: transform 0.3s ease-in-out;
    }
    
    /* Make sure the login form is properly spaced */
    @media (min-width: 640px) {
        .min-h-screen {
            padding-top: 4rem;
            padding-bottom: 4rem;
        }
    }
</style>
@endsection
