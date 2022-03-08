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
        totalDeduction();
        totalEarning();
        costToTheCompany();
    }
    $("#SalaryForm :input").attr("disabled", true);
    var contactForm = $("#SalaryForm");
    $('#editSalary').click(function (event) {
        //event.preventDefault();
        contactForm.find(':disabled').each(function () {
            $(this).removeAttr('disabled');
            $('#saveSalary').show();
            $('#cancelSalary').show();
            $('#editSalary').hide();
        });
    });

    $('#cancelSalary').click(function (event) {
        //event.preventDefault();
        contactForm.find(':enabled').each(function () {
            $(this).attr("disabled", "disabled");
            $('#saveSalary').hide();
            $('#cancelSalary').hide();
            $('#editSalary').show();
        });
    });
    function show_monthly() {
        document.getElementById('hourly').style.display = 'none';
        document.getElementById('monthly').style.display = 'block';
    }

    function show_hourly() {
        document.getElementById('hourly').style.display = 'block';
        document.getElementById('monthly').style.display = 'none';
    }

    $('.deduction').keyup(function(){
        totalDeduction();
        costToTheCompany();
    });

    $('.earning').keyup(function(){
        totalEarning();
        costToTheCompany();
    });

    function totalDeduction(){
        let totalDeduction = 
        parseInt($('#earn5').val())+
        parseInt($('#earn6').val())+
        parseInt($('#earn7').val());
        $('#totalDeduction').val(totalDeduction);
        $('#resultTotalDeduction').html(totalDeduction);
    }

    function totalEarning(){
        let totalEarning = 
        parseInt($('#earn1').val())+
        parseInt($('#earn2').val())+
        parseInt($('#earn3').val())+
        parseInt($('#earn4').val())+
        parseInt($('#earn8').val());
        $('#totalPayable').val(totalEarning);
        $('#resultTotalPayable').html(totalEarning);
    }
    function costToTheCompany(){
        let result = $('#totalPayable').val() - $('#totalDeduction').val();
        $('#totalCostCompany').val(result);
        $('#resultCostToCompany').html(result);
    }
</script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Employee <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('employees.index') }}">Dependents</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-3">
            @include('admin.employees.sidebar')
        </div>
        <div class="col-lg-9 col-md-9 col-xs-9">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Employee Salary Details</h6>
                    </div>
                </div>

                <form id="SalaryForm" action="{{ route('employeeSalaries.update',$salary->id) }}" enctype="multipart/form-data"
                    method="post" accept-charset="utf-8">
                    @method('put')
                    @csrf
                    <div class="card-body">

                        <div class="box-header with-border bg-primary-dark">
                            <h3 class="box-title">Employee Salary Details</h3>
                        </div>



                        <div class="row">
                            <div class="col-md-12">
                                <div class="well well-lg">
                                    <h4>Salary Type</h4> <br>
                                    <input type="radio" name="type" value="Monthly" checked="" onclick="show_monthly();">
                                    Monthly Salary &nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="type" value="Hourly" onclick="show_hourly();">
                                    Hourly Salary
                                </div>
                            </div>
                        </div>

                        <div id="hourly" style="display: none">

                            <div class="row">
                                <div class="col-md-8">

                                    <div class="form-group">
                                        <label>Hourly Salary <span class="required">*</span></label>
                                        <input type="text" class="form-control autocomplete_off" name="hourly_salary"
                                            value="{{ $salary->hourly_salary }}">
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div id="monthly" style="display: block">

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Pay Grade<span class="required">*</span></label>
                                        <select class="form-control" name="grade_id" id="salaryGrade">
                                            @if($salary->pay_grade == "" || $salary->pay_grade == null)
                                            <option value="" selected>Please Select</option>
                                            <option value="Grade-1">
                                                Grade-1</option>
                                            <option value="Grade-2">
                                                Grade-2</option>
                                            @elseif($salary->pay_grade == "Grade-1")
                                            <option value="Grade-1" selected>
                                                Grade-1</option>
                                            <option value="Grade-2">
                                                Grade-2</option>
                                            @elseif($salary->pay_grade == "Grade-2")
                                            <option value="Grade-1">
                                                Grade-1</option>
                                            <option value="Grade-2" selected>
                                                Grade-2</option>
                                            @endif

                                        </select>
                                        <span id="resultSalaryRange"></span>
                                        <input type="hidden" id="min_salary">
                                        <input type="hidden" id="max_salary">
                                    </div>

                                    <div class="form-group">
                                        <label>Comment</label>
                                        <textarea class="form-control" name="comment">{{ $salary->comment }}</textarea>
                                    </div>

                                </div>
                            </div>

                            <br>
                            <br>
                            <h4>Salary - All Earnings</h4>
                            <hr>


                            <div class="row">
                                <div class="col-md-8">


                                    <div class="row">
                                        <div class="col-sm-6">Basic Payment<strong>(Amount)</strong></div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" name="basic_payment" class="form-control key earning autocomplete_off"
                                                    id="earn1" value="{{ $salary->basic_payment }}">
                                                <span class="required" id="errorSalaryRange"></span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">Car Allowance<strong>(Percentage)</strong></div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" name="car_allowance" class="form-control key earning autocomplete_off"
                                                    id="earn2" value="{{ $salary->car_allowance }}">
                                                <span class="required" id="errorSalaryRange"></span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">Medical Allowance<strong>(Percentage)</strong></div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" name="medical_allowance" class="form-control key earning autocomplete_off"
                                                    id="earn3" value="{{ $salary->medical_allowance }}">
                                                <span class="required" id="errorSalaryRange"></span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">Living Allowance<strong>(Amount)</strong></div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" name="living_allowance" class="form-control key earning autocomplete_off"
                                                    id="earn4" value="{{ $salary->living_allowance }}">
                                                <span class="required" id="errorSalaryRange"></span>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">House Rent<strong>(Percentage)</strong></div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" name="house_rent" class="form-control key earning autocomplete_off"
                                                    id="earn8" value="{{ $salary->house_rent }}">
                                                <span class="required" id="errorSalaryRange"></span>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </div>

                            <br>
                            <br>
                            <h4>Salary - All Deductions</h4>
                            <hr>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-sm-6">Gratuity <strong>(Amount)</strong></div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" name="gratuity" class="form-control key deduction autocomplete_off"
                                                    id="earn5" value="{{ $salary->gratuity }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">Pension Fund <strong>(Percentage)</strong></div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" name="pension" class="form-control key deduction autocomplete_off"
                                                    id="earn6" value="{{ $salary->pension }}">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">Insurance <strong>(Amount)</strong></div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" name="insurance" class="form-control key deduction autocomplete_off"
                                                    id="earn7" value="{{ $salary->insurance }}">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <br>
                            <br>
                            <h4>Salary Summary</h4>
                            <hr>
                            <div class="well well-sm">
                                <div class="row">
                                    <div class="col-md-8">

                                        <div class="row" style="padding-bottom: 15px">
                                            <div class="col-sm-6">Total Deductions :</div>
                                            <div class="col-sm-6" id="resultTotalDeduction"><strong></strong></div>
                                            <input type="hidden" name="total_deduction" id="totalDeduction" value="">
                                        </div>

                                        <div class="row" style="padding-bottom: 15px">
                                            <div class="col-sm-6">Total Payable :</div>
                                            <div class="col-sm-6" id="resultTotalPayable"><strong></strong></div>
                                            <input type="hidden" name="total_payable" id="totalPayable" value="">
                                        </div>

                                        <div class="row" style="padding-bottom: 15px">
                                            <div class="col-sm-6">Cost to the Company :</div>
                                            <div class="col-sm-6" id="resultCostToCompany"><strong></strong></div>
                                            <input type="hidden" name="total_cost_company" id="totalCostCompany" value="">
                                        </div>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <span class="required">*</span> Required field
                        <a class="btn bg-info btn-flat" id="editSalary"><i class="fa fa-pencil-square-o"></i>Edit</a>
                        <button id="saveSalary" type="submit" class="btn bg-success btn-flat" style="display:none ;"
                            disabled="disabled">Save</button>&nbsp;&nbsp;&nbsp;
                        <a class="btn bg-danger btn-flat" id="cancelSalary" style="display: none;">Cancel</a>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addTerminationModal" style="display: none;">
    @include('admin.employeeTerminations.create')
</div>
@endsection