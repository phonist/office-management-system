@extends('admin.layouts.layout-basic')

@section('styles')
@endsection
@section('scripts')
<script src="{{ asset('/assets/admin/js/jquery.PrintArea.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs"
    crossorigin="anonymous"></script>
<script src="{{ asset('/assets/admin/js/payments/index.js') }}"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.autocomplete_off').attr('autocomplete','off');
        $('.empty_input').hide();
        $(document.body).on('click', '.add_payment', function () {
            var invoice_id = $('.invoice_id').val();
            $('.invoiceId').val(invoice_id);
        });

        function sumTotal() {
            var total = 0;
            $('.amount').each(function () {
                total += Number($(this).val());
            });
            $('#total').text(total);
            grand_total();
        }

        function grand_total() {
            var total = 0;
            $('.amount').each(function () {
                total += Number($(this).val());
            });
            total = total - $('#discount').val();
            total = total - $('#tax').val();
            total = total - $('#transport_cost').val();
            $('#g_total').text(total);
        }

        $(document.body).on('click', '.delete', function () {
            $(this).parents('tr').remove();
            setTimeout(function () {
                sumTotal();
            }, 1000);
        });

        var purchase_items = [];
        var data_items = [];

        function sumInvTotal() {
            var total = 0;
            $('.inv_total').each(function () {
                total += Number($(this).text());
            });
            $('.inv_subtotal').text(total);
            total = total - Number($('.inv_discount').text());
            total = total + Number($('.inv_tax').text());
            total = total + Number($('.inv_transport').text());
            $('.inv_g_total').text(total);
            total = total - Number($('.inv_paid').text());
            $('.inv_balance').text(total);
        }
        $("#printInvoice").click(function () {
            $('#print-invoice').printArea();
        });


        // delete invoice
        $(document.body).on('click', '.delete_order', function () {
            var invoice_id = $('.invoice_id').val();
            $('#form-d-order').attr('action', '/admin/orders/' + invoice_id);
        });

        $(document.body).on('keyup','#addAmount',function(){
            $('#save_payment').removeAttr('disabled');
            var regex = /(?:\d*\.\d{1,2}|\d+)$/;
            if (regex.test($(this).val())) {
                
                $('#amt_msg').text('');
            } else {
                $('#save_payment').attr('disabled','disabled');
                $('#amt_msg').text('Invalid inputs');
            }
        }); 
    });
</script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Orders <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('orders.create') }}">Show Order</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Invoice Details</h6>
                    </div>
                </div>
                <div class="card-body" id="print-invoice">
                    <div class="row">
                        <div class="col-sm-10 col-lg-10">
                            <h5>
                                 Buzzer Office
                            </h5>
                        </div>
                        <div class="col-sm-2 col-lg-2">
                            <h5>
                                <small>Date: {{
                                    $invoice['created_at'] }}</small>
                            </h5>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-sm-4 col-xs-4 col-lg-4">
                            <h5>Billing Address</h5> <address>
                                <strong>{{ $client->company }}</strong><br>
                                {{ $client->billing_address }}<br>
                                Phone: {{ $client->phone }}<br>
                                Email: {{ $client->email }} </address>
                        </div>

                        <div class="col-sm-4 col-xs-4 col-lg-4">
                            <h5>Shipping Address</h5> <address>
                                <strong>{{ $client->company }}</strong><br>
                                {{ $client->shipping_address }}<br>
                                Phone: {{ $client->phone }}<br>
                                Email: {{ $client->email }} </address>
                        </div>


                        <div class="col-sm-4 col-xs-4 col-lg-4">
                            <input type="hidden" class="invoice_id" value="{{ $invoice['id'] }}">
                            <h4>Invoice #{{ $invoice['invoice_number'] }}</h4>

                            <b>Order Date:</b> {{ Carbon\Carbon::parse( $invoice['invoice_date'])->format('d M
                            Y') }} <br>
                            <b>Payment Due:</b> {{ Carbon\Carbon::parse( $invoice['due_date'])->format('d M Y')
                            }}<br>
                        </div>

                    </div>

                    <div class="row" style="padding-top: 50px">
                        <div class="card-body">
                            <div class="col-xs-12 table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sl.</th>
                                            <th>Product</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Subtotal (SGD)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sale_products as $index=>$sale)
                                        <tr>
                                            <td>{{ $index+1 }} <input type="hidden" class="inventory_id" value="{{ $sale->inventory_id }}"></td>
                                            <td>{{
                                                \App\Inventory::where('id',$sale->inventory_id)->first()->name
                                                }}</td>
                                            <td>{{ $sale->description }}</td>
                                            <td>{{ $sale->rate }}</td>
                                            <td>{{ $sale->quantity }}</td>
                                            <td class='inv_total'>{{ $sale->amount }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row pull-right">
                        <div class="col-xs-6">

                            {{-- <div class="card text-white bg-success text-xs-center ">
                                <div class="card-body ">
                                    <blockquote class="card-bodyquote ">
                                        <p>Thanks for doing business with us.</p>
                                    </blockquote>
                                </div>
                            </div> --}}
                        </div>

                        <div class="col-xs-6">
                            <div class="card-body ">
                                <h6 class="pull-right">Amount Due: SGD {{ $invoice['total'] }}</h6>

                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th>Subtotal</th>
                                                <td id="total">SGD {{ $invoice['total'] }}</td>
                                            </tr>

                                            <tr>
                                                <th>Tax</th>

                                                <td id="tax">SGD {{ $invoice['tax'] }}</td>


                                            </tr>
                                            <tr>
                                                <th>Discount</th>

                                                <td id="discount">SGD -{{ $invoice['discount'] }}</td>


                                            </tr>
                                            <tr>
                                                <th>Grand Total</th>
                                                <td id="g_total">SGD {{ $invoice['g_total'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>Received Amount</th>

                                                <td id="receiv_amount">SGD {{ $invoice['paid'] }}</td>


                                            </tr>
                                            <tr>
                                                <th>Amount Due</th>

                                                <td id="amt_due">SGD {{ $invoice['balance'] }}</td>


                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="card-footer">
                    <div class="row no-print">
                        <div class="col-xs-12">

                            <button id="printInvoice" class="btn btn-secondary btn-rounded">
                                Print
                            </button>
                            <button class="btn btn-danger btn-rounded delete_order" data-target="#del_order"
                                data-toggle="modal">
                                Delete
                            </button>
                            <button class="btn btn-info btn-rounded" data-target="#modal-index-payment" data-toggle="modal">
                                View Payment
                            </button>
                            <button class="btn btn-primary btn-rounded add_payment" data-target="#modal-create-payment"
                                data-toggle="modal">
                                Add Payment
                            </button>
                            <button onclick="location.href='{{ route('orders.edit',$invoice['id']) }}'" class="btn btn-info btn-rounded">
                                Edit
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-create-payment" style="display: none;">
    @include('admin.payments.create')
</div>
<div class="modal fade" id="modal-index-payment" style="display: none">
    @include('admin.payments.index')
</div>
<div class="modal fade" id="payments_show" style="display: none">
    @include('admin.payments.show')
</div>
<div class="modal fade" id="payments_edit" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    @include('admin.payments.edit')
</div>
<div class="modal fade" id="payments_delete" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    @include('admin.payments.delete')
</div>
<div class="modal fade" id="del_order" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    @include('admin.orders.delete')
</div>
@endsection