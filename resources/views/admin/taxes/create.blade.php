<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">Add Tax</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <form action="{{ route('taxes.store') }}" method="post" id="form" class="form-horizontal">
            @csrf
            <div class="modal-body form">

                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Name</label>
                        <div class="col-md-9">
                            <input name="name" class="form-control autocomplete_off" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Rate</label>
                        <div class="col-md-9">
                            <input type="text" name="rate" class="form-control autocomplete_off">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Tax Type</label>
                        <div class="col-md-9">
                            <select class="form-control" name="type">
                                <option value="1">Percentage (%)</option>
                                <option value="2">Fixed ($)</option>
                            </select>
                            <span class="help-block"></span>
                        </div>
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