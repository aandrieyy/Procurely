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
                        <div class="row ">
                            <div class="col-md-3">

                            <div id="product_pic_uploaded">
                                <img src="<?= base_url()?>public/uploads/products-image/default_pic.png" class="img-thumbnail w-100 datapicture" alt="">
                            </div>
                            <button type="button" class="btn btn-success btn-sm btn-block"  style="display:block;height:30px;" onclick="document.getElementById('upload_picture').click()">Browse</button>
                            <input type='file' id="upload_picture" style="display:none">
                            <input type="hidden" id="product_pic" name="picture">

                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-12 mb-3"><span class="bg-success btn-block text-white">PRODUCT DETAILS</span></div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group form-group-default">
                                            <label><span class="text-danger"><span class="text-danger">*</span></span> SKU/CODE</label>
                                            <input  type="hidden" name="id" id="id" class="form-control">
                                            <input  type="text" name="code" id="code" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group form-group-default">
                                            <label><span class="text-danger">*</span> Product Name</label>
                                            <input  type="text" name="product_name" id="product_name" class="form-control" required>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group form-group-default">
                                            <label><span class="text-danger"><span class="text-danger">*</span></span> Category</label>
                                            <select name="id_product_category" id="id_product_category" class="form-control" required>
                                                <option value="">Select</option>
                                                <?php foreach($product_categories as $row): ?>
                                                    <option value="<?= $row->id?>"><?= $row->category?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-group-default">
                                            <label><span class="text-danger"><span class="text-danger">*</span></span> Brand</label>
                                            <select name="id_product_brand" id="id_product_brand" class="form-control" required>
                                                <option value="">Select</option>
                                                <?php foreach($product_brands as $row): ?>
                                                    <option value="<?= $row->id?>"><?= $row->category?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-group-default">
                                            <label><span class="text-danger"><span class="text-danger">*</span></span> Unit</label>
                                            <select name="id_product_unit" id="id_product_unit" class="form-control" required>
                                                <option value="">Select</option>
                                                <?php foreach($product_units as $row): ?>
                                                    <option value="<?= $row->id?>"><?= $row->category?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default">
                                            <label><span class="text-danger">*</span> Critical Qty</label>
                                            <input  type="number" name="cqty" id="cqty" class="form-control"  required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default">
                                            <label><span class="text-danger">*</span> Model</label>
                                            <input  type="text" name="model" id="model" class="form-control"  required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default">
                                            <label><span class="text-danger">*</span> Description</label>
                                            <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                    </div>
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