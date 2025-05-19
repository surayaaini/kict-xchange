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
                    <h3 class="page-title">Inbound Students</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Inbound Students</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Stylish Card Container -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
            <!-- Search Bar -->
            <form action="{{ route('inbounds.index') }}" method="GET" class="d-flex flex-wrap gap-2 align-items-center" role="search">
                <!-- Filter Dropdown -->
                <select name="filter_by" class="form-select form-select-sm w-auto">
                    <option value="">Filter By</option>
                    <option value="program_type" {{ request('filter_by') == 'program_type' ? 'selected' : '' }}>Program Type</option>
                    <option value="program" {{ request('filter_by') == 'program' ? 'selected' : '' }}>Program Name</option>
                    <option value="received_date" {{ request('filter_by') == 'received_date' ? 'selected' : '' }}>Received Date</option>
                </select>

                <!-- Search Box -->
                <input
                    class="form-control form-control-sm w-auto"
                    type="search"
                    name="search"
                    placeholder="Enter keyword..."
                    value="{{ request('search') }}"
                    aria-label="Search"
                >

                <!-- Search Button -->
                <button class="btn btn-outline-primary btn-sm" type="submit">
                    <i class="fas fa-search"></i>
                </button>

                <!-- Reset Button -->
                @if(request('search') || request('filter_by'))
                    <a href="{{ route('inbounds.index') }}" class="btn btn-outline-secondary btn-sm">
                        Reset
                    </a>
                @endif
            </form>

            @if(request('search'))
                <div class="alert alert-info mt-2 mb-0 w-100">
                    Showing results for "<strong>{{ request('search') }}</strong>"
                </div>
            @endif

            @if(request('search'))
                <p>{{ $count }} student(s) found for "{{ request('search') }}"</p>
            @endif

            <!-- Add Button -->
            @if(auth()->user()->role_id == 1)
                
                <div class="mb-1 text-end">
                    <a href="{{ route('inbounds.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-1"></i> Add New
                    </a>
                    <a href="{{ route('inbounds.import.form') }}" class="btn btn-success">
                        <i class="fas fa-file-import"></i> Import from Excel
                    </a>
                </div>

            @endif

           
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>Full Name</th>
                            <th>University Origin</th>
                            <th>Program</th>
                            <th>Program Type</th>
                            <th>Responsible Lecturer</th>
                            <th>Duration</th>
                            <th>Received Date</th>
                            <th>Departure Date</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $index => $student)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $student->full_name }}</td>
                                <td>{{ $student->university_origin }}</td>
                                <td>{{ $student->program }}</td>
                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $student->program_type }}
                                    </span>
                                </td>
                                <td>{{ $student->responsible_lecturer }}</td>
                                <td>{{ $student->duration_value }} {{ Str::plural($student->duration_unit, $student->duration_value) }}</td>
                                <td>{{ $student->received_date }}</td>
                                <td>{{ $student->departure_date }}</td>
                                <td class="text-end">
                                    @if(auth()->user()->role_id == 1)
                                        {{-- <a href="{{ route('inbounds.edit', $student->id) }}" class="btn btn-warning btn-sm me-1">
                                            <i class="fas fa-edit"></i>
                                        </a> --}}
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $student->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $student->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $student->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $student->id }}">Confirm Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete <strong>{{ $student->full_name }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('inbounds.destroy', $student->id) }}" method="POST">
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
                                <td colspan="10" class="text-center text-muted">No inbound students found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
