@extends('layouts.master')

@section('content')

<div class="content container-fluid">

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Submitted Posts</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Submitted Posts</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Stylish Card Container -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
            <a href="{{ route('admin.dashboard') . '#mobility' }}" class="btn btn-outline-primary btn-sm">
                &laquo; Back
            </a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Submitted At</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $index => $post)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $post->title }}</td>
                                @php
                                    $statusColor = match ($post->status) {
                                        'approve', 'approved' => 'bg-success',
                                        'reject', 'rejected' => 'bg-danger', 
                                        'pending' => 'bg-warning',
                                        default => 'bg-secondary', 
                                    };
                                @endphp

                                <td>
                                    <span class="badge rounded-pill {{ $statusColor }}">{{ ucfirst($post->status) }}</span>
                                </td>
                                <td>{{ $post->created_at->format('d M Y') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info btn-sm me-1">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    @if(auth()->user()->role_id == 1)
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $post->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>

                            <!-- Delete Confirmation Modal -->
                            <div class="modal fade" id="deleteModal{{ $post->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $post->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $post->id }}">Confirm Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete the post titled <strong>{{ $post->title }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Yes, Delete</button>
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No submitted posts found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection


