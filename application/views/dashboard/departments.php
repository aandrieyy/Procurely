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
									<h4 class="card-title">Departments Masterlist</h4>

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
												<th>Sector </th>
												<th>College</th>
												<th>Department</th>
												<th>Option</th>
											</tr>
										</thead>
                                        <tbody>
											<?php foreach($departments as $row): ?>
												<tr>
													<td hidden><?= $row->id?></td>
													<td><?= $row->sector?></td>
													<td><?= $row->college?></td>
													<td><?= $row->name?></td>
													<td>
														<div class="btn-group">
															<button title="Edit" class="form-control btn-warning btn-sm br-0" onclick="getEdit('<?= $row->id ?>')" ><i class="fa fa-edit"></i></button>
															<button title="Delete" class="form-control btn-danger btn-sm br-0" onclick="getDelete('<?= $row->id ?>','<?= base_url()?>/departments/delete')"><i class="fa fa-trash"></i></button>
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

<?php $this->load->view('dashboard/modal/add-department.php')?>
<?php $this->load->view('dashboard/template/footer.php')?>
<?php $this->load->view('dashboard/class/notification.php')?>
<?php $this->load->view('dashboard/class/delete.php')?>

<script>
	$('#btnAdd').click(function(){
		$('#addRowModal').modal('show');
		$('#addRowModal').find('.modal-title').text('Department');
		$('#myForm').attr('action','<?php echo base_url() ?>departments/save');
		$('#btnssave').text('Save');

		$("#id").val('');
		$("#sector_id").val('');
		$("#college_id").val('');
		$("#name").val('');
	});

	function getEdit(id){
		$('#addRowModal').modal('show');
		$('#addRowModal').find('.modal-title').text('Update');
		$('#myForm').attr('action','<?php echo base_url() ?>/departments/update');
		$('#btnssave').text('Update');
		$('#btnssave').attr('data-operation','update');
		

		$.ajax({
			type: 'ajax',
			method: 'post',
			url: '<?php echo base_url()?>departments/edit',
			data:{
				id:id
				},
			async: false,
			dataType: 'text',
			success: function(response){
				var data = JSON.parse(response);
				$("#id").val(data[0].id);
				$("#sector_id").val(data[0].sector_id);
				$("#sector_id").trigger('change');
				$("#college_id").val(data[0].college_id);
				$("#name").val(data[0].name);
				// setTimeout(
				// function() 
				// {
				
				// }, 1000);

			},
			error: function(){
				swal('Something went wrong');
			}
		});
	}

	$("#sector_id").on("change",function(){
		var sector_id = $("#sector_id").val();
		$.ajax({
			type: 'ajax',
			method: 'post',
			url: '<?php echo base_url()?>colleges/get/'+sector_id,
			data:{
				
			},
			async: false,
			dataType: 'text',
			success: function(response){
				var data = JSON.parse(response);
				$("#college_id").html('');
				for(var x = 0; x < data.length; x++){
					if(data[x]['qty'] != 0){
						$("#college_id").append('<option value="'+data[x]['id']+'">'+data[x]['name']+'</option>');
					}
				}
			},
			error: function(){
				swal('Something went wrong');
			}
		});
	})

</script>
