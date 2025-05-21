<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
// use App\Models\Project; // If you have a Project model for user's involvements

class ProjectController extends Controller
{
    public function index(): View
    {
        // Dummy data for completed projects timeline
        $completedProjects = collect([
            (object)['date' => '2025-01-15', 'title' => 'Beach Cleanup', 'description' => 'Organized and led a team of 15 volunteers.', 'status' => 'Completed'],
            (object)['date' => '2025-02-02', 'title' => 'Community Tutoring', 'description' => 'Tutored Math for 10 hours.', 'status' => 'Completed'],
            (object)['date' => '2025-03-10', 'title' => 'Animal Shelter Support', 'description' => 'Walked dogs and assisted with feeding.', 'status' => 'Completed'],
            (object)['date' => '2025-04-05', 'title' => 'Food Bank Distribution', 'description' => 'Helped pack and distribute 100+ food boxes.', 'status' => 'Completed'],
        ]);

        // Dummy data for analytics
        $analytics = (object)[
            'projects_completed' => 15,
            'total_hours_volunteered' => 212,
            'average_rating' => 4.7,
            'active_upcoming_count' => 3,
            'top_skills' => ['Teamwork', 'Environmental Awareness', 'Teaching', 'Lifting', 'Animal Handling', 'Compassion'],
            'projects_by_category' => [
                (object)['name' => 'Environmental', 'count' => 5],
                (object)['name' => 'Education', 'count' => 4],
                (object)['name' => 'Community', 'count' => 3],
                (object)['name' => 'Animals', 'count' => 2],
                (object)['name' => 'Programming', 'count' => 1],
            ]
        ];

        // Dummy data for active/upcoming projects table
        $activeProjects = collect([
            (object)['name' => 'Tree Planting Day', 'datetime' => '2025-04-20T09:00', 'datetime_display' => 'Apr 20, 2025 - 9:00 AM', 'status' => 'Confirmed', 'status_color' => 'text-green-600', 'location' => 'Griffith Park'],
            (object)['name' => 'Senior Center Visit', 'datetime' => '2025-04-25T14:00', 'datetime_display' => 'Apr 25, 2025 - 2:00 PM', 'status' => 'Confirmed', 'status_color' => 'text-green-600', 'location' => 'Downtown Senior Center'],
            (object)['name' => 'Charity Run Support', 'datetime' => '2025-05-05T07:00', 'datetime_display' => 'May 05, 2025 - 7:00 AM', 'status' => 'Pending Confirmation', 'status_color' => 'text-yellow-600', 'location' => 'Exposition Park'],
        ]);

        return view('projects.index', compact('completedProjects', 'analytics', 'activeProjects'));
    }
}