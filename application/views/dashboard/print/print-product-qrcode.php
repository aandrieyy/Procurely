<?php $this->load->view('dashboard/template/header.php')?>
<div class="row">
<?php foreach($products as $row): ?>

        <div class="col-md-4" align="center">
            <img src="<?= base_url()?>products/product_qr/<?= $row->id ?>" id="picture1" style="width:100%;padding:7px">
            <h3>(<?= $row->code?>) - <?= $row->product_name?></h4>
        </div>
    
<?php endforeach; ?>
</div>

<script>
    print();
</script>