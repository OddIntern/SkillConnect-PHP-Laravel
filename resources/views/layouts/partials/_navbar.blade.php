<!-- Original: -->
<!-- <a href="index.html" class="border-blue-500 tab-active ...">Home</a> -->
<!-- <a href="discovery.html" class="border-transparent ...">Discover</a> -->

<!-- Laravel Blade: -->
<a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'border-blue-500 tab-active' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Home</a>
<a href="{{ route('discover.index') }}" class="{{ request()->routeIs('discover.index') ? 'border-blue-500 tab-active' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Discover</a>
<a href="{{ route('messages.index') }}" class="{{ request()->routeIs('messages.index') ? 'border-blue-500 tab-active' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Messages</a>
<a href="{{ route('projects.index') }}" class="{{ request()->routeIs('projects.index') ? 'border-blue-500 tab-active' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">My Projects</a>