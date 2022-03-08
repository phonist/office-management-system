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
        $('.autocomplete_off').attr('autocomplete','off');
    }
    
    $('.getEditApplication').click(function () {
        var id = $(this).siblings('input').val();
        $('#form-application').attr('action', '/admin/applications/' + id);
        $.get("/admin/applications/" + id + "/edit", function (data) {
            $('#edit_employee > option').each(function(){
                if(data['employee_id'] == $(this).val()){
                    $(this).attr('selected', 'selected');
                }else{
                    $(this).removeAttr('selected');
                }
            });
            
            $('#edit_employee').val(data['employee_id']);
            $('#edit_start').val(data['start']);
            $('#edit_end').val(data['end']);
            $('#edit_leave > option').each(function(){
                if(data['type_id'] == $(this).val()){
                    $(this).attr('selected', 'selected');
                }else{
                    $(this).removeAttr('selected');
                }
            });
            $('#edit_apply').val(data['date']);
            $('#edit_status > option').each(function(){
                if(data['status'] == $(this).val()){
                    $(this).attr('selected', 'selected');
                }else{
                    $(this).removeAttr('selected');
                }
            });
        });
    });

    $('.getDeleteApplication').click(function () {
        var id = $(this).siblings('input').val();
        $('#form-d-application').attr('action', '/admin/applications/' + id);
    });
</script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">APPLICATION <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('client.index') }}">Applications</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Application List</h6>
                    </div>
                    <div class="actions">
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-create"> <i
                                class="icon-fa icon-fa-plus"></i> Add new application</button>
                        
                    </div>
                </div>
                <div class="card-body">
                    <table id="responsive-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Employee Id</th>
                                <th>Employee Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Leave Type</th>
                                <th>Application Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Employee Id</th>
                                <th>Employee Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Leave Type</th>
                                <th>Application Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>

                        @if (!$applications->isEmpty())
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
                            @foreach($applications as $application)
                            <tr>
                                <td>{{ \App\Employee::where('id',$application->employee_id)->first()->id_number }}</td>
                                <td>{{ \App\Employee::where('id',$application->employee_id)->first()->f_name }} {{ \App\Employee::where('id',$application->employee_id)->first()->l_name }}</td>
                                <td>{{ Carbon\Carbon::parse( $application->start)->format('d M Y') }}</td>
                                <td>{{ Carbon\Carbon::parse( $application->end)->format('d M Y') }}</td>
                                <td>{{ \App\LeaveType::where('id',$application->type_id)->first()->name }}</td>
                                <td>{{ Carbon\Carbon::parse( $application->date)->format('d M Y') }}</td>
                                <td>{{ $application->status }}</td>
                                <td>
                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                        <input type="hidden" value="{{ $application->id }}">

                                        <button type="button" class="btn btn-icon btn-outline-info getEditApplication"
                                            data-target="#modal-edit" data-toggle="modal"><i class="icon-fa icon-fa-pencil"></i></button>
                                        <button type="button" class="btn btn-icon btn-outline-danger getDeleteApplication"
                                        data-target="#modal-delete" data-toggle="modal"><i class="icon-fa icon-fa-trash"></i></button>
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
                                        <p>Hi, you don't have any applications yet.</p>
                                        <footer>Please add your employee application(s) by using button at the top right
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
    @include('admin.applications.create')
</div>

<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    @include('admin.applications.edit')
</div>
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    @include('admin.applications.delete')
</div>
@endsection