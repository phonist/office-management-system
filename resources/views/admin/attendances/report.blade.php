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
    $('.monthyear').datepicker( {
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });
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
            <li class="breadcrumb-item active"><a href="{{ route('client.index') }}">Attendance</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Attendance Report</h6>
                    </div>
                    <div class="actions">
                        <button class="btn btn-danger btn-sm" onclick="location.href='{{ route('attendances.export') }}'">
                            <i class="icon-fa icon-fa-cloud-upload"></i>
                            Export</button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('attendances.setReport') }}" class="form-horizontal" method="post"
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
                                        <input type="text" name="date" class="form-control ls-datepicker monthyear autocomplete_off"
                                            value="" data-date-format="yyyy-mm" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Department <span class="required">*</span></label>
                                <div class="col-sm-5">
                                    <select class="form-control select2" name="department_id" style="width: 100%;"
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
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-5">
                                    <button type="submit" class="btn bg-olive btn-md btn-flat">Go</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    @if($attendances == null)
                    @else
                    <div class="row">

                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header with-border bg-primary-dark">
                                    <h3 class="box-title">Attendance Report</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th class="active">Name</th>

                                                            @for($i = 1; $i<=$numberOfDays;$i++ ) <th class="active ">{{$i}}</th>
                                                                @endfor

                                                        </tr>

                                                    </thead>

                                                    <tbody>
                                                        
                                                        @foreach($employees as $employee)
                                                        <tr>
                                                            <td>{{
                                                                \App\Employee::where('id',$employee->employee_id)->first()->f_name
                                                                }} {{
                                                                \App\Employee::where('id',$employee->employee_id)->first()->l_name
                                                                }}</td>
                                                             @for($i = 1; $i<=$numberOfDays;$i++)
                                                                <td>
                                                                @foreach($attendances as $attendance)
                                                                    @if(\Carbon\Carbon::parse($attendance->date)->format('d')
                                                                    == $i && $attendance->employee_id == $employee->employee_id)
                                                                        @if($attendance->in != null && $attendance->out != null)
                                                                        <small class="label btn-default">On Duty</small>
                                                                        @else
                                                                        <small class="label btn-default">Holiday</small> 
                                                                        @endif
                                                                        @break
                                                                    @endif
                                                                @endforeach
                                                                </td>
                                                             @endfor
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection