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
									<h4 class="card-title"><?= $status_text ?> Purchase Requests</h4>

									<?php if($_SESSION['id_user_role'] != 8 && $_SESSION['id_user_role'] != 9){ ?>
									<a href="<?= base_url()?>purchase_requests/create_pr" id="btnAdd" class="btn btn-warning btn-round ml-auto">
										<i class="fa fa-plus"></i>
										Add
									</a>
									<?php } ?>

								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="multi-filter-select" class="display table table-striped table-hover" >
										<thead>
											<tr>
												<th hidden>id</th>
												<th>Project</th>
												<th>PR Number</th>
												<th>Date</th>
												<th>Purpose</th>
												<th>Status Remarks</th>
												<?php if($_SESSION['id_user_role'] != 10){ //BAC SEC ?>
												<th>Option</th>
												<?php } ?>
											</tr>
										</thead>
                                        <tbody>
											<?php foreach($purchase_requests as $row): ?>
												<tr>
													<td hidden><?= $row->id?></td>
													<td><span class="badge badge-warning"><?= $row->project?></span></td>
													<td><?= $row->pr_number?></td>
													<td><?= $row->date?></td>
													<td><?= $row->purpose?></td>
													<td><?= $row->status_remarks?></td>
													<?php if($_SESSION['id_user_role'] != 10){ //BAC SEC ?>
													<td>
														<div class="btn-group">
															<button title="Edit" class="btn btn-warning btn-sm br-0" onclick="getEdit('<?= $row->id ?>')" ><i class="fa fa-edit"></i></button>
															<?php if(($_SESSION["id_user_role"] != 3) && ($status == 0 || $status == 2)){ ?>
																<button title="Delete" class="btn btn-success btn-sm br-0" onclick="updateStatus('<?= $row->id ?>','1')"><i class="fa fa-check"></i> Approve</button>
															<?php } ?>
															
															<?php if($status == 1){ ?>
															<a target="_blank" href="<?= base_url() ?>purchase_requests/downloadPDF/<?php echo isset($row->id) ? $row->id: '' ?>" title="Delete" class="btn btn-success btn-sm br-0"><i class="fas fa-bookmark"></i> PR Document</a>
															<?php } ?>

															<?php if(($_SESSION["id_user_role"] != 3) && ($status == 0 || $status == 1)){ ?>
																<button title="Delete" class="btn btn-danger btn-sm br-0" onclick="updateStatus('<?= $row->id ?>','2')"><i class="fa fa-trash"></i> Reject</button>
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

<?php $this->load->view('dashboard/modal/update-pr-status.php')?>
<?php $this->load->view('dashboard/template/footer.php')?>
<?php $this->load->view('dashboard/class/notification.php')?>
<?php $this->load->view('dashboard/class/delete.php')?>

<script>

	function updateStatus(id,status){
		let modal_title = "Mark as Approve this Purchase Request";
		if(status == 2){
			let modal_title = "Mark as Reject this Purchase Request";
		}
		$("#id_pr").val(id);
		$("#status").val(status);

		$('#addRowModalStatus').modal('show');
		$('#addRowModalStatus').find('.modal-title').text(modal_title);
		$('#myFormStatus').attr('action','<?php echo base_url() ?>purchase_requests/update_status');
		$('#btnssave').text('Update');
		$('#btnssave').attr('data-operation','update');
	}

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
				$("#name").val(data[0].name);
			},
			error: function(){
				swal('Something went wrong');
			}
		});
	}
</script>
