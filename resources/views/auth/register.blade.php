@extends('user.layouts.default')

@section('title')
    {{ __('titles.register') }}
@endsection

@section('inline_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/custom/register.css') }}">
@endsection

@section('content')
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-wrapper">
                        <h2 class="page-title"> {{ __('titles.register_new_acc') }} </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section id="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    <div class="page-login-form box">
                        <h3>
                            {{ __('titles.register') }}
                        </h3>
                        {{ Form::open(['method' => 'post']) }}
                        <div class="form-group error-form">
                            <div class="input-icon @if($errors->has('name')) error-input @endif">
                                <i class="icon fa fa-user"></i>
                                {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => __('titles.your_name')]) }}
                            </div>
                            <p>{{ $errors->first('name') }}</p>
                        </div>
                        <div class="form-group error-form">
                            <div class="input-icon @if($errors->has('email')) error-input @endif">
                                <i class="icon fa fa-envelope"></i>
                                {{ Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => __('titles.your_email')]) }}
                            </div>
                            <p>{{ $errors->first('email') }}</p>
                        </div>
                        <div class="form-group error-form">
                            <div class="input-icon @if($errors->has('password')) error-input @endif">
                                <i class="icon fa fa-unlock-alt"></i>
                                {{ Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => __('titles.your_password')]) }}
                            </div>
                            <p>{{ $errors->first('password') }}</p>
                        </div>
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="icon fa fa-unlock-alt"></i>
                                {{ Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password-confirmation', 'placeholder' => __('titles.your_password_confirmation')]) }}
                            </div>
                        </div>
                        <div class="checkbox">
                            {{ Form::checkbox('agree', null, false, ['id' => 'agree', 'onclick' => 'statusCheckboxAgree()', 'style' => 'float: left']) }}
                            {{ Form::label('agree', __('titles.agree_terms')) }}
                        </div>
                        {{ Form::submit(__('titles.register'), ['class' => 'btn btn-common log-btn', 'id' => 'submit']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('inline_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#name').focus(function () {
                $('#name').parent().removeClass('error-input');
                $('#name').parent().next().remove();
            });
            $('#email').focus(function () {
                $('#email').parent().removeClass('error-input');
                $('#email').parent().next().remove();
            });
            $('#password').focus(function () {
                $('#password').parent().removeClass('error-input');
                $('#password').parent().next().remove();
            });
        });

        $('#submit').on('click', function () {
            if (!$('#agree').is(':checked')) {
                event.preventDefault();
                alert("{{ __('messages.accept_terms_conditions') }}");
            }
        });
    </script>
@endsection