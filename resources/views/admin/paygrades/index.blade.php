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
    $(document.body).on('click', '.getEditPayGrade', function () {
        $paygrade_id = $(this).siblings('input').val();

        $('#editPayGradeForm').attr('action', '/admin/paygrades/' + $paygrade_id);
        $.get('/admin/paygrades/' + $paygrade_id + '/edit', function (data) {

            $('.edit_name').val(data['name']);
            $('.edit_min').val(data['minimum']);
            $('.edit_max').val(data['maximum']);

        });
    });
    $(document.body).on('click','.getDeletePayGrade',function(){
        $paygrade_id = $(this).siblings('input').val();
        $('#form-d-payGrade').attr('action','/admin/paygrades/'+$paygrade_id);
    });
</script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Pay Grades <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">Pay Grades</a></li>
        </ol>
    </div>

    <div class="row">

        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Pay Grades</h6>
                    </div>
                    <div class="actions">
                        <button class="btn btn-primary btn-sm" data-target="#addPayGradeModal" data-placement="top"
                            data-toggle="modal"> <i class="icon-fa icon-fa-plus"></i>Add Pay Grades</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Pay
                                        Grade</th>
                                    <th>Minimum
                                        Salary</th>
                                    <th>Maximum
                                        Salary</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if(!$paygrades->isEmpty())
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
                                @foreach($paygrades as $paygrade)
                                <tr role="row" class="even">
                                    <td>{{ $paygrade->name }}</td>
                                    <td>{{ $paygrade->minimum }}</td>
                                    <td>{{ $paygrade->maximum }}</td>

                                    <td>

                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <input type="hidden" value="{{ $paygrade->id }}">
                                            <button type="button" class="btn btn-icon btn-outline-info getEditPayGrade"
                                                data-target="#editPayGradeModal" data-placement="top" data-toggle="modal"><i
                                                    class="icon-fa icon-fa-pencil"></i></button>
                                            <button type="button" class="btn btn-icon btn-outline-danger getDeletePayGrade" data-target="#deletePayGradeModal" data-placement="top" data-toggle="modal"><i class="icon-fa icon-fa-trash"></i></button>
                                         
                                            </div>
                                    </td>
                                </tr>
                                @endforeach

                                @else


                                <div class="card text-white bg-info text-sm-center">
                                    <div class="card-body">
                                        <blockquote class="card-bodyquote">
                                            <p>Hi, you don't have any Pay Grade yet</p>
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
<div class="modal fade" id="addPayGradeModal" style="display: none;">
    @include('admin.paygrades.create')
</div>
<div class="modal fade" id="editPayGradeModal" style="display: none;">
    @include('admin.paygrades.edit')
</div>
<div class="modal fade" id="deletePayGradeModal" style="display: none;">
    @include('admin.paygrades.delete')
</div>
<!-- /.row (main row) -->
@endsection