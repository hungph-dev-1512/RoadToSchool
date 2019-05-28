@extends('admin.admin_layouts.master')

@section('title')
    {{ __('information') }}
@endsection

@section('inline_styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/admin-custom.css') }}">
@endsection

@section('content')
    <div class="message-display">
        @include('flash::message')
    </div>
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-header">
                <h2 class="header-title">{{ __('categories') }}</h2>
                <div class="header-sub-title">
                    <nav class="breadcrumb breadcrumb-dash">
                        <a href="{{ route('admins.adminDashboard') }}" class="breadcrumb-item">
                            <i class="ti-home p-r-5"></i>{{ __('admin dashboard') }}
                        </a>
                        <a href="{{ route('admins.categories.index') }}" class="breadcrumb-item">
                            {{ __('categories') }}
                        </a>
                        <span class="breadcrumb-item active">{{ $category->title }}</span>
                    </nav>
                </div>
            </div>
            <div class="card">
                <div class="card-header border bottom">
                    <h4 class="card-title">{{ __('update existed category') }}</h4>
                </div>
                <div class="card-body">
                    {{ Form::model($category, ['route' => ['admins.categories.update', $category->id], 'method' => 'put']) }}

                    @foreach ($errors->all() as $error)
                        <p class="alert alert-danger fix-alert">{{ $error }}</p>
                    @endforeach

                    <div class="row">
                        <div class="col-sm-10 offset-sm-1">
                            <div class="row">
                                <div class="col-sm-8 offset-sm-2">
                                    <form class="m-t-45">
                                        <div class="form-group">
                                            {!! Form::label('title', __('title'), ['class' => 'control-label']) !!}
                                            {!! Form::text('title', null, ['class' => 'form-control']) !!}
                                        </div>
                                        @if ($category->parent_id !== 0)
                                            <div class="form-group">
                                                {!! Form::label('parent_id', __('parent category'), ['class' => 'control-label']) !!}
                                                {!! Form::select('parent_id', $parentCategories, $category->parent_id, ['class' => 'form-control']) !!}
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <div class="text-sm-right">
                                                {{ Form::submit(__('update'), ['class' => 'btn btn-gradient-success m-b-20']) }}
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('inline_scripts')
    <script>
        $(document).ready(function () {
            $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
        })
    </script>
@endsection
