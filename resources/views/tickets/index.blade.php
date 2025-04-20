<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden p-6 bg-white shadow-xl sm:rounded-lg">
                <h2 class="mb-6 text-3xl font-bold text-gray-800">Liste des Tickets</h2>
                
                <div class="overflow-x-auto bg-white rounded-lg shadow">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase">ID</th>
                                <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase">Demande</th>
                                <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase">Observation</th>
                                <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase">Technicien</th>
                                <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase">Status</th>
                                <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($tickets as $ticket)
                            <tr class="transition-colors duration-200 hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">#{{ $ticket->id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">#{{ $ticket->demande_id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $ticket->observation }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $ticket->technicien->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $ticket->status === 'traité' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $ticket->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                    <div class="flex space-x-3">
                                        <button onclick="openObservationModal({{ $ticket->id }})" 
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-white bg-blue-600 rounded-md border border-transparent transition-colors duration-200 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            <svg class="mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Observation
                                        </button>
                                        
                                        <form action="{{ route('tickets.markAsProcessed', $ticket->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-white bg-green-600 rounded-md border border-transparent transition-colors duration-200 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                <svg class="mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                Traiter
                                            </button>
                                        </form>
                                        
                                        <a href="{{ route('tickets.generatePdf', $ticket->id) }}" 
                                           class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-white bg-red-600 rounded-md border border-transparent transition-colors duration-200 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            <svg class="mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                            </svg>
                                            PDF
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="observationModal" class="hidden overflow-y-auto fixed inset-0 w-full h-full bg-gray-500 bg-opacity-75" style="z-index: 50;">
        <div class="relative top-20 p-5 mx-auto w-96 bg-white rounded-md border shadow-lg">
            <div class="mt-3">
                <h3 class="mb-4 text-lg font-medium leading-6 text-gray-900">Ajouter une observation</h3>
                <form id="observationForm" action="" method="POST" class="mt-2">
                    @csrf
                    @method('PATCH')
                    <textarea name="observation" rows="4" 
                              class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                              required></textarea>
                    <div class="flex justify-end mt-4 space-x-3">
                        <button type="button" onclick="closeObservationModal()" 
                                class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-white rounded-md border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Annuler
                        </button>
                        <button type="submit" 
                                class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md border border-transparent hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openObservationModal(ticketId) {
            const modal = document.getElementById('observationModal');
            const form = document.getElementById('observationForm');
            form.action = `/tickets/${ticketId}/observation`;
            modal.classList.remove('hidden');
        }

        function closeObservationModal() {
            const modal = document.getElementById('observationModal');
            modal.classList.add('hidden');
        }
    </script>
</x-app-layout>