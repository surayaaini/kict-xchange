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
                    <h3 class="page-title">KICT MOU/MOA List</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active">MOU/MOA List</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Stylish Card Container -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
            <!-- Search Bar -->
            <form action="{{ route('moumoa.index') }}" method="GET" class="d-flex flex-grow-1" role="search">
                <input
                    class="form-control form-control-sm me-2 w-50"
                    type="search"
                    name="search"
                    placeholder="Search collaborator or focal person..."
                    value="{{ request('search') }}"
                    aria-label="Search"
                >
                <button class="btn btn-outline-primary btn-sm" type="submit">
                    <i class="fas fa-search"></i>
                </button>

                @if(request('search'))
                <a href="{{ route('moumoa.index') }}" class="btn btn-outline-secondary btn-sm ms-2">
                    Reset
                </a>
                @endif
            </form>

            <!-- Feedback Message (after form) -->
            @if(request('search'))
            <div class="alert alert-info mt-2 mb-0 w-100">
                Showing results for "<strong>{{ request('search') }}</strong>"
            </div>
            @endif

            <!-- Add Button (Admins only) -->
            @if(auth()->user()->role_id == 1)
                <a href="{{ route('moumoa.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i> Add New
                </a>
            @endif
        </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No.</th>
                        <th>Collaborator</th>
                        <th>Signed Date</th>
                        <th>Expiry Date</th>
                        <th>Focal Person</th>
                        <th>MoU/MoA</th>
                        <th>Impact</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($moumoas as $index => $moumoa)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $moumoa->collaborator }}</td>
                            <td>{{ $moumoa->signed_date }}</td>
                            <td>{{ $moumoa->expiry_date }}</td>
                            <td>{{ $moumoa->focal_person }}</td>
                            <td>
                                <span class="badge bg-info text-dark">{{ $moumoa->type }}</span>
                            </td>
                            <td>
                                <span class="badge bg-success">{{ $moumoa->impact }}</span>
                            </td>
                            <td class="text-end">
                                @if(auth()->user()->role_id == 1)
                                    <a href="{{ route('moumoa.edit', $moumoa->id) }}" class="btn btn-warning btn-sm me-1">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Delete Button triggers modal -->
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $moumoa->id }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>

                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="deleteModal{{ $moumoa->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $moumoa->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $moumoa->id }}">Confirm Delete</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete <strong>{{ $moumoa->collaborator }}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('moumoa.destroy', $moumoa->id) }}" method="POST">
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
                            <td colspan="8" class="text-center text-muted">No MOU/MOA found matching your search.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection
