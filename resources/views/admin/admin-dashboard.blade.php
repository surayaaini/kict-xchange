
@extends('layouts.master')

@section('content')

    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Welcome DDAI Admin!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">KICT X-Change</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Outbound Students</h6>
                                <h3>206</h3>
                            </div>
                            <div class="db-icon">
                                <img src="assets/img/icons/dash-icon-01.svg" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Completed Mobility Programmes</h6>
                                <h3>7</h3>
                            </div>
                            <div class="db-icon">
                                <img src="assets/img/icons/dash-icon-02.svg" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Partnerships (MOU/MOA)</h6>
                                <h3>30+</h3>
                            </div>
                            <div class="db-icon">
                                <img src="assets/img/icons/dash-icon-03.svg" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Inbound Students</h6>
                                <h3>19</h3>
                            </div>
                            <div class="db-icon">
                                <img src="assets/img/icons/dash-icon-01.svg" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="card card-chart">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h5 class="card-title">Number of Mobility Programmes</h5>
                            </div>
                            <div class="col-6">
                                <ul class="chart-list-out">
                                    <li><span class="circle-blue"></span>Teachers</li>
                                    <li><span class="circle-green"></span>Students</li>
                                    <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="apexcharts-area"></div>
                    </div>
                </div>

            </div>
            <div class="col-md-12 col-lg-6">

                <div class="card card-chart">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h5 class="card-title">Number of Mobility Students</h5>
                            </div>
                            <div class="col-6">
                                <ul class="chart-list-out">
                                    <li><span class="circle-blue"></span>Girls</li>
                                    <li><span class="circle-green"></span>Boys</li>
                                    <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="bar"></div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-lg-12 col-xl-12 d-flex">
                <div class="card flex-fill comman-shadow">
                    <div class="card-header d-flex align-items-center">
                        <h5 class="card-title">Mobility Proposal Applications (Outbound)</h5>
                        <ul class="chart-list-out student-ellips">
                            <li class="lesson-view-all"><a href="#">View All</a></li>
                            <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="teaching-card">
                            <ul class="steps-history">
                                <li>17 July - 4 August 2025</li>
                                <li>28 May - 6 June 2025</li>
                                <li>2 March - 1 April 2025</li>
                            </ul>
                            <ul class="activity-feed">
                                <li class="feed-item d-flex align-items-center">
                                    <div class="dolor-activity">
                                        <span class="feed-text1"><a>Java Odyssey: Sharing, Training and Beyond</a></span>
                                        <ul class="teacher-date-list">
                                            <li><i class="fas fa-calendar-alt me-2"></i>Ts. Dr. Dini Oktarina Dwi Handayani</li>
                                            <li>|</li>
                                            <li><i class="fas fa-clock me-2"></i>10 March 2025
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="activity-btns ms-auto">
                                        <button type="submit" class="btn btn-info">Details</button>
                                        <button type="submit" class="btn btn-info">In Progress</button>
                                    </div>
                                </li>
                                <li class="feed-item d-flex align-items-center">
                                    <div class="dolor-activity">
                                        <span class="feed-text1"><a>Egypt Summer School </a></span>
                                        <ul class="teacher-date-list">
                                            <li><i class="fas fa-calendar-alt me-2"></i>Dr. Lili Marziana Bt. Abdullah</li>
                                            <li>|</li>
                                            <li><i class="fas fa-clock me-2"></i>September 5, 2022
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="activity-btns complete ms-auto">
                                        <button type="submit" class="btn btn-info">Details</button>
                                        <button type="submit" class="btn btn-info">Approved</button>
                                    </div>
                                </li>
                                <li class="feed-item d-flex align-items-center">
                                    <div class="dolor-activity">
                                        <span class="feed-text1"><a>Mobility to Indonesia: Integrated Agriculture Technologies</a></span>
                                        <ul class="teacher-date-list">
                                            <li><i class="fas fa-calendar-alt me-2"></i>Dr. Mohd Khairul Azmi Bin Hassan</li>
                                            <li>|</li>
                                            <li><i class="fas fa-clock me-2"></i>September 5, 2022
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="activity-btns ms-auto">
                                        <button type="submit" class="btn btn-info">Details</button>
                                        <button type="submit" class="btn btn-info">Approved</button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-12 col-lg-12 col-xl-8">
                    <div class="card flex-fill comman-shadow">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="card-title">MOU/MOA Approval</h5>
                                </div>
                                <div class="col-6">
                                    <ul class="chart-list-out">
                                        <li><span class="circle-blue"></span><span class="circle-gray"></span><span
                                                class="circle-gray"></span></li>
                                        <li class="lesson-view-all"><a href="#">View All</a></li>
                                        <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="dash-circle">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 dash-widget1">
                                    <div class="circle-bar circle-bar2">
                                        <div class="circle-graph2" data-percent="80">
                                            <b>80%</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="dash-details">
                                        <div class="lesson-activity">
                                            <div class="lesson-imgs">
                                                <img src="assets/img/icons/lesson-icon-01.svg" alt="">
                                            </div>
                                            <div class="views-lesson">
                                                <h5>Class</h5>
                                                <h4>Electrical Engg</h4>
                                            </div>
                                        </div>
                                        <div class="lesson-activity">
                                            <div class="lesson-imgs">
                                                <img src="assets/img/icons/lesson-icon-02.svg" alt="">
                                            </div>
                                            <div class="views-lesson">
                                                <h5>Lessons</h5>
                                                <h4>5 Lessons</h4>
                                            </div>
                                        </div>
                                        <div class="lesson-activity">
                                            <div class="lesson-imgs">
                                                <img src="assets/img/icons/lesson-icon-03.svg" alt="">
                                            </div>
                                            <div class="views-lesson">
                                                <h5>Time</h5>
                                                <h4>Lessons</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="dash-details">
                                        <div class="lesson-activity">
                                            <div class="lesson-imgs">
                                                <img src="assets/img/icons/lesson-icon-04.svg" alt="">
                                            </div>
                                            <div class="views-lesson">
                                                <h5>Asignment</h5>
                                                <h4>5 Asignment</h4>
                                            </div>
                                        </div>
                                        <div class="lesson-activity">
                                            <div class="lesson-imgs">
                                                <img src="assets/img/icons/lesson-icon-05.svg" alt="">
                                            </div>
                                            <div class="views-lesson">
                                                <h5>Staff</h5>
                                                <h4>John Doe</h4>
                                            </div>
                                        </div>
                                        <div class="lesson-activity">
                                            <div class="lesson-imgs">
                                                <img src="assets/img/icons/lesson-icon-06.svg" alt="">
                                            </div>
                                            <div class="views-lesson">
                                                <h5>Lesson Learned</h5>
                                                <h4>10/50</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 d-flex align-items-center justify-content-center">
                                    <div class="skip-group">
                                        <button type="submit" class="btn btn-info skip-btn">Reject</button>
                                        <button type="submit" class="btn btn-info continue-btn">Approve</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4 col-xl-4 d-flex">
                    <div class="card flex-fill student-space comman-shadow d-flex flex-column">
                        <div class="card-header d-flex align-items-center">
                            <h5 class="card-title">DDAI Staff</h5>
                            <ul class="chart-list-out student-ellips">
                                <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a></li>
                            </ul>
                    </div>
                <div class="card-body flex-grow-1 d-flex flex-column">
                    <div class="table-responsive flex-grow-1">
                        <table class="table table-hover table-center table-borderless table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Email</th>
                                    <th>Extension</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Dr. Lili</td>
                                    <td>Deputy Dean (Head)</td>
                                    <td>lmarziana@iium.edu.my</td>
                                    <th>5657</th>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Narieta Bt Bukhari</td>
                                    <td>Administrative Officer</td>
                                    <td>narieta@iium.edu.my</td>
                                    <th>5609</th>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Narieta Bt Bukhari</td>
                                    <td>Administrative Assistant</td>
                                    <td>meorshahmer@iium.edu.my</td>
                                    <th>5609</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="mobility">
    <div class="col-12 col-lg-8 col-xl-12 d-flex" >
        <div class="card flex-fill comman-shadow">
            <div class="card-header" >
                <div class="row align-items-center">
                    <div class="col-6">
                        <h5 class="card-title">Mobility Experience</h5>
                    </div>
                    {{-- <div class="col-6">
                        <span class="float-end view-link">
                            <a href="{{ route('admin.admin.dashboard') }}">View All</a>
                        </span>
                    </div>--}}
                </div>
            </div>

            <div class="pt-3 pb-3">
                <div class="table-responsive lesson">
                    <table class="table table-center">
                        <tbody>
                            @if(isset($posts) && count($posts) > 0)
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>
                                            <div class="date">
                                                <b>{{ $post->title }}</b>
                                                <p>Status: {{ ucfirst($post->status) }}</p>
                                                {{-- <p>Author: {{ $post->user->name ?? 'Unknown' }}</p> --}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="lesson-confirm">
                                                <span class="badge bg-{{ $post->status === 'approved' ? 'success' : ($post->status === 'rejected' ? 'danger' : 'warning') }}">
                                                    {{ ucfirst($post->status) }}
                                                </span>
                                            </div>
                                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info">View Post</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="2">
                                        <p class="text-center">No posts available.</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const hash = window.location.hash;

        if (hash === '#mobility-card') {
            const target = document.querySelector(hash);
            if (target) {
                // Scroll into view with an offset (if you have fixed headers)
                const yOffset = -80; // adjust based on your fixed header height
                const y = target.getBoundingClientRect().top + window.pageYOffset + yOffset;

                window.scrollTo({ top: y, behavior: 'smooth' });

                // Optional: Highlight the card
                target.style.transition = 'background-color 0.5s ease';
                target.style.backgroundColor = '#ffffcc'; 
                setTimeout(() => {
                    target.style.backgroundColor = '';
                }, 2000);
            }
        }
    });
</script>

    {{-- <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Mobility Experience</h5>
                </div>
                <div class="card-body">
                    @if(isset($posts) && count($posts) > 0)
                        @foreach ($posts as $post)
                            <div class="mb-3">
                                <h6>{{ $post->title }}</h6>
                                 <p>Status: {{ ucfirst($post->status) }}</p>
                                <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-primary btn-sm">View</a>
                            </div>
                        @endforeach
                    @else
                        <p>No posts available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>--}}


            {{--  <div class="row">
                <div class="col-12 col-lg-8 col-xl-12 d-flex">
                    <div class="card flex-fill comman-shadow">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="card-title">Student Experience</h5>
                                </div>
                                <div class="col-6">
                                    <span class="float-end view-link"><a href="#">View All</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="pt-3 pb-3">
                            <div class="table-responsive lesson">
                                <table class="table table-center">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="date">
                                                    <b>An Unforgettable Semester</b>
                                                    <p>Kansai University</p>
                                                    <ul class="teacher-date-list">
                                                        <li><i class="fas fa-calendar-alt me-2"></i>Liesa Pearl</li>
                                                        <li>|</li>
                                                        <li><i class="fas fa-clock me-2"></i>Sem 1 (2022/2023)</li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="lesson-confirm">
                                                    <a href="#">Pending Approval</a>
                                                </div>
                                                <button type="submit" class="btn btn-info">View Post</button>
                                                <button type="submit" class="btn btn-info">Review</button>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="date">
                                                    <b>My Mobility to South Korea</b>
                                                    <p>Sun Moon University</p>
                                                    <ul class="teacher-date-list">
                                                        <li><i class="fas fa-calendar-alt me-2"></i>Sem 2 (2022/2023)</li>
                                                        <li>|</li>
                                                        <li><i class="fas fa-clock me-2"></i>Suraya Aini</li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="lesson-confirm">
                                                    <a href="#">Confirmed</a>
                                                </div>
                                                <button type="submit" class="btn btn-info">View Post</button>
                                                <button type="submit" class="btn btn-info">Review</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>  --}}



        {{-- <div class="row">
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card flex-fill fb sm-box">
                    <div class="social-likes">
                        <p>Like us on facebook</p>
                        <h6>50,095</h6>
                    </div>
                    <div class="social-boxs">
                        <img src="assets/img/icons/social-icon-01.svg" alt="Social Icon">
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card flex-fill twitter sm-box">
                    <div class="social-likes">
                        <p>Follow us on twitter</p>
                        <h6>48,596</h6>
                    </div>
                    <div class="social-boxs">
                        <img src="assets/img/icons/social-icon-02.svg" alt="Social Icon">
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card flex-fill insta sm-box">
                    <div class="social-likes">
                        <p>Follow us on instagram</p>
                        <h6>52,085</h6>
                    </div>
                    <div class="social-boxs">
                        <img src="assets/img/icons/social-icon-03.svg" alt="Social Icon">
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card flex-fill linkedin sm-box">
                    <div class="social-likes">
                        <p>Follow us on linkedin</p>
                        <h6>69,050</h6>
                    </div>
                    <div class="social-boxs">
                        <img src="assets/img/icons/social-icon-04.svg" alt="Social Icon">
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

@endsection