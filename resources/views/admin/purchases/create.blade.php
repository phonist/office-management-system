@extends('admin.layouts.layout-basic')

@section('styles')
@endsection
@section('scripts')
<script src="/assets/admin/js/pages/notifications.js"></script>
<script src="/assets/admin/js/pages/validation.js"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //Initialize Select2 Elements
        function init() {
            clone();
            $('.invoice-content').attr('class', 'invoice-content row hidden');
            $('#email').attr('autocomplete','off');
            $('#discount').attr('autocomplete','off');
            $('#tax').attr('autocomplete','off');
            $('#transport_cost').attr('autocomplete','off');
            $('.quantity').attr('autocomplete','off');
            $('.autocomplete_off').attr('autocomplete','off');
        }
        $('#selected_vendor').change(function () {
            var vendor_id = $(this).val();
            $.get("/admin/vendor/" + vendor_id, function (data) {
                $('#email').val(data['email']);
                $('#b_address').val(data['billing_address']);
            });
        });

        init();
        $(document.body).on("change", ".inventory", function () {
            var inventory_id = $(this).val();
            var list = $(this);
            $.get("/admin/inventory/" + inventory_id, function (data) {
                list.closest('td').siblings('td').find('.quantity').val(1);
                list.closest('td').siblings('td').find('.rate').val(data[
                    'p_price'
                ]);
                list.closest('td').siblings('td').find('.amount').val(data[
                    'p_price'
                ]);
            });
            $('#purchasing_list tr').each(function (i) {
                $(this).find('.numbering').text(i + 1);
            });
            setTimeout(function () {
                sumTotal();
            }, 1000);
        });

        $(document.body).on("change", ".new_inventory", function () {
            var inventory_id = $(this).val();
            var list = $(this);
            list.attr('class', 'inventory added form-control select2');
            $.get("/admin/inventory/" + inventory_id, function (data) {
                list.closest('td').siblings('td').find('.quantity').val(1);
                list.closest('td').siblings('td').find('.rate').val(data[
                    'p_price'
                ]);
                list.closest('td').siblings('td').find('.amount').val(data[
                    'p_price'
                ]);
            });
            setTimeout(function () {
                sumTotal();
            }, 1000);
            clone();
        });

        $(document.body).on('keyup', '.quantity', function () {
            var quantity = $(this).val();
            var p_price = $(this).closest('td').siblings('td').find('.rate').val();
            var amount = quantity * p_price;
            integerValidation();
            $(this).closest('td').siblings('td').find('.amount').val(amount.toFixed(2));
            setTimeout(function () {
                sumTotal();
            }, 1000);
        });
        function integerValidation(){
            $('.qty_msg').text('');
            $('#savePurchase').removeAttr('disabled');
            $('#purchasing_list .quantity').not(':last').each(function(){
                if(Math.floor($(this).val()) == $(this).val() && $.isNumeric($(this).val())) {
                    
                    $(this).after('<div class="qty_msg" style="color:red"></div>');
                }else{
                    $('#savePurchase').attr('disabled','disabled');
                    $(this).after('<div class="qty_msg" style="color:red">The value must be integer</div>');
                }
            });   
        }
        function clone() {
            var trClone = $('.purchasing_item').clone();
            trClone.attr("class", "");
            trClone.removeAttr('hidden');
            trClone.find('.new_inventory').attr('class', 'inventory new_inventory form-control select2');
            

            if($('#purchasing_list tr').length <= 0){
                trClone.find('select').attr('required','required');
                trClone.find('.quantity').attr('required','required');
            }
            $('#purchasing_list').append(trClone);
        }

        function sumTotal() {
            var total = 0;
            $('.amount').each(function () {
                total += Number($(this).val());
            });
            $('#total').text(total.toFixed(2));
            $('#total').siblings('input').val(total.toFixed(2));
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
            $('#g_total').text(total.toFixed(2));
            $('#g_total').siblings('input').val(total.toFixed(2));
        }

        $(document.body).on('keyup', '#discount', function () {
            $('#savePurchase').removeAttr('disabled');
            var regex = /(?:\d*\.\d{1,2}|\d+)$/;
            if (regex.test($(this).val())) {
                
                $('#dis_msg').text('');
            } else {
                $('#savePurchase').attr('disabled','disabled');
                $('#dis_msg').text('Invalid inputs');
            }
            grand_total();
        });

        $(document.body).on('keyup', '#tax', function () {
            $('#savePurchase').removeAttr('disabled');
            var regex = /(?:\d*\.\d{1,2}|\d+)$/;
            if (regex.test($(this).val())) {
                
                $('#tax_msg').text('');
            } else {
                $('#savePurchase').attr('disabled','disabled');
                $('#tax_msg').text('Invalid inputs');
            }
            grand_total();
        });

        $(document.body).on('keyup', '#transport_cost', function () {
            $('#savePurchase').removeAttr('disabled');
            var regex = /(?:\d*\.\d{1,2}|\d+)$/;
            if (regex.test($(this).val())) {
                
                $('#transport_msg').text('');
            } else {
                $('#savePurchase').attr('disabled','disabled');
                $('#transport_msg').text('Invalid inputs');
            }
            grand_total();
        });

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

        //created_invoice_button
        $(document.body).on('click', '#printButton', function () {
            $('.print-invoice').printArea(["iframe"]);
        });


    });    
</script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Purchase <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('purchases.create') }}">Create Purchase</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Create Purchase</h6>
                    </div>
                </div>
                <form action="{{ route('purchases.store') }}" id="from-purchase" enctype="multipart/form-data" method="post"
                    accept-charset="utf-8">
                    @csrf
                    <input type="hidden" name="invoice_number">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                <div class="row">
                                    <div class="col-md-6">
                                        @if(isset($selected_vendor))
                                        <div class="row">
                                            <div class="col-md-6">

                                                <div class="form-group">

                                                    <label>Vendor <span class="required" aria-required="true">*</span></label>
                                                    <select class="form-control ls-select2" id="selected_vendor" name="vendorId"
                                                        required style="width: 100%;" readonly>
                                                        @if (!$vendors->isEmpty())
                                                        <option value="">Please Select</option>
                                                        @foreach($vendors as $vendor)
                                                        <option value="{{ $vendor->id }}">
                                                            {{ $vendor->name }}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <!-- /.Start Date -->
                                                <div class="form-group form-group-bottom">
                                                    <label>Email</label>
                                                    <input type="email" name="email" id="email" class="form-control autocomplete_off"
                                                        value="{{ $selected_vendor->email }}" required readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Billing Address</label>
                                                    <textarea class="form-control autocomplete_off" id="b_address" name="b_address"
                                                        required readonly>{{ $selected_vendor->billing_address }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Billing Ref.</label>
                                                    <textarea class="form-control autocomplete_off" id="b_reference"
                                                        name="b_reference"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                        @else
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Vendor <span style="color:red;" class="required"
                                                            aria-required="true">*</span></label>
                                                    <select class="form-control ls-select2" id="selected_vendor" name="vendorId"
                                                        required style="width: 100%;" readonly>
                                                        @if (!$vendors->isEmpty())
                                                        <option value="">Please Select</option>
                                                        @foreach($vendors as $vendor)
                                                        <option value="{{ $vendor->id }}">
                                                            {{ $vendor->name }}</option>
                                                        @endforeach
                                                        @else
                                                        <option value="">
                                                                Please Selected</option>
                                                        @endif
                                                    </select>

                                                    
                                                </div>

                                            </div>

                                            <div class="col-md-6">
                                                <!-- /.Start Date -->
                                                <div class="form-group form-group-bottom">
                                                    <label>Email</label>
                                                    <input type="email" name="email" id="email" class="form-control autocomplete_off"
                                                        value="" required readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Billing Address</label>
                                                    <textarea class="form-control autocomplete_off" id="b_address" name="b_address"
                                                        required readonly></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Billing Ref.</label>
                                                    <textarea class="form-control autocomplete_off" id="b_reference"
                                                        name="b_reference"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                        @endif

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr style="background-color: #ECEEF1">
                                                        <th style="width: 15px">#</th>
                                                        <th class="col-sm-2">Product/Service</th>
                                                        <th class="col-md-6">Description</th>
                                                        <th class="">Qty</th>
                                                        <th class="">Rate</th>
                                                        <th class="">Amount</th>
                                                        <th class=""> </th>
                                                    </tr>
                                                </thead>
                                                <!-- hidden input -->
                                                <tr class="purchasing_item" hidden>
                                                    <td>
                                                        <div class="numbering form-group form-group-bottom">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group form-group-bottom p_div">
                                                            <select class="inventory new_inventory form-control" style="width: 100%;"
                                                                name="inventory_id[]">
                                                                @if (!$inventories->isEmpty())
                                                                <option value="">Please Select</option>
                                                                @foreach($inventories as $inventory)
                                                                <option value="{{ $inventory->id}}">
                                                                    {{ $inventory->name }}</option>
                                                                @endforeach

                                                                @endif
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group form-group-bottom">
                                                            <input class="description form-control autocomplete_off"
                                                                type="text" name="inventory_desc[]">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group form-group-bottom">
                                                            <input class="quantity form-control autocomplete_off" type="text"
                                                                style="width:120px" name="inventory_qty[]">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group form-group-bottom">
                                                            <input class="rate form-control" type="text" style="width:120px"
                                                                name="inventory_rate[]" readonly>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group form-group-bottom">
                                                            <input class="amount form-control" type="text" readonly=""
                                                                name="inventory_amount[]" style="width:120px">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-outline-danger delete">Remove</button>

                                                    </td>
                                                </tr>
                                                <!-- hidden input -->
                                                <tbody id="purchasing_list">



                                                </tbody>
                                            </table>
                                        </div>

                                        <table class="table">
                                            <thead>
                                                <tr style="border-bottom: solid 1px #ccc">
                                                    <th style="width: 15px"></th>
                                                    <th class="col-sm-2"></th>
                                                    <th class="col-sm-5"></th>
                                                    <th class=""></th>
                                                    <th class=""></th>
                                                    <th style="width: 230px"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="5" style="text-align: right">
                                                        Total </td>
                                                    <input type="hidden" name="total" value="">
                                                    <td id="total" style="text-align: right; padding-right: 30px">0</td>
                                                </tr>

                                                <tr>
                                                    <td colspan="5" style="text-align: right">
                                                        Discount </td>
                                                    <td style="text-align: right; padding-right: 30px">
                                                        <input id="discount" type="" class="form-control" style="text-align: right"
                                                            value="" name="discount">
                                                        <div id="dis_msg"></div>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td colspan="5" style="text-align: right">
                                                        Tax Amount </td>
                                                    <td style="text-align: right; padding-right: 30px">
                                                        <input id="tax" type="" class="form-control" style="text-align: right"
                                                            value="" name="tax">
                                                        <div id="tax_msg"></div>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td colspan="5" style="text-align: right">
                                                        Transport Cost </td>

                                                    <td style="text-align: right; padding-right: 30px">
                                                        <input id="transport_cost" type="" class="form-control" style="text-align: right"
                                                            value="" name="shipping">
                                                        <div id="transport_msg"></div>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td colspan="5" style="text-align: right; font-weight: bold">
                                                        Grand Total </td>

                                                    <input type="hidden" name="g_total" value="">
                                                    <td id="g_total" style="text-align: right; padding-right: 30px; font-weight: bold; font-size: 16px">0.00</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Note</label>
                                            <textarea class="form-control" id="note" name="order_note"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="hidden" name="type" value="invoice">
                        <input type="hidden" class="order_id" name="order_id" value="">

                        <button type="submit" class="btn bg-primary btn-flat" id="savePurchase">Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection