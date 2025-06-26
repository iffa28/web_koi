<x-app-layout>
    <div class="max-w-2xl mx-auto py-10 space-y-4">
        <h1 class="text-2xl font-bold">
            Chat dengan {{ Auth::user()->role === 'admin' ? $chat->user->name : 'Admin' }}
        </h1>

        <div class="border p-4 rounded-lg bg-white h-80 overflow-y-auto space-y-2">
            @foreach ($chat->messages as $message)
                <div class="{{ $message->sender_id === Auth::id() ? 'text-right' : 'text-left' }}">
                    <div
                        class="inline-block px-4 py-2 rounded-lg 
            {{ $message->sender_id === Auth::id() ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800' }}">
                        {{ $message->isi_pesan }}
                    </div>
                    <div class="text-xs text-gray-400 mt-1">
                        {{ $message->created_at->format('d M Y H:i') }}
                    </div>
                </div>
            @endforeach
        </div>

        <form action="{{ route('chat.send', $chat->id) }}" method="POST" class="flex gap-2">
            @csrf
            <input type="text" name="isi_pesan" class="flex-grow border rounded p-2" placeholder="Ketik pesan..."
                required>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Kirim</button>
        </form>
    </div>
</x-app-layout>
