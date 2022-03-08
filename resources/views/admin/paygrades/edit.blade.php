<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <h5 class="modal-title" id="exampleModalLabel">Edit Pay Grade</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" id="editPayGradeForm" method="post" class="form-horizontal">
            @method('put')
            @csrf
            <div class="modal-body form">

                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Name</label>
                        <div class="col-md-9">
                            <input name="grade_name" class="form-control edit_name autocomplete_off" type="text"
                                required>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Minimum Salary</label>
                        <div class="col-md-9">
                            <input type="number" min="0.00" step="0.01" placeholder="0.00" name="min_salary" class="form-control edit_min autocomplete_off">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Maximum Salary</label>
                        <div class="col-md-9">
                            <input type="number" min="0.00" step="0.01" placeholder="0.00" name="max_salary" class="form-control edit_max autocomplete_off">
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