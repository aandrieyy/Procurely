<div class="table-responsive">
    <table id="multi-filter-select" class="display table table-striped table-hover" >
        <thead>
            <tr>
                <th hidden>id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($datas as $row) :?>
                <tr>
                    <td hidden><?= $row->id?></td>
                    <td><?= $row->name?></td>
                    <td><?= $row->email?></td>
                    <td><?= $row->contact?></td>
                    <td>
                        <div class="btn-group">
                            <?php
                            if($_SESSION['customer_management_edit'] == 1 || $_SESSION['id_user_role'] == 1){
                                ?>
                                <button title="Edit" class="form-control btn-warning btn-sm br-0" onclick="getEdit('<?= $row->id ?>')" ><i class="fa fa-edit"></i></button>
                                <?php
                            }
                            ?>
                            
                            <?php
                            if($_SESSION['customer_management_delete'] == 1 || $_SESSION['id_user_role'] == 1){
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