<!-- Modal -->
<form action="" method="POST" id="myFormStatus" enctype="multipart/form-data">
    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="addRowModalStatus" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">									
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">
                        New</span> 
                        <span class="fw-light">
                            Row
                        </span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">          
                    <div class="row p-3" id="data_for_edit">
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                                <label><span class="text-danger">*</span> Upload Signature </label>
                                <input  type="file" name="userfile" id="userfile" class="form-control" placeholder="" required>
                                <a href="<?= base_url()?>esignature" target="_blank">Click this to create your signature.</a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                                <label><span class="text-danger">*</span> Update Status Remarks </label>
                                <input  type="hidden" name="id" id="id_pr" class="form-control" placeholder="" required>
                                <input  type="hidden" name="status" id="status" class="form-control" placeholder="" required>
                                <textarea name="status_remarks" id="status_remarks" class="form-control" cols="30" rows="10" placeholder="Write something here..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer no-bd">
                    <button type="submit" id="btnssave" class="btn btn-warning"><i class="fa fa-save"></i> Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>