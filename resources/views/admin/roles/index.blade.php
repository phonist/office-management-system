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
    var temp_arr = new Array();
    $('.edit').click(function () {
        var id = $(this).siblings('input').val();
        $('#editRoleForm').attr('action', '/admin/roles/' + id);
        $.get("/admin/roles/" + id + "/edit", function (data) {
            $('.edit_name').val(data['role']['name']);
            $('.edit_display_name').val(data['role']['display_name']);
            $('.edit_description').val(data['role']['description']);
            $.each(data['permission'],function(idx, value){
                temp_arr.push(value['id'].toString());
            });
            
            $(".edit_rPermission").each(function(idx, li){
                if($.inArray(li['value'],temp_arr) != '-1'){
                    $(this).prop('checked',true);
                }else{
                    $(this).prop('checked',false);
                }
            });
        });
        temp_arr = [];
    });

    $('.delete').click(function () {
        var id = $(this).siblings('input').val();
        $('#form-d-role').attr('action', '/admin/roles/' + id);
    });

    $(document.body).on('change','#parent_present',function(){
        if(this.checked){
            $('.child_present').prop('checked',true);
        }else{
            $('.child_present').prop('checked',false);
        }
    });
    </script>

@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">ROLE <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('vendor.index') }}">Roles</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Role List</h6>
                    </div>
                    <div class="actions">
                        
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-create"> <i
                                class="icon-fa icon-fa-plus"></i> Add new role</button>
                        
                    </div>
                </div>
                <div class="card-body">
                    
                    <table id="responsive-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Display Name</th>
                                <th>Description</th>
                                <th>Assigned Permission(s)</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Display Name</th>
                                <th>Description</th>
                                <th>Assigned Permission(s)</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>

                        @if (!$roles->isEmpty())
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
                            @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->name}}</td>
                                <td>{{ $role->display_name }}</td>
                                <td>{{ $role->description }}</td>
                                <td>
                                    @if($role->permissions()->get() == [])
                                        No permission assigned
                                    @else
                                    @foreach($role->permissions()->select('display_name')->get() as $perm)
                                        <button class="btn btn-xs btn-secondary btn-rounded" disabled>{{$perm->display_name}}</button>    
                                    
                                    @endforeach
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                        <input type="hidden" value="{{ $role->id }}">
                                        
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
                                        <p>Hi, you don't have any role yet</p>
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
    @include('admin.roles.create')
</div>
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    @include('admin.roles.edit')
</div>
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    @include('admin.roles.delete')
</div>
@endsection