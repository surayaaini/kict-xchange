@extends('layouts.master')

@section('content')
<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="card-title">{{ $post->title }}</h2>
            <p class="card-text mt-3">{{ $post->content }}</p>

            @if ($post->photo)
                <div class="my-3 text-center">
                    <img src="{{ asset('storage/' . $post->photo) }}" class="img-fluid rounded" style="max-width: 500px;" alt="Post photo">
                </div>
            @endif

            @if ($post->video)
                <div class="my-3 text-center">
                    <video width="500" controls class="rounded">
                        <source src="{{ asset('storage/' . $post->video) }}">
                        Your browser does not support the video tag.
                    </video>
                </div>
            @endif
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to Posts</a>
    </div>
</div>
@endsection


