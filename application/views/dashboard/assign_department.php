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
									<h4 class="card-title">List of Department Handled</h4>
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
												<th>Action</th>
											</tr>
										</thead>
                                        <tbody>
											<?php foreach($get_assign_department as $row): ?>
												<tr>
													<td hidden><?= $row->id?></td>
													<td><?= $row->sector?></td>
													<td><?= $row->college?></td>
													<td><?= $row->department?></td>
													<td>
														<button title="Delete" class="btn btn-danger btn-sm br-0" onclick="getDelete('<?= $row->id ?>','<?= base_url()?>/departments/delete_assign')"><i class="fa fa-trash"></i></button>
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

<?php $this->load->view('dashboard/modal/add-department-handled')?>
<?php $this->load->view('dashboard/template/footer.php')?>
<?php $this->load->view('dashboard/class/input-text-accept-money-only.php')?>
<?php $this->load->view('dashboard/class/notification.php')?>
<?php $this->load->view('dashboard/class/delete.php')?>

<script>
	$('#btnAdd').click(function(){
		$('#addRowModal').modal('show');
		$('#addRowModal').find('.modal-title').text('Assign Department');
		$('#myForm').attr('action','<?php echo base_url() ?>departments/save_assign');
		$('#btnssave').text('Save');

		$("#id").val('');
		$("#sector_id").val('');
		$("#department_id").val('');
		$("#id_funds_type").val('');
		$("#funds").val('');
	});

	function getEdit(id){
		$('#addRowModal').modal('show');
		$('#addRowModal').find('.modal-title').text('Update');
		$('#myForm').attr('action','<?php echo base_url() ?>/department_budget/update');
		$('#btnssave').text('Update');
		$('#btnssave').attr('data-operation','update');
		

		$.ajax({
			type: 'ajax',
			method: 'post',
			url: '<?php echo base_url()?>department_budget/edit',
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
				$("#department_id").val(data[0].department_id);
				$("#id_funds_type").val(data[0].id_funds_type);
				$("#funds").val(data[0].funds);
			},
			error: function(){
				swal('Something went wrong');
			}
		});
	}

	$("#sector_id").on('change',function(){
		let sector_id = $(this).val();
		$("#department_id").html('<option value="">Select Sector First</option>');
		$.ajax({
			type: 'ajax',
			method: 'post',
			url: '<?php echo base_url()?>departments/get_department',
			data:{
				sector_id:sector_id
				},
			async: false,
			dataType: 'text',
			success: function(response){
				var data = JSON.parse(response);
				$("#department_id").html('<option value="">Select</option>');
				for(var i = 0; i < data.length; i++){
					$("#department_id").append('<option value="'+ data[i].id +'">'+ data[i].name +'</option>');
				}
			},
			error: function(){
				swal('Something went wrong');
			}
		});
	})

	$('#department_id').select2({
        theme: "bootstrap"
    });
	$('#id_funds_type').select2({
        theme: "bootstrap"
    });
</script>
