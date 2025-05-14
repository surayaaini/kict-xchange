@extends('layouts.master')

@section('content')
<div class="content container-fluid">

    <div class="page-header">
        <h3 class="page-title">Mobility Dashboard</h3>
        <p class="text-muted">Welcome to your mobility application portal.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Check if user has an active proposal to apply --}}
    @if($proposalToApply)
        <div class="card shadow-sm border-0 p-4 mb-4">
            <h5 class="fw-bold">Mobility Programme Invitation</h5>
            <p>You’ve been invited to apply for the mobility programme titled:</p>
            <ul>
                <li><strong>University:</strong> {{ $proposalToApply->partner_university }}</li>
                <li><strong>Duration:</strong> {{ $proposalToApply->start_date }} - {{ $proposalToApply->end_date }}</li>
            </ul>
            <a href="{{ route('mobility.create', $proposalToApply->id) }}" class="btn btn-primary mt-2">Fill Application Form</a>
        </div>
    @else
        <p>No active mobility invitations at this time.</p>
    @endif

</div>
@endsection
