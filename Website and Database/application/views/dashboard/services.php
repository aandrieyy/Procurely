<?php $this->load->view('dashboard/template/header.php')?>
<?php $this->load->view('dashboard/template/sidebar.php')?>

	<div class="main-panel">
		<div class="content">
			<div class="page-inner">
				<div class="page-header">
					<h4 class="page-title">Dashboard</h4>
					<ul class="breadcrumbs">
						<li class="nav-home">
							<a href="#">
								<i class="flaticon-home"></i>
							</a>
						</li>
						<li class="separator">
							<i class="flaticon-right-arrow"></i>
						</li>
						<li class="nav-item">
							<a href="#">Services Management</a>
						</li>
					</ul>
				</div>
				<div class="row row-card-no-pd">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<div class="card-head-row">
									<h4 class="card-title">List of Services</h4>
									<?php
									// if($_SESSION['services_management_add'] == 1){
										?>
										<button id="btnAdd" class="btn btn-warning btn-round ml-auto">
											<i class="fa fa-plus"></i>
											Add
										</button>
										<?php
									// }
									?>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="multi-filter-select" class="display table table-striped table-hover" >
										<thead>
											<tr>
												<th>Service Category</th>
												<th>Service</th>
												<th>Price</th>
												<th>Description</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($services as $row): ?>
												<tr>
													<td><span class="badge badge-success"><?= ucfirst($row->service_type) ?></span></td>
													<td><?= $row->service?></td>
													<td><span class="badge badge-warning">₱ <?= number_format($row->fee,2) ?></span></td>
													<td><?= $row->description?></td>
													<td>
														<div class="btn-group">
															<?php
															// if($_SESSION['services_management_edit'] == 1){
																?>
																<button title="Edit" class="form-control btn-warning btn-sm br-0" onclick="getEdit('<?= $row->id ?>')" ><i class="fa fa-edit"></i></button>
																<?php
															// }
															?>
															<?php
															// if($_SESSION['services_management_delete'] == 1){
																?>
																<button title="Delete" class="form-control btn-danger btn-sm br-0" onclick="getDelete('<?= $row->id ?>','<?= base_url()?>/services/delete')"><i class="fa fa-trash"></i></button>
																<?php
															// }
															?>
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

<?php $this->load->view('dashboard/admin/modal/add-services.php')?>

<?php $this->load->view('dashboard/template/footer.php')?>
<?php $this->load->view('dashboard/class/input-text-accept-money-only.php')?>
<?php $this->load->view('dashboard/class/notification.php')?>
<?php $this->load->view('dashboard/class/delete.php')?>

<script>
	$('#btnAdd').click(function(){
		$('#addRowModal').modal('show');
		$('#addRowModal').find('.modal-title').text('Service Details');
		$('#myForm').attr('action','<?php echo base_url() ?>services/save');

		$("#id").val('');
		$("#id_category_service").val('');
		$("#service").val('');
		$("#fee").val('');
		$("#description").val('');
	});

	$("#btnssave").click(function(e){
		e.preventDefault();

		let service = $("#service").val();
		let id_category_service = $("#id_category_service").val();

		if(service == ''){
			swal('Service title is required','','warning');
			return false;
		}

		if(id_category_service == ''){
			swal('Service category is required','','warning');
			return false;
		}

		swal({
			title: "Do you want to proceed?",
			text: "",
			icon: "warning",
			buttons: [
				'No, cancel it!',
				'Yes, I am sure!'
			],
			successMode: true,
		}).then(function(isConfirm) {
			if (isConfirm) {
				$("#myForm").submit();
			} else {
				return false;
			}
		})


	})

	function getEdit(id){
		$('#addRowModal').modal('show');
		$('#addRowModal').find('.modal-title').text('Update');
		$('#myForm').attr('action','<?php echo base_url() ?>/services/update');
		$('#btnssave').text('Update');
		$('#btnssave').attr('data-operation','update');
		
		$.ajax({
			type: 'ajax',
			method: 'post',
			url: '<?php echo base_url()?>services/edit',
			data:{
				id:id
				},
			async: false,
			dataType: 'text',
			success: function(response){
				var data = JSON.parse(response);
				$("#id").val(data[0].id);
				$("#id_category_service").val(data[0].id_category_service);
				$("#service").val(data[0].service);
				$("#fee").val(data[0].fee);
				$("#description").val(data[0].description);
				
			},
			error: function(){
				swal('Something went wrong');
			}
		});
	}

</script>
