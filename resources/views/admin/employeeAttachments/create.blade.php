<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">Attachment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <form action="{{ route('employeeAttachments.store') }}" id="personalAttach" enctype="multipart/form-data" method="post"
            accept-charset="utf-8">
            @csrf
            <div class="modal-body">

                <div class="form-group">
                    <label for="exampleInputEmail1">Attachment<span class="required">*</span></label>
                    <input type="file" name="file" class="form-control" required>
                </div>


                <div class="form-group">
                    <label for="exampleInputEmail1">Description<span class="required">*</span></label>
                    <input type="text" name="description" class="form-control autocomplete_off" required>
                </div>

            </div>

            <div class="modal-footer">
                <input type="hidden" name="user_id" value="{{ $employee->id }}">

                <span class="required">*</span> Required field

                <button type="button" id="close" class="btn btn-danger btn-flat pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn bg-olive btn-flat" id="btn">Save</button>


            </div>
        </form>
    </div>
</div>