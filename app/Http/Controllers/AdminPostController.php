<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('experience.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('experience.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|image',
            'video' => 'nullable|mimes:mp4,mov,avi,wmv|max:10240'
        ]);

        $post->title = $request->title;
        $post->content = $request->content;

        if ($request->hasFile('image')) {
            if ($post->image_path) Storage::delete($post->image_path);
            $post->image_path = $request->file('image')->store('images');
        }

        if ($request->hasFile('video')) {
            if ($post->video_path) Storage::delete($post->video_path);
            $post->video_path = $request->file('video')->store('videos');
        }

        $post->save();

        return redirect()->route('posts.show', $post->id)->with('success', 'Post updated successfully!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->image_path) Storage::delete($post->image_path);
        if ($post->video_path) Storage::delete($post->video_path);

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }

    public function approve($id)
    {
        $post = Post::findOrFail($id);
        $post->status = 'approved';
        $post->save();

        return redirect()->to(route('posts.post.history', [], absolute: false) . '#mobility')->with('success', 'Post approved successfully!');
    }

    public function reject($id)
    {
        $post = Post::findOrFail($id);
        $post->status = 'rejected';
        $post->save();

        return redirect()->to(route('posts.post.history', [], false) . '#mobility')->with('success', 'Post have been rejected!');
    }

    public function dashboard()
    {
        $posts = Post::where('status', 'pending')->latest()->get();

        return view('admin.admin-dashboard')->with('posts', $posts);
    }
    public function history()
    {
        $posts = Post::latest()->get(); // show all statuses
        return view('experience.post-history', compact('posts'));
    }

}
