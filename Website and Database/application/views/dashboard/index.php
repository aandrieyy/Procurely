<?php $this->load->view('dashboard/template/header.php')?>
<link href='<?= base_url()?>public/assets/css/calendar-plugin/main.css' rel='stylesheet' />
<script src='<?= base_url()?>public/assets/js/plugin/calendar-plugin/main.js'></script>
<style>
    #calendar {
        max-width: 100%;
        margin: 0 auto;
    }
    .fc-event-title, a{
        color: #fff ;
    }
    .fc-button, .fc-button-primary{
        background-color: #ffad46 !important;
        border-color: #ffad46 !important;
    }
	
	/*==============================================================
	Global Styles Start
	==============================================================*/
	.pre-loader{
		background: #ffffff;
		background-position: center center;
		background-size: 13%;
		position: fixed;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;
		z-index: 12345;
		display: flex;
		flex-wrap: wrap;
		align-items: center;
		justify-content: center;
	}
	.pre-loader .loader-logo{
		padding-bottom: 15px;
	}
	.pre-loader .loader-progress{
		height: 8px;
		border-radius: 15px;
		max-width: 200px;
		margin: 0 auto;
		display: block;
		background: #ecf0f4;
		overflow: hidden;
	}
	.pre-loader .bar{
		width: 0%;
		height: 8px;
		display: block;
		background: #1b00ff;
	}
	.pre-loader .percent{
		text-align: center;
		font-size: 24px;
		display: none;
	}
	.pre-loader .loading-text{
		text-align: center;
		font-size: 18px;
		font-weight: 500;
		padding-top: 15px;
	}
</style>

<?php 
// print_r(json_encode($events));die();
?>
<?php $this->load->view('dashboard/template/sidebar.php')?>
	<div class="main-panel">
		<div class="content">
			<div class="panel-header bg-primary-gradient">
				<div class="page-inner py-5">
					<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
						<div>
							<h2 class="text-white pb-2 fw-bold">Welcome to Procurely!</h2>
							<h5 class="text-white op-7 mb-2">Better Procurement System, Better Workspace.</h5>
						</div>
						<div class="ml-md-auto py-2 py-md-0">
							<h2 class="text-white clock"></h2>
						</div>
					</div>
				</div>
			</div>
			<div class="page-inner mt--5">
				<div class="row mt--2">
						<div class="col-xs-12 col-md-12">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">Summary & Statistics</div>

									<div class="d-flex flex-wrap justify-content-around pt-4">
										<?php if($_SESSION['id_user_role'] == 1 || $_SESSION['id_user_role'] == 8 || $_SESSION['id_user_role'] == 9 || $_SESSION['id_user_role'] == 11){ // admin | bo | sector_head || college ?>
											<div class="col-xs-12 col-md-4">
												<div class="card card-stats card-round">
													<div class="card-body">
														<div class="row">
															<div class="col-5">
																<div class="icon-big text-center">
																	<i class="fas fa-calendar-alt text-warning"></i>
																</div>
															</div>
															<div class="col-7 col-stats">
																<div class="numbers">
																	<p class="card-category">TOTAL BUDGET</p>
																	<h4 class="card-title">₱ <?php echo isset($budget_stats->total_budget) ? number_format($budget_stats->total_budget,2) : number_format(0,2) ?></h4>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-xs-12 col-md-4">
												<div class="card card-stats card-round">
													<div class="card-body">
														<div class="row">
															<div class="col-5">
																<div class="icon-big text-center">
																	<i class="fas fa-coins text-warning"></i>
																</div>
															</div>
															<div class="col-7 col-stats">
																<div class="numbers">
																	<p class="card-category">BUDGET ALLOCATED</p>
																	<h4 class="card-title">₱ <?php echo isset($budget_stats->allocated_budget) ? number_format($budget_stats->allocated_budget,2) : number_format(0,2) ?></h4>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-xs-12 col-md-4">
												<div class="card card-stats card-round">
													<div class="card-body ">
														<div class="row">
															<div class="col-5">
																<div class="icon-big text-center">
																	<i class="fas fa-shopping-cart text-warning"></i>
																</div>
															</div>
															<div class="col-7 col-stats">
																<div class="numbers">
																	<p class="card-category">BUDGET LEFT</p>
																	<h4 class="card-title">₱ <?php echo isset($budget_stats->remaining_budget) ? number_format($budget_stats->remaining_budget,2) : number_format(0,2) ?></h4>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										<?php } ?>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="row">
												<div class="col-lg-12">
													<div class="card">
														<div class="card-body p-3 text-center">
															<div class="text-right text-white">
																<i class="fa fa-chevron-up"></i>
															</div>
															<div class="h1 m-0 text-primary">0</div>
															<div class="text-muted mb-3">Documents Made</div>
														</div>
													</div>
												</div>

												<!-- <div class="col-lg-6">
													<div class="card">
														<div class="card-body p-3 text-center">
															<div class="text-right text-white">
																<i class="fa fa-chevron-up"></i>
															</div>
															<div class="h1 m-0 text-success"><?php echo isset($report->count_budget_proposal) ? $report->count_budget_proposal : number_format(0) ?></div>
															<div class="text-muted mb-3 ">Budget Proposal</div>
														</div>
													</div>
												</div> -->

												<div class="col-lg-12">
													<div class="card">
														<div class="card-body p-3 text-center">
															<div class="text-right text-white">
																<i class="fa fa-chevron-up"></i>
															</div>
															<div class="h1 m-0 text-warning"><?php echo isset($report->ppmp) ? $report->ppmp : 0 ?></div>
															<div class="text-muted mb-3">PPMP</div>
														</div>
													</div>
												</div>

												<!-- <div class="col-lg-6">
													<div class="card">
														<div class="card-body p-3 text-center">
															<div class="text-right text-white">
																<i class="fa fa-chevron-up"></i>
															</div>
															<div class="h1 m-0 text-danger"><?php echo isset($report->count_purchase_requests) ? $report->count_purchase_requests : number_format(0) ?></div>
															<div class="text-muted mb-3">Purchase Request</div>
														</div>
													</div>
												</div> -->

											</div>
										</div>
										<div class="col-md-8">
											<div class="chart-container">
												<canvas id="barChart"></canvas>
											</div>
										</div>
									</div>
									<div class="row mt-5">
										<div class="col-md-12">
											<div class="bg-danger btn-block text-white p-1 text-center">Project Procurement Management Plan</div>
										</div>
										<div class="col-md-8">
											<div class="chart-container">
												<canvas id="pieChart" style="width: 50%; height: 50%"></canvas>
											</div>
										</div>
										<div class="col-md-4">
											<div class="row">
												<div class="col-lg-6">
													<div class="card">
														<div class="card-body p-3 text-center">
															<div class="text-right text-white">
																<i class="fa fa-chevron-up"></i>
															</div>
															<div class="h1 m-0 text-primary"><?php echo isset($report->ppmp) ? $report->ppmp : 0 ?></div>
															<div class="text-muted mb-3">Project Procurement Management Plan</div>
														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="card">
														<div class="card-body p-3 text-center">
															<div class="text-right text-white">
																<i class="fa fa-chevron-up"></i>
															</div>
															<div class="h1 m-0 text-warning"><?php echo isset($report->pending_ppmp) ? $report->pending_ppmp : 0 ?></div>
															<div class="text-muted mb-3 ">Pending  <br><span class="text-white">.</span></div>
														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="card">
														<div class="card-body p-3 text-center">
															<div class="text-right text-white">
																<i class="fa fa-chevron-up"></i>
															</div>
															<div class="h1 m-0 text-success"><?php echo isset($report->approved_ppmp) ? $report->approved_ppmp : 0 ?></div>
															<div class="text-muted mb-3">Approved <br><span class="text-white">.</span></div>
														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="card">
														<div class="card-body p-3 text-center">
															<div class="text-right text-white">
																<i class="fa fa-chevron-up"></i>
															</div>
															<div class="h1 m-0 text-danger"><?php echo isset($report->rejected_ppmp) ? $report->rejected_ppmp : 0 ?></div>
															<div class="text-muted mb-3">Rejected <br><span class="text-white">.</span></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>		
					<!-- ANALYTICS -->
				</div>
			</div>
		</div>
	</div>

<!-- <script>
	alert('<?php echo $_SESSION['loading_time']?>');
</script> -->
<?php
if($_SESSION['loading_time'] != "true"){
	?>
	<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="<?= base_url()?>public/assets/img/logoo.png" style="width:100px" alt=""></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Loading...
			</div>
		</div>
	</div>
	<?php
}
$_SESSION['loading_time'] = "true"; 
?>


<?php $this->load->view('dashboard/template/footer.php')?>
<!-- Chart JS -->
<script src="<?= base_url()?>public/assets/js/plugin/chart.js/chart.min.js"></script>


<script>
	var barChart = document.getElementById('barChart').getContext('2d'),
	pieChart = document.getElementById('pieChart').getContext('2d');

	<?php
    $date = '';
    foreach($purchase_bar_graph as $row){
        $date .=  "'".date("F Y",strtotime($row->date))."',";
    }
    $date = substr($date, 0, -1);

    $count = '';
    foreach($purchase_bar_graph as $row){
        $count .=  "'".$row->count."',";
    }
    $counts = substr($count, 0, -1);
    ?>

	var myBarChart = new Chart(barChart, {
		type: 'bar',
		data: {
			labels: [<?= $date?>],
			datasets : [{
				label: "Purchase Made",
				backgroundColor: 'rgb(255, 173, 70)',
				borderColor: 'rgb(255, 173, 70)',
				data: [<?= $counts?>]
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

	<?php
	if(!empty($report)){
		?>
		<?php
		$report_ppmp = 0;
		if(!empty($report->ppmp)){
			$report_ppmp = $report->ppmp;
		}
		$report_pending_ppmp = 0;
		if(!empty($report->pending_ppmp)){
			$report_pending_ppmp = $report->pending_ppmp;
		}
		$report_approved_ppmp = 0;
		if(!empty($report->approved_ppmp)){
			$report_approved_ppmp = $report->approved_ppmp;
		}
		$report_rejected_ppmp = 0;
		if(!empty($report->rejected_ppmp)){
			$report_rejected_ppmp = $report->rejected_ppmp;
		}


		if($report_pending_ppmp == 0 && $report_ppmp == 0){
			$x_pending_ppmp = 0;
		}else{
			$x_pending_ppmp = number_format(($report_pending_ppmp / $report_ppmp) * 100,2);
		}

		if($report_approved_ppmp == 0 && $report_ppmp == 0){
			$x_approved_ppmp = 0;
		}else{
			$x_approved_ppmp = number_format(($report_approved_ppmp / $report_ppmp) * 100,2);
		}

		if($report_rejected_ppmp == 0 && $report_ppmp == 0){
			$x_rejected_ppmp = 0;
		}else{
			$x_rejected_ppmp = number_format(($report_rejected_ppmp / $report_ppmp) * 100,2);
		}
		
		?>
		var myPieChart = new Chart(pieChart, {
			type: 'pie',
			data: {
				datasets: [{
					data: [<?= $x_pending_ppmp ?> ,<?= $x_approved_ppmp ?> ,<?= $x_rejected_ppmp ?>],
					backgroundColor :["#fdaf4b","#31CE36","#f3545d"],
					borderWidth: 0
				}],
				labels: ['Pending PPMP', 'Approved PPMP', 'Rejected PPMP'] 
			},
			options : {
				responsive: true, 
				maintainAspectRatio: false,
				legend: {
					position : 'bottom',
					labels : {
						fontColor: 'rgb(154, 154, 154)',
						fontSize: 11,
						usePointStyle : true,
						padding: 20
					}
				},
				pieceLabel: {
					render: 'percentage',
					fontColor: 'white',
					fontSize: 14,
				},
				tooltips: false,
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		})
	<?php
	}
	?>

	setInterval(function(){
		var d = new Date();          
		var n = d.toLocaleString([], { hour12: true});
		$(".clock").html(n);

	},1000);

	function myFunction() {
		var d = new Date();
		var n = d.toLocaleString([], { hour: '2-digit', minute: '2-digit' });
		alert(n);
	}

	function fullDateTime() {
		var d = new Date();          
		var n = d.toLocaleString([], { hour12: true});
		// document.getElementById("demo2").innerHTML = n;
		alert(n);
	}

	var width = 100,
	perfData = window.performance.timing, // The PerformanceTiming interface represents timing-related performance information for the given page.
	EstimatedTime = -(perfData.loadEventEnd - perfData.navigationStart),
	time = parseInt((EstimatedTime/1000)%60)*100;
	
	// Percentage Increment Animation
	var PercentageID = $("#percent1"),
			start = 0,
			end = 100,
			durataion = time;
			animateValue(PercentageID, start, end, durataion);
			
	function animateValue(id, start, end, duration) {
	
		var range = end - start,
		current = start,
		increment = end > start? 1 : -1,
		stepTime = Math.abs(Math.floor(duration / range)),
		obj = $(id);
		
		var timer = setInterval(function() {
			current += increment;
			$(obj).text(current + "%");
			$("#bar1").css('width', current+"%");
		//obj.innerHTML = current;
			if (current == end) {
				clearInterval(timer);
			}
		}, stepTime);
	}

	// Fading Out Loadbar on Finised
	setTimeout(function(){
	$('.pre-loader').fadeOut(300);
	}, time);
</script>
