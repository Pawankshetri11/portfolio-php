@php
    $hero = \App\Models\Hero::first();
@endphp

<!-- 1. HERO SECTION -->
<section id="hero" class="relative z-10 min-h-screen flex items-center justify-center pt-28 pb-8 md:pt-32 md:pb-12 px-6">
    <div class="max-w-[95%] w-full mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        
        <!-- Left: Typography -->
        <div class="text-center lg:text-left space-y-6 md:space-y-8">
            <div data-aos="fade-right" class="inline-flex items-center gap-3 px-4 py-2 rounded-full border border-[#ffd700]/30 bg-[#ffd700]/5 backdrop-blur-md">
                <span class="relative flex h-3 w-3">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#ffd700] opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-3 w-3 bg-[#ffd700]"></span>
                </span>
                <span class="text-[#ffd700] text-xs md:text-sm font-bold tracking-widest uppercase">Available for Hire</span>
            </div>

            <h1 data-aos="fade-up" data-aos-delay="100" class="text-3xl sm:text-4xl md:text-6xl font-display font-bold leading-none tracking-tight text-white">
                {{ $hero->greeting ?? 'Hi, I\'m' }} {{ $hero->first_name ?? 'Pawan' }} {{ $hero->last_name ?? 'Kshetri' }} <br>
                <span class="text-gold-gradient text-xl sm:text-2xl md:text-4xl">{{ $hero->title ?? 'Full Stack &' }}</span>
            </h1>

            <p data-aos="fade-up" data-aos-delay="200" class="text-xs md:text-sm text-zinc-400 leading-relaxed max-w-2xl mx-auto lg:mx-0 font-light">
                {{ $hero->description ?? 'Turning complex datasets into actionable insights, and building robust, scalable web applications from the ground up.' }}
            </p>

            <!-- Social Icons -->
            <div data-aos="fade-up" data-aos-delay="250" class="flex items-center gap-4 justify-center lg:justify-start pb-2">
                <!-- GitHub -->
                @if($hero->github_url)
                <a href="{{ $hero->github_url }}" target="_blank" class="w-12 h-12 flex items-center justify-center rounded-xl border border-white/10 bg-white/5 text-zinc-400 hover:text-[#ffd700] hover:border-[#ffd700]/50 hover:bg-[#ffd700]/5 transition-all duration-300 group">
                    <i data-lucide="github" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                </a>
                @endif

                <!-- LinkedIn -->
                @if($hero->linkedin_url)
                <a href="{{ $hero->linkedin_url }}" target="_blank" class="w-12 h-12 flex items-center justify-center rounded-xl border border-white/10 bg-white/5 text-zinc-400 hover:text-[#ffd700] hover:border-[#ffd700]/50 hover:bg-[#ffd700]/5 transition-all duration-300 group">
                    <i data-lucide="linkedin" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                </a>
                @endif

                <!-- Email -->
                @if($hero->email)
                <a href="mailto:{{ $hero->email }}" class="w-12 h-12 flex items-center justify-center rounded-xl border border-white/10 bg-white/5 text-zinc-400 hover:text-[#ffd700] hover:border-[#ffd700]/50 hover:bg-[#ffd700]/5 transition-all duration-300 group">
                    <i data-lucide="mail" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                </a>
                @endif
            </div>

            <div data-aos="fade-up" data-aos-delay="300" class="flex flex-col sm:flex-row items-center gap-3 md:gap-4 justify-center lg:justify-start pt-2 md:pt-4">
                <!-- Primary Button -->
                <a href="#projects" class="w-full sm:w-auto group relative px-6 py-3 bg-gradient-to-r from-[#ffd700] to-yellow-500 text-black rounded-lg overflow-hidden hover:from-yellow-400 hover:to-[#ffd700] transition-all duration-300 font-bold text-base shadow-[0_0_20px_rgba(255,215,0,0.3)] hover:shadow-[0_0_40px_rgba(255,215,0,0.6)] transform hover:scale-105">
                    <span class="relative flex items-center justify-center gap-2">
                        View Projects <i data-lucide="code" class="w-4 h-4 group-hover:rotate-12 transition-transform"></i>
                    </span>
                </a>
                <!-- Secondary Button -->
                <a href="#contact" class="w-full sm:w-auto px-6 py-3 rounded-lg border-2 border-[#ffd700]/50 bg-transparent text-[#ffd700] hover:bg-[#ffd700] hover:text-black text-base transition-all duration-300 backdrop-blur-sm font-bold shadow-[0_0_10px_rgba(255,215,0,0.2)] hover:shadow-[0_0_25px_rgba(255,215,0,0.5)] transform hover:scale-105">
                    Get In Touch
                </a>
            </div>
        </div>

        <!-- Right: Floating Visuals (Skills Orbit) -->
        <div class="relative h-[400px] md:h-[600px] w-full hidden lg:flex items-center justify-center" data-aos="zoom-in" data-aos-duration="1000">
            <!-- Center Core (Full Stack) -->
            <div class="absolute z-20 w-72 h-80 md:w-80 md:h-96 glass-panel flex flex-col items-center justify-center p-8 animate-float shadow-2xl border-t border-[#ffd700]/50">
                <div class="w-20 h-20 md:w-24 md:h-24 bg-gradient-to-br from-[#ffd700] to-orange-500 rounded-xl flex items-center justify-center mb-6 shadow-xl animate-pulse-glow">
                    <i data-lucide="git-branch" class="w-10 h-10 md:w-12 md:h-12 text-black"></i>
                </div>
                <h3 class="text-2xl md:text-3xl font-display font-bold text-white mb-2">FULL STACK</h3>
                <p class="text-center text-zinc-400 text-sm">React | Python | Node.js | SQL</p>
            </div>

            <!-- Satellite elements - Reduced radius on these too -->
            <div class="absolute top-10 right-0 md:right-10 p-4 md:p-5 glass-panel flex items-center gap-3 md:gap-4 animate-float-delayed z-10 border-l-2 border-yellow-500 bg-black/40">
                <i data-lucide="bar-chart-3" class="w-6 h-6 md:w-8 md:h-8 text-yellow-400"></i>
                <div>
                    <div class="text-sm font-bold text-white">{{ $hero->animation_label_1 ?? 'Data Analysis' }}</div>
                    <div class="text-[10px] md:text-xs text-zinc-500">Python/Pandas</div>
                </div>
            </div>

            <div class="absolute bottom-10 left-0 md:bottom-20 md:left-0 p-4 md:p-5 glass-panel flex items-center gap-3 md:gap-4 animate-float z-30 border-l-2 border-lime-500 bg-black/40" style="animation-duration: 7s;">
                <i data-lucide="monitor" class="w-6 h-6 md:w-8 md:h-8 text-lime-400"></i>
                <div>
                    <div class="text-sm font-bold text-white">{{ $hero->animation_label_2 ?? 'Frontend Dev' }}</div>
                    <div class="text-[10px] md:text-xs text-zinc-500">React & Tailwind</div>
                </div>
            </div>

            <div class="absolute top-20 left-4 md:left-10 p-3 md:p-4 glass-panel flex items-center gap-3 animate-float-reverse z-0 border-l-2 border-red-500 bg-black/30 blur-[1px] hover:blur-0 transition-all duration-300">
                <i data-lucide="database" class="w-5 h-5 md:w-6 md:h-6 text-red-400"></i>
                <div>
                    <div class="text-xs md:text-sm font-bold text-white">{{ $hero->animation_label_4 ?? 'Database Design' }}</div>
                </div>
            </div>

            <div class="absolute bottom-32 right-8 md:right-20 p-3 md:p-4 glass-panel flex items-center gap-3 animate-float-delayed z-30 border-l-2 border-yellow-500 bg-black/40" style="animation-delay: 1.5s;">
                <i data-lucide="server" class="w-5 h-5 md:w-6 md:h-6 text-yellow-400"></i>
                <div>
                    <div class="text-xs md:text-sm font-bold text-white">{{ $hero->animation_label_3 ?? 'API Development' }}</div>
                </div>
            </div>
            
            <!-- Rotating Ring -->
            <div class="absolute w-[400px] h-[400px] md:w-[500px] md:h-[500px] border border-dashed border-white/10 rounded-full animate-spin-slow z-0"></div>
        </div>
    </div>
</section>