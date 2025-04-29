<x-admin-layout>
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-4 mb-8 md:grid-cols-2 lg:grid-cols-4">
        <div class="p-6 bg-blue-100 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-blue-800">Total Tickets</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $ticketStats['total'] }}</p>
            <div class="mt-2 text-sm text-blue-600">
                <span>Handled: {{ $ticketStats['handled'] }}</span>
                <span class="mx-2">|</span>
                <span>Unassigned: {{ $ticketStats['unassigned'] }}</span>
            </div>
        </div>

        <div class="p-6 bg-green-100 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-green-800">Completed Tickets</h3>
            <p class="text-3xl font-bold text-green-600">{{ $ticketStats['completed'] }}</p>
            <p class="mt-2 text-sm text-green-600">
                {{ round(($ticketStats['completed'] / $ticketStats['total']) * 100, 1) }}% completion rate
            </p>
        </div>

        <div class="p-6 bg-yellow-100 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-yellow-800">Pending Tickets</h3>
            <p class="text-3xl font-bold text-yellow-600">{{ $ticketStats['pending'] }}</p>
            <p class="mt-2 text-sm text-yellow-600">
                Requires attention
            </p>
        </div>

        <div class="p-6 bg-purple-100 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-purple-800">Active Technicians</h3>
            <p class="text-3xl font-bold text-purple-600">{{ $totalTechniciens }}</p>
            <p class="mt-2 text-sm text-purple-600">
                Avg: {{ round($ticketStats['handled'] / ($totalTechniciens ?: 1), 1) }} tickets per technician
            </p>
        </div>
    </div>

    <!-- Performance Graphs -->
    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2">
        <div class="p-6 bg-white rounded-lg shadow-sm">
            <h2 class="mb-4 text-lg font-semibold">Ticket Status Distribution</h2>
            <canvas id="ticketStatusChart"></canvas>
        </div>
        
        <div class="p-6 bg-white rounded-lg shadow-sm">
            <h2 class="mb-4 text-lg font-semibold">Technician Workload</h2>
            <canvas id="technicianWorkloadChart"></canvas>
        </div>
    </div>

    <!-- Technician Performance Stats -->
    <div class="p-6 mb-8 bg-white rounded-lg shadow-sm">
        <h2 class="mb-4 text-lg font-semibold">Technician Performance Statistics</h2>
        <div class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-3">
            @foreach($technicienPerformance as $tech)
                <div class="p-4 bg-gray-50 rounded-lg">
                    <h3 class="font-semibold text-gray-800 text-md">{{ $tech['name'] }}</h3>
                    <div class="mt-2 space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Completed Tickets:</span>
                            <span class="font-medium">{{ $tech['completed_tickets'] }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Average Resolution Time:</span>
                            <span class="font-medium">{{ $tech['average_time'] }} hours</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Efficiency Rate:</span>
                            <span class="font-medium">
                                {{ $tech['completed_tickets'] > 0 ? 
                                    round(($tech['completed_tickets'] / $ticketStats['total']) * 100, 1) : 0 }}%
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        // Ticket Status Distribution Chart
        new Chart(document.getElementById('ticketStatusChart'), {
            type: 'doughnut',
            data: {
                labels: ['Completed', 'Pending', 'Unassigned'],
                datasets: [{
                    data: [
                        {{ $ticketStats['completed'] }},
                        {{ $ticketStats['pending'] }},
                        {{ $ticketStats['unassigned'] }}
                    ],
                    backgroundColor: [
                        'rgba(34, 197, 94, 0.6)',
                        'rgba(234, 179, 8, 0.6)',
                        'rgba(239, 68, 68, 0.6)'
                    ],
                    borderColor: [
                        'rgb(34, 197, 94)',
                        'rgb(234, 179, 8)',
                        'rgb(239, 68, 68)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Technician Workload Chart
        new Chart(document.getElementById('technicianWorkloadChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($technicienPerformance->pluck('name')) !!},
                datasets: [{
                    label: 'Completed Tickets',
                    data: {!! json_encode($technicienPerformance->pluck('completed_tickets')) !!},
                    backgroundColor: 'rgba(59, 130, 246, 0.6)',
                    borderColor: 'rgb(59, 130, 246)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Tickets'
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
    <!-- History Sections -->
    <div class="grid grid-cols-1 gap-6 mb-8">
        <!-- Demande History Section -->
        <div class="overflow-hidden bg-white rounded-lg shadow-sm">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="mb-4 text-lg font-semibold text-gray-800">Historique des Demandes</h2>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">ID</th>
                                <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Demande</th>
                                <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">old Status</th>
                                <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">new Status</th>
                                <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Commentaire</th>
                                <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Modifié Par</th>
                                <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($demandeHistoriques ?? [] as $historique)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $historique->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($historique->demande)
                                        <span class="font-medium">Demande #{{ $historique->demande->id }}</span>
                                        <div class="text-xs text-gray-500">{{ $historique->demande->typeProbleme }}</div>
                                    @else
                                        <span class="text-gray-500">Demande non disponible</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 text-xs font-semibold leading-5 text-blue-800 bg-blue-100 rounded-full">
                                        {{ $historique->old_status ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 text-xs font-semibold leading-5 text-blue-800 bg-blue-100 rounded-full">
                                        {{ $historique->new_status ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="max-w-xs text-sm text-gray-900 truncate">{{ $historique->comment ?? 'Aucun commentaire' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($historique->user)
                                        {{ $historique->user->name }}
                                    @else
                                        <span class="text-gray-500">Utilisateur inconnu</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    {{ $historique->created_at->format('d/m/Y H:i') }}
                                    <div class="text-xs">{{ $historique->created_at->diffForHumans() }}</div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-sm text-center text-gray-500">
                                    Aucun historique de demande disponible
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Ticket History Section -->
        <div class="overflow-hidden bg-white rounded-lg shadow-sm">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="mb-4 text-lg font-semibold text-gray-800">Historique des Tickets</h2>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">ID</th>
                                <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Ticket</th>
                                <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Ancien Status</th>
                                <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Nouveau Status</th>
                                <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Commentaire</th>
                                <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Modifié Par</th>
                                <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($ticketHistoriques ?? [] as $historique)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $historique->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($historique->trackable)
                                        <span class="font-medium">Ticket #{{ $historique->trackable->id }}</span>
                                        <div class="text-xs text-gray-500">
                                            @if($historique->trackable->demande)
                                                {{ $historique->trackable->demande->typeProbleme }}
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-gray-500">Ticket non disponible</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 text-xs font-semibold leading-5 text-gray-800 bg-gray-100 rounded-full">
                                        {{ $historique->old_status ?? 'Nouveau' }}
                                    </span>
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                        {{ $historique->new_status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="max-w-xs text-sm text-gray-900 truncate">{{ $historique->comments ?? 'Aucun commentaire' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $historique->changed_by }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    {{ $historique->created_at->format('d/m/Y H:i') }}
                                    <div class="text-xs">{{ $historique->created_at->diffForHumans() }}</div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-sm text-center text-gray-500">
                                    Aucun historique de ticket disponible
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Combined Recent Activities Section -->
        <div class="overflow-hidden bg-white rounded-lg shadow-sm">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="mb-4 text-lg font-semibold text-gray-800">Activités Récentes</h2>
                
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Recent Demandes -->
                    <div>
                        <h3 class="mb-3 font-medium text-gray-700 text-md">Dernières Demandes</h3>
                        <ul class="space-y-3">
                            @forelse($recentDemandes ?? [] as $demande)
                            <li class="p-3 bg-gray-50 rounded-md">
                                <div class="flex justify-between">
                                    <span class="font-medium">Demande #{{ $demande->id }}</span>
                                    <span class="text-sm text-gray-500">{{ $demande->created_at->format('d/m/Y') }}</span>
                                </div>
                                <p class="mt-1 text-sm text-gray-600">{{ $demande->typeProbleme }}</p>
                                <p class="mt-1 text-xs text-gray-500">
                                    Bureau: {{ $demande->bureauDePoste->intitule_fr ?? 'Non spécifié' }}
                                </p>
                                <p class="mt-1 text-xs text-gray-500">
                                    Par: {{ $demande->user->name ?? 'Utilisateur inconnu' }}
                                </p>
                            </li>
                            @empty
                            <li class="text-sm text-gray-500">Aucune demande récente</li>
                            @endforelse
                        </ul>
                    </div>
                    
                    <!-- Recent Tickets -->
                    <div>
                        <h3 class="mb-3 font-medium text-gray-700 text-md">Derniers Tickets</h3>
                        <ul class="space-y-3">
                            @forelse($recentTickets ?? [] as $ticket)
                            <li class="p-3 bg-gray-50 rounded-md">
                                <div class="flex justify-between">
                                    <span class="font-medium">Ticket #{{ $ticket->id }}</span>
                                    <span class="text-sm text-gray-500">{{ $ticket->created_at->format('d/m/Y') }}</span>
                                </div>
                                <p class="mt-1 text-sm text-gray-600">
                                    Status: <span class="px-2 py-1 text-xs rounded-full {{ $ticket->status == 'traité' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $ticket->status }}
                                    </span>
                                </p>
                                <p class="mt-1 text-xs text-gray-500">
                                    Technicien: {{ $ticket->technicien ? $ticket->technicien->name : 'Non assigné' }}
                                </p>
                            </li>
                            @empty
                            <li class="text-sm text-gray-500">Aucun ticket récent</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>