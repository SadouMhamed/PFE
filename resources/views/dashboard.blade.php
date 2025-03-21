<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            <a href="/dashboard">{{ __('Dashboard') }}</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <h3 class="mb-4 text-lg font-semibold">Bienvenue, {{ Auth::user()->name }}</h3>

               @if(isset($showForm) && $showForm)
                <div >
                    @include('demande-form')  <!-- Inclure le formulaire -->
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
