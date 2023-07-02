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
									<h4 class="card-title">List of <?= ucwords(str_replace('_',' ',$this->uri->segment(3)))?></h4>

									<?php
									if($category_type != 'announcements' && $category_type != 'level'){
										?>
										<button id="btnAdd" class="btn btn-warning btn-round ml-auto">
											<i class="fa fa-plus"></i>
											Add
										</button>
										<?php
									}
									?>

								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="multi-filter-select" class="display table table-striped table-hover" >
										<thead>
											<tr>
												<th hidden>id</th>
												<th>Category / Type</th>
												<th>Description</th>
												<?php if($category_type != 'level'){ ?>
												<th>Option</th>
												<?php } ?>
											</tr>
										</thead>
                                        <tbody>
											<?php foreach($categories as $row): ?>
												<tr>
													<td hidden><?= $row->id?></td>
													<td><?= $row->category?></td>
													<td><?= $row->description?></td>

													<?php if($category_type != 'level'){ ?>
													<td>
														<div class="btn-group">
														<?php
														// if($can_edit == 1){
															?>
															<button title="Edit" class="form-control btn-warning btn-sm br-0" onclick="getEdit('<?= $row->id ?>')" ><i class="fa fa-edit"></i></button>
															<?php
														// }
														?>

															<?php
															if($category_type != 'announcements'){
																?>
																<button title="Delete" class="form-control btn-danger btn-sm br-0" onclick="getDelete('<?= $row->id ?>','<?= base_url()?>/categories/delete')"><i class="fa fa-trash"></i></button>
																<?php
															}
															?>
															
															
														</div>

														<?php } ?>
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

<?php $this->load->view('dashboard/modal/add-category.php')?>
<?php $this->load->view('dashboard/template/footer.php')?>
<?php $this->load->view('dashboard/class/notification.php')?>
<?php $this->load->view('dashboard/class/delete.php')?>

<script>
	$('#btnAdd').click(function(){
		$('#addRowModal').modal('show');
		$('#addRowModal').find('.modal-title').text('Category/Type Details');
		$('#myForm').attr('action','<?php echo base_url() ?>categories/save');
		$('#btnssave').text('Save');

		$("#id").val('');
		$("#category").val('');
		$("#description").val('');
	});

	function getEdit(id){
		$('#addRowModal').modal('show');
		$('#addRowModal').find('.modal-title').text('Update');
		$('#myForm').attr('action','<?php echo base_url() ?>/categories/update');
		$('#btnssave').text('Update');
		$('#btnssave').attr('data-operation','update');
		

		$.ajax({
			type: 'ajax',
			method: 'post',
			url: '<?php echo base_url()?>categories/edit',
			data:{
				id:id
				},
			async: false,
			dataType: 'text',
			success: function(response){
				var data = JSON.parse(response);
				$("#id").val(data[0].id);
				$("#category").val(data[0].category);
				$("#description").val(data[0].description);
			},
			error: function(){
				swal('Something went wrong');
			}
		});
	}
</script>
