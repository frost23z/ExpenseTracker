<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ExpenseTracker') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <!-- Navigation -->
            <nav class="bg-white border-b border-gray-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <a href="{{ url('/') }}">
                                    <x-application-logo class="block h-9 w-auto" />
                                </a>
                                <p class="ml-2 text-lg font-semibold">{{ config('app.name', 'ExpenseTracker') }}</p>
                            </div>
                        </div>
                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            @if (Route::has('login'))
                                <div class="space-x-4">
                                    @auth
                                        <a href="{{ url('/dashboard') }}" class="text-sm underline">Dashboard</a>
                                    @else
                                        <a href="{{ route('login') }}" class="text-sm underline">Log in</a>
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="ml-4 text-sm underline">Register</a>
                                        @endif
                                    @endauth
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="flex-1 flex items-center justify-center min-h-[calc(100vh-4rem)]">
                <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                    <div class="text-center">
                        <h1 class="text-4xl font-bold text-gray-900">Welcome to ExpenseTracker</h1>
                        <p class="mt-4 text-lg text-gray-600">
                            Manage your personal finances with ease. Track your income and expenses, categorize transactions, and generate insightful reports.
                        </p>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
