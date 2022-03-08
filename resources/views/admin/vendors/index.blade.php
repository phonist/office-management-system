@extends('admin.layouts.layout-basic')

@section('styles')
@endsection
@section('scripts')
<script src="/assets/admin/js/pages/notifications.js"></script>
<script src="/assets/admin/js/pages/datatables.js"></script>
<script>
    // Ladda Buttons
    Ladda.bind( 'div:not(.progress-demo) .ladda-button', { timeout: 2000 } );

    // Bind progress buttons and simulate loading progress
    Ladda.bind( '.progress-demo button', {
        callback: function( instance ) {
            var progress = 0;
            var interval = setInterval( function() {
                progress = Math.min( progress + Math.random() * 0.1, 1 );
                instance.setProgress( progress );

                if( progress === 1 ) {
                    instance.stop();
                    clearInterval( interval );
                }
            }, 200 );
        }
    } );
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    initialize();

    function initialize() {
        $('.inp_vendor_name').attr('autocomplete', 'off');
        $('.inp_company_name').attr('autocomplete', 'off');
        $('.inp_phone').attr('autocomplete', 'off');
        $('.inp_fax').attr('autocomplete', 'off');
        $('.inp_email').attr('autocomplete', 'off');
        $('.inp_website').attr('autocomplete', 'off');
        $('.inp_b_address').attr('autocomplete', 'off');
        $('.inp_vendor_note').attr('autocomplete', 'off');
    }
    $('.edit').click(function () {
        var id = $(this).siblings('.vendor_id').attr('id');
        $('#form-vendor').attr('action', '/admin/vendor/' + id);
        $.get("/admin/vendor/" + id + "/edit", function (data) {
            $('#inp_name').val(data['name']);
            $('#inp_company').val(data['company']);
            $('#inp_phone').val(data['phone']);
            $('#inp_fax').val(data['fax']);
            $('#inp_email').val(data['email']);
            $('#inp_website').val(data['website']);
            $('#inp_b_address').val(data['billing_address']);
            $('#inp_note').val(data['note']);
        });
    });

    $('.delete').click(function () {
        var id = $(this).siblings('.vendor_id').attr('id');
        $('#form-d-vendor').attr('action', '/admin/vendor/' + id);
    });
    </script>

@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">VENDOR <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('vendor.index') }}">Vendors</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Vendor List</h6>
                    </div>
                    <div class="actions">
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-create"> <i
                                class="icon-fa icon-fa-plus"></i> Add new vendor</button>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-import"> <i class="icon-fa icon-fa-cloud-upload"></i>
                            Import</button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="responsive-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Vendor/Company</th>
                                <th>Phone</th>
                                <th>Open Balance</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Vendor/Company</th>
                                <th>Phone</th>
                                <th>Open Balance</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>

                        @if (!$vendors->isEmpty())
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
                            @foreach($vendors as $vendor)
                            <tr>
                                <td>{{ $vendor->name}}</td>
                                <td>{{ $vendor->phone }}</td>
                                @if($vendor->open_balance != null)
                                <td>SGD {{ $vendor->open_balance }}</td>
                                @else
                                <td>SGD 0.00</td>
                                @endif

                                <td>
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-outline-default dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <input type="hidden" class="vendor_id" id="{{ $vendor->id }}">
                                            <a class="dropdown-item" href="/admin/purchases/{{ $vendor->id }}/createWithVendor">Create
                                                Bill</a>
                                            <a class="dropdown-item edit" href="#" data-toggle="modal" data-target="#modal-edit">Edit</a>
                                            
                                            <a class="dropdown-item delete" href="#" data-toggle="modal" data-target="#modal-delete">Delete</a>
                                          
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
                                        <p>Hi, you don't have any vendor yet</p>
                                        <footer>Please add/import your vendor(s) by using button at the top right
                                            corner</footer>
                                    </blockquote>
                                </div>
                            </div>

                        </tbody>
                        @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    @include('admin.vendors.create')
</div>
<div class="modal fade" id="modal-import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    @include('admin.vendors.import')
</div>
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    @include('admin.vendors.edit')
</div>
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    @include('admin.vendors.delete')
</div>
@endsection