@extends('admin.layouts.layout-basic')

@section('styles')
@endsection
@section('scripts')
<script src="{{ asset('/assets/admin/js/jquery.PrintArea.js') }}"></script>
<script src="/assets/admin/js/pages/datatables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs"
    crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('.autocomplete_off').attr('autocomplete','off');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $(document.body).on('click', '.del_quotation', function () {
            var quotation_id = $('.quotation_id').attr('value');
            
            $('#form-d-quotation').attr('action', '/admin/quotations/' + quotation_id);
        });
    });
</script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">QUOTATIONS <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('quotations.index') }}">Quotation List</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Quotation List</h6>
                    </div>
                    <div class="actions">
                    <button class="btn btn-primary btn-sm" onclick="location.href='{{route('quotation.exportQuotation')}}'"> <i
                                class="icon-fa icon-fa-plus"></i> Export</button>
                        <!-- <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-import"> <i class="icon-fa icon-fa-cloud-upload"></i>
                            Print</button> -->
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="responsive-datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Date(Y-M-D)</th>
                                <th>Quotation No</th>
                                <th>Client</th>
                                <th>Expiry Date</th>
                                <th>Grand Total</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        @if (!$quotations->isEmpty())
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
                            @foreach($quotations as $quotation)
                            <tr class="quotation_id" value="{{ $quotation->id }}">
                                <td>
                                    {{ $quotation->timeFormat($quotation->created_at) }}
                                    
                                </td>
                                <td>
                                    {{ $quotation->invoice_number }} </td>
                                <td>
                                    {{ $quotation->client }} </td>
                                <td>
                                    {{ $quotation->expiration_date }} </td>
                                <td>
                                    <span style="color: green"><strong>{{ $quotation->g_total }}</strong></span> </td>
                                <td>
                                    {{ $quotation->status }}
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-default dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <a class="dropdown-item" href="/admin/quotations/{{ $quotation->id }}">View</a>
                                            
                                            <a class="dropdown-item" href="/admin/quotations/{{ $quotation->id }}/edit">Edit</a>
                                            
                                            <a class="dropdown-item del_quotation" href="#" data-target="#delete_quotation"
                                                data-toggle="modal">Delete</a>
                                        </div>
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
                                        <p>Hi, you don't have any quotation(s) yet</p>
                                    </blockquote>
                                </div>
                            </div>
                        </tbody>
                        @endif
                        <tfoot>
                            <tr>
                                <th>Date(Y-M-D)</th>
                                <th>Quotation No</th>
                                <th>Client</th>
                                <th>Expiry Date</th>
                                <th>Grand Total</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delete_quotation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    @include('admin.quotations.delete')
</div>
<!-- /.row (main row) -->
@endsection