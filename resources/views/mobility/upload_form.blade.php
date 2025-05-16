@extends('layouts.master')

@section('content')
<div class="content container-fluid">

    <div class="page-header">
        <h3 class="page-title">Mobility Application Update</h3>

    </div>

    <div class="card shadow-sm border-0 p-4 mb-4 bg-light">
        <h5 class="fw-bold text-success"><i class="fas fa-check-circle me-2"></i>Upload Additional Documents</h5>
        <p>You're uploading additional documents for your mobility application to:</p>
        <ul>
            <li><strong>University:</strong> {{ $application->host_institution }}</li>
            <li><strong>Programme Dates:</strong> {{ $application->mobility_start_date }} - {{ $application->mobility_end_date }}</li>
        </ul>

        <hr>

        {{-- Upload form --}}
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
</div>
@endsection
