@extends('layouts.app')

@section('title', 'SkillConnect - Connect Through Volunteering')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/index_styles.css') }}">
@endpush

@section('content')
<!-- Hero Section -->
<div class="gradient-bg text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-8 md:mb-0">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Make a Difference Together</h1>
                <p class="text-xl mb-6">Connect with local volunteer opportunities and create meaningful change in your community.</p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('discover.index') }}" class="bg-white text-blue-600 hover:bg-gray-100 px-6 py-3 rounded-full font-medium transition duration-300">
                        Find Opportunities
                    </a>
                    <a href="{{ route('opportunities.create') }}" class="bg-blue-700 hover:bg-blue-800 text-white px-6 py-3 rounded-full font-medium transition duration-300">
                        Post a Need
                    </a>
                </div>
            </div>
            <div class="md:w-1/2 relative">
                {{-- Replace with a real image path if you have one, or keep Unsplash --}}
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&h=600&q=80" alt="Volunteers working together" class="rounded-lg shadow-xl w-full max-w-md mx-auto">
                <div class="absolute -bottom-4 -left-4 bg-white p-4 rounded-lg shadow-lg hidden md:block">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-full mr-3">
                            <i class="fas fa-hands-helping text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="font-bold text-gray-800">1,245+</p> {{-- Placeholder --}}
                            <p class="text-sm text-gray-600">Active Volunteers</p>
                        </div>
                    </div>
                </div>
                <div class="absolute -top-4 -right-4 bg-white p-4 rounded-lg shadow-lg hidden md:block">
                    <div class="flex items-center">
                        <div class="bg-green-100 p-3 rounded-full mr-3">
                            <i class="fas fa-heart text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="font-bold text-gray-800">568+</p> {{-- Placeholder --}}
                            <p class="text-sm text-gray-600">Projects Completed</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="flex flex-col md:flex-row gap-6">
        <!-- Left Sidebar -->
        <div class="w-full md:w-1/3 lg:w-1/4 space-y-6">
            <!-- User Profile Card -->
            @auth {{-- Show this card only if user is logged in --}}
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="gradient-bg h-20"></div>
                <div class="px-4 pb-6 relative">
                    <div class="flex justify-center">
                        <div class="rounded-full -mt-12 border-4 border-white overflow-hidden">
                            <img class="h-24 w-24 rounded-full avatar-ring" src="{{ Auth::user()->profile_photo_url ?? 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80' }}" alt="{{ Auth::user()->name ?? 'User avatar' }}">
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <h2 class="text-lg font-semibold text-gray-900">{{ Auth::user()->name ?? 'John Doe' }}</h2>
                        <p class="text-sm text-gray-600">{{ Auth::user()->title ?? 'Volunteer Enthusiast' }}</p> {{-- Add 'title' to user model if needed --}}
                        <div class="flex justify-center mt-2">
                            <span class="text-yellow-400"><i class="fas fa-star"></i></span>
                            <span class="text-yellow-400"><i class="fas fa-star"></i></span>
                            <span class="text-yellow-400"><i class="fas fa-star"></i></span>
                            <span class="text-yellow-400"><i class="fas fa-star"></i></span>
                            <span class="text-yellow-400"><i class="fas fa-star-half-alt"></i></span>
                            <span class="text-gray-600 text-sm ml-1">(4.7)</span> {{-- Placeholder for dynamic rating --}}
                        </div>
                    </div>
                    <div class="mt-4 flex justify-between text-center">
                        <div>
                            <p class="text-gray-700 font-semibold">24</p> {{-- Placeholder --}}
                            <p class="text-gray-500 text-sm">Projects</p>
                        </div>
                        <div>
                            <p class="text-gray-700 font-semibold">142</p> {{-- Placeholder --}}
                            <p class="text-gray-500 text-sm">Volunteers</p> {{-- Or Connections/Followers --}}
                        </div>
                        <div>
                            <p class="text-gray-700 font-semibold">56</p> {{-- Placeholder --}}
                            <p class="text-gray-500 text-sm">Helped</p> {{-- Or Hours Contributed --}}
                        </div>
                    </div>
                </div>
            </div>
            @endauth

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="font-medium text-gray-900 mb-3">Quick Actions</h3>
                <div class="space-y-2">
                    <a href="{{ route('opportunities.create') }}" class="w-full flex items-center justify-between px-4 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition">
                        <span><i class="fas fa-plus mr-2"></i> Create Post</span>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                    <a href="{{ route('discover.index') }}" class="w-full flex items-center justify-between px-4 py-2 bg-green-50 text-green-600 rounded-lg hover:bg-green-100 transition">
                        <span><i class="fas fa-search mr-2"></i> Find Projects</span>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                    <a href="#" class="w-full flex items-center justify-between px-4 py-2 bg-purple-50 text-purple-600 rounded-lg hover:bg-purple-100 transition"> {{-- Add route for My Schedule later --}}
                        <span><i class="fas fa-calendar-alt mr-2"></i> My Schedule</span>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>

            <!-- Upcoming Events -->
            {{-- This section will require dynamic data later --}}
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="font-medium text-gray-900 mb-3">Upcoming Events</h3>
                <div class="space-y-3">
                    {{-- Example static item (replace with dynamic loop) --}}
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-blue-100 rounded-lg p-2">
                            <i class="fas fa-calendar-day text-blue-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Beach Cleanup</p>
                            <p class="text-xs text-gray-500">Tomorrow, 9:00 AM</p>
                        </div>
                    </div>
                    {{-- Add more static examples or logic for dynamic data --}}
                </div>
                <button class="mt-3 w-full text-center text-blue-500 text-sm font-medium hover:text-blue-700">
                    View All Events
                </button>
            </div>

            <!-- Volunteer Badges -->
            {{-- This section will require dynamic data later --}}
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="font-medium text-gray-900 mb-3">My Badges</h3>
                <div class="grid grid-cols-3 gap-3">
                    {{-- Example static item (replace with dynamic loop) --}}
                    <div class="text-center">
                        <div class="bg-yellow-100 rounded-full p-3 mx-auto w-16 h-16 flex items-center justify-center">
                            <i class="fas fa-medal text-yellow-500 text-2xl"></i>
                        </div>
                        <p class="text-xs mt-1">Super Helper</p>
                    </div>
                    {{-- Add more static examples --}}
                </div>
                <button class="mt-3 w-full text-center text-blue-500 text-sm font-medium hover:text-blue-700">
                    View All Badges
                </button>
            </div>
        </div>

        <!-- Main Feed -->
        <div class="w-full md:w-2/3 lg:w-1/2 space-y-6">
            <!-- Feed Filters -->
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center justify-between">
                    <div class="flex space-x-2 overflow-x-auto pb-2">
                        <button class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm font-medium">All</button>
                        <button class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm font-medium hover:bg-gray-200">Environmental</button>
                        {{-- Add other category buttons --}}
                        <button class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm font-medium hover:bg-gray-200">Programming</button>
                    </div>
                </div>
            </div>

            <!-- Volunteer Opportunity Posts -->
            {{-- This section will require dynamic data from a loop later --}}
            <div class="space-y-4">
                <!-- Post 1 Example (static for now) -->
                <div class="bg-white rounded-lg shadow overflow-hidden post-card">
                    <div class="p-4">
                        <div class="flex items-start">
                            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="User avatar">
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Sarah Johnson</p>
                                <p class="text-xs text-gray-500">2 hours ago · <span class="text-green-500">Environmental</span></p>
                            </div>
                        </div>
                        <div class="mt-3">
                            <h3 class="text-lg font-semibold text-gray-900">Beach Cleanup at Santa Monica</h3>
                            <p class="mt-1 text-gray-700">Join us this Saturday to help clean up Santa Monica Beach. We'll provide all necessary equipment. Bring sunscreen and water!</p>
                            <div class="mt-3">
                                <p class="text-sm font-medium text-gray-700 mb-1">Skills Required:</p>
                                <div class="flex flex-wrap">
                                    <span class="skill-tag"><i class="fas fa-recycle mr-1"></i> Environmental Awareness</span>
                                    <span class="skill-tag"><i class="fas fa-users mr-1"></i> Teamwork</span>
                                    <span class="skill-tag"><i class="fas fa-dumbbell mr-1"></i> Physical Fitness</span>
                                </div>
                            </div>
                            <div class="mt-3 flex items-center text-sm text-gray-500">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                <span>Santa Monica Beach, CA</span>
                            </div>
                            <div class="mt-1 flex items-center text-sm text-gray-500">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                <span>Sat, June 10 · 9:00 AM - 12:00 PM</span>
                            </div>
                            <div class="mt-3 flex items-center text-sm text-gray-500">
                                <i class="fas fa-users mr-1"></i>
                                <span>5/20 volunteers needed</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 flex items-center justify-between border-t">
                        <div class="flex space-x-4">
                            <button class="flex items-center text-gray-500 hover:text-blue-500">
                                <i class="far fa-heart mr-1"></i>
                                <span>24</span>
                            </button>
                            <button class="flex items-center text-gray-500 hover:text-green-500">
                                <i class="far fa-comment mr-1"></i>
                                <span>8</span>
                            </button>
                        </div>
                        <button class="px-4 py-2 bg-blue-500 text-white rounded-full text-sm font-medium hover:bg-blue-600 transition">
                            <i class="fas fa-hand-holding-heart mr-1"></i> Volunteer
                        </button>
                    </div>
                </div>
                {{-- Add more static post examples here if needed for layout --}}
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="hidden lg:block lg:w-1/4 space-y-6">
            <!-- Trending Projects -->
            {{-- This section will require dynamic data later --}}
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="font-medium text-gray-900 mb-3">Trending Projects</h3>
                <div class="space-y-4">
                    {{-- Example static item --}}
                    <div class="flex items-start">
                        <div class="flex-shrink-0 h-12 w-12 rounded-lg overflow-hidden">
                            <img class="h-full w-full object-cover" src="https://images.unsplash.com/photo-1526779259212-939e64788e3c?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&h=200&q=80" alt="Project image">
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Urban Garden Initiative</p>
                            <p class="text-xs text-gray-500">45 volunteers this week</p>
                            <div class="mt-1 w-full bg-gray-200 rounded-full h-1.5">
                                <div class="bg-green-500 h-1.5 rounded-full" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>
                    {{-- Add more static examples --}}
                </div>
                <button class="mt-3 w-full text-center text-blue-500 text-sm font-medium hover:text-blue-700">
                    See All Trending
                </button>
            </div>

            <!-- Recommended Volunteers -->
            {{-- This section will require dynamic data later --}}
            <div class="bg-white rounded-lg shadow p-4">
                 <h3 class="font-medium text-gray-900 mb-3">Recommended Volunteers</h3>
                 {{-- Add static examples --}}
            </div>

            <!-- Community Impact / Volunteer Stats -->
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="font-medium text-gray-900 mb-3">Community Impact</h3>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">This Month</span>
                            <span class="font-medium">1,245 hours</span> {{-- Placeholder --}}
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">This Year</span>
                            <span class="font-medium">12,893 hours</span> {{-- Placeholder --}}
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">Total Volunteers</span>
                            <span class="font-medium">8,742</span> {{-- Placeholder --}}
                        </div>
                    </div>
                </div>
                @auth
                <div class="mt-4 p-3 bg-blue-50 rounded-lg text-center">
                    <p class="text-sm text-blue-700">You've contributed <span class="font-bold">42 hours</span> this month!</p> {{-- Placeholder --}}
                </div>
                @endauth
            </div>

            <!-- Volunteer Resources -->
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="font-medium text-gray-900 mb-3">Volunteer Resources</h3>
                {{-- Add static examples of resources --}}
            </div>

            <!-- Volunteer of the Month -->
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <h3 class="font-medium text-gray-900 mb-3">Volunteer of the Month</h3>
                <img src="{{ asset('images/karsten-winegeart-ZAiuJXbF7dA-unsplash.jpg') }}" alt="Volunteer of the month" class="w-20 h-20 rounded-full mx-auto mb-3">
                <h4 class="font-medium text-gray-900">Karsten Winegeart</h4>
                <p class="text-sm text-gray-600 mb-2">Dedicated 120 hours this month</p> {{-- Placeholder --}}
                <div class="flex justify-center mb-3">
                    <span class="text-yellow-400"><i class="fas fa-star"></i></span>
                    <span class="text-yellow-400"><i class="fas fa-star"></i></span>
                    <span class="text-yellow-400"><i class="fas fa-star"></i></span>
                    <span class="text-yellow-400"><i class="fas fa-star"></i></span>
                    <span class="text-yellow-400"><i class="fas fa-star"></i></span>
                </div>
                <button class="text-blue-500 text-sm font-medium hover:text-blue-700">
                    Read his journey
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Testimonials Section -->
<div class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">What Our Volunteers Say</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- Static testimonial example --}}
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&auto=format&fit=crop&w=64&h=64&q=80" alt="Testimonial" class="w-12 h-12 rounded-full mr-4">
                    <div>
                        <h4 class="font-medium text-gray-900">Sarah Johnson</h4>
                        <p class="text-sm text-gray-500">Environmental Volunteer</p>
                    </div>
                </div>
                <p class="text-gray-600">"SkillConnect made it so easy to find meaningful volunteer opportunities in my area. I've met amazing people and made a real difference in my community."</p>
                <div class="mt-4 flex text-yellow-400">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
            </div>
            {{-- Add 2 more static testimonials to match original layout --}}
        </div>
    </div>
</div>

<!-- Call to Action -->
<div class="gradient-bg text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-6">Ready to Make a Difference?</h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">Join thousands of volunteers who are creating positive change in their communities every day.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('register') }}" class="bg-white text-blue-600 hover:bg-gray-100 px-8 py-4 rounded-full font-medium text-lg transition duration-300">
                Sign Up as Volunteer
            </a>
             <a href="{{ route('opportunities.create') }}" class="bg-blue-700 hover:bg-blue-800 text-white px-8 py-4 rounded-full font-medium text-lg transition duration-300">
                Post a Volunteer Need
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/index_scripts.js') }}"></script>
    {{-- Ensure any JS for carousels or specific interactions on this page is loaded --}}
@endpush