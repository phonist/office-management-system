<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <h5 class="modal-title" id="exampleModalLabel">Delete Application</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" id="form-d-application" enctype="multipart/form-data" method="post">
            @csrf
            @method('delete')
        <div class="modal-body">
                Are you sure?
        </div>
        <div class="modal-footer">
                <button class="btn btn-danger" type="submit" value="Submit"><i class="fa fa-save"></i>
                    Delete Application</button>
        </div>
    </form>
    </div>
</div>

