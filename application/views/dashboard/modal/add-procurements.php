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
                           <div class="col-md-12 mb-3">
                                <label><span class="text-danger">*</span> For Project</label>
                                <input type="hidden" name="id" id="id">
                                <select name="id_project" id="id_project" class="form-control" required>
                                    <option value="">Select</option>
                                    <?php foreach($projects as $row): ?>
                                        <option value="<?= $row->id?>"><?= $row->project?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-group-default">
                                    <label><span class="text-danger">*</span> Material</label>
                                    <select name="id_procurements_materials" id="id_procurements_materials" class="form-control" required>
                                    <option value="">Select</option>
                                    <?php foreach($procurements_materials as $row): ?>
                                        <option value="<?= $row->id?>"><?= $row->category?></option>
                                    <?php endforeach; ?>
                                </select>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label><span class="text-danger">*</span> Supplier</label>
                                <select name="id_supplier" id="id_supplier" class="form-control" required>
                                    <option value="">Select</option>
                                    <?php foreach($suppliers as $row): ?>
                                        <option value="<?= $row->id?>"><?= $row->name?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label><span class="text-danger">*</span> Quantity</label>
                                <input  type="number" name="quantity" id="quantity" class="form-control" oninput="accept_money_only('fee')" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label><span class="text-danger">*</span> Price</label>
                                <input  type="number" name="price" id="price" class="form-control" oninput="accept_money_only('fee')" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label><span class="text-danger">*</span> Status</label>
                                <select name="id_procurements_status" id="id_procurements_status" class="form-control" required>
                                    <option value="">Select</option>
                                    <?php foreach($procurements_status as $row): ?>
                                        <option value="<?= $row->id?>"><?= $row->category?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-group-default">
                                    <label><span class="text-danger"></span> Description</label>
                                    <textarea name="description" id="description" cols="30" rows="3" class="form-control"></textarea>
                                </div>
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