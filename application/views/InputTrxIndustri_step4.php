<?php include('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
	<script type="text/javascript">
		function hideDiv(){ document.getElementById('divJenisEnergiLain').style.display = 'none'; } 
		function showDiv(){ document.getElementById('divJenisEnergiLain').style.display = 'inline'; } 
		function hideDiv1(){ document.getElementById('divJenisEnergiLain1').style.display = 'none'; } 
		function showDiv1(){ document.getElementById('divJenisEnergiLain1').style.display = 'inline'; } 
    </script>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Input Laporan Manajemen Energi Industrial</a></li>
				</ul>
			</div>
			
<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">

						<form id="form-wizard" class="form-horizontal" action="<?php echo base_url();?>TrxIndustri/add_save4" method="post" >	
                        <div id="form-wizard-1" class="step">
							<div class="step-title">
						 <i>4</i>
                                 <h5>Konsumsi Energi Spesifik</h5>
								 <span>4 dari 7</span>
							   </div>
                                <div class="control-group">
                            </div>
                               <div class="control-group">
							  <label class="control-label" for="IdPemakaianEnergi">Pemakaian Energi (GJoule)</label>
							  <div class="controls">
							    <input class="input-xlarge focused" id="IdPemakaianEnergi" type="text" name="JmlPemakaianEnergi" >
						      </div>
						      </div>
                              <div class="control-group">
							  <label class="control-label" for="IdProduksi">Produksi</label>
							  <div class="controls">
							    <input class="input-xlarge focused" id="IdProduksi" type="text" name="Produksi">
                                 <label><dfn>*) Misalnya, untuk Industri Besi dan Baja = Ton Baja; <br>Industri Tekstil = Ton Benang dan/atau m2 Kain;<br>Industri Kertas = Ton Kertas;<br>Industri Semen = Ton Semen.</dfn></label>
						      </div>
						      </div>
                                  
                                
                                  <div class="control-group">
                                    <label class="control-label" for="IdKonsumsiEnergi">Konsumsi Energi Spesifik</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" id="IdKnsumsiEnergi" type="text" name="KonsEnergiSpesifik">
                                     
                                    </div>
                                  </div>
                                  <div class="control-group">
                                    
                                   
                                    <div class="control-group">
							    
							    <div class="controls">
							      
						        </div>
						      </div>
                              
                              
                                    <!-- <span class="btn btn-primary">Tambah</span> -->
                             <!--  <table class="table">
                                <thead>
                                  <tr>
                                    <th>Jenis Peralatan Pemanfaat Energi Utama</th>
                                    <th>Jenis Energi</th>
                                    <th>Jumlah (Original Unit)</th>
                                    <th>Jumlah (GJoule)</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                  </tr>
                                </tbody>
                              </table> -->
                                </div>
                            </div>

									<div class="form-actions">
								<input id="back" class="btn btn-primary" type="reset" value="Back" />
								<input id="next" class="btn btn-primary" type="submit" value="Next" />
								<div id="status"></div>

                                  </div>
                             </div>


<?php include('footer.php'); ?>
