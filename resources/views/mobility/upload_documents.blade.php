@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <h4>Upload Additional Mobility Documents</h4>
    <p class="text-muted">You can upload or replace documents related to your mobility application.</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('mobility.uploadDocuments', $application->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="invitation_letter" class="form-label">Invitation/Acceptance Letter</label>
            <input type="file" name="invitation_letter" class="form-control">
        </div>

        <div class="mb-3">
            <label for="sponsorship_proof" class="form-label">Proof of Sponsorship</label>
            <input type="file" name="sponsorship_proof" class="form-control">
        </div>

        <div class="mb-3">
            <label for="transcript" class="form-label">Certified Academic Transcript</label>
            <input type="file" name="transcript" class="form-control">
        </div>

        <div class="mb-3">
            <label for="insurance_document" class="form-label">Proof of Insurance</label>
            <input type="file" name="insurance_document" class="form-control">
        </div>

        <div class="mb-3">
            <label for="flight_ticket" class="form-label">Copy of Flight Ticket</label>
            <input type="file" name="flight_ticket" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Upload Documents</button>
    </form>
</div>
@endsection
