<x-admin-layout>
    <!-- Notification Component -->
    <div class="fixed top-4 right-4 z-50">
        <div class="inline-block relative">
            <button id="notification-button" class="relative p-2 text-gray-600 bg-white rounded-full hover:bg-gray-100 hover:text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <span id="notification-counter" class="inline-flex absolute top-0 right-0 justify-center items-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">{{ $pendingDemandes ?? 0 }}</span>
            </button>
            
            
            <div id="notification-dropdown" class="hidden overflow-hidden absolute right-0 z-20 mt-2 w-80 bg-white rounded-md shadow-lg">
                <div class="py-2">
                    <div class="px-4 py-2 bg-gray-100 border-b border-gray-200">
                        <h3 class="text-sm font-semibold text-gray-800">Notifications</h3>
                    </div>
                    <div id="notification-list" class="overflow-y-auto max-h-64">
                        @forelse($recentDemandes ?? [] as $demande)
                            <a href="{{ route('demandes.show', $demande->id) }}" class="block px-4 py-3 border-b border-gray-200 transition duration-150 ease-in-out hover:bg-gray-50">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 p-1 bg-blue-500 rounded-full">
                                        <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 ml-3 w-0">
                                        <p class="text-sm font-medium text-gray-900">New Demand: #{{ $demande->id }}</p>
                                        <p class="text-sm text-gray-500 truncate">{{ $demande->type_probleme }}</p>
                                        <p class="text-xs text-gray-400">{{ $demande->created_at->diffForHumans() }}</p>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $demande->statut === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800' }}">
                                            {{ $demande->statut }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="px-4 py-6 text-center text-gray-500">
                                No new notifications
                            </div>
                        @endforelse
                    </div>
                    <div class="px-4 py-2 text-center bg-gray-100">
                        <a href="{{ route('demandes.list') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">View all demands</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Action Buttons -->
    <div class="mb-8 flex flex-wrap gap-4">
        <a href="{{ route('techniciens.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Create Technician
        </a>
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Create Admin User
        </a>
        <a href="{{ route('bureau-accounts.create') }}" class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-800 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Create Bureau Account
        </a>
    </div>
    
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
                {{ $ticketStats['total'] > 0 ? round(($ticketStats['completed'] / $ticketStats['total']) * 100, 1) : 0 }}% completion rate
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
                                    <div class="max-w-xs text-sm text-gray-900 truncate">{{ $historique->observation ?? 'Aucun commentaire' }}</div>
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
    
    <script>
        // Notification System
        <!-- Add notification sound functionality -->
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, setting up notification sound');
            // Create audio element for notification sound
            const notificationSound = new Audio('/sounds/notification.mp3');
            notificationSound.addEventListener('canplaythrough', function() {
            console.log('Notification sound loaded successfully');
        });
        notificationSound.addEventListener('error', function(e) {
            console.error('Error loading notification sound:', e);
            console.error('Error code:', this.error.code);
            console.error('Error message:', this.error.message);
        });
            
            // Function to play notification sound
            function playNotificationSound() {
                notificationSound.play().catch(error => {
                    console.error('Error playing notification sound:', error);
                });
            }
            
            // Toggle notification dropdown
            const notificationButton = document.getElementById('notification-button');
            const notificationDropdown = document.getElementById('notification-dropdown');
            
            notificationButton.addEventListener('click', function() {
                notificationDropdown.classList.toggle('hidden');
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!notificationButton.contains(event.target) && !notificationDropdown.contains(event.target)) {
                    notificationDropdown.classList.add('hidden');
                }
            });
            
            // Play sound when new notifications arrive (example implementation)
            // You'll need to integrate this with your actual notification system
            const notificationCounter = document.getElementById('notification-counter');
            let previousCount = parseInt(notificationCounter.textContent);
            
            // Check for new notifications periodically (every 30 seconds)
            setInterval(function() {
                fetch('/api/notifications/count')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`API returned ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        const newCount = data.count;
                        if (newCount > previousCount) {
                            playNotificationSound();
                            previousCount = newCount;
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching notifications:', error);
                        // Don't keep trying if endpoint doesn't exist
                        // clearInterval(this);
                    });
            }, 30000);
            
            // Play sound on initial load if there are pending notifications
            if (parseInt(notificationCounter.textContent) > 0) {
                playNotificationSound();
            }
        });
    </script>
</x-admin-layout>