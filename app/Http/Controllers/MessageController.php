<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
// use App\Models\Conversation; // Example
// use App\Models\Message;     // Example

class MessageController extends Controller
{
    public function index(): View
    {
        // Dummy data for conversations
        $conversations = collect([
            (object)[
                'id' => 1,
                'contact_name' => 'Sarah Johnson',
                'contact_avatar_url' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
                'last_message_preview' => 'Hey, are you available for the cleanup?',
                'last_message_time' => '10:30 AM',
                'unread_count' => 2,
                'is_active' => true, // To show which one is selected
                 'status' => 'Online'
            ],
            (object)[
                'id' => 2,
                'contact_name' => 'Michael Chen',
                'contact_avatar_url' => 'https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
                'last_message_preview' => 'Thanks for the tutoring session!',
                'last_message_time' => 'Yesterday',
                'unread_count' => 0,
                'is_active' => false,
                'status' => 'Last seen 2 hours ago'
            ],
        ]);

        // Dummy data for messages of the active conversation
        $activeConversation = $conversations->firstWhere('is_active', true);
        $messages = collect([]);
        if ($activeConversation) {
             $messages = collect([
                (object)['id' => 1, 'text' => 'Hey, are you available for the cleanup?', 'time' => '10:28 AM', 'sender_type' => 'received', 'sender_name' => 'Sarah Johnson'],
                (object)['id' => 2, 'text' => 'Yes, I can make it! What time should I be there?', 'time' => '10:29 AM', 'sender_type' => 'sent', 'sender_name' => 'You'],
                (object)['id' => 3, 'text' => 'Great! 9 AM at the pier.', 'time' => '10:30 AM', 'sender_type' => 'received', 'sender_name' => 'Sarah Johnson'],
             ]);
        }


        return view('messages.index', compact('conversations', 'messages', 'activeConversation'));
    }
}