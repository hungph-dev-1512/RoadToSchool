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
                            <div class="form-group error-form">
                                <div class="input-icon @if($errors->has('password_confirmation')) error-input @endif">
                                    <i class="icon fa fa-unlock-alt"></i>
                                    {{ Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password-confirmation', 'placeholder' => __('titles.your_password_confirmation')]) }}
                                </div>
                                <p>{{ $errors->first('password') }}</p>
                            </div>
                            <div class="form-group error-form">
                                <div class="input-icon @if($errors->has('phone')) error-input @endif">
                                    <i class="icon fa fa-phone"></i>
                                    {{ Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone', 'placeholder' => __('titles.your_phone')]) }}
                                </div>
                                <p>{{ $errors->first('phone') }}</p>
                            </div>
                            <div class="form-group error-form">
                                <div class="input-icon @if($errors->has('birthday')) error-input @endif">
                                    <i class="icon fa fa-birthday-cake"></i>
                                    {{ Form::text('birthday', null, ['class' => 'form-control', 'id' => 'birthday', 'data-provide' => 'datepicker', 'data-date-format' => 'yy-mm-dd', 'placeholder' => __('titles.your_birthday')]) }}
                                </div>
                                <p>{{ $errors->first('birthday') }}</p>
                            </div>
                            <div class="form-group error-form">
                                <div class="input-icon @if($errors->has('role')) error-input @endif">
                                    {{ Form::label('role', __('titles.you_are'), ['id' => 'label-role']) }}
                                    {{ Form::select('role', \App\Models\User::$roles, null, ['class' => 'form-control', 'id' => 'role', 'name' => 'role', 'placeholder' => __('titles.teacher_student')]) }}
                                </div>
                            <p>{{ $errors->first('role') }}</p>
                            </div>
                            <div class="checkbox">
                                {{ Form::checkbox('agree', null, false, ['id' => 'agree', 'onclick' => 'statusCheckboxAgree()', 'style' => 'float: left']) }}
                                {{ Form::label('agree', __('titles.agree_terms')) }}
                            </div>
                            {{ Form::submit(__('titles.register'), ['class' => 'btn btn-common log-btn', 'id' => 'submit', 'disabled' => 'true']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('inline_scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#name').focus(function() {
                $('#name').parent().removeAttr('style');
                $('#name').parent().next().remove();
            });
            $('#email').focus(function() {
                $('#email').parent().removeAttr('style');
                $('#email').parent().next().remove();
            });
            $('#password').focus(function() {
                $('#password').parent().removeAttr('style');
                $('#password').parent().next().remove();
            });
            $('#password-confirmation').focus(function() {
                $('#password-confirmation').parent().removeAttr('style');
                $('#password-confirmation').parent().next().remove();
            });
            $('#phone').focus(function() {
                $('#phone').parent().removeAttr('style');
                $('#phone').parent().next().remove();
            });
            $('#role').focus(function() {
                $('#role').parent().removeAttr('style');
                $('#role').parent().next().remove();
            });
        });
        function statusCheckboxAgree() {
            if ($('#agree').is(':checked')) {
                $('#submit').removeAttr('disabled');
            } else {
                $('#submit').attr('disabled', true);
            }
        };
    </script>
@endsection