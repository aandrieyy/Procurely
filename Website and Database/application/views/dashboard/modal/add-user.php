<!-- Modal -->

    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">									
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
                    <!-- <div class="row">
                        <div class="col-md-12 pl-5">
                            <label class="form-check-label">
                                <input class="form-check-input"  id="bulk_import" name="bulk_import" type="checkbox" value="">
                                <span class="form-check-sign">Do you want to upload student in bulk?</span>
                            </label>
                        </div>
                    </div>   -->
                    <form action="" method="POST" id="myForm" enctype="multipart/form-data">
                        <?php $this->load->view('dashboard/class/form.php')?>
                    </form>
                </div>
                <div class="modal-footer no-bd">
                    <button type="submit" id="btnssave" class="btn btn-danger"><i class="fa fa-save"></i> Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
