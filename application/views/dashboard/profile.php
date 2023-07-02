<?php $this->load->view('dashboard/template/header.php')?>
<?php $this->load->view('dashboard/template/sidebar.php')?>


		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<form action="<?php echo base_url() ?>profile/update/" method="POST" id="myForm" enctype="multipart/form-data">
						<div class="card">
							<div class="card-header">
								<div class="d-flex align-items-center">
									<h4 class="card-title">ACCOUNT SETTINGS</h4>
									<button type="submit" id="btnsave" class="btn btn-danger btn-round ml-auto">
										<i class="fa fa-save"></i>
										Update
									</button>
								</div>
							</div>
							<div class="card-body">
								<div class="row p-3" id="data_for_edit">      
									<div class="col-md-3">
										<div class="row">
											<div class="col-md-12 mb-3">
												<div id="dp_uploaded">
													<img src="<?= base_url()?>public/uploads/dp/<?= $_SESSION['picture']?>" class="img-thumbnail w-100 profilepic" alt="">
												</div>
												<button type="button" class="btn btn-danger btn-sm btn-block"  style="display:block;height:30px;" onclick="document.getElementById('upload_dp').click()">UPLOAD PICTURE</button>
												<input type='file' id="upload_dp" style="display:none">
												<input type="hidden" id="dp" name="picture" value="<?= $_SESSION['picture']?>">
												<div class="col-md-12 mt-1 p-none">
													<small><b>Note:</b> width and height must be equal and below 100KB.</small>
												</div>
											</div>
											<div class="col-md-12 mb-3">
												<div id="signature_uploaded">
													<img src="<?= base_url()?>public/uploads/signature/<?= $_SESSION['signature']?>" class="img-thumbnail w-100 signature" alt="">
												</div>
												<button type="button" class="btn btn-danger btn-sm btn-block"  style="display:block;height:30px;" onclick="document.getElementById('upload_signature').click()">UPLOAD PICTURE</button>
												<input type='file' id="upload_signature" style="display:none">
												<input type="hidden" id="signature" name="signature" value="<?= $_SESSION['signature']?>">
												<a href="<?= base_url()?>esignature" target="_blank">Click this to create your signature.</a>
											</div>
										</div>
									</div>
									<div class="col-md-9">

										<div class="row">
											<div class="col-md-12 my-3">
												<span class="bg-danger btn-block text-white">BASIC DETAILS</span>
											</div>
											<div class="col-sm-4">
												<div class="form-group form-group-default">
													<label><span class="text-danger">*</span> First Name</label>
													<input  type="text" name="first_name" id="first_name" class="form-control" placeholder="First name" value="<?= $_SESSION['first_name']?>" 
													onkeydown="upperCaseF(this);return alphaOnly(event);" required>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group form-group-default">
													<label><span class="text-danger">*</span> Middle Name</label>
													<input  type="text" name="middle_name" id="middle_name" class="form-control" placeholder="Middle name" value="<?= $_SESSION['middle_name']?>"   
													onkeydown="upperCaseF(this);return alphaOnly(event);" required>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group form-group-default">
													<label><span class="text-danger">*</span> Last Name</label>
													<input  type="text" name="last_name" id="last_name" class="form-control" placeholder="Last name" value="<?= $_SESSION['last_name']?>"   
													onkeydown="upperCaseF(this);return alphaOnly(event);" required>
												</div>
											</div>

											<div class="col-sm-12">
												<div class="form-group form-group-default">
													<label><span class="text-danger">*</span> Email</label>
													<input  type="email" name="email" id="email" class="form-control" placeholder="email" value="<?= $_SESSION['email']?>"  required>
												</div>
											</div>
											<div class="col-sm-12">
												<div class="form-group form-group-default">
													<label><span class="text-danger">*</span> Mobile Number</label>
													<input  type="text" name="contact" maxlength="11" id="contact" class="form-control" placeholder="Contact" onkeyup="this.value=this.value.replace(/[^\d]/,'')" value="<?= $_SESSION['contact']?>" required>
												</div>
											</div>
											<div class="col-sm-12">
												<div class="form-group form-group-default">
													<label><span class="text-danger">*</span> Address</label>
													<input  type="text" name="address" id="address" class="form-control"  value="<?= $_SESSION['address']?>"  
													onkeydown="upperCaseF(this);" required>
												</div>
											</div>
										</div>


										<div class="row">
											<div class="col-md-12 my-3">
												<span class="bg-danger btn-block text-white">LOGIN CREDENTIALS</span>
											</div>
											<div class="col-sm-12">
												<div class="form-group form-group-default">
													<label>Username</label>
													<input  type="text" readonly value="<?= $_SESSION['username']?>" class="form-control" >
												</div>
											</div>
											<div class="col-sm-12">
												<div class="form-group form-group-default">
													<label>Current Password</label>
													<input  type="password" name="current_password" id="current_password" class="form-control" >
												</div>
											</div>
											<div class="col-sm-12">
												<div class="form-group form-group-default">
													<label>New Password</label>
													<input  type="password" name="new_password" id="new_password" class="form-control" >
												</div>
											</div>
											<div class="col-sm-12">
												<div class="form-group form-group-default">
													<label>Confirm Password</label>
													<input  type="password" name="confirm_password" id="confirm_password" class="form-control" >
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>


<?php $this->load->view('dashboard/template/footer.php')?>
<?php $this->load->view('dashboard/class/email_validate.php')?>
<?php $this->load->view('dashboard/class/check-email-existence.php')?>
<?php $this->load->view('dashboard/class/check-phone-existence.php')?>
<?php $this->load->view('dashboard/class/input-text-accept-number-only.php')?>
<script src="<?= base_url()?>public/assets/js/class/upload-picture-ajax.js"></script>
<?php $this->load->view('dashboard/class/notification.php')?>

<script>
	$("#id_level").val(<?php echo isset($_SESSION['id_level']) ? $_SESSION['id_level'] : '' ?>);
	$("#id_section").val(<?php echo isset($_SESSION['id_section']) ? $_SESSION['id_section'] : '' ?>);
	$("#id_track").val(<?php echo isset($_SESSION['id_track']) ? $_SESSION['id_track'] : '' ?>);
	$("#id_strand").val(<?php echo isset($_SESSION['id_strand']) ? $_SESSION['id_strand'] : '' ?>);
	
	$(".btnSaveAccountDetails").click(function(e){
		e.preventDefault();

		swal({
			title: "Do you want to edit your profile?",
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
				let dataArray = $('#myFormAccount').serializeArray();

				for(var i=0;i<dataArray.length;i++){
					if(dataArray[i].value == ''){
						swal('Please fill-up all the required fields','','warning');
						return false;
					}
				}

				let contact = $("#contact").val();
				if(contact.length != 11){
					swal('Contact number must be 11 digit','','warning');
					return false;
				}

				let email = $("#email").val();
				if(!isEmail(email)){
					swal('Please input valid email','','warning');
					return false;
				}

				// if(isEmailExist(email,'update') == true){
				// 	swal('Email is already used','','warning');
				// 	return false;
				// }

				// if(isPhoneExist(contact,'update') == true){
				// 	swal('Phone number is already used','','warning');
				// 	return false;
				// }

				$("#myFormAccount").submit();

			} else {
				return false;
			}
		})

	})

	$(".btnChangePassword").click(function(e){
		e.preventDefault();

		swal({
			title: "Do you want to change your password?",
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
				let dataArray = $('#myFormPassword').serializeArray();

				for(var i=0;i<dataArray.length;i++){
					if(dataArray[i].value == ''){
						swal('Please fill-up all the required fields','','warning');
						return false;
					}
				}

				let password = $("#current_password").val();
				let new_password = $("#new_password").val();
				let confirm_password = $("#confirm_password").val();

				//CHECK PASSWORD IF EXIST
				let is_passwordCorrect = true;
				$.ajax({
					type: 'ajax',
					method: 'post',
					url: '<?php echo base_url()?>user/validatePassword',
					data:{
						password:password
						},
					async: false,
					dataType: 'text',
					success: function(response){
						if(response == 'false'){
							is_passwordCorrect = false;
						}
					},
					error: function(){
						swal('Something went wrong');
					}
				});

				if(is_passwordCorrect == false){
					swal('Incorrect Password','','warning');
					return false;
				}
				//CHECK PASSWORD IF EXIST

				if(new_password != confirm_password){
					swal("Password did'nt match",'','warning');
					return false;
				}

				$("#myFormPassword").submit();

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


		
	