<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Delete Confirmation</h4>
        </div>
        <div class="modal-body">
            <form action="" id="form-d-withdraw" enctype="multipart/form-data" method="post">
                @csrf
                @method('delete')
                <div class="box-body">
                    Are you sure?
                </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-danger" type="submit" value="Submit"><i class="fa fa-save"></i>
                Delete Withdraw Record</button>
        </div>
        </form>
    </div>
    <!-- /.box-body -->


    </form>
</div>
