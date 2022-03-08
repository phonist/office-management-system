<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">Withdraw Inventory</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('withdrawals.store') }}" id="form-witdraw" enctype="multipart/form-data" method="post">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" class="inv_id" name="inv_id" value="">
                                    <label>Inventory<span class="required" aria-required="true">*</span></label>
                                    <input id="withdraw_name" type="text" name="name" value="" class="form-control input-md">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <!-- /.Start Date -->
                                <div class="form-group form-group-bottom">
                                    <label>Withdraw Quantity <span class="required" aria-required="true">*</span></label>
                                    <input id="w_quantity" type="text" placeholder="" name="w_quantity" class="form-control input-md"
                                        value="" required>
                                    <div id="exceed_qty" class="hidden" style="color:red;">Exceed current quantity</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <!-- /.Start Date -->
                                <div class="form-group form-group-bottom">
                                    <label>Project Id <span class="required" aria-required="true">*</span></label>
                                    <input id="project_id" type="text" placeholder="" name="project_id" class="form-control input-md"
                                        value="" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="submit_withdraw" class="btn btn-primary" type="submit" value="Submit"><i class="fa fa-save"></i>
                    Confirm</button>
            </div>
        </form>
    </div>
</div>