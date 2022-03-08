

<div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel">Add Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addPayment" action="{{ route('payments.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                        <div class="row">
                                <div class="col-md-6">
                                <label>Payment Date<span class="required" aria-required="true">*</span></label>
                                    
                                    <div class="form-group">
                                
                                            
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="icon-fa icon-fa-calendar"></i>
                                                </span>
                                            </div>
                                            <input name="payment_date" type="text" class="form-control ls-datepicker invoice_date autocomplete_off"
                                                value="" data-date-format="yyyy-mm-dd" required>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="col-md-6">
                                    <!-- /.Start Date -->
                                    <div class="form-group form-group-bottom">
                                        <label>Reference No.</label>
                                        
                                        <input name="order_ref" class="form-control autocomplete_off" value="" type="text">
                                    </div>
                                </div>
            
                                <div class="col-md-6">
                                    <!-- /.Start Date -->
                                    <div class="form-group form-group-bottom">
                                        <label>Received Amount</label>
                                        <input id="addAmount" name="amount" class="form-control autocomplete_off" value="" type="text" placeholder="">
                                        <span style="color: #E13300" id="amt_msg"></span>
                                    </div>
                                </div>
            
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
            
    
                    <input type="hidden" name="id" value="">
                </div>
                <div class="modal-footer">
                    <input type="hidden" class="purchaseId" name="purchaseId" value="">
                    <input type="hidden" class="invoiceId" name="invoiceId" value="">
                    <button type="button" id="close" class="btn btn-danger btn-flat pull-left" data-dismiss="modal">Close</button>
                   
                    
                    <button class="btn btn-primary" type="submit" value="Submit" id="save_payment"><i class="fa fa-save"></i>
                        Save</button>
                </div>
            </form>
        </div>
    </div>