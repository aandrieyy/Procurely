<!-- Modal -->
<form action="" method="POST" id="myForm">
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
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-default">
                                        <label><span class="text-danger">*</span> Select Year </label>
                                        <input  type="hidden" name="id" id="id" class="form-control">
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
                                        <label><span class="text-danger">*</span> Item Category </label>
                                        <select name="item_category_id" id="item_category_id" class="form-control" required>
                                            <option value="">Select</option>
                                            <?php foreach($item_categories as $row): ?>
                                                <option value="<?= $row->id?>"><?= $row->category?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-default">
                                        <label><span class="text-danger"></span> Select Project </label>
                                        <select name="project_id" id="project_id" class="form-control" required>
                                            <option value="">Select</option>
                                            <?php foreach($projects as $row): ?>
                                                <option value="<?= $row->id?>"><?= $row->name?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group form-group-default">
                                        <label><span class="text-danger">*</span>  Item Type </label>
                                        <select name="item_type_id" id="item_type_id" class="form-control" required>
                                            <option value="">Select</option>
                                            <?php foreach($item_type as $row): ?>
                                                <option value="<?= $row->id?>"><?= $row->category?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group form-group-default">
                                        <label><span class="text-danger">*</span> Product Description </label>
                                        <select name="item_id" id="item_id" class="form-control" required>
                                            <option value="">Select Item Type First</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col-md-3">
                            <div class="form-group form-group-default">
                                <label><span class="text-danger">*</span> Quantity </label>
                                <input  type="text" name="quantity" id="quantity" oninput="accept_number_only('quantity');compute();" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group form-group-default">
                                <label><span class="text-danger">*</span> Unit </label>
                                <input  type="text" readonly id="unit" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group form-group-default">
                                <label><span class="text-danger">*</span> Unit Price </label>
                                <input  type="text" readonly name="unit_price" id="unit_price" oninput="accept_money_only('unit_price')"  class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group form-group-default">
                                <label><span class="text-danger">*</span> Estimated Budget </label>
                                <input  type="text" name="est_Budget" id="est_Budget" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-6 mt-5">
                            <div class="form-group form-group-default">
                                <label><span class="text-danger">*</span> Mode of Procurement </label>
                                <select name="mode_of_procurement_id" id="mode_of_procurement_id" class="form-control" required>
                                    <option value="">Select</option>
                                    <?php foreach($mode_of_procurements as $row): ?>
                                        <option value="<?= $row->id?>"><?= $row->category?></option>
                                    <?php endforeach; ?>
                                </select>
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