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
                                @php
                                $status = $existingApp->admin_approval_status;
                                $statusText = 'Your mobility application has been submitted.';
                                $bgColor = 'alert-success';

                                if ($status === 'approved') {
                                    $statusText .= ' It has been approved by DDAI.';
                                    $bgColor = 'alert-success';
                                } elseif ($status === 'rejected') {
                                    $statusText .= ' Unfortunately, it has been rejected.';
                                    $bgColor = 'alert-danger';
                                } elseif ($status === 'pending') {
                                    $statusText .= ' It is currently under review by DDAI.';
                                    $bgColor = 'alert-warning';
                                }
                            @endphp

                            <div class="alert {{ $bgColor }} mt-3">
                                <strong>Application Submitted:</strong> {{ $statusText }}
                                <a href="{{ route('mobility.show', $existingApp->id) }}" class="btn btn-sm btn-outline-dark ms-2">
                                    View Summary
                                </a>
                                <a href="{{ route('mobility.upload_form', $existingApp->id) }}" class="btn btn-sm btn-outline-primary ms-2">
                                    Upload Additional Documents
                                </a>
                            </div>
                    </div>
                @else
                    <a href="{{ route('mobility.create', $proposal->id) }}" class="btn btn-primary mt-2">Fill Application Form</a>
                @endif
            </div>
        @endforeach


    @else
        <p>No active mobility invitations at this time.</p>
    @endif


</div>
@endsection
