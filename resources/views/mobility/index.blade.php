@extends('layouts.master')

@section('content')
<div class="content container-fluid">

    <div class="page-header">
        <h3 class="page-title">Mobility Programmes</h3>
        <p class="text-muted">Welcome to your mobility application portal.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Check if user has an active proposal to apply --}}
    @if($proposals->count())
        @foreach($proposals as $proposal)

            <div class="card shadow-sm border-0 p-4 mb-4">
                <h5 class="fw-bold">Mobility Programme Invitation</h5>
                <p>You’ve been invited to apply for the mobility programme titled:</p>
                <ul>
                    <li><strong>University:</strong> {{ $proposal->partner_university }}</li>
                    <li><strong>Duration:</strong> {{ $proposal->start_date }} - {{ $proposal->end_date }}</li>
                </ul>

                @php
                    $existingApp = $proposal->mobilityApplications->firstWhere('user_id', auth()->id());
                @endphp

                @if ($existingApp)
                    <div class="alert alert-info mt-3">
                        <strong>Application Submitted:</strong> Your mobility application has been submitted.
                        <a href="{{ route('mobility.show', $existingApp->id) }}" class="btn btn-sm btn-outline-dark ms-2">
                            View Summary
                        </a>
                        <a href="{{ route('mobility.upload_form', $existingApp->id) }}" class="btn btn-sm btn-outline-primary ms-2">
                            Upload Additional Documents
                        </a>
                    </div>
                @else
                    <a href="{{ route('mobility.create', $proposal->id) }}" class="btn btn-primary mt-2">Fill Application Form</a>
                @endif
            </div>
        @endforeach

        {{-- Show this box if the student already submitted their mobility application --}}
        @if($application)
        <div class="card shadow-sm border-0 p-4 mb-4 bg-light">
            <h5 class="fw-bold text-success"><i class="fas fa-check-circle me-2"></i>Application Submitted</h5>
            <p>Your mobility application has been submitted for:</p>
            <ul>
                <li><strong>University:</strong> {{ $application->host_institution }}</li>
                <li><strong>Programme Dates:</strong> {{ $application->mobility_start_date }} - {{ $application->mobility_end_date }}</li>
            </ul>

            <hr>

            {{-- Document Upload Form --}}
            <form method="POST" action="{{ route('mobility.upload_documents') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="application_id" value="{{ $application->id }}">

                <h6 class="mt-3">Upload Additional Documents</h6>

                <div class="mb-2">
                    <label>Acceptance Letter from Host University</label>
                    <input type="file" name="acceptance_letter" class="form-control">
                </div>

                <div class="mb-2">
                    <label>Proof of Sponsorship</label>
                    <input type="file" name="proof_of_sponsorship" class="form-control">
                </div>

                <div class="mb-2">
                    <label>Academic Transcript</label>
                    <input type="file" name="academic_transcript" class="form-control">
                </div>

                <div class="mb-2">
                    <label>Insurance Document</label>
                    <input type="file" name="insurance_document" class="form-control">
                </div>

                <div class="mb-2">
                    <label>Flight Ticket</label>
                    <input type="file" name="flight_ticket" class="form-control">
                </div>

                <button type="submit" class="btn btn-success mt-2">Upload Documents</button>
            </form>
        </div>
        @endif



    @else
        <p>No active mobility invitations at this time.</p>
    @endif

    {{-- Application Summary (only if user has submitted an application) --}}
    @if($application)
    <div class="card shadow-sm border-0 p-4 mb-4 bg-success bg-opacity-10">
        <h5 class="fw-bold"><i class="fas fa-check-circle text-success me-2"></i>Application Submitted</h5>
        <p>You’ve submitted your mobility application for:</p>
        <ul>
            <li><strong>Host University:</strong> {{ $application->host_institution }}</li>
            <li><strong>Duration:</strong> {{ $application->mobility_start_date }} - {{ $application->mobility_end_date }}</li>
            <li><strong>Status:</strong> <span class="badge bg-info text-dark">Under Review</span></li>
        </ul>
        <a href="{{ route('mobility.show', $application->id) }}" class="btn btn-outline-primary mt-2">
            <i class="fas fa-file-alt me-1"></i> View Full Application
        </a>
    </div>
    @endif

    {{-- Upload Additional Documents --}}
    @if($application)
        <div class="card shadow-sm border-0 p-4 mb-4">
            <h5 class="fw-bold"><i class="fas fa-upload text-primary me-2"></i>Additional Documents</h5>
            <p>You can upload extra files here as they become available.</p>
            <form method="POST" action="{{ route('mobility.upload_documents', $application->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="document_type" class="form-label">Document Type</label>
                    <select name="document_type" id="document_type" class="form-select" required>
                        <option value="">-- Select --</option>
                        <option value="invitation_letter">Invitation/Acceptance Letter</option>
                        <option value="sponsorship_proof">Proof of Sponsorship</option>
                        <option value="transcript">Certified Academic Transcript</option>
                        <option value="insurance">Insurance Coverage Proof</option>
                        <option value="flight_ticket">Flight Ticket</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="document_file" class="form-label">Upload File (PDF only)</label>
                    <input type="file" class="form-control" name="document_file" required accept="application/pdf">
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>

            @if($application->documents && $application->documents->count())
            <hr>
                <h6 class="mt-4">Uploaded Documents</h6>
                <ul class="list-group">
                    @foreach($application->documents as $doc)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ ucfirst(str_replace('_', ' ', $doc->type)) }}
                            <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                View
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    @endif




</div>
@endsection
