@extends('admin.layouts.layout-basic')

@section('styles')
@endsection
@section('scripts')
<script src="{{ asset('/assets/admin/js/jquery.PrintArea.js') }}"></script>
<script src="/assets/admin/js/pages/datatables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs"
    crossorigin="anonymous"></script>
<script>
    init();
    function init(){
        $('.autocomplete_off').attr('autocomplete','off');
    }
    $(document.body).on('change', '#parent_present', function () {
        if (this.checked) {
            $('.child_present').prop('checked', true)
        } else {
            $('.child_present').prop('checked', false);
        }
    });

    $(document.body).on('change', '#parent_present1', function () {
        if (this.checked) {
            $('.child_present1').prop('checked', true)
        } else {
            $('.child_present1').prop('checked', false);
        }
    });

    $(document.body).on('click', '.editSupervisor', function () {
        $supervisor_id = $(this).siblings('input').val();
        $('#editSupervisorform').attr('action', '/admin/employeeSupervisors/' + $supervisor_id);
        $.get('/admin/employeeSupervisors/' + $supervisor_id + '/edit', function (data) {
            $('.edit_department_id > option').each(function(){
                if($(this).val() == data['department_id']){
                    $(this).attr('selected','selected');
                }else{
                    $(this).removeAttr('selected');
                }
            });
            $('.edit_supervisor_id > option').each(function(){
                if($(this).val() == data['supervisor_id']){
                    $(this).attr('selected','selected');
                }else{
                    $(this).removeAttr('selected');
                }
            });
           
        });
    });

    $(document.body).on('click', '.editSubordinate', function () {
        $subordinate_id = $(this).siblings('input').val();
        $('#editSubordinate').attr('action', '/admin/employeeSubordinates/' + $subordinate_id);
        $.get('/admin/employeeSubordinates/' + $subordinate_id + '/edit', function (data) {
            $('.edit_s_department_id > option').each(function(){
                if($(this).val() == data['department_id']){
                    $(this).attr('selected','selected');
                }else{
                    $(this).removeAttr('selected');
                }
            });
            $('.edit_s_subordinate_id > option').each(function(){
                if($(this).val() == data['subordinate_id']){
                    $(this).attr('selected','selected');
                }else{
                    $(this).removeAttr('selected');
                }
            });
        });
    });
    var personalForm = $("#personalForm");
    $("#personalForm :input").attr("disabled", true);
    $('#editPersonal').click(function (event) {
        //event.preventDefault();
        personalForm.find(':disabled').each(function () {
            $(this).removeAttr('disabled');
            $('#cancelPersonal').show();
            $('#savePersonal').show();
            $('#editPersonal').hide();
        });
    });

    $('#cancelPersonal').click(function (event) {
        //event.preventDefault();
        personalForm.find(':enabled').each(function () {
            $(this).attr("disabled", "disabled");
            $('#cancelPersonal').hide();
            $('#savePersonal').hide();
            $('#editPersonal').show();
        });
    });
</script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Employee <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('employees.index') }}">Report To</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-3">
            @include('admin.employees.sidebar')
        </div>
        <div class="col-lg-9 col-md-9 col-xs-9">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Assigned Supervisors</h6>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('employeeSupervisors.delete') }}" method="post" accept-charset="utf-8">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">



                                <a data-target="#addEmployeeSupervisor" title="View" data-placement="top" data-toggle="modal"
                                    href="#" class="btn bg-primary btn-md btn-flat">
                                    <i class="fa fa-plus"></i> Add Supervisor </a>

                                <button type="submit" onclick="return confirm('Are you sure want to delete this record ?');"
                                    class="btn btn-danger btn-md btn-flat" id="deletePersonalAttach"><i class="fa fa-trash"></i>
                                    Delete </button>

                                <br>
                                <br>

                                <!-- Table -->
                                <div class="table-responsive">
                                    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="active">
                                                    <label class="css-input css-checkbox css-checkbox-danger">
                                                        <input type="checkbox" id="parent_present"><span></span>
                                                    </label>
                                                </th>
                                                <th class="active">Employee</th>
                                                <th class="active">Supervisor</th>
                                                <th class="active">Actions</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if($supervisors == "" || $supervisors == null)
                                            <div class="card text-white bg-info text-sm-center">
                                                <div class="card-body">
                                                    <blockquote class="card-bodyquote">
                                                        <p>Hi, this employee don't have any supervisor(s) yet</p>
                                                    </blockquote>
                                                </div>
                                            </div>
                                            @else
                                            @foreach($supervisors as $supervisor)
                                            <tr>
                                                <td>
                                                    <label class="css-input css-checkbox css-checkbox-success">
                                                        <input name="supervisorId[]" value="{{ $supervisor->id }}" type="checkbox"
                                                            class="child_present"><span></span>
                                                    </label>
                                                </td>
                                                <td>{{
                                                    \App\Employee::where('id',$supervisor->employee_id)->first()->f_name
                                                    }} {{
                                                    \App\Employee::where('id',$supervisor->employee_id)->first()->l_name
                                                    }}</td>
                                                <td>{{
                                                    \App\Employee::where('id',$supervisor->supervisor_id)->first()->f_name
                                                    }} {{
                                                    \App\Employee::where('id',$supervisor->supervisor_id)->first()->l_name
                                                    }}</td>
                                                <td>


                                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                                        <input type="hidden" value="{{ $supervisor->id }}">

                                                        <button type="button" class="btn btn-icon btn-outline-info editSupervisor"
                                                            data-target="#editSupervisor" title="View" data-placement="top"
                                                            data-toggle="modal"><i class="icon-fa icon-fa-pencil"></i></button>
                                                    </div>
                                                </td>

                                            </tr>
                                            @endforeach
                                            @endif

                                        </tbody>

                                    </table>
                                    <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                                </div>




                            </div>
                        </div>


                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Assigned Subordinates</h6>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('employeeSubordinates.delete') }}" method="post" accept-charset="utf-8">
                        @csrf

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <a data-target="#addEmployeeSubordinate" title="View" data-placement="top" data-toggle="modal"
                                    href="#" class="btn bg-primary btn-md btn-flat">
                                    <i class="fa fa-plus"></i> Add Subordinate </a>
                                <button type="submit" onclick="return confirm('Are you sure want to delete this record ?');"
                                    class="btn btn-danger btn-md btn-flat"><i class="fa fa-trash"></i>
                                    Delete </button>

                                <br>
                                <br>

                                <div class="table-responsive">
                                    <table id="table2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="active">
                                                    <label class="css-input css-checkbox css-checkbox-danger">
                                                        <input type="checkbox" id="parent_present1"><span></span>
                                                    </label>
                                                </th>
                                                <th class="active">Employee</th>
                                                <th class="active">Subordinate</th>
                                                <th class="active">Actions</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if($subordinates == "" || $subordinates == null)

                                            <div class="card text-white bg-info text-sm-center">
                                                <div class="card-body">
                                                    <blockquote class="card-bodyquote">
                                                        <p>Hi, this employee don't have any subordinate(s) yet</p>
                                                    </blockquote>
                                                </div>
                                            </div>
                                            @else
                                            @foreach($subordinates as $subordinate)
                                            <tr>
                                                <td>
                                                    <label class="css-input css-checkbox css-checkbox-success">
                                                        <input name="subordinateId[]" value="{{ $subordinate->id }}"
                                                            type="checkbox" class="child_present1"><span></span>
                                                    </label>
                                                </td>
                                                <td>{{
                                                    \App\Employee::where('id',$subordinate->employee_id)->first()->f_name}}
                                                    {{
                                                    \App\Employee::where('id',$subordinate->employee_id)->first()->l_name}}</td>
                                                <td>{{
                                                    \App\Employee::where('id',$subordinate->subordinate_id)->first()->f_name}}
                                                    {{
                                                    \App\Employee::where('id',$subordinate->subordinate_id)->first()->l_name}}</td>
                                                <td>

                                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                                        <input type="hidden" value="{{ $subordinate->id }}">

                                                        <button type="button" class="btn btn-icon btn-outline-info editSubordinate"
                                                            data-target="#editEmployeeSubordinate" title="View"
                                                            data-placement="top" data-toggle="modal"><i class="icon-fa icon-fa-pencil"></i></button>
                                                    </div>
                                                </td>

                                            </tr>
                                            @endforeach
                                            @endif

                                        </tbody>

                                    </table>
                                    <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                                </div>



                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.row (main row) -->
<div class="modal fade" id="addEmployeeSupervisor" style="display: none;">
    @include('admin.employeeReportTo.createSupervisor')
</div>
<div class="modal fade" id="editSupervisor" style="display: none;">
    @include('admin.employeeReportTo.editSupervisor')
</div>
<div class="modal fade" id="addEmployeeSubordinate" style="display: none;">
    @include('admin.employeeReportTo.createSubordinate')
</div>
<div class="modal fade" id="editEmployeeSubordinate" style="display: none;">
    @include('admin.employeeReportTo.editSubordinate')
</div>
<div class="modal fade" id="addTerminationModal" style="display: none;">
    @include('admin.employeeTerminations.create')
</div>
@endsection