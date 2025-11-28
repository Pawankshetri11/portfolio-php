<!-- 2. KEY METRICS -->
<section class="relative z-10 py-10 md:py-12 border-y border-white/5 bg-white/[0.01]">
    <div class="max-w-[95%] mx-auto grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
        @forelse($keyMetrics as $index => $metric)
            <div data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <h3 class="text-3xl md:text-5xl font-display font-bold text-white mb-2">{{ $metric->value }}</h3>
                <p class="text-zinc-500 text-xs md:text-sm uppercase tracking-widest">{{ $metric->label }}</p>
            </div>
        @empty
            <div class="text-center text-zinc-500 py-8">
                <p>No key metrics configured yet.</p>
            </div>
        @endforelse
    </div>
</section>