<!-- 1. HERO SECTION EDITOR -->
<div id="hero-section" class="space-y-8 max-w-4xl mx-auto animate-fade-in">
    <!-- Typography -->
    <div class="admin-card">
        <h3 class="text-lg font-bold text-white mb-6 border-b border-white/5 pb-4">Main Typography</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="col-span-2">
                <label class="admin-label">Greeting Text</label>
                <input type="text" class="admin-input" data-field="greeting" value="{{ \App\Models\Hero::first()?->greeting ?? 'Hi, I\'m' }}">
            </div>
            <div class="col-span-2 md:col-span-1">
                <label class="admin-label">First Name</label>
                <input type="text" class="admin-input" data-field="first_name" value="{{ \App\Models\Hero::first()?->first_name ?? 'Pawan' }}">
            </div>
            <div class="col-span-2 md:col-span-1">
                <label class="admin-label">Last Name</label>
                <input type="text" class="admin-input" data-field="last_name" value="{{ \App\Models\Hero::first()?->last_name ?? 'Kshetri' }}">
            </div>
            <div class="col-span-2">
                <label class="admin-label">Primary Role (White Text)</label>
                <input type="text" class="admin-input" data-field="title" value="{{ \App\Models\Hero::first()?->title ?? 'Data Analyst | Full Stack Developer' }}">
            </div>
            <div class="col-span-2">
                <label class="admin-label">Secondary Role (Gold Text)</label>
                <input type="text" class="admin-input" data-field="subtitle" value="{{ \App\Models\Hero::first()?->subtitle ?? 'Data.' }}">
            </div>
            <div class="col-span-2">
                <label class="admin-label">Description</label>
                <textarea class="admin-input h-24 resize-none" data-field="description">{{ \App\Models\Hero::first()?->description ?? 'Turning complex datasets into actionable insights, and building robust, scalable web applications from the ground up.' }}</textarea>
            </div>
        </div>
    </div>

    <!-- Social Links -->
    <div class="admin-card">
        <h3 class="text-lg font-bold text-white mb-6 border-b border-white/5 pb-4">Social Icons Links</h3>
        <div class="space-y-4">
            <div>
                <label class="admin-label flex items-center gap-2"><i data-lucide="github" class="w-4 h-4"></i> GitHub URL</label>
                <input type="text" class="admin-input" data-field="github_url" value="{{ \App\Models\Hero::first()?->github_url ?? 'https://github.com/pawankshetri' }}">
            </div>
            <div>
                <label class="admin-label flex items-center gap-2"><i data-lucide="linkedin" class="w-4 h-4"></i> LinkedIn URL</label>
                <input type="text" class="admin-input" data-field="linkedin_url" value="{{ \App\Models\Hero::first()?->linkedin_url ?? 'https://linkedin.com/in/pawan' }}">
            </div>
            <div>
                <label class="admin-label flex items-center gap-2"><i data-lucide="mail" class="w-4 h-4"></i> Email Address</label>
                <input type="email" class="admin-input" data-field="email" value="{{ \App\Models\Hero::first()?->email ?? 'contact@pawan.dev' }}">
            </div>
        </div>
    </div>

    <!-- Animation Labels -->
    <div class="admin-card">
        <h3 class="text-lg font-bold text-white mb-6 border-b border-white/5 pb-4">Hero Animation Labels</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="admin-label text-yellow-400">Top Right (Yellow)</label>
                <input type="text" id="animation_label_1" class="admin-input" value="{{ \App\Models\Hero::first()?->animation_label_1 ?? 'Data Analysis' }}">
            </div>
            <div>
                <label class="admin-label text-green-400">Bottom Left (Green)</label>
                <input type="text" id="animation_label_2" class="admin-input" value="{{ \App\Models\Hero::first()?->animation_label_2 ?? 'Frontend Dev' }}">
            </div>
            <div>
                <label class="admin-label text-blue-400">Bottom Right (Blue)</label>
                <input type="text" id="animation_label_3" class="admin-input" value="{{ \App\Models\Hero::first()?->animation_label_3 ?? 'API Development' }}">
            </div>
            <div>
                <label class="admin-label text-red-400">Top Left (Red)</label>
                <input type="text" id="animation_label_4" class="admin-input" value="{{ \App\Models\Hero::first()?->animation_label_4 ?? 'Database Design' }}">
            </div>
        </div>
    </div>
</div>