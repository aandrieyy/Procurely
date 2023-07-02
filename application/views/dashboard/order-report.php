

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
                                <?php $month = isset($_GET['month']) ? $_GET['month'] : date("Y-m"); ?>
                                <form action="<?= base_url()?>projects/report" method="POST" id="myForm">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group form-group-default fc-mb">
                                                <label><span class="text-danger">*</span> Date From:  </label>
                                                <input  type="date" name="date_from" id="date_from" class="form-control" value="<?php echo isset($date_from) ? $date_from : '' ?>"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group form-group-default fc-mb">
                                                <label><span class="text-danger">*</span> Date To:  </label>
                                                <input  type="date" name="date_to" id="date_to" class="form-control" value="<?php echo isset($date_to) ? $date_to : '' ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group form-group-default fc-mb">
                                                <label><span class="text-danger">*</span> Status:  </label>
                                                <select name="id_category_status" id="id_category_status" class="form-control" required>
                                                    <option value="">Select</option>
                                                    <option value="">All</option>
                                                    <?php foreach($project_status as $row): ?>
                                                        <option value="<?= $row->id?>"><?= $row->category?></option>
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
								<div class="table-responsive">
									<table id="" class="display table table-striped table-hover" >
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
    $("#id_category_status").val(<?php echo isset($id_category_status) ? $id_category_status : '' ?>);
    function printDiv() 
	{
		$(".action").hide();
		$(".fbutton").hide();
		
		var printContents = document.getElementById("printTable").innerHTML;
		var originalContents = document.body.innerHTML;

		document.body.innerHTML = printContents;

		window.print();

		document.body.innerHTML = originalContents;
		
		location.reload();
	}
</script>
