@extends('admin.layouts.layout-basic')

@section('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="/assets/admin/js/pages/datatables.js"></script>
<script>
$('.view').click(function () {
    var id = $(this).siblings('.client_id').attr('id');
    $.get("/admin/client/" + id, function (data) {
        $('#inp_name').val(data['name']);
        $('#inp_company').val(data['company']);
        $('#inp_phone').val(data['phone']);
        $('#inp_fax').val(data['fax']);
        $('#inp_email').val(data['email']);
        $('#inp_website').val(data['website']);
        $('#inp_b_address').val(data['billing_address']);
        $('#inp_s_address').val(data['shipping_address']);
        $('#inp_note').val(data['note']);
    });
});
$(document).ready(function(){
    $.get('admin/chartClients',function(data){
        Highcharts.chart('chartClients', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Clients (Monthly)'
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Numbers'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: true
                }
            },
            series: [{
                name: 'Clients',
                data: data//data format is array
            }]
        });
    });
    $.get('/admin/chartSales',function(data){
        Highcharts.chart('chartSales', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Sales (Monthly)'
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Numbers'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: true
                }
            },
            series: [{
                name: 'Orders',
                data: data//data format is array
            }]
        });
    });
});

</script>
@endsection
@section('content')
<div class="main-content" id="dashboardPage">
    <div class="row">
        <div class="col-md-12 col-lg-6 col-xl-3">
            <a class="dashbox" href="{{ route('employees.index') }}">
                <i class="icon-fa icon-fa-users text-primary"></i>
                <span class="title">
                    {{ $employees }}
                </span>
                <span class="desc">
                    Employees
                </span>
            </a>
        </div>
        <div class="col-md-12 col-lg-6 col-xl-3">
            <a class="dashbox" href="{{ route('purchases.index') }}">
                <i class="icon-fa icon-fa-ticket text-success"></i>
                <span class="title">
                    {{ $purchases }}
                </span>
                <span class="desc">
                    Purchase(s)
                </span>
            </a>
        </div>
        <div class="col-md-12 col-lg-6 col-xl-3">
            <a class="dashbox" href="{{ route('orders.index') }}">
                <i class="icon-fa icon-fa-shopping-cart text-danger"></i>
                <span class="title">
                    {{ $orders }}
                </span>
                <span class="desc">
                    Order(s)
                </span>
            </a>
        </div>
        <div class="col-md-12 col-lg-6 col-xl-3">
            <a class="dashbox" href="{{ route('inventory.index') }}">
                <i class="icon-fa icon-fa-cubes text-info"></i>
                <span class="title">
                    {{ $products }}
                </span>
                <span class="desc">
                    Inventories
                </span>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xl-6 mt-2">
            <div class="card">
                <div class="card-header">
                    <h6><i class="icon-fa icon-fa-line-chart text-warning"></i>Clients Chart</h6>
                </div>
                <div class="card-body">
                    {{-- <line-chart :labels="['Jan','Feb','Mar','June']" :values="[20,30,40,60]"></line-chart> --}}
                    <div id='chartClients'></div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-6 mt-2">
            <div class="card">
                <div class="card-header">
                    <h6><i class="icon-fa icon-fa-bar-chart text-success"></i> Sales Chart</h6>
                </div>
                <div class="card-body">
                    {{-- <bar-chart :labels="['Jan','Feb','Mar','June']" :values="[20,30,40,60]"></bar-chart> --}}
                    <div id='chartSales'></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xl-6 mt-2">
            <div class="card">
                <div class="card-header">
                    <h6><i class="icon-fa icon-fa-shopping-cart text-danger"></i> Recent Orders</h6>
                </div>
                <div class="card-body">
                    <table id="dashboard-new-orders-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                                @if($AllOrder != [])
                                @foreach($AllOrder as $order)
                                <tr>
                                <td>{{ \App\Client::where('id',$order->client_id)->first()->name }}</td>
                                <td>{{ $order->invoice_date }}</td>
                                <td>{{ $order->g_total}}</td>
                                <td>
                                    <input type="hidden" class="client_id" id="{{ $order->id }}">
                                    <a class="btn btn-default btn-xs" href="/admin/orders/{{ $order->id }}">View</a>
                                </td>
                                </tr>
                
                                @endforeach
                                @else
                                No Orders in database
                                @endif
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-6 mt-2">
            <div class="card">
                <div class="card-header">
                    <h6><i class="icon-fa icon-fa-users text-info"></i> New Customers</h6>
                </div>
                <div class="card-body">
                    <table id="dashboard-new-customers-datatable" class="table table-striped table-bordered responsive-datatable" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                                @if($clients != [])
                                @foreach($clients as $client)
                                <tr>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->created_at }}</td>
                                <td>{{ $client->open_balance}}</td>
                                <td>
                                    <input type="hidden" class="client_id" id={{ $client->id }}>
                                    <a class="btn btn-default btn-xs view" href="#" data-toggle="modal" data-target="#modal-view">View</a>
                                </td>
                                </tr>
                
                                @endforeach
                                @else
                                No Clients in database
                                @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    @include('admin.clients.show')
</div>
@stop

