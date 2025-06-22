<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = \App\Models\User::where('role', 'customer')
            ->select('id', 'name', 'email', 'created_at')
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        return view('user.index', compact('users'));
    }

    public function destroy(User $user)
    {
        if ($user->role === 'customer') {
            $user->delete();
            return redirect()->route('user.index')->with('success', 'User berhasil dihapus.');
        }

        return redirect()->route('user.index')->with('danger', 'Anda tidak dapat menghapus user ini.');
    }
}
