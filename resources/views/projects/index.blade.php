@extends('layouts.app')

@section('title', 'My Projects - SkillConnect')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/projects_styles.css') }}">
@endpush

@section('content')
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <h1 class="text-3xl font-bold text-gray-900 mb-6">My Projects Dashboard</h1>

    <section class="mb-10" aria-labelledby="timeline-heading">
        <h2 id="timeline-heading" class="text-2xl font-semibold text-gray-800 mb-4">Completed Projects Timeline</h2>
        <div class="bg-white rounded-lg shadow p-4 overflow-hidden">
             <div class="flex space-x-6 md:space-x-8 overflow-x-auto py-4 scrollbar-thin scrollbar-thumb-blue-500 scrollbar-track-gray-100">
                @forelse($completedProjects as $project)
                <article class="flex-shrink-0 w-60 md:w-64 timeline-card bg-gradient-to-br from-green-50 to-blue-50 p-4 rounded-lg shadow border border-gray-200 text-center">
                    <time datetime="{{ $project->date }}" class="block text-xs font-semibold text-blue-600 mb-1">{{ \Carbon\Carbon::parse($project->date)->format('M d, Y') }}</time>
                    <h3 class="font-medium text-gray-800 mb-1">{{ $project->title }}</h3>
                    <p class="text-sm text-gray-600">{{ $project->description }}</p>
                    <div class="mt-2">
                       <span class="inline-block bg-green-100 text-green-700 text-xs font-medium px-2 py-0.5 rounded-full">{{ $project->status }}</span>
                    </div>
                </article>
                @empty
                <p class="text-gray-500 italic">No completed projects yet.</p>
                @endforelse
                @if($completedProjects->count() > 3) {{-- Show "More history" if many items --}}
                <div class="flex-shrink-0 w-48 flex items-center justify-center text-gray-400">
                    <p class="text-sm italic">More history...</p>
                </div>
                @endif
            </div>
        </div>
    </section>

    <section aria-labelledby="analytics-heading">
        <h2 id="analytics-heading" class="text-2xl font-semibold text-gray-800 mb-4">My Volunteer Analytics</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="bg-white rounded-lg shadow p-5 flex items-center space-x-4 stat-card">
                <div class="flex-shrink-0 bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-check-circle text-blue-500 text-xl fa-fw" aria-hidden="true"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">Projects Completed</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $analytics->projects_completed }}</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-5 flex items-center space-x-4 stat-card">
                <div class="flex-shrink-0 bg-green-100 p-3 rounded-full">
                    <i class="fas fa-clock text-green-500 text-xl fa-fw" aria-hidden="true"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Hours Volunteered</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $analytics->total_hours_volunteered }} Hours</p>
                </div>
            </div>

             <div class="bg-white rounded-lg shadow p-5 flex items-center space-x-4 stat-card">
                <div class="flex-shrink-0 bg-yellow-100 p-3 rounded-full">
                    <i class="fas fa-star text-yellow-500 text-xl fa-fw" aria-hidden="true"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">Average Rating</p>
                    <div class="flex items-baseline">
                        <p class="text-2xl font-semibold text-gray-900 mr-1">{{ $analytics->average_rating }}</p>
                        <span class="text-gray-500 text-sm">/ 5.0</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-5 flex items-center space-x-4 stat-card">
                <div class="flex-shrink-0 bg-indigo-100 p-3 rounded-full">
                    <i class="fas fa-tasks text-indigo-500 text-xl fa-fw" aria-hidden="true"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">Active / Upcoming</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $analytics->active_upcoming_count }}</p>
                </div>
                 <a href="#active-projects-table" class="ml-auto text-blue-500 hover:text-blue-700 text-sm font-medium">View</a>
            </div>

             <div class="bg-white rounded-lg shadow p-5 stat-card sm:col-span-2">
                 <div class="flex items-center space-x-4 mb-3">
                     <div class="flex-shrink-0 bg-purple-100 p-3 rounded-full">
                        <i class="fas fa-cogs text-purple-500 text-xl fa-fw" aria-hidden="true"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Top Skills Utilized</p>
                    </div>
                 </div>
                 <div class="flex flex-wrap">
                    @foreach($analytics->top_skills as $skill)
                    <span class="skill-tag"><i class="fas fa-check mr-1" aria-hidden="true"></i> {{ $skill }}</span> {{-- Add icons per skill if you have them --}}
                    @endforeach
                 </div>
            </div>

             <div class="bg-white rounded-lg shadow p-5 stat-card">
                <div class="flex items-center space-x-4 mb-3">
                     <div class="flex-shrink-0 bg-red-100 p-3 rounded-full">
                        <i class="fas fa-chart-pie text-red-500 text-xl fa-fw" aria-hidden="true"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Projects by Category</p>
                    </div>
                 </div>
                 <div class="space-y-2 text-sm">
                    @foreach($analytics->projects_by_category as $categoryStat)
                    <div class="flex justify-between"><span>{{ $categoryStat->name }}</span><span class="font-medium">{{ $categoryStat->count }} Projects</span></div>
                    @endforeach
                    <p class="text-xs text-gray-400 mt-2 italic">(Visualization can be added with a Chart Library)</p>
                 </div>
            </div>

             <div id="active-projects-table" class="sm:col-span-2 lg:col-span-3 bg-white rounded-lg shadow p-5 stat-card">
                 <h3 class="text-lg font-semibold text-gray-800 mb-4">Active & Upcoming Projects</h3>
                 <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Project Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role/Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($activeProjects as $project)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $project->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><time datetime="{{ $project->datetime }}">{{ $project->datetime_display }}</time></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm {{ $project->status_color }}">{{ $project->status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $project->location }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">No active or upcoming projects.</td>
                            </tr>
                            @endforelse
                            </tbody>
                    </table>
                 </div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/projects_scripts.js') }}"></script>
    {{-- Add JS for any charts or interactive elements on this page --}}
@endpush