<?php $this->load->view('dashboard/template/header.php')?>
<?php $this->load->view('dashboard/template/sidebar.php')?>
<style>
	.table td, .table th {
		padding: 0 8px!important;
	}
	.table td{
		height: 0px !important;
	}
	.table th{
		height: 50px !important;
	}
	.form-inline label {
		justify-content: left!important;
	}
	.page-inner {
		padding-right: 0rem;
		padding-left: 0rem;
	}
	.container {
    	max-width: 100%;
	}
</style>
		<div class="main-panel">
			<div class="container">
				<div class="page-inner mt-4">
					<div class="justify-content-center mt-5">
						<div class="">
							<div class="row">
								<div class="col-md-12">
									<div class="card card-invoice">
										<div class="card-header biz_branding text-white">
											<div class="invoice-header d-flex">
												<h3 class="invoice-title mt-2 text-dark">
												<?= $title?>
												</h3>
												<div class="col-auto ml-auto">
													<?php if($_SESSION['id_user_role'] == 3){ //DEPARTMENT ?>
													<button id="btnssave" class="btn btn-warning ml-2">
														<i class="fa fa-save"></i> <?= ucfirst($action)?>
													</button>
													<?php } ?>
												</div>
											</div>
										</div>
										<div class="card-body">
										<form action="" method="POST" id="myForm" enctype="multipart/form-data">

                                            <div class="row p-3" id="data_for_edit">
												<div class="col-md-4">
													<div class="row">
														<!-- <div class="col-md-6">
															<div class="form-group form-group-default">
																<label><span class="text-danger">*</span> College </label>
																<input  type="hidden" name="id" id="id" class="form-control">
																<select name="college_id" id="college_id" class="form-control" required>
																	<option value="">Select</option>
																	<?php foreach($colleges as $row): ?>
																		<option value="<?= $row->id?>"><?= $row->name?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div> -->
														<div class="col-md-12">
															<div class="form-group form-group-default">
																<label><span class="text-danger">*</span> Department </label>
																<select name="department_id" id="department_id" class="form-control" required>
																	<option value="">Select</option>
																	<?php foreach($assign_departments as $row): ?>
																		<option value="<?= $row->id?>"><?= $row->department?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-8">
													<div class="row">
														<div class="col-md-4">
															<div class="form-group form-group-default">
																<label><span class="text-danger">*</span> PPMP Category </label>
																<select name="ppmp_category" id="ppmp_category" class="form-control" required>
																	<option value="">Select</option>
																	<?php foreach($ppmp_categories as $row): ?>
																		<option value="<?= $row->id?>"><?= $row->category?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group form-group-default">
																<label><span class="text-danger">*</span> Select Year </label>
																<select name="year_id" id="year_id" class="form-control" required>
																	<option value="">Select</option>
																	<?php foreach($years as $row): ?>
																		<option value="<?= $row->id?>"><?= $row->category?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group form-group-default">
																<label><span class="text-danger"></span> Select Project </label>
																<select name="project_id" id="project_id" class="form-control" required>
																	<option value="">Select</option>
																	<?php foreach($projects as $row): ?>
																		<option value="<?= $row->id?>"><?= $row->name?></option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
													</div>
												</div>
												
                                            </div>

											<hr>

											<!-- BODY -->
											<div class="row mt-5">       
						
												<div class="col-md-12 ">
													<div class="invoice-detail">
														<div class="invoice-top">
															<h5 class="title biz_branding btn-block text-white">Purchase Summary</h5>
														</div>
														<div class="invoice-item">
															<div class="table-responsive mt--2">
																<table class="table table-striped">
																	<thead class="biz_branding_secondary">
																		<tr>
																			<th colspan="5"></th>
																			<th colspan="12" class="text-center text-uppercase"> Schedule/Milestones</th>
																		</tr>
																		<tr>
																			<th class="text-center" style="width: 10%;"><strong>Qty</strong></th>
																			<th style="width: 45%;"><strong>Project Item</strong></th>
																			<th class="text-center" style="width: 15%;"><strong>Unit Price</strong></th>
																			<th class="text-center" style="width: 10%;"><strong>Est. Budget</strong></th>
																			<th class="text-center" style="width: 10%;"><strong>Mode of Procurement</strong></th>
																			<th class="text-center" style="width: 10%;"><strong>Jan</strong></th>
																			<th class="text-center" style="width: 10%;"><strong>Feb</strong></th>
																			<th class="text-center" style="width: 10%;"><strong>Mar</strong></th>
																			<th class="text-center" style="width: 10%;"><strong>Apr</strong></th>
																			<th class="text-center" style="width: 10%;"><strong>May</strong></th>
																			<th class="text-center" style="width: 10%;"><strong>Jun</strong></th>
																			<th class="text-center" style="width: 10%;"><strong>Jul</strong></th>
																			<th class="text-center" style="width: 10%;"><strong>Aug</strong></th>
																			<th class="text-center" style="width: 10%;"><strong>Sept</strong></th>
																			<th class="text-center" style="width: 10%;"><strong>Oct</strong></th>
																			<th class="text-center" style="width: 10%;"><strong>Nov</strong></th>
																			<th class="text-center" style="width: 10%;"><strong>Dec</strong></th>
																			<?php if($_SESSION['id_user_role'] == 3 ){ ?>
																				<th class="text-center" style="width: 10%;"><strong>Action</strong></th>
																			<?php } ?>
																		</tr>
																	</thead>
																	<tbody class="items">	
																		
																		<?php if(isset($ppmp)){ ?>
																			<?php 
																				$est_budget = 0;
																				foreach($ppmp_items as $row): 
																					$est_budget += $row->total;
																				?>
																				<tr>
																					<td class="text-center">
																						<div class="form-group" align="center">
																							<input type="text" class="form-control form-control-sm" id="qty<?= $row->id?>"  onblur="accept_money_only('qty<?= $row->id?>');getTotal(<?= $row->id?>)" value="<?= $row->qty?>" style="width:100%;">
																						</div>
																					</td>
																					<td>
																						<div class="form-group">
																							<select id="project_item<?= $row->id?>" onchange="getTotal(<?= $row->id?>)" class="form-control form-control-sm">
																								<option value="">Select</option>
																								<?php foreach($ppmp_items_option as $row1): 
																									$selected = "";
																									if($row->project_item_id == $row1->id){
																										$selected = "selected";
																									}
																									?>
																									<option <?= $selected ?> value="<?= $row1->id ?>"> <?= $row1->code ?> (<?= $row1->description ?>)</option>
																								<?php
																								endforeach;
																								?>
																							</select>
																						</div>
																					</td>
																					<td class="text-center unit_price<?= $row->id?>"><?= $row->unit_price?></td>
																					<td class="text-center table_total<?= $row->id?>"><?= $row->total?></td>
																					<td>
																						<div class="form-group">
																							<?php // die($row->mop); ?>
																							<select id="mode_of_procurement_id<?= $row->id?>" class="form-control form-control-sm">
																								<option value="">Select</option>
																								<?php foreach($mode_of_procurements as $row1): 
																									$selected = "";
																									if($row->mop_id == $row1->id){
																										$selected = "selected";
																									}
																									?>
																									<option <?= $selected ?> value="<?= $row1->id ?>"> <?= $row1->category ?></option>
																								<?php
																								endforeach;
																								?>
																							</select>
																						</div>
																					</td>
																					<td class="text-center jan<?= $row->id?>" data-status="<?= $row->jan?>" onclick="milesonteStatus('jan',<?= $row->id?>)">
																						<?php if($row->jan == 1){ echo '<i class="fas fa-check">'; }else{ echo '<i class="fas fa-ban">'; } ?>
																					</td>
																					<td class="text-center feb<?= $row->id?>" data-status="<?= $row->feb?>" onclick="milesonteStatus('feb',<?= $row->id?>)">
																						<?php if($row->feb == 1){ echo '<i class="fas fa-check">'; }else{ echo '<i class="fas fa-ban">'; } ?>
																					</td>
																					<td class="text-center mar<?= $row->id?>" data-status="<?= $row->mar?>" onclick="milesonteStatus('mar',<?= $row->id?>)">
																						<?php if($row->mar == 1){ echo '<i class="fas fa-check">'; }else{ echo '<i class="fas fa-ban">'; } ?>
																					</td>
																					<td class="text-center apr<?= $row->id?>" data-status="<?= $row->apr?>" onclick="milesonteStatus('apr',<?= $row->id?>)">
																						<?php if($row->apr == 1){ echo '<i class="fas fa-check">'; }else{ echo '<i class="fas fa-ban">'; } ?>
																					</td>
																					<td class="text-center may<?= $row->id?>" data-status="<?= $row->may?>" onclick="milesonteStatus('may',<?= $row->id?>)">
																						<?php if($row->may == 1){ echo '<i class="fas fa-check">'; }else{ echo '<i class="fas fa-ban">'; } ?>
																					</td>
																					<td class="text-center june<?= $row->id?>" data-status="<?= $row->jun?>" onclick="milesonteStatus('june',<?= $row->id?>)">
																						<?php if($row->jun == 1){ echo '<i class="fas fa-check">'; }else{ echo '<i class="fas fa-ban">'; } ?>
																					</td>
																					<td class="text-center july<?= $row->id?>" data-status="<?= $row->jul?>" onclick="milesonteStatus('july',<?= $row->id?>)">
																						<?php if($row->jul == 1){ echo '<i class="fas fa-check">'; }else{ echo '<i class="fas fa-ban">'; } ?>
																					</td>
																					<td class="text-center aug<?= $row->id?>" data-status="<?= $row->aug?>" onclick="milesonteStatus('aug',<?= $row->id?>)">
																						<?php if($row->aug == 1){ echo '<i class="fas fa-check">'; }else{ echo '<i class="fas fa-ban">'; } ?>
																					</td>
																					<td class="text-center sept<?= $row->id?>" data-status="<?= $row->sep?>" onclick="milesonteStatus('sept',<?= $row->id?>)">
																						<?php if($row->sep == 1){ echo '<i class="fas fa-check">'; }else{ echo '<i class="fas fa-ban">'; } ?>
																					</td>
																					<td class="text-center oct<?= $row->id?>" data-status="<?= $row->oct?>" onclick="milesonteStatus('oct',<?= $row->id?>)">
																						<?php if($row->oct == 1){ echo '<i class="fas fa-check">'; }else{ echo '<i class="fas fa-ban">'; } ?>
																					</td>
																					<td class="text-center nov<?= $row->id?>" data-status="<?= $row->nov?>" onclick="milesonteStatus('nov',<?= $row->id?>)">
																						<?php if($row->nov == 1){ echo '<i class="fas fa-check">'; }else{ echo '<i class="fas fa-ban">'; } ?>
																					</td>
																					<td class="text-center dec<?= $row->id?>" data-status="<?= $row->december?>" onclick="milesonteStatus('dec',<?= $row->id?>)">
																						<?php if($row->december == 1){ echo '<i class="fas fa-check">'; }else{ echo '<i class="fas fa-ban">'; } ?>
																					</td>
																					<?php if($_SESSION['id_user_role'] == 3 ){ ?>
																					<td class="text-center"><button type="button" data-count="<?= $row->id?>" class="btn btn-danger btn-sm delete_item"><i class="fa fa-trash"></i></button></td>
																					<?php } ?>
																				</tr>
																			<?php endforeach; ?>
																		<?php } ?>
																		
																	</tbody>
																</table>
															</div>
																
															<div class="row">
																<div class="col-md-6">
																	<?php if($_SESSION['id_user_role'] == 3){ //DEPARTMENT ?>
																		<td class="text-right"><button type="button" data-count="1" class="btn btn-danger btn-sm addNewLine"><i class="fa fa-plus"></i> Add Item</button></td>
																	<?php } ?>
																</div>
																<div class="col-md-6"></div>
															</div>
															<div class="row mt-5">
																<div class="col-md-5 text-center">
																	
																</div>

																<div class="col-md-2"></div>

																<div class="col-md-5">
																	<table class="table table-striped">
																		<tbody>
																			<tr>
																				<td>Total</td>
																				<td class="text-right">
																					<div class="form-group">
																						<input type="text" readonly class="form-control form-control-sm text-right"  id="grand_total" 
																						value="<?php echo isset($est_budget) ? number_format($est_budget,2) : '0.00' ?>" style="width:100%;">
																					</div>
																				</td>
																			</tr>
																			<tr>
																				<td>Total With Contingency(+20%)</td>
																				<td class="text-right">
																					<div class="form-group">
																						<input type="text" readonly class="form-control form-control-sm text-right"  id="total_with_contingency" 
																						value="<?php echo isset($est_budget) ? number_format((($est_budget * 0.20) + $est_budget),2) : '0.00' ?>" style="width:100%;">
																					</div>
																				</td>
																			</tr>
																			<!-- <tr>
																				<td>Remaining Total Budget</td>
																				<td class="text-right">
																					<div class="form-group">
																						<input type="text" readonly class="form-control form-control-sm text-right"  id="total_with_contingency" 
																						value="<?php echo isset($est_budget) ? number_format((($est_budget * 0.20) + $est_budget),2) : '0.00' ?>" style="width:100%;">
																					</div>
																				</td>
																			</tr> -->
																		</tbody>
																	</table>
																</div>
															</div>
														</div>
													</div>	
												</div>
											</div>
										</form>
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
<?php $this->load->view('dashboard/class/money_format.php')?>
<?php $this->load->view('dashboard/class/notification.php')?>


<script>
// $("#college_id").val(<?php echo isset($ppmp->college_id) ? $ppmp->college_id : '' ?>);
// $("#college_id").trigger('change');
$("#department_id").val(<?php echo isset($ppmp->department_id) ? $ppmp->department_id : '' ?>);
$("#ppmp_category").val(<?php echo isset($ppmp->ppmp_category) ? $ppmp->ppmp_category : '' ?>);
$("#year_id").val(<?php echo isset($ppmp->year_id) ? $ppmp->year_id : '' ?>);
$("#project_id").val(<?php echo isset($ppmp->project_id) ? $ppmp->project_id : '' ?>);
// $("#mode_of_procurement_id").val(<?php echo isset($ppmp->mode_of_procurement_id) ? $ppmp->mode_of_procurement_id : '' ?>);

let customer_type = <?php echo isset($invoice->id_customer_type) ? $invoice->id_customer_type : '3' ?>;
if(customer_type == 5){
	$("#rbusiness").attr('checked',true);
}

$("#college_id").on("change",function(){

	var college_id = $("#college_id").val();
	$.ajax({
		type: 'ajax',
		method: 'post',
		url: '<?php echo base_url()?>college_departments/edit',
		data:{
            id: college_id
        },
		async: false,
		dataType: 'text',
		success: function(response){
			var data = JSON.parse(response);
			$("#department_id").html('');
			for(var x = 0; x < data.length; x++){
				if(data[x]['qty'] != 0){
					$("#department_id").append('<option value="'+data[x]['department_id']+'">'+data[x]['department']+'</option>');
				}
			}
		},
		error: function(){
			swal('Something went wrong');
		}
	});

})


$("#id_customer").val(<?php echo isset($invoice->id_customer) ? $invoice->id_customer : '' ?>);

$('.items').on("click",".delete_item",function(){
	// let count = $(this).attr('data-count');
	// var table_total = ".table_total"+count;
	// table_total = $(table_total).text();
	// var subtotal = $("#subtotal").val();
	// var sumtotal = formatCurrency(parseInt(subtotal) - parseInt(table_total))
	// $("#subtotal").val(sumtotal);
	// $("#total").val(sumtotal);

	$(this).closest("tr").remove();	
});

$("#project_id").on("change",function(){
    $(".items").html("");
})

function get_project_items(project_id){
	var products= '';
	$.ajax({
		type: 'ajax',
		method: 'post',
		url: '<?php echo base_url()?>items/get_project_items',
		data:{
            project_id: project_id
        },
		async: false,
		dataType: 'text',
		success: function(response){
			var data = JSON.parse(response);
			for(var x = 0; x < data.length; x++){
				if(data[x]['qty'] != 0){
					products += '<option value="'+data[x]['id']+'">'+data[x]['code']+' ('+data[x]['description']+')</option>';
				}
			}
		},
		error: function(){
			swal('Something went wrong');
		}
	});
	return products;
}

function get_mode_of_procurement_id(){
	var products= '';
	$.ajax({
		type: 'ajax',
		method: 'post',
		url: '<?php echo base_url()?>categories/get',
		data:{
            category_type: "mode_of_procurements"
        },
		async: false,
		dataType: 'text',
		success: function(response){
			var data = JSON.parse(response);
			for(var x = 0; x < data.length; x++){
				if(data[x]['qty'] != 0){
					products += '<option value="'+data[x]['id']+'">'+data[x]['category']+'</option>';
				}
			}
		},
		error: function(){
			swal('Something went wrong');
		}
	});
	return products;
}

$(".addNewLine").click(function(){
    let project_id = $("#project_id").val();
    if(project_id == ""){
        swal("Please select project firtst","","warning");
        return false;
    }
	let products = '';
	let count = parseInt($(this).attr('data-count')) + 1;
	$(this).attr('data-count',count);

	project_item = get_project_items(project_id);
	mode_of_procurement_id = get_mode_of_procurement_id();

	$(".items").append(
		'<tr>'+
			'<td class="text-center">'+
				'<div class="form-group" align="center">'+
					'<input type="text" class="form-control form-control-sm" id="qty'+count+'"  onblur="accept_money_only(&apos;qty'+count+'&apos;);getTotal('+count+')" value="1" style="width:100%;">'+
				'</div>'+
			'</td>'+
			'<td>'+
				'<div class="form-group">'+
					'<select id="project_item'+count+'" onchange="getTotal('+count+')" class="form-control form-control-sm">'+
						'<option value="">Select</option>'+project_item+'</select>'+
				'</div>'+
			'</td>'+
			'<td class="text-center unit_price'+count+'">0.00</td>'+
			'<td class="text-center table_total'+count+'">0.00</td>'+
			'<td>'+
				'<div class="form-group">'+
					'<select id="mode_of_procurement_id	'+count+'" class="form-control form-control-sm">'+
						'<option value="">Select</option>'+mode_of_procurement_id+'</select>'+
				'</div>'+
			'</td>'+
			'<td class="text-center jan'+count+'" data-status="0" onclick="milesonteStatus(&quot;jan&quot;,'+count+')"><i class="fas fa-ban"></i></td>'+
			'<td class="text-center feb'+count+'" data-status="0" onclick="milesonteStatus(&quot;feb&quot;,'+count+')"><i class="fas fa-ban"></i></td>'+
			'<td class="text-center mar'+count+'" data-status="0" onclick="milesonteStatus(&quot;mar&quot;,'+count+')"><i class="fas fa-ban"></i></td>'+
			'<td class="text-center apr'+count+'" data-status="0" onclick="milesonteStatus(&quot;apr&quot;,'+count+')"><i class="fas fa-ban"></i></td>'+
			'<td class="text-center may'+count+'" data-status="0" onclick="milesonteStatus(&quot;may&quot;,'+count+')"><i class="fas fa-ban"></i></td>'+
			'<td class="text-center june'+count+'" data-status="0" onclick="milesonteStatus(&quot;june&quot;,'+count+')"><i class="fas fa-ban"></i></td>'+
			'<td class="text-center july'+count+'" data-status="0" onclick="milesonteStatus(&quot;july&quot;,'+count+')"><i class="fas fa-ban"></i></td>'+
			'<td class="text-center aug'+count+'" data-status="0" onclick="milesonteStatus(&quot;aug&quot;,'+count+')"><i class="fas fa-ban"></i></td>'+
			'<td class="text-center sept'+count+'" data-status="0" onclick="milesonteStatus(&quot;sept&quot;,'+count+')"><i class="fas fa-ban"></i></td>'+
			'<td class="text-center oct'+count+'" data-status="0" onclick="milesonteStatus(&quot;oct&quot;,'+count+')"><i class="fas fa-ban"></i></td>'+
			'<td class="text-center nov'+count+'" data-status="0" onclick="milesonteStatus(&quot;nov&quot;,'+count+')"><i class="fas fa-ban"></i></td>'+
			'<td class="text-center dec'+count+'" data-status="0" onclick="milesonteStatus(&quot;dec&quot;,'+count+')"><i class="fas fa-ban"></i></td>'+
			'<td class="text-center"><button type="button" data-count="'+count+'" class="btn btn-danger btn-sm delete_item"><i class="fa fa-trash"></i></button></td>'+
		'</tr>'
	);

	let id_inventory = "#id_inventory"+count;
	$(id_inventory).select2({
		theme: "bootstrap"
	});
})

function getTotal(count){
	let project_item_id = "#project_item"+count;
	let unit_price = ".unit_price"+count;
	let table_total = ".table_total"+count;
	let qty = "#qty"+count;
	project_item_id = $(project_item_id).val();
	qty = $(qty).val();

	$.ajax({
		type: 'ajax',
		method: 'post',
		url: '<?php echo base_url()?>items/edit',
		data:{
			id:project_item_id
		},
		async: false,
		dataType: 'text',
		success: function(response){
			var data = JSON.parse(response);
			$(unit_price).text(formatCurrency(data[0].unit_price));
			$(table_total).text(formatCurrency(parseFloat(qty) * parseFloat(data[0].unit_price)));
			// $(unit).text(data[0]['unit']);
		},
		error: function(){
			swal('Something went wrong');
		}
	});

	computations(count);
}

$("#id_customer").change(function(){
	let id_customer_type = $("input[name=id_customer_type]:checked").val();

	let url = '<?php echo base_url()?>invoices/getCustomers';
	let customers = '';

	if(id_customer_type == 5){ // BUSINESS / COMPANY
		url = '<?php echo base_url()?>invoices/getBusiness';
	}

	var id_customer = $(this).val();
	$.ajax({
		type: 'ajax',
		method: 'post',
		url: url,
		data:{id_customer:id_customer},
		async: false,
		dataType: 'text',
		success: function(response){
			var data = JSON.parse(response);

			if(id_customer_type == 5){ // BUSINESS / COMPANY
				$(".customer_address").text('ADDRESS: '+data[0]['bs_address']);
				$(".customer_tin").text('TIN: '+data[0]['bs_tin']);
			}else{
				$(".customer_address").text('ADDRESS: '+data[0]['address']);
				$(".customer_tin").text('TIN: N/A');
			}
		
		},
		error: function(){
			swal('Something went wrong');
		}
	});
})

function computations(count){

		//GET LINE TOTAL
		let qty = "#qty"+count;
		let price = ".unit_price"+count;
		let table_total = ".table_total"+count;
		let total = 0;

		price = $(price).val().replace(/,/g, '');
		qty = $(qty).val();

		if(price == ''){ price = 0; }
		if(qty == ''){ qty = 0; }


		//GET PURCHASE SUMMARY 
		let subtotal = 0;

		$('.items tr').each(function(row,tr){
			total = parseFloat($(tr).find('td:eq(3)').text().replace(/,/g, ''))
			if(total == ''){ total = 0; }

			subtotal += total;
		});
		$("#grand_total").val(formatCurrency(subtotal));

		$("#total_with_contingency").val(formatCurrency((subtotal * 0.20) + subtotal));

}

function milesonteStatus(month, count){
	// alert("x");
	var class_ = "."+month+count;
	var status = $(class_).attr("data-status");
	if(status == 0){
		$(class_).html('<i class="fas fa-check"></i>');
		$(class_).attr("data-status",1);
	}else{
		$(class_).html('<i class="fas fa-ban"></i>');
		$(class_).attr("data-status",0);
	}
}

$("#btnssave").click(function(e){
	e.preventDefault();
	// let operation = '<?//= $operation?>';
	// var action = '1';
	// if(operation != 'save'){
	// 	var action = '2';
	// }

	// let college_id = $("#college_id").val();
	let department_id = $("#department_id").val();
	let ppmp_category = $("#ppmp_category").val();
	let year_id = $("#year_id").val();
	let project_id = $("#project_id").val();
	// let mode_of_procurement_id = $("#mode_of_procurement_id").val();
	let grand_total = $("#grand_total").val();


	let form_data = $("#myForm").serializeArray();
	console.log(form_data);
	for(var i=0;i<form_data.length;i++){
		if(form_data[i].name != 'id'){
			if(form_data[i].value == ''){
				swal('Please fill-up all the required(*) fields','','warning');
				return false;
			}
		}
	}

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
			var unit_price = '';
			$('.items tr').each(function(row,tr){
				let checker = $(tr).find('td:eq(1) .form-group select').val();
				if(checker == undefined || checker == ''){
				}else{
					unit_price = $(tr).find('td:eq(2)').text();
					var sub = {
					'qty' : $(tr).find('td:eq(0) .form-group input[type=text]').val(),
					'project_item_id' : $(tr).find('td:eq(1) .form-group select').val(),
					'unit_price' : unit_price,
					'total' : $(tr).find('td:eq(3)').text(),
					'mop' : $(tr).find('td:eq(4) .form-group select').val(),
					'jan' : $(tr).find('td:eq(5)').attr('data-status'),
					'feb' : $(tr).find('td:eq(6)').attr('data-status'),
					'mar' : $(tr).find('td:eq(7)').attr('data-status'),
					'apr' : $(tr).find('td:eq(8)').attr('data-status'),
					'may' : $(tr).find('td:eq(9)').attr('data-status'),
					'jun' : $(tr).find('td:eq(10)').attr('data-status'),
					'jul' : $(tr).find('td:eq(11)').attr('data-status'),
					'aug' : $(tr).find('td:eq(12)').attr('data-status'),
					'sep' : $(tr).find('td:eq(13)').attr('data-status'),
					'oct' : $(tr).find('td:eq(14)').attr('data-status'),
					'nov' : $(tr).find('td:eq(15)').attr('data-status'),
					'december' : $(tr).find('td:eq(16)').attr('data-status'),
					};

				} 
				table_data.push(sub); 
			});
			table_data = table_data.filter(function(e){return e}); 
			var ppmp_item = {'data_table' : table_data}
			console.log(ppmp_item);
			if(unit_price <= 0){
				swal('Unit price must have a value!','','warning');
				return false;
			}

			if(ppmp_item.data_table.length == 0){
				swal('Please add some items','','warning');
				return false;
			}
			
			$.ajax({
				type: 'ajax',
				method: 'post',
				url: '<?= base_url() ?>ppmp/<?= $action ?>',
				data: {
					ppmp_id : "<?php echo isset($ppmp_id) ? $ppmp_id : ''?>",
					// college_id :college_id,
					department_id : department_id,
					ppmp_category : ppmp_category,
					year_id : year_id,
					project_id : project_id,
					// mode_of_procurement_id : mode_of_procurement_id,
					ppmp_item : ppmp_item
				},
				datatype: 'text',
				success: function(response){
					// location.reload();
					swal('PPMP was <?= $action?>d successfully!','','warning');
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