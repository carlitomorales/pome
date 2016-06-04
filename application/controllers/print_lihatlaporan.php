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
    <link href='<? echo base_url() ?>css/datatables.custom.css' rel='stylesheet'>
    <link href='<? echo base_url() ?>css/dataTables.tableTools.css' rel='stylesheet'>

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="<? echo base_url() ?>img/faviconebtke.ico">
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" > <img src="<? echo base_url() ?>img/logo.png" /> <span></span></a>
			</div>
		</div>
	</div>	
</head>
	


			
			<div id="dvInformasiUmum" class="row-fluid sortable">
            	<div >
					<div >
						<h2>Informasi Umum</h2>
					</div>
					<div >                    	
                    	                     	                            
                            <div class="control-group">
                                <label class="control-label1" for="nama_perusahaan">Nama Perusahaan </label>
								<label class="control-labelisi" for="isi_nama_perusahaan">: <?php echo $this->data['nama_perusahaanp'];?></label>
							</div>
							<div class="control-group">
                                <label class="control-label1" for="type_perusahaan">Type Perusahaan</label>
								<label class="control-labelisi" for="isi_type_perusahaan">: <?php echo $this->data['type_perusahaanp'];?></label>
								
							</div>
							<div class="control-group">
                                <label class="control-label1" for="namasubsektor">Sub Sektor</label>
								<label class="control-labelisi" for="isi_namasubsektor">: <?php echo $this->data['NamaSubsektorp'];?></label>
								
							</div>
							
							<div class="control-group">
                                <label class="control-label1" for="alamat_perusahaan">Alamat Perusahaan</label>
								<label class="control-labelisi" for="isi_alamat_perusahaan">: <?php echo $this->data['alamat_perusahaanp'];?></label>
								
							</div>
                            <div class="control-group">
                                <label class="control-label1" for="prov">Provinsi</label>
								<label class="control-labelisi" for="isi_prov">: <?php echo $this->data['provp'];?></label>
								
							</div>  
							<div class="control-group">
                                <label class="control-label1" for="kotakab">Kota / Kabupaten</label>
								<label class="control-labelisi" for="isi_kotakab">: <?php echo $this->data['kotakabp'];?></label>
								
							</div>						
							<div class="control-group">
                                <label class="control-label1" for="NoTelp">No Telepon</label>
								<label class="control-labelisi" for="isi_NoTelp">: <?php echo $this->data['NoTelpp'];?></label>
								
							</div>								
							<div class="control-group">
                                <label class="control-label1" for="NoFax">No Faximili</label>
								<label class="control-labelisi" for="isi_NoFax">: <?php echo $this->data['NoFaxp'];?></label>
								
							</div>				
							<div class="control-group">
                                <label class="control-label1" for="ThnAwalOp">Tahun Awal Beroperasi</label>
								<label class="control-labelisi" for="isi_ThnAwalOp">: <?php echo $this->data['ThnAwalOpp'];?></label>
								
							</div>				
							<div class="control-group">
                                <label class="control-label1" for="JmlKaryawan">Jumlah Karyawan</label>
								<label class="control-labelisi" for="isi_JmlKaryawan">: <?php echo $this->data['JmlKaryawanp'];?></label>
								
							</div>	
							
						</form	>
					</div>
					
				</div>
			</div>
					
			<div id="dvOrganisasiManagementEnergi" class="row-fluid sortable">
            	<div >
					<div >
						<h2>Organisasi Management Energi</h2>					
					</div>
					<div >                    	
                    	                 	                            
                            <div class="control-group">
                                <label class="control-label1" for="org_manajemen_energi">Ada/Tidak Organisasi Manajemen Energi </label>
								<label class="control-labelisi" for="isi_org_manajemen_energi">: <?php echo $this->data['organisasi'];?></label>
							</div>
							<div class="control-group">
                                <label class="control-labelsub" for="file_manajemen_energi">File Struktur Organisasi, Surat Keputusan Pembentukan  </label>
								<label class="control-labelisi" for="isi_org_manajemen_energi">: <?php if($this->data['pathfilep'] !=''){ ?>  <a href="uploads/<?php echo $this->data['pathfilep']; ?>"><?php echo $this->data['pathfilep']; ?></a><?php } ?></label>
								
							</div>
							<div class="control-group">
                                <label class="control-label1" for="manager_energi">Ada/tidak Manager Energi  </label>
								<label class="control-labelisi" for="isi_manager_energi">: <?php echo $this->data['manager'];?></label>
							</div>
							<div class="control-group">
                                <label class="control-labelsub" for="nama_manager_energi">Nama Manajer Energi  </label>							
								<label class="control-labelisi" for="isi_nama_manager_energi">: <?php echo $this->data['namamanagerp'];?></label>
								
							</div>
							<div class="control-group">
                                <label class="control-labelsub" for="email_manager_energi">Email Manajer Energi  </label>							
								<label class="control-labelisi" for="isi_email_manager_energi">: <?php echo $this->data['emailmanagerp'];?></label>
							</div>
							<div class="control-group">                                
                                <label class="control-labelsub" for="telp_manager_energi">No Telp / HP Manajer Energi  </label>
								<label class="control-labelisi" for="isi_telp_manager_energi">: <?php echo $this->data['noteleponp'];?></label>
							</div> 
							<div class="control-group">
								<label class="control-labelsub" for="sertifikat_manager_energi">No Sertifikat</label>
								<label class="control-labelisi" for="isi_sertifikat_manager_energi">: <?php echo $this->data['nosertifikatp'];?></label>
							</div>
							<div class="control-group">
                                <label class="control-labelsub" for="file_sertifikat_energi">File lampirkan Sertifikat</label>
								<label class="control-labelisi" for="isi_file_sertifikat_energi">: <?php if($this->data['pathfilesertifikatp'] !=''){ ?>  <a href="uploads/<?php echo $this->data['pathfilesertifikatp']; ?>"><?php echo $this->data['pathfilesertifikatp']; ?></a><?php } ?></label>
								
							</div>
						</form	>
					</div>
					
				</div>
			</div>
			
		<?php if ($this->data['type_perusahaanp'] == "Industri"){?>	
            <div id="dvJenisProduksi" class="row-fluid">	
                <div >
					<div>
						<h2>Jenis Produksi</h2>
						
					</div>
					<div >
					        <table class="table table-striped table-bordered bootstrap-datatable" id="datatableJP">
                                  <thead>
                                      <tr>
                                          <th>Subsektor</th>
                                          <th>Jenis Produksi</th>
                                          <th>Jumlah</th>
                                         
                                      </tr>
									  <?php 
									foreach($tbjenisproduksi as $row){
									  echo "<tr>";
										echo "<th>". $row->NamaSubsektor ."</th>";
										echo "<th>". $row->jenis_produksi ."</th>";
										echo "<th>". $row->jumlah ." ".$row->satuan."</th>";										
									  echo "</tr>";   
									}?>
                                  </thead>
                                  <!-- <tfoot>
                                        <tr>
                                            <th colspan="1" style="text-align:Right">Total:</th>
                                            <th colspan="4"></th>
                                        </tr>
                                   </tfoot>  -->
								   
                              </table>
                         
							
							
							

                    </div>
                </div>
             </div>
		<?php }elseif ($this->data['type_perusahaanp'] == "Bangunan") {?>	
			<div id="dvLuasBangunan" class="row-fluid">	
                <div >
					<div>
						<h2>Luas Bangunan</h2>
						<div class="box-icon">
                        
						</div>
					</div>
					<div >
                    	<table class="table table-striped table-bordered bootstrap-datatable" id="datatableLB">
                              <thead>
                                  <tr>
	                                  <th>Subsektor</th>
                                      <th>Nama Bagunan</th>
                                      <th>Luas Bangunan</th>
                                      
                                  </tr>
								    <?php 
									foreach($tbluasbangunan as $row){
									  echo "<tr>";
										echo "<th>". $row->NamaSubsektor ."</th>";
										echo "<th>". $row->nama_bangunan ."</th>";
										echo "<th>". $row->luas_bangunan ." M2</th>";										
									  echo "</tr>";   
									}?>
                              </thead>
                              <!--<tfoot>
                                        <tr>
                                            <th colspan="2" style="text-align:Right">Total:</th>
                                            <th colspan="5"></th>
                                        </tr>
                              </tfoot>   -->
                          </table> 
                    </div>
                </div>
             </div>
		<?php }?>	 
			<div id="dvPemakaianEnergi" class="row-fluid">	
                <div >
					<div>
						<h2>Pemakaian Energi</h2>
						
					</div>
					<div >
                    	<table class="table table-bordered bootstrap-datatable" id="datatablePE">
                              <thead>
                                  <tr>
                                      <th>Jenis Energi</th>
									  <th>Detail Jenis Energi</th>
                                      <th>Original Unit</th>
                                      <th>GJoule</th>                                     
                                  </tr>
								   <?php 
									foreach($tbpemakaianenergi as $row){
									  echo "<tr>";
										echo "<th>". $row->JenisEnergi ."</th>";
										echo "<th>". $row->detail_jenis_energi ."</th>";
										echo "<th>". $row->original_unit ." ".$row->Satuan."</th>";	
										echo "<th>". $row->gjoule ."</th>";
									  echo "</tr>";   
									}?>
                              </thead>  
                          </table> 
                    </div>
                </div>
             </div>
			
			<div id="dvKonsumsiEnergiSpesifik" class="row-fluid">	
                <div >
					<div>
						<h2>Konsumsi Energi Spesifik</h2>
						
					</div>
					<div >
                    	<table class="table table-striped table-bordered bootstrap-datatable" id="datatableKE">
                              <thead>
                                  <tr>
                                      <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                      <th>Satuan</th>
                                      <th>Tahun Sebelumnya</th>
                                      <th>Tahun <?php echo date("Y")-1;?></th>
                                      <th>Persentase Pertumbuhan</th>
                                  </tr>
                              </thead>  
                          </table> 
                          <input id="type_perusahaan" name="type_perusahaan" type="hidden"  value="<?php echo $this->session->userdata('type_perusahaanp'); ?>">
                    </div>
                </div>
				<input id="type_perusahaan" name="type_perusahaan" type="hidden"  value="<?php echo $this->session->userdata('type_perusahaanp'); ?>">
             </div>
			
			<div id="dvPeralatanPemanfaatEnergiUtama" class="row-fluid">	
                <div >
					<div>
						<h2>Peralatan Pemanfaat Energi Utama</h2>
						
					</div>
					<div >
                    	<table class="table table-striped table-bordered bootstrap-datatable" id="datatablePU">
                              <thead>
                                  <tr>
                                      <th>Jenis Peralatan</th>
                                      <th>Jenis Energi</th>
                                      <th>Original Unit</th>
                                      <th>GJoule</th>
                                      <th>Persentase Pemakaian Energi</th>                                      
                                  </tr>
								  <?php 
									foreach($tbperalatanpemanfaatenergi as $row){
									  echo "<tr>";
										echo "<th>". $row->jenis_peralatan ."</th>";
										echo "<th>".$row->detail_jenis_energi." (". $row->JenisEnergi .")</th>";
										echo "<th>". $row->original_unit ." ".$row->Satuan."</th>";	
										echo "<th>". $row->gjoule ."</th>";
										echo "<th>". $row->persentase ." %</th>";
									  echo "</tr>";   
									}?>
                              </thead>  
                          </table> 
                    </div>
                </div>
             </div>
			
			<div id="dvKegiatanEfisiensiEnergi" class="row-fluid">
            	<div >
					<div>
						<h2>Kegiatan Efisiensi Energi Pada Peralatan Pengguna Energi Utama</h2>
						
					</div>
					<div >
                      <table class="table table-striped table-bordered bootstrap-datatable" id="datatableKEE">
                          <thead>
                              <tr>
								  <th rowspan="2" align="center">Peralatan</th>
                                  <th rowspan="2" align="center">Kegiatan</th>
                                  <th colspan="2" align="center">Realisasi Penghematan yang Diperoleh</th>
                                  <th colspan="2" align="center">Realisasi Emisi</th>
                                  <th rowspan="2" align="center">Keterangan</th>
                              </tr>
                              <tr>
                                <th align="center">GJoule</th>
                                <th align="center">%</th>
                                <th align="center">tCO<sub>2</sub></th>
                                <th align="center">%</th>
                            </tr> <?php 
									foreach($tbkegiatankonservasi as $row){
									  echo "<tr>";
										echo "<th>". $row->JenisPeralatan ." (".$row->detail_jenis_energi." - ". $row->JenisEnergi .")</th>";
										echo "<th>".$row->kegiatan."</th>";										
										echo "<th>". $row->realisasi_gjoule ."</th>";
										echo "<th>". $row->realisasi_persen ." %</th>";
										echo "<th>". $row->realisasi_emisi ."</th>";
										echo "<th>". $row->realisasi_emisi_persen ." %</th>";
										echo "<th>". $row->keterangan ."</th>";
									  echo "</tr>";   
									}?>
                          </thead>  
                      </table> 
                    </div>
                 </div>
              </div>
			  
			<div id="dvKegiatanEfisiensiLain" class="row-fluid">	
				<div >
					<div>
						<h2>Kegiatan Efisiensi Lain</h2>
						<div class="box-icon">
						
						</div>
					</div>
					<div >
							<table class="table table-striped table-bordered bootstrap-datatable" id="datatableKEL">
								  <thead>
									  <tr>
										  <th>Kegiatan</th>
										  <th>Detail Kegiatan</th>
									  </tr>
									<?php 
									foreach($tbkegiatankonservasilain as $row){
									  echo "<tr>";
										echo "<th>". $row->jenis_kegiatan ."</th>";
										echo "<th>".$row->detail_kegiatan."</th>";	
									  echo "</tr>";   
									}?>
								  </thead>
							  </table>
						  
					</div>
				</div>
			 </div>
		    
			<div id="dvRencanaKegiatanEfisiensiEnergi" class="row-fluid">
            	<div >
					<div>
						<h2>Rencana Kegiatan Efisiensi Energi Pada Peralatan Pengguna Energi Utama</h2>
						
					</div>
					<div >
                      <table class="table table-striped table-bordered bootstrap-datatable" id="datatableRKE">
                          <thead>
                              <tr>
								  <th rowspan="2" align="center">Peralatan</th>
                                  <th rowspan="2" align="center">Kegiatan</th>
                                  <th colspan="2" align="center">Target Penghematan yang Diperoleh</th>
                                  <th colspan="2" align="center">Target Emisi</th>
                                  <th rowspan="2" align="center">Keterangan</th>
                              </tr>
                              <tr>
                                <th align="center">GJoule</th>
                                <th align="center">%</th>
                                <th align="center">tCO<sub>2</sub></th>
                                <th align="center">%</th>
                            </tr>
							  <?php 
									foreach($tbrencanakonservasi as $row){
									  echo "<tr>";
										echo "<th>". $row->JenisPeralatan ." (".$row->detail_jenis_energi." - ". $row->JenisEnergi .")</th>";
										echo "<th>".$row->kegiatan."</th>";										
										echo "<th>". $row->target_gjoule ."</th>";
										echo "<th>". $row->target_persen ." %</th>";
										echo "<th>". $row->target_emisi ."</th>";
										echo "<th>". $row->target_emisi_persen ." %</th>";
										echo "<th>". $row->keterangan ."</th>";
									  echo "</tr>";   
									}?>
                          </thead>  
                      </table> 
                    </div>
                 </div>
              </div>
			 
			<div id="dvRencanaKegiatanEfisiensiLain" class="row-fluid">	
                <div >
					<div>
						<h2>Rencana Kegiatan Efisiensi Lain</h2>
						
					</div>
					<div >
					        <table class="table table-striped table-bordered bootstrap-datatable" id="datatableRKL">
                                  <thead>
                                      <tr>
                                      	  <th>Kegiatan</th>
                                          <th>Detail Kegiatan</th>
                                      </tr>
									  <?php 
									foreach($tbrencanakonservasilain as $row){
									  echo "<tr>";
										echo "<th>". $row->jenis_kegiatan ."</th>";
										echo "<th>".$row->detail_kegiatan."</th>";	
									  echo "</tr>";   
									}?>
                                  </thead>
                              </table>
                          
                    </div>
                </div>
             </div>
			 
			<div class="row-fluid">	
                <div >
					<div>
						<h2>Audit Energi Pada Peralatan Pemanfaat Energi Utama</h2>
						
					</div>
					<div >
                    	<table class="table table-striped table-bordered bootstrap-datatable" id="datatableAUA">
                              <thead>
                                  <tr>
                                      <th>Jenis Peralatan</th>
                                      <th>Status</th>
                                      <th>Keterangan</th>
                                      <th>File Audit</th>
                                      
                                  </tr>
								  <?php 
									foreach($tbaudit as $row){
									if($row->status_audit == '1') {$statusa = "Sudah";}else{$statusa = "Belum";}	
									if($row->keterangan_audit != '') {$ket = $row->keterangan_audit;}else{$ket = " - ";}	
									if($row->file_audit != '') {$file = $row->keterangan_audit;}else{$file = " - ";}	
									  echo "<tr>";
										echo "<th>". $row->jenis_peralatan ."</th>";
										echo "<th>".$statusa."</th>";	
										echo "<th>".$ket."</th>";	
										echo "<th>".$file."</th>";	
									  echo "</tr>";   
									}?>
                              </thead>  
                          </table>     
                    </div>
                 </div>
             </div>


	