<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Procurely </title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="<?= base_url()?>public/assets/img/logoo.png" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="<?= base_url()?>/public/assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['<?= base_url()?>/public/assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="<?= base_url()?>/public/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url()?>/public/assets/css/atlantis.min.css">
	<link rel="stylesheet" href="<?= base_url()?>/public/assets/css/jrey.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
</head>
<style>
body[data-background-color=bg2] {
    background: #9d0823;
}
.c-theme-bg{
	background-color:#C31938 !important;
}

.c-theme-text{
	color:#0D9FB6 !important;
}

.btn-border.btn-info {
    color: #C31938 !important;
    border: 1px solid #C31938 !important;
}
body{
    background-image: url("<?= base_url()?>public/assets/img/bg.jpg");
    background-position: center; /* Center the image */
    background-repeat: no-repeat; /* Do not repeat the image */
    background-size: cover; /* Resize the background image to cover the entire container */
    box-shadow: inset 0 0 0 2000px rgb(255 255 255 / 74%);
}
</style>
<body>
	<div class="">
	
		<div class="">

             
       
            <div class="col-md-4 ml-auto mr-auto  pt-5">
                <img src="<?= base_url()?>public/assets/img/logoo.png" style="width:30%;" class="w-full my-3 center" alt="">

                <?php
                if($this->session->flashdata('error')){

                    echo '<div class="alert alert-danger" role="alert">';
                    echo $this->session->flashdata('error');
                    echo '</div>';
                }
                ?>

                <div class="card">
                    <div class="card-header text-center c-theme-bg">
                        <div class="card-title text-white text-uppercase" style="font-size:25px;">Procurely</div>
                        <small id="emailHelp2" class="form-text  text-white">Login Account</small>
                    </div>
                    <div class="card-body pb-0">

                        <form method="POST" action="<?= base_url()?>login/login">

                        <div class="form-group">
                            <!-- <label for="email2">Enter your username</label> -->
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" name="username" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>

                        <div class="form-group ">
                            <!-- <label for="email2">Enter your password</label> -->
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
                                </div>
                                <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info btn-round btn-border float-right my-3 c-theme-border"><i class="fa fa-check"></i>  LOGIN</button>
                        <div class="card-action"></div>
                    
                    </div>
                </div>

                <div class="text-dark text-center">
                    <!-- <p>Book an appointment? <a href="<?= base_url()?>appointments">Click here</a></p> -->
                    All rights reserved
                </div>

        
               
            </div>
      
        

		<!-- End Custom template -->
	</div>
	<!--   Core JS Files   -->
	<script src="<?= base_url()?>/public/assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="<?= base_url()?>/public/assets/js/core/popper.min.js"></script>
	<script src="<?= base_url()?>/public/assets/js/core/bootstrap.min.js"></script>


</body>
</html>