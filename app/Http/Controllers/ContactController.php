<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Store a newly created contact message in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info('Contact form submission received.');

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        Log::info('Validated data:', $validatedData);

        try {
            ContactMessage::create($validatedData);
            Log::info('Contact message saved successfully.');

            if ($request->expectsJson()) {
                return response()->json(['success' => 'Your message has been sent successfully!']);
            }
            return redirect()->back()->with('success', 'Your message has been sent successfully!');
        } catch (\Exception $e) {
            Log::error('Error saving contact message: ' . $e->getMessage());

            if ($request->expectsJson()) {
                return response()->json(['errors' => ['general' => 'There was an error sending your message. Please try again.']], 500);
            }
            return redirect()->back()->with('error', 'There was an error sending your message. Please try again.');
        }
    }
}
