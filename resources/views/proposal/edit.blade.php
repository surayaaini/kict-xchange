@extends('layouts.master')

@section('content')
<div class="content container-fluid">

    @if (session('success'))
    <div class="alert alert-dismissible fade show text-white" role="alert" style="background-color: #0a2647;">
        <strong>Success!</strong> {{ session('success') }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif


    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Edit Mobility Proposal</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('proposal.index') }}">Proposal</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Proposal Form -->
    <form method="POST" action="{{ route('proposal.update', $proposal->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Proposal Submitted By -->
        <h5 class="fw-bold mb-3">Proposal Submitted By</h5>
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Lecturer's Name</label>
                <input type="text" class="form-control" name="submitted_by_name" value="{{ old('submitted_by_name', $proposal->submitted_by_name) }}" required>
            </div>
            <div class="col">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="submitted_by_email" value="{{ old('submitted_by_email', $proposal->submitted_by_email) }}" required>
            </div>
            <div class="col">
                <label class="form-label">Phone Number</label>
                <input type="text" class="form-control" name="submitted_by_phone" value="{{ old('submitted_by_phone', $proposal->submitted_by_phone) }}" required>
            </div>
        </div>

        <!-- Partner University -->
        <div class="mb-3">
            <label class="form-label">Partner University</label>
            <select class="form-select" name="partner_university" required>
                <option value="">Select University</option>
                @foreach($moumoas as $moumoa)
                    <option value="{{ $moumoa->collaborator }}" {{ old('partner_university', $proposal->partner_university) == $moumoa->collaborator ? 'selected' : '' }}>
                        {{ $moumoa->collaborator }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Duration -->
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Start Date</label>
                <input type="date" class="form-control" name="start_date" value="{{ old('start_date', $proposal->start_date) }}" required>
            </div>
            <div class="col">
                <label class="form-label">End Date</label>
                <input type="date" class="form-control" name="end_date" value="{{ old('end_date', $proposal->end_date) }}" required>
            </div>
        </div>

        <!-- Objective -->
        <div class="mb-4">
            <label class="form-label">Objective of Mobility Programme</label>
            <textarea class="form-control" name="objective" rows="4" required>{{ old('objective', $proposal->objective) }}</textarea>
        </div>

        <!-- Submit Button -->
        <div class="text-end">
            <button type="submit" class="btn btn-primary">Update Proposal</button>
            <a href="{{ route('proposal.index') }}" class="btn btn-secondary">Cancel</a>
        </div>

    </form>
</div>
@endsection
