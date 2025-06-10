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
                        @if(auth()->user()->wilaya_id)
                            <input type="hidden" name="wilaya_id" value="{{ auth()->user()->wilaya_id }}">
                        @else
                            <div class="mb-4">
                                <label for="wilaya_id" class="block text-sm font-medium text-gray-700">Wilaya</label>
                                <select id="wilaya_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('wilaya_id') border-red-500 @enderror" 
                                    name="wilaya_id" required>
                                    <option value="">Select Wilaya</option>
                                    @foreach($wilayas as $wilaya)
                                        <option value="{{ $wilaya->id }}">{{ $wilaya->intitule_fr }}</option>
                                    @endforeach
                                </select>
                                @error('wilaya_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif

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