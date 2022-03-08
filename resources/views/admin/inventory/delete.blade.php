<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" id="form-d-inventory" enctype="multipart/form-data" method="post">
            @csrf
            <div class="modal-body">
                Are you sure?
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Delete Inventory</button>
            </div>
        </form>
    </div>
</div>