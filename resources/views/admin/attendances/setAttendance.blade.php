@extends('admin.layouts.layout-basic')

@section('styles')
@endsection
@section('scripts')
<script src="/assets/admin/js/pages/notifications.js"></script>
<script src="/assets/admin/js/pages/datatables.js"></script>
<script>
init();
function init(){
    $('.autocomplete_off').attr('autocomplete','off');  
}
$(document.body).on('change', '#parentAttendanceCheckbox', function () {
    if (this.checked) {
        $('.child_present').prop('checked', true)
    } else {
        $('.child_present').prop('checked', false);
    }
});

$(document.body).on('change', '#parentLeaveCheckbox', function () {
    if (this.checked) {
        $('.child_absent').prop('checked', true)
    } else {
        $('.child_absent').prop('checked', false)
    }
});

       
</script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Attendance <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('attendances.index') }}">Attendance</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Set Attendance</h6>
                    </div>
                    <div class="actions">
                        <button class="btn btn-danger btn-sm" onclick="location.href='{{ route('attendances.import') }}'">
                            <i class="icon-fa icon-fa-cloud-upload"></i>
                            Import</button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('attendances.store') }}" class="form-horizontal" method="post"
                        accept-charset="utf-8">
                        @csrf
                        <div class="panel_controls">
                            <div class="form-group margin">
                                <label class="col-sm-3 control-label">Date <span class="required">*</span></label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                            <i class="icon-fa icon-fa-calendar"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="date" class="form-control ls-datepicker autocomplete_off" value="{{ Carbon\Carbon::parse($date)->format('Y-m-d') }}" data-date-format="yyyy-mm-dd" required>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Department <span class="required">*</span></label>
                                <div class="col-sm-5">
                                    <select class="form-control select2" name="department_id" style="width: 100%;">
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
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-5">
                                    <button type="submit" class="btn bg-olive btn-md btn-flat">Go</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">

                <div class="card-header bg-info">
                    <div class="caption">
                        @if(\App\Department::where('id',$department_id)->exists())
                        <h6 class="box-title">{{ \App\Department::where('id',$department_id)->first()->name }}
                            Department Attendance</h6>
                        @else
                        <h6>No Selected Department</h6>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('attendances.updateAttendance') }}" class="form-horizontal" method="post"
                        accept-charset="utf-8">
                        @csrf
                        <input type="hidden" name="date" value="{{$date}}">
                        <input type="hidden" name="department" value="{{ $department_id }}">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <th>Employee Id</th>
                                        <th>Employee</th>
                                        <th>Job Title</th>
                                        <th><input type="checkbox" id="parentAttendanceCheckbox">
                                            Attendance</th>
                                        <th><input type="checkbox" id="parentLeaveCheckbox">
                                            Leave Category</th>
                                    </thead>

                                    <tbody>
                                        @foreach($attendances as $attendance)
                                        <tr>
                                            <td>{{
                                                \App\Employee::where('id',$attendance->employee_id)->first()->id_number
                                                }}
                                                <input type="hidden" value="{{$attendance->employee_id}}" name="employee_id[]"></td>
                                            <td>{{
                                                \App\Employee::where('id',$attendance->employee_id)->first()->f_name
                                                }}
                                                {{
                                                \App\Employee::where('id',$attendance->employee_id)->first()->l_name
                                                }}</td>
                                            <td>{{
                                                \App\JobTitle::where('id',\App\JobHistory::where('employee_id',$attendance->employee_id)->first()->title_id)->first()->title
                                                }}</td>
                                            <td>
                                                <div class="col-sm-2">
                                                    <input name="attendance[]" value="{{ $attendance->id }}" type="checkbox"
                                                        class="child_present">

                                                </div>
                                                <div id="check_in" class="col-md-12">
                                                    <div class="form-group row">
                                                        
                                                        <div class="col-md-6">
                                                            
                                                            <div class="bootstrap-timepicker">
                                                                    <label class="control-label">In</label>
                                                                <div class="form-group">
                                                                    
                                                                    <div class="input-group">
                                                                        @if($attendance->in == null)
                                                                        <input type="text" name="in[]" class="form-control ls-timepicker" value="" data-duration="true">
                                                                        @else
                                                                        <input type="text" name="in[]" class="form-control ls-timepicker" value="{{ $attendance->in }}" data-duration="true">
                                                                        @endif
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">
                                                                                <i class="icon-fa icon-fa-clock-o"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <label class="control-label">Out</label>
                                                            <div class="bootstrap-timepicker">
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        @if($attendance->out == null)
                                                                        <input type="text" name="out[]" class="form-control ls-timepicker" value="" data-duration="true">
                                                                        @else
                                                                        <input type="text" name="out[]" class="form-control ls-timepicker" value="{{ $attendance->out }}" data-duration="true">
                                                                        @endif
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
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-sm-2">
                                                    <input type="checkbox" value="{{ $attendance->id }}" class="child_absent">
                                                </div>
                                                <div id="l_category" class="col-sm-10">
                                                    <select name="leave_category_id[]" class="form-control">

                                                        @if(!$leave->isEmpty())
                                                        <option value="">Select Leave Category...</option>
                                                        @foreach($leave as $leav)
                                                        @if(!$attendance->leave_id == $leav->id)
                                                        <option value="{{ $leav->id }}" selected>{{ $leav->name }}</option>
                                                        @else
                                                        <option value="{{ $leav->id }}">{{ $leav->name }}</option>
                                                        @endif

                                                        @endforeach
                                                        @else
                                                        <option value="">There is no leave record in database</option>
                                                        @endif

                                                    </select>
                                                </div>

                                            </td>
                                        </tr>

                                        @endforeach
                                    </tbody>


                                </table>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-5">
                                    <button type="submit" class="btn bg-olive btn-md btn-flat">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection