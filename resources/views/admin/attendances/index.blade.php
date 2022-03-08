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
                                        <input type="text" name="date" class="form-control ls-datepicker autocomplete_off" value="" data-date-format="yyyy-mm-dd" required>
                                        
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
        </div>
    </div>
</div>
@endsection