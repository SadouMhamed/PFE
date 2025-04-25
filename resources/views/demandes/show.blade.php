<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold text-gray-800 mb-6">Détails de la Demande #{{ $demande->id }}</h1>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <h2 class="text-sm font-medium text-gray-500">Type de Problème</h2>
                                <p class="mt-1 text-sm text-gray-900">{{ $demande->typeProbleme }}</p>
                            </div>

                            <div>
                                <h2 class="text-sm font-medium text-gray-500">Description</h2>
                                <p class="mt-1 text-sm text-gray-900">{{ $demande->description }}</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <h2 class="text-sm font-medium text-gray-500">Bureau de Poste</h2>
                                <p class="mt-1 text-sm text-gray-900">{{ $demande->bureauDePoste->intitule_fr }}</p>
                            </div>

                            <div>
                                <h2 class="text-sm font-medium text-gray-500">Statut</h2>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $demande->statut === 'traité' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $demande->statut }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-between items-center">
                        <div class="text-sm text-gray-500">
                            Créé le {{ $demande->created_at->format('d/m/Y H:i') }}
                        </div>
                        
                        <div class="flex space-x-4">
                            <button onclick="toggleDetails()" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition ease-in-out duration-150">
                                Afficher Détails
                            </button>
                            
                            <a href="{{ route('demandes.pdf', $demande) }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition ease-in-out duration-150">
                                Télécharger PDF
                            </a>
                            
                            @if(auth()->user()->role !== 'user')
                                <a href="{{ route('tickets.create', $demande) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 transition ease-in-out duration-150">
                                    Créer Ticket
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<div id="detailsSection" class="hidden mt-6 p-4 bg-gray-50 rounded-lg">
    <!-- Additional details can be added here -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <h3 class="font-medium text-gray-700">Informations Supplémentaires</h3>
            <p class="text-sm text-gray-600 mt-2">More details about the demand...</p>
        </div>
    </div>
</div>

<script>
function toggleDetails() {
    const detailsSection = document.getElementById('detailsSection');
    detailsSection.classList.toggle('hidden');
}
</script>