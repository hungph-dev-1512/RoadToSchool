@extends('admin.layouts.default')

@section('title')
    {{ __('titles.lecture_request_list') }}
@endsection

@section('inline_styles')
    <link rel="stylesheet"
          href="{{ asset('assets/admin/vendor/datatables/media/css/dataTables.bootstrap4.min.css') }}"/>
@endsection

@section('content')
    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-header">
                <h2 class="header-title">{{ __('titles.lecture_request_list') }}</h2>
                <div class="header-sub-title">
                    <nav class="breadcrumb breadcrumb-dash">
                        <a href="#" class="breadcrumb-item"><i
                                    class="ti-home p-r-5"></i>{{ __('titles.r2s_dashboard') }}</a>
                        <span class="breadcrumb-item active">{{ __('titles.lecture_request_list') }}</span>
                    </nav>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-overflow">
                        <table id="dt-opt" class="table table-hover table-xl">
                            <thead>
                            <tr>
                                <th>Course</th>
                                <th>Lecture Title</th>
                                <th>Type</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($requestLectureList as $lecture)
                                <tr id="tr-request-{{ $lecture->id }}">
                                    <td><a href="{{ route('courses.show', $lecture->course->id) }}">
                                            {{ $lecture->course->title }} </a></td>
                                    <td>
                                        <a href="{{ '/courses/' . $lecture->course->id . '/lectures/' . $lecture->id }}"> {{ $lecture->title }} </a>
                                    </td>
                                    <td>
                                        @if($lecture->is_lecture)
                                            <i>Lecture</i>
                                        @elseif($lecture->is_quiz)
                                            <i>Quiz</i>
                                        @endif
                                    </td>
                                    <td> {{ $lecture->updated_at }} </td>
                                    <td class="text-center font-size-18">
                                        <a href="#" data-lecture="{{ $lecture->id }}"
                                           class="text-gray m-r-15 accept-lecture-request"><i class="ti-check"></i></a>
                                        <a href="#" class="text-gray"><i class="ti-trash"></i></a>
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
    <!-- Content Wrapper END -->
@endsection

@include('admin.bills.partials.edit_status_modal')

@section('inline_scripts')
    <script src="{{ asset('assets/admin/vendor/datatables/media/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/datatables/media/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/tables/data-table.js') }}"></script>
    <script>
        $(document).ready(function () {
            {{--var billId;--}}
            {{--$('.edit-status').on('click', function (event) {--}}
            {{--    event.preventDefault();--}}
            {{--    $('#edit-status-modal').modal('show');--}}
            {{--    billId = $(this).data('id');--}}

            {{--    $('#change-status-select').val($(this).data('status'))--}}
            {{--})--}}

            $('.accept-lecture-request').click(function (event) {
                event.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '/admin/lectures/postAccept',
                    data: {
                        lectureId: $(this).data('lecture'),
                    },
                    success: function () {
                        // $('#edit-status-modal').modal('hide');
                        // var statusBillElement = $('#bill-status-' + billId).children();
                        // statusBillElement.removeClass();
                        // switch (statusId) {
                        //     case '0': {
                        //         statusBillElement.addClass('badge badge-pill badge-gradient-warning');
                        //         statusBillElement.html('Pending');
                        //         break;
                        //     }
                        //     case '1': {
                        //         statusBillElement.addClass('badge badge-pill badge-gradient-info');
                        //         statusBillElement.html('Transporting');
                        //         break;
                        //     }
                        //     case '2': {
                        //         statusBillElement.addClass('badge badge-pill badge-gradient-primary');
                        //         statusBillElement.html('Already Paid');
                        //         break;
                        //     }
                        //     case '3': {
                        //         statusBillElement.addClass('badge badge-pill badge-gradient-success');
                        //         statusBillElement.html('Activated');
                        //         break;
                        //     }
                        //     case '4': {
                        //         statusBillElement.addClass('badge badge-pill badge-gradient-danger');
                        //         statusBillElement.html('Canceled');
                        //         break;
                        //     }
                        // }
                        $.notify({
                            // options
                            message: ' {{ __('messages.this_lecture_is_accepted') }} '
                        }, {
                            // settings
                            type: 'success',
                            placement: {
                                from: "bottom",
                                align: "right"
                            },
                        });
                    }
                }, 'json');
                $('#tr-request-' + $(this).data('lecture')).fadeOut(300);
            });
        })
    </script>
@endsection