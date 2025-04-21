@extends('layouts.master')

@section('content')
<h2>{{ $post->title }}</h2>
<p>{{ $post->content }}</p>

@if ($post->photo)
    <img src="{{ asset('storage/' . $post->photo) }}" width="200">
@endif

@if ($post->video)
    <video width="320" controls>
        <source src="{{ asset('storage/' . $post->video) }}">
    </video>
@endif

<div class="mt-4 d-flex gap-2">
    <!-- Approve Button -->
    <form action="{{ route('posts.approve', $post->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn btn-success">Approve</button>
    </form>

    <!-- Reject Button -->
    <form action="{{ route('posts.reject', $post->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn btn-danger">Reject</button>
    </form>

    <!-- Edit Button -->
    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>
</div>

@endsection 



