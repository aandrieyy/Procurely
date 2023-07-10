<script>
function getApproved(id,url,status){

swal({
  title: "Are you sure?",
  text: "Do you want to "+status+" this car/vehicle?",
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
		data: {id: id},
		async: false,
		dataType: 'text',
		success: function(data){
			
		},
		error: function(){
			swal('Could not edit data');
		}
	});

	swal({
	  title: status+'d Successfully!',
	  text: 'Candidates are successfully shortlisted!',
	  icon: 'success'
	}).then(function() {
		//RELOAD THE PAGE TO SHOW CHANGES AFTER DELETE
		location.reload();
	});
  } else {
	swal("Cancelled", "", "error");
  }
})
};
</script>