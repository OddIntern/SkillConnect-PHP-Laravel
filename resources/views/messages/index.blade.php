@extends('layouts.app')

@section('title', 'Messages | SkillConnect')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/message_styles.css') }}">
@endpush

@section('content')
<!-- Messages Header -->
<div class="gradient-bg text-white py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold mb-2">Messages</h1>
                <p class="text-blue-100">Connect with volunteers and organizations</p>
            </div>
            <button class="bg-white text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-full text-sm font-medium transition duration-300">
                <i class="fas fa-envelope mr-1"></i> New Message
            </button>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="flex flex-col md:flex-row h-[calc(100vh-280px)]"> {{-- Adjust height based on your nav/footer --}}
            <!-- Conversations List -->
            <div class="w-full md:w-1/3 border-r border-gray-200 bg-gray-50">
                <div class="p-4 border-b border-gray-200">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" id="search-conversations" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md text-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Search conversations...">
                    </div>
                </div>

                <div class="overflow-y-auto h-full" id="conversations-list">
                    @forelse($conversations as $conversation)
                    <a href="#" class="flex items-center p-4 border-b border-gray-100 conversation-item {{ $conversation->is_active ? 'active-conversation' : '' }} hover:bg-slate-100" data-conversation-id="{{ $conversation->id }}">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" src="{{ $conversation->contact_avatar_url }}" alt="{{ $conversation->contact_name }}">
                        </div>
                        <div class="ml-3 flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">{{ $conversation->contact_name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ $conversation->last_message_preview }}</p>
                        </div>
                        <div class="ml-2 text-right">
                            <p class="text-xs text-gray-400">{{ $conversation->last_message_time }}</p>
                            @if($conversation->unread_count > 0)
                            <span class="mt-1 unread-badge">{{ $conversation->unread_count }}</span>
                            @endif
                        </div>
                    </a>
                    @empty
                    <p class="p-4 text-sm text-gray-500">No conversations yet.</p>
                    @endforelse
                </div>
            </div>

            <!-- Messages Area -->
            <div class="w-full md:w-2/3 flex flex-col">
                @if($activeConversation)
                <!-- Messages Header -->
                <div class="p-4 border-b border-gray-200 flex items-center" id="messages-header">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full" id="current-avatar" src="{{ $activeConversation->contact_avatar_url }}" alt="{{ $activeConversation->contact_name }}">
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900" id="current-contact">{{ $activeConversation->contact_name }}</p>
                        <p class="text-xs text-gray-500" id="current-status">{{ $activeConversation->status }}</p>
                    </div>
                    <div class="ml-auto flex space-x-2">
                        <button class="p-2 rounded-full hover:bg-gray-100"><i class="fas fa-phone text-gray-500"></i></button>
                        <button class="p-2 rounded-full hover:bg-gray-100"><i class="fas fa-video text-gray-500"></i></button>
                        <button class="p-2 rounded-full hover:bg-gray-100"><i class="fas fa-ellipsis-v text-gray-500"></i></button>
                    </div>
                </div>

                <!-- Messages Container -->
                <div class="message-container flex-1 p-4 overflow-y-auto bg-gray-50 flex flex-col" id="messages-container">
                    @forelse($messages as $message)
                    <div class="message-bubble {{ $message->sender_type == 'sent' ? 'sent' : 'received' }}">
                        @if($message->sender_type == 'received')
                        <p class="text-xs text-gray-600 mb-1">{{ $message->sender_name }}</p>
                        @endif
                        <p>{{ $message->text }}</p>
                        <p class="text-xs mt-1 {{ $message->sender_type == 'sent' ? 'text-blue-200' : 'text-gray-500' }} text-right">{{ $message->time }}</p>
                    </div>
                    @empty
                    <div class="flex items-center justify-center h-full">
                        <div class="text-center text-gray-500">
                            <i class="fas fa-comments text-4xl mb-2"></i>
                            <p>No messages in this conversation yet.</p>
                        </div>
                    </div>
                    @endforelse
                    {{-- Typing indicator (controlled by JS) --}}
                    <div class="typing-indicator self-start">
                        <span class="typing-dot"></span><span class="typing-dot"></span><span class="typing-dot"></span>
                    </div>
                </div>

                <!-- Message Input -->
                <div class="p-4 border-t border-gray-200 bg-white" id="message-input-container">
                    <div class="flex items-center">
                        <button class="p-2 rounded-full hover:bg-gray-100 mr-2"><i class="fas fa-paperclip text-gray-500"></i></button>
                        <input type="text" id="message-input" class="message-input flex-1 border border-gray-300 rounded-full py-2 px-4 focus:border-blue-500 focus:ring-blue-500" placeholder="Type your message...">
                        <button id="send-button" class="ml-2 p-2 rounded-full bg-blue-500 text-white hover:bg-blue-600">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
                @else
                <!-- Placeholder for when no conversation is selected -->
                 <div class="flex-1 flex items-center justify-center p-4 bg-gray-50">
                    <div class="text-center text-gray-500">
                        <i class="fas fa-comments text-4xl mb-2"></i>
                        <p>Select a conversation to start messaging</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/message_scripts.js') }}"></script>
    {{-- Add JS to handle selecting conversations, loading messages, sending messages (AJAX) --}}
@endpush