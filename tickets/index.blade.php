<script>
    function openDescriptionModal(url) {
        console.log('Opening description modal with URL:', url);
        document.getElementById('descriptionForm').action = url;
        document.getElementById('descriptionModal').classList.remove('hidden');
    }
    
    function closeDescriptionModal() {
        document.getElementById('descriptionModal').classList.add('hidden');
    }
</script>
<!-- Modal pour Description -->
<div id="descriptionModal" class="hidden overflow-y-auto fixed inset-0 w-full h-full bg-gray-500 bg-opacity-75" style="z-index: 50;">
    <div class="relative top-20 p-5 mx-auto w-96 bg-white rounded-md border shadow-lg">
        <div class="mt-3">
            <h3 class="mb-4 text-lg font-medium leading-6 text-gray-900">Ajouter une description</h3>
            <form id="descriptionForm" action="" method="POST" class="mt-2">
                @csrf
                @method('PATCH')
                <textarea name="description" rows="4" 
                          class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                          required></textarea>
                <div class="flex justify-end mt-4 space-x-3">
                    <button type="button" onclick="closeDescriptionModal()" 
                            class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-white rounded-md border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Annuler
                    </button>
                    <button type="submit" 
                            class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-md border border-transparent hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@if(auth()->user()->role === 'admin')
<button onclick="openDescriptionModal('{{ route('tickets.addDescription', $ticket->id) }}')" 
        class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-white bg-purple-600 rounded-md border border-transparent transition-colors duration-200 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 ml-2">
    <svg class="mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
    </svg>
    Description
</button>
@endif