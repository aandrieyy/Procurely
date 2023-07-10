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
							<a href="#"><?= $title?>  Management</a>
						</li>
					</ul>
				</div>
				<div class="row row-card-no-pd" id="printTable">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<div class="card-head-row">
									<h4 class="card-title">List of <?= $title?></h4>
								</div>
							</div>
							<div class="card-body">
                                <div class="jumbotron jumbotron-thin fbutton">
                                    <form action="<?= base_url()?>attendance/history" method="POST" id="myForm">
                                        <div class="row filter-less-mb">
                                            <div class="col-md-5">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-default">
                                                            <label><span class="text-danger"><span class="text-danger"></span></span> From</label>
                                                            <input  type="date" name="date_from" id="date_from" class="form-control" value="<?php echo isset($date_from) ? $date_from : date('Y-m-d'); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-default">
                                                            <label><span class="text-danger"><span class="text-danger"></span></span> To</label>
                                                            <input  type="date" name="date_to" id="date_to" class="form-control" value="<?php echo isset($date_to) ? $date_to : date('Y-m-d'); ?>" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                             if($this->session->userdata("id_user_role") == 1){
                                                ?>
                                                <div class="col-md-5">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label><span class="text-danger"><span class="text-danger"></span></span> Level</label>
                                                                <select name="id_level" id="id_level" class="form-control" >
                                                                    <option value="">All</option>
                                                                    <?php foreach($level as $row): ?>
                                                                        <option value="<?= $row->id?>"><?= $row->category?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label><span class="text-danger"><span class="text-danger"></span></span> Section</label>
                                                                <select name="id_section" id="id_section" class="form-control" >
                                                                    <option value="">All</option>
                                                                    <?php foreach($sections as $row): ?>
                                                                        <option value="<?= $row->id?>"><?= $row->category?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                             }
                                            ?>
                                           
                                            <div class="col-md-2">
                                                <div class="btn-group">
                                                    <button type="submit" class="btn btn-primary btn-lg fbutton">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                    <button type="button" onclick="printDiv()" class="btn btn-warning btn-lg fbutton">
                                                        <i class="fa fa-print"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
								</div>
								<div class="table-responsive">
									<table id="mul3ti-filter-select" class="display table table-striped table-hover" >
										<thead>
											<tr>
												<th hidden>id</th>
												<th>Student</th>
												<th>Level</th>
												<th>Section</th>
												<th>Date</th>
												<th>Time IN</th>
												<th>Time OUT</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($datas as $row) :?>
												<tr>
													<td hidden><?= $row->id?></td>
													<td><?= $row->name?></td>
													<td><?= $row->level?></td>
													<td><?= $row->section?></td>
													<td><?= $row->date?></td>
													<td><?= $row->time_in?></td>
													<td><?= $row->time_out?></td>
												</tr>
											<?php endforeach ?>
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

<?php $this->load->view('dashboard/admin/modal/add-user.php')?>
<?php $this->load->view('dashboard/template/footer.php')?>
<?php $this->load->view('dashboard/class/notification.php')?>
<?php $this->load->view('dashboard/class/email_validate.php')?>
<?php $this->load->view('dashboard/class/check-email-existence.php')?>
<?php $this->load->view('dashboard/class/check-phone-existence.php')?>
<?php $this->load->view('dashboard/class/delete.php')?>
<?php $this->load->view('dashboard/class/upload-picture-ajax.php')?>

<script>
$("#id_level").val(<?php echo isset($id_level) ? $id_level : '' ?>);
$("#id_section").val(<?php echo isset($id_section) ? $id_section : '' ?>);

function printDiv() 
	{
		$(".action").hide();
		$(".fbutton").hide();
		
		
		// $('#myForm').hide();
		// $('.card-header').prepend('<img src="<?=base_url()?>public/assets/img/report-header.jpg?>" class="mx-auto d-block" style="width:50%;">');
		// $('.card-body').append('<div class="text-center border-top border-dark w-100"><p class="mx-auto d-block" style="font-size: 1.5rem; margin-bottom: -8px;">For business inquiries:</p><p class="mx-auto d-block" style="font-size: 1.5rem; margin-top: -8px; margin-bottom: -8px;">Set an appointment: coerpa.net/appointments</p><p class="mx-auto d-block" style="font-size: 1.5rem; margin-top: -8px; margin-bottom: -8px;">E-mail: coerpa@yahoo.com</p><p class="mx-auto d-block" style="font-size: 1.5rem; margin-top: -8px; margin-bottom: -8px;">Mobile: 09173305687</p></div>');
		
		
		var printContents = document.getElementById("printTable").innerHTML;
		var originalContents = document.body.innerHTML;

		document.body.innerHTML = printContents;

		window.print();

		document.body.innerHTML = originalContents;
		
		location.reload();
	}

</script>
