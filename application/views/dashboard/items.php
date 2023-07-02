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
									<h4 class="card-title">List of Project Item/s</h4>

									<button id="btnAdd" class="btn btn-warning btn-round ml-auto">
										<i class="fa fa-plus"></i>
										Add
									</button>

								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="multi-filter-select" class="display table table-striped table-hover" >
										<thead>
											<tr>
												<th hidden>id</th>
												<th>Item Type</th>
												<th>Item Category</th>
												<th>Unit</th>
												<th>Code</th>
												<th>Description</th>
												<th>Unit Price</th>
												<th>Option</th>
											</tr>
										</thead>
                                        <tbody>
											<?php foreach($items as $row): ?>
												<tr>
													<td hidden><?= $row->id?></td>
													<td><?= $row->item_type?></td>
													<td><?= $row->item_category?></td>
													<td><?= $row->unit?></td>
													<td><?= $row->code?></td>
													<td><?= $row->description?></td>
													<td>₱ <?= number_format($row->unit_price,2)?></td>
													<td>
														<div class="btn-group">
                                                            <button title="Edit" class="form-control btn-warning btn-sm br-0" onclick="getEdit('<?= $row->id ?>')" ><i class="fa fa-edit"></i></button>
															<button title="Delete" class="form-control btn-danger btn-sm br-0" onclick="getDelete('<?= $row->id ?>','<?= base_url()?>/items/delete')"><i class="fa fa-trash"></i></button>
														</div>
													</td>
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

<?php $this->load->view('dashboard/modal/add-item.php')?>
<?php $this->load->view('dashboard/template/footer.php')?>
<?php $this->load->view('dashboard/class/notification.php')?>
<?php $this->load->view('dashboard/class/delete.php')?>

<script>
	$('#btnAdd').click(function(){
		$('#addRowModal').modal('show');
		$('#addRowModal').find('.modal-title').text('Item');
		$('#myForm').attr('action','<?php echo base_url() ?>items/save');
		$('#btnssave').text('Save');

		$("#id").val('');
		$("#item_type_id").val('');
		$("#item_categories_id").val('');
		$("#code").val('');
		$("#description").val('');
		$("#unit_price").val('');
		$("#unit_id").val('');
	});

	function getEdit(id){
		$('#addRowModal').modal('show');
		$('#addRowModal').find('.modal-title').text('Update');
		$('#myForm').attr('action','<?php echo base_url() ?>/items/update');
		$('#btnssave').text('Update');
		$('#btnssave').attr('data-operation','update');
		

		$.ajax({
			type: 'ajax',
			method: 'post',
			url: '<?php echo base_url()?>items/edit',
			data:{
				id:id
				},
			async: false,
			dataType: 'text',
			success: function(response){
				var data = JSON.parse(response);
				$("#id").val(data[0].id);
				$("#item_type_id").val(data[0].item_type_id);
				$("#item_categories_id").val(data[0].item_categories_id);
				$("#code").val(data[0].code);
				$("#description").val(data[0].description);
				$("#unit_price").val(data[0].unit_price);
				$("#unit_id").val(data[0].unit_id);
			},
			error: function(){
				swal('Something went wrong');
			}
		});
	}
</script>