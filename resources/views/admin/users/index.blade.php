@extends('admin.layouts.default')

@section('title')
    {{ __('titles.all_users') }}
@endsection

@section('inline_styles')
    <link rel="stylesheet"
          href="{{ asset('assets/admin/vendor/datatables/media/css/dataTables.bootstrap4.min.css') }}"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css"/>
@endsection

@section('content')
    <div class="message-display">
        @include('flash::message')
    </div>
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-header">
                <h2 class="header-title">{{ __('titles.all_users') }}</h2>
                <div class="header-sub-title">
                    <nav class="breadcrumb breadcrumb-dash">
                        <a href="{{ route('admin.dashboard') }}" class="breadcrumb-item">
                            <i class="ti-home p-r-5"></i>{{ __('titles.r2s_dashboard') }}
                        </a>
                        <a class="breadcrumb-item active">{{ __('titles.users') }}</a>
                        <span class="breadcrumb-item active">{{ __('titles.all_users') }}</span>
                    </nav>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-overflow">
                        <table id="dt-opt" class="table table-hover table-xl">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{ __('titles.name') }}</th>
                                <th>{{ __('titles.email') }}</th>
                                <th>{{ __('titles.role') }}</th>
                                <th>{{ __('titles.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr id="user{{ $user->id }}">
                                    <td>{{ $user->id }}</td>
                                    <td><a href="{{ route('admin.users.show', $user->id) }}">
                                            {{ $user->name }}
                                        </a></td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->is_admin == 1)
                                            Admin
                                        @else
                                            @if($user->role === 1)
                                                Teacher
                                            @elseif ($user->role === 2)
                                                Student
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-center font-size-18">
                                        <a class="text-gray" data-toggle="modal"
                                           data-target="#detail-modal"
                                           data-url="{{ route('admin.users.show', $user->id) }}">
                                            <i class="ti-info"></i>
                                        </a>&ensp;
                                        <a class="text-gray edit-user" data-user="{{ $user }}" data-toggle="modal"
                                           data-target="#edit-modal">
                                            <i class="ti-pencil"></i>
                                        </a>&ensp;
                                        @if(Auth::user()->id !== $user->id)
                                            <a class="text-gray" data-toggle="modal"
                                               data-target="#delete-modal"
                                               data-url="{{ route('admin.users.destroy', $user->id) }}">
                                                <i class="ti-trash"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('admin.users.partials.edit_modal')
@include('admin.layouts.delete_modal')

@section('inline_scripts')
    <script src="{{ asset('assets/admin/vendor/datatables/media/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/datatables/media/js/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('assets/admin/js/tables/data-table.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.datepicker').datepicker();

            $('#edit-modal').on('show.bs.modal', function (e) {
                var url = $(e.relatedTarget).data('url');
                $('#form-edit').attr('action', url);
                var user = $(this).data('user')
            });

            $('.edit-user').on('click', function () {
                var user = $(this).data('user')
                $('#m-email').val(user.email);
                $('#m-name').val(user.name);
                $('#m-phone').val(user.phone);
                $('#m-birthday').val(user.birthday);
                $('#m-address').val(user.address);
                $('#m-personal-info').val(user.personal_info);
                $('#m-working-place').val(user.working_place);
                $('#m-grade').val(user.grade);
                $('#m-role').val(user.role);
            });

            $('#update-user-info').on('click', function () {
                var id = $(this).data('id');
                console.log(id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '/admin/users/' + id + '/updateUser',
                    data: {
                        id: id,
                        working_place: $('#m-working-place').val(),
                        phone: $('#m-phone').val(),
                        birthday: $('#m-birthday').val(),
                        address: $('#m-address').val(),
                    },
                    success: function (data) {
                        $('#edit-profile-modal').modal('hide');
                        $.notify({
                            // options
                            message: ' {{ __('update_user_success') }} '
                        }, {
                            // settings
                            type: 'success'
                        });
                        $('#working-place').next().text($('#m-working-place').val());
                        $('#phone').next().text($('#m-phone').val());
                        $('#birthday').next().text($('#m-birthday').val());
                        $('#address').next().text($('#m-address').val());
                        $('#m-email').val(data.email);
                        $('#m-name').val(data.name);
                        $('#m-working-place').val(data.working_place);
                        $('#m-phone').val(data.phone);
                        $('#m-birthday').val(data.birthday);
                        $('#m-address').val(data.address);
                        flag = 1;
                    },
                    error: function (response) {
                        errors = response.responseJSON.errors;
                        if (errors.working_place != null) {
                            $('#error-m-working-place').removeAttr('hidden');
                            $('#error-m-working-place').text(errors.working_place);
                            $('#m-working-place').addClass('error-input');
                        } else {
                            $('#error-m-working-place').attr('hidden', '');
                            $('#m-working-place').removeClass('error-input');
                        }
                        if (errors.phone != null) {
                            $('#error-m-phone').removeAttr('hidden');
                            $('#error-m-phone').text(errors.phone);
                            $('#m-phone').addClass('error-input');
                        } else {
                            $('#error-m-phone').attr('hidden', '');
                            $('#m-phone').removeClass('error-input');
                        }
                        if (errors.birthday != null) {
                            $('#error-m-birthday').removeAttr('hidden');
                            $('#error-m-birthday').text(errors.birthday);
                            $('#m-birthday').addClass('error-input');
                        } else {
                            $('#error-m-birthday').attr('hidden', '');
                            $('#m-birthday').removeClass('error-input');
                        }
                        if (errors.address != null) {
                            $('#error-m-address').removeAttr('hidden');
                            $('#error-m-working-place').text(errors.address);
                            $('#m-address').addClass('error-input');
                        } else {
                            $('#error-m-address').attr('hidden', '');
                            $('#m-address').removeClass('error-input');
                        }
                    }
                }, 'json');
            })

            $('#delete-modal').on('show.bs.modal', function (e) {
                var url = $(e.relatedTarget).data('url');
                $('#form-delete').attr('action', url);
            });

            $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
        })
    </script>
@endsection
