<div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <h5 class="modal-title">Delete Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" id="form-d-payment" enctype="multipart/form-data" method="post">
            @csrf
            @method('delete')
            <div class="modal-body">
                <div class="box-body">
                    <b>Are you sure?</b>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="submit" value="Submit"><i class="fa fa-save"></i>
                    Delete Payment</button>
            </div>
        </form>
    </div>
</div>

