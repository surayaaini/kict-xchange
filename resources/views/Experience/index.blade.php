{{-- @extends('layouts.master')

@section('content')
<h2>Mobility Experience</h2>

<a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">
    Create New Post
</a>


@foreach ($posts as $post)
    <div>
        <h3>{{ $post->title }}</h3>

         @if ($post->photo)
            <img src="{{ asset('storage/' . $post->photo) }}" width="200">
        @endif

        @if ($post->video)
            <video width="320" controls>
                <source src="{{ asset('storage/' . $post->video) }}">
            </video>
        @endif

        <p>{{ $post->content }}</p>
    </div>
@endforeach

@endsection --}}

@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Mobility Experience</h2>

    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-4">Create New Post</a>

    @forelse ($posts as $post)
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">{{ $post->title }}</h5>
                <a href="{{ route('posts.full.post', $post->id) }}" class="btn btn-sm btn-outline-primary">
                    Read More
                </a>
            </div>
        </div>
    @empty
        <p class="text-muted text-center">No posts available.</p>
    @endforelse
</div>
@endsection



