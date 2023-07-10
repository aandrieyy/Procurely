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
                    <div class="row p-3" >
                        <div class="col-md-12 mb-3">
                            <label><span class="text-danger">*</span> Select Department  </label>
                            <input  type="hidden" name="id" id="id" class="form-control">
                            <input  type="hidden" name="id_department_head" value="<?= $id_department_head?>" class="form-control">
                            <select name="department_id" id="department_id" class="form-control" style="width:100%" required>
                                <option value="">Select</option>
                                <?php foreach($departments as $row): ?>
                                    <option value="<?= $row->id?>"><?= $row->name?></option>
                                <?php endforeach; ?>
                            </select>
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