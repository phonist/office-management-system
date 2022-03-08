<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <h5 class="modal-title" id="exampleModalLabel">View Payment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="addPayment" action="{{ route('payments.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Payment Ref.</th>
                                    <th>Payment Method</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $pay)
                                @if(isset($invoice))
                                <tr>
                                    <td>{{ $pay->date }}</td>
                                    <td>{{ $pay->reference_no }}</td>
                                    <td>{{ $pay->payment_method }}</td>
                                    <td>
                                        {{ $pay->received_amt }}@if($pay->attachment == null || $pay->attachment == "")
                                        <p style="color:chocolate">No attachment</p>
                                        @else
                                        <a href="/admin/payments/{{ $pay->attachment }}"><i class="fa fa-link"
                                                aria-hidden="true"></i></a>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="row">
                                            <input type="text" class="invoice_id" value="{{ $pay->order_id }}" hidden>
                                            @if(isset(\App\Order::where('id',$pay->order_id)->first()->client_id))
                                            <input type="text" id="client_id" value="{{ \App\Order::where('id',$pay->order_id)->first()->client_id }}"
                                                hidden>
                                            @else
                                            @endif
                                            <input type="text" id="payment_id" value="{{ $pay->id }}" hidden>
                                            <div class="col-sm-4">
                                                <div class="icon-box show_payment" data-target="#payments_show"
                                                    data-toggle="modal" data-dismiss="modal"><i class="icon-ln icon-ln-eye"></i></div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="icon-box edit_payment" data-target="#payments_edit"
                                                    data-toggle="modal" data-dismiss="modal"><i class="icon-ln icon-ln-pencil"></i></div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="icon-box danger delete_payment" data-target="#payments_delete"
                                                    data-toggle="modal" data-dismiss="modal"><i class="icon-ln icon-ln-trash"></i></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @elseif(isset($purchase))
                                <tr>
                                    <td>{{ $pay->date }}</td>
                                    <td>{{ $pay->reference_no }}</td>
                                    <td>{{ $pay->payment_method }}</td>
                                    <td>
                                        {{ $pay->received_amt }}

                                        @if($pay->attachment == null || $pay->attachment == "")
                                        <p style="color:chocolate">No attachment</p>
                                        @else
                                        <a href="/admin/payments/{{ $pay->attachment }}"><i class="fa fa-link"
                                                aria-hidden="true"></i></a>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="row">
                                            <input type="text" class="purchase_id" value="{{ $pay->purchase_id }}"
                                                hidden>
                                            @if(isset(\App\Purchase::where('id',$pay->purchase_id)->first()->vendor_id))
                                            <input type="text" id="vendor_id" value="{{ \App\Purchase::where('id',$pay->purchase_id)->first()->vendor_id }}"
                                                hidden>
                                            @else
                                            @endif
                                            <input type="text" id="payment_id" value="{{ $pay->id }}" hidden>
                                            <div class="col-sm-4">
                                                <div class="icon-box show_payment" data-target="#payments_show"
                                                    data-toggle="modal" data-dismiss="modal"><i class="icon-ln icon-ln-eye"></i></div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="icon-box edit_payment" data-target="#payments_edit"
                                                    data-toggle="modal" data-dismiss="modal"><i class="icon-ln icon-ln-pencil"></i></div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="icon-box danger delete_payment" data-target="#payments_delete"
                                                    data-toggle="modal" data-dismiss="modal"><i class="icon-ln icon-ln-trash"></i></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- edit till here --}}
            </div>
            <div class="modal-footer">
                <input type="hidden" class="purchaseId" name="purchaseId" value="">
                <input type="hidden" class="invoiceId" name="invoiceId" value="">
                <button type="button" id="close" class="btn btn-danger btn-flat pull-left" data-dismiss="modal">Close</button>
                <!-- <button class="btn btn-primary" type="submit" value="Submit" id="save_payment"><i class="fa fa-save"></i>
                    Save</button> -->
            </div>
        </form>
    </div>
</div>