<div class="table-responsive">
    <table id="multi-filter-select" class="display table table-striped table-hover" >
        <thead>
            <tr>
                <th hidden>id</th>
                <th>Employee ID</th>
                <th>Department</th>
                <th>Role</th>
                <th>Position</th>
                <th>Name</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($datas as $row) :?>
                <tr>
                    <td hidden><?= $row->id?></td>
                    <td><?= $row->employee_actual_id?></td>
                    <td><?= $row->department?></td>
                    <td><?= $row->role?></td>
                    <td><?= $row->position?></td>
                    <td><?= $row->name?></td>
                    <td>
                        <div class="btn-group">
                            <?php
                            if($_SESSION['employee_management_edit'] == 1 || $_SESSION['id_user_role'] == 1){
                                ?>
                                <button title="Edit" class="form-control btn-warning btn-sm br-0" onclick="getEdit('<?= $row->id ?>')" ><i class="fa fa-edit"></i></button>
                                <?php
                            }
                            ?>
                            <?php
                            if($_SESSION['employee_management_delete'] == 1 || $_SESSION['id_user_role'] == 1){
                                ?>
                                <button title="Delete" class="form-control btn-danger btn-sm br-0" onclick="getDelete('<?= $row->id ?>','<?= base_url()?>/user/delete')"><i class="fa fa-trash"></i></button>
                                <?php
                            }
                            ?>
                            
                            
                        </div>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>