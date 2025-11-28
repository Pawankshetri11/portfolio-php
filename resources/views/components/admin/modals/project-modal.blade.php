<!-- MODAL: ADD/EDIT PROJECT -->
<div id="projectModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm opacity-0 transition-opacity duration-300">
    <div class="admin-card border-gold-400/30 w-full max-w-2xl transform scale-95 transition-transform duration-300 max-h-[95vh] overflow-y-auto" id="projectModalContent">
        <h4 class="text-lg font-bold text-white mb-4 border-b border-white/5 pb-2 flex items-center gap-2">
            <i data-lucide="folder-git-2" class="w-5 h-5 text-gold-400"></i> <span id="projectModalTitle">Add Project</span>
        </h4>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="col-span-2 md:col-span-1">
                <label class="admin-label">Project Title</label>
                <input type="text" id="projectTitle" class="admin-input" placeholder="e.g., Smart Mood Enhancer">
            </div>

            <!-- Category Selection -->
            <div class="col-span-2 md:col-span-1">
                <label class="admin-label flex items-center justify-between">
                    Category
                    <button type="button" onclick="openProjectCategoryModal()" class="text-xs text-gold-400 hover:text-gold-300 flex items-center gap-1">
                        <i data-lucide="plus" class="w-3 h-3"></i> Add New
                    </button>
                </label>
                <select class="admin-select text-zinc-300" id="projectCategory" name="category_id">
                    <option value="">Select Category</option>
                    @foreach(\App\Models\ProjectCategory::orderBy('name')->get() as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-span-2">
                <label class="admin-label">Description</label>
                <textarea id="projectDescription" class="admin-input h-24 resize-none text-sm" placeholder="Briefly describe the project..."></textarea>
            </div>

            <div class="col-span-2">
                <label class="admin-label">Tech Stack (Comma separated tags)</label>
                <input type="text" id="projectTechnologies" class="admin-input" placeholder="Python, React, Node.js, SQL...">
            </div>

            <div class="col-span-2 md:col-span-1">
                <label class="admin-label flex items-center gap-2"><i data-lucide="github" class="w-3 h-3"></i> GitHub Link</label>
                <input type="url" id="projectGithubUrl" class="admin-input" placeholder="https://github.com/...">
            </div>

            <div class="col-span-2 md:col-span-1">
                <label class="admin-label flex items-center gap-2"><i data-lucide="external-link" class="w-3 h-3"></i> Live Demo Link</label>
                <input type="url" id="projectLiveUrl" class="admin-input" placeholder="https://...">
            </div>
        </div>

        <div class="mt-6 flex justify-end gap-3 border-t border-white/5 pt-4">
            <button onclick="closeProjectModal()" class="text-zinc-400 hover:text-white text-sm px-4">Cancel</button>
            <button class="bg-gold-400 text-black font-bold px-6 py-2 rounded-lg text-sm">Save Changes</button>
        </div>
    </div>
</div>