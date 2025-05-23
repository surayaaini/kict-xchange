@extends('layouts.master')

@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Proposal Details</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('proposal.index') }}">Back to Proposal List</a></li>
                    <li class="breadcrumb-item active">View Details</li>
                </ul>
            </div>
        </div>
    </div>



    @if ($proposal->mobilityApplications->count())
        <div class="card mt-4">
            <div class="card-header bg-primary text-white">
                <h5 class="fw-bold mb-0">Student Application Form Submissions</h5>
            </div>
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>👤 Student Name</th>
                            <th>📧 Email</th>
                            <th>📅 Submitted On</th>
                            <th>📊 Status</th>
                            <th class="text-center">📄 View Full Form</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proposal->mobilityApplications as $app)
                            <tr>
                                <td>{{ $app->full_name }}</td>
                                <td>{{ $app->email }}</td>
                                <td>{{ \Carbon\Carbon::parse($app->created_at)->format('d M Y') }}</td>
                                <td>
                                    @if ($app->admin_approval_status === 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif ($app->admin_approval_status === 'rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('mobility.show', $app->id) }}" class="btn btn-outline-dark btn-sm">
                                        View Summary
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif


    <!-- Proposal Details Card -->
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <h5 class="fw-bold mb-3">Submitted By</h5>
            <p><strong>Name:</strong> {{ $proposal->submitted_by_name }}</p>
            <p><strong>Email:</strong> {{ $proposal->submitted_by_email }}</p>
            <p><strong>Phone:</strong> {{ $proposal->submitted_by_phone }}</p>

            <h5 class="fw-bold mt-4 mb-3">Partner University</h5>
            <p>{{ $proposal->partner_university }}</p>

            <h5 class="fw-bold mt-4 mb-3">Duration</h5>
            <p><strong>Start:</strong> {{ $proposal->start_date }} <br>
               <strong>End:</strong> {{ $proposal->end_date }}</p>

            <h5 class="fw-bold mt-4 mb-3">Objective</h5>
            <p>{{ $proposal->objective }}</p>

            <h5 class="fw-bold mt-4 mb-3">Responsible Staff at Partner University</h5>
            @if($proposal->responsible_staff)
                @foreach(json_decode($proposal->responsible_staff, true) as $staff)
                  <p>• {{ $staff['name'] ?? '-' }} ({{ $staff['email'] ?? '-' }})</p>
                @endforeach
            @else
                <p>No responsible staff listed.</p>
            @endif

            <h5 class="mt-4 fw-bold">Other IIUM Lecturers Joining</h5>
            @if($proposal->lecturers)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th><th>Email</th><th>Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(json_decode($proposal->lecturers, true) as $lecturer)
                            <tr>
                                <td>{{ $lecturer['name'] ?? '-' }}</td>
                                <td>{{ $lecturer['email'] ?? '-' }}</td>
                                <td>{{ $lecturer['phone'] ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted">No additional lecturers were added.</p>
            @endif


            <h5 class="mt-4 fw-bold">Students Joining</h5>
            @if($proposal->students)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th><th>Matric No</th><th>Email</th><th>Kulliyyah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(json_decode($proposal->students, true) as $student)
                            <tr>
                                <td>{{ $student['name'] ?? '-' }}</td>
                                <td>{{ $student['matric_no'] ?? '-' }}</td>
                                <td>{{ $student['email'] ?? '-' }}</td>
                                <td>{{ $student['kulliyyah'] ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted">No students were listed.</p>
            @endif

            <h5 class="fw-bold mt-4 mb-3">Uploaded Documents</h5>
            @if($proposal->documents)
                @foreach(json_decode($proposal->documents, true) as $doc)
                    <a href="{{ asset('storage/'.$doc) }}" target="_blank" class="btn btn-sm btn-primary mb-2">View Document</a><br>
                @endforeach
            @else
                <p>No documents uploaded.</p>
            @endif

            <div class="text-end mt-4">
                <a href="{{ route('proposal.index') }}" class="btn btn-secondary">Back</a>
            </div>

        </div>
    </div>

</div>
@endsection
