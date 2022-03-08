@extends('admin.layouts.layout-basic')

@section('styles')
@endsection
@section('scripts')
<script src="{{ asset('/assets/admin/js/jquery.PrintArea.js') }}"></script>
<script src="/assets/admin/js/pages/datatables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs"
    crossorigin="anonymous"></script>
<script>
    $(function () {
    init();
    function init(){
        $('.autocomplete_off').attr('autocomplete','off');
    }
})
</script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Employee <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('users.create') }}">Add Employee</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Add Employee</h6>
                    </div>
                    <div class="actions">
                        <button class="btn btn-primary btn-sm" onclick="location.href='{{ route('employees.import') }}'">
                            <i class="icon-fa icon-fa-plus"></i> Import</button>
                    </div>
                </div>
                <form action="{{ route('employees.store') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    @csrf
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Role<span class="required" aria-required="true">*</span></label>
                                            <select class="form-control" name="role">
                                                @foreach($roles as $role)
                                                @if($role->name == 'user')
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
                                            <label>First Name<span class="required" aria-required="true">*</span></label>
                                            <input type="text" name="first_name" class="form-control input-md autocomplete_off"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Last Name<span class="required" aria-required="true">*</span></label>
                                            <input type="text" name="last_name" class="form-control input-md autocomplete_off"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email<span class="required" aria-required="true">*</span></label>
                                            <input type="email" name="email" class="form-control input-md autocomplete_off"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">


                                    <label>Date of Birth<span class="required" aria-required="true">*</span></label>
                                            
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="icon-fa icon-fa-calendar"></i>
                                                </span>
                                            </div>
                                            <input name="date_of_birth" type="text" class="form-control ls-datepicker autocomplete_off"
                                                value="" data-date-format="yyyy-mm-dd" required>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Marital Status</label>
                                            <select class="form-control input-md" name="marital_status">
                                                <option value="">Please Select..</option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country *</label>
                                            <select class="form-control ls-select2" style="width: 100%;" name="country"
                                                required>
                                                <option value="Singapore" selected="selected">Singapore</option>
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
                                            <select class="form-control ls-select2" style="width: 100%;" name="blood_group">
                                                <option value="A" selected="selected">A</option>
                                                <option value="B">B</option>
                                                <option value="AB">AB</option>
                                                <option value="O">O</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label>ID Number</label>
                                    <input type="text" name="id_number" class="form-control input-md autocomplete_off">
                                </div>

                                <div class="form-group">
                                    <label>Religious</label>
                                    <select class="form-control select2" style="width: 100%;" name="religious">
                                        <option value="Christians" selected="selected">Christians</option>
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
                                            <label class="css-input css-radio css-radio-success push-10-r">
                                                <input name="gender" value="Male" checked="" type="radio"><span></span>Male
                                            </label>
                                            <label class="css-input css-radio css-radio-success push-10-r">
                                                <input name="gender" value="Female" type="radio"><span></span>Female
                                            </label>
                                        </div>
                                    </div>
                                </div>



                                <!-- /.Employee Image -->
                                <div class="form-group">
                                    <label></label>
                                </div>
                                <div class="form-group">
                                    <input type="file" name="employee_photo" id="file-1" class="inputfile inputfile-1"
                                        data-multiple-caption="{count} files selected">
                                    

                                </div>
                                <!-- /.Employee Image -->




                            </div>




                        </div>

                    </div>
                    <div class="card-footer">
                        <p class="text-muted">Accepts jpg, .png, .gif up to 1MB. Recommended dimensions:
                            200px
                            X 200px</p>
                        <p class="text-muted"><span class="required" aria-required="true">*</span>Required
                            field</p>
                        <button class="btn btn-primary" type="submit" value="Submit"><i class="fa fa-save"></i>
                            Save Employee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection