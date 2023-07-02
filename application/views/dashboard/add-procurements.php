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
				<div class="row row-card-no-pd">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<div class="card-head-row">
									<h4 class="card-title"><?= $title?></h4>
                                        <button id="btnssave" class="btn btn-success btn-round ml-auto">
                                            <i class="fa fa-save"></i>
                                            Save
                                        </button>
                                    </h4>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
                                    <table class="table table-striped" style="width:1700px">
                                        <thead style="background-color:#282828;color:#fff;">
                                            <tr>
                                                <th class="text-center" style="width: 18%;"><strong>Project</strong></th>
                                                <th class="text-center" style="width: 15%;"><strong>Material</strong></th>
                                                <th style="width: 15%;"><strong>Supplier</strong></th>
                                                <th class="text-center" style="width: 8%;"><strong>Quantity</strong></th>
                                                <th class="text-center" style="width: 9%;"><strong>Price</strong></th>
                                                <th class="text-center" style="width: 9%;"><strong>Total</strong></th>
                                                <th class="text-center" style="width: 15%;"><strong>Status</strong></th>
                                                <th class="text-center" style="width: 16%;"><strong>Description</strong></th>
                                                <th class="text-center" style="width: 11%;"><strong>Action</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody class="items">	
                                            <tr>
                                                <td class="text-center">
                                                    <div class="form-group" align="center">
                                                        <select name="id_project1" id="id_project1" class="form-control form-control-sm" required>
                                                            <option value="">Select</option>
                                                            <?php foreach($projects as $row): ?>
                                                                <option value="<?= $row->id?>"><?= $row->project?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-group" align="center">
                                                        <select name="id_procurements_materials1" id="id_procurements_materials1" class="form-control form-control-sm" required>
                                                            <option value="">Select</option>
                                                            <?php foreach($procurements_materials as $row): ?>
                                                                <option value="<?= $row->id?>"><?= $row->category?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-group" align="center">
                                                        <select name="id_supplier1" id="id_supplier1" class="form-control form-control-sm" required>
                                                            <option value="">Select</option>
                                                            <?php foreach($suppliers as $row): ?>
                                                                <option value="<?= $row->id?>"><?= $row->name?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-group" align="center">
                                                        <input  type="text" name="quantity1" id="quantity1" class="form-control form-control-sm" oninput="accept_money_only('quantity1');computeTotal(1)" required>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-group" align="center">
                                                        <input  type="text" name="price1" id="price1" class="form-control form-control-sm" oninput="accept_money_only('price1');computeTotal(1)" required>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-group" align="center">
                                                        <input  type="number" name="total1" disabled id="total1" class="form-control form-control-sm" oninput="accept_money_only('total1')" required>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-group" align="center">
                                                        <select name="id_procurements_status1" id="id_procurements_status1" class="form-control form-control-sm" required>
                                                            <option value="">Select</option>
                                                            <?php foreach($procurements_status as $row): ?>
                                                                <option value="<?= $row->id?>"><?= $row->category?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-group" align="center">
                                                        <input type="text" class="form-control form-control-sm" name="description1" id="description1" style="width:100%;">
                                                    </div>
                                                </td>
                                                <td class="text-center"><button type="button" data-count="1" class="btn btn-danger btn-sm delete_item"><i class="fa fa-trash"></i></button></td>
                                            </tr>
                                        </tbody>
                                    </table>
								</div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <td class="text-right"><button type="button" data-count="1" class="mt-2 btn btn-success btn-sm addNewLine"><i class="fa fa-plus"></i> Add New Line</button></td>
                                    </div>
                                    <div class="col-md-6"></div>
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
<?php $this->load->view('dashboard/class/notification.php')?>

<script>
	$('#btnAdd').click(function(){
		$('#addRowModal').modal('show');
		$('#addRowModal').find('.modal-title').text('Procurements Details');
		$('#myForm').attr('action','<?php echo base_url() ?>procurements/save');

		$("#id_project").val('');
		$("#id_procurements_materials").val('');
		$("#id_category_service").val('');
		$("#price").val('');
		$("#id_procurements_status").val('');
		$("#description").val('');
	});

	$("#btnssave").click(function(e){
		e.preventDefault();
        let data = $("#myForm").serializeArray();
		console.log(data);
		for(var i=0;i<data.length;i++){
			if(data[i].name != 'id' && data[i].name != 'description' && data[i].name != 'picture'){
				if(data[i].value == ''){
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
				$("#myForm").submit();
			} else {
				return false;
			}
		})


	})

	function getEdit(id){
		$('#addRowModal').modal('show');
		$('#addRowModal').find('.modal-title').text('Update');
		$('#myForm').attr('action','<?php echo base_url() ?>procurements/update');
		$('#btnssave').text('Update');
		$('#btnssave').attr('data-operation','update');
		
		$.ajax({
			type: 'ajax',
			method: 'post',
			url: '<?php echo base_url()?>procurements/edit',
			data:{
				id:id
				},
			async: false,
			dataType: 'text',
			success: function(response){
				var data = JSON.parse(response);
				$("#id").val(data[0].id);
				$("#id_project").val(data[0].id_project);
				$("#id_supplier").val(data[0].id_supplier);
				$("#id_procurements_materials").val(data[0].id_procurements_materials);
				$("#quantity").val(data[0].quantity);
				$("#price").val(data[0].price);
				$("#id_procurements_status").val(data[0].id_procurements_status);
				$("#description").val(data[0].description);
				
			},
			error: function(){
				swal('Something went wrong');
			}
		});
	}
    
    function computeTotal(row){
        let quantity = $("#quantity"+row).val();
        let price = $("#price"+row).val();
        let total = parseFloat(quantity) * parseFloat(price);
        // alert(quantity+"-"+price+"-"+total);
        if(total == NaN || total == "NaN"){
            total = 0;
        }
        $("#total"+row).val(total);
    }

    $(".addNewLine").click(function(){
        let count = parseInt($(this).attr('data-count')) + 1;
        $(this).attr('data-count',count);

        let projects = '';
        <?php foreach($projects as $row): ?>
            projects += '<option value="<?= $row->id?>"><?= $row->project?></option>';
        <?php endforeach; ?>

        let procurements_materials = '';
        <?php foreach($procurements_materials as $row): ?>
            procurements_materials += '<option value="<?= $row->id?>"><?= $row->category?></option>';
        <?php endforeach; ?>

        let suppliers = '';
        <?php foreach($suppliers as $row): ?>
            suppliers += '<option value="<?= $row->id?>"><?= $row->name?></option>';
        <?php endforeach; ?>

        let procurements_status = '';
        <?php foreach($procurements_status as $row): ?>
            procurements_status += '<option value="<?= $row->id?>"><?= $row->category?></option>';
        <?php endforeach; ?>

        $(".items").append(
            '<tr>'+
                '<td class="text-center">'+
                    '<div class="form-group" align="center">'+
                        '<select name="id_project'+count+'" id="id_project'+count+'" class="form-control form-control-sm" required>'+
                            '<option value="">Select</option>'+projects+'</select>'+
                    '</div>'+
                '</td>'+
                '<td class="text-center">'+
                    '<div class="form-group" align="center">'+
                        '<select name="id_procurements_materials'+count+'" id="id_procurements_materials'+count+'" class="form-control form-control-sm" required>'+
                            '<option value="">Select</option>'+procurements_materials+'</select>'+
                    '</div>'+
                '</td>'+
                '<td class="text-center">'+
                    '<div class="form-group" align="center">'+
                        '<select name="id_supplier'+count+'" id="id_supplier'+count+'" class="form-control form-control-sm" required>'+
                            '<option value="">Select</option>'+suppliers+'</select>'+
                    '</div>'+
                '</td>'+
                '<td class="text-center">'+
                    '<div class="form-group" align="center">'+
                        '<input  type="text" name="quantity'+count+'" id="quantity'+count+'" class="form-control form-control-sm" oninput="accept_money_only(\'quantity'+count+'\');computeTotal('+count+')" required>'+
                    '</div>'+
                '</td>'+
                '<td class="text-center">'+
                    '<div class="form-group" align="center">'+
                        '<input  type="text" name="price'+count+'" id="price'+count+'" class="form-control form-control-sm" oninput="accept_money_only(\'quantity'+count+'\');computeTotal('+count+')" required>'+
                    '</div>'+
                '</td>'+
                '<td class="text-center">'+
                    '<div class="form-group" align="center">'+
                        '<input  type="text" disabled name="total'+count+'" id="total'+count+'" class="form-control form-control-sm" required>'+
                    '</div>'+
                '</td>'+
                '<td class="text-center">'+
                    '<div class="form-group" align="center">'+
                        '<select name="id_procurements_status'+count+'" id="id_procurements_status'+count+'" class="form-control form-control-sm" required>'+
                            '<option value="">Select</option>'+procurements_status+'</select>'+
                    '</div>'+
                '</td>'+
                '<td class="text-center">'+
                    '<div class="form-group" align="center">'+
                        '<input type="text" class="form-control form-control-sm" name="description'+count+'" id="description'+count+'" style="width:100%;">'+
                    '</div>'+
                '</td>'+
                '<td class="text-center"><button type="button" data-count="'+count+'" class="btn btn-danger btn-sm delete_item"><i class="fa fa-trash"></i></button></td>'+
            '</tr>'
        );

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

        let id_inventory = "#id_inventory"+count;
        $(id_inventory).select2({
            theme: "bootstrap"
        });
    })

    $('.items').on("click",".delete_item",function(){
	    $(this).closest("tr").remove();	
    });

	$("#btnssave").click(function(e){
		e.preventDefault();

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
                $('.items tr').each(function(row,tr){
                    let checker = $(tr).find('td:eq(0) .form-group select').val();
                    if(checker == undefined || checker == ''){
                    }else{
                        var sub = {
                            'id_project' : $(tr).find('td:eq(0) .form-group select').val(),
                            'id_procurements_materials' :  $(tr).find('td:eq(1) .form-group select').val(),
                            'id_supplier' : $(tr).find('td:eq(2) .form-group select').val(),
                            'quantity' :  $(tr).find('td:eq(3) .form-group input[type=number]').val(),
                            'price' :  $(tr).find('td:eq(4) .form-group input[type=number]').val(),
                            'id_procurements_status' :  $(tr).find('td:eq(5) .form-group select').val(),
                            'description' :  $(tr).find('td:eq(6) .form-group input[type=text]').val()
                        };
                    } 
                    table_data.push(sub); 
                });
                table_data = table_data.filter(function(e){return e}); 
                var procurements_details = {'data_table' : table_data}
                
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: '<?= base_url() ?>procurements/bulk_add',
                    data: {
                        procurements_details : procurements_details
                    },
                    datatype: 'text',
                    success: function(response){
                        location.reload();
                    },
                    error: function(){
                        swal("Something went wrong!");
                    }
                })

				// $("#myForm").submit();
			} else {
				return false;
			}
		})


	})

</script>
