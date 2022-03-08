<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('category.store') }}" id="from-product" enctype="multipart/form-data" method="post"
            accept-charset="utf-8">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Category</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="category" id="p_category">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" value="">
                <input type="hidden" name="type" value="inventory">

                <button class="btn btn-primary" type="submit" value="Submit"><i class="fa fa-save"></i>
                    Save Category</button>
            </div>
        </form>
    </div>
</div>