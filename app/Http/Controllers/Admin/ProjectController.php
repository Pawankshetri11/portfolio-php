<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ProjectCategory::all();
        return view('admin.projects.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'published_at' => 'nullable|date',
            'description' => 'nullable|string',
            'technologies' => 'nullable|string',
            'category_id' => 'nullable|exists:project_categories,id',
            'github_url' => 'nullable|url',
            'live_url' => 'nullable|url',
        ]);

        $data = $request->except(['image', 'slug']);
        $data['slug'] = Str::slug($request->title);

        if (Project::where('slug', $data['slug'])->exists()) {
            return back()->withErrors(['slug' => 'A project with this title already exists.'])->withInput();
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
            $data['image'] = $imagePath;
        }

        Project::create($data);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Project created successfully.']);
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::findOrFail($id);
        return response()->json($project);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::findOrFail($id);
        $categories = ProjectCategory::all();
        return view('admin.projects.edit', compact('project', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'published_at' => 'nullable|date',
            'description' => 'nullable|string',
            'technologies' => 'nullable|string',
            'category_id' => 'nullable|exists:project_categories,id',
            'github_url' => 'nullable|url',
            'live_url' => 'nullable|url',
        ]);

        $data = $request->except(['image', 'slug']);
        $data['slug'] = Str::slug($request->title);

        if (Project::where('slug', $data['slug'])->where('id', '!=', $project->id)->exists()) {
            return back()->withErrors(['slug' => 'A project with this title already exists.'])->withInput();
        }

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $imagePath = $request->file('image')->store('projects', 'public');
            $data['image'] = $imagePath;
        }

        $project->update($data);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Project updated successfully.']);
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        if (request()->wantsJson()) {
            return response()->json(['message' => 'Project deleted successfully.']);
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }
}
