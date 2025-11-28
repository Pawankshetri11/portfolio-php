<!-- Navbar -->
<header id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 py-3 md:py-5 border-b border-transparent">
    <div class="max-w-[95%] mx-auto px-4 sm:px-6 flex justify-between items-center">

        <!-- Improved Logo -->
        <a href="/" class="flex items-center gap-1 md:gap-3 group relative z-50 animate-fade-in-down" style="animation-delay: 0ms;">
            <!-- Logo Symbol -->
            <div class="relative w-6 h-6 md:w-10 md:h-10 flex items-center justify-center">
                <div class="absolute inset-0 bg-gradient-to-tr from-gold-400 to-yellow-600 rounded-xl rotate-45 group-hover:rotate-90 transition-transform duration-500 opacity-20 group-hover:opacity-40"></div>
                <div class="absolute inset-0 border-2 border-gold-400/30 rounded-xl rotate-45 group-hover:rotate-90 transition-transform duration-500"></div>
                <span class="text-gold-400 font-display font-bold text-sm md:text-xl relative z-10 group-hover:scale-110 transition-transform">P</span>
            </div>
            <!-- Logo Text -->
            <div class="flex flex-col leading-none">
                <span class="text-sm md:text-lg font-display font-bold text-white tracking-wide group-hover:text-gold-400 transition-colors">PAWAN</span>
                <span class="text-[8px] md:text-[10px] text-zinc-500 font-mono uppercase tracking-widest group-hover:text-white transition-colors">Kshetri</span>
            </div>
        </a>

        <!-- Desktop Navigation -->
        <nav class="hidden lg:flex items-center space-x-6 md:space-x-8 animate-fade-in-down" style="animation-delay: 100ms;">
            <a href="{{ url('/#hero') }}" class="nav-link">Home</a>
            <a href="{{ url('/#experience') }}" class="nav-link">Experience</a>
            <a href="{{ url('/#education') }}" class="nav-link">Education</a>
            <a href="{{ url('/#certifications') }}" class="nav-link">Certifications</a>
            <a href="{{ url('/projects') }}" class="nav-link">Projects</a>
            <a href="{{ url('/#contact') }}" class="nav-link">Contact</a>
            @auth
                <a href="{{ route('admin.index') }}" class="nav-link flex items-center gap-2">
                    <i data-lucide="shield" class="w-4 h-4"></i>
                    Admin
                </a>
            @endauth
        </nav>

        <!-- Right Side: Actions -->
        <div class="hidden lg:flex items-center gap-4 animate-fade-in-down" style="animation-delay: 200ms;">
            <!-- Resume Button (Outline Style + Icon) -->
            <a href="#" target="_blank" class="btn-outline-gold px-6 py-2 rounded-lg text-sm tracking-wide">
                Resume <i data-lucide="download" class="w-4 h-4"></i>
            </a>
        </div>

        <!-- Mobile Menu Button -->
        <button id="mobileMenuBtn" class="lg:hidden text-white p-2 focus:outline-none z-50 relative group">
            <i data-lucide="menu" class="w-7 h-7 group-hover:text-gold-400 transition-colors"></i>
        </button>
    </div>
</header>

<!-- Mobile Menu Overlay -->
<div id="mobileMenu" class="fixed inset-0 z-40 hidden">
    <!-- Backdrop -->
    <div id="mobileBackdrop" class="absolute inset-0 bg-black/80 backdrop-blur-sm opacity-0"></div>

    <!-- Drawer -->
    <div id="mobileDrawer" class="absolute right-0 top-0 bottom-0 w-[75%] max-w-[280px] bg-royal-900 border-l border-white/10 shadow-2xl flex flex-col">
        <div class="p-6 pt-24 flex flex-col h-full overflow-y-auto">

            <!-- Mobile Links -->
            <div class="space-y-2 mb-8">
                <a href="{{ url('/#hero') }}" class="block py-3 text-lg text-zinc-300 hover:text-white border-b border-white/5">Home</a>
                <a href="{{ url('/#experience') }}" class="block py-3 text-lg text-zinc-300 hover:text-white border-b border-white/5">Experience</a>
                <a href="{{ url('/#education') }}" class="block py-3 text-lg text-zinc-300 hover:text-white border-b border-white/5">Education</a>
                <a href="{{ url('/#certifications') }}" class="block py-3 text-lg text-zinc-300 hover:text-white border-b border-white/5">Certifications</a>
                <a href="{{ url('/projects') }}" class="block py-3 text-lg text-zinc-300 hover:text-white border-b border-white/5">Projects</a>
                <a href="{{ url('/#contact') }}" class="block py-3 text-lg text-zinc-300 hover:text-white border-b border-white/5">Contact</a>
                @auth
                    <a href="{{ route('admin.index') }}" class="block py-3 text-lg text-zinc-300 hover:text-white border-b border-white/5 flex items-center gap-2">
                        <i data-lucide="shield" class="w-4 h-4"></i>
                        Admin
                    </a>
                @endauth
            </div>

            <!-- Mobile Resume -->
            <div class="mt-auto space-y-4">
                <a href="#" class="w-full btn-gold px-5 py-3 rounded-lg text-center block flex items-center justify-center gap-2">
                    Resume <i data-lucide="download" class="w-4 h-4"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    /* Sticky Header State */
    .header-scrolled {
        background: rgba(2, 2, 2, 0.85);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }

    /* Nav Link Styles */
    .nav-link {
        position: relative;
        color: #a1a1aa;
        transition: color 0.3s ease;
        font-weight: 500;
        font-size: 0.95rem;
    }
    .nav-link:hover { color: white; }

    /* Animated Underline */
    .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -4px;
        left: 0;
        background: linear-gradient(90deg, #ffd700, #ffed4e);
        transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 0 8px rgba(255, 215, 0, 0.5);
    }
    .nav-link:hover::after { width: 100%; }

    /* Gold Text Gradient */
    .text-gold-gradient {
        background: linear-gradient(45deg, #ffd700, #ffed4e);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Gold Button Shimmer (Solid) - Kept for mobile if needed */
    .btn-gold {
        background: linear-gradient(45deg, #ffd700, #ffed4e, #ffd700);
        background-size: 200% auto;
        color: black;
        font-weight: 600;
        transition: all 0.3s ease;
        animation: shimmer 3s linear infinite;
    }
    .btn-gold:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px -5px rgba(255, 215, 0, 0.4);
    }

    /* Outline Gold Button (New Style) */
    .btn-outline-gold {
        border: 1px solid #ffd700;
        color: #ffd700;
        background: transparent;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-outline-gold:hover {
        background: #ffd700;
        color: #000000;
        box-shadow: 0 0 20px rgba(255, 215, 0, 0.4);
        transform: translateY(-2px);
    }

    /* Mobile Drawer */
    #mobileDrawer {
        transform: translateX(100%);
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    #mobileDrawer.open {
        transform: translateX(0);
    }
    #mobileBackdrop {
        pointer-events: none;
        transition: opacity 0.3s ease;
    }
    #mobileBackdrop.open {
        opacity: 1;
        pointer-events: auto;
    }

    @keyframes shimmer {
        0% { background-position: -200% center; }
        100% { background-position: 200% center; }
    }
</style>

<script>
    // --- 1. Sticky Header Logic ---
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 20) {
            navbar.classList.add('header-scrolled');
        } else {
            navbar.classList.remove('header-scrolled');
        }
    });

    // --- 2. Mobile Menu Logic ---
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileBackdrop = document.getElementById('mobileBackdrop');
    const mobileDrawer = document.getElementById('mobileDrawer');
    let isMenuOpen = false;

    function toggleMenu() {
        isMenuOpen = !isMenuOpen;
        if (isMenuOpen) {
            mobileMenu.classList.remove('hidden');
            setTimeout(() => {
                mobileBackdrop.classList.add('open');
                mobileDrawer.classList.add('open');
            }, 10);
        } else {
            mobileBackdrop.classList.remove('open');
            mobileDrawer.classList.remove('open');
            setTimeout(() => {
                mobileMenu.classList.add('hidden');
            }, 300);
        }
    }

    mobileMenuBtn.addEventListener('click', toggleMenu);
    mobileBackdrop.addEventListener('click', toggleMenu);
</script>