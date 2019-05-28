@extends('user.layouts.default')

@section('title')
    {{ $selectedUser->name . ' - ' . __('titles.profile_info') }}
@endsection

@section('inline_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/custom/users_show.css') }}">
    <style>
        .btn-file {
            position: relative;
            overflow: hidden;
            background-color: #3498db;
        }

        .btn-file:hover {
            background: #48acef;
        }

        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            /*background: white;*/
            cursor: inherit;
            display: block;
        }

        #current-img, #img-upload {
            width: 50px;
            height: 50px;
            margin-left: 20px;
        }
    </style>
@endsection

@section('content')
    {{ Breadcrumbs::render('users_show', $selectedUser) }} <br>
    <div id="content">
        <div class="container">
            <div class="row">
                @include('user.partials.user_management_info')
                <div class="col-sm-9 page-content">
                    <div class="inner-box">
                        <div class="usearadmin">
                            <h3><img class="userimg"
                                     src="{{ str_replace(' ', '', str_replace('public/', '', asset($selectedUser->avatar))) }}"
                                     alt="">{{ $selectedUser->name }}</h3>
                        </div>
                    </div>
                    @include('flash::message')
                    <div class="inner-box">
                        <div class="welcome-msg">
                            <h3 class="page-sub-header2 clearfix no-padding">{{ strtoupper(__('titles.slogan_p1')) }}
                                <span>{{ __('titles.slogan_p2') }} </span> {{ $selectedUser->name }}</h3>
                            {{-- <span class="page-sub-header-sub small">{{ __('titles.last_login') . $diffTime }}</span> --}}
                        </div>
                        <div id="accordion" class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="#collapseB1"
                                                               data-toggle="collapse"> {{ __('titles.profile_info') }} </a>
                                    </h4>
                                </div>
                                <div class="panel-collapse collapse in" id="collapseB1">
                                    <div class="panel-body">
                                        @if (empty($errors))
                                            <p class="error-input-p-p"> {{ __('titles.update_info_fail') }} </p>
                                        @endif
                                        {{ Form::model($selectedUser, ['route' => ['users.update', $selectedUser->id], 'enctype' => 'multipart/form-data']) }}
                                        {{ Form::hidden('role', $selectedUser->role) }}
                                        <input name="_method" type="hidden" value="PUT">
                                        <div class="form-group">
                                            {{ Form::label('name', __('titles.name') . ' *', ['class' => 'control-label']) }}
                                            <div @if ($errors->has('name')) class="error-input" @endif>
                                                {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) }}
                                            </div>
                                            <p class="error-input-p"> {{ $errors->first('name')}} </p>
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('email', __('titles.email'), ['class' => 'control-label']) }}
                                            {{ Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'readonly']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('address', __('titles.address') . ' *', ['class' => 'control-label']) }}
                                            {{ Form::text('address', null, ['class' => 'form-control', 'id' => 'address', 'readonly']) }}
                                            <div class="form-inline">
                                                {{ Form::select('province', $selectProvince, null, ['class' => 'form-control', 'id' => 'province', 'placeholder' => __('titles.choose_province')]) }}
                                                {{ Form::select('district', [], null, ['class' => 'form-control', 'id' => 'district', 'placeholder' => __('titles.choose_district')]) }}
                                                {{ Form::select('commune', [], null, ['class' => 'form-control', 'id' => 'commune', 'placeholder' => __('titles.choose_commune')]) }}
                                            </div>
                                            <p class="error-input-p"> {{ $errors->first('address')}} </p>
                                        </div>
                                        {{--                                        <div class="form-group">--}}
                                        {{--                                            {{ Form::label('avatar', __('titles.update_avatar'), ['class' => 'control-label']) }}--}}
                                        {{--                                            <br>--}}
                                        {{--                                            {{ Form::file('avatar', ['id' => 'avatar', 'onchange' => 'readURL(this)']) }}--}}
                                        {{--                                            <input type="file" id="avatar" class="form-control" name="pic" accept="image/*">--}}
                                        {{--                                            <input type="button" value="{{ __('titles.upload_avatar') }}"--}}
                                        {{--                                                   onclick="document.getElementById('avatar').click();"/>--}}
                                        {{--                                            <input type="button" id="cancel" value="{{ __('titles.cancel_avatar') }}"--}}
                                        {{--                                                   onclick="backAvatar()" hidden=""/>--}}
                                        {{--                                            <input type="text" id="cancel-value" name="cancel_value" hidden=""--}}
                                        {{--                                                   value="cancel" disabled=""/>--}}
                                        {{--                                            <input type="button" id="delete" name="delete"--}}
                                        {{--                                                   value="{{ __('titles.delete_avatar') }}" onclick="deleteAvatar()"/>--}}
                                        {{--                                            <input type="text" id="delete-value" name="delete_value" hidden=""--}}
                                        {{--                                                   value="delete" disabled=""/>--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <img class="userimg" id="current-avatar"--}}
                                        {{--                                             src="{{ str_replace('public/', '', asset($selectedUser->avatar)) }}">--}}
                                        {{--                                        <br>--}}
                                        {{--                                        <br>--}}
                                        <div class="form-group">
                                            <label>Upload Image</label>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <span class="btn btn-default btn-file upload-avatar-btn">
                                                        Browse… <input type="file" id="imgInp" name="avatar">
                                                    </span>
                                                </span>
                                                <input type="text" class="form-control" readonly>
                                            </div>
                                            Current Image
                                            <img id='current-img'
                                                 src="{{ str_replace('public', '', asset($selectedUser->avatar)) }}"/>
                                            &emsp;&emsp;New Image
                                            <img id='img-upload'/>
                                            &emsp;&emsp;<button class="btn btn-default btn-file" id="button-redo-avatar" style="display: none">Redo Avatar</button>
                                            <button class="btn btn-default btn-file"id="button-delete-avatar">Delete Avatar</button>
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('personal_info', __('titles.detail'), ['class' => 'control-label']) }}
                                            {{ Form::textarea('personal_info', null, ['class' => 'form-control', 'id' => 'personal-info', 'rows' => 5, 'cols' => 30]) }}
                                        </div>
                                        @if ($selectedUser->role == 1)
                                            <div class="form-group">
                                                {{ Form::label('working_place' . ' *', __('titles.working_place'), ['class' => 'control-label']) }}
                                                <div @if ($errors->has('working_place')) class="error-input" @endif>
                                                    {{ Form::text('working_place', null, ['class' => 'form-control', 'id' => 'working_place', 'readonly' => '']) }}
                                                </div>
                                                <div class="form-inline">
                                                    {{ Form::select('province', $selectProvince, null, ['class' => 'form-control', 'id' => 'province', 'placeholder' => __('titles.choose_province')]) }}
                                                    {{ Form::select('district', [], null, ['class' => 'form-control', 'id' => 'district', 'placeholder' => __('titles.choose_district')]) }}
                                                    {{ Form::select('commune', [], null, ['class' => 'form-control', 'id' => 'commune', 'placeholder' => __('titles.choose_commune')]) }}
                                                </div>
                                                <p class="error-input-p"> {{ $errors->first('working_place')}} </p>
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            {{ Form::label('grade', __('titles.grade'), ['class' => 'control-label']) }}
                                            <div @if ($errors->has('grade')) class="error-input" @endif>
                                                {{ Form::text('grade', null, ['class' => 'form-control', 'id' => 'grade', 'readonly' => '']) }}
                                            </div>
                                            {{ Form::select('grade', \App\Models\User::$grades, null, ['class' => 'form-control fix-select', 'id' => 'select-grade', 'placeholder' => __('titles.choose_grade')]) }}
                                            <p class="error-input-p"> {{ $errors->first('grade')}} </p>
                                        </div>
                                        {{ Form::submit(__('titles.update'), ['class' => 'btn btn-common submit', 'name' => 'update_info']) }}
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a aria-expanded="false" class="collapsed"
                                                               href="#collapseB2"
                                                               data-toggle="collapse"> {{ __('titles.change_password') }} </a>
                                    </h4>
                                </div>
                                <div aria-expanded="false" class="panel-collapse collapse" id="collapseB2">
                                    <div class="panel-body">
                                        @if (empty($errors))
                                            <p class="error-input-p"> __('titles.update_info_fail') </p>
                                        @endif
                                        {{ Form::model($selectedUser, ['route' => ['users.update', $selectedUser->id]]) }}
                                        <input name="_method" type="hidden" value="PUT">
                                        <div class="form-group">
                                            {{ Form::label('old_password', __('titles.old_password'), ['class' => 'control-label']) }}
                                            <div @if ($errors->has('old_password')) class="error-input" @endif>
                                                {{ Form::password('old_password', ['class' => 'form-control', 'id' => 'old-password']) }}
                                            </div>
                                            <p class="error-input-p"> {{ $errors->first('old_password')}} </p>
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('new_password', __('titles.new_password'), ['class' => 'control-label']) }}
                                            <div @if ($errors->has('new_password')) class="error-input" @endif>
                                                {{ Form::password('new_password', ['class' => 'form-control', 'id' => 'new-password']) }}
                                            </div>
                                            <p class="error-input-p"> {{ $errors->first('new_password')}} </p>
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('password_confirmation', __('titles.retype_new_password'), ['class' => 'control-label']) }}
                                            <div>
                                                {{ Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password-confirmation']) }}
                                            </div>
                                            <p class="error-input-p"> {{ $errors->first('password_confirmation')}} </p>
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
        $(document).ready(function () {
            $('#name').focus(function () {
                $('#name').parent().removeClass('error-input');
                $('#name').parent().next().remove();
            });
            $('#province').focus(function () {
                $('#working_place').parent().removeClass('error-input');
                $('#working_place').parent().next().next().remove();
            });
            $('#select-grade').focus(function () {
                $('#grade').parent().removeClass('error-input');
                $('#grade').parent().next().next().remove();
            });
            $('#old-password').focus(function () {
                $('#old-password').parent().removeClass('error-input');
                $('#old-password').parent().next().remove();
            });
            $('#new-password').focus(function () {
                $('#new-password').parent().removeClass('error-input');
                $('#new-password').parent().next().remove();
            });
            $('#password-confirmation').focus(function () {
                $('#password-confirmation').parent().removeClass('error-input');
                $('#password-confirmation').parent().next().remove();
            });
            $('#personal-page').addClass('active');
        });

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
            $('#current-avatar').attr('src', '{{ str_replace('public/', '', asset('assets/img/basic_avatar.png')) }}');
            $('#cancel').fadeIn(1000);
            $('#cancel-value').attr('disabled', '');
            $('#delete-value').removeAttr('disabled');
        }

        $('select#province').change(function () {
            var provinceId = $(this).val();
            $('#district').children().fadeOut();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post(
                "/districts",
                {provinceId: provinceId},
                function (result) {
                    $.each(result, function (index, element) {
                        $("select#district").append('<option value="' + element.id + '">' + element.name + '</option>');
                    });
                },
                "json",
            );
        });
        $('select#district').change(function () {
            var districtId = $(this).val();
            $('#commune').children().fadeOut();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post(
                "/communes",
                {districtId: districtId},
                function (result) {
                    $.each(result, function (index, element) {
                        $("select#commune").append('<option value="' + element.id + '">' + element.name + '</option>');
                    });
                },
                "json",
            );
        });
        $('select#commune').change(function () {
            var province = $('#province option:selected').text();
            var district = $('#district option:selected').text();
            var commune = $('#commune option:selected').text();
            var address = province + ' province, ' + district + ' district, ' + commune + ' commune.';
            $('#address').val(address);
        });
        $('select#select-grade').change(function () {
            $('#grade').val($('#select-grade option:selected').text());
        });

        $(document).on('change', '#upload-avatar-btn :file', function () {
            var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
        });

        $('#upload-avatar-btn :file').on('fileselect', function (event, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = label;

            if (input.length) {
                input.val(log);
            } else {
                if (log) alert(log);
            }
        });

        $('#button-redo-avatar').on('click', function (e) {
            e.preventDefault();
            {{--var userAvatar = '{{ $selectedUser->avatar }}';--}}
            {{--userAvatar = userAvatar.replace(--}}
            {{--    "images/",--}}
            {{--    "http://127.0.0.1:8000/images/"--}}
            {{--);--}}
            $('#img-upload').attr('src', '');
            $('#button-redo-avatar').fadeOut(300);
        })

        $('#button-delete-avatar').on('click', function (e) {
            e.preventDefault();
            $('#img-upload').attr('src', 'http://127.0.0.1:8000/images/default_avatar/default_avatar.jpg');
            $('#button-delete-avatar').fadeOut(300);
        })

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
            $('#button-redo-avatar').fadeIn(300);
        }

        $("#imgInp").change(function () {
            readURL(this);
        });
    </script>
@endsection
