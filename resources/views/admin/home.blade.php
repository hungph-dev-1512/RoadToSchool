@extends('admin.layouts.default')

@section('title')
    {{ __('titles.r2s_admin_dashboard') }}
@endsection

@section('page_style')
    {{-- page css --}}
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/jvectormap-master/jquery-jvectormap-2.0.3.css') }}" )/>
@endsection
@section('content')
    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Earning</h4>
                        </div>
                        <div class="card-body">
                            <h2 class="font-weight-light font-size-28 m-b-0">$26,932</h2>
                            <span>Sales:</span>
                            <span class="text-dark">1,782</span>
                        </div>
                        <div class="m-b-15">
                            <canvas id="earning-chart" class="chart" style="height: 170px;"></canvas>
                        </div>
                        <div class="row p-v-25">
                            <div class="col border right">
                                <div class="text-center">
                                    <span class="text-semibold d-block opacity-07">Margin</span>
                                    <span class="text-semibold">$17,312</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-center">
                                    <span class="text-semibold d-block opacity-07">Fees</span>
                                    <span class="text-semibold">$9,620</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="row no-gutters">
                            {{--<div class="col-md-8">--}}
                            {{--<div class="card-body border right border-hide-md">--}}
                            {{--<div class="map-400" id="map"></div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            <div class="col-md-12">
                                <div class="card-header">
                                    <h4 class="card-title">Category Allocation</h4>
                                </div>
                                <div class="card-body">
                                    <div class="m-t-10">
                                        <span class="status success"></span>
                                        <span class="m-b-10 font-size-16 m-l-5">Development</span>
                                        <div class="float-right">
                                            <b class=" font-size-18 text-dark">38</b>
                                            <span>%</span>
                                        </div>
                                        <div class="progress m-t-15">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 38%"
                                                 aria-valuenow="38" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="m-t-40">
                                        <span class="status info"></span>
                                        <span class="m-b-10 font-size-16 m-l-5">Marketing</span>
                                        <div class="float-right">
                                            <b class=" font-size-18 text-dark">26</b>
                                            <span>%</span>
                                        </div>
                                        <div class="progress m-t-15">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 26%"
                                                 aria-valuenow="26" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="m-t-40">
                                        <span class="status warning"></span>
                                        <span class="m-b-10 font-size-16 m-l-5">IT & Software</span>
                                        <div class="float-right">
                                            <b class=" font-size-18 text-dark">36</b>
                                            <span>%</span>
                                        </div>
                                        <div class="progress m-t-15">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 36%"
                                                 aria-valuenow="36" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="m-t-40">
                                        <button class="btn btn-default">View All</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h4 class="m-b-0">Page Views</h4>
                                    <p>12,158</p>
                                </div>
                                <div class="col text-right">
                                    <button class="btn btn-default btn-sm m-t-10">View Details</button>
                                </div>
                            </div>
                            <div class="m-t-20">
                                <canvas class="chart" id="page-view-chart" style="height: 105px;"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h4 class="m-b-0">Sales Stat</h4>
                                    <p>Jan 1th ~ 15th</p>
                                </div>
                                <div class="col text-right">
                                    <button class="btn btn-default btn-sm m-t-10">View Details</button>
                                </div>
                            </div>
                            <div class="m-t-10">
                                <canvas class="chart" id="sales-stat-chart" style="height: 105px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">User Statistic</h4>
                            {{--<a href="{{ route('admin.users.index') }}"><span class="arrow pull-right">--}}
                            {{--<i class="mdi mdi-chevron-right"></i>--}}
                            {{--</span></a>--}}
                            <div class="card-toolbar">
                                <ul>
                                    <li>
                                        <a class="text-gray" href="{{ route('admin.users.index') }}">
                                            <i class="mdi mdi-dots-vertical font-size-20"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="m-b-40">
                                <canvas id="statistic-chart" class="chart" style="height:220px"></canvas>
                            </div>
                            <div class="row">
                                <div class="col-sm-10 offset-sm-1">
                                    <div class="m-b-20">
                                        <span class="status success"></span>
                                        <span class="m-b-10 font-size-16 m-l-5">Admin</span>
                                        <div class="float-right">
                                            <b class="text-dark">{{ $count['adminsCount'] }}</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-10 offset-sm-1">
                                    <div class="m-b-20">
                                        <span class="status primary"></span>
                                        <span class="m-b-10 font-size-16 m-l-5">Instructor</span>
                                        <div class="float-right">
                                            <b class=" text-dark">{{ $count['teachersCount'] }}</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-10 offset-sm-1">
                                    <div class="m-b-20">
                                        <span class="status info"></span>
                                        <span class="m-b-10 font-size-16 m-l-5">Student</span>
                                        <div class="float-right">
                                            <b class=" text-dark">{{ $count['studentsCount'] }}</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Excellent Instructor</h4>
                            <div class="card-toolbar">
                                <ul>
                                    <li>
                                        <a class="text-gray" href="{{ route('admin.instructor_ranking') }}">
                                            <i class="mdi mdi-dots-vertical font-size-20"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <ul class="list-media m-b-20">
                            @foreach($excellentInstructors as $key => $instructor)
                                <li class="list-item">
                                    <div class="p-v-15 p-h-20">
                                        <div class="media-img">
                                            <img src="{{ str_replace('public/', '', asset($instructor->avatar)) }}"
                                                 alt="">
                                        </div>
                                        <div class="info">
                                            <span class="title text-semibold font-size-15">{{ $instructor->name }}</span>
                                            <span class="sub-title">{{ $instructor->instructor_rate }}</span>
                                            <div class="float-item">
                                                <span class="font-size-16 text-success"> #{{ ($key + 1) }} </span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Recent Bill</h4>
                            <div class="card-toolbar">
                                <ul>
                                    <li>
                                        <a class="text-gray" href="{{ route('admin.bills.index') }}">
                                            <i class="mdi mdi-dots-vertical font-size-20"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="table-overflow">
                            <table class="table table-lg">
                                <thead>
                                <tr class="bg-gray">
                                    <td class="text-dark text-semibold p-v-10">Bill ID</td>
                                    <td class="text-dark text-semibold p-v-10">Status</td>
                                    <td class="text-dark text-semibold p-v-10">Customer Name</td>
                                    <td class="text-dark text-semibold p-v-10">Order Date</td>
                                    <td class="text-dark text-semibold p-v-10">Amount</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($newestBills as $bill)
                                    <tr>
                                        <td><a href="{{ route('admin.bills.show', $bill->id) }}">#{{ $bill->id }}</a>
                                        </td>
                                        <td> {{ \App\Models\Bill::$status[$bill->status] }}</td>
                                        <td>{{ $bill->customer_name }}</td>
                                        <td>{{ $bill->created_at->toDateString() }}</td>
                                        <td>${{ $bill->total_amount }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Course stats</h4>
                            <div class="card-toolbar">
                                <ul>
                                    <li>
                                        <a class="text-gray" href="{{ route('admin.courses.index') }}">
                                            <i class="mdi mdi-dots-vertical font-size-20"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="table-overflow">
                            <table class="table table-lg">
                                <thead>
                                <tr class="bg-gray">
                                    <td class="text-dark text-semibold p-v-10">Title</td>
                                    <td class="text-dark text-semibold p-v-10">Price</td>
                                    <td class="text-dark text-semibold p-v-10">Sales</td>
                                    <td class="text-dark text-semibold p-v-10">Rate</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($mostSellerCourseList as $course)
                                    <tr>
                                        <td>
                                            <div class="list-media">
                                                <div class="list-item">
                                                    <div class="media-img">
                                                        <img src="{{ asset(str_replace('public', '', $course->course_avatar)) }}"
                                                             alt="">
                                                    </div>
                                                    <div class="info">
                                                        <span class="title p-t-10 text-semibold">{{ $course->title }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            ${{ $course->promotion_price ? $course->promotion_price : $course->origin_price}}</td>
                                        <td>{{ $course->seller }}</td>
                                        <td>{{ $course->course_rate }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Wrapper END -->
@endsection

@section('inline_scripts')
    <!-- page js -->
    <script src="{{ asset('assets/admin/vendor/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/jvectormap-master/jquery-jvectormap-2.0.3.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/maps/vector-map-lib/jquery-jvectormap-world-mill.js') }}"></script>
    <script src="{{ asset('assets/admin/js/dashboard/saas.js') }}"></script>
    <script>
        $(document).ready(function () {
            //Statistic Chart
            var statisticCtx = document.getElementById('statistic-chart').getContext('2d');
            var statisticChartGradient = statisticCtx.createLinearGradient(0, 0, 0, 150);
            statisticChartGradient.addColorStop(0, app.colors.gradientSuccessStart);
            statisticChartGradient.addColorStop(1, app.colors.gradientSuccessStop);

            var donutConfig = new Chart(statisticCtx, {
                type: 'doughnut',
                data: {
                    labels: ["Admin", "Instructor", "Student"],
                    datasets: [{
                        data: ['{{ $count['adminsCount']/$count['totalUsers']*100 }}', '{{ $count['teachersCount']/$count['totalUsers']*100 }}', '{{ $count['studentsCount']/$count['totalUsers']*100 }}'],
                        backgroundColor: [statisticChartGradient, app.colors.primary, app.colors.info]
                    }]
                },
                options: {
                    elements: {
                        arc: {
                            borderWidth: 6,
                        }
                    },
                    maintainAspectRatio: false,
                    hover: {mode: null},
                    legend: {
                        display: false
                    },
                    cutoutPercentage: 78,
                }
            });
        })
    </script>
@endsection