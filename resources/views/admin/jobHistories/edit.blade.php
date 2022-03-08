<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <h5 class="modal-title" id="exampleModalLabel">Edit Job</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" id="editJob" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            @method('put')
            @csrf
            <div class="modal-body">
                <div class="form-group form-group-bottom">
                    <label>Effective From<span class="required" aria-required="true">*</span></label>

                    <div class="input-group">
                        <input type="text" class="form-control edit_effective_from autocomplete_off" id="datepicker"
                            value="" name="effective_from" data-date-format="yyyy-mm-dd" required>
                        <div class="input-group-addon">
                            <i class="fa fa-calendar-o"></i>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label>Department<span class="required">*</span></label>
                    <select class="form-control edit_department" name="department">
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
                    <label>Job Title<span class="required">*</span></label>
                    <select class="form-control edit_title" name="title">
                        @if(!$jobTitles->isEmpty())
                        <option value="">Please Select..</option>
                        @foreach($jobTitles as $jobTitle)
                        <option value="{{ $jobTitle->id }}">{{ $jobTitle->title }}</option>
                        @endforeach
                        @else
                        <option value="">No job title(s) in record</option>
                        @endif

                    </select>

                </div>

                <div class="form-group">
                    <label>Job Category<span class="required">*</span></label>
                    <select class="form-control edit_category" name="category">
                        @if(!$jobCategories->isEmpty())
                        <option value="">Please Select..</option>
                        @foreach($jobCategories as $jobCategory)
                        <option value="{{ $jobCategory->id }}">{{ $jobCategory->category }}</option>
                        @endforeach
                        @else
                        <option value="">No job category(s) in record</option>
                        @endif

                    </select>
                </div>

                <div class="form-group">
                    <label>Employment Status<span class="required">*</span></label>
                    <select class="form-control edit_status" name="employment_status">
                        @if(!$employeeStatuses->isEmpty())
                        <option value="">Please Select..</option>
                        @foreach($employeeStatuses as $employeeStatus)
                        <option value="{{ $employeeStatus->id }}">{{ $employeeStatus->status }}</option>
                        @endforeach
                        @else
                        <option value="">No employee status(s) in record</option>
                        @endif

                    </select>

                </div>

                <div class="form-group">
                    <label>Work Shift<span class="required">*</span></label>
                    <select class="form-control edit_work_shift" name="work_shift">
                        @if(!$workShifts->isEmpty())
                        <option value="">Please Select..</option>
                        @foreach($workShifts as $workShift)
                        <option value="{{ $workShift->id }}">{{ $workShift->name }}</option>
                        @endforeach
                        @else
                        <option value="">No work shift(s) in record</option>
                        @endif

                    </select>

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