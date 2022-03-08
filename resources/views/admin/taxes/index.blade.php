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
    $(document.body).on('click', '.getEditTax', function () {
        $tax_id = $(this).siblings('input').val();

        $('#editTaxForm').attr('action', '/admin/taxes/' + $tax_id);
        $.get('/admin/taxes/' + $tax_id + '/edit', function (data) {

            $('.edit_name').val(data['name']);
            $('.edit_rate').val(data['rate']);
            if (data['type'] == 1) {
                $('#percentage_option').attr('selected', 'selected');
                $('#fixed_option').removeAttr('selected');
            } else {
                $('#fixed_option').attr('selected', 'selected');
                $('#percentage_option').removeAttr('selected');
            }
        });
    });
    $(document.body).on('click','.getDeleteTax',function(){
        $tax_id = $(this).siblings('input').val();
        $('#form-d-tax').attr('action','/admin/taxes/'+$tax_id);
    });
</script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Taxes <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">Taxes</a></li>
        </ol>
    </div>

    <div class="row">

        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Taxes</h6>
                    </div>
                    <div class="actions">
                        <button class="btn btn-primary btn-sm" data-target="#addTaxModel" data-placement="top"
                            data-toggle="modal"> <i class="icon-fa icon-fa-plus"></i>Add Tax</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Tax
                                        Name</th>
                                    <th>Tax
                                        Rate</th>
                                    <th>Tax
                                        Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if(!$taxes->isEmpty())
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
                                @foreach($taxes as $tax)
                                <tr role="row" class="even">
                                    <td>{{ $tax->name }}</td>
                                    <td>{{ $tax->rate }}</td>
                                    @if($tax->type == 1)
                                    <td>Percentage</td>
                                    @else
                                    <td>Fixed</td>
                                    @endif
                                    <td>

                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <input type="hidden" value="{{ $tax->id }}">
                                            <button type="button" class="btn btn-icon btn-outline-info getEditTax"
                                                data-target="#editTaxModel" data-placement="top" data-toggle="modal"><i
                                                    class="icon-fa icon-fa-pencil"></i></button>
                                                    <button type="button" class="btn btn-icon btn-outline-danger getDeleteTax" data-target="#deleteTaxModel" data-placement="top" data-toggle="modal"><i class="icon-fa icon-fa-trash"></i></button>
                                           
                                                </div>

                                    </td>
                                </tr>
                                @endforeach

                                @else
                                <div class="card text-white bg-info text-sm-center">
                                    <div class="card-body">
                                        <blockquote class="card-bodyquote">
                                            <p>Hi, you don't have any Tax yet</p>
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

<div class="modal fade" id="addTaxModel" style="display: none;">
    @include('admin.taxes.create')
</div>
<div class="modal fade" id="editTaxModel" style="display: none;">
    @include('admin.taxes.edit')
</div>
<div class="modal fade" id="deleteTaxModel" style="display: none;">
    @include('admin.taxes.delete')
</div>
<!-- /.row (main row) -->
@endsection