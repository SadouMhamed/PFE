<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- ... existing code ... -->
</head>
<body>
    <div class="min-h-screen bg-gray-100">
        <!-- Navigation/Sidebar -->
        <!-- ... existing code ... -->
        
        <!-- Page Content -->
        <main class="py-10">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    </div>
    
    <!-- Scripts -->
    <!-- ... existing code ... -->
</body>
</html>