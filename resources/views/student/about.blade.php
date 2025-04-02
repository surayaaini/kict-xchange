@extends('layouts.master')

@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">About</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Student</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- About Us Section -->
    <section class="about-us text-center p-5 rounded shadow-lg bg-white">
        <h2 class="fw-bold text-primary">ABOUT US</h2>
        <p class="text-muted">
            The Academic and Internationalisation Office provides direction and leadership for optimizing performance
            in KICT. Our mission focuses on:
        </p>
        <p><strong>i. Learning, Teaching and Curriculum Development and Innovation</strong></p>
        <p><strong>ii. Teaching Quality and Students’ Support Staff Monitoring and Development</strong></p>
        <p><strong>iii. Handling MOU and MOA for academic and industrial collaborations</strong></p>
        <p class="text-muted">
            We work closely with all Head of Departments to provide quality services and humanising education in line with
            the IIUM core values: <i>“Khalifah, Amanah, Iqra’, Rahmatan lil-Alamin” (khAIR)</i>.
        </p>
    </section>

    <!-- Two Column Sections -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card p-4 shadow-lg border-0 rounded-3 hover-card">
                <h4 class="fw-bold text-primary">Academic Affairs</h4>
                <ul class="list-unstyled text-muted">
                    <li>🔹 Coordination on Academic Review for Undergraduate programme</li>
                    <li>🔹 Course offering, registration, examination, and graduation coordination</li>
                    <li>🔹 Declaring programmes (BIT, BCS)</li>
                    <li>🔹 KICT promotional activities</li>
                    <li>🔹 Student applications & appeals (Study plan, Transfer Credit, etc.)</li>
                    <li>🔹 Internal & external audits (MDEC, SIRIM, MQA, etc.)</li>
                    <li>🔹 Implementation of university policies on academic activities</li>
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4 shadow-lg border-0 rounded-3 hover-card">
                <h4 class="fw-bold text-primary">Internationalisation</h4>
                <ul class="list-unstyled text-muted">
                    <li>🌍 Monitor student mobility (inbound/outbound & credit/non-credited)</li>
                    <li>🌍 Assist in staff mobility programs</li>
                    <li>🌍 Managing MOA, MOU, and LOI of Kulliyyah of ICT</li>
                    <li>🌍 Creating partnerships with universities & industries</li>
                    <li>🌍 International visits & scholar meetings</li>
                    <li>🌍 Collaboration with Office of the Deputy Rector & International Office</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Staff Carousel Section -->
    <section class="mt-5 text-center">
        <h3 class="fw-bold text-primary">ACADEMIC & INTERNATIONALISATION</h3>
        <div id="staffCarousel" class="carousel slide mt-3" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="staff-card text-center">
                        <img src="assets/img/profiles/drlili.jpg" class="rounded-circle staff-img" alt="Staff">
                        <h5 class="fw-bold">Assoc. Prof. Dr. Lili Marziana Bt. Abdullah</h5>
                        <p class="text-muted">Deputy Dean Academic & Internationalisation</p>
                        <p class="email-text">
                            <a href="mailto:lmarziana@iium.edu.my" class="text-decoration-none text-primary fw-bold">
                                lmarziana@iium.edu.my
                            </a>
                        </p>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="staff-card text-center">
                        <img src="assets/img/profiles/narieta-1.jpg" class="rounded-circle staff-img" alt="Staff">
                        <h5 class="fw-bold">Narieta Bt. Bukhari</h5>
                        <p class="text-muted">Administrative Officer</p>
                        <p class="email-text">
                            <a href="mailto:narieta@iium.edu.my" class="text-decoration-none text-primary fw-bold">
                                narieta@iium.edu.my
                            </a>
                        </p>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="staff-card text-center">
                        <img src="assets/img/profiles/meor.jpg" class="rounded-circle staff-img" alt="Staff">
                        <h5 class="fw-bold">Meor Shahmer Azrai Bin Meor Shamsudin</h5>
                        <p class="text-muted">Assistant (Clerical/Operation)</p>
                        <p class="email-text">
                            <a href="mailto:meorshahmer@iium.edu.my" class="text-decoration-none text-primary fw-bold">
                                meorshahmer@iium.edu.my
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#staffCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#staffCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>

        </div>
        <p></p>
        <p></p>
        <p></p>
        <p></p>
        <p></p>

    </section>

</div>

<!-- Custom Styling -->
<style>
    .hover-card {
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .hover-card:hover {
        transform: scale(1.03);
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.15);
    }

    .staff-card {
        padding: 20px;
    }

    .staff-img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        transition: transform 0.3s ease-in-out;
        border: 5px solid transparent;
    }

    .staff-img:hover {
        transform: scale(1.1);
        border-color: #007bff;
    }

    .email-text {
        font-size: 14px;
        color: #007bff;
    }
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        filter: invert(29%) sepia(80%) saturate(1531%) hue-rotate(204deg) brightness(95%) contrast(95%);
    }

</style>
@endsection


<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/feather.min.js"></script>
<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="assets/plugins/apexchart/apexcharts.min.js"></script>
<script src="assets/plugins/apexchart/chart-data.js"></script>
<script src="assets/plugins/simple-calendar/jquery.simple-calendar.js"></script>
<script src="assets/js/calander.js"></script>
<script src="assets/js/circle-progress.min.js"></script>
<script src="assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
