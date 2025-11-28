<!-- 6. SKILLS EDITOR (UPDATED) -->
<div id="skills-section" class="space-y-8 max-w-5xl mx-auto hidden">
    <div class="flex justify-between items-center">
        <h3 class="text-xl font-bold text-white">Technical Skills</h3>
        <button class="border border-gold-400 text-gold-400 hover:bg-gold-400 hover:text-black font-medium px-4 py-2 rounded-lg text-sm transition-colors flex items-center gap-2">
            <i data-lucide="plus" class="w-4 h-4"></i> Add Skill
        </button>
    </div>

    <!-- Add/Edit Form -->
    <div class="admin-card">
        <h4 class="text-lg font-bold text-white mb-4 border-b border-white/5 pb-2">Add / Edit Skill</h4>
        <form id="skillForm" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="admin-label">Skill Name</label>
                <input type="text" name="name" class="admin-input" placeholder="e.g., Python" required>
            </div>
            <div>
                <label class="admin-label">Category</label>
                <select class="admin-select text-zinc-300" name="category_id" required>
                    <option value="">Select Category</option>
                    @foreach($categories ?? [] as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="admin-label">Skill Level</label>
                <select name="level" class="admin-select text-zinc-300" required>
                    <option value="">Select Level</option>
                    <option value="beginner">Beginner</option>
                    <option value="intermediate">Intermediate</option>
                    <option value="advanced">Advanced</option>
                </select>
            </div>
            <div>
                <label class="admin-label">Skill Icon/Image</label>
                <label class="file-upload-box block">
                    <input type="file" name="logo" accept="image/*,.svg" class="hidden" onchange="updateFileName(this)">
                    <div class="flex flex-col items-center justify-center gap-2 text-zinc-400">
                        <i data-lucide="upload-cloud" class="w-8 h-8 text-gold-400"></i>
                        <span class="text-sm file-upload-text">Click to upload SVG/PNG</span>
                        <span class="text-xs text-gold-400 file-name hidden"></span>
                    </div>
                </label>
            </div>
            <div class="mt-6 col-span-2 flex justify-end gap-3">
                <button type="button" onclick="resetSkillForm()" class="text-zinc-400 hover:text-white text-sm px-4">Cancel</button>
                <button type="submit" class="bg-gold-400 text-black font-bold px-6 py-2 rounded-lg text-sm">Save Skill</button>
            </div>
        </form>
    </div>

    <!-- Existing Skills List -->
    <div id="skills-list" class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @php
            $skills = \App\Models\Skill::with('category')->get();
        @endphp
        @forelse($skills as $skill)
        <div class="bg-zinc-900/50 border border-white/5 rounded-lg p-4 flex items-center gap-3 hover:border-gold-400/50 transition-colors relative group skill-item" data-id="{{ $skill->id }}">
            <div class="w-8 h-8 rounded bg-white/5 flex items-center justify-center">
                @if($skill->logo)
                    <img src="{{ asset('storage/' . $skill->logo) }}" alt="{{ $skill->name }}" class="w-4 h-4 object-contain">
                @else
                    <i data-lucide="code" class="w-4 h-4 text-blue-400"></i>
                @endif
            </div>
            <div>
                <p class="text-sm font-bold text-white">{{ $skill->name }}</p>
                <p class="text-[10px] text-zinc-500">{{ $skill->category->name ?? 'No Category' }}</p>
            </div>
            <button class="absolute top-2 right-2 text-zinc-500 hover:text-red-400 opacity-0 group-hover:opacity-100 transition-opacity delete-skill" data-id="{{ $skill->id }}">
                <i data-lucide="x" class="w-3 h-3"></i>
            </button>
        </div>
        @empty
        <div class="col-span-full text-center py-8 text-zinc-500">
            <i data-lucide="zap" class="w-12 h-12 mx-auto mb-4 opacity-50"></i>
            <p>No skills added yet. Click "Add Skill" to get started.</p>
        </div>
        @endforelse
    </div>
</div>