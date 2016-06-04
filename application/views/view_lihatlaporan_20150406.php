<?php include('header.php'); ?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url();?>">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Lihat Laporan</a></li>
				</ul>
			</div>
			<div id="dvisilaporan">
			<div id="dvInformasiUmum" class="row-fluid sortable">
            	<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>Informasi Umum</h2>
						<div class="box-icon">
                        	
						</div>
					</div>
					<div class="box-content">                    	
                    	<form id="frmAdd1" class="form-horizontal" method="post">                        	                            
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
                                <label class="control-labelsub" for="prov">Provinsi</label>
								<label class="control-labelisi" for="isi_prov">: <?php echo $this->data['provp'];?></label>
								
							</div>  
							<div class="control-group">
                                <label class="control-labelsub" for="kotakab">Kota / Kabupaten</label>
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
            	<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>Organisasi Management Energi</h2>
						<div class="box-icon">
                        	
						</div>
					</div>
					<div class="box-content">                    	
                    	<form id="frmAdd" class="form-horizontal" method="post">                        	                            
                            <div class="control-group">
                                <label class="control-label1" for="org_manajemen_energi">Ada/Tidak Organisasi Manajemen Energi </label>
								<label class="control-labelisi" for="isi_org_manajemen_energi">: <?php echo $this->data['organisasi'];?></label>
							</div>
							<div class="control-group">
                                <label class="control-labelsub" for="file_manajemen_energi">File Struktur Organisasi, Surat Keputusan Pembentukan  </label>
								<label class="control-labelisi" for="isi_org_manajemen_energi">: <?php if($this->data['pathfilep'] !=''){ ?>  <a href="uploads/<?php echo $this->data['pathfilep']; ?>"><?php echo $this->data['pathfilep']; ?></a><?php } ?></label>
							</div>
							<div class="control-group">
                                <label class="control-label1" for="kebijakan_energi">ada/tidak Kebijakan Efisiensi Energi Perusahaan</label>
								<label class="control-labelisi" for="isi_kebijakan_energi">: <?php echo $this->data['kebijakan'];?></label>
							</div>
							<div class="control-group">
                                <label class="control-labelsub" for="file_kebijakan_energi">File Kebijakan Efisiensi Energi Perusahaan</label>
								<label class="control-labelisi" for="isi_kebijakan_energi">: <?php if($this->data['pathfilekebijakanp'] !=''){ ?>  <a href="uploads/<?php echo $this->data['pathfilekebijakanp']; ?>"><?php echo $this->data['pathfilekebijakanp']; ?></a><?php } ?></label>
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
                <div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>Jenis Produksi</h2>
						<div class="box-icon">
                        	
						</div>
					</div>
					<div class="box-content">
					        <table class="table table-striped table-bordered bootstrap-datatable" id="datatableJP">
                                  <thead>
                                      <tr>
                                          <th>Subsektor</th>
                                          <th>Jenis Produksi</th>
                                          <th>Jumlah</th>
                                         
                                      </tr>
                                  </thead>
                                   <tfoot>
                                        <tr>
                                            <th colspan="2" style="text-align:Right">Total:</th>
                                            <th colspan="3"></th>
                                        </tr>
                                   </tfoot>  
                              </table>
                          
                    </div>
                </div>
             </div>
		<?php }elseif ($this->data['type_perusahaanp'] == "Bangunan") {?>	
			<div id="dvLuasBangunan" class="row-fluid">	
                <div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>Luas Bangunan</h2>
						<div class="box-icon">
                        
						</div>
					</div>
					<div class="box-content">
                    	<table class="table table-striped table-bordered bootstrap-datatable" id="datatableLB">
                              <thead>
                                  <tr>
	                                  <th>Subsektor</th>
                                      <th>Nama Bagunan</th>
                                      <th>Luas Bangunan</th>
                                      
                                  </tr>
                              </thead>
                              <tfoot>
                                        <tr>
                                            <th colspan="2" style="text-align:Right">Total:</th>
                                            <th colspan="5"></th>
                                        </tr>
                              </tfoot>   
                          </table> 
                    </div>
                </div>
             </div>
		<?php }?>	 
			<div id="dvPemakaianEnergi" class="row-fluid">	
                <div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>Pemakaian Energi</h2>
						<div class="box-icon">
                        	
						</div>
					</div>
					<div class="box-content">
                    	<table class="table table-bordered bootstrap-datatable" id="datatablePE">
                              <thead>
                                 <tr>
                                      <th>Jenis Energi</th>
									  <th>Detail Jenis Energi</th>
                                      <th>Original Unit</th>
                                      <th >GJoule</th>
									  <th >Emisi (TCO2)</th>
                                      
                                  </tr>								  
                              </thead> 
							<tfoot>
                                        <tr>
                                            <th colspan="3" style="text-align:Right">Total :</th>
                                            <th colspan="1" style="text-align:left"></th>
											<th colspan="1" style="text-align:left"></th>
											
											 
                                        </tr>
										<tr>
                                            <th colspan="3" style="text-align:Right">TOE :</th>
                                            <th colspan="2" style="text-align:left"></th>
                                        </tr>
					
                                   </tfoot>  
                          </table> 
                    </div>
                </div>
             </div>
			
			<div id="dvKonsumsiEnergiSpesifik" class="row-fluid">	
                <div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>Konsumsi Energi Spesifik</h2>
						<div class="box-icon">
                        	
						</div>
					</div>
					<div class="box-content">
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
                <div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>Peralatan Pemanfaat Energi Utama</h2>
						<div class="box-icon">
                        	
						</div>
					</div>
					<div class="box-content">
                    	<table class="table table-striped table-bordered bootstrap-datatable" id="datatablePU">
                              <thead>
                                  <tr>
                                      <th rowspan="2" style="text-align:center">Jenis Peralatan</th>
                                      <th rowspan="2" style="text-align:center">Jenis Energi</th>
									  <th colspan="3" style="text-align:center">Pemakaian Energi</th>
                                  </tr>
								  <tr>
									  <th style="text-align:center">Original Unit</th>
                                      <th style="text-align:center">GJoule</th>
                                      <th style="text-align:center">Persentase</th>
								  </tr>
                              </thead>  
							   <tfoot>
                                        <tr>
                                            <th colspan="3" style="text-align:Right">Total:</th>
                                            <th colspan="1"></th>
											<th colspan="2"></th>
                                        </tr>
                                   </tfoot>  
                          </table> 
                    </div>
                </div>
             </div>
			
			<div id="dvKegiatanEfisiensiEnergi" class="row-fluid">
            	<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>Kegiatan Efisiensi Energi Pada Peralatan Pengguna Energi Utama</h2>
						<div class="box-icon">
                        	
						</div>
					</div>
					<div class="box-content">
                      <table class="table table-striped table-bordered bootstrap-datatable" id="datatableKEE">
                          <thead>
                              <tr>
								  <th rowspan="2"  style="text-align:center">Peralatan</th>
                                  <th rowspan="2"  style="text-align:center">Kegiatan</th>
								  <th rowspan="2"  style="text-align:center">Detail Kegiatan</th>
                                  <th colspan="3" width="20%" style="text-align:center">Penghematan yang Diperoleh</th>
                                  <th rowspan="2"  style="text-align:center">Keterangan</th>
                              </tr>
                              <tr>
                                <th style="text-align:center">GJoule</th>
                                <th style="text-align:center">%</th>
                                <th style="text-align:center">Emisi (tCO<sub>2</sub>)</th>
                            </tr>
                          </thead>  
                      </table> 
                    </div>
                 </div>
              </div>
			  
			<div id="dvKegiatanEfisiensiLain" class="row-fluid">	
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>Kegiatan Efisiensi Lain</h2>
						<div class="box-icon">
						
						</div>
					</div>
					<div class="box-content">
							<table class="table table-striped table-bordered bootstrap-datatable" id="datatableKEL">
								  <thead>
									  <tr>
										  <th>Kegiatan</th>
										  <th>Detail Kegiatan</th>
									  </tr>
								  </thead>
							  </table>
						  
					</div>
				</div>
			 </div>
		    
			<div id="dvRencanaKegiatanEfisiensiEnergi" class="row-fluid">
            	<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>Rencana Kegiatan Efisiensi Energi Pada Peralatan Pengguna Energi Utama</h2>
						<div class="box-icon">
                        	
						</div>
					</div>
					<div class="box-content">
                      <table class="table table-striped table-bordered bootstrap-datatable" id="datatableRKE">
                          <thead>
                              <tr>
								  <th rowspan="2" style="text-align:center">Peralatan</th>
                                  <th rowspan="2" style="text-align:center">Kegiatan</th>
								  <th rowspan="2" style="text-align:center">Detail Kegiatan</th>
                                  <th colspan="3" style="text-align:center">Target Penurunan yang Diperoleh</th>                                  
                                  <th rowspan="2" style="text-align:center">Keterangan</th>
                                  
                              </tr>
                              <tr>
                                <th style="text-align:center">GJoule</th>
                                <th style="text-align:center">%</th>
                                <th style="text-align:center">Emisi (tCO<sub>2</sub>)</th>
                              </tr>
                          </thead>  
                      </table> 
                    </div>
                 </div>
              </div>
			 
			<div id="dvRencanaKegiatanEfisiensiLain" class="row-fluid">	
                <div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>Rencana Kegiatan Efisiensi Lain</h2>
						<div class="box-icon">
                        	
						</div>
					</div>
					<div class="box-content">
					        <table class="table table-striped table-bordered bootstrap-datatable" id="datatableRKL">
                                  <thead>
                                      <tr>
                                      	  <th>Kegiatan</th>
                                          <th>Detail Kegiatan</th>
                                      </tr>
                                  </thead>
                              </table>
                          
                    </div>
                </div>
             </div>
			 
			<div class="row-fluid">	
                <div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>Audit Energi Pada Peralatan Pemanfaat Energi Utama</h2>
						<div class="box-icon">

						</div>
					</div>
					<div class="box-content">
                    	<table class="table table-striped table-bordered bootstrap-datatable" id="datatableAUA">
                              <thead>
                                  <tr>
                                      <th>Jenis Peralatan</th>
                                      <th>Status</th>
                                      <th>Keterangan</th>
                                      <th>File Audit</th>
                                      
                                  </tr>
                              </thead>  
                          </table>     
                    </div>
                 </div>
             </div>
			 </div>
			 
             <div class="row-fluid">
                <div class="box span12">
                	<div class="box-content"> 
					
					<?php if($this->session->userdata('privilege_id') != '2'){?>
					<span>Terima kasih telah mengisi laporan managemen energi tahunan, kami akan mengirimkan konfirmasi laporan melalui email max 3 hari kerja </span></p></br>					
					
						<?php if($submit_status!='1'){ ?>
						
						<span class="btn btn-primary" onClick="document.location='<?php echo base_url();?>lihatlaporan/savesubmit'" style="float:center">Submit</span> <?php } ?>
					<?php }?>
					<?php if($this->session->userdata('privilege_id') == '2'){?>						
						<span type="hidden" class="btn btn-primary" onClick="document.location='<?php echo base_url();?>lihatlaporan/print2pdf?idp=<?php echo $this->data['idp']; ?>&tahun=<?php echo $this->data['tahunp'] ;?>'" style="float:center">Print</span>
					<?php }elseif($this->session->userdata('privilege_id') == '3'){?>
						
						<span type="hidden" class="btn btn-primary" onClick="document.location='<?php echo base_url();?>lihatlaporan/print2pdf'" style="float:center">Print</span>
					<?php }?>
                    </div>
                </div>
             </div>
<?php include('footer.php'); ?>

	<script type="text/javascript">
	var oTableJP;
	var oTablePE;
	var oTableKE;
	var oTablePU;
	var oTable;
	var idp = (<?php echo $this->data['idp']; ?>);
	var tahunp = (<?php echo $this->data['tahunp'] ;?>);
	
	$(document).ready(function(){
	
	
	
		oTableJP = $("#datatableJP").dataTable({
			"fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
					iTotalMarket = parseFloat(0);
					for ( var i=0 ; i<aaData.length ; i++ )
					{
						//alert(aaData[i][1]);
						iTotalMarket += parseFloat(aaData[i][2].replace(/,/g, "").replace("ton","")*1);
					
					}
					
					/* Calculate the market share for browsers on this page */
					
					/* Modify the footer row to match what we want */
					var nCells = nRow.getElementsByTagName('th');
					nCells[1].innerHTML=formatCurrency(parseFloat(iTotalMarket),0)+" ";
					//nRow.innerHTML = "<th colspan="+"1"+" style="+"text-align:Right"+">Total:</th><th>"+parseFloat(iPageMarket)+"</th>";		
			},
			"aaSorting":[[4,"desc"]],
			"bDestroy":true,
			"bFilter":false,
			"bPaginate":false,
			"bInfo":false,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo base_url();?>lihatlaporan/listjenisproduksi?idp="+idp+"&tahunp="+tahunp,
			"sServerMethod" : "POST",
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			},
			"aoColumnDefs":[
				{
					"aTargets":[1],
					"fnRender": function(obj){
						return obj.aData[1];
					}
				},
				{
					"aTargets":[2],
					"fnRender": function(obj){
						return formatCurrency(obj.aData[2],0)+'';
					}
				}
			]
		});
		
		
		oTableLB = $("#datatableLB").dataTable({
			"fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
					iTotalMarket = parseInt(0);
					for ( var i=0 ; i<aaData.length ; i++ )
					{
						iTotalMarket += parseInt(aaData[i][2].replace(/,/g, "").replace('m2',"")*1);				
					}
					
					/* Calculate the market share for browsers on this page */
					
					/* Modify the footer row to match what we want */
					var nCells = nRow.getElementsByTagName('th');
					nCells[1].innerHTML=formatCurrency(parseFloat(iTotalMarket),2)+ " m2";
					//nRow.innerHTML = "<th colspan="+"1"+" style="+"text-align:Right"+">Total:</th><th>"+parseFloat(iPageMarket)+"</th>";		
			},
			"aaSorting":[[0,"desc"]],
			"bDestroy":true,
			"bFilter":false,
			"bPaginate":false,
			"bInfo":false,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo base_url();?>lihatlaporan/listluasbangunan?idp="+idp+"&tahunp="+tahunp,
			"sServerMethod" : "POST",
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			},
			"aoColumnDefs":[
				{
					"aTargets":[1],
					"fnRender": function(obj){
						return obj.aData[1];
					}
				},
				{
					"aTargets":[2],
					"fnRender": function(obj){
						return formatCurrency(obj.aData[2],2)+' m2';
					}
				}
			]
		});
		
		
		oTablePE = $("#datatablePE").dataTable({			
		"fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
					iTotalGJoule = parseFloat(0);
					iTotalTOE = parseFloat(0);
					iTotalEmisi = parseFloat(0);
					for ( var i=0 ; i<aaData.length ; i++ )
					{
						iTotalGJoule += parseFloat(aaData[i][3].replace(/,/g, ""));	
						iTotalEmisi += parseFloat(aaData[i][4].replace(/,/g, ""));	
					}
					
					/* Calculate the market share for browsers on this page */
					iTotalTOE = iTotalGJoule/41,868;
					/* Modify the footer row to match what we want */
					
					var nCells = nRow.getElementsByTagName('th');
					nCells[1].innerHTML=formatCurrency(parseFloat(iTotalGJoule),0);
					nCells[2].innerHTML=formatCurrency(parseFloat(iTotalEmisi),2);
					var secondRow = $(nRow).next()[0]; 
					var nCells1 = secondRow.getElementsByTagName('th'); 
					nCells1[1].innerHTML=formatCurrency(parseFloat(iTotalTOE),0);
					//var thirdRow = $(nRow).next()[1]; 
					//var nCells2 = thirdRow.getElementsByTagName('th'); 
					//nCells2[1].innerHTML=formatCurrency(parseFloat(iTotalEmisi),2);
					//nRow.innerHTML = "<th colspan="+"1"+" style="+"text-align:Right"+">Total:</th><th>"+parseFloat(iPageMarket)+"</th>";		
			},
			"aaSorting":[[5,"desc"]],
			"bDestroy":true,
			"bFilter":false,
			"bPaginate":false,
			"bInfo":false,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo base_url();?>lihatlaporan/listpemakaianenergi?idp="+idp+"&tahunp="+tahunp,
			"sServerMethod" : "POST",
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			},
			"aoColumnDefs":[
				{
					"aTargets":[2],
					"fnRender": function(obj){
						var satuan='';
						if(obj.aData[6] == null){satuan;}else{satuan=obj.aData[6];}
						return '<div align="right">'+formatCurrency(obj.aData[3],2)+'&nbsp;'+satuan+'</div>';
					}
				},
				{
					sClass: "alignRight",
					"aTargets":[3],
					"fnRender": function(obj){
						return formatCurrency(obj.aData[4],0) ; //'<div align="right">'+formatCurrency(obj.aData[4],0)+'</div>';
					}
				},
				{
					sClass: "alignRight",
					"aTargets":[4],
					"fnRender": function(obj){
						return formatCurrency(obj.aData[7]*obj.aData[4],2) ; //'<div align="right">'+formatCurrency(obj.aData[4],0)+'</div>';
					}
				}
			]
		});
		
		
		
		
		oTablePU = $("#datatablePU").dataTable({
		"fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
					iTotalGJoule = parseFloat(0);
					iTotalPersen = parseFloat(0);
					for ( var i=0 ; i<aaData.length ; i++ )
					{
						iTotalGJoule += parseFloat(aaData[i][3].replace(/,/g, "").replace("ton","")*1);
						iTotalPersen += parseFloat(aaData[i][4].replace(/,/g, "").replace("%","")*1);
					
					}
					
					/* Calculate the market share for browsers on this page */
					
					/* Modify the footer row to match what we want */
					var nCells = nRow.getElementsByTagName('th');

					nCells[1].innerHTML=formatCurrency(parseFloat(iTotalGJoule),2);
					if (iTotalPersen>=100){iTotalPersen=100;}

					nCells[2].innerHTML=formatCurrency(parseFloat(iTotalPersen),2)+' %';
					$("#IdTotalPersen").val('');
					$("#IdTotalPersen").val(parseFloat(iTotalPersen));
					if (parseFloat(iTotalPersen)>=60){
						persen_energi = "ok";
						$("#btnext").show();
						$("#btnext1").hide();
						$("#textket").hide();
					}else{
						persen_energi = "no";
						$("#btnext").hide();
						$("#btnext1").show();
						$("#textket").show();
					}
					
					//nRow.innerHTML = "<th colspan="+"1"+" style="+"text-align:Right"+">Total:</th><th>"+parseFloat(iPageMarket)+"</th>";		
			},
			"aaSorting":[[0,"desc"]],
			"bDestroy":true,
			"bFilter":false,
			"bPaginate":false,
			"bInfo":false,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo base_url();?>lihatlaporan/listperalatanpemanfaatenergi?idp="+idp+"&tahunp="+tahunp,
			"sServerMethod" : "POST",
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			},
			"aoColumnDefs":[
				{
					"aTargets":[0],
					"fnRender": function(obj){
						if (obj.aData[0] == 'Lain-Lain')
						{return '<div align="left">'+obj.aData[0]+'&nbsp;('+obj.aData[1]+')</div>';}
						else
						{return '<div align="left">'+obj.aData[0]+'</div>';}
						
					}
				},
				{
					"aTargets":[1],
					"fnRender": function(obj){
						return '<div align="left">'+obj.aData[2]+'&nbsp;('+obj.aData[3]+')</div>';
					}
				},
				{
					"aTargets":[2],
					"fnRender": function(obj){
						var satuan='';
						if(obj.aData[8] == null){satuan;}else{satuan=obj.aData[8];}
						return '<div align="left">'+formatCurrency(obj.aData[5],0)+'&nbsp;'+satuan+'</div>';
					}
				},
				{
					"aTargets":[3],
					"fnRender": function(obj){
						return formatCurrency(obj.aData[6],0) ; // '<div align="right">'+formatCurrency(obj.aData[6],0)+'</div>';
					}
				},
				{
					"aTargets":[4],
					"fnRender": function(obj){
						return formatCurrency(obj.aData[9],2)+' %';
					}
				}
			]
		});
		
		oTableKEE = $("#datatableKEE").dataTable({
			"aaSorting":[[0,"desc"]],
			"bDestroy":true,
			"bFilter":false,
			"bPaginate":false,
			"bInfo":false,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo base_url();?>lihatlaporan/listkegiatankonservasi?idp="+idp+"&tahunp="+tahunp,
			"sServerMethod" : "POST",
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			},
			"aoColumnDefs":[
				
				
				{
					"aTargets":[0],
					"fnRender": function(obj){
						if (obj.aData[9] == 'Lain-Lain')
						{return '<div align="left">'+obj.aData[14]+'&nbsp;('+obj.aData[9]+') </br> ('+obj.aData[10]+' - '+obj.aData[11]+')</div>';}
						else
						{return '<div align="left">'+obj.aData[9]+' </br> ('+obj.aData[10]+' - '+obj.aData[11]+')</div>';}
						
					}
				}
			]
		});
		
		oTableKEL = $("#datatableKEL").dataTable({
			
			"aaSorting":[[3,"desc"]],
			"bDestroy":true,
			"bFilter":false,
			"bPaginate":false,
			"bInfo":false,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo base_url();?>lihatlaporan/listkegiatankonservasilain?idp="+idp+"&tahunp="+tahunp,
			"sServerMethod" : "POST",
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			},
			"aoColumnDefs":[
				{
					"aTargets":[0],
					"fnRender": function(obj){
						return obj.aData[1];
					}
				},
				{
					"aTargets":[1],
					"fnRender": function(obj){
						return obj.aData[2];
					}
				}
			]
		});
		
		oTableRKE = $("#datatableRKE").dataTable({
			"aaSorting":[[0,"desc"]],
			"bDestroy":true,
			"bFilter":false,
			"bPaginate":false,
			"bInfo":false,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo base_url();?>lihatlaporan/listrencanakonservasi?idp="+idp+"&tahunp="+tahunp,
			"sServerMethod" : "POST",
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			},
			"aoColumnDefs":[
				{
					"aTargets":[0],
					"fnRender": function(obj){
						return '<div align="left">'+obj.aData[8]+' </br> ('+obj.aData[9]+' - '+obj.aData[10]+')</div>';
					}
				}					
			]
		});
		
		oTableRKL = $("#datatableRKL").dataTable({
			
			"aaSorting":[[3,"desc"]],
			"bDestroy":true,
			"bFilter":false,
			"bPaginate":false,
			"bInfo":false,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo base_url();?>lihatlaporan/listrencanakonservasilain?idp="+idp+"&tahunp="+tahunp,
			"sServerMethod" : "POST",
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			},
			"aoColumnDefs":[
				{
					"aTargets":[0],
					"fnRender": function(obj){
						return obj.aData[1];
					}
				},
				{
					"aTargets":[1],
					"fnRender": function(obj){
						return obj.aData[2];
					}
				}
			]
		});
		
		oTableAUA = $("#datatableAUA").dataTable({
			"aaSorting":[[0,"desc"]],
			"bDestroy":true,
			"bFilter":false,
			"bPaginate":false,
			"bInfo":false,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo base_url();?>lihatlaporan/listaudit?idp="+idp+"&tahunp="+tahunp,
			"sServerMethod" : "POST",
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			},
			"aoColumnDefs":[
				{
					"aTargets":[1],
					"fnRender": function(obj){
					 	if(obj.aData[2]==1){
							return "Sudah";
						}else{
							return "Belum";
						}
					}
				},
				{
					"aTargets":[2],
					"fnRender": function(obj){
					 	return obj.aData[3];
					}
				},
				{
					"aTargets":[3],
					"fnRender": function(obj){
						if(obj.aData[4]){
					 		return '<a href="<?php echo base_url();?>uploads/audit/'+obj.aData[4]+'" target="_blank">View file</a>';
						}else{
							return '-';
						}
					}
				}
			]
		});
		
		
		
		var urlp="";
		if("<?php echo $this->data['type_perusahaanp'];?>"=="Industri")
		{
			urlp="<?php echo base_url();?>lihatlaporan/listkonsumsienergispesifik?idp="+idp+"&tahunp="+tahunp;
		}
		if("<?php echo $this->data['type_perusahaanp'];?>"=="Bangunan")
		{
			urlp="<?php echo base_url();?>lihatlaporan/listkonsumsienergispesifikbang?idp="+idp+"&tahunp="+tahunp;
		}
		oTableKE = $("#datatableKE").dataTable({
			"bSort":false,
			"bDestroy":true,
			"bFilter":false,
			"bPaginate":false,
			"bInfo":false,
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": urlp,
			"sServerMethod" : "POST",
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			},
			"aoColumnDefs":[
				{
					"aTargets":[1],
					"fnRender": function(obj){
						return obj.aData[1];
					}
				},
				{
					"aTargets":[2],
					"fnRender": function(obj){
						var ret="";
						if(obj.aData[2]==0)
						{ret="-";} else {ret=formatCurrency(obj.aData[2],2);}
						return ret;
					}
				},
				{
					"aTargets":[3],
					"fnRender": function(obj){
						return formatCurrency(obj.aData[3],2);
					}
				},
				{
					"aTargets":[4],
					"fnRender": function(obj){
						return formatCurrency(obj.aData[4],2)+"%";
					}
				}
				
			]
		});
		
		
	});	
    </script>