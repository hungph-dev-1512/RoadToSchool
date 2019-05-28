@extends('admin.layouts.default')

@section('title')
    {{ __('titles.create_new_bill') }}
@endsection

@section('inline_styles')
@endsection

@section('content')
    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-header">
                <h2 class="header-title">Create New Bill</h2>
                <div class="header-sub-title">
                    <nav class="breadcrumb breadcrumb-dash">
                        <a href="{{ route('admin.dashboard') }}" class="breadcrumb-item"><i class="ti-home p-r-5"></i>Home</a>
                        <a class="breadcrumb-item" href="{{ route('admin.bills.index') }}">Bills</a>
                        <span class="breadcrumb-item active">Create New Bill</span>
                    </nav>
                </div>
            </div>
            <div class="card">
                <div class="card-header border bottom">
                    <h4 class="card-title">Form Create</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-10 offset-sm-1">
                            <div class="row">
                                <div class="col-sm-8 offset-sm-2">
                                    <form class="m-t-45">
                                        <div class="form-group">
                                            <label class="control-label">Credit Card Number</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="control-label">CVV Code</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="control-label">Expiry Date</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Card Holder Name</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <div class="text-sm-right">
                                                <button class="btn btn-default">Back</button>
                                                <button class="btn btn-gradient-success">Next</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Wrapper END -->
@endsection

@section('inline_scripts')

@endsection