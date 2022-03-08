@extends('admin.layouts.layout-basic')

@section('styles')
@endsection
@section('scripts')
<script src="{{ asset('/assets/admin/js/jquery.PrintArea.js') }}"></script>
<script src="/assets/admin/js/pages/datatables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs"
    crossorigin="anonymous"></script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Working Days <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">Working Days</a></li>
        </ol>
    </div>

    <div class="row">

        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Working Days</h6>
                    </div>

                </div>
                <form action="{{ route('workingdays.store') }}" method="post" accept-charset="utf-8">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7 col-sm-12 col-xs-12 col-md-offset-2">


                                <label class="css-input css-checkbox css-checkbox-success">
                                    @if($work[0]['work']==0)
                                    <input type="checkbox" name="working_days[]" value="6"><span></span>
                                    Saturday
                                    @else
                                    <input type="checkbox" name="working_days[]" value="6" checked><span></span>
                                    Saturday
                                    @endif
                                    <input type="hidden" name="days[]" value="6">
                                </label>
                                <label class="css-input css-checkbox css-checkbox-success">
                                    @if($work[1]['work']==0)
                                    <input type="checkbox" name="working_days[]" value="7"><span></span> Sunday
                                    @else
                                    <input type="checkbox" name="working_days[]" value="7" checked><span></span>
                                    Sunday
                                    @endif

                                    <input type="hidden" name="days[]" value="7">
                                </label>
                                <label class="css-input css-checkbox css-checkbox-success">
                                    @if($work[2]['work']==0)
                                    <input type="checkbox" name="working_days[]" value="1"><span></span>
                                    Monday
                                    @else
                                    <input type="checkbox" name="working_days[]" value="1" checked><span></span>
                                    Monday
                                    @endif
                                    <input type="hidden" name="days[]" value="1">
                                </label>
                                <label class="css-input css-checkbox css-checkbox-success">
                                    @if($work[3]['work']==0)
                                    <input type="checkbox" name="working_days[]" value="2"><span></span>
                                    Tuesday
                                    @else
                                    <input type="checkbox" name="working_days[]" value="2" checked><span></span>
                                    Tuesday
                                    @endif
                                    <input type="hidden" name="days[]" value="2">
                                </label>
                                <label class="css-input css-checkbox css-checkbox-success">
                                    @if($work[4]['work']==0)
                                    <input type="checkbox" name="working_days[]" value="3"><span></span>
                                    Wednesday
                                    @else
                                    <input type="checkbox" name="working_days[]" value="3" checked><span></span>
                                    Wednesday
                                    @endif
                                    <input type="hidden" name="days[]" value="3">
                                </label>
                                <label class="css-input css-checkbox css-checkbox-success">
                                    @if($work[5]['work']==0)
                                    <input type="checkbox" name="working_days[]" value="4"><span></span>
                                    Thursday
                                    @else
                                    <input type="checkbox" name="working_days[]" value="4" checked><span></span>
                                    Thursday
                                    @endif
                                    <input type="hidden" name="days[]" value="4">
                                </label>
                                <label class="css-input css-checkbox css-checkbox-success">
                                    @if($work[6]['work']==0)
                                    <input type="checkbox" name="working_days[]" value="5"><span></span>
                                    Friday
                                    @else
                                    <input type="checkbox" name="working_days[]" value="5" checked><span></span>
                                    Friday
                                    @endif
                                    <input type="hidden" name="days[]" value="5">
                                </label>




                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <button id="saveSalary" type="submit" class="btn btn-primary col-md-offset-2"><i class="fa fa-save"></i>
                            Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid spark-screen">

    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border bg-primary-dark">
                    <h3 class="box-title">Set Working Days</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->



            </div>
        </div>
    </div>
</div>
<!-- /.row (main row) -->
@endsection