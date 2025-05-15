@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h3>Mobility Application Summary</h3>

    <p><strong>Full Name:</strong> {{ $application->full_name }}</p>
    <p><strong>Matric No:</strong> {{ $application->matric_no }}</p>
    <p><strong>Host Institution:</strong> {{ $application->host_institution }}</p>
    <p><strong>Mobility Dates:</strong> {{ $application->mobility_start_date }} - {{ $application->mobility_end_date }}</p>

    {{-- Add more fields as needed --}}
</div>
@endsection
