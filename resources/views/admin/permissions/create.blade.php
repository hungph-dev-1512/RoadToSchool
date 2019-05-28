@extends('admin.layouts.default')

@section('title')
    {{ __('titles.add_new_permission') }}
@endsection

@section('inline_styles')
    <!-- page css -->
    <link href="{{ asset('assets/admin/vendor/selectize/dist/css/selectize.default.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/vendor/summernote/dist/summernote-bs4.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}"
          rel="stylesheet">
@endsection

@section('content')
    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-header">
                <h2 class="header-title">Add new permission</h2>
                <div class="header-sub-title">
                    <nav class="breadcrumb breadcrumb-dash">
                        <a href="#" class="breadcrumb-item"><i class="ti-home p-r-5"></i>Home</a>
                        <a class="breadcrumb-item" href="{{ route('admin.permissions.index') }}">Permissions</a>
                        <span class="breadcrumb-item active">Add new permission</span>
                    </nav>
                </div>
            </div>
            <div class="card">
                <div class="card-header border bottom">
                    <h4 class="card-title">Add new permission</h4>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    <p>Please input <code> permission content </code> and <code> permission group </code>
                        for create new permission.</p>
                    @include('flash::message')
                    <form action="{{ route('admin.permissions.store') }}" method="post">
                        @csrf
                        <div class="row m-t-30">
                            <div class="col-md-4">
                                <div class="p-h-10">
                                    <div class="form-group">
                                        <label class="control-label">Permission Content *</label>
                                        <input type="text" class="form-control" id="input-permission-content" name="content" placeholder="Permission Content ...">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Select permission group *</label>
                                    <select class="form-control" id="input-permission-group" name="group_permission">
                                        <option disabled="disabled" selected></option>
                                        @foreach($permissionGroupList as $key => $value)
                                            <option value="{{ $key }}"> {{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4" style="padding-top: 10px">
                                <div class="m-t-15">
                                    <div class="col-md-6" style="float: right;">
                                        <button class="btn btn-default" id="btn-reset" style="display: inline">Reset
                                        </button>
                                    </div>
                                    <div class="col-md-6" style="float: right">
                                        <button class="btn btn-info" id="btn-get-permission" style="display: inline;">
                                            Create
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @include('admin.permissions.partials.permission_list')
        </div>
    </div>
    <!-- Content Wrapper END -->
@endsection

@include('admin.layouts.delete_modal')

@section('inline_scripts')
    <script src="{{ asset('assets/admin/vendor/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/selectize/dist/js/standalone/selectize.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/admin/js/forms/form-elements.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#btn-reset').on('click', function (event) {
                event.preventDefault();
                $('#input-permission-content').val('');
                $('#input-permission-group').prop('selectedIndex',0);
            })
        })
    </script>
@endsection