<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KeyMetric;
use Illuminate\Http\Request;

class KeyMetricController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keyMetrics = KeyMetric::orderBy('order')->get();
        return view('admin.key-metrics.index', compact('keyMetrics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.key-metrics.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'value' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'order' => 'nullable|integer|min:0',
        ]);

        KeyMetric::create($request->all());

        return redirect()->route('key-metrics.index')->with('success', 'Key Metric created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $keyMetric = KeyMetric::findOrFail($id);
        return view('admin.key-metrics.edit', compact('keyMetric'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        \Log::info('KeyMetricController update called', [
            'id' => $id,
            'all_data' => $request->all(),
            'headers' => $request->headers->all(),
            'method' => $request->method(),
            'expects_json' => $request->expectsJson(),
            'content_type' => $request->header('Content-Type'),
            'input' => $request->input()
        ]);

        $request->validate([
            'value' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'order' => 'nullable|integer|min:0',
        ]);

        $keyMetric = KeyMetric::findOrFail($id);
        $keyMetric->update($request->all());

        \Log::info('KeyMetric updated successfully', ['id' => $id, 'data' => $request->all()]);

        // Check if it's an AJAX request
        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Key Metric updated successfully.']);
        }

        return redirect()->route('key-metrics.index')->with('success', 'Key Metric updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $keyMetric = KeyMetric::findOrFail($id);
        $keyMetric->delete();

        return redirect()->route('key-metrics.index')->with('success', 'Key Metric deleted successfully.');
    }
}
