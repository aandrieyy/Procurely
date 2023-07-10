<?php $this->load->view('dashboard/template/header.php')?>
<?php $this->load->view('dashboard/template/sidebar.php')?>

	<div class="main-panel">
		<div class="content">
			<div class="page-inner">
				<div class="row row-card-no-pd">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<div class="card-head-row">
									<h4 class="card-title"><?= $table_title?></h4>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="multi-filter-select" class="display table table-striped table-hover" >
										<thead>
											<tr>
												<th hidden>id</th>
												<th>Date/Time</th>
												<th>User</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($datas as $row): ?>
												<tr>
													<td hidden><?= $row->id?></td>
													<td><span class="badge badge-success"><?= date("F j, Y, g:i A",strtotime($row->dt)) ?></span></td>
													<td><?= $row->name?> (<?= $row->employee_actual_id?>)</td>
													<td><?= $this->customlib->get_user_log_description('inventories',$row->action,$row->id_transaction,$row->table_name) ?></td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<?php $this->load->view('dashboard/admin/modal/modal-inventories.php')?>
<?php $this->load->view('dashboard/admin/modal/modal-inventory-stock-out.php')?>
<?php $this->load->view('dashboard/admin/modal/modal-inventories-serials.php')?>
<?php $this->load->view('dashboard/template/footer.php')?>
<?php $this->load->view('dashboard/class/input-text-accept-money-only.php')?>
<?php $this->load->view('dashboard/class/money_format.php')?>
<?php $this->load->view('dashboard/class/notification.php')?>

<script>

	$('#btnAdd').click(function(){
		$('#addRowModal').modal('show');
		$('#addRowModal').find('.modal-title').text('Add Inventory');
		$('#myForm').attr('action','<?php echo base_url() ?>inventories/save');
		$("#id").val('');
		$("#id_purchase").val('');
		$("#id_product").val('');
		$("#atcost").val('');
		$("#qty").val('');
		$("#remarks").val('');
	});

	function stockOut(id_product){
		$('#addRowModal22').modal('show');
		$('#addRowModal22').find('.modal-title').text('Stock Out');

		$("#id_product2").val(id_product);
		$("#id_product22").val(id_product);
	}


	function getEditSerials(id,product_name){
		$('#addRowModalSerials').modal('show');
		$('#addRowModalSerials').find('.modal-title').text('Serials Management');
		$('#myFormSerials').attr('action','<?php echo base_url() ?>inventories/updateSerials');

		$(".prd_name").text(product_name);

		$.ajax({
			type: 'ajax',
			method: 'post',
			url: '<?php echo base_url()?>inventories/getSerials',
			data:{
				id:id
				},
			async: false,
			dataType: 'text',
			success: function(response){

				var data = JSON.parse(response);
				console.log(data);
				$(".data_for_serial").html('');
				for(var i = 0; i < data.length; i++){
					$(".data_for_serial").append(
						'<tr>'+
							'<td>'+ (i + 1) +'</td>'+
							'<td hidden>'+ data[i].id +'</td>'+
							'<td class="text-right">'+
								'<div class="form-group">'+
									'<input type="text" class="form-control form-control-sm" name="subtotal" id="subtotal" value="'+ data[i].get_serial +'">'+
								'</div>'+
							'</td>'+
						'</tr>'
					);
				}

			},
			error: function(){
				swal('Something went wrong');
			}
		});
	}

	$("#btnUpdateSerial").click(function(){
		
		var table_data = [];
		$('.data_for_serial tr').each(function(row,tr){
	
			var sub = {
			'id_inventory_serials' : $(tr).find('td:eq(1)').text(),
			'serial' : $(tr).find('td:eq(2) .form-group input[type=text]').val(),
			};
			
			table_data.push(sub);
		});
		table_data = table_data.filter(function(e){return e}); 
		var inventories_serial = {'data_table' : table_data}

		$.ajax({
			type: 'ajax',
			method: 'post',
			url: '<?= base_url() ?>inventories/updateSerials',
			data: {
				inventories_serial : inventories_serial
			},
			datatype: 'text',
			success: function(response){
				location.reload();
			},
			error: function(){
				swal("Something went wrong!");
			}
		})
	})

	$('#id_product1').select2({
        theme: "bootstrap"
    });
	$('#id_supplier').select2({
        theme: "bootstrap"
    });
</script>
