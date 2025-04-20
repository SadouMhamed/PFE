<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-4">Créer un Ticket pour la Demande #{{ $demande->id }}</h2>
                
                <form method="POST" action="{{ route('tickets.store') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="demande_id" value="{{ $demande->id }}">

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Observation</label>
                        <textarea name="observation" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Technicien Assigné</label>
                        <select name="technicien_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            <option value="">Sélectionner un technicien</option>
                            @foreach($techniciens as $technicien)
                                <option value="{{ $technicien->id }}">{{ $technicien->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md">
                            Créer le Ticket
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>