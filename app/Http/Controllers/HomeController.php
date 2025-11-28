<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Certificate;
use App\Models\Contact;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Hero;
use App\Models\KeyMetric;
use App\Models\Project;
use App\Models\Skill;
use App\Models\TechStack;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        $hero = Hero::first();
        $about = About::first();
        $keyMetrics = KeyMetric::orderBy('order')->get();
        $educations = Education::all();
        $projects = Project::whereNotNull('published_at')->orderBy('published_at', 'desc')->get();
        $skills = Skill::all();
        $techStacks = TechStack::all();
        $experiences = Experience::orderBy('created_at', 'desc')->get();
        $contact = Contact::first();
        $certificates = Certificate::orderBy('issue_date', 'desc')->get();

        return view('home', compact(
            'hero',
            'about',
            'keyMetrics',
            'educations',
            'projects',
            'skills',
            'techStacks',
            'experiences',
            'contact',
            'certificates'
        ));
    }

    public function projects(Request $request)
    {
        $projects = Project::with('category')->whereNotNull('published_at')->orderBy('published_at', 'desc')->paginate(12);
        if ($request->ajax()) {
            return response()->json($projects);
        }
        return view('projects', compact('projects'));
    }

    public function showProject($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        return view('project', compact('project'));
    }

    public function storeContactMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        ContactMessage::create($request->all());

        return response()->json(['success' => 'Message sent successfully!'], 200);
    }
}
