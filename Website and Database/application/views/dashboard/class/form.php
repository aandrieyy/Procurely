<div class="row p-3 single_encode" >
    <div class="col-md-12" id="error_msg">
    </div>                       
    <div class="row ">
        <div class="col-md-3">

           <div class="row">
                <div class="col-md-12">
                    <div id="dp_uploaded">
                        <img src="<?= base_url()?>public/uploads/dp/default_pic.png" class="img-thumbnail w-100 profilepic" alt="">
                    </div>
                    <button type="button" class="btn btn-danger btn-sm btn-block"  style="display:block;height:30px;" onclick="document.getElementById('upload_dp').click()">Upload Picture</button>
                    <input type='file' id="upload_dp" style="display:none">
                    <input type="hidden" id="dp" name="picture">
                </div>
                <div class="col-md-12 mt-3">
                    <div id="signature_uploaded">
                        <img src="<?= base_url()?>public/uploads/signature/default_pic.png" class="img-thumbnail w-100 signature" alt="">
                    </div>
                    <button type="button" class="btn btn-danger btn-sm btn-block"  style="display:block;height:30px;" onclick="document.getElementById('upload_signature').click()">Upload Signature</button>
                    <input type='file' id="upload_signature" style="display:none">
                    <input type="hidden" id="signature" name="signature">
                    <a href="<?= base_url()?>esignature" target="_blank">Click this to create your signature.</a>
                </div>
           </div>

        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <span class="bg-danger btn-block text-white">PERSONAL DETAILS</span>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group form-group-default">
                        <label><span class="text-danger"><span class="text-danger">*</span></span> Last name </label>

                        <input  type="hidden" name="id_user_role" id="id_user_role" value="<?= $id_user_role?>">
                        <input  type="hidden" name="id" id="id" class="form-control">
                        <input  type="text" name="last_name" id="last_name" class="form-control" >
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group form-group-default">
                        <label><span class="text-danger">*</span> First name</label>
                        <input  type="text" name="first_name" id="first_name" class="form-control" >
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group form-group-default">
                        <label><span class="text-danger">*</span> MI</label>
                        <input  type="text" name="middle_name" id="middle_name"class="form-control"  >
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group form-group-default">
                        <label><span class="text-danger"><span class="text-danger">*</span></span> Birthday</label>
                        <input  type="date" name="birthday" id="birthday"class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group form-group-default">
                        <label><span class="text-danger">*</span> Gender</label>
                        <select name="gender" id="gender" class="form-control" >
                            <option value="">Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group form-group-default">
                        <label><span class="text-danger">*</span> Mobile #</label>
                        <input  type="text" name="contact" id="contact" class="form-control" maxlength="11" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group form-group-default">
                        <label><span class="text-danger">*</span> Email</label>
                        <input  type="text" name="email" id="email" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group form-group-default">
                        <label><span class="text-danger">*</span> Address</label>
                        <input  type="text" name="address" id="address" class="form-control" >
                    </div>
                </div>
                
                <?php if($id_user_role == 8){ // sector ?>
                <div class="col-md-12">
                    <span class="bg-danger btn-block text-white">SECTOR</span>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="form-group form-group-default">
                        <label><span class="text-danger">*</span> Select Sector</label>
                        <select name="sector_id" id="sector_id" class="form-control" required>
                            <option value="">Select</option>
                            <?php foreach($sectors as $row): ?>
                                <option value="<?= $row->id?>"><?= $row->name?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <?php } ?>

                <?php if($id_user_role == 11){ // college ?>
                <div class="col-md-12">
                    <span class="bg-danger btn-block text-white">COLLEGE</span>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="form-group form-group-default">
                        <label><span class="text-danger">*</span> Select College</label>
                        <select name="college_id" id="college_id" class="form-control" required>
                            <option value="">Select</option>
                            <?php foreach($colleges as $row): ?>
                                <option value="<?= $row->id?>"><?= $row->name?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <?php } ?>

                <div class="col-md-12">
                    <span class="bg-danger btn-block text-white">ACCOUNT CREDENTIALS</span>
                </div>
                <div class="col-md-12">
                <div class="alert alert-warning">Leave as blank if you dont want to update username or password!</div>
                </div>
                <div class="col-md-4">
                    <div class="form-group form-group-default">
                        <label><span class="text-danger">*</span> Username</label>
                        <input  type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group form-group-default">
                        <label><span class="text-danger">*</span> Password</label>
                        <input  type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>