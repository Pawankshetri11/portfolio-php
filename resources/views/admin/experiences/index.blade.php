<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Experiences') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Manage Experiences</h3>
                        <a href="{{ route('experiences.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add New Experience
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-4 py-2 text-left">Company</th>
                                    <th class="px-4 py-2 text-left">Roles</th>
                                    <th class="px-4 py-2 text-left">Display Type</th>
                                    <th class="px-4 py-2 text-left">Location</th>
                                    <th class="px-4 py-2 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($experiences as $experience)
                                    <tr class="border-t">
                                        <td class="px-4 py-2">{{ $experience->company }}</td>
                                        <td class="px-4 py-2">{{ $experience->roles ? count($experience->roles) : 0 }} role(s)</td>
                                        <td class="px-4 py-2">{{ ucfirst($experience->display_type ?? 'responsibilities') }}</td>
                                        <td class="px-4 py-2">{{ $experience->location ?? 'N/A' }}</td>
                                        <td class="px-4 py-2">
                                            <a href="{{ route('experiences.edit', $experience) }}" class="text-blue-600 hover:text-blue-900 mr-2">Edit</a>
                                            <form method="POST" action="{{ route('experiences.destroy', $experience) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($experiences->isEmpty())
                        <p class="text-gray-500 mt-4">No experiences found. <a href="{{ route('experiences.create') }}" class="text-blue-600">Create one now</a>.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>