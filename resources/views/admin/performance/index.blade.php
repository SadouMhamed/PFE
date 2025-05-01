<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-semibold mb-6">Bureau de Poste Performance Metrics</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($metrics as $bureau)
                            <div class="bg-white p-6 rounded-lg shadow-md">
                                <h3 class="text-lg font-semibold mb-4">{{ $bureau->intitule_fr }}</h3>
                                
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Total Requests:</span>
                                        <span class="font-medium">{{ $bureau->demandes_count }}</span>
                                    </div>
                                    
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Resolved:</span>
                                        <span class="text-green-600 font-medium">{{ $bureau->resolved_count }}</span>
                                    </div>
                                    
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Pending:</span>
                                        <span class="text-yellow-600 font-medium">{{ $bureau->pending_count }}</span>
                                    </div>
                                    
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">In Progress:</span>
                                        <span class="text-blue-600 font-medium">{{ $bureau->in_progress_count }}</span>
                                    </div>
                                    
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Avg. Resolution Time:</span>
                                        <span class="font-medium">
                                            {{ number_format($bureau->demandes_avg_resolution_time ?? 0, 1) }} hours
                                        </span>
                                    </div>
                                    
                                    <div class="mt-4 pt-4 border-t">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Resolution Rate:</span>
                                            <span class="font-medium">
                                                {{ $bureau->demandes_count > 0 
                                                    ? number_format(($bureau->resolved_count / $bureau->demandes_count) * 100, 1) 
                                                    : 0 }}%
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>