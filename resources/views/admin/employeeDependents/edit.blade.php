<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <h5 class="modal-title" id="exampleModalLabel">Edit Dependent</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" id="editdependent" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            @method('put')
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Name<span class="required">*</span></label>
                    <input type="text" name="name" value="" class="form-control edit_name autocomplete_off">
                </div>

                <div class="form-group">
                    <label>Relationship Type<span class="required">*</span></label>
                    <input type="text" name="relationship" value="" class="form-control edit_relationship autocomplete_off">
                </div>

                <div class="form-group form-group-bottom">
                    <label>Date of Birth <span class="required" aria-required="true">*</span></label>


                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="icon-fa icon-fa-calendar"></i>
                            </span>
                        </div>
                        <input type="text" name="date_of_birth" class="form-control ls-datepicker edit_dob autocomplete_off"
                            data-date-format="yyyy-mm-dd" value="" required>
                    </div>
                </div>
            </div>



            <div class="modal-footer">
                <span class="required">*</span> Required field
                <button type="button" id="close" class="btn btn-danger btn-flat pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn bg-olive btn-flat" id="btn">Save</button>


            </div>
        </form>
    </div>
</div>