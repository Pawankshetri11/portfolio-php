<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Projects | Pawan Kshetri</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

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
                            card: '#0c0c0c',
                        },
                        gold: {
                            400: '#ffed4e',
                            500: '#ffd700',
                            600: '#d4b200',
                        },
                    },
                    animation: {
                        'blob': 'blob 20s infinite',
                        'pulse-glow': 'pulse-glow 3s infinite',
                        'twinkle': 'twinkle 4s ease-in-out infinite',
                    },
                    keyframes: {
                        blob: {
                            '0%': { transform: 'translate(0px, 0px) scale(1)' },
                            '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                            '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                            '100%': { transform: 'translate(0px, 0px) scale(1)' },
                        },
                        'pulse-glow': {
                            '0%, 100%': { boxShadow: '0 0 20px rgba(255, 215, 0, 0.1)' },
                            '50%': { boxShadow: '0 0 40px rgba(255, 215, 0, 0.4)' },
                        },
                        twinkle: {
                            '0%, 100%': { opacity: 0.2, transform: 'scale(1)' },
                            '50%': { opacity: 1, transform: 'scale(1.2)' }
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* --- Base & Scrollbar --- */
        body {
            background-color: #020202;
            color: #e4e4e7;
            overflow-x: hidden;
        }

        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #020202; }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #ffd700; }

        /* --- Refined Glass Effect --- */
        .glass-panel {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-out;
        }

        /* Hover Effect: Glow up with Gold */
        .glass-panel:hover {
            border-color: rgba(255, 215, 0, 1) !important;
            box-shadow: 0 0 30px rgba(255, 215, 0, 0.3), inset 0 0 10px rgba(255, 215, 0, 0.05);
            background: rgba(255, 255, 255, 0.05);
            transform: translateY(-5px);
        }

        /* --- Text Gradients --- */
        .text-gold-gradient {
            background: linear-gradient(135deg, #fff 20%, #ffd700 80%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-size: 200% auto;
            animation: shine 4s linear infinite;
        }

        @keyframes shine {
            to { background-position: 200% center; }
        }

        /* Filter Buttons Styles */
        .filter-btn {
            transition: all 0.3s ease;
            border: 1px solid rgba(255,255,255,0.1);
        }
        .filter-btn:hover {
            border-color: #ffd700;
            color: #ffd700;
        }
        .filter-btn.active {
            background-color: #ffd700;
            color: #000;
            border-color: #ffd700;
            font-weight: 600;
        }

        /* --- Background Animations --- */
        .stars-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .star-tiny {
            position: absolute;
            background: white;
            border-radius: 50%;
            animation: twinkle var(--duration) ease-in-out infinite;
            opacity: 0;
        }
    </style>
</head>
<body class="antialiased selection:bg-[#ffd700] selection:text-black relative">

    <!-- BACKGROUND ANIMATION LAYER -->
    <div class="fixed inset-0 z-0 pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[40vw] h-[40vw] bg-yellow-900/10 rounded-full mix-blend-screen filter blur-[100px] animate-blob"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40vw] h-[40vw] bg-[#ffd700]/5 rounded-full mix-blend-screen filter blur-[100px] animate-blob" style="animation-delay: 2s"></div>
        <div id="starsContainer" class="stars-container"></div>
        <canvas id="meshCanvas" class="opacity-40 absolute inset-0"></canvas>
    </div>

    @include('components.frontend.header-section')

    <!-- Title Section -->
    <section class="pt-24 pb-16 px-6">
        <div class="max-w-[95%] mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-display font-bold text-white mb-4">
                All <span class="text-gold-gradient">Projects</span>
            </h1>
            <p class="text-zinc-400 max-w-2xl mx-auto">A comprehensive showcase of my technical capabilities across various domains</p>
        </div>
    </section>

    <!-- PROJECTS GRID -->
    <section id="projects" class="relative z-10 w-full px-6 pb-24">
        <div class="max-w-[95%] mx-auto">
            <!-- Category Filters -->
            <div class="flex flex-wrap justify-center gap-4 mb-12" data-aos="fade-up" data-aos-delay="100">
                <button onclick="filterProjects('all')" data-slug="all" class="filter-btn active px-6 py-2 rounded-full text-sm font-medium border text-zinc-300">All</button>
                @foreach(\App\Models\ProjectCategory::orderBy('name')->get() as $category)
                <button onclick="filterProjects('{{ $category->slug }}')" data-slug="{{ $category->slug }}" class="filter-btn px-6 py-2 rounded-full text-sm font-medium border text-zinc-300">{{ $category->name }}</button>
                @endforeach
            </div>

            <!-- Grid Layout -->
            <div id="projects-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" data-page="1" data-next-page-url="{{ $projects->nextPageUrl() }}">
                @forelse($projects as $index => $project)
                <!-- Project Card -->
                <div data-aos="fade-up" data-category="{{ $project->category_slug }}" class="glass-panel p-8 cursor-pointer group flex flex-col h-full transform transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_0_30px_rgba(255,215,0,0.2)] hover:border-[#ffd700]">
                    <div class="flex justify-between items-start mb-4">
                        <h4 class="text-xl font-bold text-white">{{ $project->title }}</h4>
                        @if($project->category)
                            <span class="px-3 py-1 text-xs font-bold rounded-full" style="background-color: {{ $project->category->color }}20; color: {{ $project->category->color }}">{{ $project->category->name }}</span>
                        @else
                            <span class="px-3 py-1 text-xs font-bold text-gray-900 bg-gray-200 rounded-full">Uncategorized</span>
                        @endif

                    </div>
                    <p class="text-zinc-400 text-sm mb-6 flex-grow leading-relaxed">
                        {{ $project->description }}
                    </p>
                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach(explode(',', $project->technologies) as $tech)
                            <span class="px-3 py-1 text-xs rounded-full bg-zinc-800 text-zinc-300 border border-zinc-700">{{ trim($tech) }}</span>
                        @endforeach
                    </div>
                    <div class="flex gap-4">
                        <a href="{{ $project->github_url ?? '#' }}" class="flex-1 py-2 rounded-lg bg-zinc-800 text-white text-sm font-bold hover:bg-zinc-700 transition-colors flex items-center justify-center gap-2">
                            <i data-lucide="github" class="w-4 h-4"></i> GitHub
                        </a>
                         <a href="{{ $project->live_url ?? '#' }}" class="flex-1 py-2 rounded-lg bg-[#ffd700] text-black text-sm font-bold hover:bg-white transition-colors flex items-center justify-center gap-2">
                            <i data-lucide="external-link" class="w-4 h-4"></i> Live Demo
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-zinc-400 text-lg">No projects available yet.</p>
                    <a href="/" class="inline-block mt-4 px-6 py-2 bg-[#ffd700] text-black font-bold rounded-full hover:bg-white transition-colors">
                        ← Back to Home
                    </a>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true, mirror: false });
        lucide.createIcons();

        // Filter Logic
        function filterProjects(category) {
            const projects = document.querySelectorAll('#projects-grid > div:not(.col-span-full)');
            const buttons = document.querySelectorAll('.filter-btn');

            buttons.forEach(btn => {
                btn.classList.remove('active');
                if (btn.getAttribute('data-slug') === category) {
                    btn.classList.add('active');
                }
            });

            projects.forEach(project => {
                const projectCategory = project.getAttribute('data-category');
                if (category === 'all' || projectCategory === category) {
                    project.style.display = 'flex';
                    project.classList.remove('aos-animate');
                    setTimeout(() => project.classList.add('aos-animate'), 50);
                } else {
                    project.style.display = 'none';
                }
            });
        }

        // Starfield Logic
        function createStars() {
            const container = document.getElementById('starsContainer');
            for(let i=0; i<50; i++) {
                const star = document.createElement('div');
                star.classList.add('star-tiny');
                const x = Math.random() * 100;
                const y = Math.random() * 100;
                const size = Math.random() * 2 + 1;
                const delay = Math.random() * 5;
                const duration = Math.random() * 3 + 2;

                star.style.left = `${x}%`;
                star.style.top = `${y}%`;
                star.style.width = `${size}px`;
                star.style.height = `${size}px`;
                star.style.animationDelay = `${delay}s`;
                star.style.setProperty('--duration', `${duration}s`);
                container.appendChild(star);
            }
        }
        createStars();

        // Canvas Logic
        const canvas = document.getElementById('meshCanvas');
        const ctx = canvas.getContext('2d');

        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        window.addEventListener('resize', () => { resizeCanvas(); initParticles(); });
        resizeCanvas();

        let particles = [];
        const numParticles = window.innerWidth < 768 ? 30 : 60;
        const PARTICLE_COLOR = '#ffd700';

        class Particle {
            constructor(x, y) {
                this.x = x;
                this.y = y;
                this.size = Math.random() * 2 + 0.5;
                this.speedX = Math.random() * 0.4 - 0.2;
                this.speedY = Math.random() * 0.4 - 0.2;
            }
            update() {
                this.x += this.speedX;
                this.y += this.speedY;
                if (this.x > canvas.width) this.x = 0;
                if (this.x < 0) this.x = canvas.width;
                if (this.y > canvas.height) this.y = 0;
                if (this.y < 0) this.y = canvas.height;
            }
            draw() {
                ctx.fillStyle = PARTICLE_COLOR;
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fill();
            }
        }

        function initParticles() {
            particles = [];
            for (let i = 0; i < numParticles; i++) {
                const x = Math.random() * canvas.width;
                const y = Math.random() * canvas.height;
                particles.push(new Particle(x, y));
            }
        }

        function animateCanvas() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            for (let i = 0; i < particles.length; i++) {
                particles[i].update();
                particles[i].draw();
                for (let j = i; j < particles.length; j++) {
                    const dx = particles[i].x - particles[j].x;
                    const dy = particles[i].y - particles[j].y;
                    const distance = Math.sqrt(dx * dx + dy * dy);
                    if (distance < 120) {
                        ctx.strokeStyle = `rgba(255, 215, 0, ${0.15 * (1 - distance/120)})`;
                        ctx.lineWidth = 0.5;
                        ctx.beginPath();
                        ctx.moveTo(particles[i].x, particles[i].y);
                        ctx.lineTo(particles[j].x, particles[j].y);
                        ctx.stroke();
                    }
                }
            }
            requestAnimationFrame(animateCanvas);
        }
        initParticles();
        animateCanvas();

        // Infinite Scroll
        let isLoading = false;
        window.addEventListener('scroll', () => {
            if (isLoading) return;
            const grid = document.getElementById('projects-grid');
            const nextUrl = grid.getAttribute('data-next-page-url');
            if (!nextUrl) return;
            const rect = grid.getBoundingClientRect();
            if (rect.bottom <= window.innerHeight + 200) {
                loadMoreProjects();
            }
        });

        function loadMoreProjects() {
            isLoading = true;
            const grid = document.getElementById('projects-grid');
            const nextUrl = grid.getAttribute('data-next-page-url');
            fetch(nextUrl)
                .then(response => response.json())
                .then(data => {
                    data.data.forEach(project => {
                        const card = createProjectCard(project);
                        grid.appendChild(card);
                    });
                    grid.setAttribute('data-page', parseInt(grid.getAttribute('data-page')) + 1);
                    grid.setAttribute('data-next-page-url', data.next_page_url);
                    AOS.refresh();
                    lucide.createIcons();
                    isLoading = false;
                });
        }

        function createProjectCard(project) {
            const div = document.createElement('div');
            div.className = 'glass-panel p-8 cursor-pointer group flex flex-col h-full transform transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_0_30px_rgba(255,215,0,0.2)] hover:border-[#ffd700]';
            div.setAttribute('data-category', project.category ? project.category.slug : 'uncategorized');
            div.innerHTML = `
                <div class="flex justify-between items-start mb-4">
                    <h4 class="text-xl font-bold text-white">${project.title}</h4>
                    ${project.category ? `<span class="px-3 py-1 text-xs font-bold rounded-full" style="background-color: ${project.category.color}20; color: ${project.category.color}">${project.category.name}</span>` : ''}
                </div>
                <p class="text-zinc-400 text-sm mb-6 flex-grow leading-relaxed">
                    ${project.description}
                </p>
                <div class="flex flex-wrap gap-2 mb-6">
                    ${(project.technologies || '').split(',').map(tech => `<span class="px-3 py-1 text-xs rounded-full bg-zinc-800 text-zinc-300 border border-zinc-700">${tech.trim()}</span>`).join('')}
                </div>
                <div class="flex gap-4">
                    <a href="${project.github_url || '#'}" class="flex-1 py-2 rounded-lg bg-zinc-800 text-white text-sm font-bold hover:bg-zinc-700 transition-colors flex items-center justify-center gap-2">
                        <i data-lucide="github" class="w-4 h-4"></i> GitHub
                    </a>
                    <a href="${project.live_url || '#'}" class="flex-1 py-2 rounded-lg bg-[#ffd700] text-black text-sm font-bold hover:bg-white transition-colors flex items-center justify-center gap-2">
                        <i data-lucide="external-link" class="w-4 h-4"></i> Live Demo
                    </a>
                </div>
            `;
            return div;
        }
    </script>
    @include('components.frontend.footer-section')
</body>
</html></parameter>
</xai:function_call>