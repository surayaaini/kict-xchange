@extends('layouts.master')

@section('content')
<div class="container my-4 d-flex justify-content-center">
    <div class="col-md-8 col-lg-7">
    <h4 class="mb-4 fw-bold">Mobility Application Form</h4>


    <!-- Progress bar -->
    <div class="progress mb-4">
        <div class="progress-bar" role="progressbar" id="formProgress" style="width: 14%;">Step 1 of 7</div>
    </div>

    <form method="POST" action="{{ route('mobility.store') }}" enctype="multipart/form-data" id="mobilityForm">
        @csrf
        <input type="hidden" name="proposal_id" value="{{ $proposal->id }}">

        <!-- Step 1: Personal Information -->
        <div class="form-step active">
            <h5 class="fw-bold">1. Personal Information</h5>
            <div class="mb-3">

            <div class="mb-3">
                <label>Full Name</label>
                <input type="text" name="full_name" class="form-control" required>
            </div>
                <label>Date of Birth</label>
                <input type="date" name="dob" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Home Address</label>
                <textarea name="home_address" class="form-control" rows="2" required></textarea>
            </div>
            <div class="mb-3">
                <label>Mailing Address (if different)</label>
                <textarea name="mailing_address" class="form-control" rows="2"></textarea>
            </div>
            <div class="mb-3">
                <label>Email Address</label>
                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
            </div>
            <div class="mb-3">
                <label>Mobile Number</label>
                <input type="text" name="mobile_no" class="form-control" required>
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
            <div class="text-end">
                <button type="button" class="btn btn-primary next-btn">Next</button>
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
            <div class="mb-3">
                <label>Email Address</label>
                <input type="email" name="emergency_email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Home Address</label>
                <textarea name="emergency_address" class="form-control" rows="2" required></textarea>
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
                <label>Level of Study</label>
                <select name="level_of_study" class="form-select" required>
                    <option value="">Select Level</option>
                    <option value="Undergraduate">Undergraduate</option>
                    <option value="Postgraduate">Postgraduate</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Year of Study</label>
                <select name="year_of_study" class="form-select" required>
                    @for ($i = 1; $i <= 6; $i++)
                        <option value="{{ $i }}">Year {{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="mb-3">
                <label>Semester</label>
                <select name="semester" class="form-select" required>
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}">Semester {{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Programme</label>
                <input type="text" class="form-control" name="programme_name" required>
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
                <label>Are you fully funded for this programme?</label>
                <select name="fully_funded" class="form-select" required>
                    <option value="">Select One</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Name of Sponsoring Body</label>
                <select name="sponsor" class="form-select" required>
                    <option value="">Select Sponsor</option>
                    <option value="JPA">JPA</option>
                    <option value="Self Sponsor">Self Sponsor</option>
                    <option value="MARA">MARA</option>
                    <option value="PTPTN">PTPTN</option>
                    <option value="Others">Others</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Sponsoring Amount (RM)</label>
                <input type="text" name="sponsoring_amount" class="form-control" required>
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
                <label>Type of Mobility</label>
                <select name="mobility_type" class="form-select" required>
                    <option value="Physical">Physical</option>
                    <option value="Virtual">Virtual</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Host Institution</label>
                <input type="text" class="form-control" name="host_institution" value="{{ $proposal->partner_university ?? '' }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Country</label>
                <input type="text" class="form-control" name="host_country" required>
            </div>
            <div class="mb-3">
                <label>Start Date</label>
                <input type="date" class="form-control" name="mobility_start_date" value="{{ $proposal->start_date }}" readonly>
            </div>
            <div class="mb-3">
                <label>End Date</label>
                <input type="date" class="form-control" name="mobility_end_date" value="{{ $proposal->end_date }}" readonly>
            </div>

            <hr>
            <h6 class="fw-bold mt-4">Contact Person at University</h6>

            @if(!empty($proposal->responsible_staff))
                @php
                    $staffList = json_decode($proposal->responsible_staff, true);
                @endphp

                @foreach($staffList as $staff)
                    <p><strong>Name: </strong> {{ $staff['name'] ?? '-' }}</p>
                    <p><strong>Position: </strong> {{ $staff['position'] ?? '-' }}</p>
                    <p><strong>Email: </strong> {{ $staff['email'] ?? '-' }}</p>
                @endforeach
            @else
                <p class="text-muted">No contact person listed in the proposal.</p>
            @endif

            <div class="text-end">
                <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                <button type="button" class="btn btn-primary next-btn">Next</button>
            </div>
        </div>

        <!-- Step 7: Student Declaration -->
        <div class="form-step">
            <h5 class="fw-bold">7. Student Declaration</h5>
            <p>
                I declare that all the information provided in this application form is true and complete in every detail.
                I acknowledge that International Islamic University Malaysia (IIUM) reserves the right to approve or reject
                made on the basis of incorrect or incomplete information. I am aware of the conditions relating to my
                application and agree to pay IIUM fees (please refer to your IIUM financial statement) for which I am
                liable for while joining the program above.
            </p>

            <div class="mb-3">
                <label>Your Full Name</label>
                <input type="text" name="declaration_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Matric Number</label>
                <input type="text" name="declaration_matric" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Date</label>
                <input type="date" name="declaration_date" class="form-control" required>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="agree_declaration" id="agreeDeclaration" required>
                <label class="form-check-label" for="agreeDeclaration">
                    I understand and agree to the above declaration.
                </label>
            </div>

            <p>
                Please download and sign the <a href="{{ asset('assets/docs/Letter_of_Indemnity.docx') }}" download>Letter of Indemnity</a> before uploading:
            </p>
            <div class="mb-3">
                <label>Upload Signed Letter of Indemnity (in PDF)</label>
                <input type="file" name="indemnity_file" class="form-control" required>
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

    function showStep(step) {
        steps.forEach((s, i) => s.classList.toggle('active', i === step));
        progressBar.style.width = `${((step + 1) / steps.length) * 100}%`;
        progressBar.innerText = `Step ${step + 1} of ${steps.length}`;
    }

    document.querySelectorAll('.next-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            // Validate inputs before moving to next
            const currentInputs = steps[currentStep].querySelectorAll('input, select, textarea');
            for (const input of currentInputs) {
                if (!input.checkValidity()) {
                    input.reportValidity();
                    return;
                }
            }
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

    document.getElementById('mobilityForm').addEventListener('submit', function(e) {
        if (!confirm('Are you sure you want to submit your mobility application?')) {
            e.preventDefault();
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
