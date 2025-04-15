@extends('layouts.master')

@section('content')
<div class="content container-fluid">

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
                    <h3 class="page-title">Manage FAQ</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('faq.index') }}">FAQ</a></li>
                        <li class="breadcrumb-item active">Manage</li>

                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">

        {{-- Search Bar --}}
        <form action="{{ route('faq.index') }}" method="GET" class="d-flex align-items-center flex-grow-1 me-2">
            <input
                class="form-control form-control-sm me-2"
                type="search"
                name="search"
                placeholder="Search question or category..."
                value="{{ request('search') }}"
                aria-label="Search"
            >
            <button class="btn btn-outline-primary btn-sm" type="submit">
                <i class="fas fa-search"></i>
            </button>
            @if(request('search'))
                <a href="{{ route('faq.index') }}" class="btn btn-outline-secondary btn-sm ms-2">Reset</a>
            @endif
        </form>

        {{-- Buttons --}}
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('faq.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i> Add New
            </a>
            <a href="{{ route('faq.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Back to FAQ View
            </a>
        </div>

    </div>



    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No.</th>
                        <th>Question</th>
                        <th>Category</th>
                        <th>Last Updated</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($faqs as $index => $faq)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $faq->question }}</td>
                        <td>{{ $faq->category }}</td>
                        <td>{{ $faq->updated_at->format('Y-m-d') }}</td>
                        <td class="text-end">
                            <a href="{{ route('faqs.edit', $faq->id) }}" class="btn btn-warning btn-sm me-1">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Delete Button triggers modal -->
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $faq->id }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteModal{{ $faq->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $faq->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $faq->id }}">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this FAQ?<br>
                                    <strong>{{ $faq->question }}</strong>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('faqs.destroy', $faq->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Yes, Delete</button>
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @if($faqs->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center text-muted">No FAQs found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
