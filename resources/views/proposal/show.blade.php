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
                    <p>• {{ $staff }}</p>
                @endforeach
            @else
                <p>No responsible staff listed.</p>
            @endif

            <h5 class="fw-bold mt-4 mb-3">IIUM Lecturers Joining</h5>
            @if($proposal->lecturers)
                @foreach(json_decode($proposal->lecturers, true) as $lecturer)
                    <p>• {{ $lecturer }}</p>
                @endforeach
            @else
                <p>No additional lecturers listed.</p>
            @endif

            <h5 class="fw-bold mt-4 mb-3">Students Joining</h5>
            @if($proposal->students)
                @foreach(json_decode($proposal->students, true) as $student)
                    <p>• {{ $student }}</p>
                @endforeach
            @else
                <p>No students listed.</p>
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
