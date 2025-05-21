@extends('layouts.app')

@section('title', 'Discover Opportunities | SkillConnect')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/discovery_styles.css') }}">
@endpush

@section('content')
<!-- Discovery Hero Section -->
<div class="gradient-bg text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-4">Find Your Perfect Volunteer Opportunity</h1>
            <p class="text-xl mb-8 max-w-3xl mx-auto">Connect with meaningful causes that match your skills, interests, and schedule</p>

            <!-- Search Bar -->
            <div class="max-w-3xl mx-auto">
                <form action="{{ route('discover.index') }}" method="GET"> {{-- Make search functional later --}}
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" class="block w-full pl-10 pr-12 py-4 border border-transparent rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Search for opportunities, organizations, or causes...">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-r-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Filters Sidebar -->
        <div class="w-full lg:w-1/4">
            <div class="bg-white rounded-lg shadow p-6 sticky top-24"> {{-- Adjust top-X if nav height changes --}}
                <h2 class="text-xl font-semibold mb-6">Filter Opportunities</h2>
                <form action="{{ route('discover.index') }}" method="GET"> {{-- Filters form --}}
                    <!-- Categories -->
                    <div class="mb-6">
                        <h3 class="font-medium text-gray-900 mb-3">Categories</h3>
                        <div class="space-y-2">
                            @php $filterCategories = request('categories', []); @endphp
                            @foreach($categories as $category)
                            <div class="flex items-center">
                                <input id="category-{{ Str::slug($category) }}" name="categories[]" type="checkbox" value="{{ Str::slug($category) }}"
                                       @if(in_array(Str::slug($category), $filterCategories)) checked @endif
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="category-{{ Str::slug($category) }}" class="ml-3 text-sm text-gray-700">{{ $category }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Distance -->
                    <div class="mb-6">
                        <h3 class="font-medium text-gray-900 mb-3">Distance</h3>
                        <div class="px-2">
                            <input type="range" name="distance" min="0" max="50" value="{{ request('distance', 25) }}" class="w-full">
                        </div>
                        <div class="flex justify-between mt-1 text-xs text-gray-500">
                            <span>0 mi</span>
                            <span id="distanceValue">{{ request('distance', 25) }} mi</span> {{-- JS to update this --}}
                            <span>50 mi</span>
                        </div>
                    </div>

                    <!-- Date & Time -->
                    <div class="mb-6">
                        <h3 class="font-medium text-gray-900 mb-3">Date & Time</h3>
                        <div class="space-y-2">
                            @php $timeFilter = request('time', 'anytime'); @endphp
                            <div class="flex items-center">
                                <input id="anytime" name="time" type="radio" value="anytime" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" @if($timeFilter == 'anytime') checked @endif>
                                <label for="anytime" class="ml-3 text-sm text-gray-700">Anytime</label>
                            </div>
                            <div class="flex items-center">
                                <input id="weekend" name="time" type="radio" value="weekend" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" @if($timeFilter == 'weekend') checked @endif>
                                <label for="weekend" class="ml-3 text-sm text-gray-700">This Weekend</label>
                            </div>
                            {{-- Add other time radio buttons --}}
                        </div>
                    </div>

                    <!-- Skills -->
                    <div class="mb-6">
                        <h3 class="font-medium text-gray-900 mb-3">Skills</h3>
                        <div class="relative">
                            <input type="text" name="skills_search" value="{{ request('skills_search') }}" class="w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Search skills...">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                        <div class="mt-3 flex flex-wrap">
                            @php $filterSkills = request('skills', []); @endphp
                            @foreach($skills as $skill) {{-- Assuming $skills is an array of skill names --}}
                            <span class="skill-tag cursor-pointer hover:bg-blue-100 @if(in_array(Str::slug($skill), $filterSkills)) bg-blue-200 text-blue-800 @endif" data-skill="{{ Str::slug($skill) }}">{{ $skill }}</span>
                            <input type="checkbox" name="skills[]" value="{{ Str::slug($skill) }}" class="hidden skill-checkbox-{{ Str::slug($skill) }}" @if(in_array(Str::slug($skill), $filterSkills)) checked @endif>
                            @endforeach
                        </div>
                    </div>
                    {{-- Add Commitment Level & Opportunity Type filters similarly --}}

                    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Apply Filters
                    </button>
                    <a href="{{ route('discover.index') }}" class="w-full block text-center mt-2 text-blue-600 py-2 px-4 rounded-md hover:text-blue-700 focus:outline-none">
                        Reset All
                    </a>
                </form>
            </div>
        </div>

        <!-- Opportunities List -->
        <div class="w-full lg:w-2/4">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold">{{ $opportunities->count() }} Opportunities Found</h2> {{-- Make count dynamic --}}
                <div class="flex items-center">
                    <span class="text-sm text-gray-600 mr-2">Sort by:</span>
                    <select name="sort_by" class="border-gray-300 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500" onchange="this.form.submit()"> {{-- Assuming part of filter form --}}
                        <option value="relevance" @if(request('sort_by') == 'relevance') selected @endif>Most Relevant</option>
                        <option value="newest" @if(request('sort_by') == 'newest') selected @endif>Newest</option>
                        {{-- Add other sort options --}}
                    </select>
                </div>
            </div>

            <div class="space-y-4">
                @forelse ($opportunities as $opportunity)
                <div class="bg-white rounded-lg shadow overflow-hidden opportunity-card">
                    <div class="p-5">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <img class="h-12 w-12 rounded-full" src="{{ $opportunity->organization_logo_url ?? 'https://via.placeholder.com/48' }}" alt="Organization logo">
                            </div>
                            <div class="ml-4">
                                <div class="flex items-center">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $opportunity->title }}</h3>
                                    @if($opportunity->urgency_status)
                                    <span class="ml-2 px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">{{ $opportunity->urgency_status }}</span>
                                    @elseif($opportunity->is_virtual)
                                     <span class="ml-2 px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">Virtual</span>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-600">{{ $opportunity->organization_name }}</p>
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    @if($opportunity->is_virtual)
                                    <i class="fas fa-laptop mr-1"></i>
                                    <span>Remote Opportunity</span>
                                    @else
                                    <i class="fas fa-map-marker-alt mr-1"></i>
                                    <span>{{ $opportunity->location_short }} · {{ $opportunity->distance }}</span>
                                    @endif
                                </div>
                                <div class="mt-1 flex items-center text-sm text-gray-500">
                                    <i class="fas fa-calendar-alt mr-1"></i>
                                    <span>{{ $opportunity->datetime_display }}</span>
                                </div>
                                <div class="mt-3">
                                    <p class="text-sm text-gray-700">{{ $opportunity->description_short }}</p>
                                </div>
                                @if(!empty($opportunity->skills_needed))
                                <div class="mt-3">
                                    <p class="text-sm font-medium text-gray-700 mb-1">Skills Needed:</p>
                                    <div class="flex flex-wrap">
                                        @foreach($opportunity->skills_needed as $skill)
                                        <span class="skill-tag"><i class="{{ $skill->icon ?? 'fas fa-check' }} mr-1"></i> {{ $skill->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3 flex items-center justify-between border-t">
                        <div class="flex items-center">
                            @if(!empty($opportunity->signed_up_avatars))
                            <div class="flex -space-x-1 overflow-hidden">
                                @foreach(collect($opportunity->signed_up_avatars)->take(3) as $avatarUrl)
                                <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white" src="{{ $avatarUrl }}" alt="">
                                @endforeach
                            </div>
                            @endif
                            <span class="ml-2 text-sm text-gray-500">
                                @if($opportunity->signed_up_count > 0)
                                    +{{ $opportunity->signed_up_count }} others signed up
                                @else
                                    Be the first to sign up!
                                @endif
                            </span>
                        </div>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                                <i class="far fa-heart mr-1"></i> Save
                            </button>
                            <button class="px-4 py-1 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">
                                <i class="fas fa-hand-holding-heart mr-1"></i> Volunteer
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-center text-gray-500 py-10">No opportunities found matching your criteria.</p>
                @endforelse
            </div>

            <!-- Pagination -->
            {{-- Add pagination links if using $opportunities->links() from controller --}}
            {{-- <div class="mt-8"> $opportunities->links() </div> --}}
        </div>

        <!-- Map Sidebar -->
        <div class="hidden lg:block lg:w-1/4">
            <div class="bg-white rounded-lg shadow p-4 sticky top-24">
                <h2 class="text-xl font-semibold mb-4">Opportunities Near You</h2>
                <div class="map-container mb-4">
                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                        <i class="fas fa-map-marked-alt text-4xl text-gray-400"></i>
                        <span class="ml-2 text-gray-400">Map Placeholder</span>
                    </div>
                </div>
                {{-- Static map items, make dynamic later --}}
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                            <i class="fas fa-map-pin text-blue-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Beach Cleanup</p>
                            <p class="text-xs text-gray-500">2.3 mi away · Santa Monica</p>
                        </div>
                    </div>
                </div>
                <div class="mt-6">
                    <h3 class="font-medium text-gray-900 mb-2">Recommended For You</h3>
                    {{-- Static recommendations, make dynamic later --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/discovery_scripts.js') }}"></script>
    <script>
        // Basic JS for range slider value display
        const rangeInput = document.querySelector('input[type="range"][name="distance"]');
        const distanceValueSpan = document.getElementById('distanceValue');
        if (rangeInput && distanceValueSpan) {
            rangeInput.addEventListener('input', (event) => {
                distanceValueSpan.textContent = event.target.value + ' mi';
            });
        }
        // JS for skill tag selection (toggle checkbox)
        document.querySelectorAll('.skill-tag[data-skill]').forEach(tag => {
            tag.addEventListener('click', () => {
                const skillSlug = tag.dataset.skill;
                const checkbox = document.querySelector(`.skill-checkbox-${skillSlug}`);
                if (checkbox) {
                    checkbox.checked = !checkbox.checked;
                    tag.classList.toggle('bg-blue-200');
                    tag.classList.toggle('text-blue-800');
                }
            });
        });
    </script>
@endpush