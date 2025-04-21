@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Submit a Post</h2>
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="photo">Photo (Optional):</label>
            <input type="file" name="photo" id="photo" class="form-control-file">
        </div>

        <div class="form-group mb-4">
            <label for="video">Video (Optional):</label>
            <input type="file" name="video" id="video" class="form-control-file">
        </div>
        
        <div class="form-group mb-3">
            <label for="content">Content:</label>
            <textarea name="content" id="content" class="form-control" rows="4" required></textarea>
        </div>

        {{-- <button type="Submit" class="btn btn-primary">Submit</button>
        <button type="Cancel" class="btn btn-primary">Submit</button> --}}

        <div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">Submit</button>
    
    <!-- Cancel/Back Button -->
    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
</div>

    </form>
</div>
@endsection