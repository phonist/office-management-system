<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <h5 class="modal-title" id="exampleModalLabel">Edit Tax</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" method="post" id="editTaxForm" class="form-horizontal">
            @method('put')
            @csrf
            <div class="modal-body form">

                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Name</label>
                        <div class="col-md-9">
                            <input name="name" class="form-control edit_name autocomplete_off" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Rate</label>
                        <div class="col-md-9">
                            <input type="text" name="rate" class="form-control edit_rate autocomplete_off">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Tax Type</label>
                        <div class="col-md-9">
                            <select class="form-control edit_type" name="type">
                                <option value="1" id="percentage_option">Percentage (%)</option>
                                <option value="2" id="fixed_option">Fixed ($)</option>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>

                </div>


            </div>


            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>