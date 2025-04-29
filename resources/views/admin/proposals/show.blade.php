@extends('layouts.master')

@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">View Proposal Details</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.proposals.index') }}">Proposals</a></li>
                        <li class="breadcrumb-item active">View Proposal</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Proposal Details Card -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <h4 class="fw-bold mb-3">{{ $proposal->partner_university }}</h4>
            <p><strong>Submitted By:</strong> {{ $proposal->submitted_by_name }} ({{ $proposal->submitted_by_email }})</p>
            <p><strong>Phone Number:</strong> {{ $proposal->submitted_by_phone }}</p>
            <p><strong>Duration:</strong> {{ $proposal->start_date }} to {{ $proposal->end_date }}</p>
            <p><strong>Objective:</strong><br> {{ $proposal->objective }}</p>

            <hr>

            <!-- Responsible Staff -->
            <h5 class="fw-bold">Responsible Staff at Partner University</h5>
            @if($proposal->responsible_staff)
                <ul>
                    @foreach(json_decode($proposal->responsible_staff, true) as $staff)
                        <li>{{ $staff }}</li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">No staff information provided.</p>
            @endif

            <!-- Other Lecturers -->
            <h5 class="fw-bold mt-4">Other IIUM Lecturers Joining</h5>
            @if($proposal->lecturers)
                <ul>
                    @foreach(json_decode($proposal->lecturers, true) as $lecturer)
                        <li>{{ $lecturer }}</li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">No additional lecturers provided.</p>
            @endif

            <!-- Students Joining -->
            <h5 class="fw-bold mt-4">Students Joining</h5>
            @if($proposal->students)
                <ul>
                    @foreach(json_decode($proposal->students, true) as $student)
                        <li>{{ $student }}</li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">No students listed.</p>
            @endif

            <!-- Documents -->
            <h5 class="fw-bold mt-4">Supporting Documents</h5>
            @if($proposal->documents)
                <ul>
                    @foreach(json_decode($proposal->documents, true) as $doc)
                        <li>
                            <a href="{{ asset('storage/' . $doc) }}" target="_blank" class="btn btn-link">
                                View Document
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">No documents uploaded.</p>
            @endif

            <hr>

            <!-- Status -->
            <p><strong>Status:</strong>
                <span class="badge
                    {{ $proposal->status == 'Pending' ? 'bg-warning text-dark' : ($proposal->status == 'Approved' ? 'bg-success' : 'bg-danger') }}">
                    {{ $proposal->status }}
                </span>
            </p>

            <!-- Approve/Reject Buttons -->
            @if($proposal->status == 'Pending')
            <div class="mt-4 d-flex gap-3">
                <form action="{{ route('admin.proposals.approve', $proposal->id) }}" method="POST" onsubmit="return confirmApprove()">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check"></i> Approve Proposal
                    </button>
                </form>

                <form action="{{ route('admin.proposals.reject', $proposal->id) }}" method="POST" onsubmit="return confirmReject()">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-times"></i> Reject Proposal
                    </button>
                </form>
            </div>
            @endif

            <div class="mt-4">
                <a href="{{ route('admin.proposals.index') }}" class="btn btn-outline-secondary">Back to Proposals List</a>
            </div>
        </div>
    </div>

</div>

<!-- JS Confirmations -->
<script>
function confirmApprove() {
    return confirm('Are you sure you want to APPROVE this proposal?');
}

function confirmReject() {
    return confirm('Are you sure you want to REJECT this proposal?');
}
</script>
@endsection
