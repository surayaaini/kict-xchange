@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Edit Post</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Error Display --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        {{-- Title --}}
        <div class="form-group mb-3">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $post->title) }}" required>
        </div>

        {{-- Existing Photo --}}
        @if ($post->photo)
            <div class="mb-3">
                <label>Current Photo:</label><br>
                <img src="{{ asset('storage/' . $post->photo) }}" width="200" class="img-thumbnail mb-2">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remove_photo" id="remove_photo" value="1">
                    <label class="form-check-label" for="remove_photo">Remove Photo</label>
                </div>
            </div>
        @endif

        {{-- Upload New Photo --}}
        <div class="form-group mb-3">
            <label for="photo">Change Photo (Optional):</label>
            <input type="file" name="photo" id="photo" class="form-control-file" accept="image/*">
        </div>

        {{-- Existing Video --}}
        @if ($post->video)
            <div class="mb-3">
                <label>Current Video:</label><br>
                <video width="320" controls class="mb-2">
                    <source src="{{ asset('storage/' . $post->video) }}">
                    Your browser does not support the video tag.
                </video>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remove_video" id="remove_video" value="1">
                    <label class="form-check-label" for="remove_video">Remove Video</label>
                </div>
            </div>
        @endif

        {{-- Upload New Video --}}
        <div class="form-group mb-4">
            <label for="video">Change Video (Optional):</label>
            <input type="file" name="video" id="video" class="form-control-file" accept="video/*">
        </div>
        
        {{-- Content --}}
        <div class="form-group mb-3">
            <label for="content">Content:</label>
            <textarea name="content" id="content" class="form-control" rows="4" required>{{ old('content', $post->content) }}</textarea>
        </div>

        {{-- Buttons --}}
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-secondary">Cancel</a>
        </div>

    </form>
</div>
@endsection
