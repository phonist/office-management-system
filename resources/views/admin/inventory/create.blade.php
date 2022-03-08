<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">Add New Inventory Product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('inventory.store') }}" id="from-product" enctype="multipart/form-data" method="post"
        accept-charset="utf-8">
        @csrf
        <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name<span class="required" aria-required="true">*</span></label>
                                    <input type="text" name="name" value="" class="form-control input-md" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group form-group-bottom">
                                    <label>Part/ Model No <span class="required" aria-required="true">*</span></label>
                                    <input type="text" name="model_no" class="form-control input-md" value="" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-group-bottom">
                                    <label>In House Part No <span class="required" aria-required="true">*</span></label>
                                    <input type="text" name="in_house" class="form-control input-md" value="" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Category <span class="required" aria-required="true">*</span></label>
                                    <select class="form-control ls-select2" name="category"
                                        style="width:100%;" required>
                                        
                                        @if (!$categories->isEmpty())
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id}}">
                                            {{ $category->name }}</option>
                                        @endforeach
                                        @else
                                        <option value="">Please Select</option>
                                        @endif
                                    </select>
                                    <a href="#" data-toggle="modal" data-target="#modal_create_category">+ Add Category</a>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Product Image</label>
                                    <div class="row">
                                        <div class="col-xs-6 col-md-3">
                                            <div class="image-upload">
                                                <label for="file-input">
                                                    <div class="thumbnail" style="cursor:pointer">
                                                        <img id="blah" src="/images/image.png" width="120"
                                                            height="120" alt="..." style="pointer-events: none">
                                                    </div>
                                                </label>
                                                <input id="file-input" type="file" name="p_image">
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
                            <input type="number" min="0.00" step="0.01" name="sales_cost" placeholder="0.00" class="form-control input-md" value="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Sales information</label>
                            <textarea class="form-control input-md" name="sales_info"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Cost</label>
                            <input type="number" min="0.00" step="0.01" name="buying_cost" placeholder="0.00" class="form-control input-md" value="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Purchasing information</label>
                            <textarea class="form-control input-md" name="buying_info"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Tax <span class="required" aria-required="true">*</span></label>
                    <select class="form-control ls-select2" name="tax" style="width:100%;" required>
                        @if (!$taxes->isEmpty())
                        @foreach($taxes as $tax)
                        <option value="{{ $tax->id}}">
                            {{ $tax->rate }}</option>
                        @endforeach
                        @else
                        <option value="">Please Select</option>
                        @endif
                    </select>
                </div>
                <div class="form-group quantity">
                    <label>Quantity on hand </label>
                    <input type="text" name="inventory" class="form-control input-md" value="">
                </div>
        </div>
        <div class="modal-footer">
                <input type="hidden" name="id" value="">
                <input type="hidden" class="type" name="type" value="">
                <button class="btn btn-primary" type="submit" value="Submit"><i class="fa fa-save"></i>
                    Save Product</button>
        </div>
    </form>
    </div>
</div>
<div class="modal fade" id="modal_create_category" style="display: none;">
    @include('admin.category.create')
</div>