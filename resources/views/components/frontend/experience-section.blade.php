<!-- 5. EXPERIENCE SECTION (Single-Company Multi-Role Layout) -->
@props(['experiences' => collect([])])

<section id="experience" class="relative z-10 w-full px-6 py-16 md:py-24">
    <div class="max-w-[95%] mx-auto">
        <div class="text-center mb-12 md:mb-16" data-aos="fade-up">
            <h2 class="text-2xl md:text-5xl font-display font-bold text-white mb-4 md:mb-6">Professional <span class="text-gold-gradient">Experience</span></h2>
            <div class="w-24 h-1 bg-[#ffd700] mx-auto rounded-full"></div>
        </div>

        <!-- Experience Grid - Updated to 3 columns on large screens -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">

            @forelse($experiences->sortByDesc('created_at') as $index => $experience)
            @php
                $all_roles = [];
                if ($experience->position) {
                    $all_roles[] = [
                        'title' => $experience->position,
                        'start_date' => $experience->start_date,
                        'end_date' => $experience->end_date,
                        'description' => ($experience->display_type ?? 'responsibilities') === 'description' ? $experience->description : $experience->responsibilities,
                        'skills' => array_map('trim', explode(',', $experience->technologies ?? '')),
                        'display_type' => $experience->display_type ?? 'responsibilities'
                    ];
                }
                if (is_array($experience->roles)) {
                    $all_roles = array_merge($all_roles, $experience->roles);
                }
            @endphp

            @if(count($all_roles) > 1)
            <!-- MULTI-ROLE CARD -->
            <div class="glass-panel p-6 md:p-8 transform transition-all duration-300 hover:border-[#ffd700]" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <!-- Company Header -->
                <div class="flex gap-5 items-center mb-8 pb-6 border-b border-white/10">
                    <div class="flex-shrink-0 w-16 h-16 bg-zinc-800 rounded-xl flex items-center justify-center border border-zinc-700 text-2xl font-bold text-[#ffd700]">
                        {{ substr($experience->company, 0, 2) }}
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-white">{{ $experience->company }}</h3>
                        <p class="text-zinc-400 text-sm">{{ $experience->location ?? 'Remote' }}</p>
                    </div>
                </div>

                <div class="relative pl-4 md:pl-6 space-y-10">
                    <!-- Vertical Connector Line -->
                    <div class="absolute left-0 md:left-1 top-2 bottom-2 w-0.5 bg-white/10"></div>

                    @foreach($all_roles as $roleIndex => $role)
                    <!-- Role {{ $roleIndex + 1 }} -->
                    <div class="relative">
                        <!-- Timeline Dot -->
                        <div class="absolute -left-[21px] md:-left-[28px] top-1.5 w-3 h-3 rounded-full {{ $roleIndex === 0 ? 'bg-[#ffd700] shadow-[0_0_10px_#ffd700]' : 'bg-zinc-600 border-2 border-zinc-800' }}"></div>

                        <div class="flex flex-col justify-between items-start mb-2">
                            <h4 class="text-lg font-bold text-white">{{ $role['title'] }}</h4>
                            <span class="text-xs font-mono text-[#ffd700] bg-[#ffd700]/10 px-2 py-1 rounded border border-[#ffd700]/20 mt-1">
                                {{ \Carbon\Carbon::parse($role['start_date'])->format('M Y') }} - {{ isset($role['end_date']) && $role['end_date'] ? \Carbon\Carbon::parse($role['end_date'])->format('M Y') : 'Present' }}
                            </span>
                        </div>

                        <div class="space-y-3">
                            @if(($role['display_type'] ?? 'responsibilities') === 'responsibilities')
                                <div>
                                    <h5 class="text-xs font-bold text-zinc-500 uppercase tracking-wider mb-2">Key Responsibilities:</h5>
                                    <ul class="list-disc list-inside text-zinc-300 text-xs space-y-1 marker:text-[#ffd700]">
                                        @foreach(explode("\n", $role['description'] ?? '') as $responsibility)
                                            @if(trim($responsibility))
                                                <li>{{ trim($responsibility) }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <p class="text-zinc-300 text-xs leading-relaxed">
                                    {{ $role['description'] }}
                                </p>
                            @endif
                            @if(!empty($role['skills']))
                            <div>
                                <h5 class="text-xs font-bold text-zinc-500 uppercase tracking-wider mb-2">Skills:</h5>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($role['skills'] as $skill)
                                    @if(trim($skill))
                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-[#ffd700]/10 text-[#ffd700] border border-[#ffd700]/20">{{ trim($skill) }}</span>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @elseif(count($all_roles) === 1)
            @php $role = $all_roles[0]; @endphp
            <!-- SINGLE ROLE CARD -->
            <div class="glass-panel p-6 md:p-8 transform transition-all duration-300 hover:border-[#ffd700]" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <div class="flex gap-5 items-start mb-6">
                    <div class="flex-shrink-0 w-14 h-14 bg-zinc-800 rounded-xl flex items-center justify-center border border-zinc-700 text-2xl font-bold text-[#ffd700]">
                        {{ substr($experience->company, 0, 2) }}
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-white">{{ $role['title'] }}</h3>
                        <p class="text-[#ffd700] font-medium text-sm">{{ $experience->company }}</p>
                        <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-3 text-xs text-zinc-500 mt-1 font-mono">
                            <span><i data-lucide="calendar" class="inline w-3 h-3 mr-1"></i>{{ \Carbon\Carbon::parse($role['start_date'])->format('M Y') }} - {{ isset($role['end_date']) && $role['end_date'] ? \Carbon\Carbon::parse($role['end_date'])->format('M Y') : 'Present' }}</span>
                            <span><i data-lucide="map-pin" class="inline w-3 h-3 mr-1"></i>{{ $experience->location ?? 'Remote' }}</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    @if(($role['display_type'] ?? 'responsibilities') === 'responsibilities')
                        <div>
                            <h4 class="text-sm font-bold text-white mb-2">Key Responsibilities:</h4>
                            <ul class="list-disc list-inside text-zinc-400 text-sm space-y-1 marker:text-[#ffd700]">
                                @foreach(explode("\n", $role['description'] ?? '') as $responsibility)
                                    @if(trim($responsibility))
                                        <li>{{ trim($responsibility) }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div>
                            <h4 class="text-sm font-bold text-white mb-2">Description:</h4>
                            <p class="text-zinc-400 text-sm leading-relaxed">{{ $role['description'] }}</p>
                        </div>
                    @endif

                    @if(!empty($role['skills']))
                    <div>
                        <h4 class="text-sm font-bold text-white mb-2">Skills Developed:</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($role['skills'] as $tech)
                                @if(trim($tech))
                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-[#ffd700]/10 text-[#ffd700] border border-[#ffd700]/20">{{ trim($tech) }}</span>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif
            @empty
            <!-- Job 1: Capital Street FX (Standard Card) -->
            <div class="glass-panel p-6 md:p-8 transform transition-all duration-300 hover:border-[#ffd700]" data-aos="fade-up">
                <div class="flex gap-5 items-start mb-6">
                    <div class="flex-shrink-0 w-14 h-14 bg-zinc-800 rounded-xl flex items-center justify-center border border-zinc-700 text-2xl font-bold text-[#ffd700]">
                        CS
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-white">Wordpress Developer</h3>
                        <p class="text-[#ffd700] font-medium text-sm">Capital Street FX</p>
                        <div class="flex items-center gap-3 text-xs text-zinc-500 mt-1 font-mono">
                            <span><i data-lucide="calendar" class="inline w-3 h-3 mr-1"></i>Aug 2025 - Present</span>
                            <span><i data-lucide="map-pin" class="inline w-3 h-3 mr-1"></i>Remote</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <h4 class="text-sm font-bold text-white mb-2">Key Responsibilities:</h4>
                        <ul class="list-disc list-inside text-zinc-400 text-sm space-y-1 marker:text-[#ffd700]">
                            <li>Converted complex PSD designs into fully functional, responsive WordPress themes.</li>
                            <li>Optimized website performance, achieving a 95+ Google PageSpeed score.</li>
                            <li>Managed plugin integrations and custom PHP functionality.</li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-sm font-bold text-white mb-2">Skills Developed:</h4>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-[#ffd700]/10 text-[#ffd700] border border-[#ffd700]/20">Wordpress</span>
                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-[#ffd700]/10 text-[#ffd700] border border-[#ffd700]/20">PHP</span>
                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-[#ffd700]/10 text-[#ffd700] border border-[#ffd700]/20">CSS3</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Job 2: White Key Pro (Standard Card) -->
            <div class="glass-panel p-8 transform transition-all duration-300 hover:border-[#ffd700]" data-aos="fade-up" data-aos-delay="100">
                <div class="flex gap-5 items-start mb-6">
                    <div class="flex-shrink-0 w-14 h-14 bg-zinc-800 rounded-xl flex items-center justify-center border border-zinc-700 text-2xl font-bold text-[#ffd700]">
                        WK
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-white">WordPress & Shopify Developer</h3>
                        <p class="text-[#ffd700] font-medium text-sm">White Key Pro Commercio</p>
                        <div class="flex items-center gap-3 text-xs text-zinc-500 mt-1 font-mono">
                            <span><i data-lucide="calendar" class="inline w-3 h-3 mr-1"></i>Jun 2025 - Aug 2025</span>
                            <span><i data-lucide="map-pin" class="inline w-3 h-3 mr-1"></i>On-site</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <h4 class="text-sm font-bold text-white mb-2">Key Responsibilities:</h4>
                        <ul class="list-disc list-inside text-zinc-400 text-sm space-y-1 marker:text-[#ffd700]">
                            <li>Developed custom Shopify themes and managed e-commerce product catalogs.</li>
                            <li>Collaborated with design teams to implement pixel-perfect UI components.</li>
                            <li>Maintained legacy WordPress sites and implemented security patches.</li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-sm font-bold text-white mb-2">Skills Developed:</h4>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-[#ffd700]/10 text-[#ffd700] border border-[#ffd700]/20">Shopify Liquid</span>
                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-[#ffd700]/10 text-[#ffd700] border border-[#ffd700]/20">E-commerce</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Job 3: Dev To Dsa (MULTI-ROLE CARD) -->
            <div class="glass-panel p-8 transform transition-all duration-300 hover:border-[#ffd700]" data-aos="fade-up" data-aos-delay="200">
                <!-- Company Header -->
                <div class="flex gap-5 items-center mb-8 pb-6 border-b border-white/10">
                    <div class="flex-shrink-0 w-16 h-16 bg-zinc-800 rounded-xl flex items-center justify-center border border-zinc-700 text-2xl font-bold text-[#ffd700]">
                        DD
                    </div>
                    <div>
                        <h3 class="text-xl font-display font-bold text-white">Dev To Dsa</h3>
                        <p class="text-zinc-400 text-sm">EdTech Startup · Full-time</p>
                    </div>
                </div>

                <div class="relative pl-4 md:pl-6 space-y-10">
                    <!-- Vertical Connector Line -->
                    <div class="absolute left-0 md:left-1 top-2 bottom-2 w-0.5 bg-white/10"></div>

                    <!-- Role 1: COO -->
                    <div class="relative">
                        <!-- Timeline Dot -->
                        <div class="absolute -left-[21px] md:-left-[28px] top-1.5 w-3 h-3 rounded-full bg-[#ffd700] shadow-[0_0_10px_#ffd700]"></div>

                        <div class="flex flex-col justify-between items-start mb-2">
                            <h4 class="text-lg font-bold text-white">Chief Operating Officer</h4>
                            <span class="text-xs font-mono text-[#ffd700] bg-[#ffd700]/10 px-2 py-1 rounded border border-[#ffd700]/20 mt-1">Feb 2025 - Jun 2025</span>
                        </div>

                        <div class="space-y-3">
                            <p class="text-zinc-300 text-xs leading-relaxed">
                                Led daily operations and strategic planning, scaling the platform to over 5,000 active users.
                            </p>
                            <div>
                                <h5 class="text-xs font-bold text-zinc-500 uppercase tracking-wider mb-2">Skills:</h5>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-2 py-0.5 text-[10px] font-medium rounded-full bg-zinc-800 text-zinc-300 border border-zinc-700">Operations</span>
                                    <span class="px-2 py-0.5 text-[10px] font-medium rounded-full bg-zinc-800 text-zinc-300 border border-zinc-700">Strategy</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Role 2: Co-Founder -->
                    <div class="relative">
                        <!-- Timeline Dot -->
                        <div class="absolute -left-[21px] md:-left-[28px] top-1.5 w-3 h-3 rounded-full bg-zinc-600 border-2 border-zinc-800"></div>

                        <div class="flex flex-col justify-between items-start mb-2">
                            <h4 class="text-lg font-bold text-white">Co-Founder</h4>
                            <span class="text-xs font-mono text-zinc-500 mt-1">Jan 2025 - May 2025</span>
                        </div>

                        <div class="space-y-3">
                            <p class="text-zinc-300 text-xs leading-relaxed">
                                Conceptualized the platform vision and developed the initial MVP. Focused on early-stage product market fit.
                            </p>
                            <div>
                                <h5 class="text-xs font-bold text-zinc-500 uppercase tracking-wider mb-2">Skills:</h5>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-2 py-0.5 text-[10px] font-medium rounded-full bg-zinc-800 text-zinc-300 border border-zinc-700">Product</span>
                                    <span class="px-2 py-0.5 text-[10px] font-medium rounded-full bg-zinc-800 text-zinc-300 border border-zinc-700">Startup</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @endforelse

        </div>
    </div>
</section></parameter>
</xai:function_call>