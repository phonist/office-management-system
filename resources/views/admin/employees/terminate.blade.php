@extends('admin.layouts.layout-basic')

@section('styles')
@endsection
@section('scripts')
<script src="{{ asset('/assets/admin/js/jquery.PrintArea.js') }}"></script>
<script src="/assets/admin/js/pages/datatables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs"
    crossorigin="anonymous"></script>
<script>
$('.delete').click(function () {
        var id = $(this).siblings('.employee_id').attr('id');
        $('#form-d-employee').attr('action', '/admin/employees/' + id + '/delete');
    });
</script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Employee <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('employeeTerminations.index') }}">Terminated
                    employee(s)</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Terminated List</h6>
                    </div>
                    <div class="actions">
                        <button class="btn btn-primary btn-sm" onclick="location.href='{{ route('users.export') }}'"> <i
                                class="icon-fa icon-fa-plus"></i> Export</button>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="responsive-datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Employee
                                    Id</th>
                                <th>Employee
                                    Name</th>
                                <th>Department</th>
                                <th>Job
                                    Title</th>
                                <th>Employment
                                    Status</th>
                                <th>Shift</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($employees->isEmpty())
                            <div class="card text-white bg-info text-sm-center">
                                <div class="card-body">
                                    <blockquote class="card-bodyquote">
                                        <p>Hi, you don't have any employee yet</p>
                                    </blockquote>
                                </div>
                            </div>
                            @else
                            @foreach($employees as $employee)
                            <tr>
                                <td>{{ $employee->id_number }}</td>
                                <td>{{ $employee->f_name }} {{ $employee->l_name }}</td>
                                @if(\App\JobHistory::where('employee_id',$employee->id)->exists())
                                <td>{{
                                    \App\Department::where('id',\App\JobHistory::where('employee_id',$employee->id)->first()->department_id)->first()->name
                                    }}</td>
                                <td>{{
                                    \App\JobTitle::where('id',\App\JobHistory::where('employee_id',$employee->id)->first()->title_id)->first()->title
                                    }}</td>
                                <td>{{
                                    \App\EmployeeStatus::where('id',\App\JobHistory::where('employee_id',$employee->id)->first()->status_id)->first()->status
                                    }}</td>
                                <td>{{
                                    \App\WorkShift::where('id',\App\JobHistory::where('employee_id',$employee->id)->first()->shift_id)->first()->name
                                    }}</td>
                                @else
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                @endif
                                <td>
                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                        <input type="hidden" class="employee_id" id="{{ $employee->id }}">
                                        <button type="button" class="btn btn-icon btn-outline-info" onclick="location.href='{{ route('employees.show',$employee->id) }}'"><i
                                                class="icon-fa icon-fa-search"></i></button>
                                        
                                        <button type="button" class="btn btn-icon btn-outline-danger delete" href="#" data-toggle="modal" data-target="#modal-delete"><i class="icon-fa icon-fa-trash"></i></button>
                                        
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    @include('admin.employees.delete')
</div>
@endsection