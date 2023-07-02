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
                            <label><span class="text-danger">*</span> Select College  </label>
                            <input  type="hidden" name="id" id="id" class="form-control">
                            <select name="college_id" id="college_id" class="form-control" style="width:100%" required>
                                <option value="">Select</option>
                                <?php foreach($colleges as $row): ?>
                                    <option value="<?= $row->id?>"><?= $row->name?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label><span class="text-danger">*</span> Funds Type  </label>
                            <select name="id_funds_type" id="id_funds_type" class="form-control w-100" style="width:100%" required>
                                <option value="">Select</option>
                                <?php foreach($funds_type as $row): ?>
                                    <option value="<?= $row->id?>"><?= $row->category?> (<?= $row->description?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                                <label><span class="text-danger">*</span> Funds </label>
                                <input  type="text" name="funds" id="funds" oninput="accept_money_only('funds')" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                        <label><span class="text-danger"></span> Signature </label>
                            <a href="<?= base_url()?>public/uploads/signature/<?= $_SESSION['signature']?>" target="_blank"><img src="<?= base_url()?>public/uploads/signature/<?= $_SESSION['signature']?>" class="img-thumbnail w-100 signature" alt=""></a>
                            <!-- <div class="form-group form-group-default">
                                <label><span class="text-danger">*</span> Upload Signature </label>
                                <input  type="file" name="userfile" id="userfile" class="form-control" placeholder="" required>
                                <a href="<?= base_url()?>esignature" target="_blank">Click this to create your signature.</a>
                            </div> -->
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