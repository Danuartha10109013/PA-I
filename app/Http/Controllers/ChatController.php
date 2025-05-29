<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'user_token' => 'required',
            'sender' => 'required',
            'message' => 'required'
        ]);

        $chat = Chat::create([
            'user_token' => $request->user_token,
            'sender' => $request->sender,
            'message' => $request->message
        ]);

        return response()->json(['success' => true, 'chat' => $chat]);
    }
public function uploadFile(Request $request)
{
    if (!$request->hasFile('file')) {
        \Log::error('Upload gagal: tidak ada file');
        return response()->json(['status' => 'no file'], 400);
    }

    try {
        $path = $request->file('file')->store('chat_files', 'public');

        Chat::create([
            'user_token' => $request->user_token,
            'sender' => $request->sender,
            'file' => Storage::url($path),
        ]);

        return response()->json(['status' => 'success']);
    } catch (\Exception $e) {
        \Log::error('Upload error: ' . $e->getMessage());
        return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
    }
}

    public function getMessages($token)
    {
        $messages = Chat::where('user_token', $token)->orderBy('created_at')->get();
        return view('admin.chat', compact('messages', 'token'));
    }

    public function getChatsByUserToken($user_token)
{
    $messages = Chat::where('user_token', $user_token)
                    ->orderBy('created_at', 'asc')
                    ->get();

    return response()->json($messages);
}


public function admin()
{
    $userTokens = Chat::select('user_token', DB::raw('MAX(updated_at) as last_chat'))
                      ->groupBy('user_token')
                      ->orderByDesc('last_chat')
                      ->get();

    return view('pages.admin.k-chat.index', compact('userTokens'));
}

public function showChat($user_token)
    {
        $messages = Chat::where('user_token', $user_token)
                        ->orderBy('created_at', 'asc')
                        ->get();

        return view('pages.admin.k-chat.message', compact('messages', 'user_token'));
    }

    public function apiMessages($user_token)
{
    $messages = \App\Models\Chat::where('user_token', $user_token)
                    ->orderBy('created_at', 'asc')
                    ->get(['sender', 'message']); // ambil hanya yang dibutuhkan

    return response()->json($messages);
}


public function reply(Request $request)
{
    $request->validate([
        'user_token' => 'required|string',
        'message' => 'nullable|string',
        'sender' => 'required|string|in:Admin',
        'file' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,pdf,doc,docx,xls,xlsx,txt|max:2048',
    ]);

    $filePath = null;
    if ($request->hasFile('file')) {
        $storedPath = $request->file('file')->store('chat_files', 'public');
        // Simpan path lengkap yang bisa diakses public/storage/...
        $filePath = 'storage/' . $storedPath;
    }

    Chat::create([
        'user_token' => $request->user_token,
        'sender' => $request->sender,
        'message' => $request->message,
        'file' => $filePath,
    ]);

    return redirect()->route('admin.k-chat.message', $request->user_token)
                     ->with('success', 'Pesan berhasil dikirim.');
}




}

