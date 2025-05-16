@extends('layouts.master')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
        <h3 class="page-title">Mobility Application Summary</h3>
        <p class="text-muted">Here is a summary of your submitted mobility application form</p>
    </div>

    <div class="card shadow-sm border-0 p-4">
        <h5 class="fw-bold text-primary mb-3">1. Personal Details</h5>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Full Name:</strong> {{ $application->full_name }}</li>
            <li class="list-group-item"><strong>Matric No:</strong> {{ $application->matric_no }}</li>
            <li class="list-group-item"><strong>Date of Birth:</strong> {{ $application->date_of_birth }}</li>
            <li class="list-group-item"><strong>Nationality:</strong> {{ $application->nationality }}</li>
            <li class="list-group-item"><strong>Phone:</strong> {{ $application->mobile_no }}</li>
            <li class="list-group-item"><strong>Email:</strong> {{ $application->email }}</li>
            <li class="list-group-item"><strong>Home Address:</strong> {{ $application->home_address }}</li>
            <li class="list-group-item"><strong>Mailing Address:</strong> {{ $application->mailing_address ?? '-' }}</li>
        </ul>

        <h5 class="fw-bold text-primary mt-4 mb-3">2. Passport Details</h5>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Passport No:</strong> {{ $application->passport_no ?? '-' }}</li>
            <li class="list-group-item"><strong>Expiry Date:</strong> {{ $application->passport_expiry ?? '-' }}</li>
            <li class="list-group-item"><strong>Copy of Passport:</strong>
                @if($application->passport_copy)
                    <a href="{{ asset('storage/' . $application->passport_copy) }}" target="_blank">View File</a>
                @else
                    -
                @endif
            </li>
        </ul>

        <h5 class="fw-bold text-primary mt-4 mb-3">3. Emergency Contact</h5>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Name:</strong> {{ $application->emergency_name }}</li>
            <li class="list-group-item"><strong>Relationship:</strong> {{ $application->emergency_relationship }}</li>
            <li class="list-group-item"><strong>Phone:</strong> {{ $application->emergency_phone }}</li>
            <li class="list-group-item"><strong>Email:</strong> {{ $application->emergency_email }}</li>
            <li class="list-group-item"><strong>Address:</strong> {{ $application->emergency_address }}</li>
        </ul>

        <h5 class="fw-bold text-primary mt-4 mb-3">4. Academic Information</h5>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Kulliyyah:</strong> {{ $application->kulliyyah }}</li>
            <li class="list-group-item"><strong>Level of Study:</strong> {{ $application->level_of_study }}</li>
            <li class="list-group-item"><strong>Year:</strong> {{ $application->year_of_study }}</li>
            <li class="list-group-item"><strong>Semester:</strong> {{ $application->semester }}</li>
            <li class="list-group-item"><strong>Programme:</strong> {{ $application->programme_name }}</li>
            <li class="list-group-item"><strong>CGPA:</strong> {{ $application->cgpa }}</li>
        </ul>

        <h5 class="fw-bold text-primary mt-4 mb-3">5. Language Proficiency</h5>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Test and Score:</strong> {{ $application->language_proficiency }}</li>
        </ul>

        <h5 class="fw-bold text-primary mt-4 mb-3">6. Funding Details</h5>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Fully Funded:</strong> {{ $application->fully_funded }}</li>
            <li class="list-group-item"><strong>Sponsor:</strong> {{ $application->sponsor }}</li>
            <li class="list-group-item"><strong>Sponsoring Amount (RM):</strong> {{ $application->sponsoring_amount }}</li>
        </ul>

        <h5 class="fw-bold text-primary mt-4 mb-3">7. Mobility Programme Info</h5>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Type:</strong> {{ $application->mobility_type }}</li>
            <li class="list-group-item"><strong>Host Institution:</strong> {{ $application->host_institution }}</li>
            <li class="list-group-item"><strong>Country:</strong> {{ $application->host_country }}</li>
            <li class="list-group-item"><strong>Duration:</strong> {{ $application->mobility_start_date }} - {{ $application->mobility_end_date }}</li>
        </ul>

        <h5 class="fw-bold text-primary mt-4 mb-3">Declaration</h5>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Name:</strong> {{ $application->student_declaration_name }}</li>
            <li class="list-group-item"><strong>Matric No:</strong> {{ $application->student_declaration_matric }}</li>
            <li class="list-group-item"><strong>Date:</strong> {{ $application->student_declaration_date }}</li>
            <li class="list-group-item"><strong>Letter of Indemnity:</strong>
                @if($application->indemnity_file)
                    <a href="{{ asset('storage/' . $application->indemnity_file) }}" target="_blank">View File</a>
                @else
                    -
                @endif
            </li>
        </ul>

        @if ($application->documents && (
            $application->documents->acceptance_letter ||
            $application->documents->proof_of_sponsorship ||
            $application->documents->academic_transcript ||
            $application->documents->insurance_document ||
            $application->documents->flight_ticket
        ))
                <h5 class="fw-bold text-primary mt-4 mb-3">Uploaded Additional Documents</h5>
        <ul class="list-group list-group-flush">
            @if ($application->documents->acceptance_letter)
                <li class="list-group-item"><strong>Acceptance Letter:</strong>
                    <a href="{{ asset('storage/' . $application->documents->acceptance_letter) }}" target="_blank">View File</a>
                </li>
            @endif
            @if ($application->documents->proof_of_sponsorship)
                <li class="list-group-item"><strong>Proof of Sponsorship:</strong>
                    <a href="{{ asset('storage/' . $application->documents->proof_of_sponsorship) }}" target="_blank">View File</a>
                </li>
            @endif
            @if ($application->documents->academic_transcript)
                <li class="list-group-item"><strong>Transcript:</strong>
                    <a href="{{ asset('storage/' . $application->documents->academic_transcript) }}" target="_blank">View File</a>
                </li>
            @endif
            @if ($application->documents->insurance_document)
                <li class="list-group-item"><strong>Insurance Document:</strong>
                    <a href="{{ asset('storage/' . $application->documents->insurance_document) }}" target="_blank">View File</a>
                </li>
            @endif
            @if ($application->documents->flight_ticket)
                <li class="list-group-item"><strong>Flight Ticket:</strong>
                    <a href="{{ asset('storage/' . $application->documents->flight_ticket) }}" target="_blank">View File</a>
                </li>
            @endif
        </ul>
        @endif
    </div>
</div>
@endsection
