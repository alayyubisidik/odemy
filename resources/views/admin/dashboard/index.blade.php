@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl" style="min-height: 72vh; padding-left: 30px ">
        <div class="col mb-4">
            <!-- Page pre-title -->
            <div class="page-pretitle">
                Overview
            </div>
            <h2 class="page-title">
                Dashboard
            </h2>
        </div>
        <div class="col-12">
            <div class="row row-cards mb-3">
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path
                                                d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2">
                                            </path>
                                            <path d="M12 3v3m0 12v3"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $dailyOrder }}
                                    </div>
                                    <div class="text-secondary">
                                        Daily Orders
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path
                                                d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2">
                                            </path>
                                            <path d="M12 3v3m0 12v3"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $weeklyOrder }}
                                    </div>
                                    <div class="text-secondary">
                                        Weekly Orders
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path
                                                d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2">
                                            </path>
                                            <path d="M12 3v3m0 12v3"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $monthlyOrder }}
                                    </div>
                                    <div class="text-secondary">
                                        Monthly Orders
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path
                                                d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2">
                                            </path>
                                            <path d="M12 3v3m0 12v3"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $yearlyOrder }}
                                    </div>
                                    <div class="text-secondary">
                                        Yearly Orders
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-cards">
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="bg-success text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                        <i class="ti ti-clipboard-text"></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $totalOrders }}
                                    </div>
                                    <div class="text-secondary">
                                        Total Orders
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="bg-yellow text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                        <i class="ti ti-clipboard-text"></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $pendingCourses }}
                                    </div>
                                    <div class="text-secondary">
                                        Pending Courses
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="bg-danger text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                        <i class="ti ti-clipboard-text"></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $rejectedCourses }}
                                    </div>
                                    <div class="text-secondary">
                                        Rejected Courses
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                        <i class="ti ti-clipboard-text"></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $totalCourses }}
                                    </div>
                                    <div class="text-secondary">
                                        Total Courses
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">

            <div class="card-header">

                <div>
                    <h3 class="card-title">
                        Order Analytics
                    </h3>

                    <div class="text-secondary">
                        Monthly sales & order statistics
                    </div>
                </div>

            </div>

            <div class="card-body">

                <canvas id="orderChart" height="110"></canvas>

            </div>

        </div>


        <div class="row mt-4">

            {{-- RECENT COURSES --}}
            <div class="col-lg-4 mb-4">

                <div class="card h-100">

                    <div class="card-header">

                        <h3 class="card-title">
                            Recent Courses
                        </h3>

                        <div class="card-actions">

                            <a href="{{ route('admin.courses.index') }}" class="btn btn-sm btn-primary">

                                View All

                            </a>

                        </div>

                    </div>

                    <div class="table-responsive">

                        <table class="table table-vcenter card-table">

                            <thead>

                                <tr>
                                    <th>Course</th>
                                    <th>Price</th>
                                </tr>

                            </thead>

                            <tbody>

                                @forelse ($recentCourses as $course)
                                    <tr>

                                        <td>

                                            <div class="d-flex align-items-center gap-2">

                                                <img src="{{ asset($course->thumbnail) }}" alt="Course"
                                                    style="
                                                width: 45px;
                                                height: 45px;
                                                object-fit: cover;
                                                border-radius: 10px;
                                            ">

                                                <div>

                                                    <div class="font-weight-medium">

                                                        <a href="{{ route('admin.courses.edit', $course) }}"
                                                            class="text-reset">

                                                            {{ Str::limit($course->title, 30) }}

                                                        </a>

                                                    </div>

                                                    <div class="text-secondary">
                                                        {{ $course->instructor->name ?? '-' }}
                                                    </div>

                                                </div>

                                            </div>

                                        </td>

                                        <td>
                                            ${{ number_format($course->price, 2) }}
                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="2" class="text-center">
                                            No Data
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            {{-- RECENT ORDERS --}}
            <div class="col-lg-4 mb-4">

                <div class="card h-100">

                    <div class="card-header">

                        <h3 class="card-title">
                            Recent Orders
                        </h3>

                        <div class="card-actions">

                            <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-primary">

                                View All

                            </a>

                        </div>

                    </div>

                    <div class="table-responsive">

                        <table class="table table-vcenter card-table">

                            <thead>

                                <tr>
                                    <th>User</th>
                                    <th>Total</th>
                                </tr>

                            </thead>

                            <tbody>

                                @forelse ($recentOrders as $order)
                                    <tr>

                                        <td>

                                            <div>

                                                <div class="font-weight-medium">

                                                    <a href="{{ route('admin.orders.show', $order) }}"
                                                        class="text-reset">

                                                        {{ $order->user->name ?? '-' }}

                                                    </a>

                                                </div>

                                                <div class="text-secondary">
                                                    {{ $order->created_at->diffForHumans() }}
                                                </div>

                                            </div>

                                        </td>

                                        <td>

                                            <span class="badge bg-success-lt">

                                                ${{ number_format($order->total_amount, 2) }}

                                            </span>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="2" class="text-center">
                                            No Data
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            {{-- RECENT BLOGS --}}
            <div class="col-lg-4 mb-4">

                <div class="card h-100">

                    <div class="card-header">

                        <h3 class="card-title">
                            Recent Blogs
                        </h3>

                        <div class="card-actions">

                            <a href="{{ route('admin.blogs.index') }}" class="btn btn-sm btn-primary">

                                View All

                            </a>

                        </div>

                    </div>

                    <div class="table-responsive">

                        <table class="table table-vcenter card-table">

                            <thead>

                                <tr>
                                    <th>Blog</th>
                                    <th>Status</th>
                                </tr>

                            </thead>

                            <tbody>

                                @forelse ($recentBlogs as $blog)
                                    <tr>

                                        <td>

                                            <div class="d-flex align-items-center gap-2">

                                                <img src="{{ asset($blog->image) }}" alt="Blog"
                                                    style="
                                                width: 45px;
                                                height: 45px;
                                                object-fit: cover;
                                                border-radius: 10px;
                                            ">

                                                <div>

                                                    <div class="font-weight-medium">

                                                        <a href="{{ route('admin.blogs.edit', $blog) }}"
                                                            class="text-reset">

                                                            {{ Str::limit($blog->title, 28) }}

                                                        </a>

                                                    </div>
                                                    <div class="text-secondary">
                                                        {{ $blog->created_at->diffForHumans() }}
                                                    </div>

                                                </div>

                                            </div>

                                        </td>

                                        <td>

                                            @if ($blog->status == 1)
                                                <span class="badge bg-success-lt">
                                                    Published
                                                </span>
                                            @else
                                                <span class="badge bg-warning-lt">
                                                    Draft
                                                </span>
                                            @endif

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="2" class="text-center">
                                            No Data
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>


    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('orderChart').getContext('2d');

        new Chart(ctx, {

            data: {

                labels: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
                ],

                datasets: [

                    // BAR CHART - TOTAL SALES
                    {
                        type: 'bar',

                        label: 'Total Sales',

                        data: @json($monthlyOrderSums),

                        backgroundColor: 'rgba(59, 130, 246, 0.5)',

                        borderColor: 'rgba(59, 130, 246, 1)',

                        borderWidth: 1,

                        yAxisID: 'y',
                    },

                    // LINE CHART - TOTAL ORDERS
                    {
                        type: 'line',

                        label: 'Total Orders',

                        data: @json($monthlyOrderCounts),

                        borderColor: 'rgba(239, 68, 68, 1)',

                        backgroundColor: 'rgba(239, 68, 68, 0.2)',

                        tension: 0.4,

                        fill: false,

                        pointRadius: 4,

                        pointHoverRadius: 6,

                        yAxisID: 'y1',
                    }

                ]
            },

            options: {

                responsive: true,

                interaction: {
                    mode: 'index',
                    intersect: false,
                },

                stacked: false,

                plugins: {

                    legend: {
                        position: 'top',
                    },

                    tooltip: {
                        enabled: true,
                    }

                },

                scales: {

                    y: {

                        type: 'linear',

                        display: true,

                        position: 'left',

                        beginAtZero: true,

                        title: {
                            display: true,
                            text: 'Sales Amount'
                        }

                    },

                    y1: {

                        type: 'linear',

                        display: true,

                        position: 'right',

                        beginAtZero: true,

                        grid: {
                            drawOnChartArea: false,
                        },

                        title: {
                            display: true,
                            text: 'Order Count'
                        }

                    }

                }

            }

        });
    </script>
@endpush
