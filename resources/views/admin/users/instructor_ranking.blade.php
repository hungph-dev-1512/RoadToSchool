@extends('admin.layouts.default')

@section('title')
    {{ __('titles.instructor_ranking') }}
@endsection

@section('inline_styles')
@endsection

@section('content')
    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-header">
                <h2 class="header-title">Instructor Ranking</h2>
                <div class="header-sub-title">
                    <nav class="breadcrumb breadcrumb-dash">
                        <a href="{{ route('admin.dashboard') }}" class="breadcrumb-item"><i class="ti-home p-r-5"></i>Home</a>
                        <a class="breadcrumb-item" href="{{ route('admin.users.index') }}">Users</a>
                        <span class="breadcrumb-item active">Instructor Ranking</span>
                    </nav>
                </div>
            </div>
            <div class="card">
                <div class="card-header border bottom">
                    <h4 class="card-title">Instructor Ranking Table</h4>
                </div>
                @include('flash::message')
                <div class="card-body">
                    <div class="table-overflow">
                        <table class="table table-xl border">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Ranking</th>
                                <th scope="col">Instructor</th>
                                <th scope="col">Courses</th>
                                <th scope="col">Student</th>
                                <th scope="col">Status</th>
                                <th scope="col">Rate</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orderRankingInstructors as $instructor)
                                <tr>
                                    <td>
                                        <div class="list-media">
                                            <div class="list-item">
                                                @if($instructor->ranking === 1)
                                                    <div class="media-img">
                                                        <img class="rounded" style="width: 20px; height: 20px"
                                                             src="{{ asset('assets/admin/images/others/1st.png') }}"
                                                             alt="">
                                                    </div>
                                                @elseif($instructor->ranking === 2)
                                                    <div class="media-img">
                                                        <img class="rounded" style="width: 20px; height: 20px"
                                                             src="{{ asset('assets/admin/images/others/2nd.png') }}"
                                                             alt="">
                                                    </div>
                                                @elseif($instructor->ranking === 3)
                                                    <div class="media-img">
                                                        <img class="rounded" style="width: 20px; height: 20px"
                                                             src="{{ asset('assets/admin/images/others/3rd.png') }}"
                                                             alt="">
                                                    </div>
                                                @endif
                                                <div class="info" style="padding-left: 30px">
                                                    @if($instructor->ranking === 1)
                                                        <span class="title" style="padding-top: 4px; color: #005C9E">
                                                            {{ \App\Models\User::ordinal($instructor->ranking) }}
                                                        </span>
                                                    @elseif($instructor->ranking === 2)
                                                        <span class="title" style="padding-top: 4px; color: #84BD36">
                                                            {{ \App\Models\User::ordinal($instructor->ranking) }}
                                                        </span>
                                                    @elseif($instructor->ranking === 3)
                                                        <span class="title" style="padding-top: 4px; color: #E03914">
                                                            {{ \App\Models\User::ordinal($instructor->ranking) }}
                                                        </span>
                                                    @else
                                                        <span class="title" style="padding-top: 4px;">
                                                            {{ \App\Models\User::ordinal($instructor->ranking) }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="list-media">
                                            <div class="list-item">
                                                <div class="media-img">
                                                    <img class="rounded"
                                                         src="{{ str_replace('public/', '', asset($instructor->avatar)) }}"
                                                         alt="">
                                                </div>
                                                <div class="info">
                                                    <span class="title">{{ $instructor->name }}</span>
                                                    <span class="sub-title">{{ $instructor->email }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $instructor->coursesCount }}</td>
                                    <td>{{ $instructor->studentsCount }}</td>
                                    <td><span class="badge badge-pill {{ $instructor->deleted_at ? 'badge-danger' : 'badge-success' }}">
                                            @if(!$instructor->deleted_at)
                                                Active
                                            @else
                                                Expired
                                            @endif
                                        </span></td>
                                    <td>{{ $instructor->instructor_rate }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Wrapper END -->
@endsection

@section('inline_scripts')

@endsection