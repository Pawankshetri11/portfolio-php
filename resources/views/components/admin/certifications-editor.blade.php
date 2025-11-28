<!-- 5. CERTIFICATIONS EDITOR (Hidden) -->
<div id="certifications-section" class="space-y-8 max-w-6xl mx-auto hidden animate-fade-in pb-20">

    <div class="flex justify-end">
        <button onclick="openCertificationModal(false)" class="border border-gold-400 text-gold-400 hover:bg-gold-400 hover:text-black font-medium px-4 py-2 rounded-lg text-sm transition-colors flex items-center gap-2">
            <i data-lucide="plus" class="w-4 h-4"></i> Add New Certification
        </button>
    </div>

    <!-- Existing Certifications List (Grid View) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach(\App\Models\Certificate::all() as $certificate)
        <!-- Cert Item -->
        <div class="admin-card group relative hover:bg-white/5 transition-colors flex flex-col h-full">
            <!-- Edit Actions -->
            <div class="absolute top-4 right-4 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity z-10">
                <button data-edit-type="certification" data-id="{{ $certificate->id }}" class="p-1.5 bg-black/50 rounded text-white hover:text-gold-400" title="Edit"><i data-lucide="pencil" class="w-4 h-4"></i></button>
                <button data-delete-type="certificates" data-id="{{ $certificate->id }}" class="p-1.5 bg-black/50 rounded text-red-400 hover:bg-red-900/20" title="Delete"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
            </div>

            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 bg-zinc-800 rounded-lg flex items-center justify-center text-gold-400 border border-white/5">
                    <i data-lucide="{{ $certificate->icon ?: 'award' }}" class="w-5 h-5"></i>
                </div>
                <span class="text-xs font-mono text-zinc-500 border border-white/10 px-2 py-1 rounded">{{ $certificate->issue_date ? \Carbon\Carbon::parse($certificate->issue_date)->format('d/m/Y') : '' }}</span>
            </div>

            <div class="mb-4 flex-grow">
                <h4 class="text-white font-bold text-lg leading-tight mb-1">{{ $certificate->name }}</h4>
                <p class="text-zinc-400 text-sm">{{ $certificate->issuing_organization }}</p>
            </div>

            <div class="pt-4 border-t border-white/5 mt-auto">
                <span class="text-xs text-zinc-500 flex items-center gap-1">
                    @if($certificate->view_type === 'link')
                        <i data-lucide="link" class="w-3 h-3"></i> External Link
                    @else
                        <i data-lucide="image" class="w-3 h-3"></i> Image Popup
                    @endif
                </span>
            </div>
        </div>
        @endforeach
    </div>
</div>