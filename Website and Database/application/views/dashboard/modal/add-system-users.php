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
                        <div class="row">
                            <div class="col-md-12 mb-3 select_employee">
                                <div class="">
                                    <label><span class="text-danger"><span class="text-danger">*</span></span> Employee</label>
                                    <select name="id" id="id_employee" class="form-control mt-1"  required>
                                        <option value="">Select</option>
                                        <?php foreach($employees as $row): ?>
                                            <option value="<?= $row->id?>">  <?= $row->name?> (<?= $row->position?>) </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group form-group-default">
                                    <label><span class="text-danger">*</span> Username</label>
                                    <input  type="text" name="username" id="username" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-group-default">
                                    <label><span class="text-danger">*</span> Password</label>
                                    <input  type="password" name="password" id="password" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-group-default">
                                    <label><span class="text-danger">*</span>Confirm Password</label>
                                    <input  type="password" name="" id="cpassword" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer no-bd">
                    <button type="submit" id="btnssave" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>