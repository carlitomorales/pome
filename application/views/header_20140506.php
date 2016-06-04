<?php
	if($this->session->userdata('username')){
		$islogin = true;
	}else{
		$islogin = false;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!--
		Charisma v1.0.0

		Copyright 2012 Muhammad Usman
		Licensed under the Apache License v2.0
		http://www.apache.org/licenses/LICENSE-2.0

		http://usman.it
		http://twitter.com/halalit_usman
	-->
	<meta content="utf-8" http-equiv="encoding">
	<title>Sistem Pelaporan Online Manajemen Energi - Dirjen EBTKE - Kementerian ESDM</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
	<meta name="author" content="Muhammad Usman">

	<!-- The styles -->
	<link id="bs-css" href="<? echo base_url() ?>css/bootstrap-classic.css" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
	<link href="<? echo base_url() ?>css/bootstrap-responsive.css" rel="stylesheet">
	<link href="<? echo base_url() ?>css/charisma-app.css" rel="stylesheet">
	<link href="<? echo base_url() ?>css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<link href='<? echo base_url() ?>css/fullcalendar.css' rel='stylesheet'>
	<link href='<? echo base_url() ?>css/fullcalendar.print.css' rel='stylesheet'  media='print'>
	<link href='<? echo base_url() ?>css/chosen.css' rel='stylesheet'>
	<link href='<? echo base_url() ?>css/uniform.default.css' rel='stylesheet'>
	<link href='<? echo base_url() ?>css/colorbox.css' rel='stylesheet'>
	<link href='<? echo base_url() ?>css/jquery.cleditor.css' rel='stylesheet'>
	<link href='<? echo base_url() ?>css/jquery.noty.css' rel='stylesheet'>
	<link href='<? echo base_url() ?>css/noty_theme_default.css' rel='stylesheet'>
	<link href='<? echo base_url() ?>css/elfinder.min.css' rel='stylesheet'>
	<link href='<? echo base_url() ?>css/elfinder.theme.css' rel='stylesheet'>
	<link href='<? echo base_url() ?>css/jquery.iphone.toggle.css' rel='stylesheet'>
	<link href='<? echo base_url() ?>css/opa-icons.css' rel='stylesheet'>
	<link href='<? echo base_url() ?>css/uploadify.css' rel='stylesheet'>

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="<? echo base_url() ?>img/faviconebtke.ico">
		
</head>

<body>
	<?php if(!isset($no_visible_elements) || !$no_visible_elements)	{ ?>
	<!-- topbar starts -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="<?php echo base_url();?>dashboard"> <img src="<? echo base_url() ?>img/logo.png" /> <span></span></a>
<?php
	if($islogin){
?>
				<!-- user dropdown starts -->
				<div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone"> <?php echo $this->session->userdata('real_name'); ?></span>
						<span class="caret"></span>
					</a>

					<ul class="dropdown-menu">

						<li><a href="<?php echo base_url();?>setting">Ganti Password</a></li>
						<li><a href="<?php echo base_url();?>logout">Logout</a></li>
					</ul>
				</div>
				<!-- user dropdown ends -->

				<!-- master data dropdown starts -->
				<div class="btn-group pull-right" id="divMasterData" style="display:inline" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<span class="hidden-phone"> Master Data</span>
						<span class="caret"></span>
					</a>

					<ul class="dropdown-menu">
						<li><a href="<?php echo base_url();?>privilege">Previleges</a></li>
						<li><a href="<?php echo base_url();?>jenisenergi">Jenis Energi</a></li>
						<li><a href="<?php echo base_url();?>jenisperalatan">Jenis Peralatan</a></li>
						<li><a href="<?php echo base_url();?>subsektor">Sub Sektor</a></li>
					</ul>
				</div>
				<!-- Master Data dropdown ends -->
<?php
	}
?>
			</div>
		</div>
	</div>
	<!-- topbar ends -->
	<?php } ?>
	<div class="container-fluid">
		<div class="row-fluid">
		<?php if(!isset($no_visible_elements) || !$no_visible_elements) { ?>
		
			<!-- left menu starts -->
			<div class="span2 main-menu-span">
				<div class="well nav-collapse sidebar-nav">                    
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li class="nav-header hidden-tablet" data-toggle="collapse" data-target="#permen" style="cursor:pointer">Regulasi</li>
                    </ul>
                    <div id="permen" class="collapse">
                        <ul class="nav nav-tabs nav-stacked main-menu">
                        	<li><a class="ajax-link" href="<?php echo base_url();?>doc/uu-30-2007.pdf" target="_blank"><span class="icon icon-pdf"></span><span class="hidden-tablet"> UU No. 30 Tahun 2007</span></a></li>
                            <li><a class="ajax-link" href="<?php echo base_url();?>doc/PP 70 2009.pdf" target="_blank"><span class="icon icon-pdf"></span><span class="hidden-tablet"> PP No. 70 - 2009</span></a></li>
                            <li><a class="ajax-link" href="<?php echo base_url();?>doc/No.14 Tahun 2012.pdf" target="_blank"><span class="icon icon-pdf"></span><span class="hidden-tablet"> Per Men No. 14 - 2012</span></a></li>
                            <li><a class="ajax-link" href="<?php echo base_url();?>doc/SKKNI Manajer Energi Industri.pdf" target="_blank"><span class="icon icon-pdf"></span><span class="hidden-tablet"> SKKNI Manajer Energi Industri</span></a></li>
                            <li><a class="ajax-link" href="<?php echo base_url();?>doc/SKKNI Manajer Energi Bangunan Gedung.pdf" target="_blank"><span class="icon icon-pdf"></span><span class="hidden-tablet"> SKKNI Manajer Energi Bangunan Gedung</span></a></li>
                            <li><a class="ajax-link" href="<?php echo base_url();?>doc/SKKNI Auditor Energi.pdf" target="_blank"><span class="icon icon-pdf"></span><span class="hidden-tablet"> SKKNI Auditor Energi</span></a></li>
                        </ul>                    
                    </div>
<?php
	if($islogin){
?>                    
			<ul class="nav nav-tabs nav-stacked main-menu">    
                        <li id="liinputlaporan1" class="nav-header hidden-tablet" data-toggle="collapse" data-target="#inputlaporan" style="cursor:pointer">Input Laporan</li>
                    </ul>		
                    <div id="inputlaporan" class="collapse">
                    	<ul class="nav nav-tabs nav-stacked main-menu">
                            <li><a class="ajax-link" href="<?php echo base_url();?>Perusahaan/add"><span class="icon icon-compose"></span><span class="hidden-tablet"> Informasi Umum</span></a></li>
                            <li class="divider"></li>
                            <li id="liInputLaporan" style="display:list-item"><a class="ajax-link" href="<?php echo base_url();?>orgenergi"><span class="icon icon-compose"></span><span class="hidden-tablet"> Input Laporan</span></a></li>
                        </ul>
                    </div>
                    <ul class="nav nav-tabs nav-stacked main-menu">
                        <li  class="nav-header hidden-tablet" data-toggle="collapse" data-target="#lihatlaporan" style="cursor:pointer">Lihat Laporan</li>
                    </ul>
                    <div id="lihatlaporan" class="collapse">
                    	<ul class="nav nav-tabs nav-stacked main-menu">
                            <li><a class="ajax-link" href="#"><span class="icon icon-document"></span><span class="hidden-tablet"> Organisasi Manajemen Energi</span></a></li>
                            <li><a class="ajax-link" href="#"><span class="icon icon-document"></span><span class="hidden-tablet"> Jumlah Produksi</span></a></li>
                            <li><a class="ajax-link" href="#"><span class="icon icon-document"></span><span class="hidden-tablet"> Jumlah Pemakaian Energi</span></a></li>
                            <li><a class="ajax-link" href="#"><span class="icon icon-document"></span><span class="hidden-tablet"> Konsumsi Energi Spesifik</span></a></li>
                            <li><a class="ajax-link" href="#"><span class="icon icon-document"></span><span class="hidden-tablet"> Peralatan Pemanfaat Energi Utama</span></a></li>
                            <li><a class="ajax-link" href="#"><span class="icon icon-document"></span><span class="hidden-tablet"> Kegiatan Konservasi Energi Yang Telah Dilakukan</span></a></li>
                            <li><a class="ajax-link" href="#"><span class="icon icon-document"></span><span class="hidden-tablet"> Rencana Kegiatan Konservasi Energi</span></a></li>
                            <li><a class="ajax-link" href="#"><span class="icon icon-document"></span><span class="hidden-tablet"> Audit Energi Pada Peralatan Pemanfaat Energi Utama</span></a></li>
                        </ul>
					</div>
                    <ul class="nav nav-tabs nav-stacked main-menu">
                        <li id="liLihatStat" style="display:list-item;cursor:pointer" class="nav-header hidden-tablet" data-toggle="collapse" data-target="#lihatstatistik" >Lihat Statistik</li>
                    </ul>                    
                    <div id="lihatstatistik" class="collapse">
                    	<ul class="nav nav-tabs nav-stacked main-menu">
                            <li><a class="ajax-link" href="#"><span class="icon icon-image"></span><span class="hidden-tablet"> Pemakaian Energi Berdasarkan Jenis Peralatan</span></a></li>
                            <li><a class="ajax-link" href="#"><span class="icon icon-image"></span><span class="hidden-tablet"> Pemakaian Energi Berdasarkan Jenis Energi</span></a></li>    
                            
                        </ul>
                    </div>
                    <ul class="nav nav-tabs nav-stacked main-menu">
                        <li id="liRegistrasi" style="display:list-item;cursor:pointer;" class="nav-header hidden-tablet" data-toggle="collapse" data-target="#registrasi">Registrasi</li>
                    </ul>
                    <div id="registrasi" class="collapse">
                    	<ul class="nav nav-tabs nav-stacked main-menu">
                        	<li id="liRegistrasiItem" style="display:list-item"><a class="ajax-link" href="<?php echo base_url();?>user/registration"><span class="icon icon-users"></span><span class="hidden-tablet"> Registrasi</span></a></li>
                        </ul>
                    </div>
<?php
	}
?>
					<!--label id="for-is-ajax" class="hidden-tablet" for="is-ajax"><input id="is-ajax" type="checkbox"> Ajax on menu</label-->
				</div><!--/.well -->
			</div><!--/span-->
			<!-- left menu ends -->

			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			<!-- content starts -->
            	<input id="IdSesUname" type="hidden"  value="<?php echo $this->session->userdata('username'); ?>">
			<?php } ?>
    	<script type="text/javascript">
			var username = document.getElementById('IdSesUname').value;
			if (username != ''){
				if (username=='admin')
				{ 
					document.getElementById('liinputlaporan1').style.display = 'none';					 
					document.getElementById('liRegistrasi').style.display = 'list-item'; 
					document.getElementById('liRegistrasiItem').style.display = 'list-item'; 
					document.getElementById('divMasterData').style.display = 'inline'; 
				} 
				else
				{
					document.getElementById('liinputlaporan1').style.display = 'list-item'; 
					document.getElementById('liRegistrasi').style.display = 'none'; 
					document.getElementById('liRegistrasiItem').style.display = 'none';
					document.getElementById('divMasterData').style.display = 'none'; 
				}
			}
    	</script>