<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Submission;

class FormController extends Controller
{
    /**
     * Handle submission of the form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitForm(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'paper_number' => 'required',
            'video' => 'required|file|mimes:mp4,avi,mov,qt,wmv',
        ]);

        // Handle file upload
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $path = $file->store('public/videos'); // Store file in storage/app/public/videos directory
        } else {
            return redirect()->back()->with('error', 'Video file is required.');
        }

        // Store submission in database
        $submission = Submission::create([
            'email' => $validatedData['email'],
            'paper_number' => $validatedData['paper_number'],
            'video_path' => $path, // Store the path to the video file
        ]);

        // Redirect to thank you page with filled details
        return redirect()->route('thank.you', [
            'email' => $validatedData['email'],
            'paper_number' => $validatedData['paper_number'],
        ]);        
    }

    /**
     * Display a thank you page with submission details.
     *
     * @param  string  $email
     * @param  string  $paper_number
     * @return \Illuminate\View\View
     */
    public function thankYou($email, $paper_number)
    {
        return view('thank_you', compact('email', 'paper_number'));
    }

    // Remainder of the controller actions
}
