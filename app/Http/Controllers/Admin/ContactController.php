<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\ContactMessage; // Import ContactMessage model
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display the admin dashboard with the contact information.
     */
    public function index()
    {
        $contact = Contact::firstOrCreate([]); // Ensure a contact record always exists
        $messageCount = ContactMessage::count(); // Get total message count
        return view('admin.index', compact('contact', 'messageCount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'contact_email' => 'nullable|email',
            'display_email' => 'nullable|email',
            'heading_text' => 'nullable|string',
            'subtext' => 'nullable|string',
            'linkedin_url' => 'nullable|url',
            'github_url' => 'nullable|url',
        ]);

        $contact = Contact::firstOrCreate([]);
        $contact->update($request->all());

        return back()->with('success', 'Contact information updated successfully.');
    }
}
