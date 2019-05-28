@extends('admin.layouts.default')

@section('title')
    {{ __('titles.all_bills') }}
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
                <h2 class="header-title">{{ __('titles.all_bills') }}</h2>
                <div class="header-sub-title">
                    <nav class="breadcrumb breadcrumb-dash">
                        <a href="#" class="breadcrumb-item"><i
                                    class="ti-home p-r-5"></i>{{ __('titles.r2s_dashboard') }}</a>
                        <a class="breadcrumb-item" href="#">{{ __('titles.bills') }}</a>
                        <span class="breadcrumb-item active">{{ __('titles.all_bills') }}</span>
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
                                <th>Customer Name</th>
                                <th>Status</th>
                                <th>Courses Code</th>
                                <th>Last Transaction</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($billsList as $bill)
                                <tr>
                                    <td><a href="{{ route('admin.bills.show', $bill->id) }}"> #{{ $bill->id }} </a></td>
                                    <td> {{ $bill->customer_name }} </td>
                                    <td id="bill-status-{{ $bill->id }}">
                                        @if($bill->status === 0)
                                            <span class="badge badge-pill badge-gradient-warning">{{ \App\Models\Bill::$status[$bill->status] }}</span>
                                    </td>
                                    @elseif($bill->status === 1)
                                        <span class="badge badge-pill badge-gradient-info">{{ \App\Models\Bill::$status[$bill->status] }}</span></td>
                                    @elseif($bill->status === 2)
                                        <span class="badge badge-pill badge-gradient-primary">{{ \App\Models\Bill::$status[$bill->status] }}</span></td>
                                    @elseif($bill->status === 3)
                                        <span class="badge badge-pill badge-gradient-success">{{ \App\Models\Bill::$status[$bill->status] }}</span></td>
                                    @elseif($bill->status === 4)
                                        <span class="badge badge-pill badge-gradient-danger">{{ \App\Models\Bill::$status[$bill->status] }}</span></td>
                                    @endif
                                    <td>
                                        @foreach(\App\Models\BillCourse::where('bill_id', $bill->id)->get() as $billCourse)
                                            <a href="{{ route('admin.courses.show', $billCourse->course_id) }}">{{ $billCourse->course_id }}</a>@if(!$loop->last)
                                                , @endif
                                        @endforeach
                                    </td>
                                    <td> {{ $bill->updated_at }} </td>
                                    <td> ${{ $bill->total_amount }}</td>
                                    <td class="text-center font-size-18">
                                        <a href="#" class="text-gray m-r-15 edit-status" data-id="{{ $bill->id }}"
                                           data-status="{{ $bill->status }}"><i class="ti-exchange-vertical"></i></a>
                                        {{--                                        <a href="{{ route('admin.bills.show', $bill->id) }}" class="text-gray m-r-15"><i class="ti-info"></i></a>--}}
                                        {{--<a href="#" class="text-gray"><i class="ti-trash"></i></a>--}}
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
            var billId;
            $('.edit-status').on('click', function (event) {
                event.preventDefault();
                $('#edit-status-modal').modal('show');
                billId = $(this).data('id');

                $('#change-status-select').val($(this).data('status'))
            })

            $('#update-status').click(function (event) {
                event.preventDefault();

                var statusId = $('#change-status-select').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '/admin/bills/status/update',
                    data: {
                        billId: billId,
                        statusId: statusId,
                    },
                    success: function () {
                        $('#edit-status-modal').modal('hide');
                        var statusBillElement = $('#bill-status-' + billId).children();
                        statusBillElement.removeClass();
                        switch (statusId) {
                            case '0': {
                                statusBillElement.addClass('badge badge-pill badge-gradient-warning');
                                statusBillElement.html('Pending');
                                break;
                            }
                            case '1': {
                                statusBillElement.addClass('badge badge-pill badge-gradient-info');
                                statusBillElement.html('Transporting');
                                break;
                            }
                            case '2': {
                                statusBillElement.addClass('badge badge-pill badge-gradient-primary');
                                statusBillElement.html('Already Paid');
                                break;
                            }
                            case '3': {
                                statusBillElement.addClass('badge badge-pill badge-gradient-success');
                                statusBillElement.html('Activated');
                                break;
                            }
                            case '4': {
                                statusBillElement.addClass('badge badge-pill badge-gradient-danger');
                                statusBillElement.html('Canceled');
                                break;
                            }
                        }
                        $.notify({
                            // options
                            message: ' {{ __('messages.update_bill_status_success') }} '
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
            });
        })
    </script>
@endsection