<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{asset('TSR1.png')}}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="{{asset('vendor1')}}/css/styles.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body class="d-flex flex-column h-100">
  <!-- Loading Screen -->
  <div id="loading-screen" class="loading-screen">
    <img src="{{ asset('TSR1.png') }}" alt="Loading" class="loading-logo">
  </div>
  <style>
    /* Fullscreen loader */
    .loading-screen {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #ffffff; /* or any background color you prefer */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999; /* Ensure it's above everything */
    }

    /* Logo animation */
    .loading-logo {
        width: 150px; /* Adjust size as needed */
        animation: linear infinite; /* Infinite spinning */
    }

    /* Spin animation */
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
  </style>
  <script>
    window.addEventListener('load', function() {
        const loader = document.getElementById('loading-screen');
        loader.style.transition = 'opacity 0.5s ease'; // Fade-out effect
        loader.style.opacity = '0';

        setTimeout(() => {
            loader.style.display = 'none'; // Completely hide after fade-out
        }, 500); // Match the fade-out duration
    });
  </script>


    <main class="flex-shrink-0">
        @include('layouts.topbar')
        
        @if (session('success'))
        <script>
          document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
              icon: 'success',
              title: 'Success!',
              text: '{{ session('success') }}',
              showConfirmButton: false,
              timer: 3000
            });
          });
        </script>
        @endif

        @if (session('error'))
        <script>
          document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
              icon: 'error',
              title: 'Error!',
              text: '{{ session('error') }}',
              showConfirmButton: false,
              timer: 3000
            });
          });
        </script>
        @endif

        @if ($errors->any())
        <script>
          document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
              icon: 'error',
              title: 'Validation Error!',
              html: '<ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>',
              showConfirmButton: true
            });
          });
        </script>
        @endif
        @yield('content')
    </main>
    @include('layouts.footer')
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://kit.fontawesome.com/85ec87b76d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('vendor1')}}/js/scripts.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
          var options = {
            damping: '0.5'
          }
          Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Live Chat Floating Button -->
<!-- HTML -->
<!-- Live Chat Component -->
<div id="liveChatContainer">
    <div id="chatButton" class="chat-button" style="position: relative;">
        <i class="bi bi-chat-dots-fill"></i>
        <span id="newMessageIndicator" style="
            display:none;
            position: absolute;
            top: 6px;
            right: 6px;
            width: 12px;
            height: 12px;
            background: red;
            border-radius: 50%;
            border: 2px solid white;
            box-shadow: 0 0 4px rgba(255,0,0,0.6);
        "></span>
    </div>

    <div id="chatBox" class="chat-box d-none">
        <div class="chat-header">
            Chat
            <span id="closeChat" class="close-chat">&times;</span>
        </div>
        <div class="chat-body" id="chatMessages">
            <p class="text-muted text-center">Start chatting...</p>
        </div>
        <div id="previewContainer" class="p-2 d-none border-top" style="background-color: #f1f1f1;">
            <div id="filePreview" class="small text-muted">Preview:</div>
        </div>
        <div class="chat-footer">
            <input type="text" id="chatInput" class="form-control" placeholder="Type a message...">
            <input type="file" id="fileInput" hidden>
            <button class="btn btn-secondary btn-sm" onclick="document.getElementById('fileInput').click()">
                <i class="bi bi-paperclip"></i>
            </button>
            <button class="btn btn-primary btn-sm" id="sendBtn"><i class="bi bi-send-fill"></i></button>
        </div>
    </div>
</div>

<!-- CSS -->
<style>
#liveChatContainer {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1050;
}

.chat-button {
    width: 60px;
    height: 60px;
    background-color: #007bff;
    color: white;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    cursor: pointer;
    font-size: 1.5rem;
}

.chat-box {
    width: 400px;
    height: 550px;
    background: white;
    border-radius: 10px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
    margin-bottom: 10px;
}

.chat-header {
    background: #007bff;
    color: white;
    padding: 10px;
    font-weight: bold;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.chat-body {
    flex: 1;
    padding: 10px;
    overflow-y: auto;
    background-color: #f8f9fa;
}

.chat-footer {
    display: flex;
    padding: 10px;
    gap: 5px;
    border-top: 1px solid #ddd;
}

.close-chat {
    cursor: pointer;
    font-size: 1.2rem;
}

.preview-image {
    max-width: 100%;
    max-height: 120px;
    border-radius: 6px;
}

.preview-file {
    font-size: 0.875rem;
    color: #333;
}
</style>

<!-- JavaScript -->
<script>
function getUserToken() {
    let token = localStorage.getItem("user_token");
    if (!token) {
        token = self.crypto.randomUUID();
        localStorage.setItem("user_token", token);
    }
    return token;
}

const chatButton = document.getElementById('chatButton');
const chatBox = document.getElementById('chatBox');
const closeChat = document.getElementById('closeChat');
const sendBtn = document.getElementById('sendBtn');
const chatInput = document.getElementById('chatInput');
const chatMessages = document.getElementById('chatMessages');
const fileInput = document.getElementById('fileInput');
const filePreview = document.getElementById('filePreview');
const previewContainer = document.getElementById('previewContainer');
const newMessageIndicator = document.getElementById('newMessageIndicator');

let lastMessageCount = 0;

chatButton.addEventListener('click', () => {
    chatBox.classList.toggle('d-none');
    if (!chatBox.classList.contains('d-none')) {
        newMessageIndicator.style.display = 'none';
        loadChatMessages();
    }
});

closeChat.addEventListener('click', () => {
    chatBox.classList.add('d-none');
});

sendBtn.addEventListener('click', sendMessage);
chatInput.addEventListener('keypress', function (e) {
    if (e.key === 'Enter') sendMessage();
});

fileInput.addEventListener('change', previewFile);

async function loadChatMessages() {
    const token = getUserToken();
    try {
        const response = await fetch(`/api/chats/${token}`);
        if (response.ok) {
            const messages = await response.json();
            const newCount = messages.length;
            const newMessage = newCount > lastMessageCount;
            lastMessageCount = newCount;

            chatMessages.innerHTML = '';
            if (messages.length === 0) {
                chatMessages.innerHTML = '<p class="text-muted text-center">Start chatting...</p>';
            } else {
                messages.forEach(msg => {
                    const div = document.createElement('div');
                    div.className = `d-flex mb-2 justify-content-${msg.sender === 'User' ? 'start' : 'end'}`;
                    const isImage = msg.file && msg.file.match(/\.(jpeg|jpg|png|gif|webp)$/i);
                    const fileContent = msg.file
                        ? (isImage
                            ? `<img src="${msg.file}" style="max-width: 150px; max-height: 150px;" class="rounded">`
                            : `<a href="${msg.file}" target="_blank">Download file</a>`)
                        : msg.message;

                    div.innerHTML = `
                        <div class="px-3 py-2 rounded ${msg.sender === 'User' ? 'bg-secondary text-white' : 'bg-success text-white'}">
                            <small><strong>${msg.sender}</strong>:</small><br>
                            ${fileContent}
                        </div>
                    `;
                    chatMessages.appendChild(div);
                });
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            // Show red dot if chat closed and new message received
            if (chatBox.classList.contains('d-none') && newMessage) {
                newMessageIndicator.style.display = 'block';
            }
        }
    } catch (error) {
        console.error('Error fetch chat:', error);
    }
}

async function sendMessage() {
    const message = chatInput.value.trim();
    if (!message && !fileInput.files.length) return;

    const token = getUserToken();

    if (fileInput.files.length > 0) {
        await sendFile();
        fileInput.value = '';
        filePreview.innerHTML = '';
        previewContainer.classList.add('d-none');
    }

    if (message) {
        try {
            const response = await fetch("/save-chat", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    user_token: token,
                    sender: "User",
                    message: message
                })
            });

            if (response.ok) {
                chatInput.value = '';
                await loadChatMessages();
            } else {
                console.error("Gagal mengirim pesan");
            }
        } catch (error) {
            console.error("Error saat mengirim pesan:", error);
        }
    }
}

async function sendFile() {
    const file = fileInput.files[0];
    if (!file) return;

    const token = getUserToken();
    const formData = new FormData();
    formData.append("file", file);
    formData.append("user_token", token);
    formData.append("sender", "User");

    try {
        const response = await fetch("/upload-chat-file", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        });

        if (response.ok) {
            await loadChatMessages();
        } else {
            console.error("Gagal mengunggah file");
        }
    } catch (error) {
        console.error("Error saat upload file:", error);
    }
}

function previewFile() {
    const file = fileInput.files[0];
    if (!file) return;

    const isImage = file.type.startsWith('image/');
    previewContainer.classList.remove('d-none');

    if (isImage) {
        const reader = new FileReader();
        reader.onload = function (e) {
            filePreview.innerHTML = `<img src="${e.target.result}" class="preview-image">`;
        };
        reader.readAsDataURL(file);
    } else {
        filePreview.innerHTML = `<div class="preview-file">File: ${file.name}</div>`;
    }
}

// Poll every 5 seconds
setInterval(() => {
    loadChatMessages();
}, 5000);

// Load initial
loadChatMessages();
</script>



</body>
</html>
