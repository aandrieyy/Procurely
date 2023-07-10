<div class="row">
    <div class="col-md-3">

        <div id="biz_logo_uploaded">
            <img src="<?= base_url()?>public/uploads/business-logo/default_pic.png" class="img-thumbnail w-100 logo" alt="">
        </div>
        <button type="button" class="btn btn-black btn-sm btn-block"  style="display:block;height:30px;" onclick="document.getElementById('biz_upload_logo').click()">Upload Logo</button>
        <input type='file' id="biz_upload_logo" style="display:none" data-usage="biz_logo">
        <input type="hidden" id="biz_logo" name="logo">

    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12">
                <span class="bg-black btn-block text-white mb-3">BUSINESS DETAILS</span>
            </div>
            
            <div class="col-md-4">
                <div class="form-group form-group-default">
                    <label><span class="text-danger"><span class="text-danger">*</span></span> Business Name </label>
                    <input  type="hidden" name="id_business" id="id_business" class="form-control">
                    <input  type="text" name="business_name" id="business_name" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group form-group-default">
                    <label><span class="text-danger"><span class="text-danger">*</span></span> Business Category</label>
                    <select name="id_category_business_type" id="id_category_business_type" class="form-control">
                        <option value="">Select</option>
                        <?php foreach($business_categories as $row): ?>
                            <option value="<?= $row->id?>"><?= $row->category?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group form-group-default">
                    <label><span class="text-danger">*</span> Telephone</label>
                    <input  type="text" name="bs_telephone" id="bs_telephone" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group form-group-default">
                    <label><span class="text-danger">*</span> Phone Number</label>
                    <input  type="text" name="bs_phone" id="bs_phone"class="form-control" maxlength="11" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group form-group-default">
                    <label><span class="text-danger"><span class="text-danger">*</span></span> Email</label>
                    <input  type="email" name="bs_email" id="bs_email" class="form-control" >
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group form-group-default">
                    <label><span class="text-danger"><span class="text-danger">*</span></span> TIN</label>
                    <input  type="email" name="bs_tin" id="bs_tin" class="form-control" >
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group form-group-default">
                    <label><span class="text-danger">*</span> Address</label>
                    <input  type="text" name="bs_address" id="bs_address" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group form-group-default">
                    <label><span class="text-danger">*</span> Business Description</label>
                    <textarea name="bs_description" id="bs_description" class="form-control" cols="30" rows="5"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>