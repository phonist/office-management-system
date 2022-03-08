@extends('admin.layouts.layout-basic')

@section('styles')
@endsection
@section('scripts')
<script src="/assets/admin/js/pages/notifications.js"></script>
<script src="/assets/admin/js/pages/datatables.js"></script>
<script>
    initialize();
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

    function initialize() {
        $('.autocomplete_off').attr('autocomplete', 'off');
    }

    $('.edit').click(function () {
        var id = $(this).siblings('input').val();
        $('#editPermissionForm').attr('action', '/admin/permissions/' + id);
        $.get("/admin/permissions/" + id + "/edit", function (data) {
            console.log(data);
            $('.edit_name').val(data['name']);
            $('.edit_display_name').val(data['display_name']);
            $('.edit_description').val(data['description']);
        
        });
    });

    $('.delete').click(function () {
        var id = $(this).siblings('input').val();
        $('#form-d-permission').attr('action', '/admin/permissions/' + id);
    });
    </script>

@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">PERMISSION <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('vendor.index') }}">Permissions</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Permission List</h6>
                    </div>
                    <div class="actions">
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-create"> <i
                                class="icon-fa icon-fa-plus"></i> Add new permission</button>
                       
                    </div>
                </div>
                <div class="card-body">
                    <table id="responsive-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Display Name</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Display Name</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>

                        @if (!$permissions->isEmpty())
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
                            @foreach($permissions as $permission)
                            <tr>
                                <td>{{ $permission->name}}</td>
                                <td>{{ $permission->display_name }}</td>
                                <td>{{ $permission->description }}</td>

                                <td>
                                <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <input type="hidden" value="{{ $permission->id }}">

                                            <button type="button" class="btn btn-icon btn-outline-info edit"
                                                data-target="#modal-edit" data-placement="top" data-toggle="modal"><i
                                                    class="icon-fa icon-fa-pencil"></i></button>
                                            <button type="button" class="btn btn-icon btn-outline-danger delete" data-target="#modal-delete" data-placement="top" data-toggle="modal"><i class="icon-fa icon-fa-trash"></i></button>
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
                                        <p>Hi, you don't have any permission yet</p>
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
    @include('admin.permissions.create')
</div>

<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    @include('admin.permissions.edit')
</div>
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    @include('admin.permissions.delete')
</div>
@endsection