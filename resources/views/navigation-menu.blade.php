<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-jet-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-jet-nav-link>
                    
                    <x-jet-nav-link href="{{ route('demandes.list') }}" :active="request()->routeIs('demandes.list')">
                        {{ __('Demandes') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route('tickets.index') }}" :active="request()->routeIs('tickets.index')">
                        {{ __('Tickets') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route('historique.index') }}" :active="request()->routeIs('historique.index')">
                        <svg class="w-5 h-5 mr-1 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ __('Historique') }}
                    </x-jet-nav-link>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <x-jet-responsive-nav-link href="{{ route('historique.index') }}" :active="request()->routeIs('historique.index')">
                        {{ __('Historique') }}
                    </x-jet-responsive-nav-link>
                </div>
            </div>
        </div>
    </div>
</nav>