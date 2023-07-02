<!-- Modal -->
<form action="" method="POST" id="myForm" enctype="multipart/form-data">
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
                    <div class="row p-3" id="data_for_edit">    
                        <div class="row">
                           <div class="col-md-4 mb-3">
                                <label><span class="text-danger">*</span> For Project</label>
                                <input type="hidden" name="id" id="id">
                                <select name="id_project" id="id_project" class="form-control" required>
                                    <option value="">Select</option>
                                    <?php foreach($projects as $row): ?>
                                        <option value="<?= $row->id?>"><?= $row->project?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label><span class="text-danger">*</span> Completion Date</label>
                                <input  type="date" name="completion_date" id="completion_date" class="form-control" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label><span class="text-danger">*</span> Date of Issuance of COC</label>
                                <input  type="date" name="date_of_issuance_of_coc" id="date_of_issuance_of_coc" class="form-control" oninput="test()" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label><span class="text-danger">*</span> End of Retetion</label>
                                <h3 type="text" name="end_of_retention" id="end_of_retention"></h3>
                                <input  type="hidden" id="end_of_retention" class="form-control" required>
                                <!--<input  type="date" name="end_of_retention" id="end_of_retention" class="form-control" required>-->
                            </div>
                            <div class="col-md-4 mb-3">
                                <label><span class="text-danger">*</span> Retention Status</label>
                                <select name="id_retention_status" id="id_retention_status" class="form-control" required>
                                    <option value="">Select</option>
                                    <?php foreach($retention_status as $row): ?>
                                        <option value="<?= $row->id?>"><?= $row->category?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <!-- <div class="col-md-4 mb-3">
                                <label><span class="text-danger">*</span> Amount of Retention</label>
                                <input  type="number" name="amount" id="amount" class="form-control" required>
                            </div> -->
                            <div class="col-md-12 mb-3">
                                <label><span class="text-danger">*</span> Description</label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="4"></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label><span class="text-danger">*</span> FeedBack</label>
                                <textarea class="form-control" name="feedbacks" id="feedbacks" cols="30" rows="4"></textarea>
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