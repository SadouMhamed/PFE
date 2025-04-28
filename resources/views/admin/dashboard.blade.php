<x-admin-layout>
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-blue-100 p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-blue-800">Total Tickets</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $ticketStats['total'] }}</p>
            <div class="mt-2 text-sm text-blue-600">
                <span>Handled: {{ $ticketStats['handled'] }}</span>
                <span class="mx-2">|</span>
                <span>Unassigned: {{ $ticketStats['unassigned'] }}</span>
            </div>
        </div>

        <div class="bg-green-100 p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-green-800">Completed Tickets</h3>
            <p class="text-3xl font-bold text-green-600">{{ $ticketStats['completed'] }}</p>
            <p class="mt-2 text-sm text-green-600">
                {{ round(($ticketStats['completed'] / $ticketStats['total']) * 100, 1) }}% completion rate
            </p>
        </div>

        <div class="bg-yellow-100 p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-yellow-800">Pending Tickets</h3>
            <p class="text-3xl font-bold text-yellow-600">{{ $ticketStats['pending'] }}</p>
            <p class="mt-2 text-sm text-yellow-600">
                Requires attention
            </p>
        </div>

        <div class="bg-purple-100 p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-purple-800">Active Technicians</h3>
            <p class="text-3xl font-bold text-purple-600">{{ $totalTechniciens }}</p>
            <p class="mt-2 text-sm text-purple-600">
                Avg: {{ round($ticketStats['handled'] / ($totalTechniciens ?: 1), 1) }} tickets per technician
            </p>
        </div>
    </div>

    <!-- Performance Graphs -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-lg font-semibold mb-4">Ticket Status Distribution</h2>
            <canvas id="ticketStatusChart"></canvas>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-lg font-semibold mb-4">Technician Workload</h2>
            <canvas id="technicianWorkloadChart"></canvas>
        </div>
    </div>

    <!-- Technician Performance Stats -->
    <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
        <h2 class="text-lg font-semibold mb-4">Technician Performance Statistics</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            @foreach($technicienPerformance as $tech)
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-md font-semibold text-gray-800">{{ $tech['name'] }}</h3>
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
    <!-- After your existing dashboard content -->
    <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
        <h2 class="text-lg font-semibold mb-4">Recent Status Updates</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Old Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">New Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Changed By</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($statusHistories as $history)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ class_basename($history->trackable_type) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $history->trackable_id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    {{ $history->old_status ?? 'Created' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $history->new_status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $history->changed_by }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $history->created_at->diffForHumans() }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- History Section -->
    <div class="mt-8">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Activity History</h2>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Reference</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Previous Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">New Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($statusHistories as $history)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                    {{ $history->type }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                    #{{ $history->reference_id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $history->old_status ? 'bg-gray-100 text-gray-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $history->old_status ?? 'New' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $history->new_status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $history->created_at->diffForHumans() }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                    No history records found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>