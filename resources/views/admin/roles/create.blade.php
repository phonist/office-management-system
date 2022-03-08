<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">Add New Role</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <form action="{{ route('roles.store') }}" method="post" id="form" class="form-horizontal">
            @csrf
            <div class="modal-body form">


                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Role Name</label>
                        <div class="col-md-9">
                            <input name="name" class="form-control autocomplete_off" type="text" required>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Display Name</label>
                        <div class="col-md-9">
                            <input name="display_name" class="form-control autocomplete_off" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Description</label>
                        <div class="col-md-9">
                            <input name="description" class="form-control autocomplete_off" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Assigned Permission(s)</label>
                        <div class="col-md-9">
                            
                            @foreach($permissions as $index=>$permission)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" id="inlineCheckbox{{$index}}" name="permission[]"
                                    value="{{ $permission->id }}" class="form-check-input"> 
                                    <label for="inlineCheckbox{{$index}}" class="form-check-label">{{$permission->display_name}}</label>
                            </div>
                            @endforeach
                           
                          
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" id="btnSave" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>