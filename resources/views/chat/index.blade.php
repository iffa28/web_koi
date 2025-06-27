<x-app-layout>
    <div class="bg-blue-900 min-h-screen -mt-16 pt-16">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
            <h1 class="text-6xl font-bold text-white mb-8 text-center">Daftar Chat Customer</h1>

            @if ($chats->isEmpty())
                <div class="text-center py-36">
                    <p class="text-gray-400">Belum ada chat yang masuk.</p>
                </div>
            @else
                <div class="space-y-2">
                    @foreach ($chats as $chat)
                        <a href="{{ route('chat.show', $chat->id) }}"
                            class="block p-4 sm:p-6 bg-black bg-opacity-20 hover:bg-opacity-30 hover:scale-105 shadow-lg rounded-lg transition duration-300 ease-in-out 
                                   transform hover:-translate-y-1 hover:shadow-xl
                                   @if ($chat->unreadCount > 0) border-l-4 border-blue-500 @endif">

                            <div class="flex items-center space-x-4">
                                {{-- Indikator Pesan Belum Dibaca --}}
                                <div class="w-4">
                                    @if ($chat->unreadCount > 0)
                                        <span class="w-3 h-3 bg-blue-500 rounded-full block"
                                            title="{{ $chat->unreadCount }} pesan belum dibaca"></span>
                                    @endif
                                </div>

                                {{-- Avatar Pengguna --}}
                                <img class="h-12 w-12 rounded-full object-cover"
                                    src="https://ui-avatars.com/api/?name={{ urlencode($chat->user->name) }}&background=0D8ABC&color=fff"
                                    alt="Avatar">

                                {{-- Info Chat --}}
                                <div class="flex-1 min-w-0 ml-2">
                                    <p class="font-semibold text-white truncate">
                                        {{ $chat->user->name }}
                                    </p>

                                    @php
                                        $lastMessage = $chat->messages->sortByDesc('created_at')->first();
                                    @endphp

                                    @if ($lastMessage)
                                        <p class="text-sm mt-1 truncate {{ $chat->unreadCount > 0 ? 'text-white font-semibold' : 'text-gray-300' }}">
                                            {{ $lastMessage->sender_id === Auth::id() ? 'Anda: ' : '' }}{{ $lastMessage->isi_pesan }}
                                        </p>
                                        <p class="text-xs text-gray-400 mt-0.5">
                                            {{ $lastMessage->created_at->format('d M Y H:i') }}
                                        </p>
                                    @else
                                        <p class="text-sm text-gray-400 mt-1 italic">Belum ada pesan</p>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
