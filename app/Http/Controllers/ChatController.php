<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Jika admin, tampilkan semua chat
        if ($user->role === 'admin') {
            $chats = Chat::with('user')->latest()->get();
        } else {
            // Jika customer, hanya chat miliknya
            $chats = Chat::where('user_id', $user->id)->with('admin')->get();
        }

        return view('chat.index', compact('chats'));
    }

    public function show($chat_id)
    {
        $chat = Chat::with(['messages.sender'])->findOrFail($chat_id);
        return view('chat.show', compact('chat'));
    }

    public function sendMessage(Request $request, $chat_id)
    {
        $request->validate(['isi_pesan' => 'required|string']);

        $chat = Chat::findOrFail($chat_id);

        Message::create([
            'chat_id' => $chat->id,
            'sender_id' => Auth::id(),
            'isi_pesan' => $request->isi_pesan,
        ]);

        return redirect()->back();
    }

    public function startOrShow()
    {
        $user = Auth::user();

        // Hanya support customer memulai chat
        if ($user->role === 'admin') {
            abort(403, 'Admin tidak dapat memulai chat.');
        }

        // Cari admin pertama (atau yang sedang online)
        $admin = \App\Models\User::where('role', 'admin')->first();

        if (!$admin) {
            abort(500, 'Admin belum tersedia.');
        }

        // Cari chat yang sudah ada, atau buat baru
        $chat = \App\Models\Chat::firstOrCreate([
            'user_id' => $user->id,
            'admin_id' => $admin->id,
        ]);

        return redirect()->route('chat.show', $chat->id);
    }
}
