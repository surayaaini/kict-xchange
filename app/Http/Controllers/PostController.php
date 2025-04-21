<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function create()
    {
        return view('experience.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'video' => 'nullable|mimes:mp4,mov,avi|max:10000',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;

        if ($request->hasFile('photo')) {
            $post->photo = $request->file('photo')->store('photos', 'public');
        }

        if ($request->hasFile('video')) {
            $post->video = $request->file('video')->store('videos', 'public');
        }

        $post->status = 'pending'; // default status
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post submitted!');
    }

    public function index()
    {
        $posts = Post::where('status', 'Approve')->latest()->get();
        return view('experience.index', compact('posts'));
    }

    public function fullpost($id)
    {
        $post = Post::where('id', $id)
                ->where('status', 'Approve') // Only show approved posts
                ->firstOrFail();

        return view('experience.full-post', compact('post'));
    }
}

