    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalLabel">Withdraw Inventory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="form-witdraw-edit" enctype="multipart/form-data" method="post">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="hidden" class="withdraw_id" name="withdraw_id" value="">
                                        <label>Inventory<span class="required" aria-required="true">*</span></label>
                                        <input id="inv_name" type="text" name="name" value="" class="form-control input-md"
                                            readon>
                                        <input type="hidden" name="inv_id" value="" id="edit_inv_id">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <!-- /.Start Date -->
                                    <div class="form-group form-group-bottom">
                                        <label>Withdraw Quantity <span class="required" aria-required="true">*</span></label>
                                        <input type="hidden" id="ori_qty" name="ori_qty" value="">
                                        <input id="w_quantity" placeholder="" type="text" name="w_quantity" class="form-control input-md"
                                            value="" required>
                                        <div id="exceed_edit_qty" class="hidden" style="color:red;">Exceed current quantity</div>
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
                    <button id="submit_edit_withdraw" class="btn btn-primary" type="submit" value="Submit"><i class="fa fa-save"></i>
                        Confirm</button>
                </div>
            </form>
        </div>
    </div>

    