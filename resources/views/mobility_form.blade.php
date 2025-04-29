@extends('layouts.master')

@section('content')
<div class="content container-fluid">
    <h3 class="mb-4">Mobility Application Form</h3>

    <div class="progress mb-4">
        <div class="progress-bar" id="formProgress" role="progressbar" style="width: 14%" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100">Step 1 of 7</div>
    </div>

    <form action="{{ route('mobility.store') }}" method="POST" enctype="multipart/form-data" id="mobilityForm">
        @csrf

        <!-- Step 1: Personal Information -->
        <div class="form-step active">
            <h5 class="fw-bold">1. Personal Information</h5>
            <div class="mb-3">
                <label class="form-label">Full Name (as in passport)</label>
                <input type="text" class="form-control" name="full_name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Matric Number</label>
                <input type="text" class="form-control" name="matric_no" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Passport No.</label>
                <input type="text" class="form-control" name="passport_no">
            </div>
            <div class="mb-3">
                <label class="form-label">IC/Passport Upload</label>
                <input type="file" class="form-control" name="passport_file" required>
            </div>
            <button type="button" class="btn btn-primary next-btn">Next</button>
        </div>

        <!-- Steps 2–7 will be revealed dynamically (we’ll do JS next) -->

        <!-- Submit (in step 7) -->
        <div class="form-step">
            <h5 class="fw-bold">7. Student Declaration</h5>
            <div class="mb-3">
                <label class="form-label">Upload Signed Declaration</label>
                <input type="file" class="form-control" name="declaration_file" required>
            </div>
            <div class="text-end">
                <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                <button type="submit" class="btn btn-success">Submit Application</button>
            </div>
        </div>
    </form>
</div>

{{-- Multi-Step Form JS --}}
<script>
    let currentStep = 0;
    const steps = document.querySelectorAll('.form-step');
    const progress = document.getElementById('formProgress');

    function showStep(step) {
        steps.forEach((s, i) => s.classList.toggle('active', i === step));
        progress.style.width = `${((step + 1) / steps.length) * 100}%`;
        progress.innerText = `Step ${step + 1} of ${steps.length}`;
    }

    document.querySelectorAll('.next-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
            }
        });
    });

    document.querySelectorAll('.prev-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        });
    });

    showStep(currentStep);
</script>

{{-- Optional CSS --}}
<style>
    .form-step { display: none; }
    .form-step.active { display: block; }
</style>
@endsection
