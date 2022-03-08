<div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel">Emergency Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
    
            <form action="{{ route('emergencyContacts.store') }}" id="emergencyContact"
                enctype="multipart/form-data" method="post" accept-charset="utf-8">
                @csrf
                <div class="modal-body">
    
                    
                <div class="form-group">
                        <label>Name<span class="required">*</span></label>
                        <input type="text" name="name" value="" class="form-control autocomplete_off" required>
                    </div>
    
                    <div class="form-group">
                        <label>Relationship<span class="required">*</span></label>
                        <input type="text" name="relationship" value="" class="form-control autocomplete_off" required>
                    </div>
    
                    <div class="form-group">
                        <label>Home Telephone<span class="required">*</span></label>
                        <input type="text" name="home_telephone" value="" class="form-control autocomplete_off" required>
                    </div>
    
                    <div class="form-group">
                        <label>Mobile</label>
                        <input type="text" name="mobile" value="" class="form-control autocomplete_off">
                    </div>
    
                    <div class="form-group">
                        <label>Work Telephone</label>
                        <input type="text" name="work_telephone" value="" class="form-control autocomplete_off">
                    </div>
    
    
                </div>
    
                <div class="modal-footer">
                        <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                        <input type="hidden" name="index" value="">
        
                        <span class="required">*</span> Required field
                        <button type="button" id="close" class="btn btn-danger btn-flat pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-olive btn-flat" id="btn">Save</button>
                </div>
            </form>
        </div>
    </div>