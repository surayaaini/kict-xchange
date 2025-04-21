{{-- --}}

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



{{-- @extends('layouts.master')

@section('content')
<h2>{{ $post->title }}</h2>
<p>{{ $post->content }}</p>

@if ($post->photo)
    <img src="{{ asset('storage/' . $post->photo) }}" width="200" class="mb-3 d-block">
@endif

@if ($post->video)
    <video width="320" controls class="mb-3 d-block">
        <source src="{{ asset('storage/' . $post->video) }}">
    </video>
@endif

<div class="d-flex gap-2 mt-4">
    <!-- Approve Button Trigger -->
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal"
        data-action="approve"
        data-url="{{ route('posts.approve', $post->id) }}" method="POST">
        Approve
    </button>

    <!-- Reject Button Trigger -->
    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal"
        data-action="reject"
        data-url="{{ route('posts.reject', $post->id) }}" method="POST">
        Reject
    </button>

    <!-- Edit Post -->
    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>
</div>

<!-- Bootstrap Confirmation Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="confirmForm">
            @csrf
            @method('PATCH')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirm Action</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to <strong id="modalActionText"></strong> this post?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="modalConfirmButton">Yes, proceed</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    const confirmModal = document.getElementById('confirmModal');
    confirmModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const action = button.getAttribute('data-action');
        const url = button.getAttribute('data-url');

        const modalText = document.getElementById('modalActionText');
        modalText.textContent = action;

        const confirmForm = document.getElementById('confirmForm');
        confirmForm.action = url;

        const modalButton = document.getElementById('modalConfirmButton');
        modalButton.className = 'btn'; // Reset class

        if (action === 'approve') {
            modalButton.classList.add('btn-success');
        } else {
            modalButton.classList.add('btn-danger');
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')

@endsection --}}
