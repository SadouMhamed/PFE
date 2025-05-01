<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script>
            // Wait for the DOM to be fully loaded
            document.addEventListener('DOMContentLoaded', function() {
                // Get the notification button and dropdown elements
                const notificationButton = document.getElementById('notification-button');
                const notificationDropdown = document.getElementById('notification-dropdown');
                
                // If both elements exist, set up the click event
                if (notificationButton && notificationDropdown) {
                    // Toggle the dropdown when the button is clicked
                    notificationButton.addEventListener('click', function(event) {
                        event.preventDefault();
                        notificationDropdown.classList.toggle('hidden');
                    });
                    
                    // Close the dropdown when clicking outside
                    document.addEventListener('click', function(event) {
                        if (!notificationButton.contains(event.target) && !notificationDropdown.contains(event.target)) {
                            notificationDropdown.classList.add('hidden');
                        }
                    });
                }
            });
        </script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>

@auth
    @if(auth()->user()->role !== 'user')
        <x-nav-link :href="route('tickets.index')" :active="request()->routeIs('tickets.*')">
            {{ __('Tickets') }}
        </x-nav-link>
    @endif
@endauth
