@extends('admin.layouts.layout-basic')

@section('styles')
@endsection
@section('scripts')
<script src="{{ asset('/assets/admin/js/jquery.PrintArea.js') }}"></script>
<script src="/assets/admin/js/pages/datatables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs"
    crossorigin="anonymous"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function () {
        $('#example1').DataTable()
    })
    $('.edit').click(function () {
        var id = $(this).siblings('.withdraw_id').attr('id');
        $('#form-witdraw-edit').attr('action', '/admin/withdrawals/' + id);
        $.get("/admin/withdrawals/" + id + "/edit", function (data) {
            $w_quantity = data['w_quantity'];
            $.get('/admin/inventory/' + data['inventory_id'], function (data) {
                $('#inv_name').val(data['name']);
                $('#w_quantity').attr('placeholder',parseInt(data['quantity'])+parseInt($w_quantity));
            });
            $('#ori_qty').val(data['w_quantity']);
            $('#edit_inv_id').val(data['inventory_id']);
            $('#w_quantity').val(data['w_quantity']);
            $('#project_id').val(data['project_id']);
        });
    });

    $(document.body).on('keyup','#w_quantity',function(){
        $limit = $('#w_quantity').attr('placeholder');
        $inp = $(this).val();
        if(parseInt($(this).val()) > parseInt($limit)){
            $('#exceed_edit_qty').attr('class','');
            $('#submit_edit_withdraw').attr('disabled','disabled');
        }else{
            $('#exceed_edit_qty').attr('class','hidden');
            $('#submit_edit_withdraw').removeAttr('disabled');
        }
    });

    $('.delete').click(function () {
        var id = $(this).parents('li').siblings('.withdraw_id').attr('id');
        $('#form-d-withdraw').attr('action', '/admin/withdrawals/' + id);
    });
</script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Category <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('category.index') }}">Withdrawals</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Withdrawals</h6>
                    </div>
                </div>

                <div class="card-body table-responsive ">
                    <table id="responsive-datatable" class="table table-bordered table-striped">


                        <thead>
                            <tr role="row">
                                <th>Date Time</th>
                                <th>Product</th>
                                <th>Current Quantity</th>
                                <th>Withdraw Quantity</th>
                                <th>Withdraw By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        @if (!$withdrawals->isEmpty())
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
                            @foreach($withdrawals as $withdrawal)
                            <tr role="row" class="odd">

                                <td>{{ Carbon\Carbon::parse( $withdrawal->updated_at)->format('d M Y h:m')
                                    }}</td>
                                <td>{{
                                    \App\Inventory::where('id',$withdrawal->inventory_id)->first()->name
                                    }}</td>
                                <td>{{
                                    \App\Inventory::where('id',$withdrawal->inventory_id)->first()->quantity
                                    }}</td>
                                <td>{{ $withdrawal->w_quantity }}</td>
                                <td>{{ $withdrawal->withdrawer }}</td>
                                <td>
                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                        <input type="hidden" class="withdraw_id" id={{ $withdrawal->id }}>

                                        <button type="button" class="btn btn-icon btn-outline-info edit" data-toggle="modal"
                                            data-target="#modal-withdraw-edit"><i class="icon-fa icon-fa-pencil"></i></button>

                                    </div>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @else
                        <tbody>

                            <div class="card text-white bg-info text-sm-center">
                                <div class="card-body">
                                    <blockquote class="card-bodyquote">
                                        <p>Hi, you don't have any withdrawal yet</p>

                                    </blockquote>
                                </div>
                            </div>
                        </tbody>
                        @endif


                    </table>


                </div>
            </div>
        </div>
    </div>

</div>


<div class="modal fade" id="modal-withdraw-edit" style="display: none;">
    @include('admin.withdrawals.edit')
</div>
<div class="modal fade" id="modal-withdraw-delete" style="display: none;">
    @include('admin.withdrawals.delete')
</div>

<!-- /.row (main row) -->
@endsection