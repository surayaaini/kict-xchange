@extends('layouts.master')

@section('content')
<div class="container">
    <h4>Upload Additional Documents</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('mobility.upload.store', $application->id) }}" enctype="multipart/form-data">
        @csrf

        <x-form.input-file name="invitation_letter" label="Invitation/Acceptance Letter" />
        <x-form.input-file name="sponsorship_proof" label="Proof of Sponsorship" />
        <x-form.input-file name="transcript" label="Latest Certified Transcript" />
        <x-form.input-file name="insurance" label="Insurance Document" />
        <x-form.input-file name="flight_ticket" label="Flight Ticket" />

        <button type="submit" class="btn btn-primary mt-3">Upload</button>
    </form>
</div>
@endsection
