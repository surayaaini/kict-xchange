@extends('layouts.master')

@section('content')

@if (session('success'))
    <div class="alert alert-success container mt-3">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger container mt-3">
        {{ session('error') }}
    </div>
@endif

    <!-- Stylish Card Container -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
            <a href="{{ route('posts.post.history') . '#mobility' }}" class="btn btn-outline-primary btn-sm">
                &laquo; Back
            </a>
        </div>


<div class="container my-4">

    <!-- Post Title -->
    <h2 class="mb-3">{{ $post->title }}</h2>

    <!-- Post Content -->
    <p>{{ $post->content }}</p>

    <!-- Post Photo -->
    @if ($post->photo)
        <div class="my-3">
            <img src="{{ asset('storage/' . $post->photo) }}" alt="Post Photo" width="200" class="img-fluid rounded">
        </div>
    @endif

    <!-- Post Video -->
    @if ($post->video)
        <div class="my-3">
            <video width="320" controls class="rounded">
                <source src="{{ asset('storage/' . $post->video) }}">
                Your browser does not support the video tag.
            </video>
        </div>
    @endif

    <!-- Action Buttons -->
    <div class="mt-4 d-flex flex-wrap gap-2">

        <!-- Approve Button (opens modal) -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approveModal">
            Approve
        </button>

        <!-- Reject Button (opens modal) -->
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">
            Reject
        </button>

        <!-- Edit Button -->
        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>

    </div>

</div>

<!-- Approve Confirmation Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="approveModalLabel">Confirm Approve</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                Are you sure you want to approve this post titled <strong>{{ $post->title }}</strong>?
            </div>

            <div class="modal-footer">
                <form action="{{ route('posts.approve', $post->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success btn-sm">Yes, Approve</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Reject Confirmation Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="rejectModalLabel">Confirm Reject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                Are you sure you want to reject this post titled <strong>{{ $post->title }}</strong>?
            </div>

            <div class="modal-footer">
                <form action="{{ route('posts.reject', $post->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-danger btn-sm">Yes, Reject</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection
