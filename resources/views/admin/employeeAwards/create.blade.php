<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">Add Award</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <form id="addSubordinate" action="{{ route('employeeAwards.store') }}" method="post">
            @csrf
            <div class="modal-body">

                <div class="form-group">
                    <label>Department<span class="required">*</span></label>
                    <select class="form-control select2" name="department_id" required>
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
                    <select class="form-control select2" name="employee_id" required>
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
                    <input type="text" class="form-control autocomplete_off" name="award_name" value="" required>
                </div>

                <div class="form-group">
                    <label>Gift Item</label>
                    <input type="text" class="form-control autocomplete_off" name="gift_item" value="">
                </div>

                <div class="form-group">
                    <label>Award Amount</label>
                    <input type="text" class="form-control autocomplete_off" name="award_amount" value="">
                </div>

                <div class="form-group">
                    <label>Month</label>
             
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="icon-fa icon-fa-calendar"></i>
                            </span>
                        </div>
                        <input type="text" name="month" class="form-control monthyear ls-datepicker autocomplete_off" value="" data-date-format="yyyy-mm">
                    </div>
                </div>
            </div>


            <div class="modal-footer">
                <span class="required">*</span> Required field
                <button type="button" class="btn btn-danger btn-flat pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn bg-olive btn-flat" id="btn">Save</button>
            </div>
        </form>
    </div>
</div>