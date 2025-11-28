<!-- MODAL: ADD/EDIT PROJECT CATEGORY -->
<div id="projectCategoryModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm opacity-0 transition-opacity duration-300">
    <div class="admin-card border-gold-400/30 w-full max-w-lg transform scale-95 transition-transform duration-300" id="projectCategoryModalContent">
        <h4 class="text-lg font-bold text-white mb-4 border-b border-white/5 pb-2 flex items-center gap-2">
            <i data-lucide="tags" class="w-5 h-5 text-gold-400"></i> <span id="projectCategoryModalTitle">Add Project Category</span>
        </h4>

        <form id="projectCategoryForm" class="space-y-6">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" id="projectCategoryMethod" value="POST">

            <div>
                <label class="admin-label">Category Name</label>
                <input type="text" name="name" id="projectCategoryNameInput" class="admin-input" placeholder="e.g., Web Development" required>
            </div>

            <div>
                <label class="admin-label">Description (Optional)</label>
                <textarea name="description" class="admin-input h-20 resize-none" placeholder="Brief description of this category..."></textarea>
            </div>

            <div>
                <label class="admin-label">Color</label>
                <input type="color" name="color" class="admin-input h-12" value="#3B82F6">
            </div>

            <div class="flex justify-end gap-3 border-t border-white/5 pt-4">
                <button type="button" onclick="closeProjectCategoryModal()" class="text-zinc-400 hover:text-white text-sm px-4">Cancel</button>
                <button type="submit" class="bg-gold-400 text-black font-bold px-6 py-2 rounded-lg text-sm">Save Category</button>
            </div>
        </form>
    </div>
</div>