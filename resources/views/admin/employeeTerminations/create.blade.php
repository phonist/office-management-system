<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">Termination of Employment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('employeeTerminations.store') }}" id="" enctype="multipart/form-data" method="post"
            accept-charset="utf-8">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Termination Date<span class="required">*</span></label>
                   

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="icon-fa icon-fa-calendar"></i>
                            </span>
                        </div>
                        <input type="text" name="termination_date" class="form-control ls-datepicker autocomplete_off" value="" data-date-format="yyyy-mm-dd" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Termination Reason<span class="required">*</span></label>
                    <input type="text" name="termination_reason" value="" required="" class="form-control autocomplete_off"
                        required>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Termination Note<span class="required">*</span></label>
                    <textarea class="form-control autocomplete_off" name="termination_note" required="" rows="10"
                        required></textarea>
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