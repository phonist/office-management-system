<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <h5 class="modal-title" id="exampleModalLabel">Edit Reimbursement</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" id="form" class="editReimbursementForm" method="post">
            @method('put')
            @csrf
            <div class="modal-body">
                <!-- View massage -->

                <div class="form-group">
                    <label class="col-sm-4 col-lg-4 control-label">Date<span class="required">*</span></label>


                    <div class="input-group col-sm-8 col-lg-8">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="icon-fa icon-fa-calendar"></i>
                            </span>
                        </div>
                        <input type="text" name="date" class="edit_date form-control ls-datepicker autocomplete_off" value="" data-date-format="yyyy-mm-dd">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-4 col-lg-4 control-label">Department <span class="required">*</span></label>

                    <div class="col-sm-8 col-lg-8">
                        <select name="department_id" id="department" class="edit_department form-control input-md">
                            @if (!$departments->isEmpty())
                            <option value="">Please Select</option>
                            @foreach($departments as $department)
                            <option value="{{ $department->id}}">
                                {{ $department->name }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-4 col-lg-4 control-label">Employee <span class="required">*</span></label>

                    <div class="col-sm-8 col-lg-8">
                        <select name="employee_id" id="department" class="edit_employee form-control input-md">
                            @if (!$employees->isEmpty())
                            <option value="">Please Select</option>
                            @foreach($employees as $employee)
                            <option value="{{ $employee->id}}">
                                {{ $employee->f_name }} {{ $employee->l_name }}</option>
                            @endforeach
                            @endif
                        </select>

                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-4 col-lg-4 control-label">Amount<span class="required">*</span></label>

                    <div class="col-sm-8 col-lg-8">
                        <input type="number" class="edit_amount form-control input-md autocomplete_off" name="amount" value="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 col-lg-4 control-label">Description<span class="required">*</span></label>

                    <div class="col-sm-8 col-lg-8">
                        <textarea class="form-control input-md edit_description autocomplete_off" rows="8" name="memo"></textarea>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-4 col-lg-4 control-label">Approved by Manager</label>

                    <div class="col-sm-8 col-lg-8">
                        <input type="text" class="form-control input-md edit_mapproved" value="" readonly="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 col-lg-4 control-label">Manager Comment</label>

                    <div class="col-sm-8 col-lg-8" style="margin-top: 5px">
                        <textarea class="form-control input-md edit_mcomment autocomplete_off" name="manager_comment" readonly=""></textarea>

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 col-lg-4 control-label">Approved by Admin</label>

                    <div class="col-sm-8 col-lg-8">
                        <select class="form-control input-md" class="edit_aapproved" name="approved_admin">
                            <option value="0">Pending</option>
                            <option value="1">Approved</option>
                            <option value="2">Reject</option>
                        </select>
                    </div>
                </div>

                <div class="form-group margin">
                    <label class="col-sm-4 col-lg-4 control-label">Admin Comment</label>

                    <div class="col-sm-8 col-lg-8">
                        <textarea class="form-control input-md edit_acomment autocomplete_off" name="admin_comment">Approved and Collect Money</textarea>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-5">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>
                            Update Reimbursement</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>