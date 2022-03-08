<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <h5 class="modal-title" id="exampleModalLabel">Edit Inventory Product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" id="form-inventory" enctype="multipart/form-data" method="post">
            @method('PUT')
            @csrf
            <div class="modal-body">


                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name<span class="required" aria-required="true">*</span></label>
                                    <input id="inp_name" type="text" name="name" value="" class="form-control input-md">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <!-- /.Start Date -->
                                <div class="form-group form-group-bottom">
                                    <label>Part/ Model No <span class="required" aria-required="true">*</span></label>
                                    <input id="inp_model_no" type="text" name="model_no" class="form-control input-md"
                                        value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <!-- /.Start Date -->
                                <div class="form-group form-group-bottom">
                                    <label>In House Part No <span class="required" aria-required="true">*</span></label>
                                    <input id="inp_house_no" type="text" name="in_house" class="form-control input-md"
                                        value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Category <span class="required" aria-required="true">*</span></label>
                                    <select id="inp_category" class="form-control input-md ls-select2" name="category"
                                        style="width: 50%;">
                                        @if (!$categories->isEmpty())
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id}}">
                                            {{ $category->name }}</option>
                                        @endforeach
                                        @else
                                        <option value="">Please Select</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Product Image <span class="required" aria-required="true">*</span></label>
                                    <div class="row">
                                        <div class="col-xs-6 col-md-3">
                                            <div class="image-upload">
                                                <label for="file-input">
                                                    <div class="thumbnail" style="cursor:pointer">
                                                        <img id="edit_p_image" src="" width="120" height="120" alt=""
                                                            style="pointer-events: none">
                                                    </div>
                                                </label>
                                                <input id="file-input" type="file" name="edited_p_img">
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                </div>


                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Sales price/rate</label>
                            <input id="inp_s_cost" type="number" min="0.01" step="0.01" name="sales_cost" class="form-control input-md" value="">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Sales information</label>
                            <textarea id="inp_s_info" class="form-control input-md" name="sales_info"></textarea>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Cost</label>
                            <input id="inp_p_cost" type="number" min="0.01" step="0.01" name="buying_cost" class="form-control input-md" value="">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Purchasing information</label>
                            <textarea id="inp_p_info" class="form-control input-md" name="buying_info"></textarea>
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <label>Tax <span class="required" aria-required="true">*</span></label>

                    <select id="inp_tax" class="form-control input-md ls-select2" name="tax" style="width: 30%;">
                        @if (!$taxes->isEmpty())
                        @foreach($taxes as $tax)
                        <option value="{{ $tax->id}}">
                            {{ $tax->rate }}</option>
                        @endforeach
                        @else
                            <option value="">Please Select..</option>
                        @endif
                    </select>
                </div>


                <div class="form-group quantity">
                    <label>Quantity on hand <span class="required" aria-required="true">*</span></label>
                    <input id="inp_quantity" type="text" name="inventory" class="form-control input-md" value="">
                </div>






            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" value="">
                <input type="hidden" name="type" value="Inventory">

                <button class="btn btn-primary" type="submit" value="Submit"><i class="fa fa-save"></i>
                    Update Inventory Product</button>
            </div>
        </form>
        </form>
    </div>
</div>