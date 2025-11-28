<!-- MODAL: ADD/EDIT SKILL CATEGORY -->
<div id="skillCategoryModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm opacity-0 transition-opacity duration-300">
    <div class="admin-card border-gold-400/30 w-full max-w-md transform scale-95 transition-transform duration-300" id="skillCategoryModalContent">
        <h4 class="text-lg font-bold text-white mb-4 border-b border-white/5 pb-2 flex items-center gap-2">
            <i data-lucide="layers" class="w-5 h-5 text-gold-400"></i> <span id="skillCategoryModalTitle">Add Skill Category</span>
        </h4>

        <form id="skillCategoryForm" class="space-y-6">
            <div>
                <label class="admin-label">Category Name</label>
                <input type="text" name="name" id="skillCategoryNameInput" class="admin-input" placeholder="e.g., Frontend Development" required>
                <p class="text-xs text-zinc-500 mt-1">Enter a descriptive name for the skill category</p>
            </div>

            <!-- Predefined Icon Picker -->
            <div>
                <label class="admin-label">Select Icon</label>
                <input type="hidden" name="icon" id="selectedCategoryIcon" value="layers">
                <div class="flex flex-wrap gap-3 p-3 bg-black/20 rounded-lg border border-white/5" id="categoryIconPicker">
                    <div class="icon-option selected" onclick="selectCategoryIcon(this)" data-icon="layers" title="Layers"><i data-lucide="layers" class="w-5 h-5"></i></div>
                    <div class="icon-option" onclick="selectCategoryIcon(this)" data-icon="code" title="Code"><i data-lucide="code" class="w-5 h-5"></i></div>
                    <div class="icon-option" onclick="selectCategoryIcon(this)" data-icon="monitor" title="Monitor"><i data-lucide="monitor" class="w-5 h-5"></i></div>
                    <div class="icon-option" onclick="selectCategoryIcon(this)" data-icon="database" title="Database"><i data-lucide="database" class="w-5 h-5"></i></div>
                    <div class="icon-option" onclick="selectCategoryIcon(this)" data-icon="server" title="Server"><i data-lucide="server" class="w-5 h-5"></i></div>
                    <div class="icon-option" onclick="selectCategoryIcon(this)" data-icon="cloud" title="Cloud"><i data-lucide="cloud" class="w-5 h-5"></i></div>
                    <div class="icon-option" onclick="selectCategoryIcon(this)" data-icon="settings" title="Settings"><i data-lucide="settings" class="w-5 h-5"></i></div>
                    <div class="icon-option" onclick="selectCategoryIcon(this)" data-icon="bar-chart-2" title="Bar Chart"><i data-lucide="bar-chart-2" class="w-5 h-5"></i></div>
                    <div class="icon-option" onclick="selectCategoryIcon(this)" data-icon="brain-circuit" title="AI/ML"><i data-lucide="brain-circuit" class="w-5 h-5"></i></div>
                    <div class="icon-option" onclick="selectCategoryIcon(this)" data-icon="shield" title="Security"><i data-lucide="shield" class="w-5 h-5"></i></div>
                    <div class="icon-option" onclick="selectCategoryIcon(this)" data-icon="cpu" title="Hardware"><i data-lucide="cpu" class="w-5 h-5"></i></div>
                    <div class="icon-option" onclick="selectCategoryIcon(this)" data-icon="globe" title="Web"><i data-lucide="globe" class="w-5 h-5"></i></div>
                </div>
            </div>

            <div class="flex justify-end gap-3 border-t border-white/5 pt-4">
                <button type="button" onclick="closeSkillCategoryModal()" class="text-zinc-400 hover:text-white text-sm px-4 py-2">Cancel</button>
                <button type="submit" class="bg-gold-400 hover:bg-gold-500 text-black font-bold px-6 py-2 rounded-lg text-sm transition-colors">Save Category</button>
            </div>
        </form>
    </div>
</div>