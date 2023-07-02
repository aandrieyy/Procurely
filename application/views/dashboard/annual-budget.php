<?php $this->load->view('dashboard/template/header.php')?>
<?php $this->load->view('dashboard/template/sidebar.php')?>

	<div class="main-panel">
		<div class="content">
			<div class="page-inner">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
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
                                            <p class="card-category">Total Annual Budget</p>
                                            <h4 class="card-title">₱ <?php echo isset($budget_stats->total_annual_budget) ? number_format($budget_stats->total_annual_budget,2) : number_format(0,2) ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
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
                                            <h4 class="card-title">₱ <?php echo isset($budget_stats->total_sector_budget) ? number_format($budget_stats->total_sector_budget,2) : number_format(0,2) ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
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
                                            <h4 class="card-title">₱ <?php echo isset($budget_stats->remaining_annual_budget) ? number_format($budget_stats->remaining_annual_budget,2) : number_format(0,2) ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="row row-card-no-pd">
					<div class="col-md-12">
						<div class="alert alert-info">No EDIT and DELETE for the annual budget record to avoid data(money) manipulation!</div>
					</div>
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<div class="card-head-row">
									<h4 class="card-title">Annual Budget</h4>

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
												<th>Date</th>
												<th>Amount</th>
												<!-- <th>Type</th>
												<th>Amount After</th> -->
												<th>Created By</th>
												<th>Remarks</th>
												<!-- <th>Option</th> -->
											</tr>
										</thead>
                                        <tbody>
											<?php foreach($data as $row): ?>
												<tr>
													<td hidden><?= $row->id?></td>
													<td><?= date("F j, Y",strtotime($row->date)) ?></td>
													<td>₱<?= number_format($row->amount,2)?></td>
													
													<td>
														<?= ucwords($row->created_by)?> <br>
														<?php if($row->signature != ""){?>
														<a target="_blank" href="<?= base_url() ?>public/uploads/signature/<?= $row->signature?>"><img src="<?= base_url() ?>public/uploads/signature/<?= $row->signature?>" class="img-thumbnail w-25" alt=""></a>
														<?php }?>
													</td>
													<td><b><?= $row->remarks?></b> <br> <small><i><?= $row->transaction_description?></i></small></td>
													<!-- <td>
														<div class="btn-group">
															<button title="Edit" class="form-control btn-warning btn-sm br-0" onclick="getEdit('<?= $row->id ?>')" ><i class="fa fa-edit"></i></button>
															<button title="Delete" class="form-control btn-danger btn-sm br-0" onclick="getDelete('<?= $row->id ?>','<?= base_url()?>annual_budget/delete')"><i class="fa fa-trash"></i></button>
														</div>
													</td> -->
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

<?php $this->load->view('dashboard/modal/add-annual-budget')?>
<?php $this->load->view('dashboard/template/footer.php')?>
<?php $this->load->view('dashboard/class/notification.php')?>
<?php $this->load->view('dashboard/class/delete.php')?>
<?php $this->load->view('dashboard/class/input-text-accept-money-only.php')?>

<script>
	$('#btnAdd').click(function(){
		$('#addRowModal').modal('show');
		$('#addRowModal').find('.modal-title').text('Annual Budget');
		$('#myForm').attr('action','<?php echo base_url() ?>annual_budget/save');
		$('#btnssave').text('Save');

		$("#date").val('');
		$("#amount").val('');
		$("#remarks").val('');
	});

	function getEdit(id){
		$('#addRowModal').modal('show');
		$('#addRowModal').find('.modal-title').text('Update');
		$('#myForm').attr('action','<?php echo base_url() ?>/annual_budget/update');
		$('#btnssave').text('Update');
		$('#btnssave').attr('data-operation','update');
		

		$.ajax({
			type: 'ajax',
			method: 'post',
			url: '<?php echo base_url()?>annual_budget/edit',
			data:{
				id:id
				},
			async: false,
			dataType: 'text',
			success: function(response){
				var data = JSON.parse(response);
				$("#id").val(data[0].id);
				$("#date").val(data[0].date);
				$("#amount").val(data[0].amount);
				$("#remarks").val(data[0].remarks);
			},
			error: function(){
				swal('Something went wrong');
			}
		});
	}
</script>
