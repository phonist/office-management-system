<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <h5 class="modal-title" id="exampleModalLabel">Edit Award</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="editAward" action="" method="post">
            @method('put')
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Department<span class="required">*</span></label>
                    <select class="form-control select2 edit_department_id" name="department_id"
                        id="department" onchange="get_employee(this.value)" tabindex="-1" aria-hidden="true" style="width: 100%;"
                        required>
                        @if(!$departments->isEmpty())
                        <option value="">Please Select..</option>
                        @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                        @else
                        <option value="">No Department(s) in record</option>
                        @endif
                    </select>
                </div>

                <div class="form-group">
                    <label>Employee<span class="required">*</span></label>
                    <select class="form-control select2 edit_employee_id" name="employee_id"
                        id="employee" tabindex="-1" aria-hidden="true" style="width: 100%;" required>
                        @if(!$employees->isEmpty())
                        <option value="">Please Select</option>
                        @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->f_name }} {{ $employee->l_name }}</option>
                        @endforeach
                        @endif

                    </select>
                </div>

                <div class="form-group">
                    <label>Award Name / Title<span class="required">*</span></label>
                    <input type="text" class="form-control edit_award_name autocomplete_off" name="award_name" value=""
                        required>
                </div>

                <div class="form-group">
                    <label>Gift Item</label>
                    <input type="text" class="form-control edit_gift_item autocomplete_off" name="gift_item" value="">
                </div>

                <div class="form-group">
                    <label>Award Amount</label>
                    <input type="text" class="form-control edit_award_amount autocomplete_off" name="award_amount"
                        value="">
                </div>

                <div class="form-group">
                    <label>Month</label>
                    
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="icon-fa icon-fa-calendar"></i>
                            </span>
                        </div>
                        <input type="text" name="month" class="form-control monthyear ls-datepicker edit_month autocomplete_off" value="" data-date-format="yyyy-mm">
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <span class="required">*</span> Required field
                <button type="button" id="close" class="btn btn-danger btn-flat pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn bg-olive btn-flat">Save</button>


            </div>
        </form>
    </div>
</div>