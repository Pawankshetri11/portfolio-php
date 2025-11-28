<!-- 6. EDUCATION SECTION -->
@props(['educations' => collect([])])

<section id="education" class="relative z-10 w-full px-6">
    <div class="max-w-[95%] mx-auto">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl md:text-5xl font-display font-bold text-white mb-4">Academic <span class="text-gold-gradient">Education</span></h2>
            <p class="text-zinc-400 max-w-2xl mx-auto">The academic foundation that drives my technical expertise.</p>
        </div>

        @php $educationCount = $educations->count(); @endphp
        <div class="{{ $educationCount <= 2 ? 'flex flex-wrap justify-center gap-8' : 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8' }}">

            @forelse($educations->sortByDesc('start_date') as $index => $education)
            <!-- Edu Card -->
            <div class="glass-panel p-8 relative overflow-hidden group {{ $educationCount <= 2 ? 'w-[38%]' : '' }}" data-aos="fade-right" data-aos-delay="{{ $index * 100 }}">
                <!-- Background Decoration -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#ffd700]/5 rounded-bl-[100px] -mr-8 -mt-8 transition-all duration-500 group-hover:bg-[#ffd700]/10"></div>

                <div class="relative z-10 flex flex-col sm:flex-row items-start gap-6">
                    <!-- Icon Box -->
                    <div class="w-16 h-16 flex-shrink-0 bg-[#ffd700]/10 rounded-2xl flex items-center justify-center border border-[#ffd700]/20 shadow-[0_0_15px_rgba(255,215,0,0.1)] group-hover:scale-110 transition-transform duration-300">
                        <i data-lucide="graduation-cap" class="w-8 h-8 text-[#ffd700]"></i>
                    </div>

                    <div class="flex-grow">
                        <div class="flex flex-wrap justify-between items-center gap-2 mb-2">
                            <span class="px-3 py-1 text-xs font-bold text-black bg-[#ffd700] rounded-full shadow-[0_0_10px_rgba(255,215,0,0.4)]">
                                @if($education->is_present)
                                    {{ $education->start_date?->format('M Y') }} – Present
                                @else
                                    {{ $education->start_date?->format('M Y') }} – {{ $education->end_date?->format('M Y') }}
                                @endif
                            </span>
                            <span class="text-xs text-zinc-500 font-mono flex items-center gap-1">
                                <i data-lucide="map-pin" class="w-3 h-3"></i> {{ $education->location ?? 'Dehradun, IN' }}
                            </span>
                        </div>

                        <h3 class="text-xl font-display font-bold text-white mb-1 group-hover:text-[#ffd700] transition-colors">{{ $education->degree }}</h3>
                        <p class="text-zinc-300 text-base font-medium">{{ $education->institution }}</p>

                        <div class="mt-4 pt-4 border-t border-white/10">
                            <p class="text-zinc-400 text-sm leading-relaxed">
                                {{ $education->description ?? 'Focusing on advanced Computer Applications and software development methodologies.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <!-- No education entries found -->
            <div class="col-span-full text-center py-12">
                <i data-lucide="graduation-cap" class="w-16 h-16 text-zinc-600 mx-auto mb-4"></i>
                <p class="text-zinc-500">No education entries found. Add some from the admin panel.</p>
            </div>
            @endforelse

        </div>
    </div>
</section>