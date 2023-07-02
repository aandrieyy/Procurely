<?php $this->load->view('dashboard/template/header.php')?>
<style>
	.table td, .table th {
		height: 48px !important;
		font-size: 13px !important;
	}
</style>
<?php $this->load->view('dashboard/template/sidebar.php')?>

	<div class="main-panel">
		<div class="content">
			<div class="page-inner">
				<div class="row row-card-no-pd">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<div class="card-head-row">
									<h4 class="card-title"><?= $table_title?></h4>

									
										<div class="btn-group ml-auto">
											<?php
											if($display_type == 'inventory_list'){
											?>
											<a href="#" id="btnAdd" class="btn btn-sm btn-success ml-auto">
												<i class="fa fa-plus"></i>
												Add Stock
											</a>
											<?php
											}
											?>
											<a href="#" onclick="printDiv()" class="btn btn-sm btn-warning ml-auto">
												<i class="fa fa-print"></i>
												Print
											</a>
										</div>
									
									<?php
									if($_SESSION['inventories_management_add'] == 1){
										?>
										<?php
										if($sidebar_submenu_active != 'low_stock'){
											?>
											<a href="#" hidden id="btnAdd" class="btn btn-success btn-round ml-auto">
												<i class="fa fa-plus"></i>
												Add 
											</a>
											<?php
										}
										?>
										<?php
									}
									?>

								</div>
							</div>
							<div class="card-body">
								<?php
								if($display_type == 'inventory_list'){
									$this->load->view('dashboard/tables/inventories-list-table.php');
								}
								?>

								<?php
								if($display_type == 'low_stock'){
									$this->load->view('dashboard/tables/low-stock-table.php');
								}
								?>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<?php $this->load->view('dashboard/admin/modal/modal-inventories.php')?>
<?php $this->load->view('dashboard/admin/modal/modal-inventory-stock-out.php')?>
<?php $this->load->view('dashboard/admin/modal/modal-inventories-serials.php')?>
<?php $this->load->view('dashboard/template/footer.php')?>
<?php $this->load->view('dashboard/class/input-text-accept-money-only.php')?>
<?php $this->load->view('dashboard/class/money_format.php')?>
<?php $this->load->view('dashboard/class/notification.php')?>

<script>
	$('#btnAdd').click(function(){
		$('#addRowModal').modal('show');
		$('#addRowModal').find('.modal-title').text('Add Inventory');
		$('#myForm').attr('action','<?php echo base_url() ?>inventories/save');
		$("#id").val('');
		$("#id_purchase").val('');
		$("#id_product").val('');
		$("#atcost").val('');
		$("#qty").val('');
		$("#remarks").val('');
	});
	
	function stockOut(id_product){
		$('#addRowModal22').modal('show');
		$('#addRowModal22').find('.modal-title').text('Stock Out');

		$("#id_product2").val(id_product);
		$("#id_product22").val(id_product);
	}

	function getEditSerials(id,product_name){
		$('#addRowModalSerials').modal('show');
		$('#addRowModalSerials').find('.modal-title').text('Serials Management');
		$('#myFormSerials').attr('action','<?php echo base_url() ?>inventories/updateSerials');

		$(".prd_name").text(product_name);

		$.ajax({
			type: 'ajax',
			method: 'post',
			url: '<?php echo base_url()?>inventories/getSerials',
			data:{
				id:id
				},
			async: false,
			dataType: 'text',
			success: function(response){

				var data = JSON.parse(response);
				console.log(data);
				$(".data_for_serial").html('');
				for(var i = 0; i < data.length; i++){
					$(".data_for_serial").append(
						'<tr>'+
							'<td>'+ (i + 1) +'</td>'+
							'<td hidden>'+ data[i].id +'</td>'+
							'<td class="text-right">'+
								'<div class="form-group">'+
									'<input type="text" class="form-control form-control-sm" name="subtotal" id="subtotal" value="'+ data[i].get_serial +'">'+
								'</div>'+
							'</td>'+
						'</tr>'
					);
				}

			},
			error: function(){
				swal('Something went wrong');
			}
		});
	}

	$("#btnUpdateSerial").click(function(){
		
		var table_data = [];
		$('.data_for_serial tr').each(function(row,tr){
	
			var sub = {
			'id_inventory_serials' : $(tr).find('td:eq(1)').text(),
			'serial' : $(tr).find('td:eq(2) .form-group input[type=text]').val(),
			};
			
			table_data.push(sub);
		});
		table_data = table_data.filter(function(e){return e}); 
		var inventories_serial = {'data_table' : table_data}

		$.ajax({
			type: 'ajax',
			method: 'post',
			url: '<?= base_url() ?>inventories/updateSerials',
			data: {
				inventories_serial : inventories_serial
			},
			datatype: 'text',
			success: function(response){
				location.reload();
			},
			error: function(){
				swal("Something went wrong!");
			}
		})
	})

	function printDiv() 
	{
		$(".Option").hide();
		
		var printContents = document.getElementById("printTable").innerHTML;
		var originalContents = document.body.innerHTML;

		document.body.innerHTML = printContents;

		window.print();

		document.body.innerHTML = originalContents;
		
		location.reload();
	}

	$('#id_product1').select2({
        theme: "bootstrap"
    });
	$('#id_supplier').select2({
        theme: "bootstrap"
    });
</script>

<!-- DYNAMIC SEARCH -->
<script>
	$("#clearFilter").click(function(){
		location.reload();
	})
	
	$("#search").on('input',function(){
		let search = $(this).val();
		let filter_by = $("#filter_by").val();
		let url = '';
		<?php
		if($display_type == 'inventory_list'){
		?>
			url = '<?php echo base_url()?>inventories/filter_by';
		<?php
		}else{
		?>
			url = '<?php echo base_url()?>inventories/filter_by_low_stock';
		<?php
		}
		?>

		if(filter_by == ''){
			swal("Please specify your filter","","error");
			return false;
		}
		
		$.ajax({
			type: 'ajax',
			method: 'post',
			url: url,
			data:{
				search:search,
				filter_by:filter_by
				},
			async: false,
			dataType: 'text',
			success: function(response){
				var data = JSON.parse(response);
				var html = '';
				$("#table_data").html('');
				for(var i = 0; i < data.length; i++){

					<?php
					if($display_type == 'inventory_list'){
						?>
						html += '<tr>'+
									'<td><span class="badge badge-success">'+data[i].code+'</span></td>'+
									'<td>'+data[i].product_name+' ('+data[i].brand+')</td>'+
									'<td>'+data[i].quantity+'</td>'+
									'<td>'+data[i].unit+'</td>'+
									'<td>'+data[i].atcost_ave+'</td>'+
									'<td>'+
										<?php
										if($_SESSION['inventories_management_edit'] == 1){
										?>
										'<div class="btn-group">'+
											'<button title="Edit" class="btn btn-danger btn-sm br-0" onclick="stockOut('+data[i].id_product+')" ><i class="fa fa-minus"></i> Stock Out</button>'+
											' <a href="<?= base_url()?>inventories/history/'+data[i].id_product+'" title="Edit" class="btn btn-warning btn-sm br-0" ><i class="fas fa-clock"></i> History</a>'+
										'</div>'+
										<?php
										}
										?>
									'</td>'+
								'</tr>';
						<?php
					}else{
						?>
							html += '<tr>'+
										'<td>'+data[i].product_name+' ('+data[i].brand+')</td>'+
										'<td>'+data[i].critical_qty+'</td>'+
										'<td>'+data[i].current_qty+'</td>'+
									'</tr>';
						<?php
					}
					?>
					$("#table_data").append(html);
				}
			},
			error: function(){
				swal('Something went wrong');
			}
		});
	
		
		

	})

	$(".btnFilterByEst").click(function(){
		let filter_by_est = $("#filter_by_est").val();
		let date_from = $("#date_from").val();
		let date_to = $("#date_to").val();

		if(filter_by_est == ''){
			swal("Please select establishment","","error");
			return false;
		}
		if(date_from == ''){
			swal("Please select date from","","error");
			return false;
		}
		if(date_to == ''){
			swal("Please select date to","","error");
			return false;
		}
		

		$.ajax({
			type: 'ajax',
			method: 'post',
			url: '<?php echo base_url()?>visitors_Log/filter_by_est',
			data:{
				id_establishment:filter_by_est,
				date_from:date_from,
				date_to:date_to,
				},
			async: false,
			dataType: 'text',
			success: function(response){
				var data = JSON.parse(response);
				console.log(data.length);
				$("#table_data").html('');
				for(var i = 0; i < data.length; i++){
					$("#table_data").append(
					'<tr>'+
						'<td class="hidden">'+data[i].id+'</td>'+
						'<td>'+data[i].business_name+'</td>'+
						'<td>'+data[i].name+'</td>'+
						'<td>'+data[i].date+' '+data[i].time+'</td>'+
						'<td>'+data[i].temperature+'°</td>'+
						'<td>'+data[i].purpose+'</td>'+
						'<td>'+
							'<div class="btn-group">'+
								'<button data-toggle="tooltip" data-original-title="View" '+
								'data-toggle="tooltip" class="btn btn-link btn-warning" onclick="getEdit('+data[i].id+')" ><i class="fa fa-eye"></i></button>'+
							'</div>'+
						'</td>'+
					'</tr>'
					);
				}

				$("#table_data").html(html);
				// $("#id_category_employee_department").val(data[0].id_category_employee_department);
				// $("#id_category_employee_role").val(data[0].id_category_employee_role);
				// $("#id_category_employee_position").val(data[0].id_category_employee_position);
			
			},
			error: function(){
				swal('Something went wrong');
			}
		});

	})
</script>
<!-- DYNAMIC SEARCH -->