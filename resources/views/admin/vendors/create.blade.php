<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">Add New Vendor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('vendor.store') }}" id="from-product" enctype="multipart/form-data" method="post"
            accept-charset="utf-8">
            @csrf
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Vendor Name<span class="required" aria-required="true">*</span></label>
                            <input type="text" name="name" value="" class="form-control input-md inp_vendor_name"
                                required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- /.Start Date -->
                        <div class="form-group form-group-bottom">
                            <label>Company Name</label>
                            <input type="text" name="company_name" class="form-control input-md inp_company_name" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <!-- /.Start Date -->
                        <div class="form-group form-group-bottom">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control input-md inp_phone" value="">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- /.Start Date -->
                        <div class="form-group form-group-bottom">
                            <label>Fax</label>
                            <input type="text" name="fax" class="form-control input-md inp_fax" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <!-- /.Start Date -->
                        <div class="form-group form-group-bottom">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control input-md inp_email" value="">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- /.Start Date -->
                        <div class="form-group form-group-bottom">
                            <label>Website</label>
                            <input type="text" name="website" class="form-control input-md inp_website" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Billing Address</label>
                            <textarea class="form-control inp_b_address" name="b_address"></textarea>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Vendor Note</label>
                            <textarea class="form-control inp_vendor_note" name="note"></textarea>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="id" value="">
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit" value="Submit"><i class="fa fa-save"></i>
                    Save Vendor</button>
            </div>
        </form>
    </div>
</div>