<!-- 4. EDUCATION EDITOR (Hidden) -->
<div id="education-section" class="space-y-8 max-w-5xl mx-auto hidden animate-fade-in pb-20">

    <div class="flex justify-end">
        <button onclick="openEducationModal(false, '{{ route('admin.educations.store') }}')" class="border border-gold-400 text-gold-400 hover:bg-gold-400 hover:text-black font-medium px-4 py-2 rounded-lg text-sm transition-colors flex items-center gap-2">
            <i data-lucide="plus" class="w-4 h-4"></i> Add New Education
        </button>
    </div>

    <!-- Existing Education List -->
    <div class="space-y-6">
        @foreach(\App\Models\Education::all() as $education)
        <!-- Edu Item -->
        <div class="admin-card group relative border-l-4 border-l-gold-400 hover:bg-white/5 transition-colors">
            <!-- Edit Actions -->
            <div class="absolute top-4 right-4 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity z-10">
                <button data-edit-type="education" data-id="{{ $education->id }}" class="p-1.5 bg-black/50 rounded text-white hover:text-gold-400" title="Edit"><i data-lucide="pencil" class="w-4 h-4"></i></button>
                <button data-delete-type="educations" data-id="{{ $education->id }}" class="p-1.5 bg-black/50 rounded text-red-400 hover:bg-red-900/20" title="Delete"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
            </div>

            <div class="flex flex-col md:flex-row gap-6 items-start">
                <!-- Icon Box -->
                <div class="w-14 h-14 bg-zinc-800 rounded-xl flex items-center justify-center border border-zinc-700 text-gold-400 flex-shrink-0">
                    <i data-lucide="{{ $education->icon_style === 'grad-cap' ? 'graduation-cap' : ($education->icon_style === 'book' ? 'book-open-check' : 'award') }}" class="w-7 h-7"></i>
                </div>

                <div class="flex-grow w-full">
                    <div class="flex flex-wrap justify-between items-start mb-1">
                        <h4 class="text-white font-bold text-lg">{{ $education->degree }}</h4>
                        <span class="text-xs font-mono text-gold-400 bg-gold-400/10 px-2 py-1 rounded">
                            {{ $education->start_date ? \Carbon\Carbon::parse($education->start_date)->format('M Y') : '' }} -
                            {{ $education->is_present ? 'Present' : ($education->end_date ? \Carbon\Carbon::parse($education->end_date)->format('M Y') : '') }}
                        </span>
                    </div>
                    <p class="text-zinc-300 text-sm mb-1">{{ $education->institution }}</p>
                    <p class="text-zinc-500 text-xs flex items-center gap-1 mb-3">
                        <i data-lucide="map-pin" class="w-3 h-3"></i> {{ $education->location }}
                    </p>
                    <p class="text-zinc-400 text-sm border-l-2 border-white/10 pl-3">
                        {{ $education->description }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>