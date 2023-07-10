

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
				<div class="row row-card-no-pd div_table_data">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<div class="card-head-row">
									<h4 class="card-title">Projects List</h4>

								</div>
							</div>
							<div class="card-body">

								<div class="table-responsive">
									<table id="multi-filter-select" class="display table table-striped table-hover" >
										<thead>
											<tr>
												<th>Project</th>
												<th>Type</th>
												<th>Subtype</th>
												<th>Price</th>
												<th>Status</th>
												<th>Option</th>
											</tr>
										</thead>
										<tbody class="table_data">
											<?php foreach($projects as $row): ?>
												<tr>
													<td><?= $row->project?></td>
													<td><span class="badge badge-success"><?= ucfirst($row->project_type) ?></span></td>
													<td><span class="badge badge-info"><?= ucfirst($row->subtype) ?></span></td>
													<td>₱ <?= number_format($row->tcp,2) ?></td>
													<td><span class="badge badge-warning"><?= ucfirst($row->status) ?></span></td>
													<td>
														<div class="btn-group">
														<a title="Procurement" href="<?= base_url() ?>projects/project_form/<?= $row->id ?>/update" title="Edit" class="form-control btn-primary btn-sm br-0" ><i class="fas fa-shopping-cart"></i></a>
														<a href="<?= base_url() ?>projects/project_form/<?= $row->id ?>/update" title="Edit" class="form-control btn-primary btn-sm br-0" ><i class="fas fa-car-side"></i></a>
														<a href="<?= base_url() ?>projects/project_form/<?= $row->id ?>/update" title="Edit" class="form-control btn-primary btn-sm br-0" ><i class="fas fa-clipboard-check"></i></a>
														<a href="<?= base_url() ?>projects/project_form/<?= $row->id ?>/update" title="Edit" class="form-control btn-primary btn-sm br-0" ><i class="fas fa-check-square"></i></a>
														</div>
														<div class="btn-group">
															<?php
															if($_SESSION['projects_management_edit'] == 1){
															?>
																<a href="<?= base_url() ?>projects/project_form/<?= $row->id ?>/update" title="Edit" class="form-control btn-warning btn-sm br-0" ><i class="fa fa-edit"></i></a>
															<?php
															}
															?>
															
															<?php
															if($_SESSION['projects_management_delete'] == 1){
															?>
																<button title="Delete" class="form-control btn-danger btn-sm br-0" onclick="getDelete('<?= $row->id ?>','projects')"><i class="fa fa-trash"></i></button>
															<?php
															}
															?>
															
														</div>
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

				<!-- SUMMARY OF DATA -->
				<div class="row row-card-no-pd div_summary_of_data">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<div class="card-head-row">
									<h4 class="card-title">Summary of Data</h4>
								</div>
							</div>
							<div class="card-body">
								<div class="jumbotron jumbotron-thin">
                                    <strong>NOTE:</strong>
                                    <p class="text-danger">- REPORT FEATURE IS CURRENTLY UNDER DEVELOPMENT</p>
                                </div>
								<div class="row mb-5 ">
									<div class="col-sm-6 col-md-6">
										<div class="card card-stats card-primary card-round">
											<div class="card-body">
												<div class="row">
													<div class="col-5">
														<div class="icon-big text-center">
															<i class="flaticon-users"></i>
														</div>
													</div>
													<div class="col-7 col-stats">
														<div class="numbers">
															<p class="card-category">Projects</p>
															<h4 class="card-title projects_count">1,294</h4>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6 col-md-6">
										<div class="card card-stats card-info card-round">
											<div class="card-body">
												<div class="row">
													<div class="col-5">
														<div class="icon-big text-center">
															<i class="flaticon-interface-6"></i>
														</div>
													</div>
													<div class="col-7 col-stats">
														<div class="numbers">
															<p class="card-category">Total TCP</p>
															<h4 class="card-title total_tcp">1303</h4>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="card">
											<div class="card-header">
												<div class="card-title">Projects Chart</div>
											</div>
											<div class="card-body">
												<div class="chart-container">
													<canvas id="lineChart"></canvas>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="card">
											<div class="card-header">
												<div class="card-title">Sales Chart</div>
											</div>
											<div class="card-body">
												<div class="chart-container">
													<canvas id="barChart"></canvas>
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

<?php $this->load->view('dashboard/template/footer.php')?>
<?php $this->load->view('dashboard/class/input-text-accept-money-only.php')?>
<?php $this->load->view('dashboard/class/input-text-accept-number-only.php')?>
<?php $this->load->view('dashboard/class/notification.php')?>
<?php $this->load->view('dashboard/class/money_format.php')?>

<!-- Chart JS -->
<script src="<?= base_url()?>public/assets/js/plugin/chart.js/chart.min.js"></script>
<script>
	var lineChart = document.getElementById('lineChart').getContext('2d'),
	barChart = document.getElementById('barChart').getContext('2d');
	var myLineChart = new Chart(lineChart, {
		type: 'line',
		data: {
			labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
			datasets: [{
				label: "Active Users",
				borderColor: "#1d7af3",
				pointBorderColor: "#FFF",
				pointBackgroundColor: "#1d7af3",
				pointBorderWidth: 2,
				pointHoverRadius: 4,
				pointHoverBorderWidth: 1,
				pointRadius: 4,
				backgroundColor: 'transparent',
				fill: true,
				borderWidth: 2,
				data: [542, 480, 430, 550, 530, 453, 380, 434, 568, 610, 700, 900]
			}]
		},
		options : {
			responsive: true, 
			maintainAspectRatio: false,
			legend: {
				position: 'bottom',
				labels : {
					padding: 10,
					fontColor: '#1d7af3',
				}
			},
			tooltips: {
				bodySpacing: 4,
				mode:"nearest",
				intersect: 0,
				position:"nearest",
				xPadding:10,
				yPadding:10,
				caretPadding:10
			},
			layout:{
				padding:{left:15,right:15,top:15,bottom:15}
			}
		}
	});


	var myBarChart = new Chart(barChart, {
		type: 'bar',
		data: {
			labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
			datasets : [{
				label: "Sales",
				backgroundColor: 'rgb(23, 125, 255)',
				borderColor: 'rgb(23, 125, 255)',
				data: [3, 2, 9, 5, 4, 6, 4, 6, 7, 8, 7, 4],
			}],
		},
		options: {
			responsive: true, 
			maintainAspectRatio: false,
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true
					}
				}]
			},
		}
	});
</script>

<script>
$(".div_summary_of_data").attr('hidden',true);


function display_data(action,response){
	var data = JSON.parse(response);

	if(action == "view_data" || action == "view_data_report"){
		$(".table_data").html('');
		for(var i = 0; i < data.length; i++){
			$(".table_data").append(
				'<tr>'+
					'<td><span class="badge badge-success">'+ data[i].project_type +'</span></td>'+
					'<td>'+ data[i].project +'</td>'+
					'<td>₱ '+ formatCurrency(data[i].tcp) +'</td>'+
					'<td><span class="badge badge-warning">'+ data[i].status +'</span></td>'+
					'<td>'+
						'<div class="btn-group">'+
							'<a href="<?= base_url() ?>projects/project_form/'+ data[i].id +'/update" title="Edit" class="form-control btn-warning btn-sm br-0" ><i class="fa fa-edit"></i></a>'+
							'<button title="Delete" class="form-control btn-danger btn-sm br-0" onclick="getDelete(&apos;'+ data[i].id +'&apos;,&apos;projects&apos;)"><i class="fa fa-trash"></i></button>'+
						'</div>'+
					'</td>'+
				'</tr>'
			);
		}
	}

	if(action == "view_report"){
		$(".projects_count").text(data[0].projects_count);
		$(".total_tcp").text(formatCurrency(data[0].total_tcp));
	}
}
function action(action){

	let date_from = $("#date_from").val();
	let date_to = $("#date_to").val();
	let id_category_project_type = $("#id_category_project_type").val();
	let id_category_status = $("#id_category_status").val();

	if(action == 'view_data'){
		$(".div_table_data").attr('hidden',false);
		$(".div_summary_of_data").attr('hidden',true);
	}

	if(action == 'view_report'){
		$(".div_table_data").attr('hidden',true);
		$(".div_summary_of_data").attr('hidden',false);
	}

	if(action == 'view_data_report'){
		$(".div_table_data").attr('hidden',true);
		$(".div_summary_of_data").attr('hidden',true);
	}

	$.ajax({
		type: 'ajax',
		method: 'post',
		url: '<?php echo base_url()?>projects/get',
		data:{
			action:action,
			date_from:date_from,
			date_to:date_to,
			id_category_project_type:id_category_project_type,
			id_category_status:id_category_status
		},
		async: false,
		dataType: 'text',
		success: function(response){
			display_data(action,response);
		},
		error: function(){
			swal('Something went wrong');
		}
	});

}


function getDelete(id,process){

	let date_from = $("#date_from").val();
	let date_to = $("#date_to").val();
	let id_category_project_type = $("#id_category_project_type").val();
	let id_category_status = $("#id_category_status").val();

	let url = '<?= base_url()?>/'+process+'/delete';

	swal({
	title: "Do you want to delete this data?",
	text: "",
	icon: "warning",
	buttons: [
		'No, cancel it!',
		'Yes, I am sure!'
	],
	dangerMode: true,
	}).then(function(isConfirm) {
	if (isConfirm) {

		$.ajax({
			type: 'ajax',
			method: 'post',
			url: url,
			data: {
				id: id,
				action:'view_data',
				date_from:date_from,
				date_to:date_to,
				id_category_project_type:id_category_project_type,
				id_category_status:id_category_status
			},
			async: false,
			dataType: 'text',
			success: function(response){
				display_data('view_data',response);
			},
			error: function(){
				swal('Could not edit data');
			}
		});

		swal({
		title: 'Deleted Successfully!',
		text: 'Candidates are successfully shortlisted!',
		icon: 'success'
		}).then(function() {
			//RELOAD THE PAGE TO SHOW CHANGES AFTER DELETE
			// location.reload();
		});
	} else {
		swal("Cancelled", "", "error");
	}
	})
};

</script>
