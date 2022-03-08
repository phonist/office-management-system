@extends('admin.layouts.layout-basic')

@section('styles')
@endsection
@section('scripts')
<script src="{{ asset('/assets/admin/js/jquery.PrintArea.js') }}"></script>
<script src="/assets/admin/js/pages/datatables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js"
    integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs" crossorigin="anonymous">
</script>
<script>
    init();

    function init() {
        $('.autocomplete_off').attr('autocomplete', 'off');
    }
    $('#modalSmall').on('hidden.bs.modal', function () {
        location.reload();
    });

    $("#btn").click(function () {

        $("#holiday").validate({
            excluded: ':disabled',
            rules: {
                event_name: {
                    required: true
                },
                description: {
                    required: true
                },

                start_date: {
                    required: true
                },
                end_date: {
                    greaterThanDate: "#start_date"
                }

            },

            highlight: function (element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorElement: 'span',
            errorClass: 'help-block animated fadeInDown',
            errorPlacement: function (error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        })
    });


    // start date end date validation
    jQuery.validator.addMethod("greaterThanDate",
        function (value, element, params) {


            if (!/Invalid|NaN/.test(new Date(value))) {
                return new Date(value) >= new Date($(params).val());
            }

            return Number(value) >= Number($(params).val());
        }, 'End Date Must be greater than Start Date.');

    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
    });
    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
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
    $(document.body).on('change', '#parent_present', function () {
        if (this.checked) {
            $('.child_present').prop('checked', true)
        } else {
            $('.child_present').prop('checked', false);
        }
    });

    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
    });
    $("#btn").click(function () {

        $("#personalAttach").validate({
            excluded: ':disabled',
            rules: {

                description: {
                    required: true
                },
                file: {
                    required: true
                },



            },

            highlight: function (element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorElement: 'span',
            errorClass: 'help-block animated fadeInDown',
            errorPlacement: function (error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        })
    });

    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
    });
</script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Employee <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('employees.index') }}">Employee List</a></li>
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
                        <h6>Personal Details</h6>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('employees.update',$employee->id ) }}" id="personalForm"
                        enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Role<span class="required" aria-required="true">*</span></label>
                                            <select class="form-control" name="role" disabled="disabled">
                                                @foreach($roles as $role)
                                                @if($employee->hasRole($role->name))
                                                <option value="{{ $role->id }}" selected>{{
                                                        $role->display_name }}</option>
                                                @else
                                                <option value="{{ $role->id }}">{{
                                                    $role->display_name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>First Name<span class="required"
                                                    aria-required="true">*</span></label>
                                            <input type="text" name="first_name" value="{{$employee->f_name}}"
                                                class="form-control" disabled="disabled" required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Last Name<span class="required" aria-required="true">*</span></label>
                                            <input type="text" name="last_name" value="{{$employee->l_name}}"
                                                class="form-control" disabled="disabled" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email<span class="required" aria-required="true">*</span></label>
                                            <input type="email" name="email" value="{{$employee->email}}"
                                                class="form-control" disabled="disabled" required>
                                        </div>
                                    </div>

                                   

                                    <div class="col-md-6">

                                        <!-- /.Start Date -->
                                        <div class="form-group form-group-bottom">
                                            <label>Date of Birth <span class="required"
                                                    aria-required="true">*</span></label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="icon-fa icon-fa-calendar"></i>
                                                    </span>
                                                </div>
                                                <input name="date_of_birth" type="text" class="form-control ls-datepicker autocomplete_off"
                                                    value="{{ $employee->dob }}" data-date-format="yyyy-mm-dd" disabled="disabled" required>
                                            </div>

                                            
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Marital Status</label>
                                            <select class="form-control input-md" name="marital_status" disabled="disabled">
                                                @if($employee->marital_status == 'Single')
                                                <option value="Married">Married</option>
                                                <option value="Single" selected>Single</option>
                                                @elseif($employee->marital_status == 'Married')
                                                <option value="Single">Single</option>
                                                <option value="Married" selected>Married</option>
                                                @else
                                                <option value="">Please Select..</option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                @endif
                                                
                                               
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country <span class="required" aria-required="true">*</span></label>
                                            <select class="form-control" name="country" disabled="disabled">

                                                <option value="{{ $employee->country }}" selected>{{
                                                    $employee->country }}</option>

                                                <option value="Singapore">Singapore</option>
                                                <option value="Malaysia">Malaysia</option>
                                                <option value="China">China</option>
                                                <option value="Myanmar">Myanmar</option>
                                                <option value="Brunei">Brunei</option>
                                                <option value="Indonesia">Indonesia</option>
                                                <option value="Thailand">Thailand</option>
                                                <option value="Philipine">Philipine</option>
                                                <option value="Australia">Australia</option>
                                                <option value="UK">UK</option>
                                                <option value="Korea">Korea</option>
                                                <option value="Japan">Japan</option>
                                                <option value="Hong Kong">Hong Kong</option>
                                                <option value="Taiwan">Taiwan</option>

                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Blood Group</label>
                                            <select class="form-control" name="blood_group" disabled="disabled">
                                                <option value="{{ $employee->blood_group }}" selected>{{
                                                    $employee->blood_group }}</option>

                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="AB">AB</option>
                                                <option value="O">O</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label>ID Number</label>
                                    <input type="text" name="id_number" value="{{ $employee->id_number }}"
                                        class="form-control autocomplete_off" disabled="disabled">
                                </div>

                                <div class="form-group">
                                    <label>Religious </label>
                                    <select class="form-control" name="religious" disabled="disabled">
                                        <option value="{{ $employee->religious }}" selected>{{
                                            $employee->religious }}</option>
                                        <option value="Christians">Christians</option>
                                        <option value="Muslims">Muslims</option>
                                        <option value="Hindus">Hindus</option>
                                        <option value="Buddhists">Buddhists</option>
                                        <option value="Jews">Jews</option>
                                    </select>

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Gender<span class="required" aria-required="true">*</span></label>
                                            @if($employee->gender == "Male")
                                            <label class="css-input css-radio css-radio-success push-10-r">
                                                <input name="gender" value="Male" checked="" type="radio"
                                                    disabled="disabled"><span></span>Male
                                            </label>
                                            <label class="css-input css-radio css-radio-success push-10-r">
                                                <input name="gender" value="Female" type="radio"
                                                    disabled="disabled"><span></span>Female
                                            </label>
                                            @else
                                            <label class="css-input css-radio css-radio-success push-10-r">
                                                <input name="gender" value="Male" type="radio"
                                                    disabled="disabled"><span></span>Male
                                            </label>
                                            <label class="css-input css-radio css-radio-success push-10-r">
                                                <input name="gender" value="Female" checked="" type="radio"
                                                    disabled="disabled"><span></span>Female
                                            </label>
                                            @endif
                                        </div>
                                    </div>
                                </div>



                                <!-- /.Employee Image -->
                                <div class="form-group">
                                    @if($employee->photo != NULL)
                                    <img src="/employeesPhoto/{{ $employee->photo }}" alt="{{ $employee->photo }}"
                                        style="max-width:200px;max-height:200px">
                                    @else
                                    <img src="{{asset('/assets/admin/img/avatars/user.png')}}" alt="Avatar" style="max-width:200px;max-height:200px"></a>
                                    @endif</div>
                                <div class="form-group">
                                    <input type="file" name="employee_photo" id="file-1" class="inputfile inputfile-1"
                                        data-multiple-caption="{count} files selected" disabled="disabled">


                                </div>
                                <!-- /.Employee Image -->
                                <p class="text-muted">Accepts jpg, .png, .gif up to 1MB. Recommended
                                    dimensions: 200px X 200px</p>
                                <p class="text-muted"><span class="required" aria-required="true">*</span>Required
                                    field</p>

                            </div>
                        </div>

                        <input type="hidden" name="tab_view" value="personal" disabled="disabled">

                        <div class="box-footer">
                            <a class="btn bg-info btn-flat btn-md" id="editPersonal"><i
                                    class="fa fa-pencil-square-o"></i>
                                Edit</a>
                            <button id="savePersonal" type="submit" class="btn bg-success btn-flat"
                                style="display: none;" disabled="disabled">Save</button>&nbsp;&nbsp;&nbsp;
                            <a class="btn bg-danger btn-flat" id="cancelPersonal" style="display: none;">Cancel</a>

                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Attachment</h6>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <form action="{{ route('employeeAttachments.delete') }}" method="post" accept-charset="utf-8">

                                @csrf

                                <a data-target="#addAttachmentModal" title="View" data-placement="top"
                                    data-toggle="modal" href="#" class="btn bg-info btn-md btn-flat">
                                    <i class="fa fa-plus"></i> Add Attachment </a>
                                @if($attachments == "" || $attachments == null)



                                @else
                                <button type="submit"
                                    onclick="return confirm('Are you sure want to delete this record ?');"
                                    class="btn btn-danger btn-md btn-flat" id="deletePersonalAttach"><i
                                        class="fa fa-trash"></i>Delete
                                </button>
                                @endif
                                <br>
                                <br>

                                <!-- Table -->
                                <table id="table" class="table table-striped table-bordered" cellspacing="0"
                                    width="100%">

                                    <thead>
                                        <tr>
                                            <!--                                    <th class="col-sm-1 active" style="width: 21px"><input type="checkbox" class="checkbox-inline" id="parent_present" /></th>-->
                                            <th class="active">
                                                <label class="css-input css-checkbox css-checkbox-danger">
                                                    <input type="checkbox" id="parent_present"><span></span>
                                                </label>
                                            </th>
                                            <th class="active">File Name</th>
                                            <th class="active">Description</th>
                                            <th class="active">Date Added</th>
                                            <th class="active">Added By</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if($attachments == "" || $attachments == null)

                                        <div class="card text-white bg-info text-sm-center">
                                            <div class="card-body">
                                                <blockquote class="card-bodyquote">
                                                    <p>Hi, this user don't have any attachments yet</p>

                                                </blockquote>
                                            </div>
                                        </div>
                                        @else
                                        @foreach($attachments as $attachment)
                                        <tr>
                                            <td>
                                                <label class="css-input css-checkbox css-checkbox-success">
                                                    <input name="personalAttach[]" value="{{$attachment->id}}"
                                                        type="checkbox" class="child_present"><span></span>
                                                </label>
                                            </td>
                                            <td><a href="/employeeAttachments/{{ $attachment->name }}">{{
                                                    $attachment->name }}</a></td>
                                            <td>{{ $attachment->description }}</td>

                                            <td>{{ Carbon\Carbon::parse(
                                                $attachment->created_at)->format('d M Y') }}</td>
                                            <td>{{ $attachment->added_by }}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>

                                </table>
                                <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addAttachmentModal" style="display: none;">
    @include('admin.employeeAttachments.create')
</div>
<div class="modal fade" id="addTerminationModal" style="display: none;">
    @include('admin.employeeTerminations.create')
</div>


@endsection