@extends('frontend.instructor.dashboard.dashboard-app')

@section('dashboard-content')
    <div class="wsus__dashboard_contant">

        @if (user()->approve_status == 'pending')
            <div class="alert alert-important alert-warning alert-dismissible" style="display: flex; gap: 15px;"
                role="alert">
                <div class="alert-icon">
                    <!-- Download SVG icon from http://tabler.io/icons/icon/alert-triangle -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon alert-icon icon-2">
                        <path d="M12 9v4"></path>
                        <path
                            d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z">
                        </path>
                        <path d="M12 16h.01"></path>
                    </svg>
                </div>
                <div>
                    <h5 class="alert-heading" style="margin-bottom: 2px">Your Instructor Request is Pending</h5>
                    <p class="alert-description">Please wait for the admin to approve your Request.</p>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif

        @if (user()->approve_status == 'rejected')
            <div class="alert alert-important alert-danger alert-dismissible" style="display: flex; gap: 15px;"
                role="alert">
                <div class="alert-icon">
                    <!-- Download SVG icon from http://tabler.io/icons/icon/alert-circle -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon alert-icon icon-2">
                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                        <path d="M12 8v4"></path>
                        <path d="M12 16h.01"></path>
                    </svg>
                </div>
                <div>
                    <h5 style="margin-bottom: 2px" class="alert-heading">Instructor Request Rejected</h5>
                    <p class="alert-description">
                        Unfortunately, your request to become an instructor has been rejected.
                        <br>If you need further assistance, you may contact our customer service through the
                        <a href="" class="text-primary text-decoration-underline">Contact</a> page.
                    </p>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif

        <div class="row">
            <div class="col-xl-4 col-sm-6 wow fadeInUp">
                <div class="wsus__dash_earning">
                    <h6>REVENUE</h6>
                    <h3>$2456.34</h3>
                    <p>Earning this month</p>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 wow fadeInUp">
                <div class="wsus__dash_earning">
                    <h6>STUDENTS ENROLLMENTS</h6>
                    <h3>16,450</h3>
                    <p>Progress this month</p>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 wow fadeInUp">
                <div class="wsus__dash_earning">
                    <h6>COURSES RATING</h6>
                    <h3>4.70</h3>
                    <p>Rating this month</p>
                </div>
            </div>
        </div>

        <div class="wsus__dashboard_chat_graps">
            <div class="row">
                <div class="col-xl-8 wow fadeInRight">
                    <div class="wsus__dashboard_graph">
                        <h5>Earnings</h5>
                        <div class="example-two"></div>
                    </div>
                </div>
                <div class="col-xl-4 wow fadeInRight">
                    <div class="wsus__dashboard_barfiller">
                        <h5>Complated Course</h5>
                        <div class="single_bar">
                            <p>Java Code</p>
                            <div id="bar1" class="barfiller">
                                <div class="tipWrap">
                                    <span class="tip"></span>
                                </div>
                                <span class="fill orrange" data-percentage="75"></span>
                            </div>
                        </div>
                        <div class="single_bar">
                            <p>Design Basic</p>
                            <div id="bar2" class="barfiller">
                                <div class="tipWrap">
                                    <span class="tip"></span>
                                </div>
                                <span class="fill" data-percentage="65"></span>
                            </div>
                        </div>
                        <div class="single_bar">
                            <p>Team Building</p>
                            <div id="bar3" class="barfiller">
                                <div class="tipWrap">
                                    <span class="tip"></span>
                                </div>
                                <span class="fill megenda" data-percentage="55"></span>
                            </div>
                        </div>
                        <div class="single_bar">
                            <p>Business Marketing</p>
                            <div id="bar4" class="barfiller">
                                <div class="tipWrap">
                                    <span class="tip"></span>
                                </div>
                                <span class="fill merun" data-percentage="45"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="wsus__dashboard_contant">
            <div class="wsus__dashboard_contant_top">
                <div class="wsus__dashboard_heading wow fadeInUp">
                    <h5>Best Selling Courses</h5>
                </div>
            </div>

            <div class="wsus__dash_course_table wow fadeInUp">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th class="image">
                                            COURSES
                                        </th>
                                        <th class="details">

                                        </th>
                                        <th class="sale">
                                            SALES
                                        </th>
                                        <th class="amount">
                                            AMOUNT
                                        </th>
                                    </tr>
                                    <tr>
                                        <td class="image">
                                            <div class="image_category">
                                                <img src="images/courses_3_img_1.jpg" alt="img"
                                                    class="img-fluid w-100">
                                            </div>
                                        </td>
                                        <td class="details">
                                            <p class="rating">
                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                <i class="fas fa-star-half-alt" aria-hidden="true"></i>
                                                <i class="far fa-star" aria-hidden="true"></i>
                                                <span>(5.0)</span>
                                            </p>
                                            <a class="title" href="#">Complete Blender Creator
                                                Learn
                                                3D Modelling.</a>

                                        </td>
                                        <td class="sale">
                                            <p>34</p>
                                        </td>
                                        <td class="amount">
                                            <p>$3,145.23</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="image">
                                            <div class="image_category">
                                                <img src="images/courses_3_img_2.jpg" alt="img"
                                                    class="img-fluid w-100">
                                            </div>
                                        </td>
                                        <td class="details">
                                            <p class="rating">
                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                <i class="fas fa-star-half-alt" aria-hidden="true"></i>
                                                <i class="far fa-star" aria-hidden="true"></i>
                                                <span>(5.0)</span>
                                            </p>
                                            <a class="title" href="#">Complete Blender Creator
                                                Learn
                                                3D Modelling.</a>

                                        </td>
                                        <td class="sale">
                                            <p>34</p>
                                        </td>
                                        <td class="amount">
                                            <p>$3,145.23</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="image">
                                            <div class="image_category">
                                                <img src="images/courses_3_img_3.jpg" alt="img"
                                                    class="img-fluid w-100">
                                            </div>
                                        </td>
                                        <td class="details">
                                            <p class="rating">
                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                <i class="fas fa-star-half-alt" aria-hidden="true"></i>
                                                <i class="far fa-star" aria-hidden="true"></i>
                                                <span>(5.0)</span>
                                            </p>
                                            <a class="title" href="#">Complete Blender Creator
                                                Learn
                                                3D Modelling.</a>

                                        </td>
                                        <td class="sale">
                                            <p>34</p>
                                        </td>
                                        <td class="amount">
                                            <p>$3,145.23</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
