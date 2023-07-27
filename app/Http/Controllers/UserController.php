<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() {
        $authenticatedUser  = Auth::user();
        $users = User::where('id', '!=', $authenticatedUser->id)->get();
        return view('user.index', compact('users'));
    }

    public function details($id) {
        $user = User::with('posts.likes')->find($id);
//        dd($posts[1]->likes()->pluck('name')->implode(', '));
        return view('user.details', compact('user'));
    }

    public function getMessages($id) {
        $user = User::find($id);
        $messages = Message::where('sender_id', Auth::id())
            ->where('receiver_id', $id)
            ->orWhere('receiver_id', Auth::id())
            ->where('sender_id', $id)
            ->get();

        return view('user.chat', compact('messages', 'user'));
    }

    public function sendMessage(int $id, Request $request) {
//        $validatedContent = $request->validate([
//            'content' => 'required',
//        ]);

        $messageItem = new Message([
            'content' => $request->input('content'),
            'sender_id' => \auth()->id(),
            'receiver_id' => $id,
        ]);

        $messageItem->save();
        return redirect()->back();
    }

    public function myPage() {
        $posts = \auth()->user()->posts;
        return view('user.myPage', compact('posts'));
    }

    public function createPost(Request $request) {
        $post = new Post([
            'content' => $request->input('content'),
            'user_id' => \auth()->id(),
        ]);
        $post->save();
        return redirect()->back();
    }

    public function updateLikes(Request $request) {
        dd($request);

    }
}
