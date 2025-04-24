<x-admin-layout>
    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold">Manage Technicians</h2>
                <a href="{{ route('techniciens.create') }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                    Add New Technician
                </a>
            </div>

            @if(session('success'))
                <div class="relative px-4 py-3 mb-4 text-green-700 bg-green-100 rounded border border-green-400">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($techniciens as $technicien)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $technicien->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $technicien->email }}</td>
                                <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                    <a href="{{ route('techniciens.edit', $technicien) }}" class="mr-3 text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <form action="{{ route('techniciens.destroy', $technicien) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                       <!-- <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button> !-->
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>