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
    var depositForm = $("#depositForm");
    $("#depositForm :input").attr("disabled", true);
    $('#editDeposit').click(function (event) {
        //event.preventDefault();
        depositForm.find(':disabled').each(function () {
            $(this).removeAttr('disabled');
            $('#cancelDeposit').show();
            $('#saveDeposit').show();
            $('#editDeposit').hide();
        });
    });

    $('#cancelDeposit').click(function (event) {
        //event.preventDefault();
        depositForm.find(':enabled').each(function () {
            $(this).attr("disabled", "disabled");
            $('#cancelDeposit').hide();
            $('#saveDeposit').hide();
            $('#editDeposit').show();
        });
    });
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
        $('#editSupervisorform').attr('action', '/employeeSupervisors/' + $supervisor_id);
        $.get('/employeeSupervisors/' + $supervisor_id + '/edit', function (data) {
            $('.edit_department_id').prepend('<option selected value="' + data['department'] + '">' +
                data['department'] + '</option>');
            $('.edit_supervisor_id').prepend('<option selected value="' + data['employee'] + '">' +
                data['employee'] + '</option>');
        });
    });

    $(document.body).on('click', '.editSubordinate', function () {
        $subordinate_id = $(this).siblings('input').val();
        $('#editSubordinate').attr('action', '/employeeSubordinates/' + $subordinate_id);
        $.get('/employeeSubordinates/' + $subordinate_id + '/edit', function (data) {
            $('.edit_s_department_id').prepend('<option selected value="' + data['department'] + '">' +
                data['department'] + '</option>');
            $('.edit_s_subordinate_id').prepend('<option selected value="' + data['employee'] + '">' +
                data['employee'] + '</option>');
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
            <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">Dependents</a></li>
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
                        <h6>Employee Login</h6>
                    </div>
                </div>
                <form action="{{ route('employeeLogins.update',$login->id) }}" method="post" accept-charset="utf-8">
                    @method('put')
                    @csrf
                    <div class="card-body">
                        <div class="col-md-12">
                            @if(Session::has('success'))
                            <button class="btn btn-success" data-toastr="success" data-message="{{ Session::get('success') }}"
                                data-title="Success!">
                            </button>
                            @endif
                            @if(Session::has('failure'))
                            <button class="btn btn-danger" data-toastr="error" data-message="{{ Session::get('failure') }}"
                                data-title="Error!">
                            </button>
                            @endif
                            @if(Session::has('warning'))
                            <button class="btn btn-warning" data-toastr="warning" data-message="{{ Session::get('warning') }}"
                                data-title="Warning!">
                            </button>
                            @endif
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Login Id</label>
                                        <input type="text" class="form-control autocomplete_off" name="username" value="{{ $login->name }}"
                                            readonly="">

                                    </div>

                                    <div class="form-group">
                                        <label>Password<span class="required">*</span></label>
                                        <input type="password" class="form-control autocomplete_off" name="password"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label>Retype Password<span class="required">*</span></label>
                                        <input type="password" name="retype_password" class="form-control autocomplete_off"
                                            required>
                                    </div>


                                    <div class="form-group">
                                        <label>Active/Deactive</label>
                                        <label class="css-input switch switch-sm switch-success">
                                            <input name="activate" checked="" type="checkbox"><span></span>
                                        </label>
                                    </div>



                                </div>
                            </div>


                        </div>





                        <div class="card-footer">
                            <span class="required">*</span> Required field
                            <button id="saveSalary" type="submit" class="btn bg-olive btn-flat">
                                Update Password </button>

                        </div>


                </form>






            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="addTerminationModal" style="display: none;">
    @include('admin.employeeTerminations.create')
</div>


@endsection