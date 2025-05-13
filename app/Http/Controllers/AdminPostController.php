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
        'image' => 'nullable|image|max:5120',
        'video' => 'nullable|mimes:mp4,mov,avi,wmv|max:51200'
    ]);

    $post->title = $request->title;
    $post->content = $request->content;

    // Remove Photo
    if ($request->has('remove_photo') && $post->photo) {
        Storage::delete($post->photo);
        $post->photo = null;
    }

    // Remove Video
    if ($request->has('remove_video') && $post->video) {
        Storage::delete($post->video);
        $post->video = null;
    }

    // Update image if uploaded
    if ($request->hasFile('image')) {
        if ($post->photo) {
            Storage::delete($post->photo);
        }
        $post->photo = $request->file('image')->store('images');
    }

    // Update video if uploaded
    if ($request->hasFile('video')) {
        if ($post->video) Storage::delete('public/' . $post->video); // optional cleanup
        $path = $request->file('video')->store('videos', 'public');
        $post->video = $path;
    }
    

    $post->save();

    return redirect()->route('posts.show', $post->id)
                     ->with('success', 'Post updated successfully!');
}

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->photo) Storage::delete($post->photo);
        if ($post->video) Storage::delete($post->video);

        $post->delete();

        return redirect()->route('posts.post.history')->with('success', 'Post deleted successfully!');
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

    public function admindashboard()
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
