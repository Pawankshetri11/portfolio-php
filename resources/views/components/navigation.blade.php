<!-- Sticky Navigation Bar -->
<header class="sticky-header fixed top-0 left-0 right-0 z-50">
    <div class="max-w-[95%] mx-auto px-4 sm:px-6 py-4 flex justify-between items-center">
        <a href="#hero" class="text-2xl font-display font-bold text-white hover:text-[#ffd700] transition-colors relative group">
            Pawan Kshetri
            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#ffd700] transition-all group-hover:w-full"></span>
        </a>
        
        <!-- Desktop Navigation -->
        <nav class="hidden lg:flex space-x-8">
            <a href="#about" class="text-zinc-400 hover:text-white transition-colors text-sm font-medium">About</a>
            <a href="#skills" class="text-zinc-400 hover:text-white transition-colors text-sm font-medium">Skills</a>
            <a href="#experience" class="text-zinc-400 hover:text-white transition-colors text-sm font-medium">Experience</a>
            <a href="#education" class="text-zinc-400 hover:text-white transition-colors text-sm font-medium">Education</a>
            <a href="#certifications" class="text-zinc-400 hover:text-white transition-colors text-sm font-medium">Certifications</a>
            <a href="#projects" class="text-zinc-400 hover:text-white transition-colors text-sm font-medium">Projects</a>
            <a href="#contact" class="text-zinc-400 hover:text-white transition-colors text-sm font-medium">Contact</a>
        </nav>

        <!-- Resume Button -->
        <div class="flex items-center gap-4">
            @auth
                <a href="{{ route('admin.index') }}" class="hidden sm:inline-flex items-center gap-2 px-4 py-2 border border-[#ffd700] text-[#ffd700] font-bold rounded-lg hover:bg-[#ffd700] hover:text-black transition-all text-sm shadow-[0_0_10px_rgba(255,215,0,0.1)] hover:shadow-[0_0_20px_rgba(255,215,0,0.4)]">
                    <i data-lucide="shield" class="w-4 h-4"></i>
                    Admin
                </a>
            @else
                <a href="{{ route('login') }}" class="hidden sm:inline-flex items-center gap-2 px-4 py-2 border border-[#ffd700] text-[#ffd700] font-bold rounded-lg hover:bg-[#ffd700] hover:text-black transition-all text-sm shadow-[0_0_10px_rgba(255,215,0,0.1)] hover:shadow-[0_0_20px_rgba(255,215,0,0.4)]">
                    Login
                </a>
            @endauth
        </div>

        <!-- Mobile Menu Toggle -->
        <button class="lg:hidden text-white hover:text-[#ffd700] transition-colors">
             <i data-lucide="menu" class="w-6 h-6"></i>
        </button>
    </div>
</header>