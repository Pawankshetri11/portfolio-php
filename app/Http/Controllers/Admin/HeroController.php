<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heros = Hero::all();
        return view('admin.heros.index', compact('heros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.heros.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('heroes', 'public');
        }

        if ($request->hasFile('resume')) {
            $data['resume'] = $request->file('resume')->store('resumes', 'public');
        }

        Hero::create($data);

        return redirect()->route('heros.index')->with('success', 'Hero created successfully.');
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
        $hero = Hero::findOrFail($id);
        return view('admin.heros.edit', compact('hero'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        \Log::info('HeroController update called', [
            'id' => $id,
            'all_data' => $request->all(),
            'headers' => $request->headers->all(),
            'method' => $request->method(),
            'expects_json' => $request->expectsJson()
        ]);

        $request->validate([
            'greeting' => 'nullable|string|max:255',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'github_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'email' => 'nullable|email',
            'animation_label_1' => 'nullable|string|max:255',
            'animation_label_2' => 'nullable|string|max:255',
            'animation_label_3' => 'nullable|string|max:255',
            'animation_label_4' => 'nullable|string|max:255',
        ]);

        $hero = Hero::findOrFail($id);
        $data = $request->except(['image', 'resume']); // Exclude files from all()

        \Log::info('Hero update data', ['data' => $data]);
        \Log::info('Resume file check', [
            'has_resume' => $request->hasFile('resume'),
            'all_files' => $request->allFiles()
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($hero->image && \Storage::disk('public')->exists($hero->image)) {
                \Storage::disk('public')->delete($hero->image);
            }
            $data['image'] = $request->file('image')->store('heroes', 'public');
        }

        if ($request->hasFile('resume')) {
            \Log::info('Processing resume file', ['file' => $request->file('resume')]);
            // Delete old resume if exists
            if ($hero->resume && \Storage::disk('public')->exists($hero->resume)) {
                \Storage::disk('public')->delete($hero->resume);
            }
            $resumePath = $request->file('resume')->store('resumes', 'public');
            $data['resume'] = $resumePath;
            \Log::info('Resume stored at', ['path' => $resumePath]);
        } else {
            \Log::info('No resume file found in request');
        }

        $hero->update($data);

        \Log::info('Hero updated successfully', ['hero_id' => $id, 'updated_data' => $data]);

        // Check if it's an AJAX request
        if ($request->expectsJson()) {
            \Log::info('Returning JSON response');
            return response()->json(['success' => true, 'message' => 'Hero updated successfully.']);
        }

        \Log::info('Returning redirect response');
        return redirect()->route('heros.index')->with('success', 'Hero updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hero = Hero::findOrFail($id);
        $hero->delete();

        return redirect()->route('admin.heros.index')->with('success', 'Hero deleted successfully.');
    }
}
