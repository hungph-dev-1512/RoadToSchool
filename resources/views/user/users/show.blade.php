@extends('user.layouts.default')

@section('title')
    {{ $selectedUser->name . ' - ' . __('titles.profile_info') }}
@endsection

@section('inline_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/custom/users_show.css') }}">
@endsection

@section('content')
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 page-sideabr">
                    <aside>
                        <div class="inner-box">
                            <div class="user-panel-sidebar">
                                <div class="collapse-box">
                                    <h5 class="collapset-title no-border"> {{ __('titles.profile_info') }} <a aria-expanded="true" class="pull-right" data-toggle="collapse" href="#myclassified"><i class="fa fa-angle-down"></i></a></h5>
                                    <div aria-expanded="true" id="myclassified" class="panel-collapse collapse in">
                                        <ul class="acc-list">
                                            <li class="active">
                                                <a href="{{ route('home') }}"><i class="fa fa-home"></i> {{ __('titles.home') }} </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="collapse-box">
                                    <h5 class="collapset-title"> {{ __('titles.course') }} <a aria-expanded="true" class="pull-right" data-toggle="collapse" href=""><i class="fa fa-angle-down"></i> </a></h5>
                                    <div aria-expanded="true" id="myads" class="panel-collapse collapse in">
                                        <ul class="acc-list">
                                            <li>
                                                <a href="account-myads.html"><i class="fa fa-credit-card"></i>&ensp;&ensp; {{ __('titles.my_course') }} <span class="badge"></span></a>
                                            </li>
                                            <li>
                                                <a href="account-favourite-ads.html"><i class="fa fa-heart-o"></i>&ensp;&ensp; {{ __('titles.favourite_course') }} <span class="badge"></span></a>
                                            </li>
                                            <li>
                                                <a href="account-saved-search.html"><i class="fa fa-star-o"></i>&ensp;&ensp; {{ __('titles.saved_course') }} <span class="badge"></span></a>
                                            </li>
                                            <li>
                                                <a href="account-archived-ads.html"><i class="fa fa-folder-o"></i>&ensp;&ensp; {{ __('titles.uploaded_file') }} <span class="badge"></span></a>
                                            </li>
                                            {{-- <li>
                                                <a href="{{ route('users.notifications', $selectedUser->id) }}"><i class="fa fa-hourglass-o"></i>&ensp;&ensp; {{ __('titles.notification') }} <span class="badge"> {{ ($countUnreadNotifications != 0) ? $countUnreadNotifications : '' }} </span></a>
                                            </li> --}}
                                        </ul>
                                    </div>
                                </div>
                                <div class="collapse-box">
                                    <h5 class="collapset-title"> {{ __('titles.terminate_account') }} <a aria-expanded="true" class="pull-right" data-toggle="collapse" href="#close"><i class="fa fa-angle-down"></i></a></h5>
                                    <div aria-expanded="true" id="close" class="panel-collapse collapse in">
                                        <ul class="acc-list">
                                            <li>
                                                <a href="account-close.html"><i class="fa fa-close"></i> {{ __('titles.close_account') }} </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="inner-box">
                            <div class="widget-title">
                                <h4>Advertisement</h4>
                            </div>
                            <img src="/assets/img/img1.jpg" alt="">
                        </div>
                    </aside>
                </div>
                <div class="col-sm-9 page-content">
                    <div class="inner-box">
                        <div class="usearadmin">
                            <h3><img class="userimg" src="{{ str_replace('public/', '', asset($selectedUser->avatar)) }}" alt="">{{ $selectedUser->name }}</h3>
                        </div>
                    </div>
                    @include('flash::message')
                    <div class="inner-box">
                        <div class="welcome-msg">
                            <h3 class="page-sub-header2 clearfix no-padding">{{ strtoupper(__('titles.slogan_p1')) }} <span>{{ __('titles.slogan_p2') }} </span> {{ $selectedUser->name }}</h3>
                            {{-- <span class="page-sub-header-sub small">{{ __('titles.last_login') . $diffTime }}</span> --}}
                        </div>
                        <div id="accordion" class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> <a href="#collapseB1" data-toggle="collapse"> {{ __('titles.profile_info') }} </a> </h4>
                                </div>
                                <div class="panel-collapse collapse in" id="collapseB1">
                                    <div class="panel-body">
                                        @if (empty($errors))
                                            <p> {{ __('titles.update_info_fail') }} </p>
                                        @endif
                                        {{ Form::model($selectedUser, ['route' => ['users.update', $selectedUser->id]]) }}
                                            {{ Form::hidden('role', $selectedUser->role) }}
                                            <input name="_method" type="hidden" value="PUT">
                                            <div class="form-group">
                                                {{ Form::label('name', __('titles.name'), ['class' => 'control-label']) }}
                                                <div @if ($errors->has('name')) class="error-input" @endif>
                                                    {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) }}
                                                </div>
                                                <p> {{ $errors->first('name')}} </p>
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('email', __('titles.email'), ['class' => 'control-label']) }}
                                                {{ Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'readonly']) }}
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('address', __('titles.address'), ['class' => 'control-label']) }}
                                                {{ Form::text('address', null, ['class' => 'form-control', 'id' => 'address', 'readonly']) }}
                                                <div class="form-inline">
                                                    {{ Form::select('province', $selectProvince, null, ['class' => 'form-control', 'id' => 'province', 'placeholder' => __('titles.choose_province')]) }}
                                                    {{ Form::select('district', [], null, ['class' => 'form-control', 'id' => 'district', 'placeholder' => __('titles.choose_district')]) }}
                                                    {{ Form::select('commune', [], null, ['class' => 'form-control', 'id' => 'commune', 'placeholder' => __('titles.choose_commune')]) }}
                                                </div>
                                                <p> {{ $errors->first('address')}} </p>
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('avatar', __('titles.update_avatar'), ['class' => 'control-label']) }}
                                            <br>
                                                {{ Form::file('avatar', ['id' => 'avatar', 'onchange' => 'readURL(this)']) }}
                                                <input type="button" value="{{ __('titles.upload_avatar') }}" onclick="document.getElementById('avatar').click();" />
                                                <input type="button" id="cancel" value="{{ __('titles.cancel_avatar') }}" onclick="backAvatar()" hidden="" />
                                                <input type="text" id="cancel-value" name="cancel_value" hidden="" value="cancel" disabled=""/>
                                                <input type="button" id="delete" name="delete" value="{{ __('titles.delete_avatar') }}" onclick="deleteAvatar()"/>
                                                <input type="text" id="delete-value" name="delete_value" hidden="" value="delete" disabled=""/>
                                            </div>
                                            <img class="userimg" id="current-avatar" src="{{ str_replace('public/', '', asset($selectedUser->avatar)) }}">
                                            <br>
                                            <br>
                                            <div class="form-group">
                                                {{ Form::label('detail', __('titles.detail'), ['class' => 'control-label']) }}
                                                {{ Form::textarea('detail', null, ['class' => 'form-control', 'id' => 'detail', 'rows' => 5, 'cols' => 30]) }}
                                            </div>
                                            @if ($selectedUser->role == 1)
                                            <div class="form-group">
                                                {{ Form::label('working_place', __('titles.working_place'), ['class' => 'control-label']) }}
                                                <div @if ($errors->has('working_place')) class="error-input" @endif>
                                                    {{ Form::text('working_place', null, ['class' => 'form-control', 'id' => 'working_place', 'readonly' => '']) }}
                                                </div>
                                                <div class="form-inline">
                                                    {{ Form::select('province', $selectProvince, null, ['class' => 'form-control', 'id' => 'province', 'placeholder' => __('titles.choose_province')]) }}
                                                    {{ Form::select('district', [], null, ['class' => 'form-control', 'id' => 'district', 'placeholder' => __('titles.choose_district')]) }}
                                                    {{ Form::select('commune', [], null, ['class' => 'form-control', 'id' => 'commune', 'placeholder' => __('titles.choose_commune')]) }}
                                                </div>
                                                <p> {{ $errors->first('working_place')}} </p>
                                            </div>
                                            @endif
                                            <div class="form-group">
                                                {{ Form::label('grade', __('titles.grade'), ['class' => 'control-label']) }}
                                                <div @if ($errors->has('grade')) class="error-input" @endif>
                                                    {{ Form::text('grade', null, ['class' => 'form-control', 'id' => 'grade', 'readonly' => '']) }} 
                                                </div>
                                                {{ Form::select('grade', \App\Models\User::$grades, null, ['class' => 'form-control fix-select', 'id' => 'select-grade', 'placeholder' => __('titles.choose_grade')]) }}
                                                <p> {{ $errors->first('grade')}} </p>
                                            </div>
                                        {{ Form::submit(__('titles.update'), ['class' => 'btn btn-common submit', 'name' => 'update_info']) }}
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> <a aria-expanded="false" class="collapsed" href="#collapseB2" data-toggle="collapse"> {{ __('titles.change_password') }} </a> </h4>
                                </div>
                                <div aria-expanded="false" class="panel-collapse collapse" id="collapseB2">
                                    <div class="panel-body">
                                        @if (empty($errors))
                                            <p> __('titles.update_info_fail') </p>
                                        @endif
                                        {{ Form::model($selectedUser, ['route' => ['users.update', $selectedUser->id]]) }}
                                            <input name="_method" type="hidden" value="PUT">
                                            <div class="form-group">
                                                {{ Form::label('old_password', __('titles.old_password'), ['class' => 'control-label']) }}
                                                <div @if ($errors->has('old_password')) class="error-input" @endif>
                                                    {{ Form::password('old_password', ['class' => 'form-control', 'id' => 'old-password']) }}
                                                </div>
                                                <p> {{ $errors->first('old_password')}} </p>
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('new_password', __('titles.new_password'), ['class' => 'control-label']) }}
                                                <div @if ($errors->has('new_password')) class="error-input" @endif>
                                                    {{ Form::password('new_password', ['class' => 'form-control', 'id' => 'new-password']) }}
                                                </div>
                                                <p> {{ $errors->first('new_password')}} </p>
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('password_confirmation', __('titles.retype_new_password'), ['class' => 'control-label']) }}
                                                <div>
                                                    {{ Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password-confirmation']) }}
                                                </div>
                                                <p> {{ $errors->first('password_confirmation')}} </p>
                                            </div>
                                        {{ Form::submit(__('titles.update_password'), ['class' => 'btn btn-common submit', 'name' => 'update_password']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('inline_scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#name').focus(function() {
                $('#name').parent().removeClass('error-input');
                $('#name').parent().next().remove();
            })
            $('#province').focus(function() {
                $('#working_place').parent().removeClass('error-input');
                $('#working_place').parent().next().next().remove();
            })
            $('#select-grade').focus(function() {
                $('#grade').parent().removeClass('error-input');
                $('#grade').parent().next().next().remove();
            })
            $('#old-password').focus(function() {
                $('#old-password').parent().removeClass('error-input');
                $('#old-password').parent().next().remove();
            })
            $('#new-password').focus(function() {
                $('#new-password').parent().removeClass('error-input');
                $('#new-password').parent().next().remove();
            })
            $('#password-confirmation').focus(function() {
                $('#password-confirmation').parent().removeClass('error-input');
                $('#password-confirmation').parent().next().remove();
            })
        })

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#current-avatar').attr('src', e.target.result);
                    $('#cancel').fadeIn(1000);
                };
                reader.readAsDataURL(input.files[0]);
                $('#cancel-value').attr('disabled', '');
                $('#delete-value').attr('disabled', '');
            }
        }

        function backAvatar() {
            $('#current-avatar').attr('src', '{{ str_replace("public/", "", asset($selectedUser->avatar)) }}');
            $('#cancel-value').removeAttr('disabled');
            $('#delete-value').attr('disabled', '');
            $('#cancel').fadeOut(1000);
        }
        function deleteAvatar() {
            $('#current-avatar').attr('src', '{{ asset('assets/img/basic_avatar.png') }}');
            $('#cancel').fadeIn(1000);
            $('#cancel-value').attr('disabled', '');
            $('#delete-value').removeAttr('disabled');
        }
        $('select#province').change(function(){
            var provinceId = $(this).val();
            $('#district').children().fadeOut();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post(
                "/districts",
                { provinceId: provinceId },
                function(result) {
                    $.each(result, function (index, element) {
                        $("select#district").append('<option value="' + element.id + '">' + element.name + '</option>');
                    });
                },
                "json",
            );
        });
        $('select#district').change(function(){
            var districtId = $(this).val();
            $('#commune').children().fadeOut();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post(
                "/communes",
                { districtId: districtId },
                function(result) {
                    $.each(result, function (index, element) {
                        $("select#commune").append('<option value="' + element.id + '">' + element.name + '</option>');
                    });
                },
                "json",
            );
        });
        $('select#commune').change(function(){
            var province = $('#province option:selected').text();
            var district = $('#district option:selected').text();
            var commune = $('#commune option:selected').text();
            var address = province + ' province, ' + district + ' district, ' + commune + ' commune.';
            $('#address').val(address);
        });
        $('select#select-grade').change(function(){
            $('#grade').val($('#select-grade option:selected').text());
        });
    </script>
@endsection
