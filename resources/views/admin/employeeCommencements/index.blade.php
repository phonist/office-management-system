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

    function init() {
        $('.autocomplete_off').attr('autocomplete', 'off');
    }
    $("#ContactForm :input").attr("disabled", true);
    var contactForm = $("#ContactForm");
    $('#editContact').click(function (event) {
        //event.preventDefault();
        contactForm.find(':disabled').each(function () {
            $(this).removeAttr('disabled');
            $('#saveContact').show();
            $('#cancelContact').show();
            $('#editContact').hide();
        });
    });

    $('#cancelContact').click(function (event) {
        //event.preventDefault();
        contactForm.find(':enabled').each(function () {
            $(this).attr("disabled", "disabled");
            $('#saveContact').hide();
            $('#cancelContact').hide();
            $('#editContact').show();
        });
    });
    $(document.body).on('click', '.editJobHistory', function () {
        $job_id = $(this).siblings('input').val();
        $('#editJob').attr('action', '/admin/jobHistories/' + $job_id);
        $.get('/admin/jobHistories/' + $job_id + '/edit', function (data) {
            
            $('.edit_effective_from').val(data['effective_from']);
            $('.edit_department > option').each(function(){
                if($(this).val() == data['department_id']){
                    $(this).attr('selected','selected');
                }else{
                    $(this).removeAttr('selected');
                }
            });
            $('.edit_title > option').each(function(){
                if($(this).val() == data['title_id']){
                    $(this).attr('selected','selected');
                }else{
                    $(this).removeAttr('selected');
                }
            });
            $('.edit_category > option').each(function(){
                if($(this).val() == data['category_id']){
                    $(this).attr('selected','selected');
                }else{
                    $(this).removeAttr('selected');
                }
            });
            $('.edit_status > option').each(function(){
                if($(this).val() == data['status_id']){
                    $(this).attr('selected','selected');
                }else{
                    $(this).removeAttr('selected');
                }
            });
            $('.edit_work_shift > option').each(function(){
                if($(this).val() == data['shift_id']){
                    $(this).attr('selected','selected');
                }else{
                    $(this).removeAttr('selected');
                }
            });
        });
    });
    $(document.body).on('change', '#parent_present', function () {
        if (this.checked) {
            $('.child_present').prop('checked', true)
        } else {
            $('.child_present').prop('checked', false);
        }
    });

    $(document.body).on('click', '.editEmployeeDependent', function () {
        $dependent_id = $(this).siblings('.dependent_id').val();
        $.get('/admin/employeeDependents/' + $dependent_id + '/edit', function (data) {
            $('.edit_name').val(data['name']);
            $('.edit_relationship').val(data['relationship']);
            $('.edit_dob').val(data['dob']);
        });
        $('#editdependent').attr('action', '/admin/employeeDependents/' + $dependent_id);
    });
</script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Employee <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('employees.index') }}">Employment Commencement</a></li>
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
                        <h6>Dependents</h6>
                    </div>
                </div>
                <form action="{{ route('employeeCommencements.store') }}" id="ContactForm" class="ContactForm" method="post"
                    accept-charset="utf-8">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Joined Date<span class="required">*</span></label>


                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="icon-fa icon-fa-calendar"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="joined_date" class="form-control ls-datepicker autocomplete_off"
                                            data-date-format="yyyy-mm-dd" value="{{ $commencement->join_date }}"
                                            disabled="disabled" required>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label>Date of Permanency <span class="required">*</span></label>


                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="icon-fa icon-fa-calendar"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="date_of_permanency" class="form-control ls-datepicker autocomplete_off"
                                            data-date-format="yyyy-mm-dd" value="{{ $commencement->dop }}" disabled="disabled"
                                            required>
                                    </div>
                                </div>

                                <span class="required">*</span>Required field
                            </div>



                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Probation End Date<span class="required">*</span></label>


                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="icon-fa icon-fa-calendar"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="probation_end_date" class="form-control ls-datepicker autocomplete_off"
                                            data-date-format="yyyy-mm-dd" value="{{ $commencement->probation_end }}"
                                            disabled="disabled" required>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <input type="hidden" name="employee_id" value="{{ $commencement->employee_id }}" disabled="disabled">


                    </div>
                    <div class="card-footer">
                        <a class="btn bg-info btn-flat" id="editContact"><i class="fa fa-pencil-square-o"></i>Edit</a>
                        <button id="saveContact" type="submit" class="btn bg-success btn-flat" style="display:none ;"
                            disabled="disabled">Save</button>&nbsp;&nbsp;&nbsp;
                        <a class="btn bg-danger btn-flat" id="cancelContact" style="display: none;">Cancel</a>
                    </div>

                </form>
            </div>

            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Job History</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <form action="{{ route('jobHistories.delete') }}" method="post" accept-charset="utf-8">
                                @csrf

                                <a data-target="#addNewJobHistory" title="View" data-placement="top" data-toggle="modal"
                                    href="#" class="btn bg-info btn-md btn-flat">
                                    <i class="fa fa-plus"></i> Add New Job </a>
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
                                                <!--                                    <th class="col-sm-1 active" style="width: 21px"><input type="checkbox" class="checkbox-inline" id="parent_present" /></th>-->
                                                <th class="active">
                                                    <label class="css-input css-checkbox css-checkbox-danger">
                                                        <input type="checkbox" id="parent_present"><span></span>
                                                    </label>
                                                </th>
                                                <th class="active">Effective</th>
                                                <th class="active">Department</th>
                                                <th class="active">Job Title</th>
                                                <th class="active">Job Type</th>
                                                <th class="active">Shift</th>
                                                <th class="active">Status</th>
                                                <th class="active">Actions</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if($jobHistories == null || $jobHistories == "")

                                            <div class="card text-white bg-info text-sm-center">
                                                <div class="card-body">
                                                    <blockquote class="card-bodyquote">
                                                        <p>Hi, this user don't have any job history(s) yet</p>
                                                    </blockquote>
                                                </div>
                                            </div>
                                            @else
                                            @foreach($jobHistories as $job)
                                            <tr>
                                                <td>
                                                    <label class="css-input css-checkbox css-checkbox-success">
                                                        <input name="jobId[]" value="{{ $job->id }}" type="checkbox"
                                                            class="child_present"><span></span>
                                                    </label>
                                                </td>
                                                <td>{{
                                                    Carbon\Carbon::parse($job->effective_from)->format('d M
                                                    Y') }}</td>
                                                <td>{{
                                                    \App\Department::where('id',$job->department_id)->first()->name
                                                    }}</td>
                                                <td>{{
                                                    \App\JobTitle::where('id',$job->title_id)->first()->title
                                                    }}</td>
                                                <td>{{
                                                    \App\JobCategory::where('id',$job->category_id)->first()->category
                                                    }}</td>
                                                <td>{{
                                                    \App\WorkShift::where('id',$job->shift_id)->first()->name
                                                    }}</td>
                                                <td>
                                                    <a type="button" class="btn btn-success btn-xs">{{
                                                        \App\EmployeeStatus::where('id',$job->status_id)->first()->status
                                                        }}</a>
                                                </td>
                                                <td>
                                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                                        <input type="hidden" class="job_hist" value="{{ $job->id }}">

                                                        <button type="button" class="btn btn-icon btn-outline-info editJobHistory"
                                                            data-target="#editJobHistory" data-placement="top"
                                                            data-toggle="modal"><i class="icon-fa icon-fa-pencil"></i></button>
                                                    </div>

                                                </td>

                                            </tr>
                                            @endforeach
                                            @endif


                                        </tbody>

                                    </table>
                                </div>

                                <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addNewJobHistory" style="display: none;">
    @include('admin.jobHistories.create')
</div>
<div class="modal fade" id="editJobHistory" style="display: none;">
    @include('admin.jobHistories.edit')
</div>
<div class="modal fade" id="addTerminationModal" style="display: none;">
    @include('admin.employeeTerminations.create')
</div>


@endsection