@extends('admin.layouts.default')

@section('title')
    {{ __('titles.permission_management') }}
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
                <h2 class="header-title">{{ __('titles.permission_management') }}</h2>
                <div class="header-sub-title">
                    <nav class="breadcrumb breadcrumb-dash">
                        <a href="{{ route('admin.dashboard') }}" class="breadcrumb-item"><i class="ti-home p-r-5"></i>Home</a>
                        <span class="breadcrumb-item active">Permission Management</span>
                    </nav>
                </div>
            </div>
            <div class="card" id="card-select-user">
                <div class="card-header border bottom">
                    <h4 class="card-title">Select User</h4>
                </div>
                <div class="card-body">
                    <p style="color: red; display: none" id="error-submit"> Please select an user before submit ! </p>
                    <div class="row m-t-25">
                        <div class="col-md-4">
                            <h5>Select User Group</h5>
                            <div class="m-t-15">
                                <div class="row">
                                    <div class="col-md-10">
                                        <select id="selectize-dropdown">
                                            <option value="" disabled selected>Select a group...</option>
                                            @foreach($userGroupList as $key => $value)
                                                <option value="{{ $key }}" {{ (array_key_exists('permissionGroup', $dataParamList) && $dataParamList['permissionGroup'] == $key) ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Select User By Email</h5>
                            <div class="m-t-15">
                                <div class="row">
                                    <div class="col-md-10">
                                        <select id="selectize-dropdown-2">
                                            <option value="" disabled selected>Select a email...</option>
                                            @foreach($emailUserList as $key => $value)
                                                <option value="{{ $key }}" {{ (array_key_exists('userKey', $dataParamList) && $dataParamList['userKey'] == $key) ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Select User By Name</h5>
                            <div class="m-t-15">
                                <div class="row">
                                    <div class="col-md-10">
                                        <select id="selectize-group">
                                            <option value="">Select user name...</option>
                                            @if(!array_key_exists('permissionGroup', $dataParamList) || (array_key_exists('permissionGroup', $dataParamList) && $dataParamList['permissionGroup'] == 2))
                                                <optgroup label="Student" id="opt-student">
                                                    @foreach($studentList as $student)
                                                        <option value="{{ $student->id }}"
                                                                {{ (array_key_exists('userKey', $dataParamList) && $dataParamList['userKey'] == $student->id) ? 'selected' : '' }} id="student-{{ $student->id }}">{{ $student->name }}</option>
                                                    @endforeach
                                                </optgroup>
                                            @endif
                                            @if(!array_key_exists('permissionGroup', $dataParamList) || (array_key_exists('permissionGroup', $dataParamList) && $dataParamList['permissionGroup'] == 1))
                                                <optgroup label="Instructor" id="opt-instructor">
                                                    @foreach($instructorList as $instructor)
                                                        <option value="{{ $instructor->id }}" {{ (array_key_exists('userKey', $dataParamList) && $dataParamList['userKey'] == $instructor->id) ? 'selected' : '' }}>{{ $instructor->name }}</option>
                                                    @endforeach
                                                </optgroup>
                                            @endif
                                            @if(!array_key_exists('permissionGroup', $dataParamList) || (array_key_exists('permissionGroup', $dataParamList) && $dataParamList['permissionGroup'] == 0))
                                                <optgroup label="Admin" id="opt-admin">
                                                    @foreach($adminList as $admin)
                                                        <option value="{{ $admin->id }}" {{ (array_key_exists('userKey', $dataParamList) && $dataParamList['userKey'] == $admin->id) ? 'selected' : '' }}>{{ $admin->name }}</option>
                                                    @endforeach
                                                </optgroup>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-t-25">
                        <div class="col-md-4"></div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="m-t-15">
                                <div class="col-md-6" style="float: right;">
                                    <button class="btn btn-default" id="btn-reset" style="display: inline">Reset
                                    </button>
                                </div>
                                <div class="col-md-6" style="float: right">
                                    <button class="btn btn-info" id="btn-get-permission" style="display: inline;">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" id="card-user-info" style="display: none">
                <div class="card-header border bottom">
                    <h4 class="card-title" id="card-title-user-info"></h4>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <img class="img-fluid" id="user-avatar" src="" alt=""
                             style="padding-top: 30px; padding-left: 15px">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10 ml-auto mr-auto">
                                    <div class="m-t-30">
                                        <h4 class="card-title" id="user-name">Card Horizon</h4>
                                        <p id="user-email">Put toy mouse in food bowl run out of litter box at full
                                            speed drool but pee in the shoe purr when being pet but chew foot.</p>
                                        <div class="m-t-25">
                                            <a href="#" class="btn btn-default btn-info" id="edit-permission-button">Edit
                                                Permission</a>
                                            <a href="#" class="btn btn-default btn-warning"
                                               id="select-another-user-button">Select another user</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('admin.permissions.partials.permission_list')
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3"></div>
            <div class="col-md-3"></div>
            <div class="col-md-3" style="display: none;float: right" id="permission-control">
                <button class="btn btn-info" id="btn-update-permission">
                    Submit
                </button>
                <button class="btn btn-warning" id="btn-reset-permission">Reset
                </button>
            </div>

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
            // $('#error-submit').hide();
            $('#btn-reset').on('click', function (event) {
                event.preventDefault();
                var selectUserGroup = $('#selectize-dropdown').selectize();
                var controlUserGroup = selectUserGroup[0].selectize;
                controlUserGroup.clear();
                var selectUserEmail = $('#selectize-dropdown-2').selectize();
                var controlUserEmail = selectUserEmail[0].selectize;
                controlUserEmail.clear();
                var selectUserName = $('#selectize-group').selectize();
                var controlUserName = selectUserName[0].selectize;
                controlUserName.clear();
                window.location.replace('/admin/permissions');
            })

            // Change select box follow user group
            $('#selectize-dropdown').on('change', function (event) {
                event.preventDefault();
                var groupKey = $(this).val();
                if (groupKey == 0) {
                    // Admin group
                    window.location.replace('/admin/permissions?permissionGroup=0');

                } else if (groupKey == 1) {
                    // Instructor group
                    window.location.replace('/admin/permissions?permissionGroup=1');
                } else if (groupKey == 2) {
                    // Student group
                    window.location.replace('/admin/permissions?permissionGroup=2');
                }
            })

            // Change select box follow user email or name
            $('#selectize-dropdown-2, #selectize-group').on('change', function (event) {
                event.preventDefault();
                var userKey = $(this).val();
                window.location.replace('/admin/permissions?userKey=' + userKey);
            })

            var selectedUserId = 0;
            var userPermissionList = [];
            // Get permission
            $('#btn-get-permission').on('click', function (event) {
                event.preventDefault();
                var userId = $('#selectize-group').val();
                if (userId == '') {
                    $('#error-submit').show();
                } else {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '/admin/permissions/getPermission/' + userId,
                        type: 'post',
                        success: function (response) {
                            var responseData = jQuery.parseJSON(response);
                            var permissionList = responseData.permissionList;
                            userPermissionList = permissionList;
                            var selectedUser = responseData.selectedUser;
                            permissionList.forEach(function (element) {
                                $('#switch-' + element).attr('checked', '');
                            });
                            $.notify({
                                // options
                                message: 'Get available permission for user ' + selectedUser.name + ' successfully.',
                            }, {
                                // settings
                                type: 'info',
                                placement: {
                                    from: "bottom",
                                    align: "right"
                                },
                                delay: 2000,
                            });
                            $('#user-name').text(selectedUser.name);
                            $('#user-email').text(selectedUser.email);

                            var userAvatar = selectedUser.avatar;
                            if(userAvatar.includes("public")) {
                                userAvatar = userAvatar.replace(
                                    "public/images/",
                                    "http://127.0.0.1:8000/images/"
                                );
                            } else {
                                userAvatar = userAvatar.replace(
                                    "images/",
                                    "http://127.0.0.1:8000/images/"
                                );
                            }
                            $('#user-avatar').attr('src', userAvatar);
                            $('#card-title-user-info').text('User ' + selectedUser.name + ' \'s permission');
                            selectedUserId = selectedUser.id;
                            $('#card-user-info').show();
                            if (responseData.allowUpdate == 0) {
                                $('#edit-permission-button').hide();
                            }
                            $('#card-select-user').hide();
                        }
                    })
                }
            })

            $('#edit-permission-button').on('click', function (event) {
                event.preventDefault();
                $('#permission-control').show();
                $('.permission-checkbox').removeAttr('disabled');
                $.notify({
                    // options
                    message: 'Active edit permission successfully.',
                }, {
                    // settings
                    type: 'info',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    delay: 2000,
                });
                $(this).fadeOut(300);
            })

            $('#btn-reset-permission').on('click', function (event) {
                event.preventDefault();
                $('.permission-checkbox').prop("checked", false);
                userPermissionList.forEach(function (element) {
                    $('#switch-' + element).prop("checked", true);
                });
            })

            $('#btn-update-permission').on('click', function (event) {
                event.preventDefault();
                var checkedPermissionList = [];
                $('.permission-checkbox').each(function () {
                    var permissionIdTemp = $(this).attr('id').replace('switch-', '')
                    if ($('#' + $(this).attr('id')).prop('checked')) {
                        checkedPermissionList.push(permissionIdTemp);
                    }
                })

                $.ajax({
                    url: '/admin/permissions/updatePermission/' + selectedUserId,
                    type: 'post',
                    data: {
                        checkedPermissionList: checkedPermissionList
                    },
                    success: function (response) {
                        $('#permission-control').fadeOut(300);

                        // response is array list of permission
                        var responseData = jQuery.parseJSON(response);

                        $.notify({
                            // options
                            message: 'Get available permission for user ' + $('#user-name').text() + ' successfully.',
                        }, {
                            // settings
                            type: 'info',
                            placement: {
                                from: "bottom",
                                align: "right"
                            },
                            delay: 2000,
                        });
                        $('.permission-checkbox').attr('disabled', '');
                        $('#edit-permission-button').fadeIn(300);
                        $('.permission-checkbox').prop("checked", false);
                        if (responseData != 200) {
                            responseData.forEach(function (element) {
                                $('#switch-' + element).prop("checked", true);
                            });
                        }
                    }
                })
            })

            $('#select-another-user-button').on('click', function (event) {
                event.preventDefault();
                window.location.replace('/admin/permissions');
            })
        })
    </script>
@endsection