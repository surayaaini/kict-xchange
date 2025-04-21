{{-- @extends('layouts.master')

@section('content')
<h2>Edit Post</h2>

<form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Title</label>
    <input type="text" name="title" value="{{ $post->title }}" required>

    <label>Content</label>
    <textarea name="content" required>{{ $post->content }}</textarea>

    <label>Photo</label>
    <input type="file" name="photo">
    @if ($post->photo)
        <p>Current: <img src="{{ asset('storage/' . $post->photo) }}" width="100"></p>
    @endif

    <label>Video</label>
    <input type="file" name="video">
    @if ($post->video)
        <p>Current: <video width="160" controls><source src="{{ asset('storage/' . $post->video) }}"></video></p>
    @endif

    <button type="submit">Update</button>
</form>
@endsection --}}



@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Post</h2>

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ $post->title }}" required>
        </div>

        <!-- Content -->
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea id="content" name="content" class="form-control" rows="5" required>{{ $post->content }}</textarea>
        </div>

        <!-- Photo -->
        <div class="mb-3">
            <label for="photo" class="form-label">Photo</label>
            <input type="file" id="photo" name="photo" class="form-control">
            @if ($post->photo)
                <p class="mt-2">Current: <img src="{{ asset('storage/' . $post->photo) }}" width="100" class="img-thumbnail"></p>
            @endif
        </div>

        <!-- Video -->
        <div class="mb-3">
            <label for="video" class="form-label">Video</label>
            <input type="file" id="video" name="video" class="form-control">
            @if ($post->video)
                <p class="mt-2">Current:</p>
                <video width="320" controls class="mb-3">
                    <source src="{{ asset('storage/' . $post->video) }}">
                </video>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Update Post</button>
        </div>
    </form>
</div>
@endsection
