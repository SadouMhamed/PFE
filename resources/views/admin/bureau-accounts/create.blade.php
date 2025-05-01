<x-admin-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="mb-6 text-2xl font-semibold">Create Bureau de Poste Account</h2>

                    @if ($errors->any())
                        <div class="p-4 mb-4 text-red-700 bg-red-100 rounded-lg">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('bureau-accounts.store') }}" class="space-y-6">
                        @csrf
                        <input type="hidden" name="role" value="user">

                        <div>
                            
                            <label for="bureau_de_poste_id" class="block text-sm font-medium text-gray-700">Bureau de Poste <span class="text-red-500">*</span></label>
                            <select id="bureau_de_poste_id" name="bureau_de_poste_id" required class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Select Bureau de Poste</option>
                                @foreach($bureauDePostes as $bureau)
                                    @if(!auth()->user()->wilaya_id || auth()->user()->wilaya_id == $bureau->wilaya_id)
                                        <option value="{{ $bureau->id }}" {{ old('bureau_de_poste_id') == $bureau->id ? 'selected' : '' }}>
                                            {{ $bureau->intitule_fr }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('bureau_de_poste_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="wilaya_id" class="block text-sm font-medium text-gray-700">Wilaya</label>
                            <select id="wilaya_id" name="wilaya_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Select Wilaya</option>
                                @foreach($wilayas as $wilaya)
                                    <option value="{{ $wilaya->id }}" {{ old('wilaya_id') == $wilaya->id ? 'selected' : '' }}>
                                        {{ $wilaya->wilaya_name }}
                                    </option>
                                @endforeach
                               
                            </select>
                        </div>

                        <div>
                            
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" name="password" id="password" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div class="flex justify-end items-center">
                            <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                Create Account
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>