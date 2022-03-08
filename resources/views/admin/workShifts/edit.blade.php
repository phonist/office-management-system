<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <h5 class="modal-title" id="exampleModalLabel">Edit Work Shift</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" id="editWorkShiftForm" method="post" class="form-horizontal">
            @method('put')
            @csrf
            <div class="modal-body form">

                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Shift Name</label>
                        <div class="col-md-9">
                            <input name="shift_name" class="form-control edit_name autocomplete_off" type="text" value=""
                                required>
                            <span class="help-block"></span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">Shift Form</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input type="text" name="shift_from" class="form-control ls-timepicker edit_from autocomplete_off" value="">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                    <i class="icon-fa icon-fa-clock-o"></i>
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="form-group">
                        <label class="control-label col-md-3">Shift To</label>
                        <div class="col-md-9">

                            <div class="input-group">
                                <input type="text" name="shift_to" class="form-control ls-timepicker edit_to autocomplete_off" value="">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                    <i class="icon-fa icon-fa-clock-o"></i>
                                </span>
                                </div>
                            </div>
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