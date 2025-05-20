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
            'photo' => 'nullable|image|max:5120',
            'video' => 'nullable|mimes:mp4,mov,avi,wmv|max:51200'
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->status = 'pending';
        $post->user_id = auth()->id(); // 🔥 this connects post to the student

        // Save photo if uploaded
        if ($request->hasFile('photo')) {
            if ($post->photo) Storage::delete('public/' . $post->photo); // optional cleanup
            $path = $request->file('photo')->store('photo', 'public');
            $post->photo = $path;
        }

        // Save video if uploaded
        if ($request->hasFile('video')) {
            if ($post->video) Storage::delete('public/' . $post->video); // optional cleanup
            $path = $request->file('video')->store('videos', 'public');
            $post->video = $path;
        }
        

        $post->save();

        return redirect()->to(route('posts.index', [], false) . '#My-Posts-Card') ->with('success', 'Post submitted successfully and pending approval!');
    }



    public function index()
    {
        $posts = Post::where('status', 'approved')->latest()->get();
        return view('experience.index', compact('posts'));
    }

    public function fullpost($id)
    {
        $post = Post::where('id', $id)
                ->where('status', 'approved') // Only show approved posts
                ->firstOrFail();

        return view('experience.full-post', compact('post'));
    }

}

