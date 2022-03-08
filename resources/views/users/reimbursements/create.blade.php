

<div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel">Add Reimbursement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
    
            <form action="{{ route('reimbursements.store') }}" id="form" method="post" class="form-horizontal">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            
                            <div class="col-sm-10">
                                <label class="control-label">Date<span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <i class="icon-fa icon-fa-calendar"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="date" data-date-format="yyyy-mm-dd" class="form-control ls-datepicker input-sm autocomplete_off" value="">
                                </div>
                            </div>
                        </div>
    
    
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Amount<span class="required">*</span></label>
    
                            <div class="col-sm-10">
                                <input type="number" class="form-control input-md autocomplete_off" name="amount" value="">
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Description<span class="required">*</span></label>
    
                            <div class="col-sm-10">
                                <textarea class="form-control input-md autocomplete_off" rows="8" name="memo"></textarea>
                            </div>
                        </div>
    
    
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
        </div>
    </div>