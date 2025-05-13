@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Submit a Post</h2>

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

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Title --}}
        <div class="form-group mb-3">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        {{-- Photo --}}
        <div class="form-group mb-3">
            <label for="photo">Photo (Optional, Max: 5MB):</label>
            <input type="file" name="photo" id="photo" class="form-control-file" accept="image/*">
        </div>

        {{-- Video --}}
        <div class="form-group mb-4">
            <label for="video">Video (Optional,, 50MB):</label>
            <input type="file" name="video" id="video" class="form-control-file" accept="video/*">
        </div>
        
        {{-- Content --}}
        <div class="form-group mb-3">
            <label for="content">Content:</label>
            <textarea name="content" id="content" class="form-control" rows="4" required></textarea>
        </div>

        {{-- Buttons --}}
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
        </div>

    </form>
</div>
@endsection
