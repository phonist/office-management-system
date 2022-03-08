@extends('admin.layouts.layout-basic')

@section('styles')
@endsection
@section('scripts')
<script src="{{ asset('/assets/admin/js/jquery.PrintArea.js') }}"></script>
<script src="/assets/admin/js/pages/datatables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs"
    crossorigin="anonymous"></script>
<script>
    $(function () {
    init();
    function init(){
        $('.autocomplete_off').attr('autocomplete','off');
    }
})
</script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Import <small class="text-muted">employee</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('employees.import') }}">Import Employee(s)</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Import Employee(s)</h6>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('employees.importEmployee') }}" enctype="multipart/form-data" method="post"
                        accept-charset="utf-8">
                        @csrf

                        <div class="box-body">

                          
                            <div class="row">
                                <div class="col-md-6">
                                   
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Import Employee</label>
                                                        <input type="file" name="importEmployee" class="form-control"
                                                            required>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>



                                </div>

                                <div class="col-md-6">
                                    <strong>Download Sample CSV File</strong><br>
                                    <a href="{{ route('employees.downloadSample') }}"><i class="fa fa-download"
                                            aria-hidden="true"></i> Sample CSV File</a>
                                </div>
                            </div>


                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button class="btn btn-primary" type="submit" value="Submit"><i class="fa fa-upload"></i>
                                Import Employee</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection