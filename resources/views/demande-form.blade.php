<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="p-6 w-full max-w-2xl bg-white rounded-lg shadow-md">
        <h2 class="mb-4 text-xl font-semibold text-center text-gray-700">Créer une Demande</h2>

        @if(session('success'))
            <p class="text-center text-green-600">{{ session('success') }}</p>
        @endif

        <form action="{{ route('demande.submit') }}" method="POST" class="space-y-4">
            @csrf

           

            <!-- Description -->
            <div>
                <label for="description" class="block text-gray-700">Description:</label>
                <textarea id="description" name="description"
                          class="w-full p-2 border rounded-lg @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <!-- Type de problème -->
            <div>
                <label for="typeProbleme" class="block text-gray-700">Type de problème:</label>
                <select id="typeProbleme" name="typeProbleme"
                        class="w-full p-2 border rounded-lg @error('typeProbleme') border-red-500 @enderror">
                    <option value="">Sélectionnez un type</option>
                    <option value="hardware" {{ old('typeProbleme') == 'hardware' ? 'selected' : '' }}>Hardware</option>
                    <option value="software" {{ old('typeProbleme') == 'software' ? 'selected' : '' }}>Software</option>
                    <option value="réseau" {{ old('typeProbleme') == 'réseau' ? 'selected' : '' }}>Réseau</option>
                </select>
                @error('typeProbleme')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <!-- Statut -->
           
            <div>
                <label for="bureau_de_poste_id" class="block text-gray-700">Bureau de Poste:</label>
                <select id="bureau_de_poste_id" name="bureau_de_poste_id" class="w-full p-2 border rounded-lg">
                    <option value="">Sélectionnez un bureau de poste</option>
                    @foreach($bureauDePostes as $bureau)
                        <option value="{{ $bureau->id }}">{{ $bureau->intitule_fr }}</option>
                    @endforeach
                </select>
                @error('bureau_de_poste_id')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <input type="hidden" name="statut" value="non affecté">
            </div>

            <!-- Bouton de soumission -->
            <button type="submit"
                    class="p-3 w-full text-white bg-blue-600 rounded-lg transition hover:bg-blue-700">
                Soumettre
            </button>
        </form>
    </div>
</div>
