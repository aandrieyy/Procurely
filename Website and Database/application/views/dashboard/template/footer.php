
	
	</body>

	<!--   Core JS Files   -->
	<script src="<?= base_url()?>public/assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="<?= base_url()?>public/assets/js/core/popper.min.js"></script>
	<script src="<?= base_url()?>public/assets/js/core/bootstrap.min.js"></script>

	<!-- jQuery UI -->
	<script src="<?= base_url()?>public/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="<?= base_url()?>public/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

	<!-- jQuery Scrollbar -->
	<script src="<?= base_url()?>public/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

	<!-- SELECT BOX -->
	<script src="<?= base_url()?>public/assets/js/bootstrap-select.min.js"></script>

	<!-- Datatables -->
	<script src="<?= base_url()?>public/assets/js/plugin/datatables/datatables.min.js"></script>

	<!-- Select2 -->
	<script src="<?= base_url()?>public/assets/js/plugin/select2/select2.full.min.js"></script>

	<!-- Sweet Alert -->
	<script src="<?= base_url()?>public/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

	<!-- Atlantis JS -->
	<script src="<?= base_url()?>public/assets/js/atlantis.min.js"></script>

	<script src="<?= base_url()?>public/assets/js/setting-demo.js"></script>

	
	<script> let base_url = "<?= base_url() ?>"; </script>
	
    <script >
		$(document).ready(function() {
			$('#basic-datatables').DataTable({
			});

			$('#multi-filter-select').DataTable( {
				"pageLength": 10,
				"order": [[ 0, "desc" ]],
				initComplete: function () {
					this.api().columns().every( function () {
						var column = this;
						var select = $('<select class="form-control"><option value=""></option></select>')
						.appendTo( $(column.footer()).empty() )
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
								);

							column
							.search( val ? '^'+val+'$' : '', true, false )
							.draw();
						} );

						column.data().unique().sort().each( function ( d, j ) {
							select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
					} );
				}
			});
		});

		$(".notifDropdown").on("click",function(){
			$(".notification").text("0");
			$.ajax({
				type: 'ajax',
				method: 'post',
				url: '<?php echo base_url()?>notif/mark_as_seen',
				data:{},
				async: false,
				dataType: 'text',
				success: function(response){
				},
				error: function(){
					swal('Something went wrong');
				}
			});
		})

		
	</script>

</body>
</html>