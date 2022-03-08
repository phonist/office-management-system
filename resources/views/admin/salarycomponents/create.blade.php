<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">Add Salary Component</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <form action="{{ route('salarycomponents.store') }}" id="form" method="post" class="form-horizontal">
            @csrf
            <div class="modal-body form">

                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Component Name</label>
                        <div class="col-md-9">
                            <input name="component_name" class="form-control autocomplete_off" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <table style="width: 100%; padding-left: 50px">
                        <tbody>
                            <tr style="height: 50px">
                                <td>
                                    <label for="exampleInputEmail1">Type <span class="required">*</span></label>
                                </td>

                                <td>
                                    <label class="css-input css-radio css-radio-success push-10-r">
                                        <input name="type" value="1" type="radio"><span></span>Earning
                                    </label>
                                </td>
                                <td>
                                    <label class="css-input css-radio css-radio-success push-10-r">
                                        <input name="type" value="2" type="radio"><span></span> Deduction </label>
                                </td>
                            </tr>

                            <tr style="height: 50px">
                                <td>
                                    <label for="exampleInputEmail1">Add to<span class="required">*</span></label>
                                </td>
                                <td>

                                    <label class="css-input css-checkbox css-checkbox-success">
                                        <input name="total_payable" value="1" type="checkbox"><span></span> Total
                                        Payable </label>
                                </td>
                                <td>
                                    <label class="css-input css-checkbox css-checkbox-success">
                                        <input name="cost_company" value="1" type="checkbox"><span></span> Cost to
                                        Company </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                </td>
                                <td colspan="2">
                                    <span class="chk_error_msg"></span>
                                </td>

                            </tr>


                            <tr style="height: 50px">
                                <td>
                                    <label for="exampleInputEmail1">Value Type<span class="required">*</span></label>
                                </td>
                                <td>
                                    <label class="css-input css-radio css-radio-success push-10-r">
                                        <input name="value_type" value="1" type="radio"><span></span>Amount
                                    </label>
                                </td>
                                <td>
                                    <label class="css-input css-radio css-radio-success push-10-r">
                                        <input name="value_type" value="2" type="radio"><span></span> Percentage
                                    </label>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </div>


            </div>


            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>