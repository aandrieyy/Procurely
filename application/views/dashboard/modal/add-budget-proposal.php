<!-- Modal -->
<form action="" method="POST" id="myForm" enctype="multipart/form-data">
    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <!-- <div class="col-md-12">
                            <div class="alert alert-warning pfileEdit">Skip upload of PROPOSAL FILE if you dont want to update it.</div>
                        </div> -->
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                                <label><span class="text-danger">*</span> Select Department </label>
                                <input  type="hidden" name="id" id="id" class="form-control">
                                <select name="department_id" id="department_id" class="form-control" required>
                                    <option value="">Select</option>
                                    <?php foreach($departments as $row): ?>
                                        <option value="<?= $row->id?>"><?= $row->name?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                                <label><span class="text-danger">*</span> Select Year </label>
                                <select name="year_id" id="year_id" class="form-control" required>
                                    <option value="">Select</option>
                                    <?php foreach($years as $row): ?>
                                        <option value="<?= $row->id?>"><?= $row->category?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                                <label><span class="text-danger">*</span> Proposal Name  </label>
                                <input  type="text" name="proposal_name" id="proposal_name" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                                <label><span class="text-danger"></span> Proposal File (Optional)</label>
                                <input  type="file" name="userfile" id="userfile" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                                <label><span class="text-danger">*</span> Amount </label>
                                <input  type="text" name="amount" id="amount" class="form-control" oninput="accept_money_only('amount')" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                                <label><span class="text-danger"></span> Remarks (Optional) </label>
                                <textarea name="remarks" id="remarks" class="form-control" cols="30" rows="5"></textarea>
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