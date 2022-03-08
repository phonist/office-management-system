<div id="modalSmall" class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Termination of Employment</h4>
        </div>

        <div class="modal-body">

            <form action="{{ route('employeeTerminations.update',$terminated->id) }}" id="holiday" enctype="multipart/form-data"
                method="post" accept-charset="utf-8">
                @method('put')
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Termination Date<span class="required">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control datepicker autocomplete_off" required="" name="termination_date" id="datepicker"
                            value="{{ $terminated->date }}" data-date-format="yyyy/mm/dd">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Termination Reason<span class="required">*</span></label>
                    <input type="text" name="termination_reason" value="{{ $terminated->reason }}" required="" class="form-control autocomplete_off">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Termination Note<span class="required">*</span></label>
                    <textarea class="form-control autocomplete_off" name="termination_note" required="" rows="10">{{ $terminated->note }}</textarea>
                </div>





                <input type="hidden" name="terminated_id" value="{{ $terminated->id }}">

                <span class="required">*</span> Required field
                <div class="modal-footer">

                    <button type="button" id="close" class="btn btn-danger btn-flat pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-olive btn-flat" id="btn">Save</button>


                </div>


            </form>
        </div>

        <!-- Modal -->

        <div class="modal fade modal-small" id="modalSmall" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

            <div id="modalSmall" class="modal-dialog">
                <div class="modal-content">

                </div>
            </div>
        </div>
    </div>
</div>
