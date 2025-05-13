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

        <!-- Step 2: Emergency Contact Information -->
        <div class="form-step">
            <h5 class="fw-bold">2. Emergency Contact</h5>
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" name="emergency_name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Relationship</label>
                <input type="text" class="form-control" name="emergency_relationship" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" class="form-control" name="emergency_phone" required>
            </div>
            <div class="text-end">
                <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                <button type="button" class="btn btn-primary next-btn">Next</button>
            </div>
        </div>

        <!-- Step 3: Academic Background -->
        <div class="form-step">
            <h5 class="fw-bold">3. Academic Background</h5>
            <div class="mb-3">
                <label class="form-label">Kulliyyah</label>
                <input type="text" class="form-control" name="kulliyyah" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Programme</label>
                <input type="text" class="form-control" name="programme" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Current CGPA</label>
                <input type="text" class="form-control" name="cgpa" required>
            </div>
            <div class="text-end">
                <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                <button type="button" class="btn btn-primary next-btn">Next</button>
            </div>
        </div>

        <!-- Step 4: Language Proficiency -->
        <div class="form-step">
            <h5 class="fw-bold">4. Language Proficiency</h5>
            <div class="mb-3">
                <label class="form-label">English Proficiency Test Taken (e.g. IELTS/MUET)</label>
                <input type="text" class="form-control" name="language_test" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Score</label>
                <input type="text" class="form-control" name="language_score" required>
            </div>
            <div class="text-end">
                <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                <button type="button" class="btn btn-primary next-btn">Next</button>
            </div>
        </div>

        <!-- Step 5: Financial Information -->
        <div class="form-step">
            <h5 class="fw-bold">5. Financial Information</h5>
            <div class="mb-3">
                <label class="form-label">Source of Financial Support</label>
                <input type="text" class="form-control" name="financial_support" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Estimated Budget (RM)</label>
                <input type="text" class="form-control" name="estimated_budget" required>
            </div>
            <div class="text-end">
                <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                <button type="button" class="btn btn-primary next-btn">Next</button>
            </div>
        </div>

        <!-- Step 6: Mobility Programme Info -->
        <div class="form-step">
            <h5 class="fw-bold">6. Mobility Programme Information</h5>
            <div class="mb-3">
                <label class="form-label">Host Institution</label>
                <input type="text" class="form-control" name="host_institution" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Country</label>
                <input type="text" class="form-control" name="host_country" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Start Date</label>
                <input type="date" class="form-control" name="mobility_start_date" required>
            </div>
            <div class="mb-3">
                <label class="form-label">End Date</label>
                <input type="date" class="form-control" name="mobility_end_date" required>
            </div>
            <div class="text-end">
                <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                <button type="button" class="btn btn-primary next-btn">Next</button>
            </div>
        </div>

        <!-- Step 7: Student Declaration -->
        <div class="form-step">
            <h5 class="fw-bold">7. Student Declaration</h5>
            <div class="mb-3">
                <label class="form-label">Upload Signed Declaration Form</label>
                <input type="file" class="form-control" name="declaration_file" required>
            </div>
            <div class="text-end">
                <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                <button type="submit" class="btn btn-success">Submit Application</button>
            </div>
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
