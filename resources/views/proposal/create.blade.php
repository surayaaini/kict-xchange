@extends('layouts.master')

@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Submit Mobility Proposal</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Proposal</li>
                        <li class="breadcrumb-item active">Create</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('proposal.store') }}" enctype="multipart/form-data" onsubmit="return confirmSubmit()">
        @csrf

        <!-- Proposal Submitted By -->
        <h5 class="fw-bold mb-3">Proposal Submitted By</h5>
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Lecturer's Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="submitted_by_name" required>
            </div>
            <div class="col">
                <label class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="submitted_by_email" required>
            </div>
            <div class="col">
                <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="submitted_by_phone" required>
            </div>
        </div>

        <!-- Responsible Staff at Partner University -->
        <h5 class="fw-bold mb-3">Responsible Staff at Partner University</h5>
        <div id="staff-section">
            <div class="row mb-3 align-items-end">
                <div class="col">
                    <input type="text" class="form-control" name="partner_staff_name[]" placeholder="Full Name" required>
                </div>
                <div class="col">
                    <input type="email" class="form-control" name="partner_staff_email[]" placeholder="Email" required>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="partner_staff_position[]" placeholder="Position" required>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-sm btn-outline-primary mb-4" onclick="addStaffRow()">+ Add Another Staff</button>

        <!-- Partner University -->
        <div class="mb-3">
            <label class="form-label">Partner University <span class="text-danger">*</span></label>
            <select class="form-select" name="partner_university" required>
                <option value="">Select University</option>
                @foreach($moumoas as $moumoa)
                    <option value="{{ $moumoa->collaborator }}">{{ $moumoa->collaborator }}</option>
                @endforeach
            </select>
        </div>

        <!-- Duration -->
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Start Date <span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="start_date" required>
            </div>
            <div class="col">
                <label class="form-label">End Date <span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="end_date" required>
            </div>
        </div>

        <!-- Objective -->
        <div class="mb-3">
            <label class="form-label">Objective of Mobility Programme <span class="text-danger">*</span></label>
            <textarea class="form-control" name="objective" rows="4" required></textarea>
        </div>

        <!-- Other Lecturers Joining (Optional) -->
        <h5 class="fw-bold mb-3">Other IIUM Lecturers Joining (Optional)</h5>
        <div id="lecturer-section">
            <div class="row mb-3 align-items-end">
                <div class="col">
                    <input type="text" class="form-control" name="lecturer_name[]" placeholder="Full Name">
                </div>
                <div class="col">
                    <input type="email" class="form-control" name="lecturer_email[]" placeholder="Email">
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="lecturer_phone[]" placeholder="Phone Number">
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-sm btn-outline-primary mb-4" onclick="addLecturerRow()">+ Add Another Lecturer</button>

        <!-- Students Joining (Optional) -->
        <h5 class="fw-bold mb-3">Students Joining (Optional)</h5>
        <div id="student-section">
            <div class="row mb-3 align-items-end">
                <div class="col">
                    <input type="text" class="form-control" name="student_name[]" placeholder="Full Name">
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="student_matric[]" placeholder="Matric Number">
                </div>
                <div class="col">
                    <input type="email" class="form-control" name="student_email[]" placeholder="Email">
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="student_kulliyyah[]" placeholder="Kulliyyah">
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-sm btn-outline-primary mb-4" onclick="addStudentRow()">+ Add Another Student</button>

        <!-- Supporting Documents -->
        <div class="mb-4">
            <label class="form-label">Upload Supporting Documents (Optional)</label>
            <input type="file" class="form-control" name="documents[]" multiple>
        </div>

        <!-- Submit Button -->
        <div class="text-end">
            <button type="submit" class="btn btn-primary">Submit Proposal</button>
        </div>

    </form>
</div>

<!-- JS for Add/Remove Rows -->
<script>
function addStaffRow() {
    const section = document.getElementById('staff-section');
    section.insertAdjacentHTML('beforeend', `
        <div class="row mb-3 align-items-end">
            <div class="col"><input type="text" class="form-control" name="partner_staff_name[]" placeholder="Full Name" required></div>
            <div class="col"><input type="email" class="form-control" name="partner_staff_email[]" placeholder="Email" required></div>
            <div class="col"><input type="text" class="form-control" name="partner_staff_position[]" placeholder="Position" required></div>
            <div class="col-auto">
                <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.row').remove()">❌</button>
            </div>
        </div>
    `);
}
function addLecturerRow() {
    const section = document.getElementById('lecturer-section');
    section.insertAdjacentHTML('beforeend', `
        <div class="row mb-3 align-items-end">
            <div class="col"><input type="text" class="form-control" name="lecturer_name[]" placeholder="Full Name"></div>
            <div class="col"><input type="email" class="form-control" name="lecturer_email[]" placeholder="Email"></div>
            <div class="col"><input type="text" class="form-control" name="lecturer_phone[]" placeholder="Phone Number"></div>
            <div class="col-auto">
                <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.row').remove()">❌</button>
            </div>
        </div>
    `);
}
function addStudentRow() {
    const section = document.getElementById('student-section');
    section.insertAdjacentHTML('beforeend', `
        <div class="row mb-3 align-items-end">
            <div class="col"><input type="text" class="form-control" name="student_name[]" placeholder="Full Name"></div>
            <div class="col"><input type="text" class="form-control" name="student_matric[]" placeholder="Matric Number"></div>
            <div class="col"><input type="email" class="form-control" name="student_email[]" placeholder="Email"></div>
            <div class="col"><input type="text" class="form-control" name="student_kulliyyah[]" placeholder="Kulliyyah"></div>
            <div class="col-auto">
                <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.row').remove()">❌</button>
            </div>
        </div>
    `);
}
function confirmSubmit() {
    return confirm('Are you sure you want to submit this Mobility Proposal?');
}
</script>
@endsection
