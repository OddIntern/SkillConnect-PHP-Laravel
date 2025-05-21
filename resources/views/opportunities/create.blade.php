@extends('layouts.app')

@section('title', 'New Post | SkillConnect')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/new_post_styles.css') }}">
@endpush

@section('content')
<main class="flex-grow container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white p-6 sm:p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-6">Create New Volunteer Opportunity</h1>

        {{-- Display general form errors if any --}}
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">There were some problems with your input.</span>
                <ul class="mt-3 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('opportunities.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label for="post-title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="post-title" id="post-title" value="{{ old('post-title') }}" required
                       class="mt-1 block w-full px-3 py-2 border {{ $errors->has('post-title') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="e.g., Beach Cleanup Drive">
                @error('post-title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="post-description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="post-description" name="post-description" rows="4" required
                          class="mt-1 block w-full px-3 py-2 border {{ $errors->has('post-description') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Describe the volunteer opportunity in detail...">{{ old('post-description') }}</textarea>
                @error('post-description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="post-category" class="block text-sm font-medium text-gray-700">Category</label>
                <select id="post-category" name="post-category" required
                        class="mt-1 block w-full px-3 py-2 border {{ $errors->has('post-category') ? 'border-red-500' : 'border-gray-300' }} bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="" disabled {{ old('post-category') ? '' : 'selected' }}>Select a category</option>
                    @foreach($categories as $categoryValue)
                    <option value="{{ $categoryValue }}" {{ old('post-category') == $categoryValue ? 'selected' : '' }}>{{ ucfirst($categoryValue) }}</option>
                    @endforeach
                </select>
                @error('post-category') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="post-date" class="block text-sm font-medium text-gray-700">Date</label>
                    <input type="date" name="post-date" id="post-date" value="{{ old('post-date') }}" required
                           class="mt-1 block w-full px-3 py-2 border {{ $errors->has('post-date') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    @error('post-date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="post-time" class="block text-sm font-medium text-gray-700">Time</label>
                    <input type="time" name="post-time" id="post-time" value="{{ old('post-time') }}" required
                           class="mt-1 block w-full px-3 py-2 border {{ $errors->has('post-time') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    @error('post-time') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="post-location" class="block text-sm font-medium text-gray-700">Location</label>
                <input type="text" name="post-location" id="post-location" value="{{ old('post-location') }}" required
                       class="mt-1 block w-full px-3 py-2 border {{ $errors->has('post-location') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="e.g., Santa Monica Pier, CA or 'Remote'">
                @error('post-location') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="post-volunteers-needed" class="block text-sm font-medium text-gray-700">Number of Volunteers Needed</label>
                <input type="number" name="post-volunteers-needed" id="post-volunteers-needed" value="{{ old('post-volunteers-needed') }}" min="1" required
                       class="mt-1 block w-full px-3 py-2 border {{ $errors->has('post-volunteers-needed') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="e.g., 10">
                @error('post-volunteers-needed') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="post-skills" class="block text-sm font-medium text-gray-700">Skills Required (Optional)</label>
                <input type="text" name="post-skills" id="post-skills" value="{{ old('post-skills') }}"
                       class="mt-1 block w-full px-3 py-2 border {{ $errors->has('post-skills') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="e.g., Teaching, First Aid, Coding (comma-separated)">
                <p class="mt-1 text-xs text-gray-500">Separate skills with a comma. These will be displayed as tags.</p>
                @error('post-skills') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Upload Image (Optional)</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 {{ $errors->has('file-upload') ? 'border-red-500' : 'border-gray-300' }} border-dashed rounded-md">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                <span>Upload a file</span>
                                <input id="file-upload" name="file-upload" type="file" class="sr-only" accept="image/*">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                    </div>
                </div>
                @error('file-upload') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                <div id="image-preview-container" class="mt-2 hidden">
                    <p class="text-sm font-medium text-gray-700">Image Preview:</p>
                    <img id="image-preview" src="#" alt="Image Preview" class="mt-1 max-h-48 rounded-md"/>
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <a href="{{ url()->previous() }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 mr-3">
                    Cancel
                </a>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-plus mr-2"></i>Post Opportunity
                </button>
            </div>
        </form>
    </div>
</main>
@endsection

@push('scripts')
<script>
    // Image preview for file upload (from original new_post.html)
    const fileUpload = document.getElementById('file-upload');
    const imagePreview = document.getElementById('image-preview');
    const imagePreviewContainer = document.getElementById('image-preview-container');

    if (fileUpload) {
        fileUpload.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreviewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                imagePreview.src = '#';
                imagePreviewContainer.classList.add('hidden');
                // Optionally clear the file input if the file is not an image
                // event.target.value = null;
            }
        });
    }
</script>
@endpush