< <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">Add Holiday</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <form action="{{ route('holidays.store') }}" id="holiday" enctype="multipart/form-data" method="post"
            accept-charset="utf-8">
            @csrf
            <div class="modal-body">

                <div class="form-group">
                    <label for="exampleInputEmail1">Event Name<span class="required">*</span></label>
                    <input type="text" name="event_name" value="" class="form-control autocomplete_off" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Description<span class="required">*</span></label>
                    <textarea class="form-control autocomplete_off" name="description" required></textarea>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Start Date<span class="required">*</span></label>
                   

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="icon-fa icon-fa-calendar"></i>
                            </span>
                        </div>
                        <input type="text" name="start_date" id="start_date" class="form-control ls-datepicker autocomplete_off" data-date-format="yyyy-mm-dd" value="" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">End Date<span class="required">*</span></label>
                

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="icon-fa icon-fa-calendar"></i>
                            </span>
                        </div>
                        <input type="text" name="end_date" class="form-control ls-datepicker autocomplete_off" data-date-format="yyyy-mm-dd" value="" required>
                    </div>
                </div>
            </div>


            <div class="modal-footer">
                <input type="hidden" name="holiday_id" value="">

                <span class="required">*</span> Required field
                <button type="button" id="close" class="btn btn-danger btn-flat pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn bg-olive btn-flat" id="btn">Save</button>
            </div>
        </form>
    </div>
    </div>