

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
							<!-- <div class="card-body">
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
							</div> -->
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
                                <form action="<?= base_url()?>procurements/report" method="POST" id="myForm">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group form-group-default fc-mb">
                                                <label><span class="text-danger">*</span> Project:  </label>
                                                <select name="id_project" id="id_project" class="form-control" >
                                                    <option value="">All</option>
                                                    <?php foreach($projects as $row): ?>
                                                        <option value="<?= $row->id?>"><?= $row->project?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group form-group-default fc-mb">
                                                <label><span class="text-danger">*</span> Supplier:  </label>
                                                <select name="id_supplier" id="id_supplier" class="form-control" >
                                                <option value="">All</option>
                                                    <?php foreach($suppliers as $row): ?>
                                                        <option value="<?= $row->id?>"><?= $row->name?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group form-group-default">
                                                <label><span class="text-danger">*</span> Material</label>
                                                <select name="id_procurements_materials" id="id_procurements_materials" class="form-control" >
                                                <option value="">All</option>
                                                <?php foreach($procurements_materials as $row): ?>
                                                    <option value="<?= $row->id?>"><?= $row->category?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group form-group-default fc-mb">
                                                <label><span class="text-danger">*</span> Status:  </label>
                                                <select name="id_procurements_status" id="id_procurements_status" class="form-control" >
                                                    <option value="">Select</option>
                                                    <option value="">All</option>
                                                    <?php foreach($procurements_status as $row): ?>
                                                        <option value="<?= $row->id?>"><?= $row->category?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="submit" class="btn btn-warning btn-lg btn-block fbutton">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" onclick="printDiv()" class="btn btn-warning btn-lg btn-block fbutton">
                                                <i class="fa fa-print"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
								<div class="table-responsive">
                                    <table id="multi-filter-selec3t" class="display table table-striped table-hover" >
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
    $("#id_procurements_status").val(<?php echo isset($id_procurements_status) ? $id_procurements_status : '' ?>);
	$(".report-header").hide();
	$(".report-footer").hide();

    function printDiv() 
	{
		$(".action").hide();
		$(".fbutton").hide();
		$(".report-header").show();
		$(".report-footer").show();
		
		var printContents = document.getElementById("printTable").innerHTML;
		var originalContents = document.body.innerHTML;

		document.body.innerHTML = printContents;

		window.print();

		document.body.innerHTML = originalContents;
		
		location.reload();
	}
</script>
