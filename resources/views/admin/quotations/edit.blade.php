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
            $('.invoice_date').attr('autocomplete', 'off');
            $('.due_date').attr('autocomplete', 'off');
            $('.description').attr('autocomplete', 'off');
            $('.quantity').attr('autocomplete', 'off');
            $('.autocomplete_off').attr('autocomplete','off');
        }
        init();

        
        $('#selected_client').change(function () {
            var client_id = $(this).val();
            $.get("/admin/client/" + client_id, function (data) {
                $('#email').val(data['client'][0]['email']);
                $('#b_address').val(data['client'][0]['billing_address']);
                $('#s_address').val(data['client'][0]['shipping_address']);
            });
        });

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
            $('#quotations_list tr').not(':last').each(function (i) {
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
            $(this).closest('td').siblings('td').find('.amount').val(amount.toFixed(2));
            integerValidation();
            setTimeout(function () {
                sumTotal();
            }, 1000);
        });

        function integerValidation() {
            $('.qty_msg').text('');
            $('#updateQuotation').removeAttr('disabled');
            $('#quotations_list .quantity').not(':last').each(function () {
                if (Math.floor($(this).val()) == $(this).val() && $.isNumeric($(this).val())) {
                    $(this).after('<div class="qty_msg" style="color:red"></div>');
                } else {
                    $('#updateQuotation').attr('disabled', 'disabled');
                    $(this).after(
                        '<div class="qty_msg" style="color:red">The value must be integer</div>');
                }
            });
        }

        function clone() {
            var trClone = $('.quotations_item').clone();

            trClone.attr("class", "");
            trClone.removeAttr('hidden');
            trClone.find('.new_inventory').attr('class',
                'inventory new_inventory form-control select2');
            if ($('#quotations_list tr').length <= 0) {
                trClone.find('select').attr('required', 'required');
                trClone.find('.quantity').attr('required', 'required');
            }
        
            $('#quotations_list').append(
                trClone);
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
            total = total - Number($('#discount').val());
            total = total + Number($('#tax').val());
            $('#g_total').text(total.toFixed(2));
            $('#g_total').siblings('input').val(total.toFixed(2));
        }

        $(document.body).on('keyup', '#discount', function () {
            $('#updateQuotation').removeAttr('disabled');
            var regex = /(?:\d*\.\d{1,2}|\d+)$/;
            if (regex.test($(this).val())) {

                $('#dis_msg').text('');
            } else {
                $('#updateQuotation').attr('disabled', 'disabled');
                $('#dis_msg').text('Invalid inputs');
            }
            grand_total();
        });

        $(document.body).on('keyup', '#tax', function () {
            $('#updateQuotation').removeAttr('disabled');
            var regex = /(?:\d*\.\d{1,2}|\d+)$/;
            if (regex.test($(this).val())) {

                $('#tax_msg').text('');
            } else {
                $('#updateQuotation').attr('disabled', 'disabled');
                $('#tax_msg').text('Invalid inputs');
            }
            grand_total();
        });

        $(document.body).on('click', '.delete', function () {
            $(this).parents('tr').remove();
            setTimeout(function () {
                sumTotal();
            }, 1000);
        });

        function sumInvTotal() {
            var total = 0;
            $('.inv_total').each(function () {
                total += Number($(this).text());
            });
            $('.inv_subtotal').text(total);
            total = total - Number($('.inv_discount').text());
            total = total + Number($('.inv_tax').text());
            total = total + Number($('.inv_transport').text());
            $('.inv_g_total').text(total.toFixed(2));
            total = total - Number($('.inv_paid').text());
            $('.inv_balance').text(total.toFixed(2));
        }
    });
</script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Quotations <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('orders.create') }}">Edit Quotation</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Edit Quotation</h6>
                    </div>
                </div>

                <form action="{{ route('quotations.update',$quotation[0]['id'] ) }}" id="from-quotation" enctype="multipart/form-data"
                    method="post" accept-charset="utf-8">
                    @method("PATCH")
                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                <div class="row">
                                    <div class="col-md-8">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Client <span class="required" aria-required="true">*</span></label>
                                                    <input type="text" class="form-control" value="{{ $client[0]['name'] }}"
                                                        readonly="">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <!-- /.Start Date -->
                                                <div class="form-group form-group-bottom">
                                                    <label>Email</label>
                                                    <input type="email" id="email" name="email" class="form-control autocomplete_off"
                                                        value="{{ $client[0]['email'] }}">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Billing Address</label>
                                                    <textarea class="form-control autocomplete_off" id="b_address" name="b_address">{{ $client[0]['billing_address'] }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Shipping Address</label>
                                                    <textarea class="form-control autocomplete_off" id="s_address" name="s_address">{{ $client[0]['shipping_address'] }}</textarea>
                                                </div>
                                            </div>


                                            <div class="col-md-3">

                                                <div class="input-group">
                                                    <label>Estimation date<span class="required" aria-required="true">*</span></label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="icon-fa icon-fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                    <input name="est_date" type="text" class="form-control ls-datepicker invoice_date autocomplete_off"
                                                        value="{{ $quotation[0]['estimate_date'] }}" data-date-format="yyyy-mm-dd"
                                                        required>
                                                </div>
                                            </div>


                                            <div class="col-md-3">


                                                <div class="input-group">
                                                    <label>Expiration Date<span class="required" aria-required="true">*</span></label>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="icon-fa icon-fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                    <input name="exp_date" type="text" class="form-control ls-datepicker due_date autocomplete_off"
                                                        value="{{ $quotation[0]['expiration_date'] }}" data-date-format="yyyy-mm-dd"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        {{-- <div class="row"> --}}
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
                                                    <tr class="quotations_item" hidden>
                                                        <td>
                                                            <div class="numbering form-group form-group-bottom">

                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group form-group-bottom p_div">
                                                                <select class="inventory new_inventory form-control"
                                                                    style="width: 100%;" name="inventory_id[]">
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
                                                                <input class="quantity form-control autocomplete_off"
                                                                    type="text" style="width:120px" name="inventory_qty[]">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group form-group-bottom">
                                                                <input class="rate form-control" type="text" style="width:120px"
                                                                    name="inventory_rate[]" readonly="">
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
                                                    <tbody id="quotations_list">
                                                        @foreach($quotation_products as $index=>$product)
                                                        <tr class="">
                                                            <td>
                                                                <input type="hidden" name="quotation_id[]" value="{{ $product->id }}">
                                                                <div class="numbering form-group form-group-bottom">{{
                                                                    $index+1
                                                                    }}</div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group form-group-bottom p_div">
                                                                    <select class="inventory form-control" style="width: 100%;"
                                                                        name="inventory_id[]">
                                                                        @if (!$inventories->isEmpty())
                                                                        @foreach($inventories as $inventory)
                                                                        @if($product->inventory_id == $inventory->id)
                                                                        <option value="{{ $inventory->id}}" selected>
                                                                            {{ $inventory->name }}</option>
                                                                        @else
                                                                        <option value="{{ $inventory->id}}">
                                                                            {{ $inventory->name }}</option>
                                                                        @endif
                                                                        @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group form-group-bottom">

                                                                    <input class="description form-control autocomplete_off"
                                                                        type="text" name="inventory_desc[]" value="{{ $product->description }}">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group form-group-bottom">
                                                                    <input class="quantity form-control autocomplete_off"
                                                                        type="text" style="width:120px" name="inventory_qty[]"
                                                                        value="{{ $product->quantity }}">
                                                                </div>
                                                            </td>


                                                            <td>
                                                                <div class="form-group form-group-bottom">
                                                                    <input class="rate form-control" type="text" style="width:120px"
                                                                        name="inventory_rate[]" value="{{ $product->rate }}">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group form-group-bottom">
                                                                    <input class="amount form-control" type="text"
                                                                        readonly="" name="inventory_amount[]" style="width:120px"
                                                                        value="{{ $product->amount }}">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                    <button type="button" class="btn btn-outline-danger delete">Remove</button>
                                                
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        <!-- append list here -->
                                                    </tbody>
                                                </table>
                                            </div>

                                            <table class="table table-hover">
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
                                                        <input type="hidden" name="total" value="{{ $quotation[0]['total'] }}">
                                                        <td id="total" style="text-align: right; padding-right: 30px">{{
                                                            $quotation[0]['total'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" style="text-align: right">
                                                            Discount </td>
                                                        <td style="text-align: right; padding-right: 30px">
                                                            <input id="discount" type="" class="form-control" style="text-align: right"
                                                                value="{{ $quotation[0]['discount'] }}" name="discount">
                                                            <div id="dis_msg"></div>
                                                        </td>

                                                    </tr>



                                                    <tr>
                                                        <td colspan="5" style="text-align: right">
                                                            Tax Amount </td>
                                                        <td style="text-align: right; padding-right: 30px">
                                                            <input id="tax" type="" class="form-control" style="text-align: right"
                                                                value="{{ $quotation[0]['tax'] }}" name="tax">
                                                            <div id="tax_msg"></div>
                                                        </td>

                                                    </tr>


                                                    <tr>
                                                        <td colspan="5" style="text-align: right; font-weight: bold">
                                                            Grand Total </td>

                                                        <input type="hidden" name="g_total" value="{{ $quotation[0]['g_total'] }}">
                                                        <td id="g_total" style="text-align: right; padding-right: 30px; font-weight: bold; font-size: 16px">{{
                                                            $quotation[0]['g_total'] }}</td>
                                                    </tr>


                                                </tbody>
                                            </table>
                                            {{--
                                        </div> --}}


                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Order Note</label>
                                            <textarea class="form-control" name="order_note">{{ $quotation[0]['order_note'] }}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Order Activities</label>
                                            <textarea class="form-control" name="order_activities">{{ $quotation[0]['order_activities'] }}</textarea>
                                        </div>
                                    </div>


                                </div>





                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                            <input type="hidden" name="type" value="invoice">
                            <input type="hidden" name="order_id" value="">
        
                            <button type="submit" class="btn bg-navy btn-flat" id="updateQuotation">Update </button>
        
                        </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection