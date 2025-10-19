<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Secure Single Sign-On (SSO) Authentication System">
    <meta name="theme-color" content="#4f46e5">

    <title>{{ config('app.name', 'SSO Authentication') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.svg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        }
        .btn-primary {
            @apply bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-lg transition-all duration-200;
        }
        .btn-outline {
            @apply border border-gray-300 hover:border-gray-400 bg-white text-gray-700 hover:bg-gray-50 font-medium py-2 px-6 rounded-lg transition-all duration-200;
        }
        .auth-card {
            @apply bg-white rounded-2xl shadow-xl overflow-hidden w-full max-w-md;
        }
        .divider {
            @apply relative my-6;
        }
        .divider::before {
            @apply absolute top-1/2 left-0 right-0 h-px bg-gray-200 -translate-y-1/2;
            content: '';
        }
        .divider-text {
            @apply relative px-4 bg-white text-sm text-gray-500;
        }
        .feature-card {
            @apply p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-50 to-white antialiased">
    <div class="min-h-screen flex flex-col">
        <!-- Sticky Navigation -->
        <nav id="main-nav" class="bg-white shadow-sm sticky top-0 z-40 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="#" class="flex items-center">
                            <svg class="h-8 w-8 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                            </svg>
                            <span class="ml-2 text-xl font-bold text-gray-900">{{ config('app.name', 'SSO') }}</span>
                        </a>
                    </div>
                    <div class="hidden md:flex items-center space-x-4">
                        <a href="#features" class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium">Features</a>
                        <a href="#" class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium">Documentation</a>
                        <a href="#" class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium">Support</a>
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn-primary">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn-primary">Get started</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                    <div class="md:hidden flex items-center">
                        <!-- Mobile menu button -->
                        <button type="button" class="text-gray-700 hover:text-indigo-600 focus:outline-none" aria-controls="mobile-menu" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <main id="main-content" class="flex-grow" tabindex="-1">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="lg:grid lg:grid-cols-2 lg:gap-12 items-center">
                    <!-- Left Column -->
                    <div class="mb-12 lg:mb-0">
                        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                            Secure Access to All Your <span class="text-indigo-600">Applications</span>
                        </h1>
                        <p class="text-lg text-gray-600 mb-8">
                            A secure, modern single sign-on solution that connects you to all your applications with just one set of credentials.
                        </p>
                        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                            <a href="#" class="btn-primary text-center">
                                Get Started
                            </a>
                            <a href="#features" class="btn-outline text-center">
                                Learn More
                            </a>
                        </div>
                        <div class="mt-12">
                            <div class="flex items-center space-x-2 text-sm text-gray-500">
                                <span>Trusted by leading companies</span>
                                <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                            <div class="mt-4 flex flex-wrap items-center gap-6">
                                <div class="h-8 text-gray-400">
                                    <span class="font-bold text-gray-700">Company</span>One
                                </div>
                                <div class="h-8 text-gray-400">
                                    <span class="font-bold text-gray-700">Company</span>Two
                                </div>
                                <div class="h-8 text-gray-400">
                                    <span class="font-bold text-gray-700">Company</span>Three
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Auth Card -->
                    <div class="auth-card">
                        <div class="p-8">
                            <div class="text-center mb-8">
                                <h2 class="text-2xl font-bold text-gray-900">Welcome back</h2>
                                <p class="text-gray-600 mt-2">Sign in to your account</p>
                            </div>

                            <div class="space-y-4">
                                <a href="#" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12.545 10.239v3.821h5.445c-0.712 2.315-2.647 3.972-5.445 3.972-3.332 0-6.033-2.701-6.033-6.032s2.701-6.032 6.033-6.032c1.498 0 2.866 0.548 3.921 1.453l2.814-2.814c-1.884-1.672-4.41-2.607-6.735-2.607-5.522 0-10 4.479-10 10s4.478 10 10 10c8.396 0 10-7.524 10-10 0-0.668-0.069-1.183-0.128-1.761h-9.872z"/>
                                    </svg>
                                    Sign in with Google
                                </a>
                                <a href="#" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    <svg class="w-5 h-5 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                                    </svg>
                                    Sign in with Facebook
                                </a>
                            </div>

                            <div class="divider">
                                <span class="divider-text">Or continue with</span>
                            </div>

                            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                                @csrf
                                
                                @if($errors->any())
                                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm text-red-700">
                                                    {{ $errors->first() }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if (session('status'))
                                    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-4">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm text-green-700">
                                                    {{ session('status') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                                    <div class="mt-1">
                                        <input id="email" name="email" type="email" autocomplete="email" required 
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            value="{{ old('email') }}">
                                    </div>
                                </div>

                                <div>
                                    <div class="flex items-center justify-between">
                                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                        @if (Route::has('password.request'))
                                            <div class="text-sm">
                                                <a href="{{ route('password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                                                    Forgot your password?
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="mt-1">
                                        <input id="password" name="password" type="password" autocomplete="current-password" required 
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </div>
                                </div>

                                <div class="flex items-center">
                                    <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                    <label for="remember" class="ml-2 block text-sm text-gray-700">
                                        Remember me
                                    </label>
                                </div>

                                <div>
                                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Sign in
                                    </button>
                                </div>
                            </form>

                            @if (Route::has('register'))
                                <div class="mt-6 text-center text-sm">
                                    <p class="text-gray-600">
                                        Don't have an account? 
                                        <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                                            Sign up
                                        </a>
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back to top button -->
            <button id="back-to-top" class="fixed bottom-8 right-8 bg-indigo-600 text-white p-3 rounded-full shadow-lg opacity-0 invisible transition-all duration-300 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" aria-label="Back to top">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                </svg>
            </button>
        </main>

        <!-- Features Section -->
        <section id="features" class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                        Everything you need for secure authentication
                    </h2>
                    <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                        Our platform provides all the tools you need to secure your applications and streamline user access.
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="feature-card">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Enterprise Security</h3>
                        <p class="text-gray-600">Military-grade encryption and security protocols to keep your data safe.</p>
                    </div>

                    <div class="feature-card">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Lightning Fast</h3>
                        <p class="text-gray-600">Quick authentication with minimal latency for better user experience.</p>
                    </div>

                    <div class="feature-card">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">99.9% Uptime</h3>
                        <p class="text-gray-600">Reliable service with guaranteed uptime for your business needs.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-50 border-t border-gray-200">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 tracking-wider uppercase">Product</h3>
                        <ul class="mt-4 space-y-2">
                            <li><a href="#" class="text-base text-gray-600 hover:text-gray-900">Features</a></li>
                            <li><a href="#" class="text-base text-gray-600 hover:text-gray-900">Pricing</a></li>
                            <li><a href="#" class="text-base text-gray-600 hover:text-gray-900">Documentation</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 tracking-wider uppercase">Company</h3>
                        <ul class="mt-4 space-y-2">
                            <li><a href="#" class="text-base text-gray-600 hover:text-gray-900">About</a></li>
                            <li><a href="#" class="text-base text-gray-600 hover:text-gray-900">Blog</a></li>
                            <li><a href="#" class="text-base text-gray-600 hover:text-gray-900">Careers</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 tracking-wider uppercase">Support</h3>
                        <ul class="mt-4 space-y-2">
                            <li><a href="#" class="text-base text-gray-600 hover:text-gray-900">Help Center</a></li>
                            <li><a href="#" class="text-base text-gray-600 hover:text-gray-900">Contact Us</a></li>
                            <li><a href="#" class="text-base text-gray-600 hover:text-gray-900">Status</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 tracking-wider uppercase">Legal</h3>
                        <ul class="mt-4 space-y-2">
                            <li><a href="#" class="text-base text-gray-600 hover:text-gray-900">Privacy</a></li>
                            <li><a href="#" class="text-base text-gray-600 hover:text-gray-900">Terms</a></li>
                            <li><a href="#" class="text-base text-gray-600 hover:text-gray-900">Cookie Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="mt-8 border-t border-gray-200 pt-8 md:flex md:items-center md:justify-between">
                    <div class="flex space-x-6 md:order-2">
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">GitHub</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                    <p class="mt-8 text-base text-gray-500 md:mt-0 md:order-1">
                        &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </div>

    <script>
        // Back to top button
        document.addEventListener('DOMContentLoaded', function() {
            const backToTopButton = document.getElementById('back-to-top');
            
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    backToTopButton.classList.remove('opacity-0', 'invisible');
                    backToTopButton.classList.add('opacity-100', 'visible');
                } else {
                    backToTopButton.classList.remove('opacity-100', 'visible');
                    backToTopButton.classList.add('opacity-0', 'invisible');
                }
            });

            backToTopButton.addEventListener('click', function(e) {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>
