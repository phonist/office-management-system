<div id="modal" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <h5 class="modal-title" id="myModalLabel">Edit Payment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <form action="" id="editPayment" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Payment Date<span class="required" aria-required="true">*</span></label>
                            <input id="datepicker-3" name="payment_date" value="" class="form-control off_autocomplete" type="text" date-format="Y-m-d">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- /.Start Date -->
                        <div class="form-group form-group-bottom">
                            <label>Reference No.</label>
                            <input id="reference_no" name="order_ref" class="form-control off_autocomplete" value="" type="text">
                        </div>
                    </div>


                    <div class="col-md-6">
                        <!-- /.Start Date -->
                        <div class="form-group form-group-bottom">
                            <label>Received Amount</label>
                            <input id="amount" name="amount" class="form-control off_autocomplete" value="" type="text">
                            <span style="color: #E13300" id="msg"></span>
                        </div>
                    </div>

                    <input type="hidden" value="" id="due">

                    <div class="col-md-6">
                        <!-- /.Start Date -->
                        <div class="form-group form-group-bottom">
                            <label>Attachment</label>
                            <input name="bill" value="" type="file">
                        </div>
                    </div>

                </div>

                <div class="well well-sm">

                    <div class="row">

                        <div class="col-md-12">
                            <!-- /.Start Date -->
                            <div class="form-group form-group-bottom">
                                <label>Payment Method</label>
                                <select id="method" class="form-control" name="payment_method">
                                    <option value="cash">Cash</option>
                                    <option value="cc">Credit Card</option>
                                    <option value="ck">Cheque</option>
                                    <option value="bank">Bank Transfer</option>
                                </select>
                            </div>
                        </div>

                        <div class="cc box" style="display: none;">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input name="cc_name" value="" placeholder="Card Holder Name" class="form-control"
                                        type="text">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- /.Start Date -->
                                <div class="form-group form-group-bottom">
                                    <input name="cc_number" class="form-control" placeholder="CC Number" value="" type="text">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <!-- /.Start Date -->
                                <div class="form-group form-group-bottom">
                                    <select class="form-control" name="cc_type">
                                        <option value="Visa">Visa</option>
                                        <option value="Master">Master Card</option>
                                        <option value="AMEX">AMEX</option>
                                        <option value="Discovery">Discovery</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <!-- /.Start Date -->
                                <div class="form-group form-group-bottom">
                                    <input name="cc_month" class="form-control" placeholder="Month" value="" type="text">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <!-- /.Start Date -->
                                <div class="form-group form-group-bottom">
                                    <input name="cc_year" class="form-control" placeholder="Year" value="" type="text">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <!-- /.Start Date -->
                                <div class="form-group form-group-bottom">
                                    <input name="cvc" class="form-control" placeholder="CVC" value="" type="text">
                                </div>
                            </div>


                        </div>

                        <div class="ref box" style="display: none;">
                            <div class="col-md-12">
                                <!-- /.Start Date -->
                                <div class="form-group form-group-bottom">
                                    <label>Ref.</label>
                                    <input name="payment_ref" class="form-control" value="" type="text">
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                
                <input type="hidden" class="purchaseId" name="purchaseId" value="">
                <input type="hidden" class="order_id" name="order_id" value="">


                <div class="modal-footer">

                    <button type="button" id="close" class="btn btn-danger btn-flat pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-olive btn-flat" id="btn">Save</button>


                </div>
            </form>

        </div>





    </div>
</div>
@push('scripts')
<script>
    initialize();
    function initialize(){
        $('.off_autocomplete').attr('autocomplete','off');
    }
    $(document).ready(function () {
        //Date picker
        $('#datepicker-3').datepicker({
            autoclose: true,
            format: 'yyyy-m-d'
        });
    });

</script>
@endpush
