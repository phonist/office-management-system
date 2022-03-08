<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">Add Application</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <form action="{{ route('applications.store') }}" method="post" id="form" class="form-horizontal">
            @csrf
            <div class="modal-body form">
                <div class="form-body">
                    <div class="form-group">
                        <label>Employee <span class="required" aria-required="true">*</span></label>
                        <select class="form-control ls-select2" name="employee"
                            style="width:100%;">
                            <option value="">Please Select..</option>
                            @if (!$employees->isEmpty())
                                @foreach($employees as $employee)
                                <option value="{{ $employee->id}}">
                                {{ $employee->f_name }} {{ $employee->l_name }}</option>
                                @endforeach
                            @else

                            @endif
                        </select>
                    </div>


                    <div class="form-group form-group-bottom">
                        <label>Start Date <span class="required" aria-required="true">*</span></label>
    
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <i class="icon-fa icon-fa-calendar"></i>
                                </span>
                            </div>
                            <input type="text" name="start" class="form-control ls-datepicker autocomplete_off" data-date-format="yyyy-mm-dd" value="" required>
                        </div>
                    </div>

                    <div class="form-group form-group-bottom">
                        <label>End Date <span class="required" aria-required="true">*</span></label>
    
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <i class="icon-fa icon-fa-calendar"></i>
                                </span>
                            </div>
                            <input type="text" name="end" class="form-control ls-datepicker autocomplete_off" data-date-format="yyyy-mm-dd" value="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Leave Type <span class="required" aria-required="true">*</span></label>
                        <select class="form-control ls-select2" name="type"
                            style="width:100%;">
                            <option value="">Please Select..</option>
                            @if (!$leaveTypes->isEmpty())
                                @foreach($leaveTypes as $leaveTypes)
                                <option value="{{ $leaveTypes->id}}">
                                    {{ $leaveTypes->name }}</option>
                                @endforeach
                            @else

                            @endif
                        </select>
                    </div>

                    <div class="form-group form-group-bottom">
                        <label>Applied Date <span class="required" aria-required="true">*</span></label>
    
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <i class="icon-fa icon-fa-calendar"></i>
                                </span>
                            </div>
                            <input type="text" name="apply" class="form-control ls-datepicker autocomplete_off" data-date-format="yyyy-mm-dd" value="" required>
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