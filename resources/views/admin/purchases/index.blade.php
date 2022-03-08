@extends('admin.layouts.layout-basic')

@section('styles')
@endsection
@section('scripts')
<script src="{{ asset('/assets/admin/js/jquery.PrintArea.js') }}"></script>
<script src="/assets/admin/js/pages/datatables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs"
    crossorigin="anonymous"></script>
<script>
    $(document.body).on('click', '.received_prod_edit', function () {
        var number = 1;
        var purchase_id = $(this).siblings('input').val();
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
            $('#exceedMsg').text('');
            $('#updateReceivedProdbtn').removeAttr('disabled');
        } else {
            $('#exceedMsg').text('Invalid input');
            $('#updateReceivedProdbtn').attr('disabled','disabled');
        }
        if($(this).val() > $limit){
            $('#exceedMsg').text('exceed');
            $('#updateReceivedProdbtn').attr('disabled','disabled');
        }else{
            $('#exceedMsg').text('');
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
    $(document.body).on('click','.add_payment',function(){
        $('.purchaseId').val($(this).parents('tr').attr('value'));
    });
    $(document.body).on('click', '.return_prod_edit', function () {
        var number = 1;
        var purchase_id = $(this).parents('tr').attr('value');
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
        var purchase_id = $(this).parents('tr').attr('value');
        $('#form-d-purchase').attr('action', '/admin/purchases/' + purchase_id);
    });
</script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Purchases <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('orders.index') }}">Purchase List</a></li>
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
                    LIFE TIME PURCHASE
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
                    OPEN INVOICE
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
                    LIFETIME PAID
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
                    RETURN PURCHASE
                </span>
            </a>
        </div>

    </div> -->
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Purchase List</h6>
                    </div>
                    <div class="actions">
                    <button class="btn btn-primary btn-sm" onclick="location.href='{{ route('purchases.export') }}'"><i
                                class="icon-fa icon-fa-plus"></i> Export</button>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="responsive-datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Date(Y-M-D)</th>
                                <th>Purchase No</th>
                                <th>Supplier</th>
                                <th>Status</th>
                                <th>Grand Total</th>
                                <th>Paid</th>
                                <th>Balance</th>
                                <th>Actions</th>

                            </tr>


                        </thead>

                        @if (!$purchases->isEmpty())
                        <tbody>

                            @if(Session::has('success'))
                            <button class="btn btn-success" data-toastr="success" data-message="{{ Session::get('success') }}"
                                data-title="Success!">
                            </button>
                            @endif
                            @if(Session::has('failure'))
                            <button class="btn btn-danger" data-toastr="error" data-message="{{ Session::get('failure') }}"
                                data-title="Error!">
                            </button>
                            @endif
                            @if(Session::has('warning'))
                            <button class="btn btn-warning" data-toastr="warning" data-message="{{ Session::get('warning') }}"
                                data-title="Warning!">
                            </button>
                            @endif
                            @foreach($purchases as $purchase)
                            <tr class="purchaseId" value="{{ $purchase->id }}">
                                <td>{{ $purchase->timeFormat($purchase->created_at) }}
                                    </td>
                                <td>
                                    {{ $purchase->invoice_number }} </td>
                                <td>
                                    {{ $purchase->vendor($purchase->id) }}
                                    </td>
                                <td>
                                    @if($purchase->status == "partial_received")
                                    <span class="label label-info">Partial Received</span>
                                    @elseif($purchase->status == "pending_received")
                                    <span class="label label-warning">Pending Received</span>
                                    @elseif($purchase->status == "received")
                                    <span class="label label-info">Received</span>
                                    @elseif($purchase->status == "return_purchase")
                                    <span class="label label-danger">Return Purchase</span>
                                    @else
                                    @endif
                                </td>
                                <td>
                                    <span style="color: green"><strong>{{ $purchase->g_total }}</strong></span> </td>
                                <td>
                                    @if($purchase->paid == null)
                                    <span style="color: #3A89B7"><strong>0.00</strong></span> </td>
                                @else
                                <span style="color: #3A89B7"><strong>{{ $purchase->paid }}</strong></span> </td>
                                @endif

                                <td>
                                    @if($purchase->balance == null)
                                    <strong>0.00</strong>
                                    @else
                                    <strong>{{ $purchase->balance }}</strong>
                                    @endif
                                </td>
                                <td>
                                    @if($purchase->status == "return_purchase")


                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-outline-default dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <input type="hidden" value="{{ $purchase->id}}">
                                            <a class="dropdown-item" href="/admin/purchases/{{ $purchase->id }}">View</a>
                                            <a class="dropdown-item del_purchase" href="#" data-target="#delete_purchase"
                                                data-toggle="modal">Delete</a>
                                        </div>
                                    </div>
                                    @else

                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-outline-default dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

                                            <input type="hidden" value="{{ $purchase->id}}">
                                            <a class="dropdown-item" href="/admin/purchases/{{ $purchase->id }}">View</a>
                                            <a class="dropdown-item received_prod_edit" href="#" data-target="#receive_product"
                                                data-toggle="modal">Received Product</a>
                                            <a class="dropdown-item return_prod_edit" href="#" data-target="#return_product"
                                                data-toggle="modal">Return Purchase</a>
                                                <a class="dropdown-item add_payment" href="#" data-target="#modal-create-payment"
                                                data-toggle="modal">Add Payment</a>
                                            <a class="dropdown-item del_purchase" href="#" data-target="#delete_purchase"
                                                data-toggle="modal">Delete</a>
                                        </div>
                                    </div>
                                    @endif

                                </td>




                            </tr>
                            @endforeach
                        </tbody>
                        @else
                        <tbody>


                            <div class="card text-white bg-info text-sm-center">
                                <div class="card-body">
                                    <blockquote class="card-bodyquote">
                                        <p>Hi, you don't have any purchase yet</p>

                                    </blockquote>
                                </div>
                            </div>
                        </tbody>
                        @endif
                        <tfoot>
                            <tr>
                                <th>Date(Y-M-D)</th>
                                <th>Purchase No</th>
                                <th>Supplier</th>
                                <th>Status</th>
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
<div class="modal fade" id="modal-index-payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    @include('admin.payments.index')
</div>
<div class="modal fade" id="payments_show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    @include('admin.payments.show')
</div>
<div class="modal fade" id="payments_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    @include('admin.payments.edit')
</div>
<div class="modal fade" id="payments_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    @include('admin.payments.delete')
</div>
<div class="modal fade" id="receive_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    @include('admin.purchasedProducts.receive')
</div>
<div class="modal fade" id="return_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    @include('admin.purchasedProducts.return')
</div>
<div class="modal fade" id="delete_purchase" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    @include('admin.purchases.delete')

</div>
@endsection