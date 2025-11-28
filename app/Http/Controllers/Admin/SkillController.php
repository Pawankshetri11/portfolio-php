<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skills = Skill::with('category')->get();

        // Check if it's an AJAX request
        if (request()->expectsJson()) {
            return response()->json($skills);
        }

        return view('admin.skills.index', compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.skills.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|in:beginner,intermediate,advanced',
            'category_id' => 'nullable|exists:skill_categories,id',
            'logo' => 'nullable|file|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        $data = $request->all();

        // Map string level values to integers
        if (isset($data['level'])) {
            $levelMap = [
                'beginner' => 1,
                'intermediate' => 2,
                'advanced' => 3
            ];
            $data['level'] = $levelMap[$data['level']] ?? 1;
        }

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $skill = Skill::create($data);

        // Check if it's an AJAX request
        if (request()->expectsJson()) {
            return response()->json($skill->load('category'), 201);
        }

        return redirect()->route('admin.skills.index')->with('success', 'Skill created successfully.');
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
        $skill = Skill::findOrFail($id);
        return view('admin.skills.edit', compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|in:beginner,intermediate,advanced',
            'category_id' => 'nullable|exists:skill_categories,id',
            'logo' => 'nullable|file|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        $skill = Skill::findOrFail($id);
        $data = $request->all();

        // Map string level values to integers
        if (isset($data['level'])) {
            $levelMap = [
                'beginner' => 1,
                'intermediate' => 2,
                'advanced' => 3
            ];
            $data['level'] = $levelMap[$data['level']] ?? 1;
        }

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($skill->logo && \Storage::disk('public')->exists($skill->logo)) {
                \Storage::disk('public')->delete($skill->logo);
            }
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $skill->update($data);

        return redirect()->route('admin.skills.index')->with('success', 'Skill updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();

        // Check if it's an AJAX request
        if (request()->expectsJson()) {
            return response()->json(['message' => 'Skill deleted successfully']);
        }

        return redirect()->route('admin.skills.index')->with('success', 'Skill deleted successfully.');
    }
}
