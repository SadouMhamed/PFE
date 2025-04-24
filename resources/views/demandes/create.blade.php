<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden p-6 bg-white shadow-xl sm:rounded-lg">
                <h2 class="mb-6 text-3xl font-bold text-gray-800">Créer une Demande</h2>
                
                <form method="POST" action="{{ route('demande.submit') }}" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Type de Problème</label>
                            <select name="typeProbleme" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="hardware">Hardware</option>
                                <option value="software">Software</option>
                                <option value="réseau">Réseau</option>
                            </select>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" rows="4" 
                                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Décrivez votre problème..."></textarea>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Bureau de Poste</label>
                            <select name="bureau_de_poste_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Sélectionner un bureau de poste</option>
                                @foreach($bureauDePostes as $bureau)
                                    <option value="{{ $bureau->id }}">{{ $bureau->intitule_fr }}</option>
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" name="statut" value="non affecté">
                    </div>

                    <div class="flex justify-end items-center mt-6">
                        <button type="submit" 
                            class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-md border border-transparent transition-colors duration-200 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Créer la Demande
                        </button>
                    </div>
                </form>

                @if(session('success'))
                    <div class="p-4 mt-4 text-green-700 bg-green-100 rounded border border-green-400">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="p-4 mt-4 text-red-700 bg-red-100 rounded border border-red-400">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>