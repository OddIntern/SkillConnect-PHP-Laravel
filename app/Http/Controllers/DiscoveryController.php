<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
// use App\Models\Opportunity; // Uncomment when you have the model

class DiscoveryController extends Controller
{
    public function index(): View
    {
        // Replace with actual data fetching later
        // $opportunities = Opportunity::latest()->paginate(10);
        // $categories = Opportunity::select('category')->distinct()->pluck('category');
        // For now, we'll pass dummy data or just the view
        $opportunities = collect([ // Dummy data for now
            (object)[
                'id' => 1,
                'title' => 'Beach Cleanup at Santa Monica',
                'organization_logo_url' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
                'organization_name' => 'Ocean Conservation Society',
                'urgency_status' => 'Urgent', // or null
                'location_short' => 'Santa Monica, CA',
                'distance' => '2.3 mi away',
                'datetime_display' => 'Sat, June 10 · 9:00 AM - 12:00 PM',
                'description_short' => 'Join us for a morning of beach cleaning to protect marine life. All equipment provided. Bring sunscreen and water!',
                'skills_needed' => [
                    (object)['name' => 'Environmental Awareness', 'icon' => 'fas fa-recycle'],
                    (object)['name' => 'Teamwork', 'icon' => 'fas fa-users']
                ],
                'signed_up_avatars' => [ /* array of avatar_urls */ ],
                'signed_up_count' => 12,
                'is_virtual' => false
            ],
            // Add more dummy opportunity objects
        ]);
        $categories = ['Environmental', 'Education', 'Community', 'Animals', 'Programming']; // Dummy categories
        $skills = ['Teaching', 'Cooking', 'First Aid']; // Dummy skills

        return view('discovery.index', compact('opportunities', 'categories', 'skills'));
    }
}