@extends('admin.layouts.layout-basic')

@section('styles')
@endsection
@section('scripts')
<script src="/assets/admin/js/pages/notifications.js"></script>
<script src="/assets/admin/js/pages/datatables.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    initialize();
    function initialize(){
        $('.autocomplete_off').attr('autocomplete','off');
    }
    var personalForm = $("#personalForm");
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
        <h3 class="page-title">Profile <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('client.index') }}">{{ Auth::user()->name }} Profile</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>User Profile</h6>
                    </div>

                </div>
                <div class="card-body">
                    <div>
                        @if($user->photo != NULL)
                        <img src="/employeesPhoto/{{ $user->photo }}" alt="{{ $user->photo }}"
                            style="max-width:200px;max-height:200px">
                        @else
                        <img src="{{asset('/assets/admin/img/avatars/user.png')}}" alt="Avatar" style="max-width:200px;max-height:200px"></a>
                        @endif
                    </div>
                   
                    <table id="responsive-datatable" class="table table-bordered" cellspacing="0" width="100%">
                        <tbody>

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

                            <tr>
                                <td>Employee Id:</td>
                                <td>{{ $user->id_number }}</td>
                            </tr>
                            <tr>
                                <td>First Name:</td>
                                <td>{{ $user->f_name }}</td>
                            </tr>
                            <tr>
                                <td>Last Name:</td>
                                <td>{{ $user->l_name }}</td>
                            </tr>
                            <tr>
                                <td>Department:</td>
                                
                                <td>{{ $user->department($user->id) }}</td>
                               
                            </tr>
                            <tr>
                                <td>Job Title:</td>
                                <td>{{ $user->jobTitle($user->id) }}</td>
                            </tr>
                            <tr>
                                <td>Job Category:</td>
                                <td>{{ $user->JobCategory($user->id) }}</td>
                            </tr>
                            <tr>
                                <td>Status:</td>
                                <td>
                                    @if($user->terminate_status == 0)
                                    activate
                                    @else
                                    inactivate
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Work Shift:</td>
                                <td>{{ $user->workShift($user->id) }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="col-sm-6">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Update Password</h6>
                    </div>

                </div>
                <div class="card-body">
                    <form action="{{ route('users.update',$user->id ) }}" id="personalForm" enctype="multipart/form-data"
                        method="post" accept-charset="utf-8">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Password<span class="required" aria-required="true">*</span></label>
                                    <input type="password" name="password" value="" class="form-control" disabled="disabled"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Retype Password<span class="required" aria-required="true">*</span></label>
                                    <input type="password" name="r_password" value="" class="form-control" disabled="disabled"
                                        required>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="tab_view" value="personal" disabled="disabled">

                        <div class="box-footer">
                            <a class="btn bg-info btn-flat btn-md" id="editPersonal"><i class="fa fa-pencil-square-o"></i>
                                Edit</a>
                            <button id="savePersonal" type="submit" class="btn bg-success btn-flat" style="display: none;"
                                disabled="disabled">Save</button>&nbsp;&nbsp;&nbsp;
                            <a class="btn bg-danger btn-flat" id="cancelPersonal" style="display: none;">Cancel</a>

                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>
</div>

@endsection