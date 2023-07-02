

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
							<a href="#"><?= $title?></a>
						</li>
					</ul>
				</div>

				<!-- FILTERS -->
				<div hidden class="row row-card-no-pd">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<div class="card-head-row">
									<h4 class="card-title">Filters</h4>
									<!-- <button id="btnAdd" class="btn btn-success btn-round ml-auto">
										<i class="fa fa-plus"></i>
										Add 
									</button> -->

									<div class="input-group-append filter-action-btn ml-auto">
										<button class="btn btn-success dropdown-toggle btn-round " type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Action</button>
										<div class="dropdown-menu">
											<a class="dropdown-item" href="#" onclick="action('view_data')">View Data</a>
											<a class="dropdown-item" href="#" onclick="action('view_report')">View Report</a>
											<!-- <a class="dropdown-item" href="#" onclick="action('view_data_report')">View Data & Report</a> -->
										</div>
									</div>

								</div>
							</div>
							 <div class="card-body">
								<div class="jumbotron jumbotron-thin">
									<div class="row filter-less-mb">
										<div class="col-md-3">
											<div class="form-group form-group-default">
												<label><span class="text-danger"><span class="text-danger"></span></span> From</label>
												<input  type="date" name="date_from" id="date_from" class="form-control" value="<?= date('Y-m-d') ?>">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group form-group-default">
												<label><span class="text-danger"><span class="text-danger"></span></span> To</label>
												<input  type="date" name="date_to" id="date_to" class="form-control" value="<?= date('Y-m-d') ?>">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group form-group-default">
												<label><span class="text-danger"><span class="text-danger"></span></span> Project Type</label>
												<select name="id_category_project_type" id="id_category_project_type" class="form-control" required>
													<option value="">All</option>
													<?php foreach($project_types as $row): ?>
														<option value="<?= $row->id?>"><?= $row->category?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group form-group-default">
												<label><span class="text-danger"><span class="text-danger"></span></span> Project Status</label>
												<select name="id_category_status" id="id_category_status" class="form-control" required>
													<option value="">All</option>
													<?php foreach($project_status as $row): ?>
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

				<!-- TABLE DATA -->
				<div class="row row-card-no-pd" id="printTable">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<div class="card-head-row">
									<h4 class="card-title"><?= $title?></h4>

								</div>
							</div>
							<div class="card-body">
								<img src="<?= base_url()?>public/assets/img/report-header.jpg" style="width:100%;" alt="navbar brand" class="navbar-brand report-header">
                                <?php $month = isset($_GET['month']) ? $_GET['month'] : date("Y-m"); ?>
                                <form action="<?= base_url()?>projects/report" method="POST" id="myForm">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group form-group-default fc-mb">
                                                <label><span class="text-danger">*</span> Select Project:  </label>
                                                <select name="id_project" id="id_project" class="form-control" required>
                                                    <option value="">All</option>
                                                    <?php foreach($projects_data as $row): ?>
                                                        <option value="<?= $row->id?>"><?= $row->project?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-warning btn-lg btn-block fbutton">
                                                <i class="fa fa-search"></i>
                                                Search
                                            </button>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" onclick="printDiv()" class="btn btn-warning btn-lg btn-block fbutton">
                                                <i class="fa fa-print"></i>
                                                Print
                                            </button>
                                        </div>
                                    </div>
                                </form>

								<div class="col-md-12 mt-3">
									<div class="bg-black p-1 text-white">Project Details</div>
									<div class="table-responsive">
                                        <div class="form-group">
                                            <label for="project_status_select">Project Status</label>
                                            <select class="form-control" id="project_status_select">
                                                <option></option>
                                                <option>Pending</option>
                                                <option>Completed</option>
                                        	</select>
                                        </div>
										<table id="project_table" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>Project</th>
													<th>Type</th>
													<th>Subtype</th>
													<th>Project Cost</th>
													<th>Duration</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody class="table_data">
												<?php foreach($projects as $row): ?>
													<tr>
														<td><?= $row->project?></td>
														<td><span class="badge badge-success"><?= ucfirst($row->project_type) ?></span></td>
														<td><span class="badge badge-info"><?= ucfirst($row->subtype) ?></span></td>
														<td>₱ <?= number_format($row->tcp,2) ?></td>
														<td><span class="badge badge-success"><?= ucfirst($row->start_date) ?></span> to <span class="badge badge-danger"><?= ucfirst($row->end_date) ?></span></td>
														<td><span class="badge badge-warning"><?= ucfirst($row->status) ?></span></td>
													</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
								<?php if($this->session->userdata("id_user_role") != 3 && $this->session->userdata("id_user_role") != 5): ?>
								<div class="col-md-12 mt-3">
									<div class="bg-black p-1 text-white">Procurement Details</div>
									<div class="table-responsive">
                                        <div class="form-group">
                                            <label for="procurement_status_select">Procurement Status</label>
                                            <select class="form-control" id="procurement_status_select">
                                                <option></option>
                                                <option>For PO / Ordered</option>
                                                <option>In Stock</option>
                                        	</select>
                                        </div>
										<table id="procurement_table" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>Project</th>
													<th>Material</th>
													<th>Supplier</th>
													<th>Quantity</th>
													<th>Price</th>
													<th>Total</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($procurements as $row): ?>
													<tr>
														<td><span class="badge badge-success"><?= ucfirst($row->project) ?></span></td>
														<td><?= $row->materials?></td>
														<td><?= $row->quantity?></td>
														<td><?= $row->supplier?></td>
														<td>₱ <?= number_format($row->price,2)?></td>
														<td>₱ <?= number_format(($row->price * $row->quantity),2)?></td>
														<td><?= $row->status?></td>
													</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
								<?php endif; ?>
								<div class="col-md-12 mt-3">
									<div class="bg-black p-1 text-white">Scheduling & Delivery</div>
									<div class="table-responsive">
										<table id="multi-filter-selec3t" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>Project</th>
													<th>Status</th>
													<th>Quantity</th>
													<th>Supply Type</th>
													<th>DR</th>
													<th>Date</th>
													<th>Description</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($scheddelivery as $row): ?>
													<tr>
														<td><span class="badge badge-success"><?= ucfirst($row->project) ?></span></td>
														<td><?= $row->status?></td>
														<td><?= $row->delivery_qty?></td>
														<td><?= $row->subtype?></td>
														<td></td>
														<td><?= $row->delivery_date?></td>
														<td><?= $row->item_description?></td>
													</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
								<?php if($this->session->userdata("id_user_role") != 3 && $this->session->userdata("id_user_role") != 5): ?>
								<div class="col-md-12 mt-3">
									<div class="bg-black p-1 text-white">Production</div>
									<div class="table-responsive">
										<table id="multi-filter-selec3t" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>Project</th>
													<th>Item Description</th>
													<th>Deadline</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($invproduction as $row): ?>
													<tr>
														<td><span class="badge badge-success"><?= ucfirst($row->project) ?></span></td>
														<td><?= $row->item?></td>
														<td><?= $row->deadline?></td>
														<td><?= $row->status?></td>
													</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
								<?php endif; ?>
								<div class="col-md-12 mt-3">
									<div class="bg-black p-1 text-white">Tasks</div>
									<div class="table-responsive">
										<table id="multi-filter-se3lect" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>Project</th>
													<th>Project Manager</th>
													<th>Project In Charge</th>
													<th>Forman</th>
													<th>List of Laborers</th>
													<th>Tasks Description</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($tasks as $row): ?>
													<tr>
														<td><span class="badge badge-success"><?= ucfirst($row->project) ?></span></td>
														<td><?= $row->project_manager?></td>
														<td><?= $row->project_in_charge?></td>
														<td><?= $row->forman?></td>
														<td>
															<?php 
															$tasks_laborer = $this->customlib->get_laborers($row->id);
															foreach($tasks_laborer as $row1): ?>
																<?= $row1->employee_actual_id?>
																<?= $row1->name?>
																<hr>
															<?php endforeach; ?>
														</td>
														<td><?= $row->task_description?></td>
														<td>
														</td>
													</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="col-md-12 mt-3">
									<div class="bg-black p-1 text-white">Billing</div>
									<div class="table-responsive">
										<table id="multi-filter-selec3t" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>Project</th>
													<th>Date</th>
													<th>PB Count</th>
													<th>PB Accomplishment (%)</th>
													<th>Value of Accomplishment</th>
													<th>Less DP</th>
													<th>Retention</th>
													<th>Total Payable</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($billings as $row): ?>
													<tr>
														<td><span class="badge badge-success"><?= ucfirst($row->project) ?></span></td>
														<td><?= $row->date?></td>
														<td><?= $row->pb_count?></td>
														<td><?= $row->pb_accomplishment?>%</td>
														<td>₱<?= number_format($row->value_of_accomplishment,2)?></td>
														<td>₱<?= number_format($row->less_dp,2)?></td>
														<td>₱<?= number_format($row->retention,2)?></td>
														<td>₱<?= number_format( $row->total_payable,2)?></td>
														<td><?= $row->status?></td>
													</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="col-md-12 mt-3">
									<div class="bg-black p-1 text-white">Retention</div>
									<div class="table-responsive">
										<table id="multi-filter-selec3t" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>Project</th>
													<th>Completion Date</th>
													<th>Date of issuance of COC</th>
													<th>End of Retention</th>
													<th>End of Retention</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($retention as $row): ?>
													<tr>
														<td><span class="badge badge-success"><?= ucfirst($row->project) ?></span></td>
														<td><?= $row->completion_date?></td>
														<td><?= $row->date_of_issuance_of_coc?></td>
														<td><?= $row->end_of_retention?></td>
														<td>₱<?php echo isset($row->retention_amount) ? number_format($row->retention_amount,2) : '0'?></td>
														<td><?= $row->status?></td>
													</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
								<img src="<?= base_url()?>public/assets/img/report-footer.jpg" style="width:100%;" alt="navbar brand" class="navbar-brand report-header">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php $this->load->view('dashboard/template/footer.php')?>
<?php $this->load->view('dashboard/class/input-text-accept-money-only.php')?>
<?php $this->load->view('dashboard/class/input-text-accept-number-only.php')?>
<?php $this->load->view('dashboard/class/notification.php')?>
<?php $this->load->view('dashboard/class/money_format.php')?>

<script>
    $("#id_project").val('<?php echo isset($id_project) ? $id_project : '' ?>');
	$(".report-header").hide();
	$(".report-footer").hide();
    function printDiv() 
	{
		$(".action").hide();
		$(".fbutton").hide();
		
// 		$(".report-header").show();
// 		$(".report-footer").show();
		
		$('#myForm').hide();
		$('.card-header').prepend('<img src="<?=base_url()?>public/assets/img/report-header.jpg?>" class="mx-auto d-block" style="width:50%;">');
		$('.card-body').append('<div class="text-center border-top border-dark w-100"><p class="mx-auto d-block" style="font-size: 1.5rem; margin-bottom: -8px;">For business inquiries:</p><p class="mx-auto d-block" style="font-size: 1.5rem; margin-top: -8px; margin-bottom: -8px;">Set an appointment: coerpa.net/appointments</p><p class="mx-auto d-block" style="font-size: 1.5rem; margin-top: -8px; margin-bottom: -8px;">E-mail: coerpa@yahoo.com</p><p class="mx-auto d-block" style="font-size: 1.5rem; margin-top: -8px; margin-bottom: -8px;">Mobile: 09173305687</p></div>');
		
		
		var printContents = document.getElementById("printTable").innerHTML;
		var originalContents = document.body.innerHTML;

		document.body.innerHTML = printContents;

		window.print();

		document.body.innerHTML = originalContents;
		
		location.reload();
	}
	
    $("#project_status_select").on("change", function() {
        var value = $(this).val().toLowerCase();
            $("#project_table tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
	
    $("#procurement_status_select").on("change", function() {
        var value = $(this).val().toLowerCase();
            $("#procurement_table tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
	
    $("#delivery_status_select").on("change", function() {
        var value = $(this).val().toLowerCase();
            $("#delivery_table tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
	
    $("#production_status_select").on("change", function() {
        var value = $(this).val().toLowerCase();
            $("#production_table tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
	
    $("#retention_status_select").on("change", function() {
        var value = $(this).val().toLowerCase();
            $("#retention_table tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
</script>
