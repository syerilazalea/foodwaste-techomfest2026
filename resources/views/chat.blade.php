<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Test</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/js/app.js'])
</head>
<body class="bg-gray-100 h-screen flex flex-col">

    <!-- Header -->
    <div class="bg-white shadow p-4">
        <h1 class="text-xl font-bold">Laravel Reverb Chat</h1>
        <p class="text-sm text-gray-500">Logged in as: {{ auth()->user()->name ?? 'Guest' }}</p>
    </div>

    <!-- Chat Area -->
    <div id="chat-container" class="flex-1 overflow-y-auto p-4 space-y-4">
        <!-- Messages will appear here -->
    </div>

    <!-- Input Area -->
    <div class="bg-white p-4 border-t flex items-center gap-2">
        <input type="text" id="messageInput" class="flex-1 border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Type a message...">
        <button onclick="sendMessage()" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition">Send</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chatContainer = document.getElementById('chat-container');

            // Listen for messages
            setTimeout(() => {
                 window.Echo.channel('chat')
                .listen('MessageSent', (e) => {
                    console.log('Message received:', e);
                    appendMessage(e.user.name, e.message.message, e.user.id == "{{ auth()->id() }}");
                });
            }, 1000); // Small delay to ensure Echo is loaded

           
            // Send message function
            window.sendMessage = function() {
                const input = document.getElementById('messageInput');
                const message = input.value;

                if (message.trim() === '') return;

                axios.post('/chat/send', {
                    message: message
                })
                .then(response => {
                    input.value = ''; // Clear input
                    // Optionally append immediately for UX, but the echo event will also do it
                })
                .catch(error => {
                    console.error(error);
                    alert('Error sending message');
                });
            }

            // Handle Enter key
            document.getElementById('messageInput').addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    sendMessage();
                }
            });

            function appendMessage(user, text, isMe) {
                const div = document.createElement('div');
                div.className = `flex ${isMe ? 'justify-end' : 'justify-start'}`;
                
                const bubble = document.createElement('div');
                bubble.className = `max-w-xs md:max-w-md rounded-lg px-4 py-2 ${isMe ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800'}`;
                
                const name = document.createElement('div');
                name.className = 'text-xs opacity-75 mb-1';
                name.innerText = user;

                const content = document.createElement('div');
                content.innerText = text;

                bubble.appendChild(name);
                bubble.appendChild(content);
                div.appendChild(bubble);
                
                chatContainer.appendChild(div);
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }
        });
    </script>
</body>
</html>
