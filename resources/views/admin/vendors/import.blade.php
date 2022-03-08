
<div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalLabel">Import vendor(s)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                            <form action="{{ route('vendor.import') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                                @csrf     
                        <div class="form-group">
                                <strong>Import Vendors</strong>
                            
                                <label for="import_file">Please Select File (CSV only):</label>
                                <input type="file" id="import_file" name="import_file" /> <br>
                                
                                {{-- <input class="btn bg-navy" type="submit" name="upload" value="Import" /> --}}
                        </div>
                        <div>
                                <button type="submit" name="upload" class="btn btn-warning ladda-button" data-style="expand-left"><span
                                    class="ladda-label">Import</span></button>
                        </div>
                    </form>
                    </div>
                    <div class="col-md-6">
                        <strong>Download Sample CSV File</strong><br>
                        <a href="{{ route('vendor.download') }}"><i class="icon-fa icon-fa-arrow-circle-down" aria-hidden="true"></i>
                            Sample CSV File</a>
                    </div>
                </div>
    
            </div>
    
        </div>
    </div>