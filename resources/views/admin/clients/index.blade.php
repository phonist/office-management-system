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
    function initialize(){
        $('.inp_client_name').attr('autocomplete','off');
        $('.inp_company_name').attr('autocomplete','off');
        $('.inp_phone').attr('autocomplete','off');
        $('.inp_fax').attr('autocomplete','off');
        $('.inp_email').attr('autocomplete','off');
        $('.inp_website').attr('autocomplete','off');
        $('.inp_b_address').attr('autocomplete','off');
        $('.inp_s_address').attr('autocomplete','off');
        $('.inp_customer_note').attr('autocomplete','off');
    }
    
    // $(document.body).on('click','#inp_client_name',function(e){
    //     e.preventDefault();
    //     $(this).attr('autocomplete','off');
    // });
    $('.edit').click(function () {
        var id = $(this).siblings('.client_id').attr('id');
        $('#form-client').attr('action', '/admin/client/' + id);
        $.get("/admin/client/" + id + "/edit", function (data) {
            $('#inp_name').val(data['name']);
            $('#inp_company').val(data['company']);
            $('#inp_phone').val(data['phone']);
            $('#inp_fax').val(data['fax']);
            $('#inp_email').val(data['email']);
            $('#inp_website').val(data['website']);
            $('#inp_b_address').val(data['billing_address']);
            $('#inp_s_address').val(data['shipping_address']);
            $('#inp_note').val(data['note']);
        });
    });

    $('.delete').click(function () {
        var id = $(this).siblings('.client_id').attr('id');
        $('#form-d-client').attr('action', '/admin/client/' + id);
    });
    </script>

@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">CLIENT <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('client.index') }}">Clients</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Client List</h6>
                    </div>
                    <div class="actions">
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-create"> <i
                                class="icon-fa icon-fa-plus"></i> Add new client</button>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-import"> <i class="icon-fa icon-fa-cloud-upload"></i>
                            Import</button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="responsive-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Client/Company</th>
                                <th>Phone</th>
                                <th>Open Balance</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Client/Company</th>
                                <th>Phone</th>
                                <th>Open Balance</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>

                        @if (!$clients->isEmpty())
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
                            @foreach($clients as $client)
                            <tr>
                                <td>{{ $client->name}}</td>
                                <td>{{ $client->phone }}</td>
                                @if($client->open_balance != null)
                                <td>SGD {{ $client->open_balance }}</td>
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
                                            <input type="hidden" class="client_id" id="{{ $client->id }}">
                                            <a class="dropdown-item" href="/admin/orders/{{ $client->id }}/createWithClient">Create
                                                Invoice</a>
                                            <a class="dropdown-item" href="/admin/quotation/{{ $client->id }}/createWithClient">Quotation</a>
                                            
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
                                        <p>Hi, you don't have any client yet.</p>
                                        <footer>Please add/import your client(s) by using button at the top right
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
    @include('admin.clients.create')
</div>
<div class="modal fade" id="modal-import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    @include('admin.clients.import')
</div>
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    @include('admin.clients.edit')
</div>
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    @include('admin.clients.delete')
</div>
@endsection