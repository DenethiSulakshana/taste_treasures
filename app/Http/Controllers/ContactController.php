<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact()
    {
        return view('users.contact-us.contact'); 
    }

    public function submit(Request $request)
    {
        // Validate the form input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // Example: Store the message in the session (or database)
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
