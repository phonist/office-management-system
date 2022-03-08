@extends('admin.layouts.layout-basic')

@section('styles')
@endsection
@section('scripts')
<script src="{{ asset('/assets/admin/js/jquery.PrintArea.js') }}"></script>
<script src="/assets/admin/js/pages/datatables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js"
    integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs" crossorigin="anonymous">
</script>
<script>
    init();

    function init() {
        $('.autocomplete_off').attr('autocomplete', 'off');
    }

    $(document.body).on('click', '.editaward', function () {

        $award_id = $(this).siblings('input').val();
        $('#editAward').attr('action', '/admin/employeeAwards/' + $award_id);
        $.get('/admin/employeeAwards/' + $award_id + '/edit', function (data) {
            $('.edit_department_id > option').each(function () {
                if ($(this).val() == data['department_id']) {
                    $(this).attr('selected', 'selected');
                } else {
                    $(this).removeAttr('selected');
                }
            });
            $('.edit_employee_id > option').each(function () {
                if ($(this).val() == data['employee_id']) {
                    $(this).attr('selected', 'selected');
                } else {
                    $(this).removeAttr('selected');
                }
            });
            $('.edit_award_name').val(data['award']);
            $('.edit_gift_item').val(data['gift']);
            $('.edit_award_amount').val(data['amount']);
            $('.edit_month').val(data['month']);
        });
    });
    $('.delete').click(function () {
        var id = $(this).siblings('input').val();
        $('#form-d-award').attr('action', '/admin/employeeAwards/' + id);
    });
</script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">AWARD <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('employeeAwards.index') }}">Employee Award</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="caption">
                                <h6>Employee Award</h6>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card-body table-responsive">
                    <table id="responsive-datatable" class="table table-bordered table-striped">



                        <thead>
                            <tr>
                                <th>Employee
                                    Id</th>
                                <th>Employee
                                    Name</th>
                                <th>Award Name / Title</th>
                                <th>Gift
                                    Item</th>
                                <th>Award
                                    Amount</th>
                                <th>Month</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if($awards->isEmpty())
                            <div class="card text-white bg-info text-sm-center">
                                <div class="card-body">
                                    <blockquote class="card-bodyquote">
                                        <p>Hi, the database don't have any employee award yet</p>
                                    </blockquote>
                                </div>
                            </div>
                            @else
                            @foreach($awards as $award)
                            <tr role="row" class="odd">
                                <td>
                                    {{ $award->userId($award->id) }}
                                </td>
                                <td>{{ $award->userFName($award->id) }} {{ $award->userLName($award->id) }}</td>
                                <td class="sorting_1">{{ $award->award }}</td>
                                <td>{{ $award->gift }}</td>
                                <td>{{ $award->amount }}</td>
                                <td>{{ $award->timeFormat($award->month) }}</td>
                            </tr>
                            @endforeach
                            @endif

                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection