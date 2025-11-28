<!-- 7. PROJECTS EDITOR (Hidden) -->
<div id="projects-section" class="space-y-8 max-w-7xl mx-auto hidden animate-fade-in pb-20">

    <div class="flex justify-end">
        <button onclick="openProjectModal(false)" class="border border-gold-400 text-gold-400 hover:bg-gold-400 hover:text-black font-medium px-4 py-2 rounded-lg text-sm transition-colors flex items-center gap-2">
            <i data-lucide="plus" class="w-4 h-4"></i> Add New Project
        </button>
    </div>

    <!-- Existing Projects List (Grid View) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach(\App\Models\Project::all() as $project)
        <!-- Project -->
        <div class="admin-card group relative hover:bg-white/5 transition-colors flex flex-col h-full border border-white/5 hover:border-gold-400/50">
            <!-- Edit Actions -->
            <div class="absolute top-4 right-4 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity z-10">
                <button data-edit-type="project" data-id="{{ $project->id }}" class="p-1.5 bg-black/80 rounded text-white hover:text-gold-400 border border-white/10" title="Edit"><i data-lucide="pencil" class="w-4 h-4"></i></button>
                <button data-delete-type="projects" data-id="{{ $project->id }}" class="p-1.5 bg-black/80 rounded text-red-400 hover:bg-red-900/20 border border-white/10" title="Delete"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
            </div>

            <div class="flex justify-between items-start mb-4">
                <h4 class="text-white font-bold text-lg leading-tight">{{ $project->title }}</h4>
                <span class="text-xs font-bold text-purple-900 bg-purple-200 px-3 py-1 rounded-full">
                    {{ $project->category === 'ai' ? 'AI/ML' : ($project->category === 'web' ? 'Web' : ($project->category === 'data' ? 'Data' : 'Game')) }}
                </span>
            </div>

            <p class="text-zinc-400 text-sm mb-4 line-clamp-3">
                {{ $project->description }}
            </p>

            <div class="flex flex-wrap gap-2 mb-6">
                @foreach(explode(',', $project->technologies) as $tech)
                <span class="px-3 py-1 text-xs rounded-full bg-zinc-800 text-zinc-300 border border-zinc-700">{{ trim($tech) }}</span>
                @endforeach
            </div>

            <div class="mt-auto flex gap-3">
                @if($project->github_url)
                <button class="flex-1 py-2 rounded bg-zinc-800 text-white text-xs font-bold flex items-center justify-center gap-2 border border-zinc-700">
                    <i data-lucide="github" class="w-3 h-3"></i> GitHub
                </button>
                @endif
                @if($project->live_url)
                <button class="flex-1 py-2 rounded bg-gold-400 text-black text-xs font-bold flex items-center justify-center gap-2">
                    <i data-lucide="external-link" class="w-3 h-3"></i> Live
                </button>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>