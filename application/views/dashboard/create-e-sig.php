<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Draw & Download Signature</title>
    <script src = "<?= base_url()?>public/assets/js/plugin/jSignature/jquery.js"></script>
    <script src = "<?= base_url()?>public/assets/js/plugin/jSignature/jSignature.min.js"></script>
    <script src = "<?= base_url()?>public/assets/js/plugin/jSignature/modernizr.js"></script>
    
  </head>
  <style>
	body {
		background-color:#9D0823;
		margin: 20px 45px 0 45px;
	}
	.button, a {
		background-color: #FFAD46; /* Green */
		border: none;
		color: white;
		padding: 15px 32px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		width: 100%
	}
	.jSignature {
		background-color: rgb(255 255 255);
	}
  </style>
  <body>

  	<div class="div" align="center">
	  <img src="<?= base_url()?>public/assets/img/logoo.png" style="width:100px;" class="w-full my-3 center" alt="">
	  <h2 style="color:#fff" class="title">E Signature Generator</h2>
	  <h4 style="color:#fff" class="message">Please draw  your signature in white box. Once done click preview</h4>
	</div>
    <div id = "signature" style = "background-color:#fff;">

    </div>

    <button type = "button" id = "preview" class="button">Preview</button>

    <img src = "" id = "signaturePreview" style="background-color: #fff;">

    <a href = "" id = "download"  class="button" style="background-color:#1c9e14; width:95.8%;" download>Download</a>

    <script type="text/javascript">
      var signature = $("#signature").jSignature({'UndoButton':true});


	$("#download").hide();
	$('#preview').click(function(){
		var data = signature.jSignature('getData', 'image');
		$('#signaturePreview').attr('src', "data:" + data);
		$("#signature").hide();
		$("#preview").hide();
		$("#download").show();

		$("body"). css("background-color","#fff");
		$(".title"). css("color","#000");
		$(".message"). css("color","#9D0823");
		$(".message"). text("Please download your signature then upload it in the form provided");
		$("#signaturePreview"). css("background-color","#fff");
		$("#signaturePreview"). css("border","1px solid #000");
		$("#download"). css("background-color","#9D0823");
	});

	$('#download').click(function(){
		var image = $('#signaturePreview')[0];
		this.href = image.src;

		window.top.close();
	});

    </script>
  </body>
</html>
