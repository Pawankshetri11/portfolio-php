<!-- 6.5 CERTIFICATIONS SECTION (Horizontal Scroll on Mobile / Grid on Desktop) -->
@props(['certificates' => collect([])])

<section id="certifications" class="relative z-10 py-24 md:py-40 px-6">
    <div class="w-full">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl md:text-5xl font-display font-bold text-white mb-4">Key <span class="text-gold-gradient">Certifications</span></h2>
            <p class="text-zinc-400 max-w-2xl mx-auto">Validated expertise across cloud computing, data science, and full-stack development.</p>
        </div>

        <!-- Container with overflow-x-auto for mobile swipe -->
        <div id="cert-grid" class="flex overflow-x-auto snap-x snap-mandatory scrollbar-hide scroll-smooth sm:grid sm:grid-cols-2 lg:grid-cols-4 gap-6 pb-6 sm:pb-0">

            @foreach($certificates as $index => $certificate)
            <!-- Cert Card -->
            <div class="glass-panel p-6 min-w-full sm:min-w-0 snap-center transform transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_0_25px_rgba(255,215,0,0.15)] hover:border-[#ffd700] group flex flex-col justify-between" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                <div>
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-2 bg-zinc-800 rounded-lg group-hover:bg-[#ffd700] transition-colors">
                            <i data-lucide="{{ $certificate->icon }}" class="w-6 h-6 text-[#ffd700] group-hover:text-black"></i>
                        </div>
                        <!-- Highlighted Date -->
                        <div class="flex items-center gap-1.5 px-2 py-1 rounded bg-white/5 border border-white/10 group-hover:border-[#ffd700]/30 transition-colors">
                            <i data-lucide="calendar" class="w-3 h-3 text-[#ffd700]"></i>
                            <span class="text-[10px] text-zinc-300 font-mono">{{ $certificate->issue_date->format('d/m/Y') }}</span>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-1 group-hover:text-[#ffd700] transition-colors">{{ $certificate->name }}</h3>
                    <p class="text-xs text-zinc-400">{{ $certificate->issuing_organization }}</p>
                </div>
                <!-- View Certificate Link -->
                <div class="mt-4 pt-4 border-t border-white/5">
                    @if($certificate->view_type === 'link' && $certificate->credential_url)
                        <a href="{{ $certificate->credential_url }}" target="_blank" class="flex items-center justify-end gap-1 text-xs text-zinc-400 hover:text-[#ffd700] transition-colors group-hover:translate-x-1 duration-300">
                            View Certificate <i data-lucide="external-link" class="w-3 h-3"></i>
                        </a>
                    @elseif($certificate->view_type === 'image' && $certificate->certificate_image)
                        <button type="button" onclick="openCertificateModal('{{ $certificate->name }}', '{{ asset($certificate->certificate_image) }}')" class="flex items-center justify-end gap-1 text-xs text-zinc-400 hover:text-[#ffd700] transition-colors group-hover:translate-x-1 duration-300 w-full">
                            View Certificate <i data-lucide="external-link" class="w-3 h-3"></i>
                        </button>
                    @else
                        <span class="flex items-center justify-end gap-1 text-xs text-zinc-500">
                            No certificate available
                        </span>
                    @endif
                </div>
            </div>
            @endforeach

        </div>

        <!-- Mobile Dots -->
        <div id="cert-dots" class="flex justify-center gap-2 mt-6 sm:hidden">
            @foreach($certificates as $index => $certificate)
                <div class="carousel-dot {{ $index === 0 ? 'active' : '' }}"></div>
            @endforeach
        </div>
    </div>
</section>

<!-- Certificate Image Modal -->
<div id="certificateModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="max-w-4xl max-h-screen p-4">
        <div class="relative">
            <button onclick="closeCertificateModal()" class="absolute -top-10 right-0 text-white hover:text-gray-300">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
            <img id="certificateImage" src="" alt="Certificate" class="max-w-full max-h-[80vh] object-contain rounded">
            <h3 id="certificateModalTitle" class="text-white text-lg font-bold mt-4 text-center"></h3>
        </div>
    </div>
</div>

<script>
    // --- Mobile Auto-Scroll Carousel Logic ---
    const grid = document.getElementById('cert-grid');
    const dotsContainer = document.getElementById('cert-dots');
    let scrollInterval;

    function updateDots() {
        // Only relevant if mobile view (grid has scroll width > client width usually,
        // but checking window width is safer for the breakpoint logic)
        if (window.innerWidth >= 640) return; // sm breakpoint in tailwind is 640px

        const cards = Array.from(grid.children);
        const count = cards.length;

        if (count === 0) return;

        dotsContainer.innerHTML = '';
        for (let i = 0; i < count; i++) {
            const dot = document.createElement('div');
            dot.classList.add('carousel-dot');
            if (i === 0) dot.classList.add('active');
            dotsContainer.appendChild(dot);
        }
    }

    // Initial Dot Setup
    updateDots();

    function startAutoScroll() {
        if (window.innerWidth >= 640) return;

        scrollInterval = setInterval(() => {
            const cards = Array.from(grid.children);
            if (cards.length === 0) return;

            const cardWidth = cards[0].offsetWidth;
            const gap = 24; // gap-6 = 24px
            const scrollAmount = cardWidth + gap;

            // Check if at end
            if (grid.scrollLeft + grid.clientWidth >= grid.scrollWidth - 10) {
                grid.scrollTo({ left: 0, behavior: 'smooth' });
            } else {
                grid.scrollBy({ left: scrollAmount, behavior: 'smooth' });
            }
        }, 3000);
    }

    function stopAutoScroll() {
        clearInterval(scrollInterval);
    }

    // Update Active Dot on Scroll
    grid.addEventListener('scroll', () => {
        if (window.innerWidth >= 640) return;

        const cards = Array.from(grid.children);
        if (cards.length === 0) return;

        const cardWidth = cards[0].offsetWidth;
        // Calculate index based on center point roughly
        const index = Math.round(grid.scrollLeft / cardWidth);

        const dots = document.querySelectorAll('.carousel-dot');
        dots.forEach((dot, i) => {
            if (i === index) dot.classList.add('active');
            else dot.classList.remove('active');
        });
    });

    // Touch interaction pauses auto-scroll
    grid.addEventListener('touchstart', stopAutoScroll);
    grid.addEventListener('touchend', startAutoScroll);

    // Start initially
    startAutoScroll();

    // Handle Resize
    window.addEventListener('resize', () => {
        stopAutoScroll();
        updateDots();
        startAutoScroll();
    });

    // Certificate Modal Functions
    function openCertificateModal(title, imagePath) {
        const modal = document.getElementById('certificateModal');
        const image = document.getElementById('certificateImage');
        const titleElement = document.getElementById('certificateModalTitle');

        image.src = imagePath;
        titleElement.textContent = title;
        modal.classList.remove('hidden');

        // Initialize lucide icons for modal
        lucide.createIcons();

        // Prevent body scroll
        document.body.style.overflow = 'hidden';
    }

    function closeCertificateModal() {
        const modal = document.getElementById('certificateModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside the image
    document.getElementById('certificateModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeCertificateModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeCertificateModal();
        }
    });

</script>

<style>
    /* Carousel Dots */
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
</style>