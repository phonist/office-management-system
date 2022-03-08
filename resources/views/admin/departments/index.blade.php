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
    
    $(document.body).on('click','.getEditDepartment',function(){
        $department_id = $(this).siblings('input').val();
        $('#editDepartmentForm').attr('action','/admin/departments/'+$department_id);
        $.get('/admin/departments/'+$department_id+'/edit',function(data){
            $('.edit_department').val(data['name']);
            $('.edit_description').text(data['description']);
        });
    });

    $(document.body).on('click','.getDeleteDepartment',function(){
        $id = $(this).siblings('input').val();
        $('#form-d-department').attr('action','/admin/departments/'+$id);
    });

</script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Department <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">Department</a></li>
        </ol>
    </div>

    <div class="row">

        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Department</h6>
                    </div>
                    <div class="actions">
                        <button class="btn btn-primary btn-sm" data-target="#addDepartment" data-placement="top"
                            data-toggle="modal"> <i class="icon-fa icon-fa-plus"></i>Add Department</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">


                            <thead>
                                <tr>
                                    <th>Department</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if(!$departments->isEmpty())
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
                                @foreach($departments as $department)
                                <tr role="row" class="even">
                                    <td>{{ $department->name }}</td>
                                    <td>{{ $department->description }}</td>
                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <input type="hidden" value="{{ $department->id }}">
                                            <button type="button" class="btn btn-icon btn-outline-info getEditDepartment"
                                                data-target="#editDepartmentModal" data-toggle="modal"><i class="icon-fa icon-fa-pencil"></i></button>
                                            
                                                <button type="button" class="btn btn-icon btn-outline-danger getDeleteDepartment"
                                            data-target="#deleteDepartmentModal" data-toggle="modal"><i class="icon-fa icon-fa-trash"></i></button>
                                            
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                                @else


                                <div class="card text-white bg-info text-sm-center">
                                    <div class="card-body">
                                        <blockquote class="card-bodyquote">
                                            <p>Hi, you don't have any department yet</p>
                                        </blockquote>
                                    </div>
                                </div>
                                @endif
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addDepartment" style="display: none;">
    @include('admin.departments.create')
</div>
<div class="modal fade" id="editDepartmentModal" style="display: none;">
    @include('admin.departments.edit')
</div>
<div class="modal fade" id="deleteDepartmentModal" style="display: none;">
    @include('admin.departments.delete')
</div>
<!-- /.row (main row) -->
@endsection