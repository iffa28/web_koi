<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">
        <h1 class="text-3xl font-bold mb-6">Daftar Chat</h1>

        @if ($chats->isEmpty())
            <p class="text-gray-500">Belum ada chat.</p>
        @else
            <div class="bg-white shadow rounded-lg divide-y divide-gray-200">
                @foreach ($chats as $chat)
                    <a href="{{ route('chat.show', $chat->id) }}"
                        class="block px-6 py-4 hover:bg-gray-50 transition duration-200">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-semibold text-gray-800">
                                    @if (Auth::user()->role === 'admin')
                                        Customer: {{ $chat->user->name }}
                                    @else
                                        Admin: {{ $chat->admin->name ?? 'Belum ditentukan' }}
                                    @endif
                                </p>
                                <p class="text-sm text-gray-500">
                                    Dimulai pada: {{ $chat->created_at ? $chat->created_at->format('d M Y H:i') : '-' }}
                                </p>
                            </div>
                            <div class="text-sm text-blue-600">Lihat &rarr;</div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
