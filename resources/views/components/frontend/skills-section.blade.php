<!-- 4. TECHNICAL SKILLS -->
<section id="skills" class="relative z-10 py-12 md:py-24 px-6">
    <div class="max-w-[95%] mx-auto">
        <div class="text-center mb-12 md:mb-16" data-aos="fade-up">
            <h2 class="text-2xl md:text-5xl font-display font-bold text-white mb-4 md:mb-6">Technical <span class="text-gold-gradient">Skills</span></h2>
            <p class="text-zinc-400 max-w-2xl mx-auto">A comprehensive toolkit for data analysis, visualization, and building full-stack applications.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-8">
            @forelse($skillCategories as $index => $category)
            <div data-aos="fade-up" data-aos-delay="{{ $index * 100 }}" class="glass-panel p-4 md:p-6">
                <div class="flex items-center gap-3 mb-3 md:mb-4">
                    <i data-lucide="{{ $category->icon ?? 'layers' }}" class="w-5 h-5 md:w-6 md:h-6 text-[#ffd700]"></i>
                    <h3 class="text-base md:text-lg font-display font-bold text-white">{{ $category->name }}</h3>
                </div>
                <ul class="space-y-2 md:space-y-3">
                    @forelse($category->skills as $skill)
                        <li class="flex items-center gap-2 md:gap-3 py-2">
                            <div class="w-6 h-6 md:w-8 md:h-8 bg-zinc-800 rounded flex items-center justify-center">
                                @if($skill->logo)
                                    <img src="{{ asset('storage/' . $skill->logo) }}" alt="{{ $skill->name }}" class="w-3 h-3 md:w-4 md:h-4 object-contain">
                                @else
                                    <i data-lucide="code" class="w-3 h-3 md:w-4 md:h-4 text-zinc-400"></i>
                                @endif
                            </div>
                            <span class="text-xs md:text-sm text-zinc-300">{{ $skill->name }}</span>
                        </li>
                    @empty
                        <li class="text-sm text-zinc-500 italic">No skills in this category yet</li>
                    @endforelse
                </ul>
            </div>
            @empty
            <div class="col-span-full text-center py-8 md:py-12">
                <i data-lucide="zap" class="w-12 h-12 md:w-16 md:h-16 mx-auto mb-4 text-zinc-600"></i>
                <h3 class="text-lg md:text-xl font-display font-bold text-white mb-2">No Skills Added Yet</h3>
                <p class="text-sm md:text-base text-zinc-400">Skills will appear here once added through the admin panel.</p>
            </div>
            @endforelse
        </div>

    </div>
</section>