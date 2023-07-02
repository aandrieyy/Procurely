

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
							<a href="#">Users Management</a>
						</li>
					</ul>
				</div>
				<div class="row row-card-no-pd">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<div class="card-head-row">
									<h4 class="card-title">List of System Users</h4>
									<?php
									if($_SESSION['user_management_add'] == 1 || $_SESSION['id_user_role'] == 1){
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
												<th>Positions</th>
												<th>Employee ID</th>
												<th>Name</th>
												<th>Username</th>
												<th>Option</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($system_users as $row): ?>
												<tr>
													<td hidden><?= $row->id?></td>
													<td><span class="badge badge-success"><?= ucfirst($row->position) ?></span></td>
													<td><?= $row->employee_actual_id?></td>
													<td><?= $row->name?></td>
													<td><?= $row->username?></td>
													<td>
														<div class="btn-group">
															<?php
															if($_SESSION['user_management_edit'] == 1){
																?>
																<button title="Edit" class="form-control btn-warning btn-sm br-0" onclick="getEdit('<?= $row->id ?>')" ><i class="fa fa-edit"></i></button>
																<?php
															}
															?>
															
															<?php
															if($_SESSION['user_management_edit'] == 1){
																?>
																<button title="Delete" class="form-control btn-danger btn-sm br-0" onclick="getDelete('<?= $row->id ?>','<?= base_url()?>/users_management/delete_sys_user')"><i class="fa fa-trash"></i></button>
																<?php
															}
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

<?php $this->load->view('dashboard/admin/modal/add-system-users.php')?>

<?php $this->load->view('dashboard/template/footer.php')?>
<?php $this->load->view('dashboard/class/notification.php')?>
<?php $this->load->view('dashboard/class/delete.php')?>

<script>
	$('#btnAdd').click(function(){
		$('#addRowModal').modal('show');
		$('#addRowModal').find('.modal-title').text('Users Details');
		$('#myForm').attr('action','<?php echo base_url() ?>users_management/UpdateSystemUser');

		$("#id_employee").val('');
		$("#username").val('');
		$(".select_employee").show();
	});

	function getEdit(id){
		$('#addRowModal').modal('show');
		$('#addRowModal').find('.modal-title').text('Update');
		$('#myForm').attr('action','<?php echo base_url() ?>/users_management/UpdateSystemUser');
		
		$('#id_employee').val(id);
		$(".select_employee").hide();

		$.ajax({
			type: 'ajax',
			method: 'post',
			url: '<?php echo base_url()?>user/edit',
			data:{
				id:id,
				id_user_role:6
				},
			async: false,
			dataType: 'text',
			success: function(response){
				var data = JSON.parse(response);
				$("#username").val(data[0].username);
				$('#addRowModal').find('.modal-title').text('Update Login Credntial ('+ data[0].first_name + ") ");
			},
			error: function(){
				swal('Something went wrong');
			}
		});
	}

	$("#btnssave").click(function(e){
		e.preventDefault();

		let id_employee = $("#id_employee").val();
		let username = $("#username").val();
		let password = $("#password").val();
		let cpassword = $("#cpassword").val();

		if(id_employee == ''){
			swal("Please fill-up all the required fields",'','warning');
			return false;
		}

		if(username == '' || password == '' || cpassword == ''){
			swal("Please fill-up all the required fields",'','warning');
			return false;
		}
	
		if(password != cpassword){
			swal("Password didnt match",'','warning');
			return false;
		}

		if(password != cpassword){
			swal("Password didnt match",'','warning');
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

</script>
