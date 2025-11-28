<!-- 2. KEY METRICS EDITOR (Hidden) -->
<div id="metrics-section" class="space-y-8 max-w-4xl mx-auto hidden">
    <div class="admin-card">
        <h3 class="text-lg font-bold text-white mb-6 border-b border-white/5 pb-4">Key Metrics</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @php
                $keyMetrics = \App\Models\KeyMetric::orderBy('order')->get();
            @endphp
            @foreach($keyMetrics as $metric)
            <div>
                <label class="admin-label">{{ $metric->label }}</label>
                <input type="text" class="admin-input" data-metric-id="{{ $metric->id }}" data-field="value" value="{{ $metric->value }}">
                <input type="text" class="admin-input mt-2 text-sm" data-metric-id="{{ $metric->id }}" data-field="label" value="{{ $metric->label }}">
                <input type="hidden" data-metric-id="{{ $metric->id }}" data-field="order" value="{{ $metric->order }}">
            </div>
            @endforeach
        </div>
    </div>
</div>