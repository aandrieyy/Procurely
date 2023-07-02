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
							<a href="#">Projects Management</a>
						</li>
					</ul>
				</div>
                <form action="<?php echo base_url() ?>projects/<?= $operation ?>/<?= $this->uri->segment(3)?>" method="POST" id="myForm" enctype="multipart/form-data">
                    <div class="row row-card-no-pd">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <h4 class="card-title"><?= ucfirst($operation) ?> Project</h4>
                                        <?php if($_SESSION['id_user_role'] != 3 && $_SESSION['id_user_role'] != 5){ // customers and business ?>
                                        <button id="btnssave" class="btn btn-success btn-round ml-auto">
                                            <i class="fa fa-save"></i>
                                            <?= ucfirst($operation) ?> 
                                        </button>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12 mb-3"><span class="bg-black btn-block text-white">Project Details</span></div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-group-default">
                                                        <label><span class="text-danger">*</span> Project Name</label>
                                                        <input  type="text" name="project" id="project" class="form-control" required
                                                        value="<?php echo isset($projects->project) ? $projects->project : '' ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label><span class="text-danger"><span class="text-danger">*</span></span> Client Type</label>
                                                        <input type="hidden" id="id" value="<?= $this->uri->segment('3') ?>">
                                                        <select name="id_client_type" id="id_client_type" class="form-control" required>
                                                            <option value="">Select</option>
                                                            <?php
                                                            // $client_types = $this->customlib->getClientType();
                                                            // foreach($client_types as $row){
                                                            //     echo '<option value="'.$row->id.'">'.ucfirst($row->role).'</option>';
                                                            // }
                                                            ?>
                                                            <option value="3">INDIVIDUAL CUSTOMER</option>
                                                            <option value="5">BUSINESS/COMPANY</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label><span class="text-danger"><span class="text-danger">*</span></span> Select Client</label>
                                                        <select name="id_client" id="id_client" class="form-control" required>
                                                            <option value="">Select</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12"></div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label><span class="text-danger"><span class="text-danger">*</span></span> Project Type </label>
                                                        <select name="id_category_project_type" id="id_category_project_type" class="form-control" required>
                                                            <option value="">Select</option>
                                                            <?php foreach($project_types as $row): ?>
                                                                <option value="<?= $row->id?>"><?= $row->category?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label><span class="text-danger"><span class="text-danger">*</span></span> Project Subtype </label>
                                                        <select name="id_project_subtype" id="id_project_subtype" class="form-control" required>
                                                            <option value="">Select</option>
                                                            <?php foreach($project_subtype as $row): ?>
                                                                <option value="<?= $row->id?>"><?= $row->category?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-group-default">
                                                        <label><span class="text-danger"></span> Price</label>
                                                        <input  type="text" name="tcp" id="tcp"class="form-control" oninput="accept_money_only('tcp')"  required
                                                        value="<?php echo isset($projects->tcp) ? $projects->tcp : '' ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-group-default">
                                                        <label><span class="text-danger"><span class="text-danger"></span></span> Start Date</label>
                                                        <input  type="date" name="start_date" id="start_date"class="form-control" required
                                                        value="<?php echo isset($projects->start_date) ? $projects->start_date : '' ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-group-default">
                                                        <label><span class="text-danger"></span> End Date</label>
                                                        <input  type="date" name="end_date" id="end_date" class="form-control" required
                                                        value="<?php echo isset($projects->end_date) ? $projects->end_date : '' ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label><span class="text-danger"><span class="text-danger">*</span></span> Status</label>
                                                        <select name="id_category_status" id="id_category_status" class="form-control" required>
                                                            <option value="">Select</option>
                                                            <?php foreach($project_status as $row): ?>
                                                                <option value="<?= $row->id?>"><?= $row->category?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-group-default">
                                                        <label><span class="text-danger"></span> Address</label>
                                                        <input  type="text" name="address" id="address" class="form-control" required
                                                        value="<?php echo isset($projects->address) ? $projects->address : '' ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group form-group-default">
                                                        <label><span class="text-danger"></span>  Description</label>
                                                        <textarea name="description" id="description" class="form-control" cols="30" rows="5"><?php echo isset($projects->description) ? $projects->description : '' ?></textarea>
                                                    </div>
                                                </div>

                                                <?php
                                                if($operation == 'updfate'){
                                                    ?>
                                                    <div class="col-md-12 mb-3"><span class="bg-success btn-block text-white">Project Media</span></div>
                   
                                                    <div class="col-md-12 mx-3 ">
                                                        <div class="row">
                                                            <div class="col-md-12 add-media" 
                                                                onclick="document.getElementById('upload_media').click()"
                                                                style="display: flex;justify-content: center; padding-top: 10px; align-items: center; background-color:gainsboro">
                                                                <span class="h1"><i class="fa fa-plus" ></i></span>
                                                                <input type='file' id="upload_media" style="display:none" accept="image/*">
                                                            </div>
                                                        </div>
                                                        <div class="row uploaded_media">
                                                            <?php foreach($projects_media as $row): ?>
                                                            <div class="col-md-4 my-2">
                                                                <?php
                                                                $ext = pathinfo($row->media, PATHINFO_EXTENSION);
                                                                if($ext == 'gif' || $ext == 'png' || $ext == 'PNG' || $ext == 'jpg' || $ext == 'jpeg'){
                                                                    ?>
                                                                    <a target="_blank" href="<?= base_url()?>public/uploads/project-media/<?= $row->media ?>"><img src="<?= base_url()?>public/uploads/project-media/<?= $row->media ?>" class="w-100 datapicture" alt=""></a>
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                    <a href="<?= base_url() ?>public/uploads/project-media/<?= $row->media ?>"><?= $row->media ?></a>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <button type="button" class="btn btn-danger btn-block btn-sm" onclick="deleteMedia(<?= $row->id ?>,'projects-media')"><i class="fa fa-trash"></i></button>
                                                            </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                              

                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mb-3"><span class="bg-black btn-block text-white">Downpayment Details</span></div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div id="proof_of_payment_uploaded">
                                                                <a target="_blank" href="<?= base_url()?>public/uploads/proof_of_payment/<?php echo isset($projects->proof_of_payment) ? $projects->proof_of_payment : 'default_pic.png' ?>"><img src="<?= base_url()?>public/uploads/proof_of_payment/<?php echo isset($projects->proof_of_payment) ? $projects->proof_of_payment : 'default_pic.png' ?>" class="img-thumbnail w-100 profilepic" alt=""></a>
                                                            </div>
                                                            <?php if($_SESSION['id_user_role'] != 3 && $_SESSION['id_user_role'] != 5){ // customers and business ?>
                                                            <button type="button" class="btn btn-black btn-sm btn-block"  style="display:block;height:30px;" onclick="document.getElementById('upload_proof_of_payment').click()">Upload Proof of Payment</button>
                                                            <?php } ?>
                                                            <input type='file' id="upload_proof_of_payment" style="display:none">
                                                            <input type="hidden" id="proof_of_payment" name="proof_of_payment">
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label><span class="text-danger">*</span> Downpayment Date</label>
                                                                        <input  type="date" name="downpayment_date" id="downpayment_date" class="form-control" 
                                                                        value="<?php echo isset($projects->downpayment_date) ? $projects->downpayment_date : '' ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label><span class="text-danger">*</span> Amount</label>
                                                                        <input  type="number" name="amount" id="amount" class="form-control" 
                                                                        value="<?php echo isset($projects->amount) ? $projects->amount : '' ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="mb-3">
                                                                        <label><span class="text-danger"><span class="text-danger">*</span></span> Mode of Payment</label>
                                                                        <select name="id_mode_of_payments" id="id_mode_of_payments" class="form-control" >
                                                                            <option value="">Select</option>
                                                                            <?php foreach($mode_of_payments as $row): ?>
                                                                                <option value="<?= $row->id?>"><?= $row->category?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 banks">
                                                                    <div class="mb-3">
                                                                        <label><span class="text-danger"><span class="text-danger">*</span></span> Banks</label>
                                                                        <select name="id_bank" id="id_bank" class="form-control" >
                                                                            <option value="">Select</option>
                                                                            <?php foreach($banks as $row): ?>
                                                                                <option value="<?= $row->id?>"><?= $row->category?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
<?php $this->load->view('dashboard/class/input-text-accept-money-only.php')?>
<?php $this->load->view('dashboard/class/input-text-accept-number-only.php')?>
<?php $this->load->view('dashboard/class/media-script.php')?>
<?php $this->load->view('dashboard/class/notification.php')?>
<?php $this->load->view('dashboard/class/delete.php')?>
<?php $this->load->view('dashboard/template/preloading.php')?>
<?php $this->load->view('dashboard/class/upload-picture-ajax.php')?>



<?php
if(isset($projects->id_category_project_type)){
    ?>
    <script>
        $("#id_category_project_type").val(<?= $projects->id_category_project_type ?>);
    </script>
    <?php
}
?>
<?php
if(isset($projects->id_category_status)){
    ?>
    <script>
        $("#id_category_status").val(<?= $projects->id_category_status ?>);
    </script>
    <?php
}
?>
<?php
if(isset($projects->id_project_subtype)){
    ?>
    <script>
        $("#id_project_subtype").val(<?= $projects->id_project_subtype ?>);
    </script>
    <?php
}
?>
<?php
if(isset($projects->id_mode_of_payments)){
    ?>
    <script>
        $("#id_mode_of_payments").val(<?= $projects->id_mode_of_payments ?>);
        let mop =  $("#id_mode_of_payments option:selected").text();
    </script>
    <?php
}
?>
<?php
if(isset($projects->id_bank)){
    ?>
    <script>
        $("#id_bank").val(<?= $projects->id_bank ?>);
    </script>
    <?php
}
?>

<script>


	$("#id_client_type").on('change',function(){
		let id_user_role = $(this).val();
		let option_text = '';
		$.ajax({
            type: 'ajax',
            method: 'post',
            url: '<?php echo base_url()?>clients/getClients',
            data:{
                id_user_role:id_user_role
                },
            async: false,
            dataType: 'text',
            success: function(response){
                var data = JSON.parse(response);

				$("#id_client").html('<option value="">Select</option>');
				for(var i=0;i<data.length;i++){
					if(id_user_role == 3){
						option_text = data[i].name;
					}else{
						option_text = data[i].business_name;
					}
					$("#id_client").append('<option value="'+data[i].id+'">'+option_text+'</option>');
				}
				
                $("#id_client").val(<?php echo isset($projects->id_client) ? $projects->id_client : '' ?>);
            },
            error: function(){
                swal('Something went wrong');
            }
        });

	})

    if(mop == "bank" || mop == "Bank" || mop == "banks" || mop == "Banks"){
        $(".banks").show();
    }else{
        $(".banks").hide();
    }

    $("#id_mode_of_payments").on('change',function(){
        let bank = $("#id_mode_of_payments option:selected").text();
        if(bank == "bank" || bank == "Bank" || bank == "banks" || bank == "Banks"){
            $(".banks").show();
        }else{
            $(".banks").hide();
        }
	})

    <?php if($_SESSION['id_user_role'] != 3 && $_SESSION['id_user_role'] != 5){ // customers and business ?>
	$("#btnssave").click(function(e){
		e.preventDefault();

		let id_client_type = $("#id_client_type").val();
		let id_client = $("#id_client").val();
		let id_category_project_type = $("#id_category_project_type").val();
		let project = $("#project").val();
		let id_category_status = $("#id_category_status").val();

		if(id_client_type == ''){
			swal('Please select client type','','warning');
			return false;
		}

		if(id_client == ''){
			swal('Please select client','','warning');
			return false;
		}

		if(id_category_project_type == ''){
			swal('Please select project type','','warning');
			return false;
		}

		if(project == ''){
			swal('Project title is required','','warning');
			return false;
		}

		if(id_category_status == ''){
			swal('Project status is required','','warning');
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
    <?php } ?>

    $('#id_client_type').select2({
        theme: "bootstrap"
    });

    $('#id_client').select2({
        theme: "bootstrap"
    });

    $('#id_category_project_type').select2({
        theme: "bootstrap"
    });

    $('#id_category_status').select2({
        theme: "bootstrap"
    });

	$("#upload_picture").change(function(){
		upload_pic_and_save('projects-media','upload_picture');
	})

    $("#upload_media").change(function(){
		var id_main = $("#id").val();
		var usage = 'projects-media';
		var media = '';
		upload_pic_and_save(usage,'upload_media');
	
        setTimeout(
        function() 
        {
            $.ajax({
                url: "<?= base_url() ?>media/get/" + usage + "/" + <?= $this->uri->segment('3') ?>,
                method:"POST",
                data: '',
                contentType: false,
                cache: false,
                processData: false,
                async: false,
                timeout: 30000,
                beforeSend:function(){
                    // $('body').removeClass('loaded');
                    // $('body').addClass('load');
                },   
                success:function(response){
                    data = JSON.parse(response);

                    for(var i=0;i<data.length;i++){
                        media += '<div class="col-md-4 my-2">'+
                                    '<img src="<?= base_url()?>public/uploads/project-media/'+data[i]['media']+'" class="img-thumbnail w-100 datapicture" alt="">'+
                                    '<button type="button" class="btn btn-danger btn-block btn-sm" onclick="deleteMedia('+ data[i].id+',&apos;'+usage+'&apos;)"><i class="fa fa-trash"></i></button>'+
        						'</div>';
                    }
                    $(".uploaded_media").html(media);
                    
                },
                complete:function(data){
                    $('body').removeClass('load');
                    $('body').addClass('loaded');
                },
		    });
        }, 2000);



	})

	$("#upload_proof_of_payment").change(function(){
		upload_picture('proof_of_payment','upload_proof_of_payment');
	})

</script>


<?php
if(isset($projects->id_client_type)){
    ?>
    <script>
        $("#id_client_type").val(<?= $projects->id_client_type ?>);
        $("#id_client_type").trigger("change");
    </script>
    <?php
}
?>