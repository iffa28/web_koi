<x-app-layout>
    <div class="bg-blue-900 h-[calc(100vh-4rem)] flex flex-col">

        {{-- Kontainer utama untuk memusatkan jendela chat, dibuat mengisi semua ruang yang tersedia --}}
        <div class="flex-grow flex items-center justify-center p-4 sm:p-6 lg:p-8">

            {{-- JENDELA CHAT UTAMA --}}
            <div
                class="w-full max-w-4xl h-full flex flex-col bg-blue-950/50 border border-white/10 rounded-2xl shadow-2xl">


                {{-- HEADER CHAT --}}
                <div class="flex-shrink-0 p-4 border-b border-white/10">
                    <h1 class="text-xl font-bold text-white text-center">
                        Chat dengan
                        {{ $chatPartner->name ?? (Auth::user()->role === 'admin' ? $chat->user->name : 'Admin') }}
                    </h1>
                </div>

                {{-- AREA PESAN (BODY) --}}
                {{-- Kelas 'flex-grow' dan 'overflow-y-auto' memastikan hanya area ini yang bisa di-scroll --}}
                <div id="chat-box" class="flex-grow p-4 sm:p-6 space-y-6 overflow-y-auto min-h-0">
                    @forelse ($chat->messages as $message)
                        @if ($message->sender_id === Auth::id())
                            {{-- PESAN ANDA (KANAN) --}}
                            <div class="flex items-start justify-end gap-3">
                                <div>
                                    <div class="px-4 py-3 bg-blue-600 rounded-lg rounded-tr-lg shadow-md">
                                        <p class="text-sm text-white leading-relaxed">{{ $message->isi_pesan }}</p>
                                    </div>
                                    <p class="text-xs text-white text-right mt-1">
                                        {{ $message->created_at->format('d M Y H:i') }}</p>
                                </div>
                            </div>
                        @else
                            {{-- PESAN LAWAN BICARA (KIRI) --}}
                            <div class="flex items-start justify-start gap-3">
                                <div>
                                    <div class="px-4 py-3 bg-white bg-opacity-90 rounded-lg rounded-tl-lg shadow-md">
                                        <p class="text-sm text-gray-800 leading-relaxed">{{ $message->isi_pesan }}</p>
                                    </div>
                                    <p class="text-xs text-white mt-1">{{ $message->created_at->format('d M Y H:i') }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="text-center text-blue-300/40 pt-16">
                            <p>Belum ada pesan. Mulai percakapan!</p>
                        </div>
                    @endforelse
                </div>

                {{-- AREA INPUT (FOOTER) --}}
                <div class="flex-shrink-0 p-4 border-t border-white/10 bg-blue-950/50 rounded-b-2xl">
                    <form action="{{ route('chat.send', $chat->id) }}" method="POST" class="flex items-center gap-3">
                        @csrf
                        <input type="text" name="isi_pesan"
                            class="flex-grow w-full bg-white bg-opacity-30 border-2 border-transparent text-black rounded-full px-5 py-2.5 focus:outline-none focus:border-blue-500 transition"
                            placeholder="Ketik pesan..." autocomplete="off" required>
                        <button type="submit"
                            class="bg-blue-600 text-white font-semibold rounded-full px-6 py-2.5 hover:bg-blue-700 transition shadow-lg">
                            Kirim
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- Script JavaScript tidak perlu diubah, akan tetap berfungsi dengan baik --}}
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
