<!-- 7. PORTFOLIO GRID -->
<section id="projects" class="relative z-10 w-full px-6 py-16 md:py-40">
    <div class="max-w-[95%] mx-auto">
        <div class="text-center mb-8 md:mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-5xl font-display font-bold text-white mb-4 md:mb-6">Featured <span class="text-gold-gradient">Projects</span></h2>
            <p class="text-zinc-400 max-w-2xl mx-auto">A showcase of my technical capabilities and problem-solving approach</p>
        </div>

        <div class="flex flex-wrap justify-center gap-4 mb-8 md:mb-12" data-aos="fade-up" data-aos-delay="100">
            <button onclick="filterProjects('all')" data-slug="all" class="filter-btn active px-6 py-2 rounded-full text-sm font-medium border text-zinc-300">All</button>
            @foreach(\App\Models\ProjectCategory::orderBy('name')->get() as $category)
            <button onclick="filterProjects('{{ $category->slug }}')" data-slug="{{ $category->slug }}" class="filter-btn px-6 py-2 rounded-full text-sm font-medium border text-zinc-300">{{ $category->name }}</button>
            @endforeach
        </div>

        <!-- Mobile Carousel / Desktop Grid -->
        <!-- Changed min-w-[85vw] to min-w-full for full visibility on mobile -->
        <div id="projects-grid" class="flex md:grid md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 overflow-x-auto md:overflow-visible snap-x snap-mandatory scrollbar-hide scroll-smooth pb-4 md:pb-0">

            @forelse($projects as $index => $project)
            <!-- Project Card -->
            <div data-aos="fade-up" data-category="{{ $project->category_slug }}" class="project-card glass-panel p-6 md:p-8 cursor-pointer group flex flex-col h-full min-w-full md:min-w-0 snap-center transform transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_0_30px_rgba(255,215,0,0.2)] hover:border-[#ffd700]">
                <div class="flex justify-between items-start mb-4">
                    <h4 class="text-xl font-bold text-white">{{ $project->title }}</h4>
                    @if($project->category)
                        <span class="px-3 py-1 text-xs font-bold rounded-full" style="background-color: {{ $project->category->color }}20; color: {{ $project->category->color }}">{{ $project->category->name }}</span>
                    @else
                        <span class="px-3 py-1 text-xs font-bold text-gray-900 bg-gray-200 rounded-full">Uncategorized</span>
                    @endif

                </div>
                <p class="text-zinc-400 text-sm mb-6 flex-grow leading-relaxed">
                    {{ $project->content ?? 'A comprehensive project showcasing technical expertise and problem-solving skills.' }}
                </p>
                @if($project->technologies)
                <div class="flex flex-wrap gap-2 mb-6">
                    @foreach(explode(',', $project->technologies) as $tech)
                        <span class="px-3 py-1 text-xs rounded-full bg-zinc-800 text-zinc-300 border border-zinc-700">{{ trim($tech) }}</span>
                    @endforeach
                </div>
                @endif
                <div class="flex gap-4 mt-auto">
                    @if($project->github_url)
                    <a href="{{ $project->github_url }}" target="_blank" class="flex-1 py-2 rounded-lg bg-zinc-800 text-white text-sm font-bold hover:bg-zinc-700 transition-colors flex items-center justify-center gap-2">
                        <i data-lucide="github" class="w-4 h-4"></i> GitHub
                    </a>
                    @endif
                    @if($project->live_url)
                    <a href="{{ $project->live_url }}" target="_blank" class="flex-1 py-2 rounded-lg bg-[#ffd700] text-black text-sm font-bold hover:bg-white transition-colors flex items-center justify-center gap-2">
                        <i data-lucide="external-link" class="w-4 h-4"></i> Live
                    </a>
                    @endif
                </div>
            </div>
            @empty
            <!-- Default Project Card -->
            <div data-aos="fade-up" data-category="web" class="project-card glass-panel p-6 md:p-8 cursor-pointer group flex flex-col h-full min-w-full md:min-w-0 snap-center transform transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_0_30px_rgba(255,215,0,0.2)] hover:border-[#ffd700]">
                <div class="flex justify-between items-start mb-4">
                    <h4 class="text-xl font-bold text-white">Sample Project</h4>
                    <span class="px-3 py-1 text-xs font-bold text-indigo-900 bg-indigo-200 rounded-full">Web</span>
                </div>
                <p class="text-zinc-400 text-sm mb-6 flex-grow leading-relaxed">
                    A sample project showcasing technical capabilities and development skills.
                </p>
                <div class="flex flex-wrap gap-2 mb-6">
                    <span class="px-3 py-1 text-xs rounded-full bg-zinc-800 text-zinc-300 border border-zinc-700">React</span>
                    <span class="px-3 py-1 text-xs rounded-full bg-zinc-800 text-zinc-300 border border-zinc-700">Node.js</span>
                </div>
                <div class="flex gap-4">
                    <button class="flex-1 py-2 rounded-lg bg-zinc-800 text-white text-sm font-bold hover:bg-zinc-700 transition-colors flex items-center justify-center gap-2"><i data-lucide="github" class="w-4 h-4"></i> GitHub</button>
                     <button class="flex-1 py-2 rounded-lg bg-[#ffd700] text-black text-sm font-bold hover:bg-white transition-colors flex items-center justify-center gap-2"><i data-lucide="external-link" class="w-4 h-4"></i> Live</button>
                </div>
            </div>
            @endforelse

        </div>

        <!-- Mobile Dots -->
        <div id="mobile-dots" class="flex justify-center gap-2 mt-6 md:hidden">
            @for($i = 0; $i < $projects->count(); $i++)
                <div class="carousel-dot {{ $i === 0 ? 'active' : '' }}"></div>
            @endfor
        </div>

        <!-- View All Button -->
        <div class="text-center mt-8 md:mt-12">
            <a href="{{ route('frontend.projects.index') }}" class="inline-flex items-center gap-2 px-6 md:px-8 py-2 md:py-3 bg-[#ffd700] text-black font-bold rounded-full hover:bg-white transition-all transform hover:scale-105 shadow-[0_0_20px_rgba(255,215,0,0.4)] text-sm md:text-base">
                View All Projects <i data-lucide="arrow-right" class="w-4 h-4 md:w-5 md:h-5"></i>
            </a>
        </div>
    </div>
</section>

<script>
    // Filter Logic
    function filterProjects(category) {
        const projects = document.querySelectorAll('.project-card');
        const buttons = document.querySelectorAll('.filter-btn');
        const isDesktop = window.innerWidth >= 768;
        let visibleCount = 0;

        buttons.forEach(btn => {
            btn.classList.remove('active');
            if (btn.getAttribute('data-slug') === category) {
                btn.classList.add('active');
            }
        });

        projects.forEach(project => {
            const projectCategory = project.getAttribute('data-category');
            const shouldShow = category === 'all' || projectCategory === category;

            if (shouldShow) {
                visibleCount++;
                project.style.display = isDesktop ? 'block' : 'flex'; // Block for grid, flex for carousel
            } else {
                project.style.display = 'none';
            }
        });

        // Re-init dots after filter
        updateDots();
    }
    
        // Mobile Carousel Logic
        const projectsGrid = document.getElementById('projects-grid');
        const mobileDotsContainer = document.getElementById('mobile-dots');
        let mobileScrollInterval;

    function updateDots() {
        const visibleProjects = Array.from(projectsGrid.children).filter(child => child.style.display !== 'none');
        const dots = document.querySelectorAll('#mobile-dots .carousel-dot');

        dots.forEach((dot, i) => {
            if (i < visibleProjects.length) {
                dot.style.display = 'block';
                dot.classList.remove('active');
            } else {
                dot.style.display = 'none';
            }
        });

        if (visibleProjects.length > 0) {
            dots[0].classList.add('active');
        }
    }

    // Initial setup on load
    window.addEventListener('load', () => {
        filterProjects('all');
        updateDots();
    });

    // Auto Scroll Logic (Mobile Only)
    function startAutoScroll() {
        if (window.innerWidth >= 768) return; // Don't scroll on desktop

        mobileScrollInterval = setInterval(() => {
            const visibleProjects = Array.from(projectsGrid.children).filter(child => child.style.display !== 'none');
            if (visibleProjects.length === 0) return;

            const cardWidth = visibleProjects[0].offsetWidth;
            const gap = 24; // Tailwind gap-6 is 1.5rem = 24px approx
            const scrollAmount = cardWidth + gap;

            // Check if we reached the end
            if (projectsGrid.scrollLeft + projectsGrid.clientWidth >= projectsGrid.scrollWidth - 10) {
                projectsGrid.scrollTo({ left: 0, behavior: 'smooth' });
            } else {
                projectsGrid.scrollBy({ left: scrollAmount, behavior: 'smooth' });
            }
        }, 3000);
    }

    function stopAutoScroll() {
        clearInterval(mobileScrollInterval);
    }

    // Update active dot on scroll
    projectsGrid.addEventListener('scroll', () => {
        if (window.innerWidth >= 768) return;

        const visibleProjects = Array.from(projectsGrid.children).filter(child => child.style.display !== 'none');
        if (visibleProjects.length === 0) return;

        const cardWidth = visibleProjects[0].offsetWidth;
        const gap = 24;
        const scrollAmount = cardWidth + gap;
        const index = Math.min(Math.floor(projectsGrid.scrollLeft / scrollAmount), visibleProjects.length - 1);

        const dots = document.querySelectorAll('#mobile-dots .carousel-dot');
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });
    });

    // Event Listeners for Pause on Hover/Touch
    projectsGrid.addEventListener('touchstart', stopAutoScroll);
    projectsGrid.addEventListener('touchend', startAutoScroll);

    // Start on load
    startAutoScroll();

    // Re-check on resize
    window.addEventListener('resize', () => {
        stopAutoScroll();
        startAutoScroll();
        filterProjects('all'); // Re-run filter logic to handle desktop/mobile switching
    });

</script>

<style>
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

    /* Dots Animation */
    .carousel-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
    }
    .carousel-dot.active {
        width: 24px;
        border-radius: 4px;
        background-color: #ffd700;
    }

    /* Hide scrollbar for carousel */
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style></parameter>
</xai:function_call>