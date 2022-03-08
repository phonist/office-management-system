<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-warning">
            <h5 class="modal-title" id="exampleModalLabel">Return Purchase</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="updateReturnProd" action="" method="post" enctype="multipart/form-data">
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
                            <th class="active">Returned</th>
                            <th class="active">Return Qty</th>

                        </tr>
                    </thead><!-- / Table head -->

                    <tbody id="return_prod_list">
                        <!-- / Table body -->


                    </tbody><!-- / Table body -->
                    <tr class="custom-tr prod_return_clone" hidden>
                        <td class="vertical-td numbering">
                        </td>
                        <td class="vertical-td prod_name">
                            <br>
                            <span style=" color: #E13300" id="msg32"></span>
                        </td>
                        <td class="vertical-td pur_qty"> </td>
                        <td class="vertical-td receive"> </td>
                        <td class="vertical-td return"> </td>


                        <td class="vertical-td">
                            <input type="text" class="form-control return_amt" value="" name="" style="width: 100px">
                            <span style=" color: #E13300" id="exceedReturn"></span>
                        </td>

                        <input type="hidden" class="purchase_prod_id" name="" value="">
                        <!--get all sub category if not this empty-->


                    </tr>
                </table>
            </div>
            <!-- / Table -->


            <div class="modal-footer">
                <input type="hidden" class="purchaseId" name="purchaseId" value="">
                <button type="button" id="close" class="btn btn-danger btn-flat pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn bg-olive btn-flat" id="updateReturnProdbtn">Save</button>


            </div>
        </form>
    </div>
</div>