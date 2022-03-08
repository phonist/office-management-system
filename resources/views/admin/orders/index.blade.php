@extends('admin.layouts.layout-basic')
@section('styles')
@endsection
@section('scripts')
<script src="{{ asset('/assets/admin/js/jquery.PrintArea.js') }}"></script>
<script src="{{ asset('/assets/admin/js/pages/datatables.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js"
    integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs" crossorigin="anonymous">
</script>
<script>
    $(document).ready(function () {
        $('.autocomplete_off').attr('autocomplete', 'off');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document.body).on('click', '.add_payment', function () {
            var invoice_id = $('.inv_id').attr('value');
            $('.invoiceId').val(invoice_id);
        });
        $(document.body).on('click', '.delete_order', function () {
            var invoice_id = $('.invoiceId').attr('value');
            $('#form-d-order').attr('action', '/admin/orders/' + invoice_id);
        });
    });
</script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">ORDERS <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('orders.index') }}">Order List</a></li>
        </ol>
    </div>
    <!-- <div class="row">
        <div class="col-md-12 col-lg-6 col-xl-3">
            <a class="dashbox" href="#">
                <div class="icon-box"><i class="icon-im icon-im-calendar"></i></div>
                <span class="title">
                    150
                </span>
                <span class="desc">
                    OVERDUE
                </span>
            </a>
        </div>
        <div class="col-md-12 col-lg-6 col-xl-3">
            <a class="dashbox" href="#">
                <div class="icon-box"><i class="icon-im icon-im-info"></i></div>
                <span class="title">
                    35
                </span>
                <span class="desc">
                    ESTIMATE
                </span>
            </a>
        </div>
        <div class="col-md-12 col-lg-6 col-xl-3">
            <a class="dashbox" href="#">
                <div class="icon-box"><i class="icon-im icon-im-printer"></i></div>
                <span class="title">
                    35
                </span>
                <span class="desc">
                    OPEN INVOICE
                </span>
            </a>
        </div>
        <div class="col-md-12 col-lg-6 col-xl-3">
            <a class="dashbox" href="#">
                <div class="icon-box"><i class="icon-im icon-im-coin-dollar"></i></div>
                <span class="title">
                    35
                </span>
                <span class="desc">
                    LIFETIME SELL
                </span>
            </a>
        </div>

    </div> -->
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Order List</h6>
                    </div>
                    <div class="actions">
                        <button class="btn btn-primary btn-sm" onclick="location.href='{{ route('orders.export') }}'">
                            <i class="icon-fa icon-fa-plus"></i> Export</button>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="responsive-datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Date(Y-M-D)</th>
                                <th>Order No</th>
                                <th>Client</th>
                                <th>Due Date</th>
                                <th>Order Status</th>
                                <th>Grand Total</th>
                                <th>Paid</th>
                                <th>Balance</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        @if (!$invoice->isEmpty())
                        <tbody>
                            @if(Session::has('success'))
                            <button class="btn btn-success" data-toastr="success"
                                data-message="{{ Session::get('success') }}" data-title="Success!">
                            </button>
                            @endif
                            @if(Session::has('failure'))
                            <button class="btn btn-danger" data-toastr="error"
                                data-message="{{ Session::get('failure') }}" data-title="Error!">
                            </button>
                            @endif
                            @if(Session::has('warning'))
                            <button class="btn btn-warning" data-toastr="warning"
                                data-message="{{ Session::get('warning') }}" data-title="Warning!">
                            </button>
                            @endif
                            @foreach($invoice as $order)
                            <tr class="invoiceId inv_id" value="{{ $order->id }}">
                                <td>{{ $order->timeFormat($order->created_at) }}

                                </td>
                                <td>
                                    {{ $order->invoice_number }} </td>
                                <td>{{ $order->client }}
                                </td>
                                <td>
                                    {{ $order->due_date }} </td>
                                <td>
                                    @if($order->status == "processing_order")
                                    <span class="label label-info">Processing Order</span>
                                    @elseif($order->status == "awaiting_delivery")
                                    <span class="label label-warning">Awaiting Delivery</span>
                                    @elseif($order->status == "delivery_done")
                                    <span class="label label-info">Delivery Done</span>
                                    @elseif($order->status == "cancel_order")
                                    <span class="label label-danger">Cancel Order</span>
                                    @else
                                    @endif
                                </td>
                                <td>
                                    <span style="color: green"><strong>{{ $order->g_total }}</strong></span> </td>
                                <td>
                                    @if($order->paid == null)
                                    <span style="color: #3A89B7"><strong>0.00</strong></span> </td>
                                @else
                                <span style="color: #3A89B7"><strong>{{ $order->paid }}</strong></span> </td>
                                @endif

                                <td>
                                    @if($order->balance == null)
                                    <strong>0.00</strong>
                                    @else
                                    <strong>{{ $order->balance }}</strong>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button"
                                            class="btn btn-sm btn-outline-default dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <a class="dropdown-item" href="/admin/orders/{{ $order->id }}">View</a>
                                            <a class="dropdown-item" href="/admin/orders/{{ $order->id }}/edit">Edit</a>
                                            <a class="dropdown-item add_payment" href="#"
                                                data-target="#modal-create-payment" data-toggle="modal">Add Payment</a>
                                            {{-- <a class="dropdown-item" href="#" data-target="#modal-index-payment" data-toggle="modal">View Payment</a> --}}
                                            <a class="dropdown-item delete_order" href="#" data-target="#delete_order"
                                                data-toggle="modal">Delete</a>
                                        </div>
                                    </div>


                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @else
                        <tbody>
                            <div class="card text-white bg-info text-sm-center">
                                <div class="card-body">
                                    <blockquote class="card-bodyquote">
                                        <p>Hi, you don't have any order(s) yet</p>
                                        <footer>Please add/import your vendor(s) by using "New Purchase" in the left
                                            sidebar</footer>
                                    </blockquote>
                                </div>
                            </div>
                        </tbody>
                        @endif
                        <tfoot>
                            <tr>
                                <th>Date(Y-M-D)</th>
                                <th>Order No</th>
                                <th>Client</th>
                                <th>Due Date</th>
                                <th>Order Status</th>
                                <th>Grand Total</th>
                                <th>Paid</th>
                                <th>Balance</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-create-payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    @include('admin.payments.create')
</div>
<div class="modal fade" id="delete_order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    @include('admin.orders.delete')
</div>
@endsection