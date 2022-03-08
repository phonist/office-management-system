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
        <h3 class="page-title">Purchases <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('orders.index') }}">Purchase List</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Received Product</h6>
                    </div>
                    <div class="actions">
                        <button class="btn btn-primary btn-sm" onclick="location.href='{{ route('purchaseProduct.export') }}'"> <i
                                class="icon-fa icon-fa-plus"></i> Export</button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="responsive-datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Date Time</th>
                                <th>Purchase No</th>
                                <th>Supplier</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Received By</th>
                            </tr>
                        </thead>

                        @if (!$purchaseproducts->isEmpty())
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

                            @foreach($purchaseproducts as $product)

                            <tr>
                                <td>
                                    {{ $product->created_at }} </td>
                                <td>
                                    {{ $product->getPurchaseCode($product->purchase_id) }} </td>
                                <td>
                                    {{
                                       $product->getVendor($product->purchase_id)
                                    }} </td>
                                <td>
                                    {{ $product->inventory($product->inventory_id) }}</td>
                                <td>
                                    {{ $product->quantity }} </td>
                                <td>
                                    {{ $product->receiver }}
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                        @else
                        <tbody>
                            <div class="card text-white bg-info text-sm-center">
                                <div class="card-body">
                                    <blockquote class="card-bodyquote">
                                        <p>Hi, you don't have any received product(s) yet</p>

                                    </blockquote>
                                </div>
                            </div>
                        </tbody>
                        @endif
                        <tfoot>
                            <tr>
                                <th>Date Time</th>
                                <th>Purchase No</th>
                                <th>Supplier</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Received By</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection