@extends('layouts.master')

@section('content')
<div class="container my-4">
    <h4 class="mb-4 fw-bold">Mobility Application Form</h4>

    <!-- Progress bar -->
    <div class="progress mb-4">
        <div class="progress-bar" role="progressbar" id="formProgress" style="width: 14%;">Step 1 of 7</div>
    </div>

    <form method="POST" action="{{ route('mobility.store') }}" enctype="multipart/form-data" id="mobilityForm">
        @csrf

        <!-- Step 1: Personal Information -->
        <div class="form-step active">
            <h5 class="fw-bold">1. Personal Information</h5>
            <div class="mb-3">
                <label>Full Name</label>
                <input type="text" name="full_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Matric Number</label>
                <input type="text" name="matric_no" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Nationality</label>
                <input type="text" name="nationality" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Passport Number</label>
                <input type="text" name="passport_no" class="form-control">
            </div>
            <div class="mb-3">
                <label>Passport Expiry</label>
                <input type="date" name="passport_expiry" class="form-control">
            </div>
            <div class="mb-3">
                <label>Upload Passport Copy</label>
                <input type="file" name="passport_copy" class="form-control" accept="application/pdf,image/*">
            </div>
        </div>

        <!-- Steps 2–7 will be inserted next... -->

        <div class="mt-4 d-flex justify-content-between">
            <button type="button" class="btn btn-secondary" id="prevBtn" disabled>Previous</button>
            <button type="button" class="btn btn-primary" id="nextBtn">Next</button>
            <button type="submit" class="btn btn-success d-none" id="submitBtn">Submit</button>
        </div>
    </form>
</div>

<!-- Step Navigation Script -->
<script>
    let currentStep = 0;
    const steps = document.querySelectorAll('.form-step');
    const progressBar = document.getElementById('formProgress');
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const submitBtn = document.getElementById('submitBtn');

    function showStep(n) {
        steps.forEach((step, index) => {
            step.classList.toggle('active', index === n);
        });
        prevBtn.disabled = n === 0;
        nextBtn.classList.toggle('d-none', n === steps.length - 1);
        submitBtn.classList.toggle('d-none', n !== steps.length - 1);
        progressBar.style.width = ((n + 1) / steps.length * 100) + '%';
        progressBar.innerText = `Step ${n + 1} of ${steps.length}`;
    }

    nextBtn.addEventListener('click', () => {
        if (currentStep < steps.length - 1) {
            currentStep++;
            showStep(currentStep);
        }
    });

    prevBtn.addEventListener('click', () => {
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
    });

    showStep(currentStep);
</script>

<style>
    .form-step {
        display: none;
    }
    .form-step.active {
        display: block;
    }
</style>
@endsection
