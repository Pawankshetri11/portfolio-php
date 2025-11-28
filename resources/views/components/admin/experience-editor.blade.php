<!-- 3. EXPERIENCE SECTION EDITOR (Hidden) -->
@php
    $experiences = App\Models\Experience::orderBy('start_date', 'desc')->get();
@endphp
<div id="experience-section" class="space-y-8 max-w-5xl mx-auto hidden pb-20">

    <div class="flex justify-end">
        <button onclick="openExperienceModal()" class="border border-gold-400 text-gold-400 hover:bg-gold-400 hover:text-black font-medium px-4 py-2 rounded-lg text-sm transition-colors flex items-center gap-2">
            <i data-lucide="plus" class="w-4 h-4"></i> Add New Experience
        </button>
    </div>

    <!-- Existing Experience List -->
    <div class="space-y-6">
        @forelse($experiences as $experience)
        <!-- Job Item -->
        <div class="admin-card group relative border-l-4 border-l-gold-400">
            <div class="absolute top-4 right-4 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity z-10">
                <button onclick="openExperienceModal({{ $experience->id }})" class="p-1.5 bg-black/50 rounded text-white hover:text-gold-400" title="Edit Experience"><i data-lucide="pencil" class="w-4 h-4"></i></button>
                <button onclick="deleteExperience({{ $experience->id }})" class="p-1.5 bg-black/50 rounded text-red-400 hover:bg-red-900/20" title="Delete Experience"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
            </div>

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

            @if(count($all_roles) > 0)
                <!-- Multi-Role Company Header -->
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

                    @foreach($all_roles as $index => $role)
                    <!-- Role {{ $index + 1 }} -->
                    <div class="relative">
                        <!-- Timeline Dot -->
                        <div class="absolute -left-[21px] md:-left-[28px] top-1.5 w-3 h-3 rounded-full {{ $index === 0 ? 'bg-[#ffd700] shadow-[0_0_10px_#ffd700]' : 'bg-zinc-600 border-2 border-zinc-800' }}"></div>

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
                                    <span class="px-2 py-0.5 text-[10px] font-medium rounded-full bg-zinc-800 text-zinc-300 border border-zinc-700">{{ $skill }}</span>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <!-- Company without roles -->
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-zinc-800 rounded flex-shrink-0 flex items-center justify-center font-bold text-gold-400 text-lg">{{ substr($experience->company, 0, 2) }}</div>
                    <div>
                        <h4 class="text-white font-bold text-lg">{{ $experience->company }}</h4>
                        <p class="text-sm text-zinc-500">{{ $experience->location ?? 'Remote' }}</p>
                    </div>
                </div>
            @endif

            <button onclick="addRoleToExperience({{ $experience->id }})" class="w-full mt-6 py-2 border border-dashed border-zinc-700 text-zinc-500 hover:text-white hover:border-zinc-500 text-xs rounded transition-colors">
                + Add Another Role to {{ $experience->company }}
            </button>
        </div>
        @empty
        <p class="text-zinc-500 text-center py-8">No experiences found. <button onclick="openExperienceModal()" class="text-gold-400 hover:underline">Add your first experience</button>.</p>
        @endforelse
    </div>
</div>