<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
// use App\Models\Opportunity; // Uncomment when model exists

class OpportunityController extends Controller
{
    public function create(): View
    {
        $categories = ['environmental', 'education', 'community', 'animals', 'health', 'programming', 'other']; // Or fetch from DB
        return view('opportunities.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'post-title' => 'required|string|max:255',
            'post-description' => 'required|string',
            'post-category' => 'required|string',
            'post-date' => 'required|date_format:Y-m-d', // Matches HTML5 date input
            'post-time' => 'required|date_format:H:i',   // Matches HTML5 time input
            'post-location' => 'required|string|max:255',
            'post-volunteers-needed' => 'required|integer|min:1',
            'post-skills' => 'nullable|string',
            'file-upload' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Max 10MB
        ]);

        if ($validator->fails()) {
            return redirect()->route('opportunities.create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $validatedData = $validator->validated();
        $validatedData['user_id'] = auth()->id(); // Assign current user

        if ($request->hasFile('file-upload')) {
            $path = $request->file('file-upload')->store('opportunity_images', 'public');
            $validatedData['image_path'] = $path;
        }

        // \App\Models\Opportunity::create($validatedData); // Uncomment when Opportunity model is ready

        // For now, just a success message
        // dd('Form submitted successfully with data:', $validatedData); // For debugging

        return redirect()->route('discover.index')->with('success', 'Opportunity posted successfully!');
    }
}