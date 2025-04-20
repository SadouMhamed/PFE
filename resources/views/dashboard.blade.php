<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Message -->
            <div class="mb-6 p-6 bg-white rounded-lg shadow-lg">
                <h1 class="text-3xl font-bold text-gray-800">
                    Bonjour, {{ Auth::user()->name }} 👋
                </h1>
                <p class="mt-2 text-gray-600">Bienvenue dans votre tableau de bord</p>
            </div>

            <!-- Stats Section -->
            <div class="grid grid-cols-1 gap-5 mt-2 sm:grid-cols-3 mb-6">
                <div class="p-4 bg-white overflow-hidden shadow-lg rounded-lg">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-500 bg-opacity-75">
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div class="mx-4">
                            <h4 class="text-2xl font-semibold text-gray-700">{{ $ticketsCount }}</h4>
                            <div class="text-gray-500">Tickets</div>
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-white overflow-hidden shadow-lg rounded-lg">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-500 bg-opacity-75">
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <div class="mx-4">
                            <h4 class="text-2xl font-semibold text-gray-700">{{ $demandesCount }}</h4>
                            <div class="text-gray-500">Demandes</div>
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-white overflow-hidden shadow-lg rounded-lg">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-500 bg-opacity-75">
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div class="mx-4">
                            <h4 class="text-2xl font-semibold text-gray-700">{{ $techniciensCount }}</h4>
                            <div class="text-gray-500">Techniciens</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if(request()->routeIs('demande.show'))
                    <h2 class="text-3xl font-bold mb-6 text-gray-800">Créer une Demande</h2>
                    
                    <form method="POST" action="{{ route('demande.submit') }}" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Type de Problème</label>
                                <select name="typeProbleme" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="hardware">Hardware</option>
                                    <option value="software">Software</option>
                                    <option value="réseau">Réseau</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                <textarea name="description" rows="4" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Décrivez votre problème..."></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Bureau de Poste</label>
                                <select name="bureau_de_poste_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Sélectionner un bureau de poste</option>
                                    @foreach($bureauDePostes as $bureau)
                                        <option value="{{ $bureau->id }}">{{ $bureau->intitule_fr }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <input type="hidden" name="statut" value="non affecté">
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Créer la Demande
                            </button>
                        </div>
                    </form>

                    @if(session('success'))
                        <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
