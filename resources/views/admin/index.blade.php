<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Portfolio Admin Panel</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                        display: ['Space Grotesk', 'sans-serif']
                    },
                    colors: {
                        royal: {
                            950: '#020202',
                            900: '#050505',
                            800: '#0a0a0a',
                            card: '#121212',
                        },
                        gold: {
                            400: '#ffd700',
                            500: '#ffed4e',
                            600: '#d4b200',
                        },
                    }
                }
            }
        }
    </script>

    <style>
        body {
            background-color: #020202;
            color: #e4e4e7;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #020202; }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #ffd700; }

        /* Form Inputs */
        .admin-input, .admin-select {
            background-color: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            width: 100%;
            transition: all 0.3s ease;
        }
        .admin-input:focus, .admin-select:focus {
            border-color: #ffd700;
            outline: none;
            box-shadow: 0 0 0 2px rgba(255, 215, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.05);
        }
        /* File Input styling */
        .file-upload-box {
            border: 2px dashed rgba(255, 255, 255, 0.1);
            border-radius: 0.5rem;
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }
        .file-upload-box:hover {
            border-color: #ffd700;
            background-color: rgba(255, 215, 0, 0.05);
        }

        .admin-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #a1a1aa;
            margin-bottom: 0.5rem;
        }

        /* Sidebar Link Active State */
        .sidebar-link.active {
            background: linear-gradient(90deg, rgba(255, 215, 0, 0.1), transparent);
            border-left: 3px solid #ffd700;
            color: #ffd700;
        }
        .sidebar-link i { transition: color 0.3s; }
        .sidebar-link.active i { color: #ffd700; }

        /* Glass Card */
        .admin-card {
            background: #0a0a0a;
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            padding: 1.5rem;
        }

        /* Table Styles */
        .admin-table th {
            text-align: left;
            padding: 1rem;
            color: #ffd700;
            font-weight: 600;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .admin-table td {
            padding: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            color: #d4d4d8;
        }
        .admin-table tr:hover td {
            background-color: rgba(255, 255, 255, 0.02);
        }

        /* Modal Animation */
        .modal-enter {
            opacity: 0;
            transform: scale(0.95);
        }
        .modal-enter-active {
            opacity: 1;
            transform: scale(1);
            transition: opacity 300ms, transform 300ms;
        }
        .modal-exit {
            opacity: 1;
            transform: scale(1);
        }
        .modal-exit-active {
            opacity: 0;
            transform: scale(0.95);
            transition: opacity 300ms, transform 300ms;
        }

        /* Dropdown Options Dark Background Fix */
        .admin-select option {
            background-color: #121212; /* Dark background for options */
            color: white;
            padding: 10px;
        }

        /* Icon Picker Styles */
        .icon-option {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            color: #a1a1aa;
        }
        .icon-option:hover {
            background: rgba(255, 215, 0, 0.1);
            color: #ffd700;
        }
        .icon-option.selected {
            background: #ffd700;
            color: black;
            border-color: #ffd700;
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.3);
        }
    </style>
</head>
<body class="flex h-screen overflow-hidden font-sans">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-royal-900 border-r border-white/5 flex flex-col flex-shrink-0">
        <!-- Logo Area -->
        <div class="h-16 flex items-center px-6 border-b border-white/5">
            <div class="flex items-center gap-2 text-white">
                <div class="w-8 h-8 bg-gold-400 rounded flex items-center justify-center text-black font-bold font-display">A</div>
                <span class="font-bold font-display text-lg tracking-wide">Admin<span class="text-gold-400">Panel</span></span>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto py-4 space-y-1">
            <p class="px-6 text-xs font-bold text-zinc-500 uppercase tracking-wider mb-2 mt-2">Home Page</p>
            <a href="#hero" onclick="showSection('hero')" class="sidebar-link active flex items-center gap-3 px-6 py-3 text-sm text-zinc-400 hover:text-white hover:bg-white/5 transition-all">
                <i data-lucide="layout-template" class="w-4 h-4"></i> Hero & Animation
            </a>
            <a href="#metrics" onclick="showSection('metrics')" class="sidebar-link flex items-center gap-3 px-6 py-3 text-sm text-zinc-400 hover:text-white hover:bg-white/5 transition-all">
                <i data-lucide="bar-chart-2" class="w-4 h-4"></i> Key Metrics
            </a>

            <p class="px-6 text-xs font-bold text-zinc-500 uppercase tracking-wider mb-2 mt-6">Profile</p>
            <a href="#experience" onclick="showSection('experience')" class="sidebar-link flex items-center gap-3 px-6 py-3 text-sm text-zinc-400 hover:text-white hover:bg-white/5 transition-all">
                <i data-lucide="briefcase" class="w-4 h-4"></i> Experience
            </a>
            <a href="#education" onclick="showSection('education')" class="sidebar-link flex items-center gap-3 px-6 py-3 text-sm text-zinc-400 hover:text-white hover:bg-white/5 transition-all">
                <i data-lucide="graduation-cap" class="w-4 h-4"></i> Education
            </a>
            <a href="#certifications" onclick="showSection('certifications')" class="sidebar-link flex items-center gap-3 px-6 py-3 text-sm text-zinc-400 hover:text-white hover:bg-white/5 transition-all">
                <i data-lucide="award" class="w-4 h-4"></i> Certifications
            </a>
            <a href="#skills" onclick="showSection('skills')" class="sidebar-link flex items-center gap-3 px-6 py-3 text-sm text-zinc-400 hover:text-white hover:bg-white/5 transition-all">
                <i data-lucide="zap" class="w-4 h-4"></i> Skills
            </a>
            <a href="#skill-categories" onclick="showSection('skill-categories')" class="sidebar-link flex items-center gap-3 px-6 py-3 text-sm text-zinc-400 hover:text-white hover:bg-white/5 transition-all">
                <i data-lucide="layers" class="w-4 h-4"></i> Skill Categories
            </a>

            <p class="px-6 text-xs font-bold text-zinc-500 uppercase tracking-wider mb-2 mt-6">Work</p>
            <a href="#projects" onclick="showSection('projects')" class="sidebar-link flex items-center gap-3 px-6 py-3 text-sm text-zinc-400 hover:text-white hover:bg-white/5 transition-all">
                <i data-lucide="folder-git-2" class="w-4 h-4"></i> Projects List
            </a>
            <a href="#categories" onclick="showSection('categories')" class="sidebar-link flex items-center gap-3 px-6 py-3 text-sm text-zinc-400 hover:text-white hover:bg-white/5 transition-all">
                <i data-lucide="tags" class="w-4 h-4"></i> Project Categories
            </a>

            <p class="px-6 text-xs font-bold text-zinc-500 uppercase tracking-wider mb-2 mt-6">General</p>
            <a href="#contact" onclick="showSection('contact')" class="sidebar-link flex items-center gap-3 px-6 py-3 text-sm text-zinc-400 hover:text-white hover:bg-white/5 transition-all">
                <i data-lucide="mail" class="w-4 h-4"></i> Contact Info
            </a>
            <a href="#messages" onclick="showSection('messages')" class="sidebar-link flex items-center gap-3 px-6 py-3 text-sm text-zinc-400 hover:text-white hover:bg-white/5 transition-all">
                <i data-lucide="inbox" class="w-4 h-4"></i> Messages @if($messageCount > 0) <span class="ml-auto text-xs bg-gold-400 text-black font-bold px-1.5 rounded">{{ $messageCount }}</span> @endif
            </a>
        </nav>

        <!-- User Profile -->
        <div class="p-4 border-t border-white/5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-zinc-800 flex items-center justify-center border border-white/10">
                    <i data-lucide="user" class="w-5 h-5 text-zinc-400"></i>
                </div>
                <div>
                    <p class="text-sm font-bold text-white">{{ auth()->user()->name ?? 'Pawan Kshetri' }}</p>
                    <p class="text-xs text-zinc-500">Administrator</p>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="inline ml-auto">
                    @csrf
                    <button class="text-zinc-500 hover:text-red-400">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden bg-royal-950">

        <!-- Top Header -->
        <header class="h-16 bg-royal-950 border-b border-white/5 flex items-center justify-between px-8 flex-shrink-0">
            <h2 class="text-xl font-bold text-white font-display" id="pageTitle">Hero Section</h2>
            <div class="flex items-center gap-4">
                <a href="{{ url('/') }}" class="flex items-center gap-2 text-sm text-zinc-400 hover:text-white transition-colors">
                    <i data-lucide="external-link" class="w-4 h-4"></i> View Live Site
                </a>
                <button id="saveChanges" class="bg-gold-400 hover:bg-gold-500 text-black font-bold py-2 px-6 rounded-lg text-sm transition-colors shadow-[0_0_15px_rgba(255,215,0,0.2)] hidden">
                    Save Changes
                </button>
            </div>
        </header>

        <!-- Scrollable Content Area -->
        <div class="flex-1 overflow-y-auto p-8">

            <!-- 1. HERO SECTION EDITOR -->
            @include('components.admin.hero-editor')

            <!-- 2. KEY METRICS EDITOR (Hidden) -->
            @include('components.admin.key-metrics-editor')

            <!-- 3. EXPERIENCE SECTION EDITOR (Hidden) -->
            @include('components.admin.experience-editor')

            <!-- 4. EDUCATION EDITOR (Hidden) -->
            @include('components.admin.education-editor')

            <!-- 5. CERTIFICATIONS EDITOR (Hidden) -->
            @include('components.admin.certifications-editor')

            <!-- 6. SKILLS EDITOR (Hidden) -->
            @include('components.admin.skills-editor', ['categories' => $categories])

            <!-- 7. PROJECTS EDITOR (Hidden) -->
            @include('components.admin.projects-editor')

            <!-- 8. PROJECT CATEGORIES EDITOR (Hidden) -->
            <div id="categories-section" class="space-y-8 max-w-4xl mx-auto hidden">
                <div class="admin-card">
                    <h3 class="text-lg font-bold text-white mb-6 border-b border-white/5 pb-4">Manage Project Categories</h3>
                    <div id="project-categories-list" class="space-y-3">
                        @foreach(\App\Models\ProjectCategory::orderBy('name')->get() as $category)
                        <div class="flex items-center gap-3 bg-white/5 p-3 rounded-lg project-category-item" data-id="{{ $category->id }}">
                            <span class="flex-1 text-white">{{ $category->name }}</span>
                            <div class="w-6 h-6 rounded-full" style="background-color: {{ $category->color ?: '#3B82F6' }}"></div>
                            <button class="text-blue-400 hover:text-blue-300 edit-project-category" data-id="{{ $category->id }}" title="Edit Category"><i data-lucide="edit" class="w-4 h-4"></i></button>
                            <button class="text-red-400 hover:text-red-300 delete-project-category" data-id="{{ $category->id }}" title="Delete Category"><i data-lucide="x" class="w-4 h-4"></i></button>
                        </div>
                        @endforeach
                        <!-- Add New -->
                        <button onclick="openProjectCategoryModal()" class="w-full border border-dashed border-zinc-700 text-zinc-500 hover:text-white hover:border-zinc-500 py-3 rounded-lg text-sm flex items-center justify-center gap-2 transition-all">
                            <i data-lucide="plus" class="w-4 h-4"></i> Add New Category
                        </button>
                    </div>
                </div>
            </div>

            <!-- 9. CONTACT EDITOR (Hidden) -->
            @include('components.admin.contact-editor', ['contact' => $contact])

            <!-- 10. MESSAGES SECTION (NEW) -->
            @include('components.admin.messages-section')

            <!-- 11. SKILL CATEGORIES EDITOR (NEW) -->
            <div id="skill-categories-section" class="space-y-8 max-w-4xl mx-auto hidden">
                <div class="admin-card">
                    <h3 class="text-lg font-bold text-white mb-6 border-b border-white/5 pb-4">Manage Skill Categories</h3>
                    <div id="categories-list" class="space-y-3">
                        @foreach($categories as $category)
                        <div class="flex items-center gap-3 bg-white/5 p-3 rounded-lg category-item" data-id="{{ $category->id }}">
                            <input type="text" class="bg-transparent border-none text-white flex-1 focus:outline-none category-name" value="{{ $category->name }}">
                            <button class="text-blue-400 hover:text-blue-300 edit-category mr-2" data-id="{{ $category->id }}" title="Edit Category"><i data-lucide="edit" class="w-4 h-4"></i></button>
                            <button class="text-red-400 hover:text-red-300 delete-category" data-id="{{ $category->id }}" title="Delete Category"><i data-lucide="x" class="w-4 h-4"></i></button>
                        </div>
                        @endforeach
                        <!-- Add New -->
                        <button onclick="openSkillCategoryModal()" class="w-full border border-dashed border-zinc-700 text-zinc-500 hover:text-white hover:border-zinc-500 py-3 rounded-lg text-sm flex items-center justify-center gap-2 transition-all">
                            <i data-lucide="plus" class="w-4 h-4"></i> Add New Category
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- MODALS -->
    @include('components.admin.modals.education-modal')
    @include('components.admin.modals.certification-modal')
    @include('components.admin.modals.project-modal')
    @include('components.admin.modals.skill-category-modal')
    @include('components.admin.modals.project-category-modal')

    <!-- MODAL: EDIT EXPERIENCE -->
    <div id="experienceModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm opacity-0 transition-opacity duration-300">
        <div class="admin-card border-gold-400/30 w-full max-w-4xl transform scale-95 transition-transform duration-300 max-h-[90vh] overflow-y-auto" id="modalContent">
            <h4 class="text-lg font-bold text-white mb-4 border-b border-white/5 pb-2 flex items-center gap-2">
                <i data-lucide="briefcase" class="w-5 h-5 text-gold-400"></i> <span id="modalTitle">Add Experience</span>
            </h4>

            <!-- Company Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 border-b border-white/5 pb-6">
                <div>
                    <label class="admin-label">Company Name</label>
                    <input type="text" id="companyInput" class="admin-input" placeholder="e.g., Capital Street FX">
                </div>
                <div>
                    <label class="admin-label">Location</label>
                    <input type="text" id="locationInput" class="admin-input" placeholder="e.g., Remote">
                </div>
                <div class="col-span-2">
                    <label class="admin-label">Company Logo (Initials)</label>
                    <input type="text" id="logoInput" class="admin-input w-20 text-center font-bold uppercase" placeholder="CS" maxlength="2">
                </div>
                <div class="col-span-2">
                    <label class="admin-label">Display Layout</label>
                    <select id="displayTypeInput" class="admin-select">
                        <option value="responsibilities">Responsibilities</option>
                        <option value="description">Description</option>
                    </select>
                </div>
            </div>

            <!-- Roles Section -->
            <div>
                <div class="flex justify-between items-center mb-4">
                    <h5 class="text-gold-400 text-sm font-bold">Roles at this Company</h5>
                    <button onclick="addNewRole()" class="text-gold-400 hover:text-gold-300 text-sm flex items-center gap-1">
                        <i data-lucide="plus" class="w-4 h-4"></i> Add Role
                    </button>
                </div>

                <div id="rolesContainer" class="space-y-4">
                    <!-- Roles will be added here dynamically -->
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3 border-t border-white/5 pt-4">
                <button onclick="closeModal()" class="text-zinc-400 hover:text-white text-sm px-4">Cancel</button>
                <button onclick="saveExperienceData()" class="bg-gold-400 text-black font-bold px-6 py-2 rounded-lg text-sm">Save Changes</button>
            </div>
        </div>
    </div>


    <script>
        // Cache busting - force reload of JavaScript
        console.log('Admin panel JavaScript loaded at:', new Date().toISOString());
        lucide.createIcons();

        // Enhanced Tab Switching Logic
        function showSection(sectionId, updateHistory = true) {
            // List of all possible section IDs
            const sections = ['hero', 'metrics', 'experience', 'education', 'certifications', 'projects', 'categories', 'contact', 'skills', 'skill-categories', 'messages'];

            // Hide all
            sections.forEach(id => {
                const el = document.getElementById(id + '-section');
                if(el) el.classList.add('hidden');
            });

            // Remove active class from all links
            document.querySelectorAll('.sidebar-link').forEach(link => {
                link.classList.remove('active');
            });

            // Show selected
            const target = document.getElementById(sectionId + '-section');
            if(target) {
                target.classList.remove('hidden');
                // Simple fade in
                target.animate([
                    { opacity: 0, transform: 'translateY(10px)' },
                    { opacity: 1, transform: 'translateY(0)' }
                ], { duration: 300, easing: 'ease-out' });
            }

            // Update Title
            const titles = {
                'hero': 'Hero & Animation',
                'metrics': 'Key Metrics',
                'experience': 'Professional Experience',
                'education': 'Education History',
                'certifications': 'Certifications',
                'projects': 'Projects List',
                'categories': 'Project Categories',
                'contact': 'Contact Settings',
                'skills': 'Technical Skills',
                'skill-categories': 'Skill Categories',
                'messages': 'Inbox'
            };
            document.getElementById('pageTitle').innerText = titles[sectionId] || 'Admin Panel';

            // Add active class to clicked link
            const link = event && event.currentTarget ? event.currentTarget : document.querySelector(`a[href="#${sectionId}"]`);
            if (link && link.classList) {
                link.classList.add('active');
            }

            // Update URL hash without page reload
            if (updateHistory) {
                history.pushState({section: sectionId}, '', '#' + sectionId);
            }

            // Show/hide main save button based on section
            const saveButton = document.getElementById('saveChanges');
            if (sectionId === 'hero') {
                saveButton.classList.remove('hidden');
            } else {
                saveButton.classList.add('hidden');
            }

            // Add section-specific save buttons
            if (sectionId === 'metrics') {
                const metricsSection = document.getElementById('metrics-section');
                if (metricsSection) {
                    const adminCard = metricsSection.querySelector('.admin-card');
                    if (adminCard) {
                        // Remove any existing save button first
                        const existingBtn = adminCard.querySelector('#save-key-metrics-btn');
                        if (existingBtn) {
                            existingBtn.remove();
                        }

                        // Add new save button
                        const saveBtn = document.createElement('button');
                        saveBtn.id = 'save-key-metrics-btn';
                        saveBtn.textContent = 'Save Changes';
                        saveBtn.className = 'bg-gold-400 hover:bg-gold-500 text-black font-bold py-2 px-6 rounded-lg text-sm transition-colors shadow-[0_0_15px_rgba(255,215,0,0.2)] mt-4';
                        saveBtn.onclick = saveKeyMetrics;
                        adminCard.appendChild(saveBtn);
                    }
                }
            }
        }

        // Handle browser back/forward navigation
        window.addEventListener('popstate', function(event) {
            if (event.state && event.state.section) {
                showSection(event.state.section, false);
            }
        });



        function showNotification(message, type) {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg text-white z-50 ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            }`;
            notification.textContent = message;

            document.body.appendChild(notification);

            // Remove after 3 seconds
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // Experience Modal Logic
        const modal = document.getElementById('experienceModal');
        const modalContent = document.getElementById('modalContent');
        const modalTitle = document.getElementById('modalTitle');
        let roleCounter = 0;

        function openExperienceModal(id = null) {
            modal.classList.remove('hidden');
            // Animation frame to allow display:block to apply
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modalContent.classList.remove('scale-95');
                modalContent.classList.add('scale-100');
            }, 10);

            if (id) {
                // Edit mode - fetch data and populate
                editExperience(id);
            } else {
                // Add mode
                modalTitle.innerText = 'Add New Experience';
                // Clear form
                document.getElementById('companyInput').value = '';
                document.getElementById('locationInput').value = '';
                document.getElementById('logoInput').value = '';
                document.getElementById('displayTypeInput').value = 'responsibilities';
                document.getElementById('rolesContainer').innerHTML = '';
                roleCounter = 0;
                addNewRole(); // Add first role
                currentEditId = null;
                currentEditType = null;
            }
        }

        function addNewRole(roleData = null) {
            roleCounter++;
            const roleId = `role-${roleCounter}`;
            // Check if there are already 2 or more roles, default to description
            const existingRolesCount = document.querySelectorAll('.role-item').length;
            const defaultDisplayType = existingRolesCount >= 2 ? 'description' : 'responsibilities';
            const roleHtml = `
                <div class="role-item bg-white/5 p-4 rounded-lg border border-white/10" data-role-id="${roleId}">
                    <div class="flex justify-between items-center mb-3">
                        <h6 class="text-white font-medium">Role ${roleCounter}</h6>
                        <button onclick="removeRole('${roleId}')" class="text-red-400 hover:text-red-300">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="col-span-2 md:col-span-1">
                            <label class="admin-label">Job Title</label>
                            <input type="text" class="admin-input role-title" placeholder="e.g., Senior Developer">
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <label class="admin-label">Employment Type</label>
                            <select class="admin-select text-zinc-300 role-type">
                                <option>Full-time</option>
                                <option>Part-time</option>
                                <option>Contract</option>
                                <option>Freelance</option>
                                <option>Self-employed</option>
                            </select>
                        </div>
                        <div>
                            <label class="admin-label">Start Date</label>
                            <input type="date" class="admin-input role-start-date">
                        </div>
                        <div>
                            <label class="admin-label">End Date</label>
                            <div class="flex gap-2">
                                <input type="date" class="admin-input role-end-date">
                                <div class="flex items-center gap-2 min-w-[80px]">
                                    <input type="checkbox" class="w-4 h-4 accent-gold-400 role-present" onchange="toggleRoleEndDate(this)">
                                    <label class="text-sm text-zinc-400">Present</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="admin-label">Content Type</label>
                            <select class="admin-select role-display-type">
                                <option value="responsibilities">Responsibilities (Bullets)</option>
                                <option value="description">Description (Paragraph)</option>
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label class="admin-label">Description</label>
                            <textarea class="admin-input h-24 resize-none role-description" placeholder="Describe your responsibilities..."></textarea>
                        </div>
                        <div class="col-span-2">
                            <label class="admin-label">Skills Developed (Comma separated)</label>
                            <input type="text" class="admin-input role-skills" placeholder="React, Node.js, Leadership">
                        </div>
                    </div>
                </div>
            `;
            document.getElementById('rolesContainer').insertAdjacentHTML('beforeend', roleHtml);

            if (roleData) {
                const roleElement = document.querySelector(`[data-role-id="${roleId}"]`);
                if(roleElement) {
                    roleElement.querySelector('.role-title').value = roleData.title || '';
                    roleElement.querySelector('.role-type').value = roleData.type || 'Full-time';
                    roleElement.querySelector('.role-start-date').value = roleData.start_date || '';
                    roleElement.querySelector('.role-end-date').value = roleData.end_date || '';
                    roleElement.querySelector('.role-present').checked = roleData.present || false;
                    roleElement.querySelector('.role-display-type').value = roleData.display_type || defaultDisplayType;
                    roleElement.querySelector('.role-description').value = roleData.description || '';
                    roleElement.querySelector('.role-skills').value = roleData.skills ? roleData.skills.join(', ') : '';

                    if (roleData.present) {
                        toggleRoleEndDate(roleElement.querySelector('.role-present'));
                    }
                }
            }

            lucide.createIcons(); // Refresh icons
        }

        function removeRole(roleId) {
            const roleElement = document.querySelector(`[data-role-id="${roleId}"]`);
            if (roleElement) {
                roleElement.remove();
            }
        }

        function toggleRoleEndDate(checkbox) {
            const input = checkbox.closest('.flex').querySelector('input[type="date"]');
            if (input) {
                if (checkbox.checked) {
                    input.disabled = true;
                    input.value = '';
                } else {
                    input.disabled = false;
                }
            }
        }

        function addRoleToExperience(experienceId) {
            // Open modal in edit mode for the specific experience
            openExperienceModal(experienceId);
        }

        function editRole(experienceId, roleIndex) {
            // For now, just open the modal in edit mode - user can edit roles there
            openExperienceModal(experienceId);
        }

        function deleteRole(experienceId, roleIndex) {
            if (!confirm('Are you sure you want to delete this role?')) return;

            // This would require a more complex implementation
            // For now, just show a message
            showNotification('Role deletion not implemented yet. Please edit the experience to modify roles.', 'error');
        }

        function closeModal() {
            modal.classList.add('opacity-0');
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        async function editExperience(id) {
            console.log('editExperience called with id:', id);
            try {
                const response = await fetch(`/admin/experiences/${id}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                console.log('Response status:', response.status);
                if (response.ok) {
                    const experience = await response.json();
                    console.log('Experience data:', experience);
                    currentEditId = id;
                    currentEditType = 'experience';

                    // Populate company info
                    document.getElementById('companyInput').value = experience.company || '';
                    document.getElementById('locationInput').value = experience.location || '';
                    document.getElementById('logoInput').value = experience.logo || '';
                    document.getElementById('displayTypeInput').value = experience.display_type || 'responsibilities';

                    // Clear existing roles
                    document.getElementById('rolesContainer').innerHTML = '';
                    roleCounter = 0;

                    // If experience has roles, populate them
                    if (experience.roles && experience.roles.length > 0) {
                        console.log('Populating roles:', experience.roles);
                        experience.roles.forEach(role => {
                            addNewRole({
                                title: role.title || '',
                                type: role.type || 'Full-time',
                                start_date: role.start_date || '',
                                end_date: role.end_date || '',
                                present: !role.end_date,
                                description: role.description || '',
                                display_type: role.display_type ?? 'responsibilities',
                                skills: role.skills || []
                            });
                        });
                    } else {
                        // Single role - create from main experience data
                        console.log('Creating single role from legacy data');
                        addNewRole({
                            title: experience.position || '',
                            type: 'Full-time',
                            start_date: experience.start_date ? experience.start_date.split('T')[0] : '',
                            end_date: experience.end_date ? experience.end_date.split('T')[0] : '',
                            present: !experience.end_date,
                            description: experience.description || experience.responsibilities || '',
                            skills: experience.technologies ? experience.technologies.split(', ') : []
                        });
                    }

                    modalTitle.innerText = 'Edit Experience';
                    console.log('Modal title set to Edit Experience');
                } else {
                    console.error('Failed to fetch experience data');
                    showNotification('Error loading experience data', 'error');
                }
            } catch (error) {
                console.error('Error in editExperience:', error);
                showNotification('Error loading experience data', 'error');
            }
        }

        async function deleteExperience(id) {
            if (!confirm('Are you sure you want to delete this experience?')) return;

            try {
                const response = await fetch(`/admin/experiences/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    showNotification('Experience deleted successfully!', 'success');
                    location.reload(); // Refresh to show updated data
                } else {
                    showNotification('Failed to delete experience', 'error');
                }
            } catch (error) {
                showNotification('Error deleting experience', 'error');
            }
        }

        function toggleEndDate(checkbox) {
            const input = document.getElementById('endDateInput');
            if (checkbox.checked) {
                input.disabled = true;
                input.value = '';
            } else {
                input.disabled = false;
            }
        }

        // Bullet Point Logic for Experience Description
        const textarea = document.getElementById('desc-input');
        if (textarea) {
            textarea.addEventListener('keyup', function(e) {
                if (e.key === 'Enter') {
                    const cursorPosition = this.selectionStart;
                    const textBefore = this.value.substring(0, cursorPosition);
                    const textAfter = this.value.substring(cursorPosition);
                    this.value = textBefore + "• " + textAfter;
                    this.selectionStart = this.selectionEnd = cursorPosition + 2;
                }
            });
        }

        // Education Modal Logic
        const educationModal = document.getElementById('educationModal');
        const educationModalContent = document.getElementById('educationModalContent');
        const educationModalTitle = document.getElementById('educationModalTitle');

        function openEducationModal(id = null, url = '') {
            educationForm.reset();
            if (id) {
                // Edit mode
                educationModalTitle.innerText = 'Edit Education';
                educationForm.action = `/admin/educations/${id}`;
                educationMethod.value = 'PATCH';
                editEducation(id);
            } else {
                // Add mode
                educationModalTitle.innerText = 'Add New Education';
                educationForm.action = url;
                educationMethod.value = 'POST';
                 educationModal.classList.remove('hidden');
                setTimeout(() => {
                    educationModal.classList.remove('opacity-0');
                    educationModalContent.classList.remove('scale-95');
                    educationModalContent.classList.add('scale-100');
                }, 10);
            }
        }

        function closeEducationModal() {
            educationModal.classList.add('opacity-0');
            educationModalContent.classList.remove('scale-100');
            educationModalContent.classList.add('scale-95');
            setTimeout(() => {
                educationModal.classList.add('hidden');
            }, 300);
        }

                const educationForm = document.getElementById('educationForm');
        const educationMethod = document.getElementById('educationMethod');

       function toggleEducationEndDate(checkbox) {
            const input = document.getElementById('educationEndDateInput');
            if (input) {
                input.disabled = checkbox.checked;
                if (checkbox.checked) {
                    input.value = '';
                }
            }
        }

        async function saveEducation(event) {
            event.preventDefault();
            const formData = new FormData(educationForm);
            const isEdit = educationMethod.value === 'PATCH';

            try {
                const response = await fetch(educationForm.action, {
                    method: 'POST', // Always POST, as we use _method for PATCH
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                if (response.ok) {
                    showNotification(`Education ${isEdit ? 'updated' : 'added'} successfully!`, 'success');
                    closeEducationModal();
                    location.reload(); // Refresh to show new data
                } else {
                    let errorData = { message: 'An unknown error occurred.' };
                    try {
                        errorData = await response.json();
                    } catch (e) {
                        console.error('Could not parse error response as JSON:', await response.text());
                    }
                    showNotification(errorData.message || `Failed to ${isEdit ? 'update' : 'add'} education`, 'error');
                }
            } catch (error) {
                showNotification(`Error ${isEdit ? 'updating' : 'adding'} education`, 'error');
            }
        }

        // Certification Modal Logic
        const certificationModal = document.getElementById('certificationModal');
        const certificationModalContent = document.getElementById('certificationModalContent');
        const certificationModalTitle = document.getElementById('certificationModalTitle');

        function openCertificationModal(isEdit = false) {
            certificationModal.classList.remove('hidden');
            setTimeout(() => {
                certificationModal.classList.remove('opacity-0');
                certificationModalContent.classList.remove('scale-95');
                certificationModalContent.classList.add('scale-100');
            }, 10);

            certificationModalTitle.innerText = isEdit ? 'Edit Certification' : 'Add Certification';

            // Set default view type to link
            const viewTypeSelector = document.getElementById('certViewTypeSelector');
            if (viewTypeSelector) {
                viewTypeSelector.value = 'link';
            }
            toggleCertViewType();
        }

        function closeCertificationModal() {
            certificationModal.classList.add('opacity-0');
            certificationModalContent.classList.remove('scale-100');
            certificationModalContent.classList.add('scale-95');
            setTimeout(() => {
                certificationModal.classList.add('hidden');
            }, 300);
        }

        // Toggle View Type Logic
        function toggleCertViewType() {
            // Only link option available, so always show link input
            const linkGroup = document.getElementById('certLinkInputGroup');
            if (linkGroup) {
                linkGroup.classList.remove('hidden');
            }
        }

        // Icon Selection Logic
        function selectCertIcon(element) {
            // Remove selected class from all
            document.querySelectorAll('#certIconPicker .icon-option').forEach(el => el.classList.remove('selected'));
            // Add to clicked
            element.classList.add('selected');
        }

        // Project Modal Logic
        const projectModal = document.getElementById('projectModal');
        const projectModalContent = document.getElementById('projectModalContent');
        const projectModalTitle = document.getElementById('projectModalTitle');

        function openProjectModal(isEdit = false) {
            projectModal.classList.remove('hidden');
            setTimeout(() => {
                projectModal.classList.remove('opacity-0');
                projectModalContent.classList.remove('scale-95');
                projectModalContent.classList.add('scale-100');
            }, 10);

            projectModalTitle.innerText = isEdit ? 'Edit Project' : 'Add New Project';

            // Clear form for add mode
            if (!isEdit) {
                document.getElementById('projectTitle').value = '';
                document.getElementById('projectCategory').value = '';
                document.getElementById('projectDescription').value = '';
                document.getElementById('projectTechnologies').value = '';
                document.getElementById('projectGithubUrl').value = '';
                document.getElementById('projectLiveUrl').value = '';
                currentEditId = null;
                currentEditType = null;
            }

            // Load categories for the dropdown
            const selectedCategoryId = isEdit ? (currentEditType === 'project' ? currentEditId : null) : null;
            // For edit, we need to get the category_id from the project data, but since we set it earlier, perhaps pass it differently
            // Actually, since we set the value before, but options load async, better to pass the category_id
            // Wait, in editProject, we have project.category_id
            // So let's modify to pass the selectedId to openProjectModal

            // For now, let's load and then set the value after a delay, or modify the function
            loadProjectCategoriesForDropdown();
            // For edit mode, set the category after a short delay to allow options to load
            if (isEdit && currentEditType === 'project') {
                setTimeout(() => {
                    // The category should be set from the project data, but since we cleared it, we need to refetch or store it
                    // Actually, in editProject, we set document.getElementById('projectCategory').value = project.category_id || '';
                    // But since options are loaded async, it may not work
                    // Better to modify editProject to call loadProjectCategoriesForDropdown with selectedId
                }, 100);
            }

            // Attach save button event listener
            const saveButton = projectModal.querySelector('button.bg-gold-400');
            if (saveButton) {
                // Remove any existing listeners
                saveButton.onclick = null;
                saveButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Save button clicked');
                    // Disable button to prevent double clicks
                    saveButton.disabled = true;
                    saveButton.textContent = 'Saving...';
                    const formData = new FormData();
                    formData.append('title', document.getElementById('projectTitle').value);
                    formData.append('category_id', document.getElementById('projectCategory').value);
                    formData.append('content', document.getElementById('projectDescription').value);
                    formData.append('technologies', document.getElementById('projectTechnologies').value);
                    formData.append('github_url', document.getElementById('projectGithubUrl').value);
                    formData.append('live_url', document.getElementById('projectLiveUrl').value);
                    const isEditMode = currentEditType === 'project';
                    console.log('isEditMode:', isEditMode, 'currentEditId:', currentEditId);
                    saveProject(formData, isEditMode).finally(() => {
                        // Re-enable button
                        saveButton.disabled = false;
                        saveButton.textContent = 'Save Changes';
                        currentEditId = null;
                        currentEditType = null;
                    });
                });
            }
        }

        function closeProjectModal() {
            projectModal.classList.add('opacity-0');
            projectModalContent.classList.remove('scale-100');
            projectModalContent.classList.add('scale-95');
            setTimeout(() => {
                projectModal.classList.add('hidden');
            }, 300);
        }

        // Project Category Modal Logic
        const projectCategoryModal = document.getElementById('projectCategoryModal');
        const projectCategoryModalContent = document.getElementById('projectCategoryModalContent');
        const projectCategoryModalTitle = document.getElementById('projectCategoryModalTitle');
        const projectCategoryForm = document.getElementById('projectCategoryForm');
        const projectCategoryMethod = document.getElementById('projectCategoryMethod');

        function openProjectCategoryModal(isEdit = false) {
            projectCategoryModal.classList.remove('hidden');
            setTimeout(() => {
                projectCategoryModal.classList.remove('opacity-0');
                projectCategoryModalContent.classList.remove('scale-95');
                projectCategoryModalContent.classList.add('scale-100');
            }, 10);

            if (!isEdit) {
                projectCategoryModalTitle.innerText = 'Add Project Category';
                projectCategoryForm.reset();
                projectCategoryMethod.value = 'POST';
                window.currentEditProjectCategoryId = null;
            }
        }

        function closeProjectCategoryModal() {
            projectCategoryModal.classList.add('opacity-0');
            projectCategoryModalContent.classList.remove('scale-100');
            projectCategoryModalContent.classList.add('scale-95');
            setTimeout(() => {
                projectCategoryModal.classList.add('hidden');
            }, 300);
        }

        // Global variables for edit mode
        let currentEditId = null;
        let currentEditType = null;

        // CRUD Operations for Admin Panel
        async function saveHeroData() {
            console.log('=== saveHeroData function STARTED ===');
            console.log('Current timestamp:', new Date().toISOString());

            // Get hero section
            const heroSection = document.getElementById('hero-section');
            if (!heroSection) {
                console.error('Hero section not found');
                showNotification('Hero section not found', 'error');
                return;
            }

            console.log('Hero section found');

            // Get inputs by data attributes
            const greetingInput = heroSection.querySelector('input[data-field="greeting"]');
            const firstNameInput = heroSection.querySelector('input[data-field="first_name"]');
            const lastNameInput = heroSection.querySelector('input[data-field="last_name"]');
            const titleInput = heroSection.querySelector('input[data-field="title"]');
            const subtitleInput = heroSection.querySelector('input[data-field="subtitle"]');
            const githubInput = heroSection.querySelector('input[data-field="github_url"]');
            const linkedinInput = heroSection.querySelector('input[data-field="linkedin_url"]');
            const emailInput = heroSection.querySelector('input[data-field="email"]');
            const textarea = heroSection.querySelector('textarea[data-field="description"]');

            console.log('Found inputs:', {
                greeting: greetingInput?.value,
                firstName: firstNameInput?.value,
                lastName: lastNameInput?.value,
                title: titleInput?.value,
                subtitle: subtitleInput?.value,
                github: githubInput?.value,
                linkedin: linkedinInput?.value,
                email: emailInput?.value,
                description: textarea?.value
            });

            // Create data object
            const data = {};

            // Add form data
            if (greetingInput) data.greeting = greetingInput.value.trim();
            if (firstNameInput) data.first_name = firstNameInput.value.trim();
            if (lastNameInput) data.last_name = lastNameInput.value.trim();
            if (titleInput) data.title = titleInput.value.trim();
            if (subtitleInput) data.subtitle = subtitleInput.value.trim();
            if (githubInput) data.github_url = githubInput.value.trim();
            if (linkedinInput) data.linkedin_url = linkedinInput.value.trim();
            if (emailInput) data.email = emailInput.value.trim();
            if (textarea) data.description = textarea.value.trim();

            // Add animation labels
            const anim1 = document.getElementById('animation_label_1');
            const anim2 = document.getElementById('animation_label_2');
            const anim3 = document.getElementById('animation_label_3');
            const anim4 = document.getElementById('animation_label_4');

            if (anim1) data.animation_label_1 = anim1.value.trim();
            if (anim2) data.animation_label_2 = anim2.value.trim();
            if (anim3) data.animation_label_3 = anim3.value.trim();
            if (anim4) data.animation_label_4 = anim4.value.trim();

            // Log data for debugging
            console.log('Sending data:', data);

            console.log('Sending request to /admin/heros/1');

            try {
                const response = await fetch('/admin/heros/1', {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                console.log('Response status:', response.status);
                console.log('Response ok:', response.ok);

                if (response.ok) {
                    console.log('Success: Hero section updated');
                    showNotification('Hero section updated successfully!', 'success');
                } else {
                    console.log('Error: Failed to update hero section');
                    const errorText = await response.text();
                    console.log('Error response:', errorText);
                    showNotification('Failed to update hero section', 'error');
                }
            } catch (error) {
                console.log('Fetch error:', error);
                showNotification('Error updating hero section', 'error');
            }
        }

        

        function saveCertificationFromModal() {
            console.log('saveCertificationFromModal called');
            const form = document.getElementById('certificationForm');
            if (!form) {
                console.error('Certification form not found');
                return;
            }

            const formData = new FormData(form);

            // Get selected icon from the selected icon-option div
            const selectedIconDiv = document.querySelector('#certIconPicker .icon-option.selected');
            if (selectedIconDiv) {
                const iconValue = selectedIconDiv.getAttribute('data-icon');
                formData.set('icon', iconValue);
                console.log('Selected icon:', iconValue);
            }

            console.log('Form data entries:');
            for (let [key, value] of formData.entries()) {
                console.log(key, value);
            }

            const isEdit = currentEditType === 'certification';
            console.log('isEdit:', isEdit, 'currentEditId:', currentEditId);

            saveCertification(formData, isEdit);
            currentEditId = null;
            currentEditType = null;
        }

        async function saveCertification(formData, isEdit = false) {
            try {
                const url = isEdit ? `/admin/certificates/${currentEditId}` : '/admin/certificates';
                let method = isEdit ? 'POST' : 'POST'; // Always use POST for FormData with method spoofing

                // Add _method field for PATCH requests
                if (isEdit) {
                    formData.append('_method', 'PATCH');
                } else {
                    formData.delete('_method'); // Ensure it's not present for POST
                }

                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: formData // Send as FormData directly
                });

                const result = await response.json(); // Always try to parse JSON

                if (response.ok) {
                    showNotification(result.message || `Certification ${isEdit ? 'updated' : 'added'} successfully!`, 'success');
                    closeCertificationModal();
                    location.reload(); // Refresh to show new data
                } else if (response.status === 422 && result.errors) {
                    // Handle validation errors
                    let errorMessages = '';
                    for (const field in result.errors) {
                        errorMessages += `${field}: ${result.errors[field].join(', ')}\n`;
                    }
                    showNotification(`Validation failed:\n${errorMessages}`, 'error');
                } else {
                    showNotification(result.message || `Failed to ${isEdit ? 'update' : 'add'} certification`, 'error');
                    console.error('Certification submission error:', result);
                }
            } catch (error) {
                console.error('Error during saveCertification:', error);
                showNotification(`Error ${isEdit ? 'updating' : 'adding'} certification: ${error.message}`, 'error');
            }
        }
        async function saveProject(formData, isEdit = false) {
            try {
                const url = isEdit ? `/admin/projects/${currentEditId}` : '/admin/projects';
                let method = isEdit ? 'POST' : 'POST'; // Always use POST for FormData with method spoofing

                // Add _method field for PATCH requests
                if (isEdit) {
                    formData.append('_method', 'PATCH');
                } else {
                    formData.delete('_method'); // Ensure it's not present for POST
                }

                console.log('Sending request to:', url, 'method:', method);
                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                console.log('Response status:', response.status);
                if (response.ok) {
                    const result = await response.json();
                    console.log('Success:', result);
                    showNotification(`Project ${isEdit ? 'updated' : 'added'} successfully!`, 'success');
                    closeProjectModal();
                    location.reload(); // Refresh to show new data
                } else {
                    const errorText = await response.text();
                    console.log('Error response:', errorText);
                    try {
                        const errorData = JSON.parse(errorText);
                        showNotification(errorData.message || `Failed to ${isEdit ? 'update' : 'add'} project`, 'error');
                    } catch (e) {
                        showNotification(`Failed to ${isEdit ? 'update' : 'add'} project`, 'error');
                    }
                }
            } catch (error) {
                showNotification(`Error ${isEdit ? 'updating' : 'adding'} project`, 'error');
            }
        }

        // Project Category Management Functions
        async function loadProjectCategories() {
            try {
                const response = await fetch('/admin/project-categories');
                const categories = await response.json();
                const categoriesList = document.getElementById('project-categories-list');

                // Clear existing categories except the add button
                const addButton = categoriesList.querySelector('button');
                categoriesList.innerHTML = '';

                categories.forEach(category => {
                    const categoryDiv = document.createElement('div');
                    categoryDiv.className = 'flex items-center gap-3 bg-white/5 p-3 rounded-lg project-category-item';
                    categoryDiv.setAttribute('data-id', category.id);
                    categoryDiv.innerHTML = `
                        <input type="text" class="bg-transparent border-none text-white flex-1 focus:outline-none project-category-name" value="${category.name}">
                        <div class="w-6 h-6 rounded-full cursor-pointer category-color" style="background-color: ${category.color || '#3B82F6'}" title="Click to change color"></div>
                        <button class="text-red-400 hover:text-red-300 delete-project-category" data-id="${category.id}" title="Delete Category"><i data-lucide="x" class="w-4 h-4"></i></button>
                    `;
                    categoriesList.appendChild(categoryDiv);
                });

                categoriesList.appendChild(addButton);
                lucide.createIcons();
            } catch (error) {
                console.error('Error loading project categories:', error);
            }
        }

        async function loadProjectCategoriesForDropdown(selectedId = null) {
            try {
                const response = await fetch('/admin/project-categories');
                const categories = await response.json();
                const dropdown = document.getElementById('projectCategory');

                // Clear existing options except the first one
                dropdown.innerHTML = '<option value="">Select Category</option>';

                categories.forEach(category => {
                    const option = document.createElement('option');
                    option.value = category.id;
                    option.textContent = category.name;
                    if (selectedId && category.id == selectedId) {
                        option.selected = true;
                    }
                    dropdown.appendChild(option);
                });
            } catch (error) {
                console.error('Error loading categories for dropdown:', error);
            }
        }

        async function saveProjectCategory(event) {
            event.preventDefault();

            const formData = new FormData(projectCategoryForm);
            const isEdit = window.currentEditProjectCategoryId !== null;

            try {
                const url = isEdit ? `/admin/project-categories/${window.currentEditProjectCategoryId}` : '/admin/project-categories';
                const method = isEdit ? 'POST' : 'POST'; // Always POST for FormData with method spoofing

                // Add _method field for PATCH requests
                if (isEdit) {
                    formData.append('_method', 'PATCH');
                }

                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                if (response.ok) {
                    showNotification(`Category ${isEdit ? 'updated' : 'added'} successfully!`, 'success');
                    closeProjectCategoryModal();
                    loadProjectCategories(); // Reload categories
                    loadProjectCategoriesForDropdown(); // Update dropdown in project modal
                } else {
                    const errorData = await response.json();
                    showNotification(errorData.message || `Failed to ${isEdit ? 'update' : 'add'} category`, 'error');
                }
            } catch (error) {
                showNotification(`Error ${isEdit ? 'updating' : 'adding'} category`, 'error');
            }
        }

        async function deleteProjectCategory(id) {
            if (!confirm('Are you sure you want to delete this category? This may affect existing projects.')) return;

            try {
                const response = await fetch(`/admin/project-categories/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    showNotification('Category deleted successfully!', 'success');
                    loadProjectCategories(); // Reload categories
                    loadProjectCategoriesForDropdown(); // Update dropdown in project modal
                } else {
                    showNotification('Failed to delete category', 'error');
                }
            } catch (error) {
                showNotification('Error deleting category', 'error');
            }
        }

        async function updateProjectCategoryName(id, name) {
            try {
                const response = await fetch(`/admin/project-categories/${id}`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ name: name })
                });

                if (response.ok) {
                    showNotification('Category name updated successfully!', 'success');
                    loadProjectCategoriesForDropdown(); // Update dropdown in project modal
                } else {
                    showNotification('Failed to update category name', 'error');
                }
            } catch (error) {
                showNotification('Error updating category name', 'error');
            }
        }

        async function deleteItem(type, id) {
            if (!confirm('Are you sure you want to delete this item?')) return;

            try {
                const response = await fetch(`/admin/${type}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    showNotification('Item deleted successfully!', 'success');
                    location.reload(); // Refresh to show updated data
                } else {
                    showNotification('Failed to delete item', 'error');
                }
            } catch (error) {
                showNotification('Error deleting item', 'error');
            }
        }

        // Edit functions
        async function editEducation(id) {
            console.log('Editing education with ID:', id);
            try {
                const response = await fetch(`/admin/educations/${id}/edit`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                console.log('Response from server:', response);

                if (response.ok) {
                    const education = await response.json();
                    console.log('Education data received:', education);
                    
                    // Populate modal with existing data
                    educationForm.querySelector('[name="degree"]').value = education.degree || '';
                    educationForm.querySelector('[name="institution"]').value = education.institution || '';
                    educationForm.querySelector('[name="start_date"]').value = education.start_date ? education.start_date.split('T')[0] : '';
                    educationForm.querySelector('[name="end_date"]').value = education.end_date ? education.end_date.split('T')[0] : '';
                    educationForm.querySelector('[name="is_present"]').checked = education.is_present || false;
                    educationForm.querySelector('[name="location"]').value = education.location || '';
                    educationForm.querySelector('[name="description"]').value = education.description || '';

                    toggleEducationEndDate(educationForm.querySelector('[name="is_present"]'));
                    
                    educationModal.classList.remove('hidden');
                    setTimeout(() => {
                        educationModal.classList.remove('opacity-0');
                        educationModalContent.classList.remove('scale-95');
                        educationModalContent.classList.add('scale-100');
                    }, 10);
                } else {
                     console.error('Error loading education data. Response not OK.', response);
                     showNotification('Error loading education data', 'error');
                }
            } catch (error) {
                console.error('Error in editEducation function:', error);
                showNotification('Error loading education data', 'error');
            }
        }

        async function editCertification(id) {
            try {
                const response = await fetch(`/admin/certificates/${id}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    const certification = await response.json();
                    currentEditId = id;
                    currentEditType = 'certification';

                    // Populate modal with existing data
                    document.querySelector('#certificationModal input[placeholder*="AWS"]').value = certification.name || '';
                    document.querySelector('#certificationModal input[placeholder*="Amazon"]').value = certification.issuing_organization || '';
                    document.querySelector('#certificationModal input[type="date"]').value = certification.issue_date ? certification.issue_date.split('T')[0] : '';
                    // Ensure view_type is 'link' since image option is removed
                    document.querySelector('#certViewTypeSelector').value = 'link';
                    document.querySelector('#certLinkInputGroup input').value = certification.credential_url || '';

                    // Set selected icon
                    document.querySelectorAll('#certIconPicker .icon-option').forEach(el => el.classList.remove('selected'));
                    const selectedIconDiv = document.querySelector(`#certIconPicker .icon-option[data-icon="${certification.icon}"]`);
                    if (selectedIconDiv) {
                        selectedIconDiv.classList.add('selected');
                    } else {
                        // Default to award if icon not found
                        const defaultIcon = document.querySelector('#certIconPicker .icon-option[data-icon="award"]');
                        if (defaultIcon) {
                            defaultIcon.classList.add('selected');
                        }
                    }

                    toggleCertViewType(); // Update visibility
                    openCertificationModal(true);
                }
            } catch (error) {
                showNotification('Error loading certification data', 'error');
            }
        }

        async function editProject(id) {
            try {
                const response = await fetch(`/admin/projects/${id}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    const project = await response.json();
                    currentEditId = id;
                    currentEditType = 'project';

                    // Populate modal with existing data
                    document.getElementById('projectTitle').value = project.title || '';
                    document.getElementById('projectDescription').value = project.content || '';
                    document.getElementById('projectTechnologies').value = project.technologies || '';
                    document.getElementById('projectGithubUrl').value = project.github_url || '';
                    document.getElementById('projectLiveUrl').value = project.live_url || '';

                    openProjectModal(true);

                    // Load categories with selected category
                    await loadProjectCategoriesForDropdown(project.category_id);
                }
            } catch (error) {
                showNotification('Error loading project data', 'error');
            }
        }

        // Inline edit functionality for sections without modals
        async function saveKeyMetrics() {
            const metricsSection = document.getElementById('metrics-section');
            const inputs = metricsSection.querySelectorAll('input[data-metric-id]');

            // Group inputs by metric ID
            const metricsData = {};
            inputs.forEach(input => {
                const metricId = input.getAttribute('data-metric-id');
                const field = input.getAttribute('data-field');
                if (!metricsData[metricId]) {
                    metricsData[metricId] = {};
                }
                metricsData[metricId][field] = input.value.trim();
            });

            // Update each metric
            const updatePromises = Object.entries(metricsData).map(async ([metricId, data]) => {
                const formData = new FormData();
                formData.append('value', data.value);
                formData.append('label', data.label);

                return fetch(`/admin/key-metrics/${metricId}`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });
            });

            try {
                const responses = await Promise.all(updatePromises);
                const allSuccessful = responses.every(response => response.ok);

                if (allSuccessful) {
                    showNotification('Key metrics updated successfully!', 'success');
                } else {
                    showNotification('Failed to update some key metrics', 'error');
                }
            } catch (error) {
                showNotification('Error updating key metrics', 'error');
            }
        }

        async function saveExperienceData() {
            const company = document.getElementById('companyInput').value.trim();
            const location = document.getElementById('locationInput').value.trim();
            const logo = document.getElementById('logoInput').value.trim();

            if (!company) {
                showNotification('Company name is required', 'error');
                return;
            }

            // Collect all roles
            const roles = [];
            const roleItems = document.querySelectorAll('.role-item');

            roleItems.forEach((item, index) => {
                const title = item.querySelector('.role-title').value.trim();
                const type = item.querySelector('.role-type').value;
                const startDate = item.querySelector('.role-start-date').value.trim();
                const endDate = item.querySelector('.role-end-date').value.trim();
                const isPresent = item.querySelector('.role-present').checked;
                const description = item.querySelector('.role-description').value.trim();
                const displayType = item.querySelector('.role-display-type').value;
                const skillsText = item.querySelector('.role-skills').value.trim();

                if (title) { // Only add if title is provided
                    // Only include start_date if it's not empty
                    const roleData = {
                        title: title,
                        type: type,
                        description: description,
                        display_type: displayType,
                        skills: skillsText ? skillsText.split(',').map(s => s.trim()).filter(s => s) : []
                    };

                    // Add dates only if they have values
                    if (startDate) {
                        roleData.start_date = startDate;
                    }
                    if (!isPresent && endDate) {
                        roleData.end_date = endDate;
                    }

                    roles.push(roleData);
                }
            });

            if (roles.length === 0) {
                showNotification('At least one role is required', 'error');
                return;
            }

            const displayType = document.getElementById('displayTypeInput').value;

            const data = {
                company: company || null,
                location: location || null,
                logo: logo || null,
                display_type: displayType,
                roles: roles
            };

            console.log('Sending experience data:', JSON.stringify(data, null, 2));

            // Reset edit state if ID is missing
            if (!currentEditId && currentEditType === 'experience') {
                currentEditType = null;
            }

            try {
                const isEdit = currentEditType === 'experience' && currentEditId;
                const url = isEdit ? `/admin/experiences/${currentEditId}` : '/admin/experiences';
                let method = isEdit ? 'PATCH' : 'POST';

                // Method spoofing for PATCH through POST
                if (isEdit) {
                    data._method = 'PATCH';
                    method = 'POST';
                }

                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                const responseText = await response.text();
                console.log('Response status:', response.status);
                console.log('Response text:', responseText);

                if (response.ok) {
                    showNotification(`Experience ${currentEditType === 'experience' ? 'updated' : 'added'} successfully!`, 'success');
                    closeModal();
                    window.location.reload(); // Refresh to show new data
                } else {
                    let errorData;
                    try {
                        errorData = JSON.parse(responseText);
                    } catch (e) {
                        errorData = { message: 'Unknown error occurred' };
                    }
                    showNotification(errorData.message || `Failed to ${currentEditType === 'experience' ? 'update' : 'add'} experience`, 'error');
                }
            } catch (error) {
                console.error('Error saving experience:', error);
                showNotification(`Error ${currentEditType === 'experience' ? 'updating' : 'adding'} experience: ${error.message}`, 'error');
            }
        }

        // Skill Categories Management
        async function loadCategories() {
            try {
                const response = await fetch('/admin/skill-categories');
                const categories = await response.json();
                const categoriesList = document.getElementById('categories-list');

                // Clear existing categories except the add button
                const addButton = document.getElementById('add-category-btn');
                categoriesList.innerHTML = '';

                categories.forEach(category => {
                    const categoryDiv = document.createElement('div');
                    categoryDiv.className = 'flex items-center gap-3 bg-white/5 p-3 rounded-lg category-item';
                    categoryDiv.setAttribute('data-id', category.id);
                    categoryDiv.innerHTML = `
                        <input type="text" class="bg-transparent border-none text-white flex-1 focus:outline-none category-name" value="${category.name}">
                        <button class="text-red-400 hover:text-red-300 delete-category" data-id="${category.id}"><i data-lucide="x" class="w-4 h-4"></i></button>
                    `;
                    categoriesList.appendChild(categoryDiv);
                });

                categoriesList.appendChild(addButton);
                lucide.createIcons();
            } catch (error) {
                console.error('Error loading categories:', error);
            }
        }

        async function saveCategory(id, name) {
            try {
                const response = await fetch(`/admin/skill-categories/${id}`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ name: name })
                });

                if (response.ok) {
                    showNotification('Category updated successfully!', 'success');
                } else {
                    showNotification('Failed to update category', 'error');
                }
            } catch (error) {
                showNotification('Error updating category', 'error');
            }
        }

        async function deleteCategory(id) {
            if (!confirm('Are you sure you want to delete this category?')) return;

            try {
                const response = await fetch(`/admin/skill-categories/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    showNotification('Category deleted successfully!', 'success');
                    loadCategories(); // Reload categories
                } else {
                    showNotification('Failed to delete category', 'error');
                }
            } catch (error) {
                showNotification('Error deleting category', 'error');
            }
        }

        // Skill Category Modal Functions
        const skillCategoryModal = document.getElementById('skillCategoryModal');
        const skillCategoryModalContent = document.getElementById('skillCategoryModalContent');
        const skillCategoryModalTitle = document.getElementById('skillCategoryModalTitle');
        const skillCategoryForm = document.getElementById('skillCategoryForm');
        const skillCategoryNameInput = document.getElementById('skillCategoryNameInput');

        function openSkillCategoryModal(isEdit = false) {
            skillCategoryModal.classList.remove('hidden');
            setTimeout(() => {
                skillCategoryModal.classList.remove('opacity-0');
                skillCategoryModalContent.classList.remove('scale-95');
                skillCategoryModalContent.classList.add('scale-100');
            }, 10);

            if (!isEdit) {
                skillCategoryModalTitle.innerText = 'Add Skill Category';
                skillCategoryForm.reset();
                // Reset icon selection
                document.querySelectorAll('#categoryIconPicker .icon-option').forEach(el => el.classList.remove('selected'));
                document.querySelector('#categoryIconPicker .icon-option[data-icon="layers"]').classList.add('selected');
                document.getElementById('selectedCategoryIcon').value = 'layers';
            }
        }

        function closeSkillCategoryModal() {
            skillCategoryModal.classList.add('opacity-0');
            skillCategoryModalContent.classList.remove('scale-100');
            skillCategoryModalContent.classList.add('scale-95');
            setTimeout(() => {
                skillCategoryModal.classList.add('hidden');
            }, 300);
        }

        function selectCategoryIcon(element) {
            // Remove selected class from all
            document.querySelectorAll('#categoryIconPicker .icon-option').forEach(el => el.classList.remove('selected'));
            // Add to clicked
            element.classList.add('selected');
            // Update hidden input
            document.getElementById('selectedCategoryIcon').value = element.getAttribute('data-icon');
        }

        async function saveSkillCategory(event) {
            event.preventDefault();

            const formData = new FormData(skillCategoryForm);
            const isEdit = window.currentEditCategoryId !== null;

            try {
                const url = isEdit ? `/admin/skill-categories/${window.currentEditCategoryId}` : '/admin/skill-categories';
                const method = isEdit ? 'PATCH' : 'POST';

                if (isEdit) {
                    formData.append('_method', 'PATCH');
                }

                const response = await fetch(url, {
                    method: 'POST', // Always POST for FormData
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                if (response.ok) {
                    showNotification(`Category ${isEdit ? 'updated' : 'added'} successfully!`, 'success');
                    closeSkillCategoryModal();
                    loadCategories(); // Reload categories
                } else {
                    const errorData = await response.json();
                    showNotification(errorData.message || `Failed to ${isEdit ? 'update' : 'add'} category`, 'error');
                }
            } catch (error) {
                showNotification(`Error ${isEdit ? 'updating' : 'adding'} category`, 'error');
            }
        }

        // Skill Management Functions
        async function loadSkills() {
            try {
                const response = await fetch('/admin/skills');
                const skills = await response.json();
                const skillsList = document.getElementById('skills-list');

                // Clear existing skills
                skillsList.innerHTML = '';

                if (skills.length === 0) {
                    skillsList.innerHTML = `
                        <div class="col-span-full text-center py-8 text-zinc-500">
                            <i data-lucide="zap" class="w-12 h-12 mx-auto mb-4 opacity-50"></i>
                            <p>No skills added yet. Click "Add Skill" to get started.</p>
                        </div>
                    `;
                } else {
                    skills.forEach(skill => {
                        const skillDiv = document.createElement('div');
                        skillDiv.className = 'bg-zinc-900/50 border border-white/5 rounded-lg p-4 flex items-center gap-3 hover:border-gold-400/50 transition-colors relative group skill-item';
                        skillDiv.setAttribute('data-id', skill.id);
                        skillDiv.innerHTML = `
                            <div class="w-8 h-8 rounded bg-white/5 flex items-center justify-center">
                                ${skill.logo ? `<img src="/storage/${skill.logo}" alt="${skill.name}" class="w-4 h-4 object-contain">` : '<i data-lucide="code" class="w-4 h-4 text-blue-400"></i>'}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-white">${skill.name}</p>
                                <p class="text-[10px] text-zinc-500">${skill.category ? skill.category.name : 'No Category'}</p>
                            </div>
                            <button class="absolute top-2 right-2 text-zinc-500 hover:text-red-400 opacity-0 group-hover:opacity-100 transition-opacity delete-skill" data-id="${skill.id}">
                                <i data-lucide="x" class="w-3 h-3"></i>
                            </button>
                        `;
                        skillsList.appendChild(skillDiv);
                    });
                }

                lucide.createIcons();
            } catch (error) {
                console.error('Error loading skills:', error);
            }
        }

        function resetSkillForm() {
            document.getElementById('skillForm').reset();
            // Reset file name display
            const fileNameSpan = document.querySelector('.file-name');
            const uploadText = document.querySelector('.file-upload-text');
            if (fileNameSpan) fileNameSpan.classList.add('hidden');
            if (uploadText) uploadText.textContent = 'Click to upload SVG/PNG';
        }

        function updateFileName(input) {
            const fileNameSpan = input.closest('.file-upload-box').querySelector('.file-name');
            const uploadText = input.closest('.file-upload-box').querySelector('.file-upload-text');

            if (input.files && input.files[0]) {
                const fileName = input.files[0].name;
                if (fileNameSpan) {
                    fileNameSpan.textContent = fileName;
                    fileNameSpan.classList.remove('hidden');
                }
                if (uploadText) {
                    uploadText.textContent = 'File selected:';
                }
            } else {
                if (fileNameSpan) fileNameSpan.classList.add('hidden');
                if (uploadText) uploadText.textContent = 'Click to upload SVG/PNG';
            }
        }

        async function saveSkill(event) {
            event.preventDefault();

            const formData = new FormData(document.getElementById('skillForm'));

            try {
                const response = await fetch('/admin/skills', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                if (response.ok) {
                    showNotification('Skill added successfully!', 'success');
                    resetSkillForm();
                    loadSkills(); // Reload skills list
                } else {
                    const errorData = await response.json();
                    showNotification(errorData.message || 'Failed to add skill', 'error');
                }
            } catch (error) {
                showNotification('Error adding skill', 'error');
            }
        }

        async function deleteSkill(id) {
            if (!confirm('Are you sure you want to delete this skill?')) return;

            try {
                const response = await fetch(`/admin/skills/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    showNotification('Skill deleted successfully!', 'success');
                    loadSkills(); // Reload skills list
                } else {
                    showNotification('Failed to delete skill', 'error');
                }
            } catch (error) {
                showNotification('Error deleting skill', 'error');
            }
        }

        async function editCategory(id) {
            try {
                const response = await fetch(`/admin/skill-categories/${id}`);
                const category = await response.json();

                // Store current edit ID for update
                window.currentEditCategoryId = id;

                // Open modal first (without resetting for edit)
                openSkillCategoryModal(true); // Pass true to indicate edit mode
                document.getElementById('skillCategoryModalTitle').innerText = 'Edit Skill Category';

                // Populate modal with existing data after modal is open
                document.getElementById('skillCategoryNameInput').value = category.name;

                // Set selected icon
                document.querySelectorAll('#categoryIconPicker .icon-option').forEach(el => el.classList.remove('selected'));
                const selectedIcon = document.querySelector(`#categoryIconPicker .icon-option[data-icon="${category.icon || 'layers'}"]`);
                if (selectedIcon) {
                    selectedIcon.classList.add('selected');
                    document.getElementById('selectedCategoryIcon').value = category.icon || 'layers';
                }
            } catch (error) {
                showNotification('Error loading category data', 'error');
            }
        }

        async function addCategory() {
            window.currentEditCategoryId = null;
            openSkillCategoryModal();
        }

        // Form submission handlers & event delegation
        document.addEventListener('DOMContentLoaded', function() {
            console.log('=== DOM Content Loaded - Attaching event listeners ===');

                    async function editProjectCategory(id) {
                        try {
                            const response = await fetch(`/admin/project-categories/${id}`);
                            const category = await response.json();
            
                            // Store current edit ID for update
                            window.currentEditProjectCategoryId = id;
            
                            // Open modal first (without resetting for edit)
                            openProjectCategoryModal(true); // Pass true to indicate edit mode
                            projectCategoryModalTitle.innerText = 'Edit Project Category';
            
                            // Populate modal with existing data after modal is open
                            projectCategoryForm.querySelector('[name="name"]').value = category.name;
                            projectCategoryForm.querySelector('[name="description"]').value = category.description;
                            projectCategoryForm.querySelector('[name="color"]').value = category.color;
                        } catch (error) {
                            showNotification('Error loading category data', 'error');
                        }
                    }
            
                    // Delegated event listeners for dynamic content
                    document.body.addEventListener('click', function(e) {
                        const editButton = e.target.closest('[data-edit-type]');
                        const deleteButton = e.target.closest('[data-delete-type]');
                        const editProjectCategoryButton = e.target.closest('.edit-project-category');
                        const deleteProjectCategoryButton = e.target.closest('.delete-project-category');
            
                        if (editButton) {
                            const type = editButton.getAttribute('data-edit-type');
                            const id = editButton.getAttribute('data-id');
                            if (type === 'project') editProject(id);
                            if (type === 'certification') editCertification(id);
                            if (type === 'education') editEducation(id);
                            if (type === 'experience') editExperience(id);
                        }
            
                        if (deleteButton) {
                            const type = deleteButton.getAttribute('data-delete-type');
                            const id = deleteButton.getAttribute('data-id');
                            deleteItem(type, id);
                        }
            
                        if (editProjectCategoryButton) {
                            const id = editProjectCategoryButton.getAttribute('data-id');
                            editProjectCategory(id);
                        }
            
                        if (deleteProjectCategoryButton) {
                            const id = deleteProjectCategoryButton.getAttribute('data-id');
                            deleteProjectCategory(id);
                        }
                    });
            // Check for hash in URL on page load
            const hash = window.location.hash.substring(1); // Remove the '#'
            if (hash && ['hero', 'metrics', 'experience', 'education', 'certifications', 'projects', 'categories', 'contact', 'skills', 'skill-categories', 'messages'].includes(hash)) {
                showSection(hash, false);
            } else {
                // Default to hero section and set initial state
                history.replaceState({section: 'hero'}, '', '#hero');
            }

            // Hero save button
            const saveButton = document.getElementById('saveChanges');
            if (saveButton) {
                console.log('Save button found, attaching click handler');
                saveButton.addEventListener('click', function(e) {
                    console.log('=== Save Changes button clicked ===');
                    e.preventDefault();
                    console.log('Calling saveHeroData...');
                    saveHeroData();
                });
            } else {
                console.error('Save button not found!');
            }

            // Show save button for hero section initially (since hero is default)
            if (saveButton) {
                saveButton.classList.remove('hidden');
            }
            // Education modal save
            educationForm.addEventListener('submit', saveEducation);
                    // Certification modal save (using form submit event)
                    const certificationForm = document.getElementById('certificationForm');
                    if (certificationForm) {
                        certificationForm.addEventListener('submit', function(e) {
                            e.preventDefault(); // Prevent default form submission
                            saveCertificationFromModal();
                        });
                    }
            // Skill category modal save
            if (skillCategoryForm) {
                skillCategoryForm.addEventListener('submit', saveSkillCategory);
            }

            // Skill form save
            const skillForm = document.getElementById('skillForm');
            if (skillForm) {
                skillForm.addEventListener('submit', saveSkill);
            }

            // Project category modal save
            if (projectCategoryForm) {
                projectCategoryForm.addEventListener('submit', saveProjectCategory);
            }

            // Edit button handlers
            document.addEventListener('click', function(e) {
                if (e.target.closest('[data-edit-type="education"]')) {
                    const id = e.target.closest('[data-edit-type="education"]').getAttribute('data-id');
                    openEducationModal(id);
                } else if (e.target.closest('[data-edit-type="certification"]')) {
                    const id = e.target.closest('[data-edit-type="certification"]').getAttribute('data-id');
                    editCertification(id);
                } else if (e.target.closest('[data-edit-type="project"]')) {
                    const id = e.target.closest('[data-edit-type="project"]').getAttribute('data-id');
                    editProject(id);
                }
            });

            // Delete button handlers
            document.addEventListener('click', function(e) {
                if (e.target.closest('[data-delete-type]')) {
                    e.preventDefault();
                    const deleteBtn = e.target.closest('[data-delete-type]');
                    const type = deleteBtn.getAttribute('data-delete-type');
                    const id = deleteBtn.getAttribute('data-id');
                    deleteItem(type, id);
                }

                // Category management
                if (e.target.closest('.delete-category')) {
                    e.preventDefault();
                    const id = e.target.closest('.delete-category').getAttribute('data-id');
                    deleteCategory(id);
                }

                // Skill management
                if (e.target.closest('.delete-skill')) {
                    e.preventDefault();
                    const id = e.target.closest('.delete-skill').getAttribute('data-id');
                    deleteSkill(id);
                }

                // Project category management
                if (e.target.closest('.delete-project-category')) {
                    e.preventDefault();
                    const id = e.target.closest('.delete-project-category').getAttribute('data-id');
                    deleteProjectCategory(id);
                }

                // Category management
                if (e.target.closest('.edit-category')) {
                    e.preventDefault();
                    const id = e.target.closest('.edit-category').getAttribute('data-id');
                    editCategory(id);
                }

                // Add category button is now handled by onclick attribute
            });

            // Category name editing
            document.addEventListener('blur', function(e) {
                if (e.target.classList.contains('category-name')) {
                    const categoryItem = e.target.closest('.category-item');
                    const id = categoryItem.getAttribute('data-id');
                    const newName = e.target.value.trim();
                    if (newName) {
                        saveCategory(id, newName);
                    }
                }

                // Project category name editing
                if (e.target.classList.contains('project-category-name')) {
                    const categoryItem = e.target.closest('.project-category-item');
                    const id = categoryItem.getAttribute('data-id');
                    const newName = e.target.value.trim();
                    if (newName) {
                        updateProjectCategoryName(id, newName);
                    }
                }
            });

            // Enter key for category editing
            document.addEventListener('keypress', function(e) {
                if (e.target.classList.contains('category-name') && e.key === 'Enter') {
                    e.target.blur();
                }

                // Enter key for project category editing
                if (e.target.classList.contains('project-category-name') && e.key === 'Enter') {
                    e.target.blur();
                }
            });

            // Experience modal save is handled by the onclick attribute on the button
        });
    </script>
</body>
</html>