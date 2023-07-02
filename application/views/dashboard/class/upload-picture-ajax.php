<script>
	function upload_picture(usage,id_trigger){
		let uploaded_image = '#'+usage+'_uploaded';
		var temp_photo_arr = $('#'+usage).val();

		var name = document.getElementById(id_trigger).files[0].name;
		var form_data = new FormData();
		var ext = name.split('.').pop().toLowerCase();

		if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
		{
		alert("Invalid Image File");
		return false;
		}
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById(id_trigger).files[0]);
		var f = document.getElementById(id_trigger).files[0];
		var fsize = f.size||f.fileSize;
		if(fsize > 2000000)
		{
		alert("Image File Size is very big");
		}
		else
		{
		form_data.append("file", document.getElementById(id_trigger).files[0]);
		$.ajax({
			url: "<?= base_url() ?>upload_picture_ajax/upload_picture/" + usage + "/" + temp_photo_arr,
			method:"POST",
			data: form_data,
			contentType: false,
			cache: false,
			processData: false,
			beforeSend:function(){
				$(uploaded_image).html("<label class='text-success'>Image Uploading...</label>");
			},   
			success:function(response){
				var split_img = response.split(',');
				$(uploaded_image).html(split_img[0]);
				$('#'+usage).val(split_img[1]);
			}
		});
		}
	}
</script>