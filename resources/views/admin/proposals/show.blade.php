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


    @if($proposal->mobilityApplications->count())
        <div class="card mt-5">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Student Application Submissions</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>View Form</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($proposal->mobilityApplications as $app)
                            <tr>
                                <td>{{ $app->full_name }}</td>
                                <td>{{ $app->email }}</td>
                                <td>
                                    @if ($app->admin_approval_status === 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif ($app->admin_approval_status === 'rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('mobility.show', $app->id) }}" class="btn btn-sm btn-outline-dark">View Form</a>
                                </td>
                                <td>
                                    {{-- If pending, show approval form --}}
                                    @if ($app->admin_approval_status === 'pending')
                                    <form action="{{ route('mobility.handleApproval', $app->id) }}" method="POST">
                                        @csrf
                                            <p class="small text-muted mb-1">Approval Statement:</p>
                                            <div class="border p-2 small bg-light mb-2">
                                                I hereby confirm that this student has gone through the rightful university selection procedures and recommend that the student is qualified to participate in the student exchange programme above.
                                            </div>

                                            <input type="text" name="admin_approver_name" class="form-control form-control-sm mb-2" placeholder="Dean/Deputy Dean Responsible" required>
                                            <input type="date" name="admin_approval_date" class="form-control form-control-sm mb-2" value="{{ now()->toDateString() }}" required>

                                            <button type="submit" name="action" value="approve" class="btn btn-sm btn-success me-1">
                                                <i class="fas fa-check"></i> Approve
                                            </button>

                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="collapse" data-bs-target="#rejectionForm-{{ $app->id }}">
                                                <i class="fas fa-times"></i> Reject
                                            </button>

                                            <div class="collapse mt-2" id="rejectionForm-{{ $app->id }}">
                                                <textarea name="admin_rejection_reason" class="form-control form-control-sm mb-2" rows="2" placeholder="Reason for rejection..."></textarea>
                                                <button type="submit" name="action" value="reject" class="btn btn-sm btn-danger">
                                                    Confirm Rejection
                                                </button>
                                            </div>
                                        </form>
                                    @else
                                        <p><strong>Decision:</strong>
                                            @if ($app->admin_approval_status === 'approved')
                                                <span class="text-success">Approved</span>
                                            @else
                                                <span class="text-danger">Rejected</span>
                                            @endif
                                        </p>
                                        <p><strong>By:</strong> {{ $app->admin_approver_name ?? '-' }}</p>
                                        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($app->admin_approval_date)->format('d M Y') }}</p>
                                        @if ($app->admin_rejection_reason)
                                            <p><strong>Reason:</strong> {{ $app->admin_rejection_reason }}</p>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    @endif

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
                        <li>{{ is_array($staff) ? implode(', ', $staff) : $staff }}</li>
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
                        <li>{{ is_array($lecturer) ? implode(', ', $lecturer) : $lecturer }}</li>
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
                        <li>{{ is_array($student) ? implode(', ', $student) : $student}}</li>

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
{{--
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
            @endif --}}

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
