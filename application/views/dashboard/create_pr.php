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
												Purchase Request
												</h3>
												<div class="col-auto ml-auto">
													<button id="btnssave" class="btn btn-warning ml-2">
														<i class="fa fa-save"></i> Save
													</button>
												</div>
											</div>
										</div>
										<div class="card-body">
										<form action="" method="POST" id="myForm" enctype="multipart/form-data">

											<div class="row">

												<div class="col-md-12">
													<div class="form-group form-inline ">
														<label for="inlineinput" class="col-md-3 col-form-label">Project: </label>
														<div class="col-md-9 p-0">
															<input type="hidden" name="id" id="id" class="form-control">
															<select name="project_id" id="project_id" class="form-control" style="width:100%">
																<option value="">Select</option>
																<?php foreach($projects as $row): ?>
																	<option value="<?= $row->id ?>"> <?= $row->name ?></option>
																<?php
																endforeach;
																?>
															</select>
														</div>
													</div>
													<div class="form-group form-inline ">
														<label for="inlineinput" class="col-md-3 col-form-label" align="left">PR Number: </label>
														<div class="col-md-9 p-0">
															<input type="text" class="form-control input-full" id="pr_number" name="pr_number" 
															value="<?php echo isset($invoice->date) ? $invoice->date : '' ?>">
														</div>
													</div>
													<div class="form-group form-inline ">
														<label for="inlineinput" class="col-md-3 col-form-label" align="left">Date: </label>
														<div class="col-md-9 p-0">
															<input type="date" class="form-control input-full" id="date" name="date" 
															value="<?php echo isset($invoice->date) ? $invoice->date : '' ?>">
														</div>
													</div>
													<div class="form-group form-inline ">
														<label for="inlineinput" class="col-md-3 col-form-label" align="left">Total: </label>
														<div class="col-md-9 p-0">
															<input type="input" class="form-control input-full" id="total" name="total" oninput="accept_money_only('total')"
															value="<?php echo isset($invoice->date) ? $invoice->date : '' ?>">
														</div>
													</div>
													
													<div class="form-group form-inline">
														<label for="inlineinput" class="col-md-3 col-form-label">Purpose: </label>
														<div class="col-md-9 p-0">
															<textarea name="purpose" id="purpose" cols="30" rows="10"  class="form-control input-full"></textarea>
														</div>
													</div>
												</div>

											</div>

											<hr>

											<!-- BODY -->
											<!-- <div class="row mt-5">       
						
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
																			<th class="text-center" style="width: 10%;"><strong>QTY</strong></th>
																			<th style="width: 45%;"><strong>PROJECT ITEM</strong></th>
																			<th class="text-center" style="width: 15%;"><strong>UNIT PRICE</strong></th>
																			<th class="text-center" style="width: 10%;"><strong>TOTAL</strong></th>
																			<th class="text-center" style="width: 10%;"><strong>ACTION</strong></th>
																		</tr>
																	</thead>
																	<tbody class="items">		
																		<tr>
																			<td class="text-center">
																				<div class="form-group" align="center">
																					<input type="text" class="form-control form-control-sm" id="qty1"  onblur="accept_money_only('qty1');computations(1)" value="0" style="width:100%;">
																				</div>
																			</td>
																			<td>
																				<div class="form-group">
																					<select id="id_inventory1" onchange="getSellingPrice(1)" class="form-control form-control-sm">
																						<option value="">Select</option>
																						<?php foreach($inventories as $row): ?>
																							<?php
																							if($row->qty != 0){
																								?>
																								<option value="<?= $row->id_product ?>"> <?= $row->product_name ?> (<?= $row->brand ?>)</option>
																								<?php
																							}
																							?>
																							
																						<?php
																						endforeach;
																						?>
																					</select>
																				</div>
																			</td>
																			<td class="text-center">
																				<div class="form-group" align="center">
																					<input type="text" class="form-control form-control-sm" id="unit_price1" onblur="accept_money_only('price1');computations(1)" value="0.00" style="width:100%;">
																				</div>
																			</td>
																			<td class="text-center table_total1">0.00</td>
																			<td class="text-center"><button type="button" data-count="1" class="btn btn-danger btn-sm delete_item"><i class="fa fa-trash"></i></button></td>
																		</tr>
																		
																	</tbody>
																</table>
															</div>
																
															<div class="row">
																<div class="col-md-6">
																	<td class="text-right"><button type="button" data-count="1" class="btn btn-danger btn-sm addNewLine"><i class="fa fa-plus"></i> Add New Line</button></td>
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
																				<td>Grand Total</td>
																				<td class="text-right">
																					<div class="form-group">
																						<input type="text" readonly class="form-control form-control-sm text-right"  name="tcp" id="tcp" 
																						value="<?php echo isset($invoice->tcp) ? number_format($invoice->tcp,2) : '0.00' ?>" style="width:100%;">
																					</div>
																				</td>
																			</tr>
																		</tbody>
																	</table>
																</div>
															</div>
														</div>
													</div>	
												</div>
											</div> -->
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
$("#id_employee_representative").val(<?php echo isset($invoice->id_employee_representative) ? $invoice->id_employee_representative : '' ?>);

let customer_type = <?php echo isset($invoice->id_customer_type) ? $invoice->id_customer_type : '3' ?>;
if(customer_type == 5){
	$("#rbusiness").attr('checked',true);
}

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

function get_product_list(){
	var products= '';
	$.ajax({
		type: 'ajax',
		method: 'post',
		url: '<?php echo base_url()?>inventories/getInventoriesList',
		data:{},
		async: false,
		dataType: 'text',
		success: function(response){
			var data = JSON.parse(response);
			for(var x = 0; x < data.length; x++){
				if(data[x]['qty'] != 0){
					products += '<option value="'+data[x]['id']+'">'+data[x]['product_name']+' ('+data[x]['brand']+')</option>';
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
	let products = '';
	let count = parseInt($(this).attr('data-count')) + 1;
	$(this).attr('data-count',count);

	// products = get_product_list();

	$(".items").append(
		'<tr>'+
			'<td class="text-center">'+
				'<div class="form-group" align="center">'+
					'<input type="text" class="form-control form-control-sm" id="qty'+count+'"  onblur="accept_money_only(&apos;qty'+count+'&apos;);computations('+count+')" value="0" style="width:100%;">'+
				'</div>'+
			'</td>'+
			'<td>'+
				'<div class="form-group">'+
					'<select id="id_inventory'+count+'" onchange="getSellingPrice('+count+')" class="form-control form-control-sm">'+
						'<option value="">Select</option></select>'+
					'</select>'+
				'</div>'+
			'</td>'+
			'<td class="text-center">'+
				'<div class="form-group" align="center">'+
					'<input type="text" class="form-control form-control-sm" id="unit_price'+count+'" onblur="accept_money_only(&apos;price'+count+'&apos;);computations('+count+')" value="0.00" style="width:100%;">'+
				'</div>'+
			'</td>'+
			'<td class="text-center table_total'+count+'">0.00</td>'+
			'<td class="text-center"><button type="button" data-count="'+count+'" class="btn btn-danger btn-sm delete_item"><i class="fa fa-trash"></i></button></td>'+
		'</tr>'
	);

	let id_inventory = "#id_inventory"+count;
	$(id_inventory).select2({
		theme: "bootstrap"
	});
})

function getSellingPrice(count){
	let id_inventory = "#id_inventory"+count;
	let unit_price = "#unit_price"+count;
	let unit = ".unit"+count;
	id_inventory = $(id_inventory).val();

	$.ajax({
		type: 'ajax',
		method: 'post',
		url: '<?php echo base_url()?>invoices/getSellingPrice',
		data:{
			id_inventory:id_inventory
		},
		async: false,
		dataType: 'text',
		success: function(response){
			var data = JSON.parse(response);
			// $(unit_price).val(formatCurrency(data[0]['selling_price']));
			$(unit).text(data[0]['unit']);
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
		let price = "#unit_price"+count;
		let table_total = ".table_total"+count;
		let total = 0;

		price = $(price).val().replace(/,/g, '');
		qty = $(qty).val();

		if(price == ''){ price = 0; }
		if(qty == ''){ qty = 0; }

		$(table_total).text(formatCurrency(parseFloat(price) * parseInt(qty)));

		//GET PURCHASE SUMMARY 
		let subtotal = 0;

		$('.items tr').each(function(row,tr){
			total = parseFloat($(tr).find('td:eq(4)').text().replace(/,/g, ''))
			if(total == ''){ total = 0; }

			subtotal += total;
		});

		$("#tcp").val(formatCurrency(subtotal));

}

$("#btnssave").click(function(e){
	e.preventDefault();
	// let operation = '<?//= $operation?>';
	// var action = '1';
	// if(operation != 'save'){
	// 	var action = '2';
	// }

	let project_id = $("#project_id").val();
	let pr_number = $("#pr_number").val();
	let date = $("#date").val();
	let total = $("#total").val();
	let purpose = $("#purpose").val();


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

			// var table_data = [];
			// var unit_price = '';
			// $('.items tr').each(function(row,tr){
			// 	let checker = $(tr).find('td:eq(2) .form-group select').val();
			// 	if(checker == undefined || checker == ''){
			// 	}else{
			// 		unit_price = $(tr).find('td:eq(3) .form-group input[type=text]').val();
			// 		var sub = {
			// 		'qty' : $(tr).find('td:eq(0) .form-group input[type=text]').val(),
			// 		'id_product' : $(tr).find('td:eq(2) .form-group select').val(),
			// 		'unit_price' : unit_price,
			// 		'total' : $(tr).find('td:eq(4)').text()
			// 		};

			// 	} 
			// 	table_data.push(sub); 
			// });
			// table_data = table_data.filter(function(e){return e}); 
			// var invoices_detail = {'data_table' : table_data}

			// if(unit_price <= 0){
			// 	swal('Unit price must have a value!','','warning');
			// 	return false;
			// }

			// if(invoices_detail.data_table.length == 0){
			// 	swal('Please add items','','warning');
			// 	return false;
			// }
			
			$.ajax({
				type: 'ajax',
				method: 'post',
				url: '<?= base_url() ?>purchase_requests/save',
				data: {
					project_id : project_id,
					pr_number : pr_number,
					date : date,
					total : total,
					purpose : purpose
				},
				datatype: 'text',
				success: function(response){
					location.reload();
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

<script>
	$('#project_id').select2({
        theme: "bootstrap"
    });

</script>