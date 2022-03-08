<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">Add Supervisor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <form id="addSupervisor" action="{{ route('employeeSupervisors.store') }}" method="post">

            @csrf
            <div class="modal-body">

                <div class="form-group">
                    <label>Department<span class="required">*</span></label>
                    <select class="form-control" name="department_id" id="department" onchange="get_employee(this.value)">
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
                    <select class="form-control" name="supervisor_id" id="employee">
                        @if(!$employees->isEmpty())
                        <option value="">Please Select</option>
                        @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->f_name }} {{ $employee->l_name }}</option>
                        @endforeach
                        @else
                        <option value="">No Employee(s) in record</option>
                        @endif
                    </select>
                </div>
            </div>





            <div class="modal-footer">
                <input type="hidden" name="employee_id" id="employee_id" value="{{ $employee->id }}">

                <span class="required">*</span> Required field
                <button type="button" id="close" class="btn btn-danger btn-flat pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn bg-olive btn-flat" id="btn">Save</button>


            </div>
        </form>
    </div>
</div>