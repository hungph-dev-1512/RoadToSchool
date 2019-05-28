@extends('admin.layouts.default')

@section('title')
    {{ __('titles.bill_detail') . ' #' . $bill->id }}
@endsection

@section('inline_styles')
@endsection

@section('content')
    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="container">
                <div class="card">
                    <div class="p-v-5 p-h-10 border bottom print-invisible">
                        <ul class="list-unstyle list-inline text-right">
                            <li class="list-inline-item">
                                <a href="#" class="btn text-gray text-hover display-block p-10 m-b-0"
                                   onclick="window.print();">
                                    <i class="ti-printer text-info p-r-5"></i>
                                    <b>Print</b>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="text-gray text-hover display-block p-10 m-b-0">
                                    <i class="fa fa-file-pdf-o text-danger p-r-5"></i>
                                    <b>Export PDF</b>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <ul class="nav wizard wizard-gradient-info">
                            @foreach(\App\Models\Bill::$status as $key => $value)
                                <li class="nav-item">
                                    <a class="nav-link status-map @if($key < $bill->status) completed @elseif($key == $bill->status) active @endif"
                                       href="#" id="status-map-{{ $key }}"></a>
                                    <div class="nav-title">{{ $value }}</div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="p-h-30">
                            <div class="m-t-15">
                                <div class="inline-block">
                                    <img class="img-fluid" src="{{ asset('assets/admin/images/logo/logo.jpg') }}"
                                         alt="">
                                    <address class="p-l-10 m-t-20">
                                        <b class="text-dark">R2S Inc.</b><br>
                                        <span>1 Dai Co Viet Road</span><br>
                                        <span>Ha Noi, Viet Nam</span><br>
                                        <abbr class="text-dark" title="Phone">Phone:</abbr>
                                        <span>(+84) 965 818 552</span>
                                    </address>
                                </div>
                                <div class="pull-right">
                                    <h2>BILL DETAIL #{{ $bill->id }}</h2>
                                    <h3 id="bill-status">Bill
                                        Status: {{ \App\Models\Bill::$status[$bill->status] }}</h3>
                                    <a href="#" id="edit-status" data-id="{{ $bill->id }}"
                                       data-status="{{ $bill->status }}">Change Bill Status</a>
                                </div>
                            </div>
                            <div class="row m-t-20">
                                <div class="col-sm-9">
                                    <h3 class="p-l-10 m-t-10">Customer Infomation</h3>
                                    <address class="p-l-10 m-t-10">
                                        <b class="text-dark">Name: </b><span> {{ $bill->customer_name }} </span><br>
                                        <b class="text-dark">Phone: </b><span> {{ $bill->customer_phone }} </span><br>
                                        <b class="text-dark">Address: </b><span> {{ $bill->customer_address }} </span><br>
                                        <b class="text-dark">Note: </b><span> {{ $bill->customer_note ?? 'No note' }} </span><br>
                                    </address>
                                </div>
                                <div class="col-sm-3">
                                    <div class="m-t-80">
                                        <div class="text-dark text-uppercase d-inline-block"><b>Bill No :</b></div>
                                        <div class="pull-right">#{{ $bill->id }}</div>
                                    </div>
                                    <div class="text-dark text-uppercase d-inline-block"><b> {{ __('titles.date') }}
                                            :</b></div>
                                    <div class="pull-right">{{ $bill->created_at->toDateString() }}</div>
                                    <br>
                                    <div class="text-dark text-uppercase d-inline-block"><b> {{ __('titles.time') }}
                                            :</b></div>
                                    <div class="pull-right">{{ $bill->created_at->toTimeString() }}</div>
                                </div>
                            </div>
                            <div class="row m-t-20">
                                <div class="col-sm-12">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>Course ID</th>
                                            <th>Items</th>
                                            <th class="text-right">Price</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($billCourses as $billCourse)
                                            <tr>
                                                <td><a href="TODO"> #{{ $billCourse->course_id }} </a></td>
                                                <td>{{ App\Models\Course::findOrFail($billCourse->course_id)->title }}</td>
                                                <td class="text-right">${{ $billCourse->price }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="row m-t-30">
                                        <div class="col-sm-12">
                                            <div class="pull-right text-right">
                                                <p>Total amount: ${{ $bill->total_amount }}</p>
                                                <p>Discount : $0 </p>
                                                <hr>
                                                <h3><b>Total :</b> ${{ $bill->total_amount }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    {{--<div class="row m-t-30">--}}
                                    {{--<div class="col-sm-12">--}}
                                    {{--<div class="border top bottom p-v-20">--}}
                                    {{--<p class="text-opacity"><small>In exceptional circumstances, Financial Services can provide an urgent manually processed special cheque. Note, however, that urgent special cheques should be requested only on an emergency basis as manually produced cheques involve duplication of effort and considerable staff resources. Requests need to be supported by a letter explaining the circumstances to justify the special cheque payment.</small></p>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="row m-v-20">
                                        <div class="col-sm-6">
                                            <img class="img-fluid text-opacity m-t--5" width="100"
                                                 src="{{ asset('assets/admin/images/logo/logo.jpg') }}" alt="">
                                        </div>
                                        <div class="col-sm-6 text-right">
                                            <small><b>Phone:</b> (+84) 965 818 552</small>
                                            <br>
                                            <small>hungph.dev.ict@gmail.com</small>
                                        </div>
                                    </div>
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

@include('admin.bills.partials.edit_status_modal')

@section('inline_scripts')
    <script src="{{ asset('assets/admin/vendor/datatables/media/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/datatables/media/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/tables/data-table.js') }}"></script>

    <script>
        $(document).ready(function () {
            var billId;

            $('#edit-status').on('click', function (event) {
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
                        $('#edit-status').data('status', statusId);
                        console.log(statusId);
                        var statusBillElement = $('#bill-status');
                        statusBillElement.html();
                        $('.status-map').removeClass();
                        $('#status-map-' + statusId).addClass('nav-link status-map active');
                        for (var i = 0; i < 5; i++) {
                            if (i < statusId) {
                                $('#status-map-' + i).addClass('nav-link status-map completed');
                            } else if (i > statusId) {
                                $('#status-map-' + i).addClass('nav-link status-map');
                            }
                        }
                        switch (statusId) {
                            case '0': {
                                statusBillElement.html('Bill Status: Pending');
                                break;
                            }
                            case '1': {
                                statusBillElement.html('Bill Status: Transporting');
                                break;
                            }
                            case '2': {
                                statusBillElement.html('Bill Status: Already Paid');
                                break;
                            }
                            case '3': {
                                statusBillElement.html('Bill Status: Activated');
                                break;
                            }
                            case '4': {
                                console.log('44444444');
                                statusBillElement.html('Bill Status: Canceled');
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