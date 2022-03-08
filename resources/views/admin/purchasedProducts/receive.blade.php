
<div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="exampleModalLabel">Received Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="updateReceivedProd" action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <table class="table table-bordered table-hover purchase-products" id="myTable">
                        <thead>
                            <!-- Table head -->
                            <tr>
                                <th class="active col-sm-1">Sl</th>
                                <th class="active">Product</th>
                                <th class="active">Purchase Qty</th>
                                <th class="active">Received</th>
                                <th class="active">Received Qty</th>

                            </tr>
                        </thead><!-- / Table head -->
                        <tbody id="received_prod_list">
                        </tbody><!-- / Table body -->
                        <tr class="custom-tr prod_received_clone" hidden>
                            <td class="vertical-td purchase_prod_number">
                            </td>
                            <td class="vertical-td purchase_prod">
                            
                                <br>
                                <span style="color: #E13300" id="msg"></span>
                            </td>
                            <td class="vertical-td purchase_qty"> </td>
                            <td class="vertical-td received_amt"> </td>
                            <td class="vertical-td">
                                <input type="text" class="form-control received_inp" name="" style="width: 100px">
                                <span style="color: #E13300" class="exceedMsg"></span>
                            </td>


                            <input type="hidden" class="purchase_prod_id" name="" value="">
                        </tr>
                    </table> <!-- / Table -->
                    <input type="hidden"
                     class="purchaseId" name="purchaseId" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" id="close" class="btn btn-danger btn-flat pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-navy" id="updateReceivedProdbtn">Update </button>

                </div>
            </form>
        </div>
    </div>