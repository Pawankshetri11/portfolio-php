<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $experiences = Experience::all();
        return view('admin.experiences.index', compact('experiences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.experiences.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'company' => 'required|string|max:255',
                'location' => 'nullable|string|max:255',
                'logo' => 'nullable|string|max:10',
                'display_type' => 'required|in:responsibilities,description',
                'roles' => 'required|array|min:1',
                'roles.*.title' => 'required|string|max:255',
                'roles.*.type' => 'required|in:Full-time,Part-time,Contract,Freelance,Self-employed',
                'roles.*.start_date' => 'nullable|date_format:Y-m-d',
                'roles.*.end_date' => 'nullable|date_format:Y-m-d|after:roles.*.start_date',
                'roles.*.description' => 'required|string',
                'roles.*.display_type' => 'required|in:responsibilities,description',
                'roles.*.skills' => 'nullable|array',
                'roles.*.skills.*' => 'string|max:255',
            ]);

            // Handle transformations on dates
            if (isset($validatedData['roles'])) {
                foreach ($validatedData['roles'] as &$role) {
                    if (isset($role['start_date']) && empty($role['start_date'])) {
                        $role['start_date'] = null;
                    }
                    if (isset($role['end_date']) && empty($role['end_date'])) {
                        $role['end_date'] = null;
                    }
                }
            }

            // Prepare the base data for the experience
            $experienceData = [
                'company' => $validatedData['company'],
                'location' => $validatedData['location'] ?? null,
                'logo' => $validatedData['logo'] ?? null,
                'display_type' => $validatedData['display_type'],
                'description' => null,
                'responsibilities' => null,
            ];

            // Extract the first role to populate top-level columns for a new experience
            if (!empty($validatedData['roles'])) {
                $firstRole = array_shift($validatedData['roles']); // Extracts and removes the first role

                $experienceData['position'] = $firstRole['title'];
                $experienceData['start_date'] = $firstRole['start_date'] ?? null;
                $experienceData['end_date'] = $firstRole['end_date'] ?? null;
                
                // Conditionally assign description or responsibilities
                if ($validatedData['display_type'] === 'description') {
                    $experienceData['description'] = $firstRole['description'];
                } else {
                    $experienceData['responsibilities'] = $firstRole['description'];
                }
                
                if (!empty($firstRole['skills'])) {
                    $experienceData['technologies'] = implode(', ', $firstRole['skills']);
                } else {
                    $experienceData['technologies'] = null;
                }
            }

            // Any remaining roles are stored in the JSON 'roles' column
            $experienceData['roles'] = !empty($validatedData['roles']) ? $validatedData['roles'] : null;

            Experience::create($experienceData);

            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Experience created successfully.']);
            }

            return redirect()->route('experiences.index')->with('success', 'Experience created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $experience = Experience::findOrFail($id);

        if (request()->ajax()) {
            return response()->json($experience);
        }

        return view('admin.experiences.show', compact('experience'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $experience = Experience::findOrFail($id);
        return view('admin.experiences.edit', compact('experience'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validatedData = $request->validate([
                'company' => 'required|string|max:255',
                'location' => 'nullable|string|max:255',
                'logo' => 'nullable|string|max:10',
                'display_type' => 'required|in:responsibilities,description',
                'roles' => 'required|array|min:1',
                'roles.*.title' => 'required|string|max:255',
                'roles.*.type' => 'required|in:Full-time,Part-time,Contract,Freelance,Self-employed',
                'roles.*.start_date' => 'nullable|date_format:Y-m-d',
                'roles.*.end_date' => 'nullable|date_format:Y-m-d|after:roles.*.start_date',
                'roles.*.description' => 'required|string',
                'roles.*.display_type' => 'required|in:responsibilities,description',
                'roles.*.skills' => 'nullable|array',
                'roles.*.skills.*' => 'string|max:255',
            ]);

            // Handle transformations on dates
            if (isset($validatedData['roles'])) {
                foreach ($validatedData['roles'] as &$role) {
                    if (isset($role['start_date']) && empty($role['start_date'])) {
                        $role['start_date'] = null;
                    }
                    if (isset($role['end_date']) && empty($role['end_date'])) {
                        $role['end_date'] = null;
                    }
                }
            }

            // Prepare the base data for the experience
            $experienceData = [
                'company' => $validatedData['company'],
                'location' => $validatedData['location'] ?? null,
                'logo' => $validatedData['logo'] ?? null,
                'display_type' => $validatedData['display_type'],
                'description' => null,
                'responsibilities' => null,
            ];

            // The first role always updates the top-level columns
            if (!empty($validatedData['roles'])) {
                $firstRole = array_shift($validatedData['roles']); // Extracts and removes the first role

                $experienceData['position'] = $firstRole['title'];
                $experienceData['start_date'] = $firstRole['start_date'] ?? null;
                $experienceData['end_date'] = $firstRole['end_date'] ?? null;

                // Conditionally assign description or responsibilities
                if ($validatedData['display_type'] === 'description') {
                    $experienceData['description'] = $firstRole['description'];
                } else {
                    $experienceData['responsibilities'] = $firstRole['description'];
                }
                
                if (!empty($firstRole['skills'])) {
                    $experienceData['technologies'] = implode(', ', $firstRole['skills']);
                } else {
                    $experienceData['technologies'] = null;
                }
            }

            // Any remaining roles are stored in the JSON 'roles' column
            $experienceData['roles'] = !empty($validatedData['roles']) ? $validatedData['roles'] : null;
            
            $experience = Experience::findOrFail($id);
            $experience->update($experienceData);

            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Experience updated successfully.']);
            }

            return redirect()->route('experiences.index')->with('success', 'Experience updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $experience = Experience::findOrFail($id);
        $experience->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Experience deleted successfully.']);
        }

        return redirect()->route('experiences.index')->with('success', 'Experience deleted successfully.');
    }
}
