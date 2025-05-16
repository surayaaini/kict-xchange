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

    @if (
            $application->acceptance_letter || $application->proof_of_sponsorship ||
            $application->academic_transcript || $application->insurance_document || $application->flight_ticket
        )
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-header bg-light">
                    <h5 class="fw-bold">📎 Additional Uploaded Documents</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @if($application->acceptance_letter)
                            <li class="list-group-item">
                                <strong>Acceptance Letter:</strong>
                                <a href="{{ asset('storage/' . $application->acceptance_letter) }}" target="_blank">View</a>
                            </li>
                        @endif
                        @if($application->proof_of_sponsorship)
                            <li class="list-group-item">
                                <strong>Proof of Sponsorship:</strong>
                                <a href="{{ asset('storage/' . $application->proof_of_sponsorship) }}" target="_blank">View</a>
                            </li>
                        @endif
                        @if($application->academic_transcript)
                            <li class="list-group-item">
                                <strong>Transcript:</strong>
                                <a href="{{ asset('storage/' . $application->academic_transcript) }}" target="_blank">View</a>
                            </li>
                        @endif
                        @if($application->insurance_document)
                            <li class="list-group-item">
                                <strong>Insurance Document:</strong>
                                <a href="{{ asset('storage/' . $application->insurance_document) }}" target="_blank">View</a>
                            </li>
                        @endif
                        @if($application->flight_ticket)
                            <li class="list-group-item">
                                <strong>Flight Ticket:</strong>
                                <a href="{{ asset('storage/' . $application->flight_ticket) }}" target="_blank">View</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        @endif

        @if(auth()->user()->role === 'admin' && $application->admin_approval_status === null)
        <hr>
        <h5 class="mt-4">Kulliyyah Approval & Recommendation</h5>
        <p>
            I hereby confirm that this student has gone through the rightful university selection procedures and recommend that the student is qualified to participate in the student exchange programme above.
        </p>

        <form method="POST" action="{{ route('mobility.approve_or_reject', $application->id) }}">
            @csrf

            <div class="mb-3">
                <label for="dean_name">Dean/Deputy Dean Responsible</label>
                <input type="text" name="dean_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="approval_date">Date</label>
                <input type="date" name="approval_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Status</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" value="approved" required>
                    <label class="form-check-label">Approve</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" value="rejected">
                    <label class="form-check-label">Reject</label>
                </div>
            </div>

            <div class="mb-3" id="rejectionReasonDiv" style="display:none;">
                <label for="rejection_reason">Reason for Rejection</label>
                <textarea name="rejection_reason" class="form-control" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Submit Decision</button>
        </form>

        <script>
            document.querySelectorAll('input[name="status"]').forEach(el => {
                el.addEventListener('change', function () {
                    const reasonDiv = document.getElementById('rejectionReasonDiv');
                    reasonDiv.style.display = this.value === 'rejected' ? 'block' : 'none';
                });
            });
        </script>
    @endif

    <div class="card shadow-sm border-0 p-4 mt-4">
        <hr class="my-4">

        <div class="card border">
            <div class="card-body">
                <h5 class="fw-bold mb-3">
                    <i class="fas fa-clipboard-check me-2"></i>
                    Application Decision by Admin
                </h5>

                <p><strong>Status:</strong>
                    @if ($application->admin_approval_status === 'approved')
                        <span class="badge bg-success">Approved</span>
                    @elseif ($application->admin_approval_status === 'rejected')
                        <span class="badge bg-danger">Rejected</span>
                    @else
                        <span class="badge bg-secondary">Pending</span>
                    @endif
                </p>

                @if ($application->admin_approval_status === 'approved')
                    <p><strong>Approved by:</strong> {{ $application->admin_approver_name }}</p>
                    <p><strong>Approval Date:</strong> {{ \Carbon\Carbon::parse($application->admin_approval_date)->format('d M Y') }}</p>

                    <div class="alert alert-success mt-3">
                        <strong>✔️ Approved:</strong> The student has been recommended to join the programme.
                    </div>

                @elseif ($application->admin_approval_status === 'rejected')
                    <p><strong>Rejected by:</strong> {{ $application->admin_approver_name }}</p>
                    <p><strong>Rejection Date:</strong> {{ \Carbon\Carbon::parse($application->admin_approval_date)->format('d M Y') }}</p>

                    <div class="alert alert-danger mt-3">
                        <strong>❌ Rejection Reason:</strong><br>
                        {{ $application->admin_rejection_reason }}
                    </div>
                @endif
            </div>
        </div>
    </div>




</div>
@endsection
