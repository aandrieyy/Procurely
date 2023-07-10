<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-3">
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <span class="bg-success btn-block text-white mb-3">EMPLOYEE DETAILS</span>
            </div>
            
        
            <!-- <div class="col-md-6">
                <div class="form-group form-group-default">
                    <label><span class="text-danger"><span class="text-danger">*</span></span> Employee ID</label>
                    <input type="text" id="employee_actual_id" name="employee_actual_id" class="form-control">
                </div>
            </div> -->
            <div class="col-md-6">
                <div class="form-group form-group-default">
                    <label><span class="text-danger"><span class="text-danger">*</span></span> Department</label>
                    <select name="id_category_employee_department" id="id_category_employee_department" class="form-control">
                        <option value="">Select</option>
                        <?php foreach($employee_departments as $row): ?>
                            <option value="<?= $row->id?>"><?= $row->category?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-group-default">
                    <label><span class="text-danger"><span class="text-danger">*</span></span> Role</label>
                    <select name="id_category_employee_role" id="id_category_employee_role" class="form-control">
                        <option value="">Select</option>
                        <?php foreach($employee_roles as $row): ?>
                            <option value="<?= $row->id?>"><?= $row->category?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-group-default">
                    <label><span class="text-danger"><span class="text-danger">*</span></span> Position</label>
                    <select name="id_category_employee_position" id="id_category_employee_position" class="form-control">
                        <option value="">Select</option>
                        <?php foreach($employee_positions as $row): ?>
                            <option value="<?= $row->id?>"><?= $row->category?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
           
        </div>
    </div>
</div>