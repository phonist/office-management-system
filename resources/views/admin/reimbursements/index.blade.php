@extends('admin.layouts.layout-basic')

@section('styles')
@endsection
@section('scripts')
<script src="{{ asset('/assets/admin/js/jquery.PrintArea.js') }}"></script>
<script src="/assets/admin/js/pages/datatables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs"
    crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    
        $('.autocomplete_off').attr('autocomplete','off');
    
    
    $(document).on('click', 'a.jquery-postback', function(e) {
        e.preventDefault(); // does not go through with the link.

        var $this = $(this);

        $.post({
            type: $this.data('method'),
            url: $this.attr('href')
        }).done(function (data) {
            location.reload();
        });
    });
    $(document.body).on('click', '.showReimbursement', function () {
        $reimbursement_id = $(this).siblings('.reimbursement_id').val();
        $.get("/admin/reimbursements/" + $reimbursement_id, function (data) {
            // console.log(data['date']);
            $('.show_date').text(data['date']);
            $('.show_amt').text(data['amount']);
            $('.show_desc').text(data['description']);
            if (data['m_approved'] == 0) {
                $('.show_mapproved').html('<small class="label bg-yellow">Pending</small>');
            } else {
                $('.show_mapproved').html('<small class="label bg-green">Approved</small>');
            }
            if (data['a_approved'] == 0) {
                $('.show_aapproved').html('<small class="label bg-yellow">Pending</small>');
            } else {
                $('.show_aapproved').html('<small class="label bg-green">Approved</small>');
            }
            if (data['m_comment'] == null) {
                $('.show_mcomment').text('-');
            } else {
                $('.show_mcomment').text(data['m_comment']);
            }
            if (data['a_comment'] == null) {
                $('.show_acomment').text('-');
            } else {
                $('.show_acomment').text(data['a_comment']);
            }
        });
    });

    $(document.body).on('click', '.editReimbursement', function () {
        $reimbursement_id = $(this).siblings('.reimbursement_id').val();
        $('.editReimbursementForm').attr('action', '/admin/reimbursements/' + $reimbursement_id);
        $.get("/admin/reimbursements/" + $reimbursement_id, function (data) {
            $('.edit_date').val(data['date']);
            $('.edit_amount').val(data['amount']);
            $('.edit_description').text(data['description']);
            $('.edit_department > option').each(function () {
                if (data['department_id'] == $(this).val()) {
                    $(this).attr('selected', 'selected');
                } else {
                    $(this).removeAttr('selected');
                }
            });
            $('.edit_employee > option').each(function () {
                if (data['employee_id'] == $(this).val()) {
                    $(this).attr('selected', 'selected');
                } else {
                    $(this).removeAttr('selected');
                }
            });

            if (data['m_approved'] == 0) {
                $('.edit_mapproved').val('Pending');
            } else {
                $('.edit_mapproved').val('Approved');
            }

            $('.edit_aapproved > option').each(function () {
                if (data['a_approved'] == $(this).val()) {
                    $(this).attr('selected','selected');
                } else {
                    $(this).removeAttr('selected');
                }
            })

            if (data['m_comment'] == null) {
                $('.edit_mcomment').text('-');
            } else {
                $('.edit_mcomment').text(data['m_comment']);
            }

            if (data['a_comment'] == null) {
                $('.edit_acomment').text('-');
            } else {
                $('.edit_acomment').text(data['a_comment']);
            }
        });
    });
    $('.delete').click(function () {
        var id = $(this).siblings('.reimbursement_id').val();
        $('#form-d-reimbursement').attr('action', '/admin/reimbursements/' + id);
    });
});

</script>
@stop

@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Reimbursement <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('orders.index') }}">Reimbursement List</a></li>
        </ol>
    </div>

    <div class="card">
        <div class="card-header bg-info">
            <div class="caption">
                <h6>Reimbursement List</h6>
            </div>
            <div class="actions">
            <button class="btn btn-primary btn-sm" onclick="location.href='{{ route('reimbursements.export') }}'"> <i class="icon-fa icon-fa-plus"></i>
                    Export</button>
                <button class="btn btn-primary btn-sm" data-target="#addReimbursement" title="View" data-placement="top"
                    data-toggle="modal"> <i class="icon-fa icon-fa-plus"></i>
                    New Reimbursement Form</button>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table id="responsive-datatable" class="table table-bordered table-striped">
                <thead>
                    <tr>

                        <th>Date(Y-M-D)</th>
                        <th>Employee</th>
                        <th>Department</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Approved
                            by Manager</th>
                        <th>Approved
                            admin</th>
                        <th>Actions</th>

                    </tr>

                </thead>
                <tbody>
                    @foreach($reimbursements as $reimbursement)
                    <tr>
                        <td>
                            {{ \Carbon\Carbon::parse($reimbursement->date)->format('Y-m-d') }} </td>
                        <td>
                            {{
                            \App\Employee::where('id',$reimbursement->employee_id)->first()->f_name
                            }} {{
                            \App\Employee::where('id',$reimbursement->employee_id)->first()->l_name
                            }}</td>
                        <td>
                            {{
                            \App\Department::where('id',$reimbursement->department_id)->first()->name
                            }} </td>
                        <td>
                            {{$reimbursement->amount}} </td>
                        <td>
                            {{$reimbursement->description }} </td>
                        <td>
                            <small class="label bg-yellow">Pending</small> </td>
                        <td>
                            <small class="label bg-success">Approved</small> </td>
                        <td>


                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-outline-default dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <input type="hidden" class="reimbursement_id" value="{{ $reimbursement->id }}">
                                    <a class="dropdown-item showReimbursement" href="#" data-target="#showReimbursement"
                                        data-placement="top" data-toggle="modal">View</a>
                                    <a class="dropdown-item editReimbursement" href="#" data-target="#editReimbursement"
                                        data-placement="top" data-toggle="modal">Edit</a>
                                    <a class="dropdown-item delete" href="#" data-toggle="modal" data-target="#modal-delete">Delete</a>

                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

</div>
<div class="modal fade" id="addReimbursement" style="display: none;">
    @include('admin.reimbursements.create')
</div>
<div class="modal fade" id="showReimbursement" style="display: none;">
    @include('admin.reimbursements.show')
</div>
<div class="modal fade" id="editReimbursement" style="display: none;">
    @include('admin.reimbursements.edit')
</div>
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    @include('admin.reimbursements.delete')
</div>
<!-- /.row (main row) -->
@endsection