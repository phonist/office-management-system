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
        <h3 class="page-title">INVENTORY <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('inventory.import') }}">Import Inventory Excel(csv)</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Import csv inventories</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <strong>Download Sample CSV File</strong><br>
                                            <a href="{{ route('inventory.download') }}"><i class="fa fa-download"
                                                    aria-hidden="true"></i> Sample CSV
                                                File</a>
                                            <br>
                                            <br>
                                            <p>Product Type:</p>
                                            <p>Inventory Product Type use -&gt; '<strong>Inventory</strong>'</p>
                                            <p>Non Inventory Product Type use -&gt; '<strong>Non-Inventory</strong>'</p>
                                            <p>Service Product Type use -&gt; '<strong>Service</strong>'</p>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Import Product</label>
                                <form action="{{ route('inventory.importInventory') }}" class="form-horizontal" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <h6><label for="import_file">Please Select File (CSV only):</label>
                                        <input type="file" id="import_file" name="import_file" /></h6>
                                    <h6><input class="btn bg-navy btn-sm" type="submit" name="upload" value="Import" /></h6>
                                </form>
                            </div>

                        </div>

                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Use Product Category ID and Tax ID when prepare CSV file.</h5>
                                </div>
                                <div class="col-md-6">
                                    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Product Category</th>
                                            </tr>
                                            <tr>
                                                <th>Category ID</th>
                                                <th>Category</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!$categories->isEmpty())
                                            @foreach($categories as $index=>$category)
                                            <tr>
                                                <td>{{ $index+1 }}</td>
                                                <td>{{ $category->name }}</td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                No Category
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-md-6">
                                    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th colspan="3">Tax Table</th>
                                            </tr>
                                            <tr>
                                                <th>Tax ID</th>
                                                <th>Tax Rate</th>
                                                <th>Tax Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!$taxes->isEmpty())
                                            @foreach($taxes as $index=>$tax)
                                            <tr>
                                                <td>{{ $index+1 }}</td>
                                                <td>{{ $tax->rate }}</td>
                                                <td>{{ $tax->type }}</td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                No Tax
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection