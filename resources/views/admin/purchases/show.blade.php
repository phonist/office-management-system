@extends('admin.layouts.layout-basic')

@section('styles')
@endsection
@section('scripts')
<script src="{{ asset('/assets/admin/js/jquery.PrintArea.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs"
    crossorigin="anonymous"></script>
<script src="{{ asset('/assets/admin/js/payments/index.js') }}"></script>
    
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function init() {
        
        $('.invoice-content').attr('class', 'invoice-content row hidden');
        $('.received_inp').attr('autocomplete','off');
    }
    init();
    $(document.body).on('click','.add_payment',function(){
        $('.purchaseId').val($('.purchase_id').val());
    });
    
    $(document.body).on('click', '.received_prod_edit', function () {
        var number = 1;
        var purchase_id = $('.purchase_id').val();
        $('.purchaseId').val(purchase_id);
        $('#received_prod_list').empty();
        $('#updateReceivedProd').attr('action', '/admin/purchaseProduct/' + purchase_id + '/updateReceivedAmt');
        $.get('/admin/purchases/' + purchase_id + '/edit', function (data) {
            $('#ReceivePurchaseInvoice').text('Purchase Invoice #'+data['id']);
            $.each(data['purchaseProducts'], function (index, value) {
                var receive;
                var tr_received_clone = $('.prod_received_clone').clone();
                tr_received_clone.attr('class', 'custom-tr prod_received_added');
                tr_received_clone.removeAttr('hidden');
                tr_received_clone.find('.purchase_prod_number').text(number);
                $.get('/admin/purchaseProduct/'+value["id"]+'/getName',function(data){
                    tr_received_clone.find('.purchase_prod').text(data);
                });
                tr_received_clone.find('.purchase_qty').text(value['quantity']);
                tr_received_clone.find('.received_inp').attr('name', 'qty[]');
                tr_received_clone.find('.purchase_prod_id').attr('name', 'purchase_prod_id[]');
                if (value['receive'] == null) {
                    receive = 0;
                } else {
                    receive = value['receive'];
                }
                tr_received_clone.find('.received_amt').text(receive);
                tr_received_clone.find('.purchase_prod_id').val(value['id']);
                $('#received_prod_list').append(tr_received_clone);
                number++;
            });

        });
    });

    $(document.body).on('keyup','.received_inp',function(){
        $qty = $(this).parent('td').siblings('.purchase_qty').text();
        $recv = $(this).parent('td').siblings('.received_amt').text();
        $limit = $qty - $recv;
        $('#updateReceivedProdbtn').removeAttr('disabled');
        var regex = /(?:\d*\.\d{1,2}|\d+)$/;
        if (regex.test($(this).val())) {
            $(this).siblings('.exceedMsg').text('');
            $('#updateReceivedProdbtn').removeAttr('disabled');
        } else {
            $(this).siblings('.exceedMsg').text('Invalid input');
            $('#updateReceivedProdbtn').attr('disabled','disabled');
        }
        if($(this).val() > $limit){
            $(this).siblings('.exceedMsg').text('exceed');
            $('#updateReceivedProdbtn').attr('disabled','disabled');
        }else{
            $(this).siblings('.exceedMsg').text('');
            $('#updateReceivedProdbtn').removeAttr('disabled');
        }
    });

    $(document.body).on('keyup','.return_amt',function(){
        $recv = $(this).parent('td').siblings('.receive').text();
        $return = $(this).parent('td').siblings('.return').text();
        $limit = $recv - $return;
        $('#updateReturnProdbtn').removeAttr('disabled');
        var regex = /(?:\d*\.\d{1,2}|\d+)$/;
        if (regex.test($(this).val())) {
            $('#exceedMsg').text('');
            $('#updateReturnProdbtn').removeAttr('disabled');
        } else {
            $('#exceedMsg').text('Invalid input');
            $('#updateReturnProdbtn').attr('disabled','disabled');
        }
        if($(this).val() > $limit){
            $('#exceedReturn').text('exceed');
            $('#updateReturnProdbtn').attr('disabled','disabled');
        }else{
            $('#exceedReturn').text('');
            $('#updateReturnProdbtn').removeAttr('disabled');
        }
    });

    $(document.body).on('click', '.return_prod_edit', function () {
        var number = 1;
        var purchase_id = $('.purchase_id').val();
        $('.purchaseId').val(purchase_id);
        $('#return_prod_list').empty();
        $('#updateReturnProd').attr('action', '/admin/purchaseProduct/' + purchase_id + '/updateReturnAmt');
        $.get('/admin/purchases/' + purchase_id + '/edit', function (data) {
            $.each(data['purchaseProducts'], function (index, value) {
                var return_num;
                var receive;
                var tr_return_clone = $('.prod_return_clone').clone();
                tr_return_clone.attr('class', 'custom-tr prod_return_added');
                tr_return_clone.removeAttr('hidden');
                tr_return_clone.find('.numbering').text(number);
                tr_return_clone.find('.prod_name').text(value['name']);
                tr_return_clone.find('.pur_qty').text(value['quantity']);
                if (value['receive'] == null) {
                    receive = 0;
                } else {
                    receive = value['receive'];
                }
                tr_return_clone.find('.receive').text(receive);
                if (value['return'] == null) {
                    return_num = 0;
                } else {
                    return_num = value['return'];
                }
                tr_return_clone.find('.return').text(return_num);
                tr_return_clone.find('.return_amt').attr('name', 'return[]');
                tr_return_clone.find('.purchase_prod_id').attr('name', 'purchase_prod_id[]');
                tr_return_clone.find('.purchase_prod_id').val(value['id']);
                $('#return_prod_list').append(tr_return_clone);
                number++;
            });
        });
    });

    $(document.body).on('click', '.del_purchase', function () {
        var purchase_id = $('.purchase_id').val();
        $('#form-d-purchase').attr('action', '/admin/purchases/' + purchase_id);
    });

    $("#print_purchase").click(function () {
        $('#printPurchase').printArea();
    });

    $(document.body).on('keyup', '#addAmount', function () {
        var purchase_id = $('.purchase_id').val();
        var keyInAmount = $(this).val();
        $.get('/admin/purchases/' + purchase_id + '/getBalance', function (data) {
            $balance = data;
            if(parseFloat(keyInAmount).toFixed(2) > $balance.toFixed(2)){
                $('#msg').text('Oops...Are you sure?');
            }else{
                $('#msg').text('');
            }
        });
    });
</script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Purchases <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('orders.create') }}">Show Purchase</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Purchase Details</h6>
                    </div>
                </div>
                <div class="card-body" id="printPurchase">
                    <div class="row">
                        <div class="col-sm-10 col-lg-10">
                            <h5>
                                 Buzzer Office
                            </h5>
                        </div>
                        <div class="col-sm-2 col-lg-2">
                            <h5>
                                <small>Date: {{
                                    $purchase->created_at }}</small>
                            </h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 invoice-col">
                            <h5>Billing Address</h5> <address>
                                <strong>{{ $vendors['company'] }}</strong><br>
                                {{ $vendors['billing_address'] }}<br>
                                Phone: {{ $vendors['phone'] }}<br>
                                Email: {{ $vendors['email'] }} </address>
                        </div>
                        <!-- /.col -->

                        <div class="col-sm-4 invoice-col">

                        </div>

                        <!-- /.col -->

                        <div class="col-sm-4 invoice-col inv_ref">
                            <input type="hidden" class="purchase_id" value="{{ $purchase->id }}">
                            <h4>Purchase #{{ $purchase->invoice_number }}</h4>
                            <b>Order Date:</b> {{ Carbon\Carbon::parse( $purchase->created_at)->format('d M
                            Y') }} <br>
                            <b>Billing Ref:</b> {{ $purchase->b_reference }}<br>
                        </div>
                        <!-- /.col -->
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
                                    <tbody class="inv_purchased_product">
                                        @foreach($purchase_products as $index=>$product)
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
                        </div>
                    </div>
                    <!-- /.row -->

                    <div class="row pull-right">

                        <div class="col-xs-6">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th style="width:50%">Subtotal:</th>
                                                <td class="inv_subtotal">{{ $purchase->total }}</td>
                                            </tr>
                                            <tr>
                                                <th>Discount:</th>
                                                <td class="inv_discount">{{ $purchase->discount }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tax Amount:</th>
                                                <td class="inv_tax">{{ $purchase->tax }}</td>
                                            </tr>
                                            <tr>
                                                <th>Shipping:</th>
                                                <td class="inv_transport">{{ $purchase->transport }}</td>
                                            </tr>
                                            <tr>
                                                <th>Grand Total:</th>
                                                <td class="inv_g_total">{{ $purchase->g_total }}</td>
                                            </tr>
                                            <tr>
                                                <th>Paid :</th>
                                                <td class="inv_paid">{{ $purchase->paid }}</td>
                                            </tr>
                                            <tr>
                                                <th>Balance :</th>
                                                <td class="inv_balance">{{ $purchase->balance }}</td>
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
                            <button id="print_purchase" class="btn btn-secondary btn-rounded">
                                Print
                            </button>
                            <button class="btn btn-danger btn-rounded del_purchase" data-target="#delete_purchase" data-toggle="modal">
                                Delete
                            </button>
                            <button class="btn btn-warning btn-rounded return_prod_edit" data-target="#return_product" data-toggle="modal">
                                Return Purchase
                            </button>
                            <button class="btn btn-warning btn-rounded received_prod_edit" data-target="#receive_product" data-toggle="modal">
                                Received Product
                            </button>
                            <button class="btn btn-info btn-rounded" data-target="#modal-index-payment" data-toggle="modal">
                                View Payment
                            </button>
                            <button class="btn btn-primary btn-rounded add_payment" data-target="#modal-create-payment"
                                data-toggle="modal">
                                Add Payment
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
<div class="modal fade" id="receive_product" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    @include('admin.purchasedProducts.receive')
</div>
<div class="modal fade" id="return_product" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    @include('admin.purchasedProducts.return')
</div>
<div class="modal fade" id="delete_purchase" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    @include('admin.purchases.delete')
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
@endsection