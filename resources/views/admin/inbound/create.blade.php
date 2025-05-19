@extends('layouts.master')

@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Add Inbound Student</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('inbounds.index') }}">Inbound Students</a></li>
                        <li class="breadcrumb-item active">Add</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Inbound Student Form -->
    <form method="POST" action="{{ route('inbounds.store') }}" onsubmit="return confirm('Are you sure you want to add this new student?')">
        @csrf

        <div class="mb-3">
            <label for="full_name" class="form-label">Full Name</label>
            <input type="text" class="form-control" name="full_name" required>
        </div>

        <div class="mb-3">
            <label for="university_origin" class="form-label">University of Origin</label>
            <input type="text" class="form-control" name="university_origin" required>
        </div>

        <div class="mb-3">
            <label for="program" class="form-label">Program</label>
            <input type="text" class="form-control" name="program" required>
        </div>

        <div class="mb-3">
            <label>Program Type</label>
            <select name="program_type" class="form-select" required>
                <option value="">Select Level</option>
                <option value="Short-term">Short-Term</option>
                <option value="Summer course">Summer Course</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="responsible_lecturer" class="form-label">Responsible Lecturer</label>
            <input type="text" class="form-control" name="responsible_lecturer" required>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="duration_value" class="form-label">Duration</label>
                <input type="number" class="form-control" name="duration_value" min="1" required>
            </div>
            <div class="col">
                <label for="duration_unit" class="form-label">Unit</label>
                <select class="form-select" name="duration_unit" required>
                    <option value="">Select unit</option>
                    <option value="day">Day(s)</option>
                    <option value="week">Week(s)</option>
                    <option value="month">Month(s)</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="received_date" class="form-label">Received Date</label>
            <input type="date" class="form-control" name="received_date" required>
        </div>

        <div class="mb-3">
            <label for="departure_date" class="form-label">Departure Date</label>
            <input type="date" class="form-control" name="departure_date" required>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
@endsection
