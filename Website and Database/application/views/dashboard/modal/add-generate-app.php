<!-- Modal -->
<form action="" method="POST" id="myForm">
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
                            <div class="form-group form-group-default">
                                <label><span class="text-danger">*</span> Select Sector </label>
                                <input  type="hidden" name="id" id="id" class="form-control">
                                <input  type="hidden" name="ppmp_category" id="ppmp_category" value="<?= $ppmp_category ?>" class="form-control">
                                <select name="funds_type_id" id="funds_type_id" class="form-control" required>
                                    <option value="">Select</option>
                                    <?php foreach($funds_type as $row): ?>
                                        <option value="<?= $row->id?>"><?= $row->category?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div> -->
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                                <label><span class="text-danger">*</span> Prepared By </label>
                                <input  type="hidden" name="ppmp_category" id="ppmp_category" value="<?= $ppmp_category ?>" class="form-control">
                                <select name="prepared_by" id="prepared_by" class="form-control" required>
                                    <option value="">Select</option>
                                    <?php foreach($users as $row): ?>
                                        <option value="<?= $row->id?>"><?= $row->name?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                                <label><span class="text-danger">*</span> Attested By </label>
                                <select name="attested_by" id="attested_by" class="form-control" required>
                                    <option value="">Select</option>
                                    <?php foreach($users as $row): ?>
                                        <option value="<?= $row->id?>"><?= $row->name?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                                <label><span class="text-danger">*</span> Recommending Approval </label>
                                <select name="president" id="president" class="form-control" required>
                                    <option value="">Select</option>
                                    <?php foreach($users as $row): ?>
                                        <option value="<?= $row->id?>"><?= $row->name?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer no-bd">
                    <button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>