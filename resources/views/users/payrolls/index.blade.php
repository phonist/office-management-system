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
    $(document.body).on('click', '.showPayroll', function () {
        $payroll_id = $(this).siblings('input').val();
        $.get("/users/payrolls/" + $payroll_id, function (data) {
            $('.show_name').text(data[1][0]['name']);
            $('.show_department').text(data[2]);
            $('.show_id').text(data[1][0]['id_number']);
            $('.show_jobtitle').text(data[3]);
            $('.show_gsalary').text(data[0]['basic_payment']);
            $('.show_deduction').text(data[0]['total_deduction']);
            $('.show_salary').text(data[0]['total_payable']);
            $('.show_fdeduction').text(data[0]['cost_to_company']);
            $('.show_bonus').text(data[0]['basic_payment']);
            $('.show_payment_amt').text(data[0]['basic_payment']);
            $('.show_payment_method').text(data[0]['basic_payment']);
            $('.show_comment').text(data[0]['basic_payment']);
        });
    });

</script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Pay Grades <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">Pay Grades</a></li>
        </ol>
    </div>

    <div class="row">

        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>{{ Auth::user()->name }}'s Payroll List</h6>
                    </div>
                    
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="responsive-datatable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>Employee Id</th>
                                    <th>Employee Name</th>
                                    <th>Job Title</th>
                                    <th>Gross Salary/Hourly Salary</th>
                                    <th>Payment Amount</th>
                                    <th>Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($salaries->isEmpty())
                                <div class="card text-white bg-info text-sm-center">
                                    <div class="card-body">
                                        <blockquote class="card-bodyquote">
                                            <p>Hi, the database don't have any employee award yet</p>
                                        </blockquote>
                                    </div>
                                </div>
                                @else
                                @foreach($salaries as $salary)
                                <tr role="row" class="odd">
                                    <td></td>
                                    <td>
                                        {{ $salary->userId($salary->id) }}
                                       </td>
                                    <td>{{ $salary->userName($salary->id) }}</td>
                                    <td>{{ $salary->jobTitle($salary->id) }}</td>
                                    <td>{{ $salary->basic_payment }}</td>
                                    <td>{{ $salary->total_payable }}</td>
                                    <td>{{ $salary->type }}</td>
                                    <td>
                                        <input type="text" value="{{ $salary->id }}" hidden>
                                        <button type="button" class="btn btn-icon btn-outline-info showPayroll"
                                        data-target="#showPayroll" data-toggle="modal"><i class="icon-fa icon-fa-eye"></i></button>
                                    </td>
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
</div>
<div class="modal fade" id="showPayroll" style="display: none;">
    @include('users.payrolls.show')
</div>
@endsection