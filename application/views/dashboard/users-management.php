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
							<a href="#"><?= ucwords(str_replace("_"," ",$title))?>  Management</a>
						</li>
					</ul>
				</div>
				<div class="row row-card-no-pd">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<div class="card-head-row">
									<h4 class="card-title">List of <?= ucwords(str_replace("_"," ",$title))?></h4>
									<div class="btn-group ml-auto">
										<button id="btnAdd" class="btn btn-warning">
											<i class="fa fa-plus"></i>
											Add
										</button>
										<!-- <a href="<?= base_url()?>students/excel" id="btnAdd" class="btn btn-success  ml-auto">
											<i class="fas fa-file-excel"></i>
										</a> -->
									</div>
								</div>
							</div>
							<div class="card-body">
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
															<button title="Edit" class="btn btn-warning btn-sm br-0" onclick="getEdit('<?= $row->id ?>')" ><i class="fa fa-edit"></i></button>
															<?php if($_SESSION['id_user'] != $row->id){ // ADMIN ?>
															<button title="Delete" class="btn btn-danger btn-sm br-0" onclick="getDelete('<?= $row->id ?>','<?= base_url()?>/user/delete')"><i class="fa fa-trash"></i></button>
															<?php } ?>
															<?php if($id_user_role == 3){ // DEPARTMENT HEAD ?>
																<a href="<?= base_url()?>departments/assign_department/<?= $row->id ?>" title="Delete" class="btn btn-info btn-sm br-0" ><i class="fas fa-check"></i> Assign Department/s</a>
															<?php } ?>
														</div>
													</td>
												</tr>
											<?php endforeach ?>
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

<?php $this->load->view('dashboard/modal/add-user.php')?>
<?php $this->load->view('dashboard/template/footer.php')?>
<?php $this->load->view('dashboard/class/notification.php')?>
<?php $this->load->view('dashboard/class/email_validate.php')?>
<?php $this->load->view('dashboard/class/check-email-existence.php')?>
<?php $this->load->view('dashboard/class/check-phone-existence.php')?>
<?php $this->load->view('dashboard/class/delete.php')?>
<?php $this->load->view('dashboard/class/upload-picture-ajax.php')?>

<script>

	$('#btnAdd').click(function(){
		$('#addRowModal').modal('show');
		$('#addRowModal').find('.modal-title').text('<?= ucwords(str_replace("_"," ",$title))?>'+' Details');
		$('#myForm').attr('action','<?php echo base_url() ?>user/save');
		$('#btnssave').text('Save');

		$("#id").val('');
		$("#first_name").val('');
		$("#middle_name").val('');
		$("#last_name").val('');
		$("#birthday").val('');
		$("#gender").val('');
		$("#email").val('');
		$("#contact").val('');
		$("#address").val('');
		$("#temp_photo_arr").val('');
		$("#dp").val('');

	});
	
	function getEdit(id,id_user_role){
		$('#addRowModal').modal('show');
		$('#addRowModal').find('.modal-title').text('Update');
		$('#myForm').attr('action','<?php echo base_url() ?>/user/update');
		$('#btnssave').text('Update');
		$('#btnssave').attr('data-operation','update');
		

		$.ajax({
			type: 'ajax',
			method: 'post',
			url: '<?php echo base_url()?>user/edit',
			data:{
				id:id,
				id_user_role:<?= $id_user_role?>
				},
			async: false,
			dataType: 'text',
			success: function(response){
				var data = JSON.parse(response);
				console.log(data);
				$("#college_id").val(data[0].college_id);
				$("#id").val(data[0].id);
				$("#first_name").val(data[0].first_name);
				$("#middle_name").val(data[0].middle_name);
				$("#last_name").val(data[0].last_name);
				$("#birthday").val(data[0].birthday);
				$("#gender").val(data[0].gender);
				$("#civil_status").val(data[0].civil_status);
				$("#email").val(data[0].email);
				$("#contact").val(data[0].contact);
				$("#address").val(data[0].address);
				$("#temp_photo_arr").val(data[0].picture);
				$("#dp").val(data[0].picture);
				$("#signature").val(data[0].signature);

				let picture = data[0].picture;
				if(picture == ''){
					picture = 'default_pic.png';
				}

				let signature = data[0].signature;
				if(signature == ''){
					signature = 'default_pic.png';
				}

				$(".signature").attr({'src': '<?= base_url()?>public/uploads/signature/'+signature});
			
			},
			error: function(){
				swal('Something went wrong');
			}
		});
	}

	$("#btnssave").click(function(e){
		e.preventDefault();
		let operation = $(this).attr('data-operation');
		let id = $("#id").val();

		let data = $('#myForm').serializeArray();
		console.log(data);
		for(var i=0;i<data.length;i++){
			if(data[i].name != 'id' && data[i].name != 'picture' && data[i].name != 'id_track' && data[i].name != 'id_strand'  && data[i].name != 'username' && data[i].name != 'password'){
				if(data[i].value == ''){
					swal('Please fill-up all the required fields','','warning');
					return false;
				}
			}
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

				var data = {};

				let contact = $("#contact").val();
				if(contact != ''){
					if(contact.length != 11){
						swal('Contact number must be 11 digit','','warning');
						return false;
					}

					// if(isPhoneExist(contact,operation,id) == true){
					// 	swal('Phone number is already used','','warning');
					// 	return false;
					// }
				}

				let email = $("#email").val();
				if(email != ''){
					if(!isEmail(email)){
						swal('Please input valid email','','warning');
						return false;
					}

					// if(isEmailExist(email,operation,id) == true){
					// 	swal('Email is already used','','warning');
					// 	return false;
					// }

				}
				
				let password = $("#password").val();
				if(password != ''){
					let length = password.length;
					if(length < 8){
						swal('Password must be 8 or more characters!','','warning');
						return false;
					}
				}


				$("#myForm").submit();

			} else {
				return false;
			}
		})

	})

	$("#upload_dp").change(function(){
		upload_picture('dp','upload_dp');
	})
	$("#upload_signature").change(function(){
		upload_picture('signature','upload_signature');
	})

</script>
