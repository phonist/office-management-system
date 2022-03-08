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
    $(document.body).on('click', '.getEditWorkShift', function () {
        $workshift_id = $(this).siblings('input').val();
        $('#editWorkShiftForm').attr('action', '/admin/workshifts/' + $workshift_id);
        $.get('/admin/workshifts/' + $workshift_id + '/edit', function (data) {

            $('.edit_name').val(data['name']);
            $('.edit_from').val(data['from']);
            $('.edit_to').val(data['to']);
        });
    });
    $(document.body).on('click','.getDeleteWorkShift',function(){
        $workshift_id = $(this).siblings('input').val();
        $('#form-d-workshifts').attr('action','/admin/workshifts/'+ $workshift_id);
    });
</script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Work Shift <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">Work Shift</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Work Shift</h6>
                    </div>
                    <div class="actions">
                        <button class="btn btn-primary btn-sm" data-target="#addWorkShift" data-placement="top"
                            data-toggle="modal"> <i class="icon-fa icon-fa-plus"></i>Add Work Shift</button>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">

                        <thead>
                            <tr>
                                <th>Shift
                                    Name</th>
                                <th>Shift
                                    From</th>
                                <th>Shift
                                    To</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if(!$workshifts->isEmpty())
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
                            @foreach($workshifts as $workshift)
                            <tr role="row" class="even">
                                <td>{{ $workshift->name }}</td>
                                <td>{{ $workshift->from }}</td>
                                <td>{{ $workshift->to }}</td>
                                <td>

                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                        <input type="hidden" value="{{ $workshift->id }}">
                                        <button type="button" class="btn btn-icon btn-outline-info getEditWorkShift"
                                            data-target="#editWorkShift" data-placement="top" data-toggle="modal"><i
                                                class="icon-fa icon-fa-pencil"></i></button>
                                                <button type="button" class="btn btn-icon btn-outline-danger getDeleteWorkShift" data-target="#deleteWorkShift" data-placement="top" data-toggle="modal"><i class="icon-fa icon-fa-trash"></i></button>
                                       
                                            </div>
                                </td>
                            </tr>
                            @endforeach

                            @else


                            <div class="card text-white bg-info text-sm-center">
                                <div class="card-body">
                                    <blockquote class="card-bodyquote">
                                        <p>Hi, you don't have any work shift yet</p>
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
<div class="modal fade" id="addWorkShift" style="display: none;">
    @include('admin.workShifts.create')
</div>
<div class="modal fade" id="editWorkShift" style="display: none;">
    @include('admin.workShifts.edit')
</div>
<div class="modal fade" id="deleteWorkShift" style="display: none;">
    @include('admin.workShifts.delete')
</div>
<!-- /.row (main row) -->
@endsection