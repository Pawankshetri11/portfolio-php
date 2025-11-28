<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Experience') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('experiences.update', $experience) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
                            <input type="text" name="position" id="position" value="{{ old('position', $experience->position) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @error('position') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="company" class="block text-sm font-medium text-gray-700">Company</label>
                            <input type="text" name="company" id="company" value="{{ old('company', $experience->company) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @error('company') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $experience->start_date->format('Y-m-d')) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @error('start_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date (leave empty for present)</label>
                            <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $experience->end_date ? $experience->end_date->format('Y-m-d') : '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('end_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                            <input type="text" name="location" id="location" value="{{ old('location', $experience->location) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="e.g., Remote, On-site">
                            @error('location') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="display_type" class="block text-sm font-medium text-gray-700">Display Type</label>
                            <select name="display_type" id="display_type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="responsibilities" {{ old('display_type', $experience->display_type ?? 'responsibilities') == 'responsibilities' ? 'selected' : '' }}>Key Responsibilities (List)</option>
                                <option value="description" {{ old('display_type', $experience->display_type) == 'description' ? 'selected' : '' }}>Description (Paragraph)</option>
                            </select>
                            @error('display_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4" id="responsibilities-group" style="{{ old('display_type', $experience->display_type ?? 'responsibilities') == 'responsibilities' ? '' : 'display: none;' }}">
                            <label for="responsibilities" class="block text-sm font-medium text-gray-700">Key Responsibilities (one per line)</label>
                            <textarea name="responsibilities" id="responsibilities" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Enter each responsibility on a new line">{{ old('responsibilities', $experience->responsibilities) }}</textarea>
                            @error('responsibilities') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4" id="description-group" style="{{ old('display_type', $experience->display_type) == 'description' ? '' : 'display: none;' }}">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $experience->description) }}</textarea>
                            @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="technologies" class="block text-sm font-medium text-gray-700">Technologies (comma-separated)</label>
                            <input type="text" name="technologies" id="technologies" value="{{ old('technologies', $experience->technologies) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="e.g., PHP, Laravel, JavaScript">
                            @error('technologies') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex items-center justify-end">
                            <a href="{{ route('experiences.index') }}" class="mr-4 text-gray-600">Cancel</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Experience
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('display_type').addEventListener('change', function() {
            const responsibilitiesGroup = document.getElementById('responsibilities-group');
            const descriptionGroup = document.getElementById('description-group');

            if (this.value === 'responsibilities') {
                responsibilitiesGroup.style.display = 'block';
                descriptionGroup.style.display = 'none';
            } else {
                responsibilitiesGroup.style.display = 'none';
                descriptionGroup.style.display = 'block';
            }
        });
    </script>
</x-app-layout>