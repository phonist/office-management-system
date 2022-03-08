<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <h5 class="modal-title" id="exampleModalLabel">Edit Employee Status</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" method="post" id="editEmployeeStatusForm" class="form-horizontal">
            @method('put')
            @csrf
            <div class="modal-body form">


                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Employee Status</label>
                        <div class="col-md-9">
                            <input name="status" class="form-control edit_status autocomplete_off" type="text" required>
                            <span class="help-block"></span>
                        </div>
                    </div>


                </div>


            </div>


            <div class="modal-footer">
                <button type="submit" id="btnSave" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>