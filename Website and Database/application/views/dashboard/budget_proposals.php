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
									<h4 class="card-title"><?= $status_text ?> Budget Proposals</h4>
                                    <?php if($_SESSION['id_user_role'] == 3){ //DEPARTMENT ?>
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
												<th>Department</th>
												<th>Year</th>
												<th>Proposal Name</th>
												<th>Amount</th>
												<th>Status</th>
												<?php if($_SESSION['id_user_role'] != 10){ //BAC SEC ?>
												<th>Option</th>
												<?php } ?>
											</tr>
										</thead>
                                        <tbody>
											<?php foreach($budget_proposals as $row): ?>
												<tr>
													<td hidden><?= $row->id?></td>
													<td><?= $row->department?></td>
													<td><?= $row->year?></td>
                                                  
													<td>
                                                        <?php
                                                        if($row->proposal_file == ""){
                                                            ?>
                                                            <?= $row->proposal_name?>
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <a download href="<?= base_url() ?>public/uploads/budget_proposal/<?= $row->proposal_file?>" target="_blank"><?= $row->proposal_name?></a>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
													<td>₱<?= number_format($row->amount,2)?></td>
													<td style="padding:15px">
														Status: <?= $status_text?> <br>
														Status Remarks: <?= $row->status_remarks?> <br>
														Update By: <?= $row->update_by ?> <br>
														Signature:  <br>
														<?php if($row->signature != ""){?>
														<a target="_blank" href="<?= base_url() ?>public/uploads/signature/<?= $row->signature?>"><img src="<?= base_url() ?>public/uploads/signature/<?= $row->signature?>" class="img-thumbnail w-25" alt=""></a>
														<?php }?>
													</td>

													<?php if($_SESSION['id_user_role'] != 10){ //BAC SEC ?>
													<td>
														<div class="btn-group">
                                                            <?php if($_SESSION['id_user_role'] == 3){ //DEPARTMENT ?>
															<button title="Edit" class="btn btn-warning btn-sm br-0" onclick="getEdit('<?= $row->id ?>')" ><i class="fa fa-edit"></i></button>
															<?php } ?>
															
															<?php if(($status == 0 || $status == 2) && $_SESSION['id_user_role'] == 9){ //9 = BUDGET OFFICER ?>
																<button title="Approve" class="btn btn-success btn-sm br-0" onclick="updateStatus('<?= $row->id ?>','1')"><i class="fa fa-check"></i> Approve</button>
															<?php } ?>
															
															<?php if(($status == 0 || $status == 1) && $_SESSION['id_user_role'] == 9){  //9 = BUDGET OFFICER ?>
																<button title="Delete" class="btn btn-danger btn-sm br-0" onclick="updateStatus('<?= $row->id ?>','2')"><i class="fa fa-trash"></i> Reject</button>
															<?php } ?>

															<?php if($_SESSION['id_user_role'] == 3 ){ ?>
																<button title="Delete" class="btn btn-danger btn-sm br-0" onclick="getDelete('<?= $row->id ?>','<?= base_url()?>/budget_proposals/delete')"><i class="fa fa-trash"></i></button>
															<?php } ?>

														</div>
													</td>
													<?php } ?>
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

<?php $this->load->view('dashboard/modal/add-budget-proposal')?>
<?php $this->load->view('dashboard/modal/update-bp-status.php')?>
<?php $this->load->view('dashboard/template/footer.php')?>
<?php $this->load->view('dashboard/class/input-text-accept-money-only.php')?>
<?php $this->load->view('dashboard/class/notification.php')?>
<?php $this->load->view('dashboard/class/delete.php')?>

<script>
	$('#btnAdd').click(function(){
        $(".pfileEdit").hide();
		$('#addRowModal').modal('show');
		$('#addRowModal').find('.modal-title').text('Sector');
		$('#myForm').attr('action','<?php echo base_url() ?>budget_proposals/save');
		$('#btnssave').text('Save');

		$("#id").val('');
		$("#department_id").val('');
		$("#year_id").val('');
		$("#proposal_name").val('');
		$("#proposal_file").val('');
		$("#amount").val('');
		$("#remarks").val('');
	});

	function getEdit(id){
        $(".pfileEdit").show();
		$('#addRowModal').modal('show');
		$('#addRowModal').find('.modal-title').text('Update');
		$('#myForm').attr('action','<?php echo base_url() ?>/budget_proposals/update');
		$('#btnssave').text('Update');
		$('#btnssave').attr('data-operation','update');
		

		$.ajax({
			type: 'ajax',
			method: 'post',
			url: '<?php echo base_url()?>budget_proposals/edit',
			data:{
				id:id
				},
			async: false,
			dataType: 'text',
			success: function(response){
				var data = JSON.parse(response);
				$("#id").val(data[0].id);
				$("#department_id").val(data[0].department_id);
				$("#year_id").val(data[0].year_id);
				$("#proposal_name").val(data[0].proposal_name);
				$("#proposal_file").val(data[0].proposal_file);
				$("#amount").val(data[0].amount);
				$("#remarks").val(data[0].remarks);
			},
			error: function(){
				swal('Something went wrong');
			}
		});
	}

    function updateStatus(id,status){
		let modal_title = "Mark as Approve this Budget Proposal";
		if(status == 2){
			let modal_title = "Mark as Reject this Budget Proposal";
		}
		$("#id_ppmp").val(id);
		$("#status").val(status);

		$('#addRowModalStatus').modal('show');
		$('#addRowModalStatus').find('.modal-title').text(modal_title);
		$('#myFormStatus').attr('action','<?php echo base_url() ?>budget_proposals/update_status');
		$('#btnssave').text('Update');
		$('#btnssave').attr('data-operation','update');
	}
</script>
