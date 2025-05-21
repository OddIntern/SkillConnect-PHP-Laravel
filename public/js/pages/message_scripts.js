// Sample conversation data
const conversations = [
    {
        id: 1,
        name: "Sarah Johnson",
        avatar: "https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
        status: "Online",
        unread: 3,
        lastMessage: "Sounds great! I'll bring the supplies.",
        lastMessageTime: "10:30 AM",
        messages: [
            { text: "Hi there! Thanks for volunteering for the beach cleanup this weekend.", time: "10:15 AM", sent: false },
            { text: "Happy to help! What time should I arrive and what should I bring?", time: "10:18 AM", sent: true },
            { text: "We'll start at 9am at the main lifeguard station. Bring sunscreen, water, and wear comfortable clothes. We'll provide gloves and trash bags.", time: "10:20 AM", sent: false },
            { text: "Perfect! I can also bring some extra trash bags if needed.", time: "10:25 AM", sent: true },
            { text: "That would be amazing! We're expecting a big turnout so extra supplies will definitely help.", time: "10:30 AM", sent: false }
        ]
    },
    {
        id: 2,
        name: "Community Food Bank",
        avatar: "https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
        status: "Offline",
        unread: 0,
        lastMessage: "Thank you for volunteering last weekend!",
        lastMessageTime: "Yesterday",
        messages: [
            { text: "Hello! We wanted to thank you for your help last weekend.", time: "Yesterday", sent: false },
            { text: "You're welcome! I had a great time and would love to volunteer again.", time: "Yesterday", sent: true },
            { text: "Thank you for volunteering last weekend!", time: "Yesterday", sent: false }
        ]
    },
    {
        id: 3,
        name: "Michael Chen",
        avatar: "https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
        status: "Online",
        unread: 1,
        lastMessage: "Are you still available to help with the park cleanup?",
        lastMessageTime: "Tue",
        messages: [
            { text: "Hi, are you still available to help with the park cleanup this Saturday?", time: "Tue", sent: false },
            { text: "Yes, I should be available. What time?", time: "Tue", sent: true },
            { text: "Are you still available to help with the park cleanup?", time: "Tue", sent: false }
        ]
    },
    {
        id: 4,
        name: "Animal Rescue LA",
        avatar: "https://images.unsplash.com/photo-1507101105822-7472b28e22ac?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
        status: "Offline",
        unread: 0,
        lastMessage: "New volunteer orientation next Monday at 5pm",
        lastMessageTime: "Mon",
        messages: [
            { text: "Hello! We're having a new volunteer orientation next Monday at 5pm.", time: "Mon", sent: false },
            { text: "Thanks for letting me know! I'll check my schedule and get back to you.", time: "Mon", sent: true },
            { text: "New volunteer orientation next Monday at 5pm", time: "Mon", sent: false }
        ]
    },
    {
        id: 5,
        name: "Youth Mentorship Program",
        avatar: "https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
        status: "Online",
        unread: 0,
        lastMessage: "Your mentee has some questions about college applications",
        lastMessageTime: "Jun 12",
        messages: [
            { text: "Hi, your mentee has some questions about college applications.", time: "Jun 12", sent: false },
            { text: "I'd be happy to help! When would be a good time to meet?", time: "Jun 12", sent: true },
            { text: "Your mentee has some questions about college applications", time: "Jun 12", sent: false }
        ]
    },
    {
        id: 6,
        name: "Habitat for Humanity",
        avatar: "https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
        status: "Offline",
        unread: 0,
        lastMessage: "Construction volunteer training next month",
        lastMessageTime: "Jun 10",
        messages: [
            { text: "We're offering construction volunteer training next month if you're interested.", time: "Jun 10", sent: false },
            { text: "That sounds great! Can you send me more details about dates?", time: "Jun 10", sent: true },
            { text: "Construction volunteer training next month", time: "Jun 10", sent: false }
        ]
    }
];

// Current active conversation
let activeConversation = null;

// DOM elements
const conversationsList = document.getElementById('conversations-list');
const messagesHeader = document.getElementById('messages-header');
const currentAvatar = document.getElementById('current-avatar');
const currentContact = document.getElementById('current-contact');
const currentStatus = document.getElementById('current-status');
const messagesContainer = document.getElementById('messages-container');
const messageInputContainer = document.getElementById('message-input-container');
const messageInput = document.getElementById('message-input');
const sendButton = document.getElementById('send-button');
const searchInput = document.getElementById('search-conversations');
const mobileMenuButton = document.getElementById('mobile-menu-button');
const mobileMenu = document.getElementById('mobile-menu'); // Ensure this ID exists in your HTML
const userMenuButton = document.getElementById('user-menu');
const userDropdown = document.getElementById('user-dropdown'); // Ensure this ID exists


// Initialize the app
function init() {
    renderConversationsList();
    setupEventListeners();
    // Initially hide message input if no conversation is selected
    if (!activeConversation && messageInputContainer) {
        messageInputContainer.style.display = 'none';
    }
    // Initial setup for the message area if no conversation is selected
    if (!activeConversation && messagesContainer) {
        messagesContainer.innerHTML = `
            <div class="flex items-center justify-center h-full">
                <div class="text-center text-gray-500">
                    <i class="fas fa-comments text-4xl mb-2"></i>
                    <p>Select a conversation to start messaging</p>
                </div>
            </div>`;
    }
    if (currentAvatar) currentAvatar.style.display = 'none'; // Hide avatar initially
}

// Render conversations list
function renderConversationsList(filter = '') {
    if (!conversationsList) return;
    conversationsList.innerHTML = '';
    
    const filteredConversations = conversations.filter(convo => 
        convo.name.toLowerCase().includes(filter.toLowerCase())
    );
    
    filteredConversations.forEach(conversation => {
        const convoElement = document.createElement('div');
        convoElement.className = `conversation-item p-4 border-b border-gray-200 cursor-pointer flex items-center ${activeConversation?.id === conversation.id ? 'active-conversation' : 'hover:bg-gray-100'}`;
        convoElement.dataset.id = conversation.id;
        
        const statusColor = conversation.status === 'Online' ? 'bg-green-400' : 'bg-gray-300';
        
        convoElement.innerHTML = `
            <div class="flex-shrink-0 relative">
                <img class="h-10 w-10 rounded-full" src="${conversation.avatar}" alt="${conversation.name} avatar" onerror="this.onerror=null; this.src='https://via.placeholder.com/40?text=${conversation.name.charAt(0)}';">
                <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full ${statusColor} ring-2 ring-white"></span>
            </div>
            <div class="ml-3 flex-1 overflow-hidden">
                <div class="flex justify-between items-baseline">
                    <p class="text-sm font-medium text-gray-900 truncate">${conversation.name}</p>
                    <p class="text-xs text-gray-500">${conversation.lastMessageTime}</p>
                </div>
                <p class="text-sm text-gray-500 truncate">${conversation.lastMessage}</p>
            </div>
            ${conversation.unread > 0 ? `<div class="ml-2"><span class="unread-badge">${conversation.unread}</span></div>` : ''}
        `;
        
        conversationsList.appendChild(convoElement);
    });
}

// Set up event listeners
function setupEventListeners() {
    // Conversation item click
    if (conversationsList) {
        conversationsList.addEventListener('click', (e) => {
            const convoItem = e.target.closest('.conversation-item');
            if (convoItem) {
                const convoId = parseInt(convoItem.dataset.id);
                setActiveConversation(convoId);
            }
        });
    }
    
    // Send message
    if (sendButton) sendButton.addEventListener('click', sendMessage);
    if (messageInput) {
        messageInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault(); // Prevent form submission if inside a form
                sendMessage();
            }
        });
    }
    
    // Search conversations
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            renderConversationsList(e.target.value);
        });
    }

    // Mobile menu toggle
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // User dropdown toggle
    if (userMenuButton && userDropdown) {
        userMenuButton.addEventListener('click', function() {
            userDropdown.classList.toggle('hidden');
        });
         // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!userMenuButton.contains(event.target) && !userDropdown.contains(event.target)) {
                userDropdown.classList.add('hidden');
            }
        });
    }
}

// Set active conversation
function setActiveConversation(convoId) {
    const previouslyActive = document.querySelector('.conversation-item.active-conversation');
    if (previouslyActive) {
        previouslyActive.classList.remove('active-conversation');
        previouslyActive.classList.add('hover:bg-gray-100');
    }

    activeConversation = conversations.find(c => c.id === convoId);
    
    const currentActiveItem = conversationsList.querySelector(`.conversation-item[data-id="${convoId}"]`);
    if (currentActiveItem) {
        currentActiveItem.classList.add('active-conversation');
        currentActiveItem.classList.remove('hover:bg-gray-100');
    }

    // Update UI
    updateActiveConversationUI();
    renderMessages();
    
    // Mark as read
    if (activeConversation) {
        activeConversation.unread = 0;
        renderConversationsList(searchInput ? searchInput.value : ''); // Re-render with current filter
    }
}

// Update active conversation UI
function updateActiveConversationUI() {
    if (!activeConversation || !currentAvatar || !currentContact || !currentStatus || !messageInputContainer) return;

    currentAvatar.src = activeConversation.avatar;
    currentAvatar.alt = `${activeConversation.name} avatar`;
    currentAvatar.style.display = 'block'; // Show avatar
    currentContact.textContent = activeConversation.name;
    currentStatus.textContent = activeConversation.status;
    currentStatus.className = `text-xs ${activeConversation.status === 'Online' ? 'text-green-500' : 'text-gray-500'}`;
    
    // Show message input
    messageInputContainer.style.display = 'flex'; // Assuming it's a flex container
    messageInput.focus();
}

// Render messages for active conversation
function renderMessages() {
    if (!messagesContainer) return;
    messagesContainer.innerHTML = ''; // Clear previous messages or placeholder
    
    if (!activeConversation) {
         messagesContainer.innerHTML = `
            <div class="flex items-center justify-center h-full">
                <div class="text-center text-gray-500">
                    <i class="fas fa-comments text-4xl mb-2"></i>
                    <p>Select a conversation to start messaging</p>
                </div>
            </div>`;
        if (messageInputContainer) messageInputContainer.style.display = 'none';
        if (currentAvatar) currentAvatar.style.display = 'none';
        if (currentContact) currentContact.textContent = 'Select a conversation';
        if (currentStatus) currentStatus.textContent = '';
        return;
    }
    
    // Add date divider (example, can be dynamic)
    // addDateDivider('Today'); 
    
    activeConversation.messages.forEach(message => {
        addMessageToUI(message.text, message.time, message.sent);
    });
    
    // Scroll to bottom
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
}

// Add date divider to UI
function addDateDivider(date) {
    if (!messagesContainer) return;
    const divider = document.createElement('div');
    divider.className = 'flex items-center my-4';
    divider.innerHTML = `
        <div class="flex-grow border-t border-gray-300"></div>
        <span class="flex-shrink mx-2 text-xs text-gray-500">${date}</span>
        <div class="flex-grow border-t border-gray-300"></div>
    `;
    messagesContainer.appendChild(divider);
}

// Add message to UI
function addMessageToUI(text, time, isSent) {
    if (!messagesContainer) return;
    const messageDiv = document.createElement('div');
    messageDiv.className = `message-bubble flex flex-col ${isSent ? 'sent ml-auto' : 'received mr-auto'}`; // Added ml-auto/mr-auto for alignment
    
    const textP = document.createElement('p');
    textP.textContent = text;
    
    const timeP = document.createElement('p');
    timeP.className = `text-xs mt-1 ${isSent ? 'text-blue-100 self-end' : 'text-gray-500 self-start'}`; // Align time based on sender
    timeP.textContent = time;

    messageDiv.appendChild(textP);
    messageDiv.appendChild(timeP);
    messagesContainer.appendChild(messageDiv);
}

// Send message
function sendMessage() {
    if (!messageInput || !activeConversation) return;
    const messageText = messageInput.value.trim();
    if (messageText) {
        const now = new Date();
        const timeString = now.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit', hour12: true});
        
        activeConversation.messages.push({
            text: messageText,
            time: timeString,
            sent: true
        });
        
        activeConversation.lastMessage = messageText;
        activeConversation.lastMessageTime = timeString;
        
        addMessageToUI(messageText, timeString, true);
        renderConversationsList(searchInput ? searchInput.value : '');
        
        messageInput.value = '';
        if (messagesContainer) messagesContainer.scrollTop = messagesContainer.scrollHeight;
        messageInput.focus(); // Keep focus on input
    }
}

// Initialize the app
document.addEventListener('DOMContentLoaded', init);