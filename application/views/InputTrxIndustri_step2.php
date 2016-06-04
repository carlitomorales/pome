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

						<form id="form-wizard" class="form-horizontal" action="<?php echo base_url();?>TrxIndustri/add_save2" method="post" >	
                        <div id="form-wizard-1" class="step">
							<div class="step-title">
							 <i>2</i>
                                 <h5>Jenis Produksi</h5>
								 <span>2 dari 7</span>
							   </div>
                               <div class="control-group">
                               </div>
                            	<div class="control-group">
                                    <label class="control-label" for="IdJnsProduksi">Jenis Produksi</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" id="IdJnsProduksi" type="text" name="JnsProduksi">
                                    </div>
                                  </div>
                                  <div class="control-group">
                                    <label class="control-label" for="IdJumlah">Jumlah</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" id="IdJumlah" type="text" name="Jumlah">
                                    </div>
                                  </div>
                                  <div class="control-group">
                                    <label class="control-label" for="IdSatuan">Satuan</label>
                                    <div class="controls">
                                     <select name="Satuan" id="select">
																				<option value="ton">ton</option>
																				<option value="m2">m2</option>
																		 </select>
                                    </div>
                                    <!-- <span class="btn btn-primary">Tambah</span> -->
																		                           <div class="form-actions">
								<input id="back" class="btn btn-primary" type="reset" value="Back" />
								<input id="next" class="btn btn-primary" type="submit" value="Next" />
								<div id="status"></div>
						   </div>
                            <!--   <table class="table">
                                <thead>
                                  <tr>
                                    <th>Jenis Produksi</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                  </tr>
                                </tbody>
                              </table> -->
                              </div>
                             </div>
                           <div id="submitted"></div> 
							 </form>
             </div>
						   

</div>
</div>

<?php include('footer.php'); ?>
