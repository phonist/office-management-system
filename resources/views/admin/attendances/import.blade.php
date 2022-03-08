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
                        <h6>Import Attendance</h6>
                    </div>
                    <div class="actions">
                        <button class="btn btn-danger btn-sm" onclick="location.href='{{ route('attendances.import') }}'">
                            <i class="icon-fa icon-fa-cloud-upload"></i>
                            Import</button>
                    </div>
                </div>
                <div class="card-body">
                        <form action="{{ route('attendances.importAttendance') }}" enctype="multipart/form-data" method="post"
                        accept-charset="utf-8">
                        @csrf
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-12">
    
                                            <div class="row">
    
                                                <div class="col-md-10">
    
                                                    <strong>Download Sample CSV File</strong><br>
                                                    <p>Import employee attendance use <strong>Employee ID</strong> Search
                                                        from bellow Table</p>
                                                    <p>Attendance Status: 1 = Present | 0 = Absent | 3 = On leave</p>
                                                    <p>Date Format: Year-Month-Date | 2017-01-31</p>
                                                    <a href="{{ route('attendances.download') }}"><i class="fa fa-download"
                                                            aria-hidden="true"></i> Sample CSV File</a>
    
                                                    <div class="form-group">
                                                        <label>Import Attendance</label>
                                                        <input type="file" name="importAttendance" class="form-control">
                                                    </div>
                                                </div>
    
                                            </div>
                                        </div>
                                    </div>
    
                                    <button class="btn btn-primary" type="submit" value="Submit"><i class="fa fa-upload"></i>
                                        Import Attendance</button>
                                </div>
    
                                <div class="col-md-7">
    
    
    
                                    <br>
                                    <div class="container gc-container">
                                        <div class="success-message hidden"></div>
    
                                        <div class="row">
                                            <div class="table-section">
                                                <div class="table-container table-responsive">

                                                    <table class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Employee
                                                                    id</th>
                                                                <th>First
                                                                    name</th>
                                                                <th>Last
                                                                    name</th>
                                                                <th>Department</th>
                                                                <th>Job
                                                                    Title</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($employees as $employee)
                                                            <tr>
                                                                <td>{{ $employee->id_number }}</td>
                                                                <td>{{ $employee->f_name }}</td>
                                                                <td>{{ $employee->l_name }}</td>
                                                                @if(\App\JobHistory::where('employee_id',$employee->id)->exists())
                                                                <td>{{
                                                                    \App\Department::where('id',\App\JobHistory::where('employee_id',$employee->id)->first()->department_id)->first()->name
                                                                    }}</td>
                                                                <td>{{
                                                                    \App\JobTitle::where('id',\App\JobHistory::where('employee_id',$employee->id)->first()->title_id)->first()->title
                                                                    }}</td>
    
                                                                @else
                                                                <td>-</td>
                                                                <td>-</td>
                                                                @endif
    
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
