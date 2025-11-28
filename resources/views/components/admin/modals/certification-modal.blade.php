<!-- MODAL: ADD/EDIT CERTIFICATION -->
<div id="certificationModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm opacity-0 transition-opacity duration-300">
    <div class="admin-card border-gold-400/30 w-full max-w-2xl transform scale-95 transition-transform duration-300 max-h-[95vh] overflow-y-auto" id="certificationModalContent">
        <h4 class="text-lg font-bold text-white mb-4 border-b border-white/5 pb-2 flex items-center gap-2">
            <i data-lucide="award" class="w-5 h-5 text-gold-400"></i> <span id="certificationModalTitle">Add Certification</span>
        </h4>

        <form id="certificationForm" class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="col-span-2 md:col-span-1">
                <label class="admin-label">Certificate Name</label>
                <input type="text" name="name" class="admin-input" placeholder="e.g., AWS Certified Developer" required>
            </div>
            <div class="col-span-2 md:col-span-1">
                <label class="admin-label">Issuing Organization</label>
                <input type="text" name="issuing_organization" class="admin-input" placeholder="e.g., Amazon Web Services" required>
            </div>

            <div>
                <label class="admin-label">Issue Date</label>
                <input type="date" name="issue_date" class="admin-input" required>
            </div>

            <!-- View Type Selection -->
            <div>
                <label class="admin-label">Certificate View Type</label>
                <select name="view_type" class="admin-select text-zinc-300" id="certViewTypeSelector" onchange="toggleCertViewType()" required>
                    <option value="link">External Link (URL)</option>
                </select>
            </div>

            <!-- Dynamic Field: Link -->
            <div class="col-span-2" id="certLinkInputGroup">
                <label class="admin-label">Credential URL</label>
                <input type="url" name="credential_url" class="admin-input" placeholder="https://www.credly.com/...">
            </div>

            <!-- Predefined Icon Picker -->
            <div class="col-span-2">
                <label class="admin-label">Select Icon</label>
                <input type="hidden" name="icon" id="selectedIcon" value="award">
                <div class="flex flex-wrap gap-3 p-3 bg-black/20 rounded-lg border border-white/5" id="certIconPicker">
                    <!-- Icons will be generated here but kept static for demo -->
                    <div class="icon-option selected" onclick="selectCertIcon(this)" data-icon="award"><i data-lucide="award" class="w-5 h-5"></i></div>
                    <div class="icon-option" onclick="selectCertIcon(this)" data-icon="cloud"><i data-lucide="cloud" class="w-5 h-5"></i></div>
                    <div class="icon-option" onclick="selectCertIcon(this)" data-icon="database"><i data-lucide="database" class="w-5 h-5"></i></div>
                    <div class="icon-option" onclick="selectCertIcon(this)" data-icon="code"><i data-lucide="code" class="w-5 h-5"></i></div>
                    <div class="icon-option" onclick="selectCertIcon(this)" data-icon="server"><i data-lucide="server" class="w-5 h-5"></i></div>
                    <div class="icon-option" onclick="selectCertIcon(this)" data-icon="shield"><i data-lucide="shield" class="w-5 h-5"></i></div>
                    <div class="icon-option" onclick="selectCertIcon(this)" data-icon="brain-circuit"><i data-lucide="brain-circuit" class="w-5 h-5"></i></div>
                    <div class="icon-option" onclick="selectCertIcon(this)" data-icon="bar-chart-2"><i data-lucide="bar-chart-2" class="w-5 h-5"></i></div>
                    <div class="icon-option" onclick="selectCertIcon(this)" data-icon="cpu"><i data-lucide="cpu" class="w-5 h-5"></i></div>
                    <div class="icon-option" onclick="selectCertIcon(this)" data-icon="globe"><i data-lucide="globe" class="w-5 h-5"></i></div>
                </div>
            </div>
            <div class="mt-6 col-span-2 flex justify-end gap-3 border-t border-white/5 pt-4">
                <button type="button" onclick="closeCertificationModal()" class="text-zinc-400 hover:text-white text-sm px-4">Cancel</button>
                <button type="submit" class="bg-gold-400 text-black font-bold px-6 py-2 rounded-lg text-sm">Save Changes</button>
            </div>
        </form>
    </div>
</div>
    </div>
</div>