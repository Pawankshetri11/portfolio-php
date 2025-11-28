<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $certificates = Certificate::orderBy('issue_date', 'desc')->get();
        return view('admin.certificates.index', compact('certificates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.certificates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'issuing_organization' => 'required|string|max:255',
                'issue_date' => 'required|date',
                'icon' => 'required|string|max:255',
                'view_type' => 'required|in:link',
                'credential_url' => 'nullable|url',
            ]);

            $certificate = Certificate::create($validatedData);

            if (request()->expectsJson()) {
                return response()->json(['message' => 'Certificate created successfully.', 'certificate' => $certificate], 201);
            }

            return redirect()->route('admin.certificates.index')->with('success', 'Certificate created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if (request()->expectsJson()) {
                return response()->json(['errors' => $e->errors()], 422);
            }
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $certificate = Certificate::findOrFail($id);
        return response()->json($certificate);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $certificate = Certificate::findOrFail($id);
        if (request()->expectsJson()) {
            return response()->json($certificate);
        }
        return view('admin.certificates.edit', compact('certificate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'issuing_organization' => 'required|string|max:255',
                'issue_date' => 'required|date',
                'icon' => 'required|string|max:255',
                'view_type' => 'required|in:link',
                'credential_url' => 'nullable|url',
            ]);

            $certificate = Certificate::findOrFail($id);
            $certificate->update($validatedData);

            if (request()->expectsJson()) {
                return response()->json(['message' => 'Certificate updated successfully.', 'certificate' => $certificate]);
            }

            return redirect()->route('admin.certificates.index')->with('success', 'Certificate updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if (request()->expectsJson()) {
                return response()->json(['errors' => $e->errors()], 422);
            }
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $certificate = Certificate::findOrFail($id);
        $certificate->delete();

        if (request()->expectsJson()) {
            return response()->json(['message' => 'Certificate deleted successfully.']);
        }

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate deleted successfully.');
    }
}
