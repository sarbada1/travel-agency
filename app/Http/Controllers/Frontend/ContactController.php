<?php
// filepath: /home/sarbada/Desktop/booking/app/Http/Controllers/Frontend/ContactController.php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact\Contact;
use App\Models\User\User;
use App\Models\Setting\Setting;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmitted;

class ContactController extends Controller
{
    /**
     * Display the contact page.
     */
    public function index()
    {
        // Get users with account type 3 (sellers) instead of agents
        $sellers = User::where('account_type_id', 3)
                      ->take(4)
                      ->get();
        
        // Get settings
        $settings = Setting::first();
        
        return view('frontend.pages.contact.index', compact('sellers', 'settings'));
    }
    
    /**
     * Submit the contact form.
     */
    public function submit(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|string|max:20',
            'inquiry_type' => 'required|string|max:20',
            'message' => 'required|string'
        ]);
        
        // Combine first and last name
        $validatedData['name'] = $validatedData['first_name'] . ' ' . $validatedData['last_name'];
        
        // Add user_id if authenticated
        if (auth()->check()) {
            $validatedData['user_id'] = auth()->id();
        }
        
        // Save to database
        $contact = Contact::create($validatedData);
        
        // Send notification email to admin
        try {
            $settings = Setting::first();
            $adminEmail = $settings->email ?? config('mail.from.address');
            
            Mail::to($adminEmail)->send(new ContactFormSubmitted($contact));
            
            // Auto-response to user 
            // Mail::to($validatedData['email'])->send(new ContactAutoResponse($contact));
        } catch (\Exception $e) {
            // Log error but don't stop the form submission
        }
        
        return redirect()->back()->with('success', 'Thank you for your message. We will get back to you shortly!');
    }
}