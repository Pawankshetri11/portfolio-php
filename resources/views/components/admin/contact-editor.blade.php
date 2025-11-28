<!-- 9. CONTACT EDITOR (Hidden) -->
<div id="contact-section" class="space-y-8 max-w-4xl mx-auto hidden">
    <div class="admin-card">
        <h3 class="text-lg font-bold text-white mb-6 border-b border-white/5 pb-4">Contact Information</h3>
        @php
            $contact = \App\Models\Contact::first();
        @endphp
        <form action="{{ route('admin.contacts.update') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="admin-label">Contact Email (Form Destination)</label>
                    <input type="email" name="contact_email" class="admin-input" value="{{ $contact?->contact_email ?? 'pawankshetri11@gmail.com' }}" required>
                </div>
                <div>
                    <label class="admin-label">Display Email</label>
                    <input type="email" name="display_email" class="admin-input" value="{{ $contact?->display_email ?? 'pawankshetri11@gmail.com' }}" required>
                </div>
                <div>
                    <label class="admin-label">Heading Text</label>
                    <input type="text" name="heading_text" class="admin-input" value="{{ $contact?->heading_text ?? 'Get In Touch' }}" required>
                </div>
                <div>
                    <label class="admin-label">Subtext</label>
                    <textarea name="subtext" class="admin-input h-24 resize-none" required>{{ $contact?->subtext ?? 'Let\'s connect! Whether it\'s about a project, opportunity, or just to say hi.' }}</textarea>
                </div>
                <div>
                    <label class="admin-label">LinkedIn URL</label>
                    <input type="url" name="linkedin_url" class="admin-input" value="{{ $contact?->linkedin_url ?? 'https://linkedin.com/in/pawankshetri' }}">
                </div>
                <div>
                    <label class="admin-label">GitHub URL</label>
                    <input type="url" name="github_url" class="admin-input" value="{{ $contact?->github_url ?? 'https://github.com/pawankshetri11' }}">
                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-[#ffd700] text-black font-bold rounded-lg hover:bg-white transition-all">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>