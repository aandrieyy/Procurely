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
									<h4 class="card-title">Colleges Masterlist</h4>

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
												<th>Sector</th>
												<th>College Name</th>
												<th>Option</th>
											</tr>
										</thead>
                                        <tbody>
											<?php foreach($colleges as $row): ?>
												<tr>
													<td hidden><?= $row->id?></td>
													<td><?= $row->sector?></td>
													<td><?= $row->name?></td>
													<td>
														<div class="btn-group">
															<button title="Edit" class="form-control btn-warning btn-sm br-0" onclick="getEdit('<?= $row->id ?>')" ><i class="fa fa-edit"></i></button>
															<button title="Delete" class="form-control btn-danger btn-sm br-0" onclick="getDelete('<?= $row->id ?>','<?= base_url()?>/sectors/delete')"><i class="fa fa-trash"></i></button>
                                                            <!-- <a href="<?= base_url()?>college_departments/index/<?= $row->id ?>" title="Delete" class="btn btn-info btn-sm br-0" ><i class="fas fa-check"></i> Assign Department/s</a> -->
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

<?php $this->load->view('dashboard/modal/add-colleges')?>
<?php $this->load->view('dashboard/template/footer.php')?>
<?php $this->load->view('dashboard/class/notification.php')?>
<?php $this->load->view('dashboard/class/delete.php')?>

<script>
	$('#btnAdd').click(function(){
		$('#addRowModal').modal('show');
		$('#addRowModal').find('.modal-title').text('Sector');
		$('#myForm').attr('action','<?php echo base_url() ?>colleges/save');
		$('#btnssave').text('Save');

		$("#id").val('');
		$("#sector_id").val('');
		$("#name").val('');
	});

	function getEdit(id){
		$('#addRowModal').modal('show');
		$('#addRowModal').find('.modal-title').text('Update');
		$('#myForm').attr('action','<?php echo base_url() ?>/colleges/update');
		$('#btnssave').text('Update');
		$('#btnssave').attr('data-operation','update');
		

		$.ajax({
			type: 'ajax',
			method: 'post',
			url: '<?php echo base_url()?>colleges/edit',
			data:{
				id:id
				},
			async: false,
			dataType: 'text',
			success: function(response){
				var data = JSON.parse(response);
				$("#id").val(data[0].id);
				$("#sector_id").val(data[0].sector_id);
				$("#name").val(data[0].name);
			},
			error: function(){
				swal('Something went wrong');
			}
		});
	}
</script>
