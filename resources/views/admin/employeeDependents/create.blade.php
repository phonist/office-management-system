<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">Add Dependent</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <form action="{{ route('employeeDependents.store') }}" id="dependent" enctype="multipart/form-data" method="post"
            accept-charset="utf-8">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Name<span class="required">*</span></label>
                    <input type="text" name="name" value="" class="form-control autocomplete_off" required>
                </div>

                <div class="form-group">
                    <label>Relationship Type<span class="required">*</span></label>
                    <input type="text" name="relationship" value="" class="form-control autocomplete_off" required>
                </div>

                <div class="form-group form-group-bottom">
                    <label>Date of Birth <span class="required" aria-required="true">*</span></label>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="icon-fa icon-fa-calendar"></i>
                            </span>
                        </div>
                        <input type="text" name="date_of_birth" class="form-control ls-datepicker autocomplete_off" data-date-format="yyyy-mm-dd" value="" required>
                    </div>
                </div>



                <div class="modal-footer">
                    <input type="hidden" name="employee_id" value="{{ $employee->id }}">


                    <span class="required">*</span> Required field

                    <button type="button" id="close" class="btn btn-danger btn-flat pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-olive btn-flat" id="btn">Save</button>


                </div>
            </div>

        </form>
    </div>
</div>