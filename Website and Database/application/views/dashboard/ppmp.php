<?php $this->load->view('dashboard/template/header.php')?>
<?php $this->load->view('dashboard/template/sidebar.php')?>

	<div class="main-panel">
		<div class="content">
			<div class="page-inner">
				<div class="row">
					<!-- <div class="col-sm-6 col-md-6">
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
                                            <p class="card-category">TOTAL</p>
                                            <h4 class="card-title">₱ <?php echo isset($report->total) ? number_format($report->total,2) : number_format(0,2) ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
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
                                            <p class="card-category">TOTAL WITH CONTINGENCY (+20%)</p>
                                            <h4 class="card-title">₱ <?php echo isset($report->total) ? number_format(($report->total + ($report->total * 0.20)) ,2) : number_format(0,2) ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
				</div>
				<div class="row row-card-no-pd">
					<div class="col-md-12">
						<?php
						if($_SESSION['id_user_role'] == 11 || $_SESSION['id_user_role'] == 8 || $_SESSION['id_user_role'] == 10 || $_SESSION['id_user_role'] == 9 || $_SESSION['id_user_role'] == 3){ // college , sector head, bac sec, budget officer
							?>	
							<div class="row">
								<div class="col-md-2 text-center">
									<img src="<?= base_url()?>public/assets/img/logoo.png"  style="width:100px;" class="m-3">
								</div>
								<div class="col-md-8 text-center">
									<h2><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES</b></h2>
									<br>
									Ayala Blvd., Ermita, Manila, 1000, Philippines 
									<br>
									Website: www.tup.edu.ph
								</div>
								<div class="col-md-2"></div>
							</div>
							<div class="row">
								<div class="col-md-2"></div>
								<div class="col-md-8 text-center">
									<?php
									$title = 'CONSOLIDATED PROJECT PROCUREMENT MANAGEMENT PLAN (PPMP) <br>';
									if(isset($ppmp)){
										if($ppmp->generated_docu_type == 'app'){
											$title = 'ANNUAL PROCUREMENT MANAGEMENT PLAN (APP)<br>';
										}
									}
									// $content .= $title;
									?>
									<h5><?= $title?></h5>
									<p>Calendar Year :2023</p>
								</div>
								<div class="col-md-2"></div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="table-responsive">
										<table id="multi-filter-selec1t" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th hidden>id</th>
													<th width="10">No.</th>
													<th width="70">Description</th>
													<?php
													if(isset($ppmp)){
														if($ppmp->generated_docu_type == 'app' && $_SESSION['id_user_role'] == 9){ // budget officier
															echo '<th width="15%">End User</th>';
														}
													}
													?>
													<th width="10">Qty.</th>
													<th width="10">Jan</th>
													<th width="5">Feb</th>
													<th width="5">Mar</th>
													<th width="5">Apr</th>
													<th width="5">May</th>
													<th width="5">Jun</th>
													<th width="5">Jul</th>
													<th width="5">Aug</th>
													<th width="5">Sept</th>
													<th width="5">Oct</th>
													<th width="5">Nov</th>
													<th width="5">Dec</th>
													<th>Price Catalogue</th>

													<?php if($_SESSION['id_user_role'] == 10){ //bac sec ?>
													<th width="5">College</th>
													<th width="5">Department</th>
													<?php } ?>

													<th>Total Amount</th>
													<?php if($_SESSION['id_user_role'] == 9 && $status == 0){ // BUDGET OFFICIER ?>
														<th>Department</th>
														<th>Remarks</th>
													<?php } ?>
												</tr>
											</thead>
											<tbody class="items">
												<?php 
												$count = 0;
												$total_amt = 0;
												foreach($ppmp_item as $row): 
													$count += 1;
													$total_amt += ($row->total_qty * $row->unit_price);
													?>
													<tr>
														<td hidden><?= $row->ppmp_id?></td>
														<td><?= $count?></td>
														<td><?= $row->description ?></td>
														<?php
														if(isset($ppmp)){
															if($ppmp->generated_docu_type == 'app' && $_SESSION['id_user_role'] == 9){ // budget officier
																echo '<td>'.$row->sector.'</td>';
															}
														}
														?>
														<td><?= $row->total_qty ?></td>
														<td><?php if($row->jan == 1){ echo '*'; }else{ echo ''; } ?></td>
														<td><?php if($row->feb == 1){ echo '*'; }else{ echo ''; } ?></td>
														<td><?php if($row->mar == 1){ echo '*'; }else{ echo ''; } ?></td>
														<td><?php if($row->apr == 1){ echo '*'; }else{ echo ''; } ?></td>
														<td><?php if($row->may == 1){ echo '*'; }else{ echo ''; } ?></td>
														<td><?php if($row->jun == 1){ echo '*'; }else{ echo ''; } ?></td>
														<td><?php if($row->jul == 1){ echo '*'; }else{ echo ''; } ?></td>
														<td><?php if($row->aug == 1){ echo '*'; }else{ echo ''; } ?></td>
														<td><?php if($row->sep == 1){ echo '*'; }else{ echo ''; } ?></td>
														<td><?php if($row->oct == 1){ echo '*'; }else{ echo ''; } ?></td>
														<td><?php if($row->nov == 1){ echo '*'; }else{ echo ''; } ?></td>
														<td><?php if($row->december == 1){ echo '*'; }else{ echo ''; } ?></td>
														<td><?= number_format($row->unit_price,2) ?></td>

														<?php if($_SESSION['id_user_role'] == 10){ //bac sec ?>
															<td><?= $row->department_name ?></td>
															<td><?= $row->college_name ?></td>
														<?php } ?>

														<td><?= number_format(($row->total_qty * $row->unit_price),2) ?></td>
														<?php if($_SESSION['id_user_role'] == 9 && $status == 0){ // BUDGET OFFICIER ?>
															<td><?= $row->department ?></td>
															<td>
																<div class="btn-group">
																	<button title="Approve" class="btn btn-success btn-sm br-0" onclick="updateStatus('<?= $row->ppmp_id ?>','<?= $row->project_item_id ?>','1')"><i class="fa fa-check"></i></button>
																	<button title="Delete" class="btn btn-danger btn-sm br-0" onclick="updateStatus('<?= $row->ppmp_id ?>','<?= $row->project_item_id ?>','2')"><i class="fa fa-times"></i></button>
																</div>
															</td>
														<?php } ?>
													</tr>
												<?php endforeach; ?>
												<tr>
													<!-- <td  colspan="17">Total:</td><td align="left" colspan="1">₱<?= number_format($total_amt,2) ?></td>  -->
													<?php
													if(isset($ppmp)){
														if($ppmp->generated_docu_type == 'app' && $_SESSION['id_user_role'] == 9){ // budget officier
															// echo '<td></td>';
														}
													}
													?>
													<?php if($_SESSION['id_user_role'] == 9 && $status == 0){ // BUDGET OFFICIER ?>
														<td></td><td></td>
													<?php } ?>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="row">
										<div class="col-md-2"><b>Total:</b></div><div class="col-md-8"></div><div class="col-md-2 text-right"><span class="mr-4 fw-bold">₱<?= number_format($total_amt,2) ?></span></div>
									</div>
								</div>
								<div class="col-md-12 mt-3">
								<?php if($_SESSION['id_user_role'] != 10){ ?>
									<div class="btn-group">

											<?php if($_SESSION['id_user_role'] != 3){ ?>
												<a target="_blank" href="<?= base_url() ?>ppmp/generateDocu/<?= $ppmp_category?>/document/<?= $status?>" class="btn btn-danger">Generate Document</a>
											<?php }else{ ?>
												<a href="#" id="btnSend" class="btn btn-danger">Send</a>
											<?php } ?>

											<?php
											if($_SESSION['id_user_role'] == 9 && $status == 1){
												?>
													<a target="_blank" id="btnGenerateApp" class="btn btn-warning">Generate APP</a>
													<!-- <a target="_blank" href="<?= base_url() ?>ppmp/generateDocu/<?= $ppmp_category?>/app" class="btn btn-warning">Generate APP</a> -->
												<?php
											}
											?>
										</div>

										<?php if($_SESSION['id_user_role'] == 11){ // COLLEGE ?>
											<p>Prepared By:</p>
											<?php if(isset($ppmp)){ // COLLEGE ?>
												<p><?= $ppmp->college ?></p>
											<?php } ?>
										<?php } ?>
									</div>
								<?php } ?>
							</div>
							<?php
						}else{
							?>
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">

										<?php if($_SESSION['id_user_role'] == 8){ // SECTOR HEAD ?>
											<h4 class="card-title">LIST OF CONSOLIDATED PPMP OF COLLEGES</h4>
										<?php }else{
											?>
											<h4 class="card-title">List of <?= $status_text?> <?= $ppmp_categories?> PPMP</h4>
											<?php
										} ?>

										<?php if($_SESSION['id_user_role'] == 3){ //DEPARTMENT ?>
										<!-- <button id="btnAdd" class="btn btn-warning btn-round ml-auto">
											<i class="fa fa-plus"></i>
											Add
										</button> -->
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
													<th>Year ID</th>
													<th>Project Title</th>
													<th>Total</th>
													<th>Total With Contingency(+20%)</th>
													<th width="100">Status Remarks</th>
													<th>Option</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($ppmp as $row): ?>
													<tr>
														<td hidden><?= $row->id?></td>
														<td><?= $row->department?></td>
														<td><?= $row->year?></td>
														<td><?= $row->project?></td>
														<td>₱<?=  number_format($row->total,2) ?></td>
														<td>₱<?=  number_format((($row->total * 0.20) + $row->total),2) ?></td>
														<td >
															<?php if($row->signature != ""){?>
															<a target="_blank" href="<?= base_url() ?>public/uploads/signature/<?= $row->signature?>"><img src="<?= base_url() ?>public/uploads/signature/<?= $row->signature?>" class="img-thumbnail w-25" alt=""></a>
															<?php }?>
															<br>
															<?= $row->status_remarks?>
														</td>

														
														<td>
															<div class="btn-group">

																<a href="<?= base_url() ?>ppmp/update_ppmp/<?= $row->id ?>" title="View" class="btn btn-warning btn-sm br-0"><i class="fa fa-eye"></i></a>
																<?php if($_SESSION['id_user_role'] != 10){ //BAC SEC ?>
																
																	<?php if($_SESSION['id_user_role'] != 3 && $_SESSION['id_user_role'] != 8 && $_SESSION['id_user_role'] != 11){ //DEPARTMENT || SECTOR HEAD || COLLEGE?>
																	<?php if($status == 0 || $status == 2){ ?>
																		<button title="Approve" class="btn btn-success btn-sm br-0" onclick="updateStatus('<?= $row->id ?>','1')"><i class="fa fa-check"></i> Approve</button>
																	<?php } ?>
																	<?php } ?>

																	<?php if(($_SESSION["id_user_role"] != 3 && $_SESSION['id_user_role'] != 8 && $_SESSION['id_user_role'] != 11) && ($status == 0)){ //DEPARTMENT || SECTOR HEAD ?>
																		<button title="Delete" class="btn btn-danger btn-sm br-0" onclick="updateStatus('<?= $row->id ?>','2')"><i class="fa fa-trash"></i> Reject</button>
																	<?php } ?>

																	<?php if($status == 1){ ?>
																	<a target="_blank" href="<?= base_url() ?>ppmp/downloadPDF/<?php echo isset($row->id) ? $row->id: '' ?>" title="Delete" class="btn btn-success btn-sm br-0"><i class="fas fa-bookmark"></i> PPMP Document</a>
																	<?php } ?>

																	<?php if($_SESSION['id_user_role'] == 3 ){ ?>
																		<button title="Delete" class="btn btn-danger btn-sm br-0" onclick="getDelete('<?= $row->id ?>','<?= base_url()?>/ppmp/delete')"><i class="fa fa-trash"></i></button>
																	<?php } ?>

																<?php } // end bac. sec. ?>
															</div>
														</td>
														
													</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php $this->load->view('dashboard/modal/add-generate-app.php')?>
<?php $this->load->view('dashboard/modal/update-ppmp-status.php')?>
<?php $this->load->view('dashboard/template/footer.php')?>
<!-- jSignature -->
<!-- <script src="<?= base_url()?>public/assets/js/plugin/jSignature/jSignature.min.js"></script>
<script src="<?= base_url()?>public/assets/js/plugin/jSignature/jSignature.min.js"></script>
<script src="<?= base_url()?>public/assets/js/plugin/jSignature/modernizr.js"></script> -->

<?php $this->load->view('dashboard/class/notification.php')?>
<?php $this->load->view('dashboard/class/input-text-accept-money-only.php')?>
<?php $this->load->view('dashboard/class/input-text-accept-number-only.php')?>
<?php $this->load->view('dashboard/class/delete.php')?>

<script type="text/javascript">
	// var signature = $("#signature").jSignature({'UndoButton':true});

	// $('#preview').click(function(){
	// var data = signature.jSignature('getData', 'image');
	// $('#signaturePreview').attr('src', "data:" + data);
	// });

	// $('#download').click(function(){
	// var image = $('#signaturePreview')[0];
	// this.href = image.src;
	// });
</script>

<script>
	$('#btnGenerateApp').click(function(){
		$('#addRowModal').modal('show');
		$('#addRowModal').find('.modal-title').text('Generate APP');
		$('#myForm').attr('action','<?php echo base_url() ?>ppmp/save_app');
		$('#btnssave').text('Save');

		// $("#funds_type_id").val('<?php echo isset($_SESSION['ppmp_funds_type_id']) ? $_SESSION['ppmp_funds_type_id'] : '' ?>');
		$("#prepared_by").val('<?php echo isset($_SESSION['ppmp_prepared_by']) ? $_SESSION['ppmp_prepared_by'] : '' ?>');
		$("#attested_by").val('<?php echo isset($_SESSION['ppmp_attested_by']) ? $_SESSION['ppmp_attested_by'] : '' ?>');
		$("#president").val('<?php echo isset($_SESSION['ppmp_president']) ? $_SESSION['ppmp_president'] : '' ?>');
	});

	$('#btnAdd').click(function(){
		$('#addRowModal').modal('show');
		$('#addRowModal').find('.modal-title').text('PPMP');
		$('#myForm').attr('action','<?php echo base_url() ?>ppmp/save');
		$('#btnssave').text('Save');

		$("#id").val('');
		$("#item_type_id").val('');
		$("#item_categories_id").val('');
		$("#code").val('');
		$("#description").val('');
		$("#unit_price").val('');
		$("#unit_id").val('');
	});

	function getEdit(id){
		$('#addRowModal').modal('show');
		$('#addRowModal').find('.modal-title').text('Update');
		$('#myForm').attr('action','<?php echo base_url() ?>/ppmp/update');
		$('#btnssave').text('Update');
		$('#btnssave').attr('data-operation','update');
		

		$.ajax({
			type: 'ajax',
			method: 'post',
			url: '<?php echo base_url()?>ppmp/edit',
			data:{
				id:id
				},
			async: false,
			dataType: 'text',
			success: function(response){
				var data = JSON.parse(response);
				$("#id").val(data[0].id);
				$("#year_id").val(data[0].year_id);
				$("#item_category_id").val(data[0].item_category_id);
				$("#project_id").val(data[0].project_id);
				$("#item_type_id").val(data[0].item_type_id);
				$("#item_type_id").trigger('change');
				$("#item_id").val(data[0].item_id);
				$("#quantity").val(data[0].quantity);
				$("#unit_id").val(data[0].unit_id);
				$("#unit_price").val(data[0].unit_price);
				$("#mode_of_procurement_id").val(data[0].mode_of_procurement_id);

				compute();
			},
			error: function(){
				swal('Something went wrong');
			}
		});
	}

	function updateStatus(ppmp_id,project_item_id,status){
		let modal_title = "Mark as Approve this PPMP Item";
		if(status == 2){
			let modal_title = "Mark as Reject this PPMP Item";
		}
		// $("#id_ppmp").val(id);
		$("#ppmp_id").val(ppmp_id);
		$("#project_item_id").val(project_item_id);
		$("#status").val(status);

		$('#addRowModalStatus').modal('show');
		$('#addRowModalStatus').find('.modal-title').text(modal_title);
		$('#myFormStatus').attr('action','<?php echo base_url() ?>ppmp/update_ppmp_item_status');
		$('#btnssave').text('Update');
		$('#btnssave').attr('data-operation','update');
	}

	function compute(){
		let unit_price = $("#unit_price").val();
		let quantity = $("#quantity").val();
		let est = 0;
		// alert(unit_price + " " +quantity);
		if(unit_price != "" && quantity != ""){
			est = parseFloat(unit_price) * parseFloat(quantity);
		}else{
			est = 0;
		}
		$("#est_Budget").val(est);
	}
	
	$("#item_type_id").on('change',function(){
		let item_type_id = $(this).val();
		$("#item_id").html('<option value="">Select Item Type First</option>');
		$.ajax({
			type: 'ajax',
			method: 'post',
			url: '<?php echo base_url()?>items/get_items',
			data:{
				item_type_id:item_type_id
				},
			async: false,
			dataType: 'text',
			success: function(response){
				var data = JSON.parse(response);
				$("#item_id").html('<option value="">Select</option>');
				for(var i = 0; i < data.length; i++){
					$("#item_id").append('<option value="'+ data[i].id +'">('+ data[i].code +') '+ data[i].description +'</option>');
				}
			},
			error: function(){
				swal('Something went wrong');
			}
		});
	})

	$("#item_id").on('change',function(){
		let item_id = $(this).val();
		$.ajax({
			type: 'ajax',
			method: 'post',
			url: '<?php echo base_url()?>items/get_items',
			data:{
				item_id:item_id
				},
			async: false,
			dataType: 'text',
			success: function(response){
				var data = JSON.parse(response);
				$("#unit_id").val(data[0].unit_id);
				$("#unit").val(data[0].unit);
				$("#unit_price").val(data[0].unit_price);
			},
			error: function(){
				swal('Something went wrong');
			}
		});
	})
	
	$("#btnSend").click(function(e){
		e.preventDefault();
		// let operation = '<?//= $operation?>';
		// var action = '1';
		// if(operation != 'save'){
		// 	var action = '2';
		// }

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

				var table_data = [];
				$('.items tr').each(function(row,tr){
					var sub = {
						'ppmp_id' : $(tr).find('td:eq(0)').text(),
					};
					table_data.push(sub); 
				});
				table_data = table_data.filter(function(e){return e}); 
				var ppmp_item = {'data_table' : table_data}

				if(ppmp_item.data_table.length == 0){
					swal('Please add some ppmp items','','warning');
					return false;
				}
				
				$.ajax({
					type: 'ajax',
					method: 'post',
					url: '<?= base_url() ?>ppmp/send',
					data: {
						ppmp_item : ppmp_item
					},
					datatype: 'text',
					success: function(response){
						// location.reload();
						swal('PPMP Item was sent successfully!','','warning');
					},
					error: function(){
						swal("Something went wrong!");
					}
				})

			} else {
				return false;
			}
		})


	})
</script>
