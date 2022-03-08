@extends('admin.layouts.layout-basic')

@section('styles')
@endsection
@section('scripts')
<script src="{{ asset('/assets/admin/js/jquery.PrintArea.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs"
    crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //Initialize Select2 Elements
        function init() {
            $('.invoice-content').attr('class', 'invoice-content row hidden');
        }
        init();

        $('.empty_input').hide();

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
        $("#printQuotation").click(function () {
            $('#print-quotation').printArea();
        });

        // delete invoice
        $(document.body).on('click', '.del_quotation', function () {
            var quotation_id = $('.quotation_id').val();
            $('#form-d-quotation').attr('action', '/admin/quotations/' + quotation_id);
        });
    });
</script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Quotation <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('orders.create') }}">Show Quotation</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Quotation Details</h6>
                    </div>
                </div>
                <div class="card-body" id="print-quotation">


                    <div class="row">
                        <div class="col-sm-10 col-lg-10">
                            <h5>
                                Buzzer Office
                            </h5>
                        </div>
                        <div class="col-sm-2 col-lg-2">
                            <h5>
                                <small>Date: {{
                                    $quotation[0]['created_at'] }}</small>
                            </h5>
                        </div>
                    </div>
                    <!-- info row -->
                    <div class="row quotation-info">
                        <div class="col-sm-4 quotation-col">
                            <h5>Billing Address</h5> <address>
                                <strong>{{ $client[0]['company'] }}</strong><br>
                                {{ $client[0]['billing_address'] }}<br>
                                Phone: {{ $client[0]['phone'] }}<br>
                                Email: {{ $client[0]['email'] }} </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 quotation-col">
                            <h5>Shipping Address</h5> <address>
                                <strong>{{ $client[0]['company'] }}</strong><br>
                                {{ $client[0]['shipping_address'] }}<br>
                                Phone: {{ $client[0]['phone'] }}<br>
                                Email: {{ $client[0]['email'] }} </address>
                        </div>
                        <!-- /.col -->

                        <div class="col-sm-4 quotation-col">
                            <input type="hidden" class="quotation_id" value="{{ $quotation[0]['id'] }}">
                            <h4>Quotation #{{ $quotation[0]['invoice_number'] }}</h4>
                            <b>Estimation Date:</b> {{ Carbon\Carbon::parse(
                            $quotation[0]['estimation_date'])->format('d M Y')
                            }} <br>
                            <b>Expiration Due:</b> {{ Carbon\Carbon::parse(
                            $quotation[0]['expiration_date'])->format('d M Y')
                            }}<br>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row" style="padding-top: 50px">
                        {{-- <div card="card-body"> --}}
                            <div class="col-xs-12 col-sm-12 table-responsive">
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
                                        @foreach($quotation_products as $index=>$product)
                                        <tr>
                                            <td>{{ $index+1 }} <input type="hidden" class="inventory_id" value="{{ $product->inventory_id }}"></td>
                                            <td>{{
                                                \App\Inventory::where('id',$product->inventory_id)->first()->name
                                                }}</td>
                                            <td>{{ $product->description }}</td>
                                            <td>{{ $product->rate }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td class='inv_total'>{{ $product->amount }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        {{-- </div> --}}
                    </div>
                    <!-- /.row -->

                    <div class="row pull-right">

                        <div class="col-xs-6">
                            <div class="card-body">
                                <p class="pull-right">Amount Due: SGD {{ $quotation[0]['g_total'] }}</p>

                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th style="width:50%">Subtotal:</th>
                                                <td id="total">SGD {{ $quotation[0]['total'] }}</td>
                                            </tr>

                                            <tr>
                                                <th>Tax:</th>
                                                @if( $quotation[0]['tax'] == null)
                                                <td id="tax">SGD 0.00</td>
                                                @else
                                                <td id="tax">SGD {{ $quotation[0]['tax'] }}</td>
                                                @endif

                                            </tr>
                                            <tr>
                                                <th>Discount:</th>
                                                @if( $quotation[0]['discount'] == null)
                                                <td id="discount">SGD -0.00</td>
                                                @else
                                                <td id="discount">SGD -{{ $quotation[0]['discount'] }}</td>
                                                @endif

                                            </tr>
                                            <tr>
                                                <th>Grand Total:</th>
                                                <td id="g_total">SGD {{ $quotation[0]['g_total'] }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <div class="card-footer">
                    <div class="row no-print">
                        <div class="col-xs-12">

                            <button id="printQuotation" class="btn btn-secondary btn-rounded">
                                Print
                            </button>
                            <button class="btn btn-danger btn-rounded del_quotation" data-target="#delete_quotation" data-toggle="modal">
                                Delete
                            </button>
                            
                            <button onclick="location.href='{{ route('quotations.edit',$quotation[0]['id']) }}'" class="btn btn-info btn-rounded">
                                Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delete_quotation" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    @include('admin.quotations.delete')
</div>
@endsection