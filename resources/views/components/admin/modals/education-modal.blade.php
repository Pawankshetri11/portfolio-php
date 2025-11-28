<!-- MODAL: ADD/EDIT EDUCATION -->
<div id="educationModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm opacity-0 transition-opacity duration-300">
    <div class="admin-card border-gold-400/30 w-full max-w-2xl transform scale-95 transition-transform duration-300 max-h-[90vh] overflow-y-auto" id="educationModalContent">
        <h4 class="text-lg font-bold text-white mb-4 border-b border-white/5 pb-2 flex items-center gap-2">
            <i data-lucide="graduation-cap" class="w-5 h-5 text-gold-400"></i> <span id="educationModalTitle">Add Education</span>
        </h4>

        <form id="educationForm" method="POST" action="">
            @csrf
            <input type="hidden" name="_method" id="educationMethod" value="POST">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="col-span-2 md:col-span-1">
                    <label class="admin-label">Degree / Course Name</label>
                    <input type="text" name="degree" class="admin-input" placeholder="e.g., Master's of Computer Application" required>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label class="admin-label">Institution / University</label>
                    <input type="text" name="institution" class="admin-input" placeholder="e.g., Graphic Era University" required>
                </div>

                <div>
                    <label class="admin-label">Start Date</label>
                    <input type="date" name="start_date" class="admin-input" required>
                </div>
                <div>
                    <label class="admin-label">End Date</label>
                    <div class="flex gap-2">
                        <input type="date" name="end_date" class="admin-input" id="educationEndDateInput">
                        <div class="flex items-center gap-2 min-w-[80px]">
                            <input type="checkbox" name="is_present" id="educationPresent" class="w-4 h-4 accent-gold-400" onchange="toggleEducationEndDate(this)" value="1">
                            <label for="educationPresent" class="text-sm text-zinc-400">Present</label>
                        </div>
                    </div>
                </div>

                <div class="col-span-2 md:col-span-1">
                    <label class="admin-label">Location</label>
                    <input type="text" name="location" class="admin-input" placeholder="e.g., Dehradun, IN">
                </div>
                

                <div class="col-span-2">
                    <label class="admin-label">Description / Key Focus</label>
                    <textarea name="description" class="admin-input h-24 resize-none text-sm" placeholder="Briefly describe your major or focus areas..."></textarea>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3 border-t border-white/5 pt-4">
                <button type="button" onclick="closeEducationModal()" class="text-zinc-400 hover:text-white text-sm px-4">Cancel</button>
                <button type="submit" class="bg-gold-400 text-black font-bold px-6 py-2 rounded-lg text-sm">Save Changes</button>
            </div>
        </form>
    </div>
</div>