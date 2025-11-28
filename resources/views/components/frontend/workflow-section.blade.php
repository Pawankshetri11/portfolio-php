<!-- 3. WORKFLOW -->
<section class="relative z-10 py-20 px-6">
    <div class="max-w-[95%] mx-auto" data-aos="fade-up">
        <div class="glass-panel p-8 md:p-12 relative overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center relative z-10">

                <!-- Left: Process Visual -->
                <div class="relative h-48 md:h-64 w-full bg-black/40 rounded-lg border border-white/5 flex flex-col items-center justify-center overflow-hidden">
                    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-10"></div>

                    <div class="relative z-10 flex items-center gap-2 md:gap-4">
                        <div class="flex flex-col items-center">
                            <div class="w-10 h-10 md:w-12 md:h-12 rounded-lg bg-yellow-500/10 border border-yellow-500/20 flex items-center justify-center text-yellow-400">
                                <i data-lucide="database" class="w-5 h-5 md:w-6 md:h-6"></i>
                            </div>
                            <span class="text-[8px] md:text-[10px] text-yellow-400 mt-1 md:mt-2">RAW DATA</span>
                        </div>

                        <div class="flex flex-col items-center gap-1">
                            <div class="w-16 h-1 md:w-24 bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-pink-500 animate-process w-1/2"></div>
                            </div>
                            <span class="text-[6px] md:text-[8px] text-pink-500 uppercase tracking-widest font-mono">Development</span>
                        </div>

                        <div class="flex flex-col items-center">
                            <div class="w-10 h-10 md:w-12 md:h-12 rounded-lg bg-[#ffd700]/10 border border-[#ffd700]/20 flex items-center justify-center text-[#ffd700] shadow-[0_0_15px_rgba(255,215,0,0.2)]">
                                <i data-lucide="layers-3" class="w-5 h-5 md:w-6 md:h-6"></i>
                            </div>
                            <span class="text-[8px] md:text-[10px] text-[#ffd700] mt-1 md:mt-2">DEPLOYED APP</span>
                        </div>
                    </div>

                    <div class="absolute bottom-2 md:bottom-4 text-center w-full">
                        <p class="text-[10px] md:text-xs text-zinc-600 font-mono">Status: <span class="text-green-500">CI/CD Pipeline Complete</span></p>
                    </div>
                </div>

                <!-- Right: Text Content -->
                <div class="space-y-4 md:space-y-6 text-center md:text-left">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-yellow-500/10 border border-yellow-500/20 text-yellow-400 text-xs font-mono tracking-widest uppercase">
                        <span class="w-2 h-2 rounded-full bg-yellow-500 animate-pulse"></span> About Me
                    </div>
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-display font-bold text-white leading-tight">
                        Passionate <span class="text-gold-gradient">Developer</span> & Analyst
                    </h2>
                    <p class="text-zinc-400 leading-relaxed text-xs md:text-sm lg:text-base">
                        Namaste! I'm Pawan Kshetri, specializing in end-to-end data-driven applications. My passion lies in extracting meaningful signals from noisy datasets and translating them into robust, user-friendly software experiences. With hands-on experience, I thrive on tackling technical challenges across the full stack.
                    </p>

                    <div class="grid grid-cols-2 gap-3 md:gap-4 pt-2">
                        <div class="flex items-center gap-2 md:gap-3 p-2 md:p-3 rounded-lg bg-white/5 border border-white/5">
                            <i data-lucide="wrench" class="w-4 h-4 md:w-5 md:h-5 text-[#ffd700]"></i>
                            <div class="text-left">
                                <div class="text-white font-bold text-xs md:text-sm">Clean Code</div>
                                <div class="text-[8px] md:text-[10px] text-zinc-500">Maintainable & Tested</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 md:gap-3 p-2 md:p-3 rounded-lg bg-white/5 border border-white/5">
                            <i data-lucide="sigma" class="w-4 h-4 md:w-5 md:h-5 text-[#ffd700]"></i>
                            <div class="text-left">
                                <div class="text-white font-bold text-xs md:text-sm">Statistical Rigor</div>
                                <div class="text-[8px] md:text-[10px] text-zinc-500">Meaningful Insights</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Satellite elements - Mobile responsive -->
            <div class="absolute top-6 right-2 md:top-10 md:right-10 p-2 md:p-5 glass-panel flex items-center gap-2 md:gap-4 animate-float-delayed z-10 border-l-2 border-yellow-500 bg-black/40">
                <i data-lucide="bar-chart-3" class="w-4 h-4 md:w-8 md:h-8 text-yellow-400"></i>
                <div class="hidden md:block">
                    <div class="text-sm font-bold text-white">Data Analysis</div>
                    <div class="text-xs text-zinc-500">Python/Pandas</div>
                </div>
            </div>

            <div class="absolute bottom-6 left-2 md:bottom-20 md:left-0 p-2 md:p-5 glass-panel flex items-center gap-2 md:gap-4 animate-float z-30 border-l-2 border-lime-500 bg-black/40" style="animation-duration: 7s;">
                <i data-lucide="monitor" class="w-4 h-4 md:w-8 md:h-8 text-lime-400"></i>
                <div class="hidden md:block">
                    <div class="text-sm font-bold text-white">Frontend Dev</div>
                    <div class="text-xs text-zinc-500">React & Tailwind</div>
                </div>
            </div>

            <div class="absolute top-12 left-2 md:left-10 p-2 md:p-4 glass-panel flex items-center gap-2 animate-float-reverse z-0 border-l-2 border-red-500 bg-black/30 blur-[1px] hover:blur-0 transition-all duration-300">
                <i data-lucide="database" class="w-4 h-4 md:w-6 md:h-6 text-red-400"></i>
                <div class="hidden md:block">
                    <div class="text-xs md:text-sm font-bold text-white">Database Design</div>
                </div>
            </div>

            <div class="absolute bottom-16 right-2 md:bottom-32 md:right-20 p-2 md:p-4 glass-panel flex items-center gap-2 animate-float-delayed z-30 border-l-2 border-yellow-500 bg-black/40" style="animation-delay: 1.5s;">
                <i data-lucide="server" class="w-4 h-4 md:w-6 md:h-6 text-yellow-400"></i>
                <div class="hidden md:block">
                    <div class="text-xs md:text-sm font-bold text-white">API Development</div>
                </div>
            </div>
        </div>
    </div>
</section>