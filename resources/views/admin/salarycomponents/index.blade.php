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
    $(document.body).on('click', '.getEditSalaryComponent', function () {
        $salarycomponent_id = $(this).siblings('input').val();

        $('#editSalaryComponentForm').attr('action', '/admin/salarycomponents/' + $salarycomponent_id);
        $.get('/admin/salarycomponents/' + $salarycomponent_id + '/edit', function (data) {
            $('.edit_name').val(data['component_name']);

            if (data['type'] == 1) {
                $('#edit_type_1').children('input').attr('checked', 'checked');
                $('#edit_type_2').children('input').removeAttr('checked');
            } else if (data['type'] == 2) {
                $('#edit_type_2').children('input').attr('checked', 'checked');
                $('#edit_type_1').children('input').removeAttr('checked');
            }
            if (data['total_payable'] == 1) {
                $('#edit_t_pay').children('input').attr('checked', 'checked');
            } else if (data['total_payable'] == 0 || data['total_payable'] == null) {
                $('#edit_t_pay').children('input').removeAttr('checked');
            }
            if (data['cost_company'] == 1) {
                $('#edit_t_cost').children('input').attr('checked', 'checked');
            } else if (data['cost_company'] == 0 || data['cost_company'] == null) {
                $('#edit_t_cost').children('input').removeAttr('checked');
            }
            if (data['value_type'] == 1) {
                $('#edit_amt').children('input').attr('checked', 'checked');
                $('#edit_percentage').children('input').removeAttr('checked');
            } else if (data['value_type'] == 2) {
                $('#edit_amt').children('input').removeAttr('checked');
                $('#edit_percentage').children('input').attr('checked', 'checked');
            }

        });
    });
    $(document.body).on('click','.getDeleteSalaryComponent',function(){
        $salarycomponent_id = $(this).siblings('input').val();
        $('#form-d-salaryComponent').attr('action','/admin/salarycomponents/'+$salarycomponent_id);
    });
</script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Salary Component <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">Salary Component</a></li>
        </ol>
    </div>

    <div class="row">

        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Salary Component</h6>
                    </div>
                    <div class="actions">
                        <button class="btn btn-primary btn-sm" data-target="#addSalaryComponentModel" data-placement="top"
                            data-toggle="modal"> <i class="icon-fa icon-fa-plus"></i>Add Salary Component</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">

                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Total
                                        Payable</th>
                                    <th>Cost
                                        to Company</th>
                                    <th>Rules</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if(!$salaries->isEmpty())
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
                                @foreach($salaries as $salary)
                                <tr>
                                    <td>{{ $salary->component_name }}</td>
                                    @if($salary->type == 1)
                                    <td>Earning</td>
                                    @else
                                    <td>Deduction</td>
                                    @endif
                                    @if($salary->total_payable == 1)
                                    <td>Yes</td>
                                    @else
                                    <td>No</td>
                                    @endif
                                    @if($salary->cost_company == 1)
                                    <td>Yes</td>
                                    @else
                                    <td>No</td>
                                    @endif
                                    @if($salary->value_type == 1)
                                    <td>Amount</td>
                                    @else
                                    <td>Percentage</td>
                                    @endif




                                    <td>

                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <input type="hidden" value="{{ $salary->id }}">
                                            <button type="button" class="btn btn-icon btn-outline-info getEditSalaryComponent"
                                                data-target="#editSalaryComponentModel" data-placement="top"
                                                data-toggle="modal"><i class="icon-fa icon-fa-pencil"></i></button>
                                                <button type="button" class="btn btn-icon btn-outline-danger getDeleteSalaryComponent" data-target="#deleteSalaryComponentModel" data-placement="top"
                                            data-toggle="modal"><i class="icon-fa icon-fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                                @else



                                <div class="card text-white bg-info text-sm-center">
                                    <div class="card-body">
                                        <blockquote class="card-bodyquote">
                                            <p>Hi, you don't have any Salary Component yet</p>
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
<div class="modal fade" id="addSalaryComponentModel" style="display: none;">
    @include('admin.salarycomponents.create')
</div>
<div class="modal fade" id="editSalaryComponentModel" style="display: none;">
    @include('admin.salarycomponents.edit')
</div>
<div class="modal fade" id="deleteSalaryComponentModel" style="display: none;">
    @include('admin.salarycomponents.delete')
</div>
<!-- /.row (main row) -->
@endsection