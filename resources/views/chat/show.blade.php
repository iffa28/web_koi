<x-app-layout>
    {{-- CSS Kustom untuk Scrollbar --}}
    <style>
        #chat-box::-webkit-scrollbar {
            width: 8px;
        }

        #chat-box::-webkit-scrollbar-track {
            background: transparent;
        }

        #chat-box::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            border: 2px solid transparent;
            background-clip: content-box;
        }

        #chat-box::-webkit-scrollbar-thumb:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }
    </style>

    {{-- 1. Latar Belakang Gradien yang Lebih Dinamis --}}
    <div class="bg-gradient-to-br from-gray-900 via-blue-950 to-black min-h-screen flex flex-col">
        <div class="max-w-4xl w-full mx-auto flex flex-col flex-grow pt-8 pb-6 px-4">

            {{-- Judul Halaman --}}
            <h1 class="text-3xl font-bold text-white mb-6 text-center tracking-tight drop-shadow-lg">
                Chat
            </h1>

            {{-- 2. JENDELA CHAT DENGAN EFEK GLASSMORPHISM --}}
            <div class="w-full flex flex-col bg-black bg-opacity-20 backdrop-blur-lg border border-white/10 rounded-lg shadow-2xl"
                style="height: 80vh;">

                {{-- 3. HEADER CHAT DENGAN AVATAR --}}
                <div
                    class="bg-black bg-opacity-20 flex-shrink-0 p-4 border-b border-white/10 flex items-center gap-4 rounded-lg">
                    <div class="flex-shrink-0">
                        <div
                            class="h-10 w-10 bg-blue-500 rounded-full flex items-center justify-center font-bold text-white">
                            {{-- Inisial dari nama partner chat --}}
                            {{ strtoupper(substr($chatPartner->name ?? (Auth::user()->role === 'admin' ? $chat->user->name : 'A'), 0, 1)) }}
                        </div>
                    </div>
                    <h2 class="text-lg font-bold text-white truncate">
                        {{ $chatPartner->name ?? (Auth::user()->role === 'admin' ? $chat->user->name : 'Admin') }}
                    </h2>
                </div>

                {{-- 4. AREA PESAN DENGAN SCROLLBAR KUSTOM --}}
                <div id="chat-box" class="flex-grow p-4 sm:p-6 space-y-1 overflow-y-auto" style="min-height: 0;">
                    @forelse ($chat->messages as $message)
                        @if ($message->sender_id === Auth::id())
                            {{-- 5. GELEMBUNG PESAN ANDA (KANAN) --}}
                            <div class="flex items-end justify-end gap-2.5">
                                <div>
                                    <div
                                        class="inline-block px-4 py-2.5 bg-blue-600 shadow-lg rounded-lg rounded-br-none max-w-sm sm:max-w-md">
                                        <p class="text-sm text-white leading-relaxed break-words">
                                            {{ $message->isi_pesan }}</p>
                                    </div>
                                    <p class="text-xs text-white text-right mt-2">
                                        {{ $message->created_at->format('d M Y H:i') }}
                                    </p>
                                </div>
                            </div>
                        @else
                            {{-- 6. GELEMBUNG PESAN LAWAN BICARA (KIRI) --}}
                            <div class="flex items-end justify-start gap-2.5 mt-3">
                                <div>
                                    <div
                                        class="inline-block px-4 py-2.5 bg-gray-200 shadow-lg rounded-lg rounded-bl-none max-w-sm sm:max-w-md">
                                        <p class="text-sm text-black leading-relaxed break-words">
                                            {{ $message->isi_pesan }}</p>
                                    </div>
                                    <p class="text-xs text-white mt-2">
                                        {{ $message->created_at->format('d M Y H:i') }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="text-center text-blue-300/60 pt-16 flex flex-col items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-400/30" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            <p>Belum ada pesan. Mulai percakapan!</p>
                        </div>
                    @endforelse
                </div>

                {{-- 7. AREA INPUT YANG LEBIH BERSIH --}}
                <div class="flex-shrink-0 p-4 border-t border-white/10 bg-black/10">
                    <form action="{{ route('chat.send', $chat->id) }}" method="POST" class="flex items-center gap-3">
                        @csrf
                        <input type="text" name="isi_pesan"
                            class="flex-grow w-full bg-black/30 border-2 border-transparent text-black rounded-full px-5 py-3 placeholder-gray-400 focus:outline-none focus:border-blue-500 transition"
                            placeholder="Ketik pesan..." autocomplete="off" required>
                        <button type="submit"
                            class="flex-shrink-0 bg-blue-600 text-white rounded-full h-12 w-12 flex items-center justify-center hover:bg-blue-700 transition shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900 focus:ring-blue-500">
                            {{-- Ikon Kirim --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transform rotate-90" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Script JavaScript tetap (tidak ada perubahan) --}}
    <script>
        const chatBox = document.getElementById('chat-box');

        function fetchMessages() {
            const isScrolledUp = chatBox.scrollHeight - chatBox.scrollTop > chatBox.clientHeight + 100;

            fetch("{{ route('chat.show', $chat->id) }}", {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newMessages = doc.getElementById('chat-box');

                    if (newMessages) {
                        chatBox.innerHTML = newMessages.innerHTML;

                        if (!isScrolledUp) {
                            chatBox.scrollTop = chatBox.scrollHeight;
                        }
                    }
                });
        }

        setInterval(fetchMessages, 2000);

        document.addEventListener('DOMContentLoaded', () => {
            chatBox.scrollTop = chatBox.scrollHeight;
        });
    </script>
</x-app-layout>
