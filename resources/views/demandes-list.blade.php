<x-app-layout>
    <div class="py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h2 class="mb-4 text-2xl font-bold text-gray-800">📋 Liste des Demandes</h2>

        <div class="overflow-hidden bg-white rounded-lg shadow-md">
            <table class="min-w-full border border-gray-300 border-collapse">
                <thead class="text-white bg-gray-800">
                    <tr>
                        <th class="px-4 py-2 border border-gray-300">ID</th>
                        <th class="px-4 py-2 border border-gray-300">Type de Problème</th>
                        <th class="px-4 py-2 border border-gray-300">Description</th>
                        <th class="px-4 py-2 border border-gray-300">Bureau de Poste</th>
                        <th class="px-4 py-2 border border-gray-300">Statut</th>
                        <th class="px-4 py-2 border border-gray-300">Date de création</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach($demandes as $demande)
                    <tr class="hover:bg-gray-100">
                        <td class="px-4 py-2 text-center border border-gray-300">{{ $demande->id }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $demande->typeProbleme }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ $demande->description }}</td>
                        <td class="px-4 py-2 border border-gray-300">
                            {{ $demande->bureauDePoste->intitule_fr ?? 'Non assigné' }}
                        </td>
                        <td class="px-4 py-2 text-center border border-gray-300">
                            @if($demande->statut === 'non affecté')
                                <span class="px-3 py-1 text-xs font-semibold text-yellow-800 bg-yellow-200 rounded-full">🟡 Non Affecté</span>
                            @elseif($demande->statut === 'affecté en cours')
                                <span class="px-3 py-1 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">🔵 En Cours</span>
                            @elseif($demande->statut === 'affecté en attente')
                                <span class="px-3 py-1 text-xs font-semibold text-gray-800 bg-gray-200 rounded-full">⚪ En Attente</span>
                            @elseif($demande->statut === 'traité')
                                <span class="px-3 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded-full">🟢 Traité</span>
                            @else
                                <span class="px-3 py-1 text-xs font-semibold text-red-800 bg-red-200 rounded-full">🔴 Clôturé</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 text-center border border-gray-300">{{ $demande->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
