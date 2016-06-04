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
	<link id="bs-css" href="<? echo base_url() ?>css/bootstrap-cerulean.css" rel="stylesheet">
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
    <link href='<? echo base_url() ?>css/datatables.custom.css' rel='stylesheet'>
    <link href='<? echo base_url() ?>css/dataTables.tableTools.css' rel='stylesheet'>
    <link href='<? echo base_url() ?>css/multiple-select.css' rel='stylesheet'>

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
				<a class="brand" href="<?php echo base_url();?>dashboard"> <img src="<? echo base_url(); ?>img/logo.png" /> <span></span></a>
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
				<!-- inbox starts -->
				<div class="btn-group pull-right" >
					<a class="btn "  href="<?php echo base_url();?>user/inbox">
						<span class="hidden-phone">INBOX (<?php 
							$this->db->where('isread','0');
							$this->db->where('sendto',$this->session->userdata('username'));
							$this->db->from('t_pesan');
							echo $this->db->count_all_results();
							?>)</span>
					</a>
				</div>
				<!-- inbox ends -->

				<!-- master data dropdown starts -->
				<?php if($this->session->userdata('privilege_id') == '2'){?>
				<div class="btn-group pull-right" id="divMasterData" style="display:inline" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<span class="hidden-phone"> Master Data</span>
						<span class="caret"></span>
					</a>

					<ul class="dropdown-menu">
						<li><a href="<?php echo base_url();?>privilege">Previlege</a></li>
						<li><a href="<?php echo base_url();?>jenisenergi">Jenis Energi</a></li>
						<li><a href="<?php echo base_url();?>jenisperalatan">Jenis Peralatan</a></li>
						<li><a href="<?php echo base_url();?>kegiatanpenghematan">Jenis kegiatan</a></li>
						<li><a href="<?php echo base_url();?>satuanproduksi">Satuan Produksi</a></li>
						<li><a href="<?php echo base_url();?>subsektor">Sub Sektor</a></li>
						<li><a href="<?php echo base_url();?>inputberita">Input Berita</a></li>
                        <li><a href="<?php echo base_url();?>inputregulasi">Input Informasi Lainnya</a></li>
                        <li><a href="<?php echo base_url();?>inputinfolain">Input Regulasi</a></li>
                        <li><a href="<?php echo base_url();?>inputfaq">Input FAQ</a></li>
                        <li><a href="<?php echo base_url();?>inputbukutahunan">Input Buku Tahunan</a></li>
					</ul>
				</div>
				<?php }?>
				<!-- Master Data dropdown ends -->
<?php
	}
?>
			</div>
                    
            <div class="container-fluid">
            	<nav>
                    <ul>
						<li><a href="<?php echo base_url();?>dashboard"><span class="icon icon-white icon-home"></span><span class="hidden-tablet"> Home</span></a></li>
						<li>
							<a href="#"><span class="icon icon-white icon-pdf"></span><span class="hidden-tablet"> Regulasi</span></a>
							<ul class="nav-dropdown">
							<?php 
			                        		$sql = "SELECT * FROM tm_infolain ORDER BY id_regulasi ASC ";
								$query = $this->db->query($sql);
								
								$regulasi=$query->result_array();
			                        		foreach($regulasi as $row){ ?>
			                        	<li><a class="ajax-link" href="<?php echo base_url();?>uploads/doc/<?php echo $row['file_regulasi'];?>" target="_blank"><span class="icon icon-pdf"></span><span class="hidden-tablet"> <?php echo $row['nama_regulasi'];?></span></a></li>
			                        	<?php } ?>
							</ul>
						</li>
						<li>
							<a href="#"><span class="icon icon-white icon-pdf"></span><span class="hidden-tablet"> Informasi Lainnya</span></a>
							<ul class="nav-dropdown">
							<?php 
			                        		$sql = "SELECT * FROM tm_regulasi ORDER BY nama_regulasi ASC ";
								$query = $this->db->query($sql);
								
								$regulasi=$query->result_array();
			                        		foreach($regulasi as $row){ ?>
			                        	<li><a class="ajax-link" href="<?php echo base_url();?>uploads/doc/<?php echo $row['file_regulasi'];?>" target="_blank"><span class="icon icon-pdf"></span><span class="hidden-tablet"> <?php echo $row['nama_regulasi'];?></span></a></li>
			                        	<?php } ?>
							</ul>
						</li>
<?php
	if($islogin){
?>


<?php 
	$sqllastlogin = "UPDATE tm_user SET last_login = now( ) WHERE user_name = '".$this->session->userdata('username')."'";
								$query = $this->db->query($sqllastlogin );

?>
		<?php if($this->session->userdata('privilege_id') == '2'){?>
						<li>
							<a href="#"><span class="icon icon-white icon-document"></span><span class="hidden-tablet"> Rekapitulasi</span></a>
							<ul class="nav-dropdown">
								   <li><a class="ajax-link" href="<?php echo base_url();?>reportsudahlapor"><span class="icon icon-document"></span><span class="hidden-tablet"> Perusahaan Sudah Mengisi Laporan</span></a></li>
					                            <li><a class="ajax-link" href="<?php echo base_url();?>reportbijakenergi"><span class="icon icon-document"></span><span class="hidden-tablet"> Perusahaan Sudah Memiliki Kebijakan Energi</span></a></li>
					                            <li><a class="ajax-link" href="<?php echo base_url();?>reportmgrenergi"><span class="icon icon-document"></span><span class="hidden-tablet"> Perusahaan Memiliki Manager Energi</span></a></li>
					                            <!--li><a class="ajax-link" href="<?php echo base_url();?>reportjumlahproduksiadmin"><span class="icon icon-document"></span><span class="hidden-tablet"> Jumlah Produksi</span></a></li-->
					                            <li><a class="ajax-link" href="<?php echo base_url();?>reportpemakaianenergiadmin"><span class="icon icon-document"></span><span class="hidden-tablet"> Jumlah Pemakaian Energi</span></a></li>
					                            <li><a class="ajax-link" href="<?php echo base_url();?>reportkonsumsienergispesifik"><span class="icon icon-document"></span><span class="hidden-tablet"> Konsumsi Energi Spesifik</span></a></li>
					                            <li><a class="ajax-link" href="<?php echo base_url();?>reportperalatanpemanfaatanenergiutamaadmin"><span class="icon icon-document"></span><span class="hidden-tablet"> Peralatan Pemanfaat Energi Utama</span></a></li>
                                                <li><a class="ajax-link" href="<?php echo base_url();?>reportpenghematanemisiadmin"><span class="icon icon-document"></span><span class="hidden-tablet"> Penghematan Energi dan Penurunan Emisi</span></a></li>
					                            <!--<li><a class="ajax-link" href="<?php echo base_url();?>reportperalatanpemanfaatanenergiutamaadmin"><span class="icon icon-document"></span><span class="hidden-tablet"> Peralatan Pemanfaat Energi Utama</span></a></li>-->
					                            <li><a class="ajax-link" href="<?php echo base_url();?>reportkonversienergidilakukanadmin"><span class="icon icon-document"></span><span class="hidden-tablet"> Kegiatan Konservasi Energi Yang Telah Dilakukan</span></a></li>
					                            <li><a class="ajax-link" href="<?php echo base_url();?>reportrencanakegiatankonservasienergiadmin"><span class="icon icon-document"></span><span class="hidden-tablet"> Rencana Kegiatan Konservasi Energi</span></a></li>
					                            <li><a class="ajax-link" href="<?php echo base_url();?>reportauditenergiadmin"><span class="icon icon-document"></span><span class="hidden-tablet"> Audit Energi Pada Peralatan Pemanfaat Energi Utama</span></a></li>
							</ul>
						</li>
		<?php } ?>
        <?php if($this->session->userdata('privilege_id') == '2'){?>
						<li>
							<a href="#"><span class="icon icon-white icon-image"></span><span class="hidden-tablet"> Statistik</span></a>
							<ul class="nav-dropdown">
                            		<li><a class="ajax-link" href="<?php echo base_url();?>chartstatuspersubsektor"><span class="icon icon-image"></span><span class="hidden-tablet"> Status Pelaporan Per Sub Sektor</span></a></li>
                                    <li><a class="ajax-link" href="<?php echo base_url();?>chartpenghematanenergi"><span class="icon icon-image"></span><span class="hidden-tablet"> Penghematan Energi Per Sub Sektor</span></a></li>
                                    <li><a class="ajax-link" href="<?php echo base_url();?>chartpenurunanemisi"><span class="icon icon-image"></span><span class="hidden-tablet"> Penurunan Emisi Per Sub Sektor</span></a></li>
                                    <li><a class="ajax-link" href="<?php echo base_url();?>chartsudahlapor"><span class="icon icon-document"></span><span class="hidden-tablet"> Perusahaan Sudah Mengisi Laporan</span></a></li>
                            		<li><a class="ajax-link" href="<?php echo base_url();?>chartbijakenergi"><span class="icon icon-image"></span><span class="hidden-tablet"> Perusahaan Sudah Memiliki Kebijakan Energi</span></a></li>
                                    <li><a class="ajax-link" href="<?php echo base_url();?>chartmgrenergi"><span class="icon icon-image"></span><span class="hidden-tablet"> Perusahaan Sudah Memiliki Manajer Energi</span></a></li>
                                    <li><a class="ajax-link" href="<?php echo base_url();?>chartpakaienergi"><span class="icon icon-image"></span><span class="hidden-tablet"> Jumlah Pemakaian Energi</span></a></li>
                                    <li><a class="ajax-link" href="<?php echo base_url();?>statkonsumsienergispesifik"><span class="icon icon-image"></span><span class="hidden-tablet"> Konsumsi Energi Spesifik</span></a></li>
								   <li><a class="ajax-link" href="<?php echo base_url();?>chartperalatanpemanfaat"><span class="icon icon-image"></span><span class="hidden-tablet"> Peralatan Pemanfaat Energi Utama</span></a></li>
                                   <li><a class="ajax-link" href="<?php echo base_url();?>chartkegiatan"><span class="icon icon-image"></span><span class="hidden-tablet"> Kegiatan Konservasi Energi</span></a></li>
                                   <li><a class="ajax-link" href="<?php echo base_url();?>chartrencana"><span class="icon icon-image"></span><span class="hidden-tablet"> Rencana Kegiatan Konservasi Energi</span></a></li>
							</ul>
						</li>
         <?php } ?>
		<?php if($this->session->userdata('privilege_id') == '2'){?>
						<li>
							<a href="#"><span class="icon icon-white icon-check"></span><span class="hidden-tablet"> Akun &amp; Status Pelaporan</span></a>
							<ul class="nav-dropdown">
								<li id="liRegistrasiItem" style="display:list-item"><a class="ajax-link" href="<?php echo base_url();?>user/registration"><span class="icon icon-users"></span><span class="hidden-tablet"> Akun</span></a></li>                        
                        				        <li id="lidetailperusahaanItem" style="display:list-item"><a class="ajax-link" href="<?php echo base_url();?>user/detailperusahaan"><span class="icon icon-check"></span><span class="hidden-tablet"> Status Pelaporan</span></a></li>
							</ul>
						</li>
                        <li>
							<a href="<?php echo base_url();?>rating"><span class="icon icon-white icon-star-on"></span><span class="hidden-tablet"> Rating</span></a>
						</li>
		<?php } ?>
<?php
	}
?>
						<li>
							<a href="#"><span class="icon icon-white icon-book-empty"></span><span class="hidden-tablet"> Buku Tahunan</span></a>
							<ul class="nav-dropdown">
                            <?php 
			                        		$sql = "SELECT * FROM tm_bukutahunan ORDER BY id_bukutahunan ASC ";
								$query = $this->db->query($sql);
								
								$regulasi=$query->result_array();
			                        		foreach($regulasi as $row){ ?>
			                        	<li><a class="ajax-link" href="<?php echo base_url();?>uploads/doc/<?php echo $row['file_bukutahunan'];?>" target="_blank"><span class="icon icon-book-empty"></span><span class="hidden-tablet"> <?php echo $row['nama_bukutahunan'];?></span></a></li>
			                        	<?php } ?>
							</ul>
						</li>
						<li>
							<a href="#"><span class="icon icon-white icon-lightbulb"></span><span class="hidden-tablet"> Help</span></a>
							<ul class="nav-dropdown">
								<li><a href="<?php echo base_url();?>doc/panduan_pengguna_pome.pdf"><span class="icon icon-contacts"></span><span class="hidden-tablet"> Panduan Pengguna Aplikasi POME</span></a></li>
								<li><a href="<?php echo base_url();?>home/faq"><span class="icon icon-messages"></span><span class="hidden-tablet"> FAQ</span></a></li>
							</ul>
						</li>
					</ul>
                </nav>
            </div>
		</div>
	</div>
	<!-- topbar ends -->
	<?php } ?>
	<div class="container-fluid">
		<div class="row-fluid">
		<?php if(!isset($no_visible_elements) || !$no_visible_elements) { ?>
<?php
	if($islogin){
		if($this->session->userdata('privilege_id') != '2'){
			$span = "span10";
?>
			 <!-- Left menu start -->            
            <div class="span2 main-menu-span">
				<div class="well nav-collapse sidebar-nav">  
					<ul class="nav nav-tabs nav-stacked main-menu">    					
                        <li class="nav-header hidden-tablet" data-toggle="collapse" data-target="#inputlaporan" style="cursor:pointer">Input Laporan</li>					
                    </ul>
                    <div id="inputlaporan" class="collapse">
					
                    	<ul class="nav nav-tabs nav-stacked main-menu">
                            <li><a class="ajax-link" href="<?php echo base_url();?>Perusahaan/add"><span class="icon icon-compose"></span><span class="hidden-tablet"> Informasi Umum</span></a></li>
                            <li class="divider"></li>
                            <li id="liInputLaporan" style="display:list-item"><a class="ajax-link" href="<?php echo base_url();?>orgenergi"><span class="icon icon-compose"></span><span class="hidden-tablet"> Input Laporan</span></a></li>
                        </ul>					
                    </div>
                    <ul class="nav nav-tabs nav-stacked main-menu">
                        <li class="nav-header hidden-tablet" data-toggle="collapse" data-target="#lihatlaporan" style="cursor:pointer">Lihat Laporan</li>
                    </ul>
                    <div id="lihatlaporan" class="collapse">
                    	<ul class="nav nav-tabs nav-stacked main-menu">
                        	 <li><a class="ajax-link" href="<?php echo base_url();?>lihatlaporan"><span class="icon icon-document"></span><span class="hidden-tablet"> Lihat Laporan</span></a></li>
                        </ul>
					</div>
                    <ul class="nav nav-tabs nav-stacked main-menu">
                        <li id="liLihatStat" style="display:list-item;cursor:pointer" class="nav-header hidden-tablet" data-toggle="collapse" data-target="#lihatstatistik" >Lihat Statistik</li>
                    </ul>                    
                    <div id="lihatstatistik" class="collapse">
                    	<ul class="nav nav-tabs nav-stacked main-menu">
<?php
	$sql = "SELECT `status` FROM t_statussubmit WHERE IdPerusahaan=".$this->session->userdata('id_perusahaan')." AND tahun=YEAR(NOW())-1";
	$query = $this->db->query($sql);
	$regulasi=$query->result_array();
	$statusLapor = 0;
	foreach($regulasi as $row){
		$statusLapor = $row['status'];
	}
	if($statusLapor == 2){
?>
                            <li><a class="ajax-link" href="<?php echo base_url();?>chartkonsumsienergispesifiknew"><span class="icon icon-image"></span><span class="hidden-tablet"> Konsumsi Energi Spesifik</span></a></li>
                            <li><a class="ajax-link" href="<?php echo base_url();?>chartkegiatanefesiensi"><span class="icon icon-image"></span><span class="hidden-tablet"> Kegiatan Efisiensi Energi</span></a></li>    
                            <li><a class="ajax-link" href="<?php echo base_url();?>chartrencanaefesiensi"><span class="icon icon-image"></span><span class="hidden-tablet"> Rencana Efisiensi Energi</span></a></li>
<?php
	}else{
?>
							<li><a class="ajax-link" href="#"><span class="hidden-tablet"> Hanya bisa dilihat bila sudah melaporkan dan sudah diverifikasi</span></a></li>
<?php
	}
?>
                        </ul>
                    </div>
				</div><!--/.well -->
			</div><!--/span-->
			<!-- left menu ends -->
<?php
		}else{
			$span = "";
		}
	}else{
		$span = "";
	}
?>
<?php if($span == "") {?>
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content">
			<!-- content starts -->
<?php }else{ ?>
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			<!-- content starts -->
<?php } ?>
            	<input id="IdSesUname" type="hidden"  value="<?php echo $this->session->userdata('username'); ?>">
			<?php } ?>
    	<script type="text/javascript">
		/*
			var username = document.getElementById('IdSesUname').value;
			if (username != ''){
				if (username=='admin')
				{ 
					document.getElementById('liInputLaporan').style.display = 'none'; 
					document.getElementById('liRegistrasi').style.display = 'list-item'; 
					document.getElementById('liRegistrasiItem').style.display = 'list-item'; 
					document.getElementById('divMasterData').style.display = 'inline'; 
				} 
				else
				{
					document.getElementById('liInputLaporan').style.display = 'list-item'; 
					document.getElementById('liRegistrasi').style.display = 'none'; 
					document.getElementById('liRegistrasiItem').style.display = 'none';
					document.getElementById('divMasterData').style.display = 'none'; 
				}
			}
		*/
    	</script>