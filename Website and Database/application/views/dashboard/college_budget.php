<?php $this->load->view('dashboard/template/header.php')?>
<?php $this->load->view('dashboard/template/sidebar.php')?>

	<div class="main-panel">
		<div class="content">
			<div class="page-inner">
                <div class="row">
					<?php if($_SESSION['id_user_role'] != 3){ // BUDGET OFFICER ?>
					<div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="icon-big text-center">
                                            <i class="flaticon-coins text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="col-9 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Sector Remaning Budget</p>
                                            <h4 class="card-title">₱ <?php echo isset($budget_stats->remaining_sector_budget) ? number_format($budget_stats->remaining_sector_budget,2) : number_format(0,2) ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					<?php } ?>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="icon-big text-center">
                                            <i class="flaticon-coins text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="col-9 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Total College Budget</p>
                                            <h4 class="card-title">₱ <?php echo isset($budget_stats->college_budget) ? number_format($budget_stats->college_budget,2) : number_format(0,2) ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="icon-big text-center">
                                            <i class="flaticon-coins text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="col-9 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Budget Allocated</p>
                                            <h4 class="card-title">₱ <?php echo isset($budget_stats->allocated_budget_proposal) ? number_format($budget_stats->allocated_budget_proposal,2) : number_format(0,2) ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="icon-big text-center">
                                            <i class="flaticon-coins text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="col-9 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Remaining Budget</p>
                                            <h4 class="card-title">₱ <?php echo isset($budget_stats->remaining_department_budget) ? number_format($budget_stats->remaining_department_budget,2) : number_format(0,2) ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="row row-card-no-pd">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<div class="card-head-row">
									<h4 class="card-title">College Budget</h4>

									<?php if($_SESSION['id_user_role'] == 8 || $_SESSION['id_user_role'] == 9){ // SECTOR HEAD | BUDGET OFFICER ?>
									<button id="btnAdd" class="btn btn-warning btn-round ml-auto">
										<i class="fa fa-plus"></i>
										Add
									</button>
									<?php } ?>

								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="multi-filter-select" class="display table table-striped table-hover" >
										<thead>
											<tr>
												<th hidden>id</th>
												<th>College</th>
												<th>Funds Type</th>
												<th>Funds/Amount</th>
												<th>Created By</th>
											</tr>
										</thead>
                                        <tbody>
											<?php foreach($college_budget as $row): ?>
												<tr>
													<td hidden><?= $row->id?></td>
													<td><?= $row->college?></td>
													<td><?= $row->fund_type?> (<?= $row->fund_type_desc?>)</td>
													<td>₱ <?= number_format($row->funds,2)?></td>
													<td>
														<?= ucwords($row->created_by)?> <br>
														<?php if($row->signature != ""){?>
														<a target="_blank" href="<?= base_url() ?>public/uploads/signature/<?= $row->signature?>"><img src="<?= base_url() ?>public/uploads/signature/<?= $row->signature?>" class="img-thumbnail w-25" alt=""></a>
														<?php }?>
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

<?php $this->load->view('dashboard/modal/add-budget-allocation')?>
<?php $this->load->view('dashboard/template/footer.php')?>
<?php $this->load->view('dashboard/class/input-text-accept-money-only.php')?>
<?php $this->load->view('dashboard/class/notification.php')?>
<?php $this->load->view('dashboard/class/delete.php')?>

<script>
	$('#btnAdd').click(function(){
		$('#addRowModal').modal('show');
		$('#addRowModal').find('.modal-title').text('College Budget');
		$('#myForm').attr('action','<?php echo base_url() ?>college_budget/save');
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
		$('#myForm').attr('action','<?php echo base_url() ?>/college_budget/update');
		$('#btnssave').text('Update');
		$('#btnssave').attr('data-operation','update');
		

		$.ajax({
			type: 'ajax',
			method: 'post',
			url: '<?php echo base_url()?>college_budget/edit',
			data:{
				id:id
				},
			async: false,
			dataType: 'text',
			success: function(response){
				var data = JSON.parse(response);
				$("#id").val(data[0].id);
				$("#college_id").val(data[0].college_id);
				// $("#sector_id").trigger('change');
				// $("#department_id").val(data[0].department_id);
				$("#id_funds_type").val(data[0].id_funds_type);
				$("#funds").val(data[0].funds);
			},
			error: function(){
				swal('Something went wrong');
			}
		});
	}

	// $("#sector_id").on('change',function(){
	// 	let sector_id = $(this).val();
	// 	$("#department_id").html('<option value="">Select Sector First</option>');
	// 	$.ajax({
	// 		type: 'ajax',
	// 		method: 'post',
	// 		url: '<?php echo base_url()?>departments/get_department',
	// 		data:{
	// 			sector_id:sector_id
	// 			},
	// 		async: false,
	// 		dataType: 'text',
	// 		success: function(response){
	// 			var data = JSON.parse(response);
	// 			$("#department_id").html('<option value="">Select</option>');
	// 			for(var i = 0; i < data.length; i++){
	// 				$("#department_id").append('<option value="'+ data[i].id +'">'+ data[i].name +'</option>');
	// 			}
	// 		},
	// 		error: function(){
	// 			swal('Something went wrong');
	// 		}
	// 	});
	// })

	$('#sector_id').select2({
        theme: "bootstrap"
    });
	$('#id_funds_type').select2({
        theme: "bootstrap"
    });
</script>
