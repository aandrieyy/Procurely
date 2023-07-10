<script>
	function upload_pic_and_save(usage,id_trigger){
		var media	= '';
		var form_data = new FormData();
		if(usage == 'cars-media'){
			var id_main = $("#id").val();
		}
		if(usage == 'projects-media'){
			var id_main = <?= $this->uri->segment('3') ?>;
		}

		var name = document.getElementById(id_trigger).files[0].name;
		var form_data = new FormData();
		var ext = name.split('.').pop().toLowerCase();

		if(jQuery.inArray(ext, ['gif','png','jpg','jpeg','docx','ppt','csv','xslx','txt']) == -1) 
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
		alert("File File Size is very big");
		}
		else
		{
		form_data.append("file", document.getElementById(id_trigger).files[0]);
		$.ajax({
			url: "<?= base_url() ?>upload_picture_ajax/upload_pic_and_save/" + usage + "/" + id_main,
			method:"POST",
			data: form_data,
			contentType: false,
			cache: false,
			processData: false,
			beforeSend:function(){
			},   
			success:function(response){

			},
			complete:function(data){
			},
		});
		}
	}


	function deleteMedia(id,usage){
        var media	= '';
		var url = '';
		var image_path = '';
		// alert(id + " - "+ usage);

		if(usage == 'cars-media'){
			var id_main = $("#id").val();
		}

		if(usage == 'cars-media'){
			url = '<?= base_url() ?>media/delete/'+id+ '/'+ id_main +'/'+usage;
			image_path = 'public/uploads/cars-image/pms/';
		}else if(usage == 'projects-media'){
			url = '<?= base_url() ?>media/delete/'+ id + '/<?= $this->uri->segment(3)?>/'+usage;
			image_path = 'public/uploads/project-media/';
		}
		
        $.ajax({
			url: url,
			method:"POST",
			data: {
                id:id
            },
			contentType: false,
			cache: false,
			processData: false,
			beforeSend:function(){
				$('body').removeClass('loaded');
				$('body').addClass('load');
			},   
			success:function(response){
				var data = JSON.parse(response);
				for(var i=0;i<data.length;i++){
					media += '<div class="col-md-4 my-2">'+
								'<img src="<?= base_url()?>'+image_path+'/'+data[i]['media']+'" class="img-thumbnail w-100 datapicture" alt="">'+
								'<button type="button" class="btn btn-danger btn-block btn-sm" onclick="deleteMedia('+data[i]['id']+',&apos;'+usage+'&apos;)"><i class="fa fa-trash"></i></button>'+
							'</div>';
				}
				$(".uploaded_media").html(media);
			},
			complete:function(data){
				$('body').removeClass('load');
				$('body').addClass('loaded');
			},
		});
    }

	
</script>