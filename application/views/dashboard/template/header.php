<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Procurely </title> 
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="<?= base_url()?>public/assets/img/logoo.png" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="<?= base_url()?>public/assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['<?= base_url()?>public/assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="<?= base_url()?>public/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url()?>public/assets/css/atlantis.min.css">

	<link rel="stylesheet" href="<?= base_url()?>public/assets/css/demo.css">
	<link rel="stylesheet" href="<?= base_url()?>public/assets/css/jrey.css">

	<link rel="stylesheet" href="<?= base_url()?>public/assets/css/select2.css">
	<link rel="stylesheet" href="<?= base_url()?>public/assets/css/preloader.css">


</head>
<style>
.logo-header {
    background: #9d0823 !important;
} 

.navbar-header {
    background: #C31938!important;
}

.sidebar, .sidebar[data-background-color=white] {
    background: #9d0823 !important;
}

.sidebar .user .info a>span, .sidebar[data-background-color=white] .user .info a>span {
    color: #efefef;
}
.sidebar .user .info a>span .user-level, .sidebar[data-background-color=white] .user .info a>span .user-level {
    color: #e5e5e5;
}
.sidebar .nav .nav-section .text-section, .sidebar[data-background-color=white] .nav .nav-section .text-section {
    color: #ffffff;
}
.sidebar .nav>.nav-item a p, .sidebar[data-background-color=white] .nav>.nav-item a p {
    color: #ededed;
}
.sidebar .nav>.nav-item a i, .sidebar[data-background-color=white] .nav>.nav-item a i {
    color: #efefef;
}
.sidebar.sidebar-style-2 .nav.nav-primary>.nav-item.active>a {
    background: #ffad46!important;
}
.navbar .navbar-nav .notification {
    background-color: #686868;
}

.bg-primary-gradient {
    background: #1572e8!important;
    background: -webkit-linear-gradient(legacy-direction(-45deg),#06418e,#1572e8)!important;
    background: linear-gradient( -45deg ,#06a8ce,#2f5597)!important;
}

.btn-secondary {
    background: #0d9fb6!important;
    border-color: #0d9fb6!important;
}

.bg-secondary {
    background: #0d9fb6!important;
}


.btn-secondary:hover {
    background: #24b3ca!important;
    border-color: #24b3ca!important;
}

.c-theme-bg{
	background-color:#0D9FB6 !important;
}

.c-theme-text{
	color:#0D9FB6 !important;
}


.br-0{
	border-radius: 0px !important;
}

.bg-success {
	background-color: #007E35 !important;
}


.btn-light {
    background: #f8f9fa!important;
    border-color: transparent;
}

.form-control:disabled, .form-control[readonly] {
    border-color: #d4d4d4!important;
}

.add-media:hover span i{
	font-size:35px;
	transition: 1s;
}

.jumbotron-thin {
    padding: 1rem 1rem;
}

/* FILTERS */
.filter-less-mb{
	margin-bottom: -10px !important;
}

.filter-action-btn{
	height:80%;
}
/* FILTERS */

.bg-primary-gradient {
    background: #1572e8!important;
    background: -webkit-linear-gradient(legacy-direction(-45deg),#06418e,#1572e8)!important;
    background: linear-gradient( -45deg ,#4c4c4c,#4c4c4c)!important;
}
.sidebar .nav.nav-primary>.nav-item a:focus i, .sidebar .nav.nav-primary>.nav-item a:hover i, .sidebar .nav.nav-primary>.nav-item a[data-toggle=collapse][aria-expanded=true] i, .sidebar[data-background-color=white] .nav.nav-primary>.nav-item a:focus i, .sidebar[data-background-color=white] .nav.nav-primary>.nav-item a:hover i, .sidebar[data-background-color=white] .nav.nav-primary>.nav-item a[data-toggle=collapse][aria-expanded=true] i {
    color: #fff!important;
}
.bg-blue {
    background: #2F5597!important;
}
.bg-black {
    background: #2F5597!important;
}
.sidebar .nav>.nav-item a, .sidebar[data-background-color=white] .nav>.nav-item a {
    color: #e1e1e1;
}
.modal-header {
	background-color: #9D0823 !important;
}
.btn-black {
    background: #2F5597!important;
    border-color: #2F5597!important;
	color: #fff;
}
.bg-primary-gradient {
    background: #1572e8!important;
    background: -webkit-linear-gradient(legacy-direction(-45deg),#06418e,#1572e8)!important;
    background: linear-gradient( -45deg ,#9d0823,#c31938)!important;
}
.bg-light-blue{
    background-color: #06A8CE;
    border-radius: none;
}
.btn-light-blue{
	background: #06A8CE!important;
    border: 1px solid #06A8CE!important;
    color: #fff;
}




</style>