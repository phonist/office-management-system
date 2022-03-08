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
                        <h6>Dependents</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <form action="{{ route('employeeDependents.delete') }}" method="post" accept-charset="utf-8">
                                @csrf

                                <a data-target="#addEmployeeDependentModal" title="View" data-placement="top"
                                    data-toggle="modal" href="#" class="btn bg-primary btn-md btn-flat">
                                    <i class="fa fa-plus"></i> Add Dependent </a>

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
                                                <th class="active">Name</th>
                                                <th class="active">Relationship</th>
                                                <th class="active">Date of Birth </th>
                                                <th class="active">Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if($dependents == "" || $dependents == null)

                                            <div class="card text-white bg-info text-sm-center">
                                                <div class="card-body">
                                                    <blockquote class="card-bodyquote">
                                                        <p>Hi, this user don't have any dependent(s) yet</p>
                                                    </blockquote>
                                                </div>
                                            </div>
                                            @else
                                            @foreach($dependents as $dependent)
                                            <tr>
                                                <td>
                                                    <label class="css-input css-checkbox css-checkbox-success">
                                                        <input name="dependentId[]" value="{{ $dependent->id }}" type="checkbox"
                                                            class="child_present"><span></span>
                                                    </label>
                                                </td>
                                                <td>{{ $dependent->name }}</td>
                                                <td>{{ $dependent->relationship }}</td>
                                                <td>{{ Carbon\Carbon::parse($dependent->dob)->format('d M Y') }}</td>
                                                <td>


                                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                                        <input type="hidden" class="dependent_id" value="{{ $dependent->id }}">

                                                        <button type="button" class="btn btn-icon btn-outline-info editEmployeeDependent"
                                                            data-target="#editEmployeeDependentModal" title="View"
                                                            data-placement="top" data-toggle="modal"><i class="icon-fa icon-fa-pencil"></i></button>
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

<div class="modal fade" id="addEmployeeDependentModal" style="display: none;">
    @include('admin.employeeDependents.create')
</div>
<div class="modal fade" id="editEmployeeDependentModal" style="display: none;">
    @include('admin.employeeDependents.edit')
</div>
<div class="modal fade" id="addTerminationModal" style="display: none;">
    @include('admin.employeeTerminations.create')
</div>


@endsection