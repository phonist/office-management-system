<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <h5 class="modal-title" id="myModalLabel">View Payment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-lable="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="printPayment" id="printPayment">
                <table width="100%" cellpadding="10" cellspacing="15">
                    <tbody>
                        <tr>
                            <td width="50%"><img src="" style="height: 100px; width: 150px"></td>
                            <td width="50%">
                                <h4>Date: <b id="payment_date"></b> </h4>
                                @if(isset($invoice))
                                <h4>Sales Ref: <b id="sales_ref"></b></h4>
                                @elseif(isset($purchase))
                                <h4>Purchase Ref: <b id="purchase_ref"></b></h4>
                                @endif
                                <h4>Payment Ref: <b id="payment_ref"></b></h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            @if(isset($invoice))
                            <address id="client_address">
                                    <!-- To: <br>
                                    <h4>Sanitary Grocery Stores</h4>
                                    117 E Scooba St, Hattiesburg, MS, 39401 <br>
                                    Phone: (541) 563-2081<br>
                                    Email: sara@email.com -->
                                </address>
                            @elseif(isset($purchase))
                            <address id="vendor_address">
                                    <!-- To: <br>
                                    <h4>Sanitary Grocery Stores</h4>
                                    117 E Scooba St, Hattiesburg, MS, 39401 <br>
                                    Phone: (541) 563-2081<br>
                                    Email: sara@email.com -->
                                </address>
                            @endif
                                
                            </td>
                            <td>
                                <address id="office_address">
                                    <!-- From: <br>
                                    <h4>eOffice Manager</h4>
                                    360 Edgefield Circle Butte, MT 59701<br>
                                    Phone: 203-962-5164<br>
                                    Email: support@codeslab.net -->
                                </address>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="background:#F5F5F5; border:solid 1px #ccc;">
                                <table width="100%" border="0" cellpadding="5" cellspacing="5">
                                    <tbody>
                                        <tr style="">
                                            <td style="padding: 10px">
                                                <h4>Payment Sent</h4>
                                            </td>
                                            <td align="right" style="padding: 10px">
                                                <h4 id="payment_received"> </h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 10px">
                                                <h4>Paid by </h4>
                                            </td>
                                            <td align="right" style="padding: 10px">
                                                <h4 id="payment_type"></h4>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="border-top: dotted 2px #ccc">Authorized Signature</td>
                            <td>&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <br>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-danger btn-flat pull-left" data-dismiss="modal">Close</button>
                <a id="print_payment" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function () {
        console.log('show payment');
        $("#print_payment").click(function () {
            var prtContent = document.getElementById("printPayment");
            var WinPrint = window.open('', '',
                'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
            WinPrint.document.write(prtContent.innerHTML);
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();
        });
    });
</script>
@endpush
